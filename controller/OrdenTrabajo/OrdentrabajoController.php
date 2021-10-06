<?php
require_once '../model/ordentrabajoModel.php';

class OrdentrabajoController {
    public function consult(){
        $obj = new OrdenTrabajoModel();
        $sql ="SELECT * FROM `subcategoria` s WHERE s.est_codigo = 1 ORDER BY s.sub_descripcion ASC";
        // $sql = "SELECT * FROM producto p WHERE p.est_codigo = 1 ORDER BY p.prod_descripcion ASC";
        $subCategoria = $obj->consult($sql);
        include_once '../view/ordentrabajo/consultar.php';
    }

    public function insertar(){
        $obj = new OrdenTrabajoModel();

        $id = $obj->autoIncrement('ordentrabajo','otr_codigo');

        $ortIdentificador   = $_POST['idenOrdenTrabajo'];
        $prodCodigo         = $_POST['otrIdProducto'];

        $sql="INSERT INTO `ordentrabajo` (`otr_codigo`, `otr_identificador`, `prod_codigo`, `est_codigo`)
              VALUES ($id, '$ortIdentificador', '$prodCodigo', '1')";

        $ejecutar= $obj->insert($sql);
        if($ejecutar){
            echo 'Insercion exitosa';
        }else{
            echo $ejecutar;
            echo "Ocurrio un error creando la nueva maquina.";
        }
        
    }

    public function editar(){
        $obj = new OrdenTrabajoModel();

        $id                 = $_POST['editCodigoOrdenTrabajo'];
        $ortIdentificador   = $_POST['editidenOrdenTrabajo'];
        $prodCodigo         = $_POST['editOtrIdProducto'];

        $sql = "UPDATE `ordentrabajo` SET 
                `otr_identificador` = '$ortIdentificador', 
                `prod_codigo` = $prodCodigo 
                WHERE 
                `ordentrabajo`.`otr_codigo` = $id";

        $ejecutar= $obj->insert($sql);
        if($ejecutar){
            echo 'Actualizacion exitosa';
        }else{
            echo $ejecutar;
            echo "Ocurrio un error creando la nueva maquina.";
        }
        
    }


    public function eliminar(){
        $obj = new OrdenTrabajoModel();

        $id = $_POST['id'];
        $est_codigo = $_POST['est_codigo'];

        //Cambio de estado
        if($est_codigo == 1){

            $est_codigo = 2;
        }else{
            $est_codigo = 1;
        }

        $sql = "UPDATE `ordentrabajo` SET 
                `est_codigo` = $est_codigo
                WHERE 
                `ordentrabajo`.`otr_codigo` = $id";

        $ejecutar= $obj->insert($sql);
        if($ejecutar){
            echo 'Actualizacion exitosa';
        }else{
            echo $ejecutar;
            echo "Ocurrio un error actualizando la maquina.";
        }
    }

