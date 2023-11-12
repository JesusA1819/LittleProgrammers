   <?php
   $servername = "lps1819.mariadb.database.azure.com";
   $username = "JesusAlonso@lps1819";
   $password = "Alonsogomez1819";
   $database = "lpstec";

   $conn = mysqli_connect($servername, $username, $password, $database);

   if (!$conn) {
      die("La conexión a la base de datos falló: " . mysqli_connect_error());
   }

   if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $nombre = $_POST["nombre"];
      $apellidoPaterno = $_POST["apellido_paterno"];
      $apellidoMaterno = $_POST["apellido_materno"];
      $telefono = $_POST["telefono"];
      $edad = $_POST["edad"];
      $correoElectronico = $_POST["correo_electronico"];
      $contrasena = $_POST["contrasena"];
      $matricula = $_POST["matricula"];
      $semestre = $_POST["semestre"];
      $carrera = $_POST["carrera"];

   
      $query = "SELECT Matricula FROM usuario WHERE Matricula = '$matricula'";

      $resultado = mysqli_query($conn, $query);
      if ($resultado === false) {
         echo '<script>alert("La matricula no se puede comprobar");</script>';
      }
            
      if (mysqli_num_rows($resultado) > 0) {
         echo '<script>alert("La matrícula ya fue utilizada");</script>';

      } 
      else 
      {

         //-------------------------- consulta para ver si el celular ya existe

         $query = "SELECT Telefono FROM telefono WHERE Telefono = '$telefono'";
         $resultado = mysqli_query($conn, $query);
         if ($resultado === false) {
            echo '<script>alert("El telefono no se pudo comprobar");</script>';
         }
               
            if (mysqli_num_rows($resultado) > 0) {
               echo '<script>alert("El telefono ya fue utilizado");</script>';
            } 
            
            else {

                     //-------------------------- consulta para ver si el correo ya existe

               $query = "SELECT Correo_electronico FROM correos WHERE Correo_electronico = '$correoElectronico'";
               $resultado = mysqli_query($conn, $query);
               if ($resultado === false) {
                  echo '<script>alert("El correo no se pudo comprobar");</script>';
               }
                     
               if (mysqli_num_rows($resultado) > 0) {
                  echo '<script>alert("El correo ya fue utilizado");</script>';
               } else {

               $sqlTelefono = "INSERT INTO telefono (Telefono) VALUES (?)"; 
               $stmtTelefono = mysqli_prepare($conn, $sqlTelefono);
               if ($stmtTelefono) {
                  mysqli_stmt_bind_param($stmtTelefono, "s", $telefono);
                  mysqli_stmt_execute($stmtTelefono);
                  $idTelefono = mysqli_insert_id($conn);
               } else {
                  echo '<script>alert("El telefono no se pudo comprobar");</script>';
               }

               $sqlCorreo = "INSERT INTO correos (Correo_electronico) VALUES (?)"; 
               $stmtCorreo = mysqli_prepare($conn, $sqlCorreo);
               if ($stmtCorreo) {
                  mysqli_stmt_bind_param($stmtCorreo, "s", $correoElectronico);
                  mysqli_stmt_execute($stmtCorreo);
                  $idCorreo = mysqli_insert_id($conn);
               } else {
                  echo '<script>alert("El correo no se pudo comprobar");</script>';
               }

               if (isset($matricula, $nombre, $apellidoPaterno, $apellidoMaterno, $idTelefono, $idCorreo, $semestre, $carrera, $contrasena, $edad)) {
               $sqlUsuario = "INSERT INTO usuario (Matricula, Nombre, Apellido_P, Apellido_M, ID_Cel, ID_Email, ID_Sem, ID_Car, Contrasena, Edad) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
               $stmtUsuario = mysqli_prepare($conn, $sqlUsuario);

                  if ($stmtUsuario) {
                     mysqli_stmt_bind_param($stmtUsuario, "ssssiiiisi", $matricula, $nombre, $apellidoPaterno, $apellidoMaterno, $idTelefono, $idCorreo, $semestre, $carrera, $contrasena, $edad);
                     if (mysqli_stmt_execute($stmtUsuario)) {
                        mysqli_close($conn);
                        header("Location: exito.php");
                        exit();
                     } else {
                        echo '<script>alert("El usuario no se pudo comprobar");</script>';
                     }
                  } else {
                        echo '<script>alert("El usuario no se puede agregar");</script>';
                  }
               } else {
               echo '<script>alert("algun campo no tiene valor ingresado");</script>';
               }
                     
            }
         }
      }
   }
   ?>

   <!DOCTYPE html>
   <html lang="es">

   <head>
      <!-- Inclusion del head -->
      <?php include 'controller/head.php';?>
      <title>Register · LTSchool</title>

      <script> // Validacion de campos
         function soloTexto(event) {
            const input = event.target;
            const valor = input.value;
            input.value = valor.replace(/[^A-Za-záéíóúÁÉÍÓÚ\s]/g, '');
         }
         function soloNumeros(event) {
            const input = event.target;
            const valor = input.value;
            input.value = valor.replace(/[^0-9]/g, ''); 
         }

         let avisoMostrado = false;

         function minimo8(valor, input) {
            if (valor.length < 8 && !avisoMostrado) {
               alert('La matrícula debe contener al menos 8 dígitos numéricos');
               avisoMostrado = true;
               input.focus(); 
            } else {
               avisoMostrado = false; 
            }
         }

         

         let avisoMostrado2 = false;

         function minimo10(valor, input) {
            if (valor.length < 10 && !avisoMostrado2) {
               alert('El telefono debe contener al menos 10 dígitos numéricos');
               avisoMostrado2 = true; 
               input.focus(); 
            } else {
               avisoMostrado2 = false; 
            }
         }

         // Verificacion de campos completos
         function validarFormulario(input) {
            var matriculaInput = document.querySelector('input[name="matricula"]');
            var nombreInput = document.querySelector('input[name="nombre"]');
            var apellidopInput = document.querySelector('input[name="apellido_paterno"]');
            var apellidomInput = document.querySelector('input[name="apellido_materno"]');
            var telefonoInput = document.querySelector('input[name="telefono"]');
            var edadInput = document.querySelector('input[name="edad"]');
            var correoInput = document.querySelector('input[name="correo_electronico"]');
            var contrasenaInput = document.querySelector('input[name="contrasena"]');
            var semestreSelect = document.querySelector('select[name="semestre"]');
            var carreraSelect = document.querySelector('select[name="carrera"]');
            var botonGuardar = document.querySelector('button[name="registrar"]');

            var matriculaValor = matriculaInput.value.trim();
            var nombreValor = nombreInput.value.trim();
            var apellidopValor = apellidopInput.value.trim();
            var apellidomValor = apellidomInput.value.trim();
            var telefonoValor = telefonoInput.value.trim();
            var edadValor = edadInput.value.trim();
            var correoValor = correoInput.value.trim();
            var contrasenaValor = contrasenaInput.value.trim();
            var semestreValor = semestreSelect.value;
            var carreraValor = carreraSelect.value;

            // Si los campos no son iguales a Null se quitara el disabled del botón "Guardar datos"
            if (matriculaValor !== "" && nombreValor !== "" && apellidopValor !== "" && apellidomValor !== "" && telefonoValor !== "" && edadValor !== "" && correoValor !== "" && contrasenaValor !== "" && semestreValor !== "" && carreraValor !== "" && validarCorreo(correoInput)) {
                botonGuardar.removeAttribute("disabled");
            } else { // Caso contrario se mantendra o agregara
                botonGuardar.setAttribute("disabled", "disabled");
            }
        }

        function solonumeroyletras(event){
         const input = event.target;
            const valor = input.value;
            input.value = valor.replace(/[^A-Z0-9a-záéíóúÁÉÍÓÚ\s]/g, '');
        }

        // Validacion de Correo Electronico
        function validarCorreo(input) {
            var correoValor = input.value.trim();
            var formatoCorreo = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            return formatoCorreo.test(correoValor);
        }

     </script>
