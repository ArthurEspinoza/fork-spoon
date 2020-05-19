<?php 
    session_start();
    if(isset($_SESSION['numT'])){
        unset($_SESSION['numT']);
    }
    session_destroy();
    header("Location: ../front/login.php");
    exit;
?>