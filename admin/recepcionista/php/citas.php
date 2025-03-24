<?php
require_once('../config/conexion.php');

if ($_POST['accion'] == 'cargarCitas') {
    // $sql = "SELECT * FROM citas WHERE fecha = CURDATE() ORDER BY hora ASC"; citas de hoy
    $sql = "SELECT p.nombre, p.apellido, c.fecha_cita, c.hora_cita, c.id, c.motivo, c.estado, c.tipo, c.motivo, m.especialidad, e.nombre AS nombre_medico, e.apellido AS apellido_medico
FROM citas c
INNER JOIN pacientes p ON c.paciente_id = p.id
INNER JOIN medicos m ON c.medico_id = m.id
INNER JOIN empleados e ON m.id_empleado = e.id" ; 
    $result = $conexion->query($sql);
    $citas = array();

    while ($row = $result->fetch_assoc()) {
        $citas[] = $row;
    }
    echo json_encode($citas);

}




?>