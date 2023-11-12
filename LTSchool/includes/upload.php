<?php
session_start();
$_SESSION['Matricula'];
include 'db.php';

if (isset($_FILES['Archivo'])) {
    extract($_POST);
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['ID_Itrccs'];

    $nombreArchivo = $_FILES["Archivo"]["name"];
    $ext = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
    
    if (strtolower($ext) !== 'pdf') {
        echo "<script language='JavaScript'>
            alert('El archivo debe ser un PDF.');
            location.assign('../page/home.php');
            </script>";
    } else {
    $pdfData = file_get_contents($_FILES["Archivo"]["tmp_name"]);
        

        if (isset($_SESSION['Matricula']) && is_numeric($_SESSION['Matricula'])) {
            $matricula = (int)$_SESSION['Matricula']; 

            $sql2 = "INSERT INTO calificaciones (Calificacion) VALUES ('0')";
            $resultado3 = mysqli_query($conexion, $sql2);
            $idnewcali = mysqli_insert_id($conexion);
    
    
            $fecha_actual = date("Y-m-d");
            date_default_timezone_set('America/Mexico_City');
            $hora_actual = date("H:i:s");

            
            $sql1 = "INSERT INTO tareas (Archivo, Rutas, Fecha, Tiempo, ID_Itrccs, ID_Cali, ID_Status) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $statement1 = $conexion->prepare($sql1);
    
            $ID_Status = '1';
            $statement1->bind_param("ssssiii", $nombre, $pdfData, $fecha_actual, $hora_actual, $descripcion, $idnewcali, $ID_Status);
            $resultado3 = mysqli_query($conexion, $sql2);
            if ($statement1->execute()) {
                $idnewtarea = mysqli_insert_id($conexion);
            } else {
                echo "Error: " . $statement1->error;
            }    
        
            $sql3 = "INSERT INTO conexion_T_C (ID_Tarea, ID_Matricula) VALUES (?, ?)";
            $statement2 = $conexion->prepare($sql3);
        
            if ($statement2) {
                $statement2->bind_param("ii", $idnewtarea, $matricula);
                
                 if ($statement2->execute()) {
                    if ($resultado3) {
                        echo "<script language='JavaScript'>
                            alert('Archivo Subido');
                            location.assign('../page/home.php');
                            </script>";
                    } else {
                        echo "<script language='JavaScript'>
                            alert('Error al insertar el archivo en la tabla de tareas.');
                            location.assign('../page/home.php');
                            </script>";
                    }

                    $statement2->close();
                    $statement1->close();
                    $conexion->close();
            } else {
                echo "Error al preparar la consulta statement2: " . $conexion->error;
            }
        } else {
            echo "Error: El valor de Matricula no es válido o no está definido.";
        }
        
    }
    } 
} else {
    echo "<script language='JavaScript'>
        alert('No se ha cargado un archivo.');
        location.assign('../page/home.php');
        </script>";
}


?>
