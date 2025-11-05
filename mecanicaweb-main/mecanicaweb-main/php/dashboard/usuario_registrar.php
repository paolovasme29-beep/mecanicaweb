<?php
require '../conexion.php';

$nombre   = $_POST['nom'];
$apellido = $_POST['apellido'];
$telefono = $_POST['telefono'];
$correo   = $_POST['correo'];
$pass     = $_POST['pass'];
$rol      = $_POST['rol'];

$sql = "INSERT INTO clientes (nombre, apellido, telefono, correo, pass, roles)
        VALUES ('$nombre', '$apellido', '$telefono', '$correo', '$pass', '$rol')";

$resultado = $conexion->query($sql);

if ($resultado) {
    header("Location: ../../dash_usuario_registro.php?msj=ok");
} else {
    header("Location: ../../dash_usuario_registro.php?msj=error");
}
?>
