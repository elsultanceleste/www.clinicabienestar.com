<?php
require_once('../../config/conexion.php');

if(isset($_POST['busqueda'])) {
    $busqueda = mysqli_real_escape_string($conexion, $_POST['busqueda']);
    
    $query = "SELECT * FROM pacientes WHERE 
            nombre LIKE '%$busqueda%' OR 
            apellido LIKE '%$busqueda%' OR 
            telefono LIKE '%$busqueda%' OR 
            email LIKE '%$busqueda%' OR
            direccion LIKE '%$busqueda%'";
            
    $resultado = mysqli_query($conexion, $query);
    $pacientes = [];
    
    while($row = mysqli_fetch_assoc($resultado)) {
        $pacientes[] = $row;
    }
    
    echo json_encode($pacientes);
}
?>