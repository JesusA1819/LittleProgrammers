<?php
include "db.php";

$id = isset($_GET['Ruta_archivo']) ? $_GET['Ruta_archivo'] : null;

if (!is_numeric($id)) {
    die("ID no válido");
}

$sql0 = "SELECT ID_Cali FROM tareas WHERE ID_Tarea = $id";
$result0 = mysqli_query($conexion, $sql0);

if (!$result0) {
    die("Error al obtener el ID de calificación: " . mysqli_error($conexion));
}

$row = mysqli_fetch_assoc($result0);
$IDCali = $row['ID_Cali'];

$sqlCheckCalificacion = "SELECT Calificacion FROM calificaciones WHERE ID_Cali = $IDCali";
$resultCheckCalificacion = mysqli_query($conexion, $sqlCheckCalificacion);

if (!$resultCheckCalificacion) {
    die("Error al verificar la calificación: " . mysqli_error($conexion));
}

$rowCalificacion = mysqli_fetch_assoc($resultCheckCalificacion);
$calificacion = $rowCalificacion['Calificacion'];

if ($calificacion == 0) {
    $sql2 = "DELETE FROM conexion_T_C WHERE ID_Tarea = $id";
    $sql3 = "DELETE FROM tareas WHERE ID_Tarea = $id";
    $sql1 = "DELETE FROM calificaciones WHERE ID_Cali = $IDCali";

    if (
        mysqli_query($conexion, $sql2) &&
        mysqli_query($conexion, $sql3) &&
        mysqli_query($conexion, $sql1)
    ) {
        echo "Registros eliminados correctamente.";
        header("Location: ../page/home.php");
    } else {
        echo "Error al eliminar registros: " . mysqli_error($conexion);
        header("Location: ../page/index.html");
    }
} else {
    echo "No se pueden eliminar tareas con calificaciones diferentes de 0";
    header("Location: ../page/home.php");

}

mysqli_close($conexion);
?>
