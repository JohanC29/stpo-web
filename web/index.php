<?php
    include_once '../lib/helpers.php';
    include_once '../lib/helpersLogin.php';
    
    include_once '../view/partials/header.php';
    
    // loading
    include_once '../view/partials/loading.php';
    
    include_once '../view/partials/navbar.php';
    include_once '../view/partials/sidebar.php';
        echo "<div class='main-panel'>";
            echo "<div class='content'>";
                if (isset($_GET['modulo'])) {
                    resolve();
                }else{
                    include_once '../view/partials/home.php';
                }
            echo "</div>";
        echo "</div>";

    include_once '../view/partials/modal.php';
    
    echo "</body>";
    include_once '../view/partials/footer.php';
    include_once '../view/partials/importJs.php';
    if (!isset($_GET['modulo'])) {
        include_once '../view/partials/charImport.php';
    }else if(ucwords($_GET['modulo'])=='Notificacion'){
        echo '<script src="js/notificacion.js"></script>';
    }else if(ucwords($_GET['modulo'])=='Seguimiento'){
        echo '<script src="js/seguimiento.js"></script>';
    }
    echo "</html>";
?>