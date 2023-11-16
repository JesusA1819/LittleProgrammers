<?php
include "db.php";

$id = isset($_GET['Ruta_archivo']) ? $_GET['Ruta_archivo'] : null;

if (!is_numeric($id)) {
   die("echo <script language='JavaScript'>
   alert('Error de id');
   location.assign('../page/home.php');
   </script>;");
}

$sql0 = "SELECT ID_Cali FROM tareas WHERE ID_Tarea = $id";
$result0 = mysqli_query($conexion, $sql0);

if (!$result0) {
  die("echo <script language='JavaScript'>
   alert('Error');
   location.assign('../page/home.php');
   </script>;");
}

$row = mysqli_fetch_assoc($result0);
$IDCali = $row['ID_Cali'];

$sqlCheckCalificacion = "SELECT Calificacion FROM calificaciones WHERE ID_Cali = $IDCali";
$resultCheckCalificacion = mysqli_query($conexion, $sqlCheckCalificacion);

if (!$resultCheckCalificacion) {
   echo "<script language='JavaScript'>
   alert('Error al obtener calificacion');
   location.assign('../page/home.php');
   </script>";
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
      echo "<script language='JavaScript'>
      alert('Tarea eliminada correctamente.');
      location.assign('../page/home.php');
      </script>";    
    } else {
      echo "<script language='JavaScript'>
      alert('Error al eliminar la tarea.');
      location.assign('../page/home.php');
      </script>";
    }
} else {
   echo "<script language='JavaScript'>
   alert('No se pueden elimar tareas ya calificadas');
   location.assign('../page/home.php');
   </script>";
}

mysqli_close($conexion);
?>
