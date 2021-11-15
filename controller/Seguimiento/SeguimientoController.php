<?php
require_once '../model/ordentrabajoModel.php';

class SeguimientoController {

    public function cir_usuarios(){
        $obj = new OrdenTrabajoModel();
        $result_array = array();

        // $result_array = [
        //     id => "circles-1",
        //     radius => 45,
        //     value => 60,
        //     maxValue => 100,
        //     width => 7,
        //     text => 5,
        //     colors => ["#f1f1f1", "#FF9E27"],
        //     duration => 400,
        //     wrpClass => "circles-wrp",
        //     textClass => "circles-text",
        //     styleWrapper => true,
        //     styleText => true,
        // ];

        // Cantidad de usuarios
        // Usuarios con seguimiento solo iniciado
        // 
        $sql = 'select (  select count(1) from empleado e where e.est_codigo = 1  ) usuario, 
        fnu_getCantUsuNow() usuario_activo from dual';
        $seguimiento = $obj->consult($sql);

        $usuario = 0;
        $usuario_activo = 0;

        foreach ($seguimiento as $s){
            $usuario = $s['usuario'];
            $usuario_activo = $s['usuario_activo'];
        }

        $result_array = [
            'id' => "circles-1",
            'radius' => 45,
            'value' => $usuario_activo,
            'maxValue' => $usuario,
            'width' => 7,
            'text' => $usuario_activo,
            'colors' => ["#f1f1f1", "#FF9E27"],
            'duration' => 400,
            'wrpClass' => "circles-wrp",
            'textClass' => "circles-text",
            'styleWrapper' => true,
            'styleText' => true,
        ];
        
        echo json_encode($result_array);
    }


    public function cir_orden_sistema(){
        $obj = new OrdenTrabajoModel();
        $result_array = array();

		// Circles.create({
		// 	id: "circles-2",
		// 	radius: 45,
		// 	value: 70,
		// 	maxValue: 100,
		// 	width: 7,
		// 	text: 36,
		// 	colors: ["#f1f1f1", "#2BB930"],
		// 	duration: 400,
		// 	wrpClass: "circles-wrp",
		// 	textClass: "circles-text",
		// 	styleWrapper: true,
		// 	styleText: true,
		// });

        // Cantidad de usuarios
        // Usuarios con seguimiento solo iniciado
        // 
        $sql = 'SELECT 
        100 valor_max,
        ( select sum(a.valor) from (SELECT 
               case  
                 when fnu_getCantFalSegxOtr(ot.otr_codigo) > 0 then 1
                 else 0
                 end valor
            FROM
                ordentrabajo ot
                where ot.est_codigo = 1) a
            ) valor
    FROM DUAL';
        $seguimiento = $obj->consult($sql);

        $valor = 0;
        $max_valor = 0;

        foreach ($seguimiento as $s){
            $max_valor = $s['valor_max'];
            $valor = $s['valor'];
        }

        $result_array = [
            'id' => "circles-2",
            'radius' => 45,
            'value' => $valor,
            'maxValue' => $max_valor,
            'width' => 7,
            'text' => $valor,
            'colors' => ["#f1f1f1", "#2BB930"],
            'duration' => 400,
            'wrpClass' => "circles-wrp",
            'textClass' => "circles-text",
            'styleWrapper' => true,
            'styleText' => true,
        ];
        
        echo json_encode($result_array);
    }


