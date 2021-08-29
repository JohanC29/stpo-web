<?php
require_once '../model/maquinaModel.php';

class MaquinaController {
    public function consult(){
        $obj = new MaquinaModel();
        $sql = "SELECT * FROM maquina";
        $maquinas = $obj->consult($sql);
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
        echo $sql;
        if($ejecutar){
            echo 'Insercion exitosa';
        }else{
            echo $ejecutar;
            echo "Ocurrio un error creando la nueva maquina.";
        }
        
    }



}

?>