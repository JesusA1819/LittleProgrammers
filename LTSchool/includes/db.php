<?php

    $servername = "lps1819.mariadb.database.azure.com";
   $username = "JesusAlonso@lps1819";
   $password = "Alonsogomez1819";
   $database = "lpstec";

   $conn = mysqli_connect($servername, $username, $password, $database);
    if(!$conexion){
        echo "No se realizo la conexion a la basa de datos, el error fue:".
        mysqli_connect_error() ;
        header("Location: home.php");
        exit();
    }

?>
