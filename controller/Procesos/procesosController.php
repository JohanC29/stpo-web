<?php
require_once '../model/procesosModel.php';

class ProcesosController {
    public function consult(){
        $obj = new ProcesosModel();
        //$sql = "SELECT * FROM unidadOperativa";
        //$unidadesOperativas = $obj->consult($sql);
        include_once '../view/procesos/consultar.php';
    }

}

?>