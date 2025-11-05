<?php     
session_start();
if (isset($_SESSION['user_sesion'])) {
  $roles_user = $_SESSION['user_sesion']['roles'];
  $nombre_user = $_SESSION['user_sesion']['nombre'];
  if ($roles_user !== "cliente") {
    header('Location: dashboard.php');
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>MecanicaX</title>
  <link rel="shortcut icon" href="assets/images/logo/logo.ico" type="image/x-icon">

  <!-- Estilos propios -->
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="stylesheet" href="assets/css/responsive.css" />
  <link rel="stylesheet" href="assets/css/modal_login.css" />

  <!-- Bootstrap 5 -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Font Awesome -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
  />

  <!-- SweetAlert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <body>
<?php
$usuario = isset($_SESSION['user_sesion']) ? $_SESSION['user_sesion'] : null;
?>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
  <div class="container-fluid">
  <a class="navbar-brand d-flex align-items-center" href="#">
  <img src="assets/images/logo/logo.ico" alt="Logo" class="brand-logo me-2">
  Mecanica<span class="brand-X">X</span>
</a>


    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
      data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
      aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Productos</a>
        </li>

        <!-- Menú dinámico según sesión -->
        <?php if (!isset($_SESSION['user_sesion'])): ?>
          <!-- No logueado -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button"
              data-bs-toggle="dropdown" aria-expanded="false">
              Cuenta
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="#" id="btnLogin">Iniciar Sesión</a></li>
              <li><a class="dropdown-item" href="#" id="btnRegistrarUser">Registrar Usuario</a></li>
            </ul>
          </li>
        <?php else: ?>
          <!-- Usuario logueado -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button"
              data-bs-toggle="dropdown" aria-expanded="false">
              👋 Hola, <?php echo htmlspecialchars($_SESSION['user_sesion']['nombre']); ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="#">Perfil</a></li>

              <?php if ($_SESSION['user_sesion']['roles'] === 'admin'): ?>
                <li><a class="dropdown-item" href="dashboard.php">Panel Admin</a></li>
              <?php endif; ?>

              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item text-danger" href="php/cerrar_sesion.php">Cerrar Sesión</a></li>
            </ul>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<!-- Espacio para que el contenido no quede oculto -->
<div style="margin-top: 80px;"></div>


  <!-- Header -->
  <header class="header">
      <div class="search-container">
        <input
          type="text"
          class="search-input"
          placeholder="¿Qué producto buscas?"
        />
        <button class="search-btn"><i class="fas fa-search"></i></button>

        <input
          type="text"
          class="search-input"
          placeholder="Consulta a un mecánico"
        />
        <button class="search-btn"><i class="fas fa-search"></i></button>
      </div>

    
    </div>
  <!-- Main Content -->
  <div class="main-content">
    <!-- Products Section -->
    <section class="products-section">
      <div class="sort-container mb-3">
        <div style="display: flex; gap: 15px; align-items: center">
          <span class="sort-label">Ordenar por:</span>
          <select class="sort-select">
            <option>Recomendados</option>
            <option>Menor calidad</option>
            <option>Mayor calidad</option>
            <option>Más pedidos</option>
          </select>
        </div>
      </div>

      <!-- Grid de Productos con Bootstrap -->
      <div class="container my-4">
        <div class="row text-center g-4">

          <!-- Producto 1 -->
          <div class="col-12 col-md-4">
            <div class="card shadow-sm h-100">
              <img src="https://revistasociosams.com/wp-content/uploads/2023/03/Varios-aceites-exxon.png" 
                   class="card-img-top" alt="Aceite para carros">
              <div class="card-body">
                <h5 class="card-title">MOBIL SUPER</h5>
                <p class="card-text">Aceite Para Carros</p>
                <p class="fw-bold text-success">S/ 30</p>
                <button class="btn btn-dark w-100">
                  <i class="fas fa-plus"></i> Añadir al carrito
                </button>
              </div>
            </div>
          </div>

          <!-- Producto 2 -->
          <div class="col-12 col-md-4">
            <div class="card shadow-sm h-100">
              <img src="https://ar.moovelub.com/storage/uploads/00000001000.png" 
                   class="card-img-top" alt="Aceite para motos">
              <div class="card-body">
                <h5 class="card-title">MOBIL SUPER</h5>
                <p class="card-text">Aceite Para Motos</p>
                <p class="fw-bold text-success">S/ 20</p>
                <button class="btn btn-dark w-100">
                  <i class="fas fa-plus"></i> Añadir al carrito
                </button>
              </div>
            </div>
          </div>

          <!-- Producto 3 -->
          <div class="col-12 col-md-4">
            <div class="card shadow-sm h-100">
              <img src="https://ar.moovelub.com/mobil/aceite-de-motor-de-motocicletas/images/00000000341.png" 
                   class="card-img-top" alt="Aceite sintético premium">
              <div class="card-body">
                <h5 class="card-title">MOBIL SUPER MOTO™ 10W-40</h5>
                <p class="card-text">Aceite Sintético Premium</p>
                <p class="fw-bold text-success">S/ 35</p>
                <button class="btn btn-dark w-100">
                  <i class="fas fa-plus"></i> Añadir al carrito
                </button>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>
  </div>

  <!-- Footer -->
  <footer class="footer">
    <div class="footer-bottom">
      <div class="social-links">
        <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
        <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
        <a href="#" class="social-link"><i class="fab fa-tiktok"></i></a>
      </div>
      <div class="footer-legal">
        <a href="#">Términos y condiciones</a>
        <a href="#">Política de cookies</a>
        <a href="#">Política de privacidad</a>
      </div>
      <p class="copyright">
        © TODOS LOS DERECHOS RESERVADOS<br />
        Av. Yarinacocha MZ.34 Lt.13-A, Pucallpa 25004, Perú.
      </p>
    </div>
  </footer>

  <!-- Modal LOGIN -->
  <div id="modalLogin" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2>Iniciar Sesión</h2>
      <form action="php/iniciar_sesion.php" method="POST">
        <label class="labelModal" for="login_correo">Correo</label>
        <input class="inputGeneral" type="email" name="ucorreo" id="login_correo" placeholder="Ingresa tu usuario" required />
        <label class="labelModal" for="login_password">Contraseña</label>
        <input name="upass" type="password" id="login_password" class="inputGeneral" placeholder="Ingresa tu contraseña" required />
        <button type="submit" class="btnEntrarLogin">Entrar</button>
      </form>
    </div>
  </div>

  <!-- Modal REGISTRAR -->
  <div id="modalRegistrarUser" class="modal">
    <div class="modal-content">
      <span class="closeRUser">&times;</span>
      <h2>Registrar Usuario</h2>
      <form action="php/registrar_usuario.php" method="POST">
        <label class="labelModal" for="nombre">Nombre</label>
        <input class="inputGeneral" type="text" id="nombre" name="nom" placeholder="Registra tu nombre" required />
        <label class="labelModal" for="apellido">Apellido</label>
        <input class="inputGeneral" type="text" id="apellido" name="apellido" placeholder="Registra tu apellido" required />
        <label class="labelModal" for="telefono">Teléfono</label>
        <input class="inputGeneral" type="text" id="telefono" name="telefono" placeholder="Registra tu teléfono" required />
        <label class="labelModal" for="registro_correo">Correo</label>
        <input class="inputGeneral" type="email" id="registro_correo" name="correo" placeholder="Registra tu Correo Electrónico" required />
        <label class="labelModal" for="registro_password">Contraseña</label>
        <input name="pass" type="password" id="registro_password" class="inputGeneral" placeholder="Registra tu contraseña" required />
        <button type="submit" class="btnEntrarLogin">Entrar</button>
      </form>
    </div>
  </div>

  <!-- Scripts -->
  <script src="assets/js/toggledropdown_login.js"></script>
  <script src="assets/js/modal-login.js"></script>
  <script src="assets/js/modal-registro-usuario.js"></script>

  <?php 
  if (isset($_GET['msj'])) {
    if ($_GET['msj'] == "ok") {
      echo "<script>Swal.fire({icon:'success',title:'Registrado',text:'¡Usted está registrado en el sistema!'});</script>";
    } else {
      echo "<script>Swal.fire({icon:'error',title:'Oops!',text:'¡No se pudo registrar en el sistema!'});</script>";
    }
  }

  if (isset($_GET['error']) && $_GET['error'] == "user") {
    echo "<script>Swal.fire({icon:'error',title:'Oops!',text:'¡Contraseña o correo incorrecto!'});</script>";
  }
  ?>
</body>
</html>