<?php
require_once '../model/productoModel.php';

class ProductobaseController {
    public function consult(){
        $obj = new ProductoModel();
        //$sql = "SELECT * FROM unidadOperativa";
        //$unidadesOperativas = $obj->consult($sql);
        include_once '../view/producto/productoBase/consultar.php';
    }

    public function insertar(){
        $obj = new ProductoModel();

        $id = $obj->autoIncrement('producto','prod_codigo');

        $desProducto = $_POST['nomProducto'];
        $subCategoriaProducto = $_POST['subCategoria'];

        $sql="INSERT INTO `producto` (`prod_codigo`, `prod_descripcion`, `sub_codigo`, `est_codigo`)
              VALUES ($id, '$desProducto', $subCategoriaProducto, '1')";

        $ejecutar= $obj->insert($sql);
        if($ejecutar){
            echo 'Insercion exitosa';
        }else{
            echo $ejecutar;
            echo "Ocurrio un error creando la nueva maquina.";
        }
        
    }

    public function editar(){
        $obj = new ProductoModel();

        $id = $_POST['editCodigoMaquina'];
        $desProducto = $_POST['editNomProducto'];
        $subCategoriaProducto = $_POST['editSubCategoria'];

        $sql = "UPDATE `producto` SET 
                `prod_descripcion` = '$desProducto', 
                `sub_codigo` = $subCategoriaProducto 
                WHERE 
                `producto`.`prod_codigo` = $id";

        $ejecutar= $obj->insert($sql);
        if($ejecutar){
            echo 'Actualizacion exitosa';
        }else{
            echo $ejecutar;
            echo "Ocurrio un error creando la nueva maquina.";
        }
        
    }


    public function eliminar(){
        $obj = new ProductoModel();

        $id = $_POST['id'];
        $est_codigo = $_POST['est_codigo'];

        //Cambio de estado
        if($est_codigo == 1){

            $est_codigo = 2;
        }else{
            $est_codigo = 1;
        }

        $sql = "UPDATE `producto` SET 
                `est_codigo` = $est_codigo
                WHERE 
                `producto`.`prod_codigo` = $id";

        $ejecutar= $obj->insert($sql);
        if($ejecutar){
            echo 'Actualizacion exitosa';
        }else{
            echo $ejecutar;
            echo "Ocurrio un error actualizando la maquina.";
        }
    }

    public function getTable(){
        $obj = new ProductoModel();
        
        $sql = "SELECT * FROM producto m ORDER BY m.est_codigo ASC";
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