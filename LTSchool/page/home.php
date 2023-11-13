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
   <title>Login · LTSchool</title>
   <script>
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

   function solonumeroyletras(event){
         const input = event.target;
            const valor = input.value;
            input.value = valor.replace(/[^A-Z0-9a-záéíóúÁÉÍÓÚ\s]/g, '');
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
                   <h4 class="card-title mt-3 text-center">Iniciar sesión</h4>
                   <p class="text-center">Ingrese los datos correspontientes</p>
                   <form method="post" action="checkup/verificacion.php">
                   <!--Usuario-->
                   <div class="input-group mb-2">
                       <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                       <input type="text" class="form-control" placeholder="Usuario" aria-label="Usuario" id="Matricula" name="Matricula" maxlength="10" oninput="soloNumeros(event);" onblur="minimo8(this.value, this);" required>
                   </div>
                   <!--Contraseña-->
                   <div class="input-group mb-2">
                       <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                       <input type="password" class="form-control" placeholder="Contraseña" aria-label="Contraseña" id="Contrasena" name="Contrasena"  maxlength="12" oninput="solonumeroyletras(event);" required>
                   </div>
                   <!--Botón para iniciar sesion-->
                   <div class="form-group d-grid mt-3">
                       <button type="submit" class="btn btn-primary btn-block"> Ingresar </button>
                   </div>
                   <!--Redireccion a registro (register.php)-->
                   <p class="text-center mt-2">¿No tienes una cuenta?
                       <a href="register.php">Registrarse</a>
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
