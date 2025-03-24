<?php

    require "./conexion.php";

    $sql = "SELECT 
    medicos.id AS id_medico,
    empleados.nombre AS nombre_medico,
    empleados.apellido AS apellido_medico,
    empleados.nacionalidad As nacionalidad_medico,
    empleados.perfil AS perfil_medico,
    medicos.especialidad,
    medicos.titulo_profesional,
    medicos.experiencia,
    medicos.idiomas
FROM 
    medicos
INNER JOIN 
    empleados 
ON 
    medicos.id_empleado = empleados.id";
    $result = mysqli_query($conexion, $sql);

    $json = [];

    while($fila = mysqli_fetch_assoc($result))
        $json [] = $fila;

    echo json_encode($json);

?>