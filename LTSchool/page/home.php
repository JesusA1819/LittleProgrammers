<?php
session_start();

if (!isset($_SESSION['Matricula'])) {
    header("Location: index.html");
    exit; 
}
$matricula = $_SESSION['Matricula'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITSP · Subir Tareas</title>
     
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/estilos.css">

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    
               <!----------------------------------------------------------------------- Separador ---------------------------------------------------------------->
    <script>
        $(document).ready(function() {
        // Al hacer clic en el botón de tareas, mostrar u ocultar el contenido de tareas
        $(".toggle-tasks1").click(function() {
            $(".tareas-container").slideToggle();
            $(".document-container").hide();
        });

        // Al hacer clic en el botón de instrucciones, mostrar u ocultar el contenido de instrucciones
        $(".toggle-instructions1").click(function() {
            $(".document-container").slideToggle();
            $(".tareas-container").hide();
        });
    });

        $(document).ready(function () {
            $(".instruccion-container").hide();

            $(".toggle-tasks").click(function () {
                var container = $(this).next(".instruccion-container");
                
                $(".instruccion-container").not(container).slideUp();
                
                container.slideToggle();
            });

            $(".agregar-tarea").click(function () {
                var idInstruccion = $(this).data("id-instruccion");
                $("#ID_Itrccs").val(idInstruccion);
            });
        });

    $(document).ready(function () {
        $(".agregar-tarea").click(function () {
            var idInstruccion = $(this).data("id-instruccion");
            $("#ID_Itrccs").val(idInstruccion);
            
        });
    });
    </script>
    
                    <!----------------------------------------------------------------------- Separador ---------------------------------------------------------------->
        </head>
        <body>
        <div class="container">
            
                    <!----------------------------------------------------------------------- Separador ---------------------------------------------------------------->
            <div class="col-sm-12">
                <h2 class="mt-5 mb-4" style="text-align: center;">Subir Archivos PDF</h2>
                <div class="s">
                    <h4>Matrícula: <?php echo $_SESSION['Matricula'];?></h4>
                    <h4>Nombre: <?php echo $_SESSION['Nombre'];?></h4>
                    <button type="button" class="btn btn-danger"><a href="index.html"> Cerrar Sesión</a></button>
                </div>
                
                    <!----------------------------------------------------------------------- Separador ---------------------------------------------------------------->
                <button class="toggle-tasks1 btn btn-primary">
                    <i class="fas fa-chevron-down"></i> Tareas
                    </button>
                    <button class="toggle-instructions1 btn btn-primary">
                        <i class="fas fa-chevron-down"></i> Documentos
                    </button>
                    
                    <!----------------------------------------------------------------------- Separador ---------------------------------------------------------------->
                    <?php
        $documentosMostrados = false; // Variable para controlar la tabla de documentos
        require_once "../includes/db.php";
        $matricula = $_SESSION['Matricula'];

        $query_instrucciones = "SELECT DISTINCT i.ID_Itrccs, i.Titulo
                            FROM instrucciones i
                            LEFT JOIN tareas t ON i.ID_Itrccs = t.ID_Itrccs
                            LEFT JOIN conexion_T_C c ON t.ID_Tarea = c.ID_Tarea AND c.ID_Matricula = ?
                            WHERE (i.ID_Stt = '1')";
        $statement_instrucciones = $conexion->prepare($query_instrucciones);

        if ($statement_instrucciones) {
            $statement_instrucciones->bind_param("i", $matricula);
            $statement_instrucciones->execute();
            $resultado_instrucciones = $statement_instrucciones->get_result();

            while ($fila_instrucciones = mysqli_fetch_assoc($resultado_instrucciones)) {
                $id_instruccion = $fila_instrucciones['ID_Itrccs'];
                $titulo_instruccion = $fila_instrucciones['Titulo'];
                $num_tareas = 0; 
                $query_contar_tareas = "SELECT COUNT(*) AS num_tareas FROM tareas t
                                    LEFT JOIN conexion_T_C c ON t.ID_Tarea = c.ID_Tarea
                                    WHERE t.ID_Itrccs = ? AND c.ID_Matricula = ?";
                $statement_contar_tareas = $conexion->prepare($query_contar_tareas);

                if ($statement_contar_tareas) {
                    $statement_contar_tareas->bind_param("ii", $id_instruccion, $matricula);
                    $statement_contar_tareas->execute();
                    $resultado_contar_tareas = $statement_contar_tareas->get_result();

                    if ($resultado_contar_tareas && $fila_contar_tareas = $resultado_contar_tareas->fetch_assoc()) {
                        $num_tareas = $fila_contar_tareas['num_tareas'];
                    }
                }
                ?>
                <div class="mt-4">
                <div class="tareas-container" style="display: none;">
                    <h3>Tarea: <?php echo $titulo_instruccion; ?></h3>
                        <button class="toggle-tasks btn btn-primary">
                            <i class="fas fa-chevron-down"></i> Mostrar tareas
                        </button>
            
                        <div class="instruccion-container" style="display: none;">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Titulo</th>
                                        <th>Descripcion</th>
                                        <th>Calificacion</th>
                                        <th>Fecha de entrega</th>
                                        <th>Hora de entrega</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead> 
                                <tbody>
                                    <?php
                                    $query_tareas = "SELECT u.*, t.*, f.*, e.*, i.* FROM usuario u
                                                    INNER JOIN conexion_T_C t ON u.Matricula = t.ID_Matricula
                                                    INNER JOIN tareas f ON t.ID_Tarea = f.ID_Tarea
                                                    INNER JOIN calificaciones e ON f.ID_Cali = e.ID_Cali
                                                    INNER JOIN instrucciones i ON f.ID_Itrccs = i.ID_Itrccs
                                                    WHERE u.Matricula = ? AND i.ID_Itrccs = ?";
                                    $statement_tareas = $conexion->prepare($query_tareas);

                                    if ($statement_tareas) {
                                        $statement_tareas->bind_param("ii", $matricula, $id_instruccion);
                                        $statement_tareas->execute();
                                        $resultado_tareas = $statement_tareas->get_result();

                                        while ($fila_tareas = mysqli_fetch_assoc($resultado_tareas)) {
                                    ?>
                                            <tr>
                                                <td><?php echo $fila_tareas['Archivo']; ?></td>
                                                <td><?php echo $fila_tareas['Instruccion']; ?></td>
                                                <td><?php echo $fila_tareas['Calificacion']; ?></td>
                                                <td><?php echo $fila_tareas['Fecha']; ?></td>
                                                <td><?php echo $fila_tareas['Tiempo']; ?></td>
                                                <td>
                                                    <?php 
                                                    $calificacion = $fila_tareas['Calificacion'];
                                                    if ($calificacion > 0) {
                                                        echo '<button class="btn btn-danger" disabled>Eliminar</button>';
                                                    } else {
                                                        echo '<a href="../includes/deleted.php?Ruta_archivo=' . $fila_tareas['ID_Tarea'] . '" class="btn btn-danger">Eliminar</a>';
                                                    }
                                                    ?>
                                                </td>
                                                <td><a href="../includes/download.php?Ruta_archivo=<?php echo $fila_tareas['ID_Tarea']; ?>" class="btn btn-success">Descargar</a></td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                        <div class="bn-container">
                                    <?php if ($num_tareas == 0) { ?>
                                    <button type="button" class="btn btn-success px-3 mb-4 agregar-tarea" 
                                        data-toggle="modal" data-target="#agregar"
                                        data-id-instruccion="<?php echo $id_instruccion; ?>">
                                        Agregar
                                    </button>
                                    <?php } else { ?>
                                    
                                    <?php } ?>
                                </div>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php
                }
            }
            ?>
            <div class="document-container" style="display: <?php echo $documentosMostrados ? 'none' : 'block'; ?>">
                <!-- Contenido de documentos -->
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Titulo</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead> 
                    <tbody>
                        <?php
                        $query_documentos = "SELECT * FROM documentos";
                        $statement_documentos = $conexion->prepare($query_documentos);

                        if ($statement_documentos) {
                            $statement_documentos->execute();
                            $resultado_documentos = $statement_documentos->get_result();

                            while ($fila_doc = mysqli_fetch_assoc($resultado_documentos)) {
                        ?>
                        <tr>
                            <td><?php echo $fila_doc['Archivo']; ?></td>
                            <td><a href="../includes/downloaddoc.php?Ruta=<?php echo $fila_doc['ID_Doc']; ?>" class="btn btn-success">Descargar</a></td>
                        </tr>
                        <?php
                            }
                            $documentosMostrados = true; // Marcamos que la tabla de documentos ha sido mostrada
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </body>
        <?php include "agregar.php"; ?>
        <style>
            a {
                text-decoration: none;
            }
            .toggle-tasks {
                background-color: #007bff;
                color: #fff;
                border: none;
                padding: 5px 10px;
                cursor: pointer;
            }

            .toggle-tasks:hover {
                background-color: #0056b3;
            }

            .toggle-tasks i {
                margin-right: 5px;
            }

            .instruccion-container {
                display: none;
            }
        </style>


        </html>
