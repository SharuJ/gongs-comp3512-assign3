<?php
    
    //error_reporting(E_ALL);
    ini_set('display_errors', '1');

    define("DBHOST", "");
    define("DBNAME", "book");
    define("DBUSER", "stephenjohnson");
    define("DBPASS", "");
    define("DBCONNSTRING", "mysql:dbname=book;charset=utf8mb4");
    define('DBCONNECTION', "mysql:dbname=book");
    
    spl_autoload_register(function ($class) {
    $file = 'classes/' . $class . '.php';
    if(file_exists($file))
        include $file;
    });

    $connection = DatabaseHelper::createConnectionInfo(array(DBCONNECTION, DBUSER, DBPASS));
    
?>