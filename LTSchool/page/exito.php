<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Registro de datos</title>
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

      setTimeout(function() {
         window.location.href = "index.html"; 
      }, 3000); 
   </script>
</head>
<body>
   <div class="cont">
      <h1>Completado</h1>
      <h1>Datos guardados correctamente</h1>
      <h1>Redirigiendo</h1>
   </div>
</body>
</html>