    public function getTable(){
        $obj = new OrdenTrabajoModel();
        
        $sql = "SELECT 
                    o.otr_codigo, 
                    o.otr_identificador, 
                    p.prod_codigo, 
                    p.prod_descripcion, 
                    o.est_codigo 
                FROM 
                    ordentrabajo o,
                    producto p
                WHERE
                    o.prod_codigo = p.prod_codigo
                ORDER BY o.est_codigo ASC";
        $resultado = $obj->consult($sql);
        //$maquinasJSON = $obj->convertirJSON($sql);
        //echo getUrl("maquina","maquina","getTable",false,"ajax");
        //echo $maquinasJSON;

        $result_array = array();
        if (mysqli_num_rows($resultado) > 0) {
            $item_array = array();
            while($row = mysqli_fetch_assoc($resultado)) {
                $btnAcciones = "<div class='form-button-action'><button type='button' title='Editar' class='editar btn btn-link btn-primary btn-lg' data-original-title='Editar'  data-toggle='modal' data-target='#editarOrdenTrabajoModal' ><i class='fa fa-edit'></i></button>";
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

    public function filtroProductoCategoria(){
        $obj = new OrdenTrabajoModel();
        $idSubCategoria = $_POST['id'];
        
        $sql = "SELECT p.prod_codigo, p.prod_descripcion FROM 
                    producto p 
                WHERE 
                p.est_codigo = 1
                AND p.sub_codigo = $idSubCategoria 
                
                ORDER BY p.prod_descripcion ASC";
        $productos = $obj->consult($sql);
        $row=$productos->num_rows;
        if($row > 0){
            echo '<option value="0" selected>Seleccione Prodcuto</option>';
            foreach ($productos as $srs) {
                echo "<option value= '" . $srs['prod_codigo'] . "'>" . $srs['prod_descripcion'] . "</option>";
            }
        }else{
            echo '<option value="0" selected>La categoria no tiene productos.</option>';
        }
        
    }


    public function filtroDescripcion(){
        $obj = new OrdenTrabajoModel();
        $idProducto = $_POST['id'];
        
        $sql = "SELECT p.prod_detalle FROM 
                    producto p 
                WHERE 
                p.est_codigo = 1
                AND p.prod_codigo = $idProducto";
        $productos = $obj->consult($sql);
        
        foreach ($productos as $srs) {
            echo $srs['prod_detalle'] ;
        }
        
        
    }



    // Detalle orden de trabajo
    public function consultOtDetalle(){
        $obj = new OrdenTrabajoModel();
        $sql ="SELECT * FROM `ordentrabajo` o WHERE o.est_codigo = 1 ORDER BY o.otr_identificador ASC";
        // $sql = "SELECT * FROM producto p WHERE p.est_codigo = 1 ORDER BY p.prod_descripcion ASC";
        $ordenTrabajo = $obj->consult($sql);

        // Consultar procesos
        $sql = "SELECT p.pro_codigo, upper(p.pro_nombre) AS pro_nombre
                    FROM
                    proceso p
                    WHERE
                    p.est_codigo = 1
                    ORDER BY p.pro_nombre ASC";

        $dotrproceso = $obj->consult($sql);


        include_once '../view/ordentrabajo/OtDetalle/consultar.php';
    }

    // Obtener datos para la tabla
    public function getTableProductoDetalle(){
        $obj = new OrdenTrabajoModel();

        $id = $_GET['id'];
        $idenP = $_GET['idenP'];

        // Validar si tiene resultados
        $contador = 0;

        if ($id==0 && (!$idenP=='')) {
            // Contador validador
            $sql="SELECT COUNT(1) contador FROM
                    ordentrabajo o,
                    proceso p,
                    detalleordentrabajo dot
                    where 
                    o.otr_codigo = dot.otr_codigo
                    and dot.pro_codigo = p.pro_codigo
                    AND o.otr_identificador = $idenP
                    ";

            $resultadoCount = $obj->consult($sql);
            

            foreach ($resultadoCount as $rsc) {
                $contador = $rsc['contador'];
            }

            if($contador!= '0'){
                $sql = "SELECT dot.dotr_codigo, 
                               p.pro_codigo, 
                               p.pro_nombre, 
                               dot.dotr_cantidad, 
                               dot.dotr_orden,
                               1 est_codigo
                            FROM 
                            ordentrabajo o,
                            proceso p,
                            detalleordentrabajo dot
                            WHERE 
                            o.otr_codigo = dot.otr_codigo
                            AND dot.pro_codigo = p.pro_codigo
                            AND o.otr_identificador = $idenP
                            ORDER BY dot.dotr_orden ASC";
            }

            

            
        }elseif ($id!=0 && ($idenP=='')) {
            // Contador validador
            $sql="SELECT COUNT(1) contador FROM
                    ordentrabajo o,
                    proceso p,
                    detalleordentrabajo dot
                    where 
                    o.otr_codigo = dot.otr_codigo
                    and dot.pro_codigo = p.pro_codigo
                    AND o.otr_codigo = $id";

            $resultadoCount = $obj->consult($sql);


            foreach ($resultadoCount as $rsc) {
                $contador = $rsc['contador'];
            }

            if($contador != '0'){
                $sql = "SELECT dot.dotr_codigo, 
                               p.pro_codigo, 
                               p.pro_nombre, 
                               dot.dotr_cantidad, 
                               dot.dotr_orden,
                               1 est_codigo
                            FROM 
                            ordentrabajo o,
                            proceso p,
                            detalleordentrabajo dot
                            WHERE 
                            o.otr_codigo = dot.otr_codigo
                            AND dot.pro_codigo = p.pro_codigo
                            AND o.otr_codigo = $id
                            ORDER BY dot.dotr_orden ASC";
            }

            // echo $sql;
 
        }

        if($contador == '0' ){
            $sql = "SELECT -1 dotr_codigo, 
                        ''  pro_codigo, 
                         'Sin Resultados' pro_nombre, 
                         '' dotr_cantidad, 
                         '' dotr_orden,
                         -1 est_codigo
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


    public function validaOtDetalle(){
        $obj = new OrdenTrabajoModel();

        $id = $_POST['id'];
        

        $result_array = array();
        if($id != 0){
            //Valida si existe producto
            

            $sql = "SELECT COUNT(1) vaOrdenTrabajo
            FROM ordentrabajo o 
            WHERE
            o.otr_codigo = $id";

            $resultado = $obj->consult($sql);
            if (mysqli_num_rows($resultado) > 0) {
                while($row = mysqli_fetch_assoc($resultado)) {
                    $result_array[]=$row;
                }
            }

            if($result_array[0]['vaOrdenTrabajo'] >0){
                //Valida si existe proceso asociada
            $sql = "SELECT count(1) vaProceso, 
                            (SELECT o.otr_codigo FROM ordentrabajo o WHERE o.otr_codigo = d.otr_codigo) otr_codigo, 
                            (SELECT ot.otr_identificador FROM ordentrabajo ot WHERE ot.otr_codigo = d.otr_codigo) otr_identificador 
                    FROM 
                        detalleordentrabajo d 
                    WHERE
                        d.otr_codigo = $id";

            $resultado = $obj->consult($sql);
            if (mysqli_num_rows($resultado) > 0) {
                while($row = mysqli_fetch_assoc($resultado)) {
                    $result_array[]=$row;
                }
            }
            }else{
                $result_array[]=['vaProceso' => '0',
                                 'otr_codigo' => '0',
                                 'otr_identificador' => '0',];
            }

            echo json_encode($result_array);

        }
        if(isset($_POST['idenP'])){
            $idenP = $_POST['idenP'];

            if($idenP != ''){
                //Valida si existe proceso
                $sql = "SELECT COUNT(1) vaOrdenTrabajo
                            FROM ordentrabajo o 
                            WHERE
                            o.otr_identificador = $idenP";

                
                $resultado = $obj->consult($sql);
                if (mysqli_num_rows($resultado) > 0) {
                    while($row = mysqli_fetch_assoc($resultado)) {
                        $result_array[]=$row;
                    }
                }

                if($result_array[0]['vaProducto']>0){                
                //Valida si existe maquina asociada
                $sql = "SELECT count(1) vaProceso, 
                                (SELECT o.otr_codigo FROM ordentrabajo o WHERE o.otr_codigo = d.otr_codigo) otr_codigo, 
                                (SELECT ot.otr_identificador FROM ordentrabajo ot WHERE ot.otr_codigo = d.otr_codigo) otr_identificador 
                        FROM
                            detalleordentrabajo d,
                            ordentrabajo otr 
                        WHERE
                            otr.otr_codigo = d.otr_codigo
                            AND otr.otr_identificador = $idenP";
    
                $resultado = $obj->consult($sql);
                if (mysqli_num_rows($resultado) > 0) {
                    while($row = mysqli_fetch_assoc($resultado)) {
                        $result_array[]=$row;
                    }
                }

                }else{
                    $result_array[]=[ 'vaProceso' => '0',
                                      'otr_codigo' => '0',
                                      'otr_identificador' => '0',];
                }
    
                echo json_encode($result_array);
            }
        }
        

    }



}

?>