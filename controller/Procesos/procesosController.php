<?php
require_once '../model/procesosModel.php';

class ProcesosController {
    public function consult(){
        $obj = new ProcesosModel();
        //$sql = "SELECT * FROM unidadOperativa";
        //$unidadesOperativas = $obj->consult($sql);
        include_once '../view/procesos/consultar.php';
    }

    public function insertar(){
        $obj = new ProcesosModel();

        $id = $obj->autoIncrement('proceso','pro_codigo');
        $idenProceso = $_POST['idenProceso'];
        $nomProceso = $_POST['nomProceso'];

        $sql="INSERT INTO `proceso` (`pro_codigo`, `pro_identificador`, `pro_nombre`, `est_codigo`)
              VALUES ($id, '$idenProceso', '$nomProceso', '1')";

        $ejecutar= $obj->insert($sql);
        if($ejecutar){
            echo 'Insercion exitosa';
        }else{
            echo $ejecutar;
            echo "Ocurrio un error creando el nuevo proceso.";
        }
        
    }


    //

    public function editar(){
        $obj = new ProcesosModel();

        $id = $_POST['editCodigoProceso'];
        $idenProceso = $_POST['editIdenProceso'];
        $nomProceso = $_POST['editNomProceso'];

        $sql = "UPDATE `proceso` SET 
                `pro_identificador` = '$idenProceso', 
                `pro_nombre` = '$nomProceso' 
                WHERE 
                `proceso`.`pro_codigo` = $id";

        $ejecutar= $obj->insert($sql);
        if($ejecutar){
            echo 'Actualizacion exitosa';
        }else{
            echo $ejecutar;
            echo "Ocurrio un error actualizando el proceso.";
        }
        
    }


    public function eliminar(){
        $obj = new ProcesosModel();

        $id = $_POST['id'];
        $est_codigo = $_POST['est_codigo'];

        //Cambio de estado
        if($est_codigo == 1){

            $est_codigo = 2;
        }else{
            $est_codigo = 1;
        }

        $sql = "UPDATE `proceso` SET 
                `est_codigo` = $est_codigo
                WHERE 
                `proceso`.`pro_codigo` = $id";

        $ejecutar= $obj->insert($sql);
        if($ejecutar){
            echo 'Actualizacion exitosa';
        }else{
            echo $ejecutar;
            echo "Ocurrio un error actualizando el proceso.";
        }
    }

    public function getTable(){
        $obj = new ProcesosModel();
        
        $sql = "SELECT * FROM proceso";
        $maquinas = $obj->consult($sql);
        //$maquinasJSON = $obj->convertirJSON($sql);
        //echo getUrl("maquina","maquina","getTable",false,"ajax");
        //echo $maquinasJSON;

        $result_array = array();
        if (mysqli_num_rows($maquinas) > 0) {
            $item_array = array();
            while($row = mysqli_fetch_assoc($maquinas)) {
                $btnAcciones = "<div class='form-button-action'><button type='button' title='Editar' class='editar btn btn-link btn-primary btn-lg' data-original-title='Editar'  data-toggle='modal' data-target='#editarProcesoModal' ><i class='fa fa-edit'></i></button>";
                if($row['est_codigo']==1){
                    $btnAcciones=$btnAcciones."<button estado = '1' type='button' data-toggle='tooltip' title='Eliminar'class='eliminar btn btn-link btn-danger' data-original-title='Eliminar'><i class='fas fa-eye-slash'></i></button>";
                }else{
                    $btnAcciones = $btnAcciones."<button estado = '2' type='button' data-toggle='tooltip' title='Habilitar' class='eliminar btn btn-link btn-success' data-original-title='Habilitar'><i class=' fas fa-eye'></i></button>";
                }
                $btnAcciones = $btnAcciones."</div>";
                $row['est_codigo'] = $btnAcciones;
                $result_array[]=$row;
            }
            echo json_encode($result_array);                
        }
        //return -1;
        // print_r($result_array);

    }

    public function consultAsignacionMaquina(){
        $obj = new ProcesosModel();

        $sql = "SELECT p.pro_codigo,p.pro_nombre
                FROM
                proceso p
                WHERE
                    p.est_codigo = 1
                ORDER BY p.pro_nombre";
        
        $procesos = $obj->consult($sql);
        include_once '../view/procesos/ProcesoMaquina/consultar.php';
    }

    public function getProcesos(){
        

        // $sql = "SELECT pro_identificador FROM proceso";
        
        // //$maquinasJSON = $obj->convertirJSON($sql);
        // //echo getUrl("maquina","maquina","getTable",false,"ajax");
        // //echo $maquinasJSON;

        // $result_array = array();
        // if (mysqli_num_rows($maquinas) > 0) {
        //     $item_array = array();
        //     while($row = mysqli_fetch_assoc($maquinas)) {
        //           $result_array[]=$row;
        //     }
        //     echo json_encode($result_array);                
        // }


        //
        if(isset($_POST['search'])){
            $obj = new ProcesosModel();
            $search = mysqli_real_escape_string($con,$_POST['search']);
           
            $sql = "SELECT * FROM proceso WHERE pro_identificador like'%".$search."%'";
            $procesos = $obj->consult($sql);
           
            $response = array();
            while($row = mysqli_fetch_array($procesos) ){
              $response[] = array("value"=>$row['pro_codigo'],"label"=>$row['pro_identificador']);
            }
           
            echo json_encode($response);
           }
    }


