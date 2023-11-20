<?php
session_start();

    $servername = "lps1819.mariadb.database.azure.com";
    $username = "JesusAlonso@lps1819";
    $password = "Alonsogomez1819";
    $database = "lpstec";
    
    $conexion = mysqli_connect($servername, $username, $password, $database);
if (!$conexion) {
   echo "<script language='JavaScript'>
   alert('Error de conexion.');
   location.assign('../page/index.html');
   </script>";
   exit();
} else {
    $username = $_POST["Matricula"];
    $password = $_POST["Contrasena"];

    $sql = "SELECT Matricula, Nombre, Contrasena, ID_Estado
            FROM usuario
            WHERE Matricula = ? AND Contrasena = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("is", $username, $password);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($matricula, $nombre, $contrasena, $id_estado);
        $stmt->fetch();

        if ($id_estado == 1) {
            $_SESSION['Matricula'] = $matricula;
            $_SESSION['Nombre'] = $nombre;
            header("Location: ../home.php");
            exit();
        } else {
            echo "<script language='JavaScript'>
            alert('Matricula inhabilitada');
            location.assign('AccesoDenegado.php');
            </script>";
        }
    } else {
        echo "<script language='JavaScript'>
        
        alert('Datos no coinciden');
        location.assign('AccesoDenegado.php');
        </script>";
    }
}




?>
