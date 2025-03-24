<?php
require_once('../config/conexion.php');

if (isset($_POST['rol']) && $_POST['accion'] == 'agregar') {
    $rol = $_POST['rol'];

    // Verificar si el rol ya existe en la base de datos
    $verificarRol = "SELECT * FROM rol WHERE nombre = '$rol'";
    $resulVerif = mysqli_query($conexion, $verificarRol);

    if (mysqli_num_rows($resulVerif) > 0) {
        // El rol ya existe
        echo 3; // Código para indicar que el rol ya existe
    } else {
        // Insertar el nuevo rol
        $sql = "INSERT INTO rol (nombre) VALUES ('$rol')";
        $resultado = mysqli_query($conexion, $sql);

        if ($resultado) {
            echo 1; 
        } else {
            echo 2;
        }
    }
}elseif ($_POST['accion'] == 'traer') {
    $sql = "SELECT * FROM rol";
    $resul = mysqli_query($conexion, $sql);
    $datos = array();
    while ($fila = mysqli_fetch_assoc($resul)) {
        $datos[] = $fila;
    }
    echo json_encode($datos);
    mysqli_close($conexion);
}
?>