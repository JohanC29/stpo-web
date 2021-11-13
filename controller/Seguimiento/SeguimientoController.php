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

		// Circles.create({
		// 	id: "circles-3",
		// 	radius: 45,
		// 	value: 40,
		// 	maxValue: 100,
		// 	width: 7,
		// 	text: 12,
		// 	colors: ["#f1f1f1", "#F25961"],
		// 	duration: 400,
		// 	wrpClass: "circles-wrp",
		// 	textClass: "circles-text",
		// 	styleWrapper: true,
		// 	styleText: true,
		// });

        // Cantidad de usuarios
        // Usuarios con seguimiento solo iniciado
        // 

        /*
        SELECT ( select count(1) from maquina m where m.est_codigo = 1  ) valor_max,

( 
  
  select count(1) from (
      SELECT dp.* from seguimiento s1, detalleprocesomaquina dp 
        WHERE
        s1.dpm_codigo = dp.dpm_codigo
        GROUP by dp.maq_codigo
      ) s  

) valor from dual
        */
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
                select 1 mes, count(1) cantidad from subcategoria sub, producto prod, ordentrabajo otr, seguimiento s where sub.sub_codigo = prod.sub_codigo and prod.prod_codigo = otr.prod_codigo and sub.cat_codigo = ".$arrCategoria[$i]['id']."   and fnu_getCantFalSegxOtr(otr.otr_codigo) = 0 and otr.est_codigo = 1 and s.otr_codigo = otr.otr_codigo and EXTRACT(MONTH FROM s.seg_fechaFinal) = 1

union all
select 2 mes, count(1) cantidad from subcategoria sub, producto prod, ordentrabajo otr, seguimiento s where sub.sub_codigo = prod.sub_codigo and prod.prod_codigo = otr.prod_codigo and sub.cat_codigo = ".$arrCategoria[$i]['id']."   and fnu_getCantFalSegxOtr(otr.otr_codigo) = 0 and otr.est_codigo = 1 and s.otr_codigo = otr.otr_codigo and EXTRACT(MONTH FROM s.seg_fechaFinal) = 2

union all
select 3 mes, count(1) cantidad from subcategoria sub, producto prod, ordentrabajo otr, seguimiento s where sub.sub_codigo = prod.sub_codigo and prod.prod_codigo = otr.prod_codigo and sub.cat_codigo = ".$arrCategoria[$i]['id']."   and fnu_getCantFalSegxOtr(otr.otr_codigo) = 0 and otr.est_codigo = 1 and s.otr_codigo = otr.otr_codigo and EXTRACT(MONTH FROM s.seg_fechaFinal) = 3

union all
select 4 mes, count(1) cantidad from subcategoria sub, producto prod, ordentrabajo otr, seguimiento s where sub.sub_codigo = prod.sub_codigo and prod.prod_codigo = otr.prod_codigo and sub.cat_codigo = ".$arrCategoria[$i]['id']."   and fnu_getCantFalSegxOtr(otr.otr_codigo) = 0 and otr.est_codigo = 1 and s.otr_codigo = otr.otr_codigo and EXTRACT(MONTH FROM s.seg_fechaFinal) = 4

union all
select 5 mes, count(1) cantidad from subcategoria sub, producto prod, ordentrabajo otr, seguimiento s where sub.sub_codigo = prod.sub_codigo and prod.prod_codigo = otr.prod_codigo and sub.cat_codigo = ".$arrCategoria[$i]['id']."   and fnu_getCantFalSegxOtr(otr.otr_codigo) = 0 and otr.est_codigo = 1 and s.otr_codigo = otr.otr_codigo and EXTRACT(MONTH FROM s.seg_fechaFinal) = 5

union all
select 6 mes, count(1) cantidad from subcategoria sub, producto prod, ordentrabajo otr, seguimiento s where sub.sub_codigo = prod.sub_codigo and prod.prod_codigo = otr.prod_codigo and sub.cat_codigo = ".$arrCategoria[$i]['id']."   and fnu_getCantFalSegxOtr(otr.otr_codigo) = 0 and otr.est_codigo = 1 and s.otr_codigo = otr.otr_codigo and EXTRACT(MONTH FROM s.seg_fechaFinal) = 6

union all
select 7 mes, count(1) cantidad from subcategoria sub, producto prod, ordentrabajo otr, seguimiento s where sub.sub_codigo = prod.sub_codigo and prod.prod_codigo = otr.prod_codigo and sub.cat_codigo = ".$arrCategoria[$i]['id']."   and fnu_getCantFalSegxOtr(otr.otr_codigo) = 0 and otr.est_codigo = 1 and s.otr_codigo = otr.otr_codigo and EXTRACT(MONTH FROM s.seg_fechaFinal) = 7

union all
select 8 mes, count(1) cantidad from subcategoria sub, producto prod, ordentrabajo otr, seguimiento s where sub.sub_codigo = prod.sub_codigo and prod.prod_codigo = otr.prod_codigo and sub.cat_codigo = ".$arrCategoria[$i]['id']."   and fnu_getCantFalSegxOtr(otr.otr_codigo) = 0 and otr.est_codigo = 1 and s.otr_codigo = otr.otr_codigo and EXTRACT(MONTH FROM s.seg_fechaFinal) = 8

union all
select 9 mes, count(1) cantidad from subcategoria sub, producto prod, ordentrabajo otr, seguimiento s where sub.sub_codigo = prod.sub_codigo and prod.prod_codigo = otr.prod_codigo and sub.cat_codigo = ".$arrCategoria[$i]['id']."   and fnu_getCantFalSegxOtr(otr.otr_codigo) = 0 and otr.est_codigo = 1 and s.otr_codigo = otr.otr_codigo and EXTRACT(MONTH FROM s.seg_fechaFinal) = 9

union all
select 10 mes, count(1) cantidad from subcategoria sub, producto prod, ordentrabajo otr, seguimiento s where sub.sub_codigo = prod.sub_codigo and prod.prod_codigo = otr.prod_codigo and sub.cat_codigo = ".$arrCategoria[$i]['id']."   and fnu_getCantFalSegxOtr(otr.otr_codigo) = 0 and otr.est_codigo = 1 and s.otr_codigo = otr.otr_codigo and EXTRACT(MONTH FROM s.seg_fechaFinal) = 10

union all
select 11 mes, count(1) cantidad from subcategoria sub, producto prod, ordentrabajo otr, seguimiento s where sub.sub_codigo = prod.sub_codigo and prod.prod_codigo = otr.prod_codigo and sub.cat_codigo = ".$arrCategoria[$i]['id']."   and fnu_getCantFalSegxOtr(otr.otr_codigo) = 0 and otr.est_codigo = 1 and s.otr_codigo = otr.otr_codigo and EXTRACT(MONTH FROM s.seg_fechaFinal) = 11

union all
select 12 mes, count(1) cantidad from subcategoria sub, producto prod, ordentrabajo otr, seguimiento s where sub.sub_codigo = prod.sub_codigo and prod.prod_codigo = otr.prod_codigo and sub.cat_codigo = ".$arrCategoria[$i]['id']."   and fnu_getCantFalSegxOtr(otr.otr_codigo) = 0 and otr.est_codigo = 1 and s.otr_codigo = otr.otr_codigo and EXTRACT(MONTH FROM s.seg_fechaFinal) = 12) w ORDER BY mes ASC         
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




    
}

?>