<?php
require_once '../model/empleadoModel.php';

class EmpleadoController {
    public function consult(){
        //$obj = new MaquinaModel();
        //$sql = "SELECT * FROM maquina";
        //$maquinas = $obj->consult($sql);
        include_once '../view/empleado/consultar.php';
    }

    public function insertar(){
        $obj = new EmpleadoModel();

        $id = $obj->autoIncrement('empleado','emp_codigo');
        $idenEmpleado = $_POST['idenEmpleado'];
        $nomEmpleado = strtoupper(trim($_POST['nomEmpleado']));
        $apeEmpleado = strtoupper(trim($_POST['apeEmpleado']));
        $carEmpleado = ucwords(strtolower(trim($_POST['carEmpleado'])));

        $sql="INSERT INTO `empleado` (`emp_codigo`,
                                        `emp_nombre`,
                                        `emp_apellido`,
                                        `emp_cedula`,
                                        `emp_cargo`,
                                        `est_codigo`)
              VALUES ($id, '$nomEmpleado', '$apeEmpleado', $idenEmpleado, '$carEmpleado', '1')";

        $ejecutar= $obj->insert($sql);
        if($ejecutar){
            echo 'Insercion exitosa';
        }else{
            echo $ejecutar;
            echo "Ocurrio un error creando la nueva maquina.";
        }
        
    }

    public function editar(){
        $obj = new EmpleadoModel();

        $id = $_POST['editCodigoEmpleado'];
        $editNomEmpleado = strtoupper(trim($_POST['editNomEmpleado']));
        $editApeEmpleado = strtoupper(trim($_POST['editApeEmpleado']));
        $editIdenEmpleado = $_POST['editIdenEmpleado'];
        $editCarEmpleado = ucwords(strtolower(trim($_POST['editCarEmpleado'])));

        $sql = "UPDATE `empleado` SET
                    `emp_nombre` = '$editNomEmpleado',
                    `emp_apellido` = '$editApeEmpleado',
                    `emp_cedula` = $editIdenEmpleado,
                    `emp_cargo` = '$editCarEmpleado'
                WHERE `emp_codigo` = $id";

        $ejecutar= $obj->insert($sql);
        if($ejecutar){
            echo 'Actualización exitosa';
        }else{
            echo $ejecutar;
            echo "Ocurrio un error creando la nueva maquina.";
        }
        
    }


    public function eliminar(){
        $obj = new EmpleadoModel();

        $id = $_POST['id'];
        $est_codigo = $_POST['est_codigo'];

        //Cambio de estado
        if($est_codigo == 1){

            $est_codigo = 2;
        }else{
            $est_codigo = 1;
        }

        $sql = "UPDATE `empleado` SET 
                `est_codigo` = $est_codigo
                WHERE 
                `empleado`.`emp_codigo` = $id";

        $ejecutar= $obj->insert($sql);
        if($ejecutar){
            echo 'Cambio de estado exitoso';
        }else{
            echo $ejecutar;
            echo "Ocurrio un error actualizando la maquina.";
        }
    }

    public function getTable(){
        $obj = new EmpleadoModel();
        
        $sql = "SELECT * FROM empleado m WHERE m.emp_codigo > 0 ORDER BY m.est_codigo ASC";
        $empleados = $obj->consult($sql);
        //$maquinasJSON = $obj->convertirJSON($sql);
        //echo getUrl("maquina","maquina","getTable",false,"ajax");
        //echo $maquinasJSON;

        $result_array = array();
        if (mysqli_num_rows($empleados) > 0) {
            $item_array = array();
            while($row = mysqli_fetch_assoc($empleados)) {
                $btnAcciones = "<div class='form-button-action'><button type='button' title='Editar' class='editar btn btn-link btn-primary btn-lg' data-original-title='Editar'  data-toggle='modal' data-target='#editarEmpleadoModal' ><i class='fa fa-edit'></i></button>";
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