    public function cir_maq(){
        $obj = new OrdenTrabajoModel();
        $result_array = array();

        $sql = 'SELECT 
        (SELECT 
                COUNT(1)
            FROM
                maquina m
            WHERE
                m.est_codigo = 1) valor_max,
        (SELECT 
                COUNT(1)
            FROM
                (SELECT 
                    dp.maq_codigo
                FROM
                    seguimiento s, detalleprocesomaquina dp
                WHERE
                    s.dpm_codigo = dp.dpm_codigo
                        AND s.est_codigo = 3
                GROUP BY dp.maq_codigo) a) valor
        FROM DUAL';
        $seguimiento = $obj->consult($sql);

        $valor = 0;
        $max_valor = 0;

        foreach ($seguimiento as $s){
            $max_valor = $s['valor_max'];
            $valor = $s['valor'];
        }

        $result_array = [
            'id' => "circles-3",
            'radius' => 45,
            'value' => $valor,
            'maxValue' => $max_valor,
            'width' => 7,
            'text' => $valor,
            'colors' => ["#f1f1f1", "#F25961"],
            'duration' => 400,
            'wrpClass' => "circles-wrp",
            'textClass' => "circles-text",
            'styleWrapper' => true,
            'styleText' => true,
        ];
        
        echo json_encode($result_array);
    }

