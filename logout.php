<?php 
    session_start();
    unset($_SESSION);
    session_destroy();
    print_r($_SESSION) ;
    header('Location: login.php');
?>