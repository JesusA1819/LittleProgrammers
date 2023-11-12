
<div class="modal fade" id="agregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h3 class="modal-title" id="exampleModalLabel">Agregar tarea</h3>
                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>

            <?php 
            $servername = "lps1819.mariadb.database.azure.com";
   $username = "JesusAlonso@lps1819";
   $password = "Alonsogomez1819";
   $database = "lpstec";

   $conn = mysqli_connect($servername, $username, $password, $database);
            if (!$conexion) {
                die("Error al conectar a la base de datos: " . mysqli_connect_error());
                echo "Fallo de conexion vuelva despues";
                header("Location: home.php");
                exit();
            }
            $matricula = $_SESSION['Matricula'];

            $query = "SELECT DISTINCT i.ID_Itrccs, i.Titulo
                      FROM instrucciones i
                      LEFT JOIN tareas t ON i.ID_Itrccs = t.ID_Itrccs
                      LEFT JOIN conexion_T_C c ON t.ID_Tarea = c.ID_Tarea AND c.ID_Matricula = ?
                      WHERE c.ID_Matricula IS NULL AND (i.ID_Stt = 1 OR i.ID_Stt = 3)";
                        
            $statement = $conexion->prepare($query);
            
            if ($statement) {
                $statement->bind_param("i", $matricula);
                $statement->execute();
                $resultado = $statement->get_result();
                
                if ($resultado) {
                } else {
                    die("Error al ejecutar la consulta: " . $conexion->error);
                }
            } else {
                die("Error al preparar la consulta: " . $conexion->error);
            }
            
            if ($statement) {
                $statement->bind_param("i", $matricula);
                $statement->execute();
                $resultado = $statement->get_result();
                
                if ($resultado) {
                } else {
                    die("Error al ejecutar la consulta: " . $conexion->error);
                }
            } else {
                die("Error al preparar la consulta: " . $conexion->error);
            }

            ?>

            <div class="modal-body">

                <form action="../includes/upload.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="ID_Itrccs" name="ID_Itrccs" value="">
 

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Titulo</label>
                                <input type="text" id="nombre" name="nombre" class="form-control" required>

                            </div>
                        </div>
                   </div>
                    
                    <div class="col-12">
                        <label for="yourPassword" class="form-label">Archivo PDF</label>
                        <input type="file" name="Archivo" id="Archivo" class="form-control" required accept=".pdf">
                    </div>

                    <br>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-disabled" id="register" name="registrar" disabled>Guardar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>


                <script>
                document.addEventListener("DOMContentLoaded", function () {
                var nombreInput = document.getElementById("nombre");
                var archivoInput = document.getElementById("Archivo");
                var guardarButton = document.getElementById("register");

                function validarCampos() {
                    var nombreValor = nombreInput.value.trim();
                    var archivoValor = archivoInput.value.trim();

                    if (nombreValor !== "" && archivoValor !== "") {
                        guardarButton.removeAttribute("disabled");
                    } else {
                        guardarButton.setAttribute("disabled", "disabled");
                    }
                }

                nombreInput.addEventListener("input", validarCampos);
                archivoInput.addEventListener("input", validarCampos);

                validarCampos();
                    });
                </script>
        <Style>

        .btn-disabled {
            background-color: #999; 
            cursor: not-allowed; 
        }

        </Style>
    </div>
</div>