   public function historialOt(){
       $obj = new OrdenTrabajoModel();

       // realizar consulta obtener todas las categorias 
       
       $sql = "SELECT ca.cat_codigo, ca.cat_descripcion 
                from categoria ca 
               where ca.est_codigo = 1 
                and ca.cat_codigo > 0";
        $resultCategoria = $obj->consult($sql);
        
        $arrCategoria = array();
        $i=0;
        foreach ($resultCategoria as $r){
            array_push($arrCategoria,array('id'          => $r['cat_codigo'],
                                           'descripcion' => $r['cat_descripcion']));
            //$i++;
        }

        //echo $arrCategoria[0]['id'];
        $arrayDetalle = array();

        for ($i=0; $i < count($arrCategoria) ; $i++) { 
            // Consulta de detalle por mes.
            $sql = "SELECT mes, cantidad from (
                select 1 mes, count(1) cantidad from subcategoria sub, producto prod, ordentrabajo otr, seguimiento s where sub.sub_codigo = prod.sub_codigo and prod.prod_codigo = otr.prod_codigo and sub.cat_codigo = ".$arrCategoria[$i]['id']." /* Codigo categoria */ and fnu_getCantFalSegxOtr(otr.otr_codigo) = 0 and otr.est_codigo = 1 and s.otr_codigo = otr.otr_codigo and EXTRACT(MONTH FROM s.seg_fechaFinal) = 1 and s.seg_codigo = (select max(se.seg_codigo) from seguimiento se where se.otr_codigo = otr.otr_codigo)

        union all
        select 2 mes, count(1) cantidad from subcategoria sub, producto prod, ordentrabajo otr, seguimiento s where sub.sub_codigo = prod.sub_codigo and prod.prod_codigo = otr.prod_codigo and sub.cat_codigo = ".$arrCategoria[$i]['id']." /* Codigo categoria */ and fnu_getCantFalSegxOtr(otr.otr_codigo) = 0 and otr.est_codigo = 1 and s.otr_codigo = otr.otr_codigo and EXTRACT(MONTH FROM s.seg_fechaFinal) = 2 and s.seg_codigo = (select max(se.seg_codigo) from seguimiento se where se.otr_codigo = otr.otr_codigo)

        union all
        select 3 mes, count(1) cantidad from subcategoria sub, producto prod, ordentrabajo otr, seguimiento s where sub.sub_codigo = prod.sub_codigo and prod.prod_codigo = otr.prod_codigo and sub.cat_codigo = ".$arrCategoria[$i]['id']." /* Codigo categoria */ and fnu_getCantFalSegxOtr(otr.otr_codigo) = 0 and otr.est_codigo = 1 and s.otr_codigo = otr.otr_codigo and EXTRACT(MONTH FROM s.seg_fechaFinal) = 3 and s.seg_codigo = (select max(se.seg_codigo) from seguimiento se where se.otr_codigo = otr.otr_codigo)

        union all
        select 4 mes, count(1) cantidad from subcategoria sub, producto prod, ordentrabajo otr, seguimiento s where sub.sub_codigo = prod.sub_codigo and prod.prod_codigo = otr.prod_codigo and sub.cat_codigo = ".$arrCategoria[$i]['id']." /* Codigo categoria */ and fnu_getCantFalSegxOtr(otr.otr_codigo) = 0 and otr.est_codigo = 1 and s.otr_codigo = otr.otr_codigo and EXTRACT(MONTH FROM s.seg_fechaFinal) = 4 and s.seg_codigo = (select max(se.seg_codigo) from seguimiento se where se.otr_codigo = otr.otr_codigo)

        union all
        select 5 mes, count(1) cantidad from subcategoria sub, producto prod, ordentrabajo otr, seguimiento s where sub.sub_codigo = prod.sub_codigo and prod.prod_codigo = otr.prod_codigo and sub.cat_codigo = ".$arrCategoria[$i]['id']." /* Codigo categoria */ and fnu_getCantFalSegxOtr(otr.otr_codigo) = 0 and otr.est_codigo = 1 and s.otr_codigo = otr.otr_codigo and EXTRACT(MONTH FROM s.seg_fechaFinal) = 5 and s.seg_codigo = (select max(se.seg_codigo) from seguimiento se where se.otr_codigo = otr.otr_codigo)

        union all
        select 6 mes, count(1) cantidad from subcategoria sub, producto prod, ordentrabajo otr, seguimiento s where sub.sub_codigo = prod.sub_codigo and prod.prod_codigo = otr.prod_codigo and sub.cat_codigo = ".$arrCategoria[$i]['id']." /* Codigo categoria */ and fnu_getCantFalSegxOtr(otr.otr_codigo) = 0 and otr.est_codigo = 1 and s.otr_codigo = otr.otr_codigo and EXTRACT(MONTH FROM s.seg_fechaFinal) = 6 and s.seg_codigo = (select max(se.seg_codigo) from seguimiento se where se.otr_codigo = otr.otr_codigo)

        union all
        select 7 mes, count(1) cantidad from subcategoria sub, producto prod, ordentrabajo otr, seguimiento s where sub.sub_codigo = prod.sub_codigo and prod.prod_codigo = otr.prod_codigo and sub.cat_codigo = ".$arrCategoria[$i]['id']." /* Codigo categoria */ and fnu_getCantFalSegxOtr(otr.otr_codigo) = 0 and otr.est_codigo = 1 and s.otr_codigo = otr.otr_codigo and EXTRACT(MONTH FROM s.seg_fechaFinal) = 7 and s.seg_codigo = (select max(se.seg_codigo) from seguimiento se where se.otr_codigo = otr.otr_codigo)

        union all
        select 8 mes, count(1) cantidad from subcategoria sub, producto prod, ordentrabajo otr, seguimiento s where sub.sub_codigo = prod.sub_codigo and prod.prod_codigo = otr.prod_codigo and sub.cat_codigo = ".$arrCategoria[$i]['id']." /* Codigo categoria */ and fnu_getCantFalSegxOtr(otr.otr_codigo) = 0 and otr.est_codigo = 1 and s.otr_codigo = otr.otr_codigo and EXTRACT(MONTH FROM s.seg_fechaFinal) = 8 and s.seg_codigo = (select max(se.seg_codigo) from seguimiento se where se.otr_codigo = otr.otr_codigo)

        union all
        select 9 mes, count(1) cantidad from subcategoria sub, producto prod, ordentrabajo otr, seguimiento s where sub.sub_codigo = prod.sub_codigo and prod.prod_codigo = otr.prod_codigo and sub.cat_codigo = ".$arrCategoria[$i]['id']." /* Codigo categoria */ and fnu_getCantFalSegxOtr(otr.otr_codigo) = 0 and otr.est_codigo = 1 and s.otr_codigo = otr.otr_codigo and EXTRACT(MONTH FROM s.seg_fechaFinal) = 9 and s.seg_codigo = (select max(se.seg_codigo) from seguimiento se where se.otr_codigo = otr.otr_codigo)

        union all
        select 10 mes, count(1) cantidad from subcategoria sub, producto prod, ordentrabajo otr, seguimiento s where sub.sub_codigo = prod.sub_codigo and prod.prod_codigo = otr.prod_codigo and sub.cat_codigo = ".$arrCategoria[$i]['id']." /* Codigo categoria */ and fnu_getCantFalSegxOtr(otr.otr_codigo) = 0 and otr.est_codigo = 1 and s.otr_codigo = otr.otr_codigo and EXTRACT(MONTH FROM s.seg_fechaFinal) = 10 and s.seg_codigo = (select max(se.seg_codigo) from seguimiento se where se.otr_codigo = otr.otr_codigo)

        union all
        select 11 mes, count(1) cantidad from subcategoria sub, producto prod, ordentrabajo otr, seguimiento s where sub.sub_codigo = prod.sub_codigo and prod.prod_codigo = otr.prod_codigo and sub.cat_codigo = ".$arrCategoria[$i]['id']." /* Codigo categoria */ and fnu_getCantFalSegxOtr(otr.otr_codigo) = 0 and otr.est_codigo = 1 and s.otr_codigo = otr.otr_codigo and EXTRACT(MONTH FROM s.seg_fechaFinal) = 11 and s.seg_codigo = (select max(se.seg_codigo) from seguimiento se where se.otr_codigo = otr.otr_codigo)

        union all
        select 12 mes, count(1) cantidad from subcategoria sub, producto prod, ordentrabajo otr, seguimiento s where sub.sub_codigo = prod.sub_codigo and prod.prod_codigo = otr.prod_codigo and sub.cat_codigo = ".$arrCategoria[$i]['id']." /* Codigo categoria */ and fnu_getCantFalSegxOtr(otr.otr_codigo) = 0 and otr.est_codigo = 1 and s.otr_codigo = otr.otr_codigo and EXTRACT(MONTH FROM s.seg_fechaFinal) = 12 and s.seg_codigo = (select max(se.seg_codigo) from seguimiento se where se.otr_codigo = otr.otr_codigo)


            ) w ORDER BY mes ASC         
            ";
            //echo $sql;
            $resultDetalle = $obj->consult($sql);

            $auxArrayDetalle = array();
            foreach ($resultDetalle as $rd) {
                array_push($auxArrayDetalle,$rd['cantidad']);
            }

            array_push($arrayDetalle,$auxArrayDetalle);
        }

