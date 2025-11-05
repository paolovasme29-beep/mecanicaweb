<?php
session_start();

// Verificar sesión
if (!isset($_SESSION['user_sesion'])) {
    header("Location: index.php");
    exit;
}

// Verificar rol de administrador
if ($_SESSION['user_sesion']['roles'] !== 'admin') {
    header("Location: index.php");
    exit;
}

require_once("php/conexion.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Panel de Administración - MecanicaX</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-light">

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold" href="#">MecanicaX Admin</a>

      <div class="d-flex align-items-center">
        <span class="text-white me-3">👤 <?php echo htmlspecialchars($_SESSION['user_sesion']['nombre']); ?></span>
        <a href="php/cerrar_sesion.php" class="btn btn-outline-light btn-sm">Cerrar Sesión</a>
      </div>
    </div>
  </nav>

  <!-- Contenido principal -->
  <div class="container mt-4">
    <h2 class="mb-4 text-center">Usuarios Registrados</h2>

    <?php
    // Consulta para obtener los clientes registrados
    $sql = "SELECT id, nombre, apellido, telefono, correo, roles FROM clientes";
    $result = $conexion->query($sql);

    if ($result && $result->num_rows > 0):
    ?>
      <div class="table-responsive shadow-sm">
        <table class="table table-hover table-striped align-middle">
          <thead class="table-dark">
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Teléfono</th>
              <th>Correo</th>
              <th>Rol</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
              <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                <td><?php echo htmlspecialchars($row['apellido']); ?></td>
                <td><?php echo htmlspecialchars($row['telefono']); ?></td>
                <td><?php echo htmlspecialchars($row['correo']); ?></td>
                <td>
                  <span class="badge bg-<?php echo $row['roles'] === 'admin' ? 'danger' : 'primary'; ?>">
                    <?php echo ucfirst($row['roles']); ?>
                  </span>
                </td>
                <td>
                  <a href="php/eliminar_usuario.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-danger">
                    <i class="fa fa-trash"></i> Eliminar
                  </a>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    <?php else: ?>
      <div class="alert alert-info text-center">No hay usuarios registrados aún.</div>
    <?php endif; ?>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>
</html>
