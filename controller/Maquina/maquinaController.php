<?php
require_once '../model/maquinaModel.php';

class MaquinaController {
    public function consult(){
        //$obj = new MaquinaModel();
        //$sql = "SELECT * FROM maquina";
        //$maquinas = $obj->consult($sql);
        include_once '../view/maquina/consultar.php';
    }

    public function insertar(){
        $obj = new MaquinaModel();

        $id = $obj->autoIncrement('maquina','maq_codigo');
        $idenMaquina = $_POST['idenMaquina'];
        $nomMaquina = $_POST['nomMaquina'];

        $sql="INSERT INTO `maquina` (`maq_codigo`, `maq_identificador`, `maq_nombre`, `est_codigo`)
              VALUES ($id, '$idenMaquina', '$nomMaquina', '1')";

        $ejecutar= $obj->insert($sql);
        if($ejecutar){
            echo 'Insercion exitosa';
        }else{
            echo $ejecutar;
            echo "Ocurrio un error creando la nueva maquina.";
        }
        
    }

    public function editar(){
        $obj = new MaquinaModel();

        $id = $_POST['editCodigoMaquina'];
        $idenMaquina = $_POST['editIdenMaquina'];
        $nomMaquina = $_POST['editNomMaquina'];

        $sql = "UPDATE `maquina` SET 
                `maq_identificador` = '$idenMaquina', 
                `maq_nombre` = '$nomMaquina' 
                WHERE 
                `maquina`.`maq_codigo` = $id";

        $ejecutar= $obj->insert($sql);
        if($ejecutar){
            echo 'Actualizacion exitosa';
        }else{
            echo $ejecutar;
            echo "Ocurrio un error creando la nueva maquina.";
        }
        
    }


    public function eliminar(){
        $obj = new MaquinaModel();

        $id = $_POST['id'];
        $est_codigo = $_POST['est_codigo'];

        //Cambio de estado
        if($est_codigo == 1){

            $est_codigo = 2;
        }else{
            $est_codigo = 1;
        }

        $sql = "UPDATE `maquina` SET 
                `est_codigo` = $est_codigo
                WHERE 
                `maquina`.`maq_codigo` = $id";

        $ejecutar= $obj->insert($sql);
        if($ejecutar){
            echo 'Actualizacion exitosa';
        }else{
            echo $ejecutar;
            echo "Ocurrio un error actualizando la maquina.";
        }
    }

    public function getTable(){
        $obj = new MaquinaModel();
        
        $sql = "SELECT * FROM maquina m ORDER BY m.est_codigo ASC";
        $maquinas = $obj->consult($sql);
        //$maquinasJSON = $obj->convertirJSON($sql);
        //echo getUrl("maquina","maquina","getTable",false,"ajax");
        //echo $maquinasJSON;

        $result_array = array();
        if (mysqli_num_rows($maquinas) > 0) {
            $item_array = array();
            while($row = mysqli_fetch_assoc($maquinas)) {
                $btnAcciones = "<div class='form-button-action'><button type='button' title='Editar' class='editar btn btn-link btn-primary btn-lg' data-original-title='Editar'  data-toggle='modal' data-target='#editarMaquinaModal' ><i class='fa fa-edit'></i></button>";
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


}

?>