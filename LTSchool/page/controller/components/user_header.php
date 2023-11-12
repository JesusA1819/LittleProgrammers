<!--Barra de navegador--> <!--fixed-top para que sea flotante-->
<nav class="navbar bg-dark">
  <div class="container-fluid mx-2">
    <!--Contenido superior del menu-->
    <div>
        <i class="bi bi-mortarboard-fill mx-1 text-white"></i>
        <a class="navbar-brand text-white" href="index.php">LTSchool</a>
    </div>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!--Interfaz de menu lateral-->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <!--Titulo en la parte superuiro con botón de cerrar-->
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="border-bottom mx-2"></div>

        <!--Informacion basica-->
        <div class="bg-body-tertiary card-button" data-toggle="collapse">
            <div class="row no-gutters m-2">
                <!-- Icono en la parte izquierda -->
                <div class="col-md-4">
                    <span class="bi bi-person-circle" style="font-size: 2rem;"></span>
                </div>
                <div class="col-md-8">
                    <!-- Texto en la parte superior con alineación izquierda -->
                    <h5 class="card-title text-left">Luis Fuentes Tec</h5>
                    <!-- Texto en la parte inferior con alineación izquierda -->
                    <p class="card-text text-left">Ingenieria en sistemas</p>
                </div>
            </div>
        </div>

        <div class="border-bottom mx-2"></div>

        <!--Resto de contenido-->
      <div class="offcanvas-body">
        
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#" id="toggleButton">Informacion</a>
            <p id="texto" class="hidden">Este es el texto que se puede mostrar u ocultar.</p>
          </li>
        </ul>
        <ul class="list-group list-group-flush">
        <li class="list-group-item">An item</li>
        <li class="list-group-item">A second item</li>
        <li class="list-group-item">A third item</li>
        <li class="list-group-item">A fourth item</li>
        <li class="list-group-item">And a fifth one</li>
        </ul>
        <!-- Botones para cambiar el tema -->
        <div class="btn-group dropup position-absolute bottom-0 end-0 m-3">
        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-half" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
            </svg>
        </button> 
        <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" id="theme-light-button" href="#">Tema Claro</a></li>
            <li><a class="dropdown-item" id="theme-dark-button" href="#">Tema Oscuro</a></li>
        </ul>
        </div>
      </div>
    </div>
  </div>
</nav>