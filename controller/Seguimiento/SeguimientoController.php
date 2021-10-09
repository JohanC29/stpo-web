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
        $sql = 'select (  select count(1) from empleado e where e.est_codigo = 1  ) usuario, ( select count(s.emp_codigo) from seguimiento s where s.est_codigo = 3  ) usuario_activo from dual';
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
        $sql = 'SELECT ( select count(1) from ordentrabajo ot where ot.est_codigo = 1  ) valor_max, ( select count(1) from (select count(1) from seguimiento s1  GROUP BY s1.otr_codigo) s  ) valor from dual';
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
        $sql = 'SELECT ( select count(1) from maquina m where m.est_codigo = 1  ) valor_max,
        (select count(1) from (
              SELECT dp.* from seguimiento s1, detalleprocesomaquina dp 
                WHERE
                s1.dpm_codigo = dp.dpm_codigo
                GROUP by dp.maq_codigo
              ) s  
        ) valor from dual';
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
}

?>