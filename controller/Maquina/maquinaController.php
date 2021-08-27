<?php
require_once '../model/maquinaModel.php';

class MaquinaController {
    public function consult(){
        $obj = new MaquinaModel();
        //$sql = "SELECT * FROM unidadOperativa";
        //$unidadesOperativas = $obj->consult($sql);
        include_once '../view/maquina/consultar.php';
    }



}

?>