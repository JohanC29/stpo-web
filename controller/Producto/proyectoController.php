<?php
require_once '../model/productoModel.php';

class ProyectoController {
    public function consult(){
        $obj = new ProductoModel();
        //$sql = "SELECT * FROM unidadOperativa";
        //$unidadesOperativas = $obj->consult($sql);
        include_once '../view/producto/proyecto/consultar.php';
    }

}

?>