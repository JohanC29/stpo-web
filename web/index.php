<?php

    include_once '../lib/helpers.php';
    include_once '../lib/helpersLogin.php';
    include_once '../view/partials/header.php';
    
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
    include_once '../view/partials/footer.php';
    echo "</body>";
    echo "</html>";
?>