        $color = array('#f3545d','#fdaf4b','#177dff','#f3545d','#fdaf4b','#177dff','#f3545d','#fdaf4b','#177dff','#f3545d','#fdaf4b','#177dff','#f3545d','#fdaf4b','#177dff');
        $colorBackPoint = array('rgba(243, 84, 93, 0.6)','rgba(253, 175, 75, 0.6)','rgba(23, 125, 255, 0.6)','rgba(243, 84, 93, 0.6)','rgba(253, 175, 75, 0.6)','rgba(23, 125, 255, 0.6)','rgba(243, 84, 93, 0.6)','rgba(253, 175, 75, 0.6)','rgba(23, 125, 255, 0.6)');
        $colorBackColor = array('rgba(243, 84, 93, 0.4)','rgba(253, 175, 75, 0.4)','rgba(23, 125, 255, 0.4)','rgba(243, 84, 93, 0.4)','rgba(253, 175, 75, 0.4)','rgba(23, 125, 255, 0.4)','rgba(243, 84, 93, 0.4)','rgba(253, 175, 75, 0.4)','rgba(23, 125, 255, 0.4)');


        $result_array = array();
        for ($i=0; $i < count($arrCategoria) ; $i++) { 
            array_push($result_array,array(
                
                'label' => $arrCategoria[$i]['descripcion'],
                'borderColor' => $color[$i],
                'pointBackgroundColor' => $colorBackPoint[$i],
                'pointRadius' => 0,
                'backgroundColor' => $colorBackColor[$i],
                'legendColor' => $color[$i],
                'fill' => true,
                'borderWidth' => 2,
                'data' => $arrayDetalle[$i]
            ));

        }