    public function getTableAsignacionMaquina(){
        $obj = new ProcesosModel();

        $id = $_GET['id'];
        $idenP = $_GET['idenP'];

        if ($id==0 && (!$idenP=='')) {
            $sql = "SELECT m.* FROM maquina m, 
                    detalleprocesomaquina d, proceso p
                    WHERE m.maq_codigo = d.maq_codigo
                    AND d.pro_codigo = p.pro_codigo
                    AND upper(p.pro_identificador) = upper('$idenP')
                    ORDER BY m.est_codigo ASC";
        }elseif ($id!=0 && ($idenP=='')) {
            $sql = "SELECT m.* FROM maquina m, 
                    detalleprocesomaquina d, proceso p
                    WHERE m.maq_codigo = d.maq_codigo
                    AND d.pro_codigo = p.pro_codigo
                    AND d.pro_codigo = $id
                    ORDER BY m.est_codigo ASC";
        }
        
        
        $maquinas = $obj->consult($sql);
        //$maquinasJSON = $obj->convertirJSON($sql);
        //echo getUrl("maquina","maquina","getTable",false,"ajax");
        //echo $maquinasJSON;

        $result_array = array();
        if (mysqli_num_rows($maquinas) > 0) {
            $item_array = array();
            while($row = mysqli_fetch_assoc($maquinas)) {
                $btnAcciones = "<div class='form-button-action'><button type='button' title='Editar' class='editar btn btn-link btn-primary btn-lg' data-original-title='Editar'  data-toggle='modal' data-target='#editarProcesoModal' ><i class='fa fa-edit'></i></button>";
                if($row['est_codigo']==1){
                    $btnAcciones=$btnAcciones."<button estado = '1' type='button' data-toggle='tooltip' title='Eliminar'class='eliminar btn btn-link btn-danger' data-original-title='Eliminar'><i class='fas fa-eye-slash'></i></button>";
                }else{
                    $btnAcciones = $btnAcciones."<button estado = '2' type='button' data-toggle='tooltip' title='Habilitar' class='eliminar btn btn-link btn-success' data-original-title='Habilitar'><i class=' fas fa-eye'></i></button>";
                }
                $btnAcciones = $btnAcciones."</div>";
                $row['est_codigo'] = $btnAcciones;
                $result_array[]=$row;
            }
            echo json_encode($result_array);                
        }
        //return -1;
        // print_r($result_array);

    }

    public function validaAsigancionMaquina(){
        $obj = new ProcesosModel();

        $id = $_POST['id'];
        

        $result_array = array();
        if($id != 0){
            //Valida si existe proceso
            

            $sql = "SELECT COUNT(1) vaProceso
            FROM proceso p 
            WHERE
            p.pro_codigo = $id";

            $resultado = $obj->consult($sql);
            if (mysqli_num_rows($resultado) > 0) {
                while($row = mysqli_fetch_assoc($resultado)) {
                    $result_array[]=$row;
                }
            }

            if($result_array[0]['vaProceso'] >0){
                //Valida si existe maquina asociada
            $sql = "SELECT count(1) vaMaquina FROM
            detalleprocesomaquina d 
            where
            d.pro_codigo = $id";

            $resultado = $obj->consult($sql);
            if (mysqli_num_rows($resultado) > 0) {
                while($row = mysqli_fetch_assoc($resultado)) {
                    $result_array[]=$row;
                }
            }
            }else{
                $result_array[]=['vaMaquina' => '0'];
            }

            echo json_encode($result_array);

        }
        if(isset($_POST['idenP'])){
            $idenP = $_POST['idenP'];

            if($idenP != ''){
                //Valida si existe proceso
                $sql = "SELECT COUNT(1) vaProceso
                FROM proceso p 
                WHERE
                upper(p.pro_identificador) = upper('$idenP')";

                $resultado = $obj->consult($sql);
                if (mysqli_num_rows($resultado) > 0) {
                    while($row = mysqli_fetch_assoc($resultado)) {
                        $result_array[]=$row;
                    }
                }

                if($result_array[0]['vaProceso']>0){                
                //Valida si existe maquina asociada
                $sql = "SELECT COUNT(1) vaMaquina FROM maquina m, 
                detalleprocesomaquina d, proceso p
                WHERE m.maq_codigo = d.maq_codigo
                AND d.pro_codigo = p.pro_codigo
                AND upper(p.pro_identificador) = upper('$idenP')
                ";
    
                $resultado = $obj->consult($sql);
                if (mysqli_num_rows($resultado) > 0) {
                    while($row = mysqli_fetch_assoc($resultado)) {
                        $result_array[]=$row;
                    }
                }

                }else{
                    $result_array[]=['vaMaquina' => 0];
                }
    
                echo json_encode($result_array);
            }
        }
        

    }


}

?>