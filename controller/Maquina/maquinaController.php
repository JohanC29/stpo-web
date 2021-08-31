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

    public function getTable(){
        $obj = new MaquinaModel();
        
        $sql = "SELECT * FROM maquina";
        $maquinas = $obj->consult($sql);
        //$maquinasJSON = $obj->convertirJSON($sql);
        //echo getUrl("maquina","maquina","getTable",false,"ajax");
        //echo $maquinasJSON;


        $result_array = array();
        if (mysqli_num_rows($maquinas) > 0) {
            $item_array = array();
            while($row = mysqli_fetch_assoc($maquinas)) {
                $btnAcciones = "<div class='form-button-action'><button type='button' data-toggle='tooltip' title='' class='editar btn btn-link btn-primary btn-lg' data-original-title='Editar'><i class='fa fa-edit'></i></button>";
                if($row['est_codigo']==1){
                    $btnAcciones=$btnAcciones."<button type='button' data-toggle='tooltip' title=''class='btn btn-link btn-danger' data-original-title='Eliminar'><i class='fas fa-eye-slash'></i></button>";
                }else{
                    $btnAcciones = $btnAcciones."<button type='button' data-toggle='tooltip' title='' class='btn btn-link btn-success' data-original-title='Habilitar'><i class=' fas fa-eye'></i></button>";
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