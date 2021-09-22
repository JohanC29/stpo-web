<?php

require_once '../model/Login/LoginModel.php';

class LoginController {

    public function validar($user,$password){
        
        /*
        $obj = new LoginModel();
        $sql = "SELECT usu_nombre FROM usuario WHERE '".$user."'=usu_user AND '".$password."' = usu_password";
        $resultado = $obj->consult($sql);
        $row = $resultado->num_rows;
        
        if($row > 0 ){
            foreach($resultado as $res){
                $_SESSION['user'] = $res['usu_nombre'];
            }
        }else{
            $_SESSION['errorLogin'] = "Usuario y/o Contraseña invalida. <br> Por favor vuelva a intentar.";
            
        }
        */
        echo "<script type='text/javascript'>"."window.location.href='index.php'"."</script>";
        

    }

    public function login(){

        $username = $_POST['username'];
        $password = $_POST['password'];
        if($username == "admin"){
            $_SESSION['auth']="ok";
        }else{
            $_SESSION['errorLogin'] = "Usuario y/o Contraseña invalida. <br> Por favor vuelva a intentar.";
        }
        redirect("index.php");
    }

    public function logout(){
        session_destroy();
        echo "<script type='text/javascript'>"."window.location.href='index.php'"."</script>";
    }
}
?>