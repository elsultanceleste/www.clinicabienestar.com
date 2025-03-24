<?php

    require "./conexion.php";
    $id = $_POST['id_medico'];

    $sql = "SELECT 
    medicos.id AS medico_id, 
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
    medicos.id_empleado = empleados.id WHERE medicos.id = $id ";
    $result = mysqli_query($conexion, $sql);

    $json = [];

    while($fila = $result->fetch_assoc())
        $json [] = $fila;
    
    echo json_encode($json);
?>