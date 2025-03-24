<?php
session_start();
require_once('../../config/conexion.php');

$accion = $_GET['accion'] ?? '';
$id_medico = $_SESSION['id_medico'] ?? 0;
$response = []; // Initialize response array

switch($accion) {
    case 'contadores':
        $response = [
            'pendientes' => obtenerContadorCitas('Programada'),
            'atendidas' => obtenerContadorCitas('Realizada'),
            'nuevas' => obtenerContadorCitas('nueva')
        ];
        break;

    case 'pendientes':
        $query = "SELECT c.*, p.nombre as nombre_paciente, p.apellido as apellido_paciente 
                 FROM citas c 
                 JOIN pacientes p ON c.paciente_id = p.id 
                 WHERE c.medico_id = $id_medico AND c.estado = 'Programada'
                 ORDER BY c.fecha_cita, c.hora_cita";
        $result = mysqli_query($conexion, $query);
        if($result) {
            $response = mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            $response = ['error' => mysqli_error($conexion)];
        }
        break;

    case 'atendidas':
        $query = "SELECT c.*, p.nombre as nombre_paciente, p.apellido as apellido_paciente,
                 h.diagnostico 
                 FROM citas c 
                 JOIN pacientes p ON c.paciente_id = p.id 
                 LEFT JOIN historial_medico h ON c.id = h.id_cita
                 WHERE c.medico_id = $id_medico AND c.estado = 'Realizada'
                 ORDER BY c.fecha_cita DESC";
        $result = mysqli_query($conexion, $query);
        if($result) {
            $response = mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            $response = ['error' => mysqli_error($conexion)];
        }
        break;

    case 'atender':
        $cita_id = $_POST['cita_id'] ?? 0;
        $diagnostico = mysqli_real_escape_string($conexion, $_POST['diagnostico'] ?? '');
        $tratamiento = mysqli_real_escape_string($conexion, $_POST['tratamiento'] ?? '');
        $receta = mysqli_real_escape_string($conexion, $_POST['receta'] ?? '');

        mysqli_begin_transaction($conexion);
        try {
            // Actualizar estado de la cita
            $update_query = "UPDATE citas SET estado = 'Realizada' WHERE id = $cita_id";
            if(!mysqli_query($conexion, $update_query)) {
                throw new Exception(mysqli_error($conexion));
            }
            
            // Crear registro en historial médico
            $insert_query = "INSERT INTO historial_medico (id_cita, paciente_id, id_medico, diagnostico, tratamiento, receta) 
                           SELECT id, paciente_id, medico_id, '$diagnostico', '$tratamiento', '$receta'
                           FROM citas WHERE id = $cita_id";
            if(!mysqli_query($conexion, $insert_query)) {
                throw new Exception(mysqli_error($conexion));
            }
            
            mysqli_commit($conexion);
            $response = ['success' => true];
        } catch (Exception $e) {
            mysqli_rollback($conexion);
            $response = ['success' => false, 'error' => $e->getMessage()];
        }
        break;

    case 'obtener_cita':
        case 'detalles':
                $id_cita = $_GET['id'] ?? 0;
                $query = "SELECT c.*, 
                            p.nombre as nombre_paciente, 
                            p.apellido as apellido_paciente,
                            p.fecha_nacimiento,
                            p.genero,
                            p.telefono,
                            CONCAT(p.nombre, ' ', p.apellido) as nombre_completo,
                            DATE_FORMAT(c.fecha_cita, '%d/%m/%Y') as fecha_formateada,
                            c.hora_cita as hora,
                            CONCAT(DATE_FORMAT(c.fecha_cita, '%d/%m/%Y'), ' ', c.hora_cita) as fecha_hora
                     FROM citas c
                     JOIN pacientes p ON c.paciente_id = p.id
                     WHERE c.id = $id_cita AND c.medico_id = $id_medico";
                
                $result = mysqli_query($conexion, $query);
                if($result && mysqli_num_rows($result) > 0) {
                    $cita = mysqli_fetch_assoc($result);
                    
                    // Obtener historial previo del paciente
                    $query_historial = "SELECT h.*, 
                                       DATE_FORMAT(c.fecha_cita, '%d/%m/%Y') as fecha
                                       FROM historial_medico h
                                       JOIN citas c ON h.id_cita = c.id
                                       WHERE h.paciente_id = {$cita['paciente_id']}
                                       ORDER BY c.fecha_cita DESC LIMIT 3";
                    
                    $result_historial = mysqli_query($conexion, $query_historial);
                    $historial_html = "";
                    
                    if($result_historial && mysqli_num_rows($result_historial) > 0) {
                        while($hist = mysqli_fetch_assoc($result_historial)) {
                            $historial_html .= "<div class='mb-2'>
                                                <strong>Fecha:</strong> {$hist['fecha']}<br>
                                                <strong>Diagnóstico:</strong> {$hist['diagnostico']}<br>
                                                <strong>Tratamiento:</strong> {$hist['tratamiento']}
                                              </div>";
                        }
                    } else {
                        $historial_html = "<p>No hay historial previo</p>";
                    }
                    
                    $cita['historial_html'] = $historial_html;
                    $response = $cita;
                } else {
                    $response = ['error' => 'Cita no encontrada'];
                }
                break;
    case 'historial':
        $id_paciente = $_GET['id'] ?? 0;
        
        // Obtener información del paciente
        $query_paciente = "SELECT 
            p.*,
            CONCAT(p.nombre, ' ', p.apellido) as nombre_completo
            FROM pacientes p 
            WHERE p.id = $id_paciente";
            
        $result_paciente = mysqli_query($conexion, $query_paciente);
        
        // Obtener historial de consultas
        $query_consultas = "SELECT 
            h.*,
            DATE_FORMAT(c.fecha_cita, '%d/%m/%Y') as fecha,
            CONCAT(e.nombre, ' ', e.apellido) as medico
            FROM historial_medico h
            JOIN citas c ON h.id_cita = c.id
            JOIN medicos m ON c.medico_id = m.id
            JOIN empleados e ON m.id_empleado = e.id
            WHERE h.paciente_id = $id_paciente
            ORDER BY c.fecha_cita DESC";
            
        $result_consultas = mysqli_query($conexion, $query_consultas);
        
        if($result_paciente && $result_consultas) {
            $paciente = mysqli_fetch_assoc($result_paciente);
            $consultas = [];
            
            while($consulta = mysqli_fetch_assoc($result_consultas)) {
                $consultas[] = [
                    'fecha' => $consulta['fecha'],
                    'diagnostico' => $consulta['diagnostico'],
                    'detalles' => $consulta['tratamiento'] . "\n" . $consulta['Receta'],
                    'medico' => $consulta['medico']
                ];
            }
            
            $response = [
                'paciente' => $paciente,
                'consultas' => $consultas
            ];
        } else {
            $response = ['error' => 'Error al obtener el historial'];
        }
        break;
    default:
        $response = ['error' => 'Acción no válida'];
        break;
}

header('Content-Type: application/json');
echo json_encode($response);
exit;

function obtenerContadorCitas($estado) {
    global $conexion, $id_medico;
    $query = "SELECT COUNT(*) as total FROM citas 
              WHERE medico_id = $id_medico AND estado = '$estado'";
    $result = mysqli_query($conexion, $query);
    return $result ? mysqli_fetch_assoc($result)['total'] : 0;
}
?>