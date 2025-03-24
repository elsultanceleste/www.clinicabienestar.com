<?php

    require "./conexion.php";

    session_start();

    $id = $_SESSION['id_paciente'];

    $consult = "SELECT 
    empleados.nombre AS nombre_medico,
    citas.fecha_cita,
    citas.hora_cita,
    citas.motivo,
    citas.estado
    FROM 
        citas
    INNER JOIN 
        medicos 
    ON 
        citas.medico_id = medicos.id
    INNER JOIN 
        empleados 
    ON 
        medicos.id_empleado = empleados.id
    WHERE 
        citas.paciente_id = $id";

    $resultado = mysqli_query($conexion,$consult);

    $json = [];

    while($obj = mysqli_fetch_assoc($resultado))
         $json [] = $obj;
        
    echo json_encode($json);

?>