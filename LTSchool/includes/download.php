<?php
include "db.php";

$id = isset($_GET['Ruta_archivo']) ? $_GET['Ruta_archivo'] : null;

if (!is_numeric($id)) {
    die("echo <script language='JavaScript'>
    alert('Error de id');
    location.assign('../page/home.php');
    </script>;");
}

$sql0 = "SELECT ID_Cali, Archivo, Rutas FROM tareas WHERE ID_Tarea = $id";
$result0 = mysqli_query($conexion, $sql0);

if (!$result0) {
    die("echo <script language='JavaScript'>
    alert('Error al obtener tarea');
    location.assign('../page/home.php');
    </script>;");
}

$row = mysqli_fetch_assoc($result0);
$IDCali = $row['ID_Cali'];
$nombreArchivo = $row['Archivo'];
$pdfData = $row['Rutas'];

// Establecer las cabeceras para forzar la descarga del archivo
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="' . $nombreArchivo . '.pdf"');

// Mostrar el contenido del PDF almacenado en el campo BLOB
echo $pdfData;

mysqli_close($conexion);
?>
