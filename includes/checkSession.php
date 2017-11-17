<?php
    //echo 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    session_start();
    if (!isset($_SESSION['email']))
    {
        header('Location: login.php?name=https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    }
?>