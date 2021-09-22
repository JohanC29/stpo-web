<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>STPO - Web</title>
    <link rel="shortcut icon" href="../assets_metalPlast/img/icon.svg" type="image/x-icon">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!--Hoja de estilos-->
    <link rel="StyleSheet" href="css/estiloLogin.css">
    
    <!---Tipo de letra-->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">

    <!--Iconos Fontawsome-->
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    
</head>
<body>
    <!-- <img src="Vista/imagen/1.fonoLogin.jpg" alt="Fondo" class="fondo"> -->
    <!-- <img src="Vista/imagen/wave.png" alt="Fondo" class="fondo"> -->
    <img src="../assets_metalPlast/img/1.png" alt="Fondo" class="fondo">

    
    <div class="contenedor">
        <div class="img">
            <!-- <img src="Vista/imagen/3.computerLogin.svg" alt="Computer" class="img"> -->
            <img src="../assets_metalPlast/img/logo-100px.png" alt="Computer" class="img">
        </div>
        <div class="login-container">
            <form action="<?php echo getUrl("login","login","login")?>" method="POST">
                <img src="../assets_metalPlast/img/4.avatarLogin.svg" alt="Avatar" class="avatar">
                <h2>Bienvenido</h2>
                <!-- Alerta -->
                <?php
                if(isset($_SESSION['errorLogin'])){
                ?>
                <div class="alert alert-danger" id="alert" role="alert">
                    
                    <?php
                    
                    echo $_SESSION['errorLogin'];
                    unset($_SESSION['errorLogin']);
                    ?>
                </div>
                <?php
                }
                ?>
                <!--Contenedor input nombre de Usuario-->
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div>
                        <h5>Usuario</h5>
                        <input type="text" class="input" name="username" required>
                    </div>
                </div>

                <!--- Contenedor input contraseña -->
                <div class="input-div two">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div>
                        <h5>Contraseña</h5>
                        <input type="password" class="input" name="password" required>
                    </div>
                </div>

                <a href="#">Recuperar contraseña</a>
                <input type="submit" class="btn" value="ingresar">
            </form>
        </div>
    </div>


    <script type="text/javascript" src="js/mainLogin.js"></script>
</body>
</html>