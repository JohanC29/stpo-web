<?php
require_once '../model/NotificacionModel.php';

class NotificacionController {

    public function consult(){
        include_once '../view/notificacion/consultar.php';
    }

   public function actividadUsuariosNotificacion(){
    $obj = new NotificacionModel();

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
                 x.fechaFormato,
                 x.hora,
                 x.cantidad
             FROM
                 actividadUsuario x
            ORDER BY fecha DESC";

     //
     $result = $obj->consult($sql);
     $html = '<div id="accordion">';

     $bg = array('bg-info','','bg-danger','bg-secondary','bg-success');

     //Fecha
     $auxFecha ="";

     foreach ($result as $r) {
        $fechaSinEspacios = str_replace(' ','',$r['fechaFormato']);
        // fecha
        $fecha = ucwords($r['fechaFormato']);

        if($auxFecha == '' ){
            $auxFecha = $r['fechaFormato'];
            $html.='<div class="card">
                    <div class="card-header" id="heading'.$fechaSinEspacios.'">
                        <h5 class="mb-0">
                            <button class="btn btn-light" data-toggle="collapse" data-target="#'.$fechaSinEspacios.'"
                                aria-expanded="true" aria-controls="'.$fechaSinEspacios.'">
                                '.$fecha.'<span class="caret"> </span>
                            </button>
                        </h5>
                    </div>

                    <div id="'.$fechaSinEspacios.'" class="collapse show" aria-labelledby="heading'.$fechaSinEspacios.'"
                        data-parent="#accordion">
                        <div class="card-body">';
        }else if($auxFecha != $r['fechaFormato']){
            $auxFecha = $r['fechaFormato'];

            // Se cierran los div que se abrieron
            $html.='</div>
                </div>
            </div>';

            // Se abre la nueva fecha
            $html.='<div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-light" data-toggle="collapse" data-target="#'.$fechaSinEspacios.'"
                                aria-expanded="true" aria-controls="'.$fechaSinEspacios.'">
                                '.$fecha.' <span class="caret"> </span>
                            </button>
                        </h5>
                    </div>

                    <div id="'.$fechaSinEspacios.'" class="collapse" aria-labelledby="headingOne"
                        data-parent="#accordion">
                        <div class="card-body">';

        }

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

     }

     // Se cierran los div que se abrieron
     $html.='   </div>
            </div>
        </div>
    </div>';

    
        echo $html;
   
     


}




    
}

?>