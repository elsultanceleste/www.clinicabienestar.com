<?php

    require "./conexion.php";

    $sql = "SELECT 
    medicos.id AS medico_id, 
    empleados.nombre AS nombre_medico, 
    medicos.especialidad 
FROM 
    medicos 
INNER JOIN 
    empleados 
ON 
    medicos.id_empleado = empleados.id";
    $result = mysqli_query($conexion, $sql);

    $json = [];

    while($fila = $result->fetch_assoc())
        $json [] = $fila;
    
    echo json_encode($json);
?>