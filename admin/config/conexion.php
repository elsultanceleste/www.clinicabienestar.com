<?php
$servidor = 'localhost';
$usuario = 'root';
$contrasena = '';
$basededatos = 'ClinicaBienestar';

$conexion = mysqli_connect($servidor, $usuario, $contrasena, $basededatos);

if (!$conexion) {
    die("Error de conexión: ". mysqli_connect_error());
}
