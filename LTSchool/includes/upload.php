<?php
session_start();
$_SESSION['Matricula'];
include 'db.php';

if (isset($_FILES['Archivo'])) {
    extract($_POST);
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['ID_Itrccs'];

    $nombreArchivo = $_FILES["Archivo"]["name"];
    $ext = pathinfo($_FILES['Archivo']['name'], PATHINFO_EXTENSION);

    // Obtener el tipo MIME del archivo
    $tipo_mime = $_FILES['Archivo']['type'];

    // Verificar si la extensión es 'pdf' y el tipo MIME es 'application/pdf'
    if (strtolower($ext) !== 'pdf' || $tipo_mime !== 'application/pdf') {
        echo "<script language='JavaScript'>
                alert('El archivo debe ser un PDF.');
                location.assign('../page/home.php');
                </script>";
    } else {
        $rutaArchivo = $_FILES["Archivo"]["tmp_name"];

        $primerosBytes = file_get_contents($rutaArchivo, false, null, 0, 5);

        if (substr($primerosBytes, 0, 5) === '%PDF-') {
            $imageMagickPath = '/usr/bin/convert'; 
           $outputImagePath = 'imagen.png'; 
            
            $command = $imageMagickPath . " -density 300 \"$rutaArchivo\"[0] \"$outputImagePath\"";
            exec($command);
            if (file_exists($outputImagePath)) {
                unlink($outputImagePath);

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
                        echo "<script language='JavaScript'>
                        alert('Error');
                        location.assign('../page/home.php');
                        </script>";
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
                                    alert('Error al subir tarea.');
                                    location.assign('../page/home.php');
                                    </script>";
                            }
        
                            $statement2->close();
                            $statement1->close();
                            $conexion->close();
                    } else {
                        echo "<script language='JavaScript'>
                        alert('Error en el proceso');
                        location.assign('../page/home.php');
                        </script>";
                        
                    }
                } else {
                    echo "<script language='JavaScript'>
                    alert('Error en el proceso');
                    location.assign('../page/home.php');
                    </script>";
                }
            }
            } else {
                // La conversión falló, el archivo PDF podría ser problemático
                echo "<script language='JavaScript'>
                    alert('Error al procesar el archivo PDF.');
                    location.assign('../page/home.php');
                    </script>";
            }

        } else {
            // Los primeros bytes no coinciden con '%PDF-'
            echo "<script language='JavaScript'>
                alert('El archivo no parece ser un PDF válido.');
                location.assign('../page/home.php');
                </script>";
        }
    }
}
?>
