<?php

$connection = null;

try{
    //config
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "login-register-coba-fitcheck";

    //conect
    $database = "mysql:dbname=$dbname;host=$host";
    $connection = new PDO($database, $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // if($connection){
    //     echo "Berhasil";
    // }else{
    //     echo "Gagal";
    // }

}   CATCH (PDOException $e){
    echo "Error !". $e->getMessage();
    die;
}

?>