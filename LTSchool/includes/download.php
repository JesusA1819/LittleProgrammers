<?php
include "db.php";

$id = isset($_GET['Ruta_archivo']) ? $_GET['Ruta_archivo'] : null;

if (!is_numeric($id)) {
    die("ID no válido");
}

$sql0 = "SELECT ID_Cali, Archivo, Rutas FROM tareas WHERE ID_Tarea = $id";
$result0 = mysqli_query($conexion, $sql0);

if (!$result0) {
    die("Error al obtener la tarea: " . mysqli_error($conexion));
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
