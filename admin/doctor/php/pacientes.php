<?php
require_once('../../config/conexion.php');
session_start();

$accion = $_GET['accion'] ?? '';

switch($accion) {
    case 'listar':
        $id_medico = $_SESSION['id_medico'] ?? 0;
        $query = "SELECT DISTINCT 
                    p.id,
                    p.nombre,
                    p.apellido,
                    p.fecha_nacimiento,
                    p.genero,
                    p.direccion,
                    p.telefono,
                   p.edad
                 FROM pacientes p
                 INNER JOIN citas c ON p.id = c.paciente_id
                 WHERE c.medico_id = $id_medico
                 ORDER BY p.apellido, p.nombre";
        
        $result = mysqli_query($conexion, $query);
        $pacientes = [];
        while($row = mysqli_fetch_assoc($result)) {
            $pacientes[] = $row;
        }
        echo json_encode($pacientes);
        break;
    
    case 'historial':
        $id_paciente = $_GET['id'];
        $query = "SELECT h.*, p.nombre, p.apellido,edad, DATE_FORMAT(h.fecha, '%d/%m/%Y') as fecha 
                  FROM historial_medico h 
                  JOIN pacientes p ON h.paciente_id = p.id 
                  WHERE h.paciente_id = ? 
                  ORDER BY h.fecha DESC";
        
        $stmt = mysqli_prepare($conexion, $query);
        mysqli_stmt_bind_param($stmt, "i", $id_paciente);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        
        $historial = [];
        while($row = mysqli_fetch_assoc($resultado)) {
            $historial[] = $row;
        }
        
        echo json_encode($historial);
        break;
    
    case 'obtenerHistorial':
        $id_historial = $_GET['id'];
        $query = "SELECT * FROM historial_medico WHERE id = ?";
        
        $stmt = mysqli_prepare($conexion, $query);
        mysqli_stmt_bind_param($stmt, "i", $id_historial);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        
        echo json_encode(mysqli_fetch_assoc($resultado));
        break;
}
?>