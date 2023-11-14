<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Inclusion del head -->
    <?php include 'controller/head.php';?>
    <title>404 · LTSchool</title>
</head>
<body class="bg-body-tertiary">

  <!-- Barra de navegación -->
  <?php include 'controller/components/user_header.php'; ?>
  <!--Permite que el codigo de esta pagina sea menor y agil para la vista del programador-->

  <div class="py-5 text-center">
    <div class="container py-5">
    <i class="bi bi-exclamation-octagon display-4" style="font-size: 6rem;"></i>
      <h1 class="text-body-emphasis display-4">Error 404</h1>
      <p class="col-lg-8 mx-auto lead">
      Lo sentimos, la página que buscas no se encuentra o es inexistente.
      </p>
      <p>¿Qué tal volver a <a href="index.php">página de inicio</a>?</p>
    </div>
  </div>

  <!-- Barra de navegación -->
  <?php include 'controller/components/user_footer.php'; ?>
  <!--Permite que el codigo de esta pagina sea menor y agil para la vista del programador-->
  
</body>
</html>