</head>
<body>
   <!--Reacomodamiento general y anexo de fondo-->
   <section class="pt-5 pb-5 mt-0 align-items-center d-flex bg-dark" style="min-height: 100vh; background-size: cover; background-image: url(https://i.ytimg.com/vi/hKe__FEvsc4/maxresdefault.jpg);">
      <div class="container-fluid">
         <!--Ajustes responsibos-->
         <div class="row  justify-content-center align-items-center d-flex-row text-center h-100">
         <div class="col-12 col-md-4 col-lg-3   h-50 ">
               <!--Encapsulamiento del <form>-->
               <div class="card shadow">
               <div class="card-body mx-auto">
                  <h4 class="card-title mt-3 text-center">Registro</h4>
                  <p class="text-center">Ingrese los datos correspontientes</p>
                  <form method="post">
                  <fieldset>
                  <legend>Información personal</legend>
                     <!--Usuario-->
                     <div class="input-group mb-2">
                           <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                           <input type="text" autocomplete="nope" name="matricula" class="form-control" placeholder="Usuario" aria-label="Usuario" minlength="8" maxlength="8" oninput="soloNumeros(event); validarFormulario(this);" onblur="minimo8(this.value, this);">
                     </div>
                     <!--Nombre-->
                     <div class="input-group mb-2">
                           <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                           <input type="text" autocomplete="nope"  name="nombre" class="form-control" placeholder="Nombre" aria-label="Nombre" maxlength="30" oninput="soloTexto(event); validarFormulario(this);">
                     </div>
                     <!--Apellido P.-->
                     <div class="input-group mb-2">
                           <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                           <input type="text" autocomplete="nope" name="apellido_paterno" class="form-control" placeholder="Apellido paterno" aria-label="Apellido paterno" maxlength="30" oninput="soloTexto(event); validarFormulario(this);">
                     </div>
                     <!--Apellido M.-->
                     <div class="input-group mb-2">
                           <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                           <input type="text" autocomplete="nope" name="apellido_materno" class="form-control" placeholder="Apellido materno" aria-label="Apellido materno" maxlength="30" oninput="soloTexto(event); validarFormulario(this);">
                     </div>
                     <!--Teléfono-->
                     <div class="input-group mb-2">
                           <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                           <input type="text" autocomplete="nope" name="telefono" class="form-control" placeholder="Teléfono" aria-label="Teléfono" maxlength="10" oninput="soloNumeros(event); validarFormulario(this);" onblur="minimo10(this.value, this);">
                     </div>
                     <!--Edad-->
                     <div class="input-group mb-2">
                           <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                           <input type="text" autocomplete="nope" name="edad" class="form-control" placeholder="Edad" aria-label="Edad" maxlength="2" oninput="soloNumeros(event); validarFormulario(this);">
                     </div>  
                     <!--Correo electronico-->
                     <div class="input-group mb-2">
                           <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                           <input type="text" autocomplete="nope" name="correo_electronico" class="form-control" placeholder="Correo electronico" aria-label="Correo electronico" maxlength="40" pattern=".*@(gmail\.com|hotmail\.com)" oninput="validarFormulario(this);">
                     </div>
                     <!--Contraseña-->
                     <div class="input-group mb-2">
                           <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                           <input type="password" autocomplete="nope" name="contrasena" class="form-control" placeholder="Contraseña" aria-label="Contraseña" maxlength="12" oninput="solonumeroyletras(event); ">
                     </div>
                  </fieldset>
                  
                  <fieldset>
                  <legend>Información académica</legend>
                     <!--| |Semestre| |-->
                     <div class="input-group mb-2">
                     <select class="form-select" aria-label="Default select example" name="semestre" onchange="validarFormulario(this);">
                           <option selected value="">Selecciona el grado actual</option>
                           <option value="1">Primero</option>
                           <option value="2">Segundo</option>
                           <option value="3">Tercero</option>
                           <option value="4">Cuarto</option>
                           <option value="5">Quinto</option>
                     </select>
                     </div>
                     
                     <!--| |Carrera| |-->
                     <div class="input-group mb-2">
                           <select class="form-select" aria-label="Default select example" name="carrera" onchange="validarFormulario(this);">
                              <option selected value="">Especializacion</option>
                              <option value="1">Sistemas</option>
                              <option value="2">Administración</option>
                           </select>
                     </div>
                  </fieldset>

                  <!--Botón para iniciar sesion-->
                  <div class="form-group d-grid mt-3">
                     <button type="submit" class="btn btn-primary btn-block px-4" name="registrar" disabled>Guardar datos</button>
                  </div>
                  <!--Redireccion a registro (register.php)-->
                  <p class="text-center mt-2">Ya estoy registrado
                     <a href="index.html">Iniciar sesión</a>
                  </p>
                  </form>
               </div>
               </div>
         </div>
         </div>
      </div>
   </section>
</body>
</html>
