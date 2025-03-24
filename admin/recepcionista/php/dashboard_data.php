<?php
require_once('../../config/conexion.php');

// Get total patients
$query_pacientes = "SELECT COUNT(*) as total FROM pacientes";
$result_pacientes = mysqli_query($conexion, $query_pacientes);
$total_pacientes = mysqli_fetch_assoc($result_pacientes)['total'];

// Get total appointments
$query_citas = "SELECT COUNT(*) as total FROM citas";
$result_citas = mysqli_query($conexion, $query_citas);
$total_citas = mysqli_fetch_assoc($result_citas)['total'];

// Get pending appointments
$query_pendientes = "SELECT COUNT(*) as total FROM citas WHERE estado = 'Programada'";
$result_pendientes = mysqli_query($conexion, $query_pendientes);
$citas_pendientes = mysqli_fetch_assoc($result_pendientes)['total'];

// Get today's appointments
$query_hoy = "SELECT 
    c.id,
    p.nombre,
    p.apellido,
    c.hora_cita,
    c.estado,
    CONCAT(e.nombre, ' ', e.apellido) as medico,
    c.tipo
    FROM citas c
    JOIN pacientes p ON c.paciente_id = p.id
    JOIN medicos m ON c.medico_id = m.id
    JOIN empleados e ON m.id_empleado = e.id
    WHERE DATE(c.fecha_cita) = CURDATE()
    ORDER BY c.hora_cita";

$result_hoy = mysqli_query($conexion, $query_hoy);
$citas_hoy = [];
while($row = mysqli_fetch_assoc($result_hoy)) {
    $citas_hoy[] = $row;
}

$data = [
    'total_pacientes' => $total_pacientes,
    'total_citas' => $total_citas,
    'citas_pendientes' => $citas_pendientes,
    'citas_hoy' => $citas_hoy
];

echo json_encode($data);
?>