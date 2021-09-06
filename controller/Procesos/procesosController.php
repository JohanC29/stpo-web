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
        //$obj = new ProcesosModel();
        //$sql = "SELECT * FROM unidadOperativa";
        //$unidadesOperativas = $obj->consult($sql);
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


}

?>