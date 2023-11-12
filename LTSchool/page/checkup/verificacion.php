<?php
session_start();

$host = "bpwy1dcsa1mcx5dsui0u-mysql.services.clever-cloud.com";
$user = "uzdw4zvdkutw5xtl";
$password = "g12r5yTL04okkU0RTAJ5";
$database = "bpwy1dcsa1mcx5dsui0u";

$conexion = mysqli_connect($host, $user, $password, $database);
if (!$conexion) {
    echo "No se realizó la conexión a la base de datos, el error fue:" . mysqli_connect_error();
} else {
    $username = $_POST["Matricula"];
    $password = $_POST["Contrasena"];

    $sql = "SELECT Matricula, Nombre, Contrasena
            FROM usuario
            WHERE Matricula = ? AND Contrasena = ?";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("is", $username, $password);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($matricula, $nombre, $contrasena);
        $stmt->fetch();
    
        $_SESSION['Matricula'] = $matricula;
        $_SESSION['Nombre'] = $nombre;
        header("Location: ../home.php");
        exit();
    } else {
        echo "Acceso denegado";
        header("Location: AccesoDenegado.php");
        exit();
    }
    
}
?>
