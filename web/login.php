<?php
include_once '../lib/helpers.php';
//esta condicion es para que no nos deje volver al login cuando ya iniciamos sesion
// if (isset($_SESSION['auth'])&&($_SESSION['auth'] == 'ok')) {
//     redirect('index.php');
// }

include_once '../view/login/login.php';

?>
