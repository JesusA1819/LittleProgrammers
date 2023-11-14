<?php
session_start();

    $servername = "lps1819.mariadb.database.azure.com";
    $username = "JesusAlonso@lps1819";
    $password = "Alonsogomez1819";
    $database = "lpstec";
    
    $conexion = mysqli_connect($servername, $username, $password, $database);
if (!$conexion) {
    echo "No se realizó la conexión a la base de datos, el error fue:" . mysqli_connect_error();
} else {
    $username = $_POST["Matricula"];
    $password = $_POST["Contrasena"];

    $sql = "SELECT Matricula, Nombre, Contrasena
            FROM usuario
            WHERE Matricula = ? AND Contrasena = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("is", $username, $password);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($matricula, $nombre, $contrasena);
        $stmt->fetch();
    
        $_SESSION['Matricula'] = $matricula;
        $_SESSION['Nombre'] = $nombre;
        header("Location: ../home.php");
        exit();
    } else {
        ?>

        <!DOCTYPE html>
        <html lang="es">
        
        <head>
           <!--Metas Defauld-->
           <meta charset="UTF-8">
           <meta http-equiv="X-UA-Compatible" content="IE=edge">
           <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
           <!--Enlaces/Librerias-->
           <!--Boostrap-->
           <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"/>
        
           <!--CDN-->
           <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
           <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>
           <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
           <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
           <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
        
           <!--Enlace a la carpeta CSS-->
        
           <!--TODO LOS JAVASCRIPT SE ENCEUNTRA EN LA CARPETA CONTROLLER NOMBRADO SCRIPTS.PHP-->
           <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
           <title>Registro de datos · LTSchool</title>
           <link rel="stylesheet" href="../../assets/css/inf.css">
        
           <script>
              function soloTexto(event) {
                 const input = event.target;
                 const valor = input.value;
                 input.value = valor.replace(/[^A-Za-záéíóúÁÉÍÓÚ\s]/g, '');
              }
              function soloNumeros(event) {
                 const input = event.target;
                 const valor = input.value;
                 input.value = valor.replace(/\D/g, ''); 
              }
        
           </script>
        </head>
        <body>
           <section class="pt-5 pb-5 mt-0 align-items-center d-flex bg-dark" style="min-height: 100vh; background-size: cover; background-image: url(https://img.freepik.com/fotos-premium/fondo-negro-espacio-copia_28629-1765.jpg);">
              <div class="container-fluid">
                 <!--Ajustes responsibos-->
                 <div class="row  justify-content-center align-items-center d-flex-row text-center h-100">
                 <div class="col-10 h-50 ">
                    <div class="position-relative p-5 text-center text-muted bg-body border border-dashed rounded-5">
                       <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-exclamation-triangle mt-5 mb-3 text-warning" viewBox="0 0 16 16">
                       <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                       <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
                       </svg>
                       <h1 class="text-body-emphasis">Acceso Denegado</h1>
                       <p class="col-lg-6 mx-auto mb-4">
                          Es psoible que algun campo que se a ingresado sea incorrecto, vuelva a intentarlo.
                       </p>
                       <p class="text-center mt-2">
                       <button class="styled-button"><a href="../index.html">Iniciar Sesion</a></button> 
                       </p>
                    </div>
                 </div>
                 </div>
              </div>
           </section>
        </body>
        </html>

        <?php
    }
    
}
?>
