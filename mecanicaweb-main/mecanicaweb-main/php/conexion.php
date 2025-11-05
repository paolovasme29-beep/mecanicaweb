<?php
$servidor = "localhost";
$database = "db_mecanica";
$usuario = "root";
// $pass = "paolord";
$pass = "";
#Instanciar un objeto
$conexion = new mysqli($servidor, $usuario, $pass, $database);
if($conexion->connect_error){
    echo "CONEXION MALA";
    echo $conexion->connect_error; 
}else{
    //echo "CONEXION EXITOSA";
}
?>