<?php
session_start();
require 'conexion.php';

$userCorreo = trim($_POST['ucorreo']);
$userPass   = trim($_POST['upass']);

// Consulta usando la tabla correcta
$consulta_sql = "SELECT * FROM clientes WHERE correo = ?";
$stmt = $conexion->prepare($consulta_sql);
$stmt->bind_param("s", $userCorreo);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $row = $resultado->fetch_assoc();

    // Verificar contraseña (TEXTO PLANO)
    if ($userPass === $row['pass']) {
        $_SESSION['user_sesion'] = $row;
        header("Location: ../index.php?msj=ok");
        exit;
    } else {
        // Contraseña incorrecta
        header("Location: ../index.php?error=pass");
        exit;
    }
} else {
    // Usuario no encontrado
    header("Location: ../index.php?error=user");
    exit;
}

$stmt->close();
$conexion->close();
?>