        echo json_encode($result_array);

   }

   public function semanaOt(){
    $obj = new OrdenTrabajoModel();

    // Cantidad de dias de la semana a mostrar
    $cantDia = 7;

    $sql = "SELECT dia, cantidad from (";

    for ($i=0; $i < $cantDia; $i++) { 
        $sql.= "SELECT  fva_getDia( ( DATE_SUB(NOW_COL(),INTERVAL $i DAY) ) ) dia
                    ,COUNT(1) cantidad, $i orden
                FROM  ordentrabajo otr, seguimiento s
                WHERE FNU_GETCANTFALSEGXOTR(otr.otr_codigo) = 0
                AND otr.est_codigo = 1
                AND s.otr_codigo = otr.otr_codigo
                AND DATE_FORMAT(s.seg_fechaInicio, '%Y-%m-%d') = DATE_FORMAT( DATE_SUB(NOW_COL(), INTERVAL $i DAY),'%Y-%m-%d')
                AND s.seg_codigo = (select max(se.seg_codigo) from seguimiento se where se.otr_codigo = otr.otr_codigo)
                ";
        
        if ( ($i+1) < $cantDia) {
            $sql.=" UNION ALL 
                    ";
        }
    }
    $sql.=") x ORDER BY orden desc";

    $result = $obj->consult($sql);

    $arrLabel = array();
    $arrayDetalle = array();
    $sumTotalOt = 0;
    foreach ($result as $r){

    array_push($arrLabel,$r['dia']);
    array_push($arrayDetalle,$r['cantidad']);
    $sumTotalOt+=$r['cantidad'];

    }

    


    $arrResultado = array( $arrLabel,$arrayDetalle,$sumTotalOt );

    echo json_encode($arrResultado);



   }


   public function actividadUsuario(){
       $obj = new OrdenTrabajoModel();

       // Select Para traer todas las actividades de los usuario en la tabla 
       // seguimiento
       $sql = "SELECT 
                    x.codigoEstado,
                    x.estado,
                    x.seg_codigo,
                    x.emp_nombre,
                    x.emp_apellido,
                    x.pro_nombre,
                    x.maq_nombre,
                    x.otr_identificador,
                    x.fecha,
                    x.hora,
                    x.cantidad
                FROM
                    actividadUsuario x
                WHERE
                    date_format(x.fecha,'%d-%m-%y') = date_format(now_col(),'%d-%m-%y')
                ORDER BY fecha DESC";

        //
        $result = $obj->consult($sql);
        $html = "";

        $bg = array('bg-info','','bg-danger','bg-secondary','bg-success');
        // $j = 0;
        foreach ($result as $r) {

            $logo = substr($r['emp_nombre'],0,1).substr($r['emp_apellido'],0,1);
            $nombreApellido =$r['emp_nombre'].' '.$r['emp_apellido'];
            $Ot = $r['otr_identificador'];
            
            //validacion del color del estado
            $estado = $r['estado'];
            $codigoEstado = $r['codigoEstado'];
            if($codigoEstado == 1){
                $estadoCompleto = '<span class="text-success pl-3">'.$estado.'</span>';

                // Concatenamos la descripcion
                $descripcion = 'Ot '.$Ot.'. Proceso '.$r['pro_nombre'].'. maquinaria
                            '.$r['maq_nombre'].'.';
            }else{
                $estadoCompleto = '<span class="text-warning pl-3">'.$estado.'</span>';

                // Concatenamos la descripcion
                $descripcion = 'Ot '.$Ot.'. Cantidad '.$r['cantidad'].' proceso '.$r['pro_nombre'].'. maquinaria
                            '.$r['maq_nombre'].'.';
            }

            // hora
            $hora = $r['hora'];

            // Concatenamos el hmtl que se va a aplicar
            $html.='
            <div class="d-flex">
                <div class="avatar ">
                    <span class="avatar-title rounded-circle border border-white '.$bg[random_int(0,(count($bg)-1))].'">'.$logo.'</span>
                </div>
                <div class="flex-1 ml-3 pt-1">
                    <h6 class="text-uppercase fw-bold mb-1">
                        '.$nombreApellido.'
                        '.$estadoCompleto.'
                    </h6>
                    <span class="text-muted">'.$descripcion.'</span>
                </div>
                <div class="float-right pt-1">
                    <small class="text-muted">'.$hora.'</small>
                </div>
            </div>
            <div class="separator-dashed"></div>
            ';
            // if ($j == 3) {
            //     $j = 0 ;
            // }else{
            //     $j++;
            // }
        }
        // for ($i=0; $i < 10; $i++) { 
            echo $html;
        // }
        


   }


   public function actividadUsuariosNotificacion(){
    $obj = new OrdenTrabajoModel();

    // Select Para traer todas las actividades de los usuario en la tabla 
    // seguimiento
    $sql = "SELECT 
                 x.codigoEstado,
                 x.estado,
                 x.seg_codigo,
                 x.emp_nombre,
                 x.emp_apellido,
                 x.pro_nombre,
                 x.maq_nombre,
                 x.otr_identificador,
                 x.fecha,
                 x.hora,
                 x.cantidad
             FROM
                 actividadUsuario x
            ORDER BY fecha DESC";

     //
     $result = $obj->consult($sql);
     $html = "";

     $bg = array('bg-info','','bg-danger','bg-secondary','bg-success');
     // $j = 0;
     foreach ($result as $r) {

         $logo = substr($r['emp_nombre'],0,1).substr($r['emp_apellido'],0,1);
         $nombreApellido =$r['emp_nombre'].' '.$r['emp_apellido'];
         $Ot = $r['otr_identificador'];
         
         //validacion del color del estado
         $estado = $r['estado'];
         $codigoEstado = $r['codigoEstado'];
         if($codigoEstado == 1){
             $estadoCompleto = '<span class="text-success pl-3">'.$estado.'</span>';

             // Concatenamos la descripcion
             $descripcion = 'Ot '.$Ot.'. Proceso '.$r['pro_nombre'].'. maquinaria
                         '.$r['maq_nombre'].'.';
         }else{
             $estadoCompleto = '<span class="text-warning pl-3">'.$estado.'</span>';

             // Concatenamos la descripcion
             $descripcion = 'Ot '.$Ot.'. Cantidad '.$r['cantidad'].' proceso '.$r['pro_nombre'].'. maquinaria
                         '.$r['maq_nombre'].'.';
         }

         // hora
         $hora = $r['hora'];

         // Concatenamos el hmtl que se va a aplicar
         $html.='
         <div class="d-flex">
             <div class="avatar ">
                 <span class="avatar-title rounded-circle border border-white '.$bg[random_int(0,(count($bg)-1))].'">'.$logo.'</span>
             </div>
             <div class="flex-1 ml-3 pt-1">
                 <h6 class="text-uppercase fw-bold mb-1">
                     '.$nombreApellido.'
                     '.$estadoCompleto.'
                 </h6>
                 <span class="text-muted">'.$descripcion.'</span>
             </div>
             <div class="float-right pt-1">
                 <small class="text-muted">'.$hora.'</small>
             </div>
         </div>
         <div class="separator-dashed"></div>
         ';
         // if ($j == 3) {
         //     $j = 0 ;
         // }else{
         //     $j++;
         // }
     }
     // for ($i=0; $i < 10; $i++) { 
         echo $html;
     // }
     


  }

  public function actividadOrdenTrabajo(){
    $obj = new OrdenTrabajoModel();

    // Select Para traer todas las actividades de los usuario en la tabla 
    // seguimiento
    $sql = "SELECT 
                 x.codigoEstado,
                 x.estado,
                 x.seg_codigo,
                 x.emp_nombre,
                 x.emp_apellido,
                 x.pro_nombre,
                 x.maq_nombre,
                 x.otr_identificador,
                 x.fecha,
                 x.hora,
                 x.cantidad
             FROM
                 actividadUsuario x
             WHERE
                 date_format(x.fecha,'%d-%m-%y') = date_format(now_col(),'%d-%m-%y')
             ORDER BY fecha DESC";

     //
     $result = $obj->consult($sql);
     $html = "";

     $bg = array('bg-info','','bg-danger','bg-secondary','bg-success');
     // $j = 0;
     foreach ($result as $r) {

         $logo = substr($r['emp_nombre'],0,1).substr($r['emp_apellido'],0,1);
         $nombreApellido =$r['emp_nombre'].' '.$r['emp_apellido'];
         $Ot = $r['otr_identificador'];
         
         //validacion del color del estado
         $estado = $r['estado'];
         $codigoEstado = $r['codigoEstado'];
         if($codigoEstado == 1){
             $estadoCompleto = '<span class="text-success pl-3">'.$estado.'</span>';

             // Concatenamos la descripcion
             $descripcion = 'Ot '.$Ot.'. Proceso '.$r['pro_nombre'].'. maquinaria
                         '.$r['maq_nombre'].'.';
         }else{
             $estadoCompleto = '<span class="text-warning pl-3">'.$estado.'</span>';

             // Concatenamos la descripcion
             $descripcion = 'Ot '.$Ot.'. Cantidad '.$r['cantidad'].' proceso '.$r['pro_nombre'].'. maquinaria
                         '.$r['maq_nombre'].'.';
         }

         // hora
         $hora = $r['hora'];

         // Concatenamos el hmtl que se va a aplicar
         $html.='
         <div class="d-flex">
             <div class="avatar ">
                 <span class="avatar-title rounded-circle border border-white '.$bg[random_int(0,(count($bg)-1))].'">'.$logo.'</span>
             </div>
             <div class="flex-1 ml-3 pt-1">
                 <h6 class="text-uppercase fw-bold mb-1">
                     '.$nombreApellido.'
                     '.$estadoCompleto.'
                 </h6>
                 <span class="text-muted">'.$descripcion.'</span>
             </div>
             <div class="float-right pt-1">
                 <small class="text-muted">'.$hora.'</small>
             </div>
         </div>
         <div class="separator-dashed"></div>
         ';
         // if ($j == 3) {
         //     $j = 0 ;
         // }else{
         //     $j++;
         // }
     }
     // for ($i=0; $i < 10; $i++) { 
         echo $html;
     // }
     


    }
  
