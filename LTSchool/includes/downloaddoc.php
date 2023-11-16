<?php
include "db.php";

$id = isset($_GET['Ruta']) ? $_GET['Ruta'] : null;

if (!is_numeric($id)) {
    die("echo <script language='JavaScript'>
    alert('Error');
    location.assign('../page/home.php');
    </script>;");
    
}

$sql0 = "SELECT ID_Doc, Archivo, Ruta FROM documentos WHERE ID_Doc = $id";
$result0 = mysqli_query($conexion, $sql0);

if (!$result0) {
    die("echo <script language='JavaScript'>
    alert('Error al obtener documento');
    location.assign('../page/home.php');
    </script>;");
}

$row = mysqli_fetch_assoc($result0);
$nombreArchivo = $row['Archivo'];
$pdfData = $row['Ruta'];

// Establecer las cabeceras para forzar la descarga del archivo
header('Content-Disposition: attachment; filename="' . $nombreArchivo . '"');

// Mostrar el contenido del PDF almacenado en el campo BLOB
echo $pdfData;

mysqli_close($conexion);
?>
