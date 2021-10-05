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



    //  PRUCTO DETALLE -----///
    public function consultProductoDetalle(){
        $obj = new ProductoModel();

        // Consulta producto

        $sql = "SELECT p.prod_codigo, upper(p.prod_descripcion) AS prod_descripcion
                    FROM
                    producto p
                    WHERE
                    p.est_codigo = 1
                    ORDER BY p.prod_descripcion ASC";


        $producto = $obj->consult($sql);


        // Consultar procesos
        $sql = "SELECT p.pro_codigo, upper(p.pro_nombre) AS pro_nombre
                    FROM
                    proceso p
                    WHERE
                    p.est_codigo = 1
                    ORDER BY p.pro_nombre ASC";

        $dprodproceso = $obj->consult($sql);
        include_once '../view/producto/productoBase/ProductoDetalle/consultar.php';
    }



    public function getTableProductoDetalle(){
        $obj = new ProductoModel();

        $id = $_GET['id'];
        $idenP = $_GET['idenP'];

        // Validar si tiene resultados
        $contador = 0;

        if ($id==0 && (!$idenP=='')) {
            // Contador validador
            $sql="SELECT COUNT(1) contador FROM
                    proceso p,
                    producto pr,
                    detalleproducto dp
                    WHERE
                    dp.pro_codigo = p.pro_codigo
                    AND dp.prod_codigo = pr.prod_codigo
                    AND pr.prod_codigo = $idenP
                    ORDER BY dp.dprod_orden ASC";

            $resultadoCount = $obj->consult($sql);
            

            foreach ($resultadoCount as $rsc) {
                $contador = $rsc['contador'];
            }

            if($contador!= '0'){
                $sql = "SELECT p.*, dp.dprod_orden FROM
                            proceso p,
                            producto pr,
                            detalleproducto dp
                            WHERE
                            dp.pro_codigo = p.pro_codigo
                            AND dp.prod_codigo = pr.prod_codigo
                            AND pr.prod_codigo = $idenP
                            ORDER BY dp.dprod_orden ASC";
            }

            

            
        }elseif ($id!=0 && ($idenP=='')) {
            // Contador validador
            $sql="SELECT COUNT(1) contador FROM
                    proceso p,
                    producto pr,
                    detalleproducto dp
                    WHERE
                    dp.pro_codigo = p.pro_codigo
                    AND dp.prod_codigo = pr.prod_codigo
                    AND pr.prod_codigo = $id
                    ORDER BY dp.dprod_orden ASC";

            $resultadoCount = $obj->consult($sql);


            foreach ($resultadoCount as $rsc) {
                $contador = $rsc['contador'];
            }

            if($contador != '0'){
                $sql = "SELECT p.*, dp.dprod_orden FROM
                            proceso p,
                            producto pr,
                            detalleproducto dp
                            WHERE
                            dp.pro_codigo = p.pro_codigo
                            AND dp.prod_codigo = pr.prod_codigo
                            AND pr.prod_codigo = $id
                            ORDER BY dp.dprod_orden ASC";
            }

            // echo $sql;
 
        }

        if($contador == '0' ){
            $sql = "SELECT -1 pro_codigo, 
                        'Sin Resultados' pro_identificador, 
                        '' pro_nombre, 1 est_codigo, -1 dprod_orden
                    FROM DUAL";
        }
        
        
        $procesos = $obj->consult($sql);
        //$maquinasJSON = $obj->convertirJSON($sql);
        //echo getUrl("maquina","maquina","getTable",false,"ajax");
        //echo $maquinasJSON;

        $result_array = array();
        if (mysqli_num_rows($procesos) > 0) {
            $item_array = array();
            while($row = mysqli_fetch_assoc($procesos)) {
                if($row['pro_codigo'] != -1){
                    $btnAcciones = "<div class='form-button-action'>";

                    $btnAcciones=$btnAcciones."<button estado = '1' type='button' data-toggle='tooltip' title='Eliminar'class='eliminar btn btn-link btn-danger' data-original-title='Eliminar'><i class='fas fa-trash-alt'></i></button>";
                    
                    $btnAcciones = $btnAcciones."</div>";
                }else{
                    $btnAcciones = "<div class='form-button-action'>";

                    //  $btnAcciones=$btnAcciones."<button estado = '1' type='button' data-toggle='tooltip' title='Eliminar'class='eliminar btn btn-link btn-danger' data-original-title='Eliminar'><i class='fas fa-trash-alt'></i></button>";
                    
                    $btnAcciones = $btnAcciones."</div>";
                }
                
                $row['est_codigo'] = $btnAcciones;
                $result_array[]=$row;
            }
            echo json_encode($result_array);                
        }
        //return -1;
        // print_r($result_array);
    }



    public function validaDetalleProducto(){
        $obj = new ProductoModel();

        $id = $_POST['id'];
        

        $result_array = array();
        if($id != 0){
            //Valida si existe producto
            

            $sql = "SELECT COUNT(1) vaProducto
            FROM producto p 
            WHERE
            p.prod_codigo = $id";

            $resultado = $obj->consult($sql);
            if (mysqli_num_rows($resultado) > 0) {
                while($row = mysqli_fetch_assoc($resultado)) {
                    $result_array[]=$row;
                }
            }

            if($result_array[0]['vaProducto'] >0){
                //Valida si existe proceso asociada
            $sql = "SELECT count(1) vaProceso, 
                            (SELECT p.prod_codigo FROM producto p WHERE p.prod_codigo = d.prod_codigo) prod_codigo, 
                            (SELECT pr.prod_descripcion FROM producto pr WHERE pr.prod_codigo = d.prod_codigo) prod_descripcion 
                    FROM 
                        detalleproducto d 
                    WHERE
                        d.prod_codigo = $id";

            $resultado = $obj->consult($sql);
            if (mysqli_num_rows($resultado) > 0) {
                while($row = mysqli_fetch_assoc($resultado)) {
                    $result_array[]=$row;
                }
            }
            }else{
                $result_array[]=['vaProceso' => '0',
                                 'prod_codigo' => '0',
                                 'prod_descripcion' => '0',];
            }

            echo json_encode($result_array);

        }
        if(isset($_POST['idenP'])){
            $idenP = $_POST['idenP'];

            if($idenP != ''){
                //Valida si existe proceso
                $sql = "SELECT COUNT(1) vaProducto
                            FROM producto p 
                            WHERE
                            p.prod_codigo = $idenP";

                
                $resultado = $obj->consult($sql);
                if (mysqli_num_rows($resultado) > 0) {
                    while($row = mysqli_fetch_assoc($resultado)) {
                        $result_array[]=$row;
                    }
                }

                if($result_array[0]['vaProducto']>0){                
                //Valida si existe maquina asociada
                $sql = "SELECT count(1) vaProceso, 
                                (SELECT p.prod_codigo FROM producto p WHERE p.prod_codigo = d.prod_codigo) prod_codigo, 
                                (SELECT pr.prod_descripcion FROM producto pr WHERE pr.prod_codigo = d.prod_codigo) prod_descripcion 
                        FROM 
                            detalleproducto d 
                        WHERE
                            d.prod_codigo = $idenP";
    
                $resultado = $obj->consult($sql);
                if (mysqli_num_rows($resultado) > 0) {
                    while($row = mysqli_fetch_assoc($resultado)) {
                        $result_array[]=$row;
                    }
                }

                }else{
                    $result_array[]=[   'vaProceso' => '0',
                                        'prod_codigo' => '0',
                                        'prod_descripcion' => '0',];
                }
    
                echo json_encode($result_array);
            }
        }
        

    }



    public function insertarDetalleProducto(){
        $obj = new ProductoModel();

        $id = $obj->autoIncrement('detalleproducto','dprod_codigo');

        $dprodIdCodigoNombre           = $_POST['dprodIdCodigoNombre'];
        $dprodIdCodigoProceso          = $_POST['dprodIdCodigoProceso'];
        $dprodIdCodigoProcesoSelect    = $_POST['dprodIdCodigoProcesoSelect'];

        //---
        $dprodIdCodigoNombre    = substr($dprodIdCodigoNombre,0,strpos($dprodIdCodigoNombre,'-'));



        $sql="INSERT INTO `detalleproducto` (`dprod_codigo`, `pro_codigo`, `prod_codigo`)
              VALUES ($id, $dprodIdCodigoProcesoSelect, $dprodIdCodigoNombre )";
        
        $ejecutar= $obj->insert($sql);
        if($ejecutar){
            echo 'Insercion exitosa';
        }else{
            echo $ejecutar;
            echo "Ocurrio un error creando el nuevo proceso.";
        }
        
    }


    public function elimiarDetalleProducto(){
        $obj = new ProductoModel();

        $idProducto          = $_POST['idCampo1'];
        $idProceso          = $_POST['idCampo2'];

        $sql="DELETE FROM `detalleproducto` WHERE `pro_codigo`= $idProceso AND `prod_codigo` = $idProducto";

        $ejecutar= $obj->insert($sql);
        if($ejecutar){
            echo 'Eliminacion exitosa';
        }else{
            echo $ejecutar;
            echo "Ocurrio un error creando el nuevo proceso.";
        }
        
    }
    

}

?>