//
  public function consult(){
    include_once '../view/seguimiento/consultar.php';
  }


  public function getTable(){
    $obj = new OrdenTrabajoModel();

    $sql = "SELECT 
    s.seg_codigo,
    e.emp_codigo,
    e.emp_nombre,
    e.emp_apellido,
    p.pro_codigo,
    p.pro_nombre,
    m.maq_codigo,
    m.maq_nombre,
    otr.otr_identificador,
    prod.prod_codigo,
    prod.prod_descripcion,
    s.seg_fechaInicio,
    s.seg_fechaFinal,
    s.seg_tiempoEjecucion,
    s.seg_cantidad,
    est.est_descripcion
    from 
    seguimiento s,
    empleado e,
    detalleprocesomaquina dpm,
    ordentrabajo otr,
    producto prod,
    proceso p,
    maquina m,
    estado est
    where
    s.emp_codigo = e.emp_codigo
    and s.dpm_codigo = dpm.dpm_codigo
    and dpm.maq_codigo = m.maq_codigo
    and dpm.pro_codigo = p.pro_codigo
    and s.otr_codigo = otr.otr_codigo
    and otr.prod_codigo = prod.prod_codigo
    and s.est_codigo = est.est_codigo";

    $seguimiento = $obj->consult($sql);

    $result_array = array();    
    if (mysqli_num_rows($seguimiento) > 0) {
        $item_array = array();
        while($row = mysqli_fetch_assoc($seguimiento)) {
            $result_array[]=$row;
        }
        echo json_encode($result_array);                
    }

  }


    





}

?>