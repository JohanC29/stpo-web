<?php
require_once '../model/productoModel.php';

class ProductobaseController {
    public function consult(){
        $obj = new ProductoModel();

        // Categorias de productos

        $sql = "SELECT c.cat_codigo, c.cat_descripcion 
                FROM categoria c 
                WHERE 
                  c.est_codigo = 1 and c.cat_codigo <> -1
                ORDER BY c.cat_descripcion ASC";
        $categorias = $obj->consult($sql);
        include_once '../view/producto/productoBase/consultar.php';
    }

    public function insertar(){
        $obj = new ProductoModel();

        $id = $obj->autoIncrement('producto','prod_codigo');

        $desProducto = $_POST['nomProducto'];
        $subCategoriaProducto = $_POST['idSubCategoria'];

        $sql="INSERT INTO `producto` (`prod_codigo`, `prod_descripcion`, `sub_codigo`, `est_codigo`)
              VALUES ($id, '$desProducto', $subCategoriaProducto, '1')";

        $ejecutar= $obj->insert($sql);
        if($ejecutar){
            echo 'Insercion exitosa';
        }else{
            echo $ejecutar;
            echo "Ocurrio un error creando el nuevo producto.";
        }

        
    }

    public function editar(){
        $obj = new ProductoModel();

        $id = $_POST['editCodigoProducto'];
        $desProducto = $_POST['editNomProducto'];
        $subCategoriaProducto = $_POST['idSubCategoria'];

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
        
        $sql = "SELECT p.prod_codigo, p.prod_descripcion, c.cat_descripcion, s.sub_descripcion, p.est_codigo 
                FROM 
                  producto p, 
                  subcategoria s, 
                  categoria c 
                WHERE 
                  p.sub_codigo = s.sub_codigo 
                  AND s.cat_codigo = c.cat_codigo 
                  AND c.est_codigo = 1 
                  AND s.est_codigo = 1 
                  AND c.cat_codigo <> -1
                ORDER BY p.est_codigo, c.cat_descripcion, p.prod_codigo ASC";
        $resultados = $obj->consult($sql);
        //$maquinasJSON = $obj->convertirJSON($sql);
        //echo getUrl("maquina","maquina","getTable",false,"ajax");
        //echo $maquinasJSON;

        $result_array = array();
        if (mysqli_num_rows($resultados) > 0) {
            $item_array = array();
            while($row = mysqli_fetch_assoc($resultados)) {
                $btnAcciones = "<div class='form-button-action'><button type='button' title='Editar' class='editar btn btn-link btn-primary btn-lg resetSubCategoria' data-original-title='Editar'  data-toggle='modal' data-target='#editarProductoModal' ><i class='fa fa-edit'></i></button>";
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

    public function obtenerSubCategoria(){
        $obj = new ProductoModel();

        $idCategoria = $_POST['id'];

        $sql = "SELECT sub_codigo, sub_descripcion 
                FROM subcategoria s 
                WHERE 
                  s.cat_codigo = $idCategoria
                 AND s.est_codigo = 1";

        $resultado = $obj->consult($sql);
        $html = '';
        foreach ($resultado as $rs) {
            $html = $html . "<option value= '".$rs['sub_codigo']."'>".$rs['sub_descripcion']."</option>";
        }

        echo $html;
    }

}

?>