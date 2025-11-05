<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre   = trim($_POST['nom']);
    $apellido = trim($_POST['apellido']);
    $telefono = trim($_POST['telefono']);
    $correo   = trim($_POST['correo']);
    $pass     = trim($_POST['pass']);

    // Verificar si el correo ya existe
    $sql_check = "SELECT id_cliente FROM clientes WHERE correo = ?";
    $stmt = $conexion->prepare($sql_check);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "❌ El correo ya está registrado.";
        exit;
    }
    $stmt->close();

    // Insertar nuevo usuario con cargo 'cliente'
    $sql = "INSERT INTO clientes (nombre, apellido, telefono, correo, cargo, pass)
            VALUES (?, ?, ?, ?, 'cliente', ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssss", $nombre, $apellido, $telefono, $correo, $pass);

    if ($stmt->execute()) {
        echo "✅ Usuario registrado correctamente.";
        header("Location: ../index.php?msj=ok");
        exit;
    } else {
        echo "❌ Error al insertar: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
}
?>
