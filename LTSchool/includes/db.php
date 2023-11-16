<?php

   $servername = "lps1819.mariadb.database.azure.com";
   $username = "JesusAlonso@lps1819";
   $password = "Alonsogomez1819";
   $database = "lpstec";

   $conexion = mysqli_connect($servername, $username, $password, $database);
    if(!$conexion){
        echo "<script language='JavaScript'>
        alert('Error de conexion.');
        location.assign('../page/index.html');
        </script>";
        exit();
    }

?>
