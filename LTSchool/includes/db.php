<?php

    $host = "bpwy1dcsa1mcx5dsui0u-mysql.services.clever-cloud.com";
    $user = "uzdw4zvdkutw5xtl";
    $password = "g12r5yTL04okkU0RTAJ5";
    $database = "bpwy1dcsa1mcx5dsui0u";

    $conexion = mysqli_connect($host, $user, $password, $database);
    if(!$conexion){
        echo "No se realizo la conexion a la basa de datos, el error fue:".
        mysqli_connect_error() ;
        header("Location: home.php");
        exit();
    }

?>