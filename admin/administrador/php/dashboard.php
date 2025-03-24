<?php
require_once('../config/conexion.php');

$accion = $_GET['accion'] ?? '';

switch($accion) {
    case 'conteos':
        $response = [
            'empleados' => obtenerTotalEmpleados(),
            'pacientes' => obtenerTotalPacientes(),
            'usuarios' => obtenerTotalUsuarios()
        ];
        break;
    case 'roles':
        $response = obtenerRoles();
        break;
    case 'medicos':
        $response = obtenerMedicos();
        break;
    case 'pacientes_genero':
        $response = obtenerPacientesPorGenero();
        break;
        case 'obtener_medico':
            $id = $_GET['id'] ?? 0;
            $response = obtenerMedicoPorId($id);
            break;
        case 'actualizar_medico':
            $response = actualizarMedico($_POST);
            break;
}

// Add these new functions
function obtenerMedicoPorId($id) {
    global $conexion;
    $id = mysqli_real_escape_string($conexion, $id);
    $query = "SELECT * FROM medicos WHERE id = $id";
    $result = mysqli_query($conexion, $query);
    return mysqli_fetch_assoc($result);
}

function actualizarMedico($datos) {
    global $conexion;
    $id = mysqli_real_escape_string($conexion, $datos['medico_id']);
    $especialidad = mysqli_real_escape_string($conexion, $datos['especialidad']);
    $titulo = mysqli_real_escape_string($conexion, $datos['titulo_profesional']);
    $experiencia = mysqli_real_escape_string($conexion, $datos['experiencia']);
    $idiomas = mysqli_real_escape_string($conexion, $datos['idiomas']);
    
    $query = "UPDATE medicos SET 
              especialidad = '$especialidad',
              titulo_profesional = '$titulo',
              experiencia = $experiencia,
              idiomas = '$idiomas'
              WHERE id = $id";
              
    $result = mysqli_query($conexion, $query);
    return ['success' => $result];
}

echo json_encode($response);

function obtenerTotalEmpleados() {
    global $conexion;
    $query = "SELECT COUNT(*) as total FROM empleados";
    $result = mysqli_query($conexion, $query);
    return mysqli_fetch_assoc($result)['total'];
}

function obtenerTotalPacientes() {
    global $conexion;
    $query = "SELECT COUNT(*) as total FROM pacientes";
    $result = mysqli_query($conexion, $query);
    return mysqli_fetch_assoc($result)['total'];
}

function obtenerTotalUsuarios() {
    global $conexion;
    $query = "SELECT COUNT(*) as total FROM usuario";
    $result = mysqli_query($conexion, $query);
    return mysqli_fetch_assoc($result)['total'];
}

function obtenerRoles() {
    global $conexion;
    $query = "SELECT r.nombre, COUNT(CASE 
                WHEN p.id IS NOT NULL THEN 1 
                WHEN e.id IS NOT NULL THEN 1 
                END) as cantidad
              FROM rol r
              LEFT JOIN pacientes p ON r.id = p.id_rol
              LEFT JOIN empleados e ON r.id = e.id_rol
              GROUP BY r.id, r.nombre";
    $result = mysqli_query($conexion, $query);
    $roles = [];
    while($row = mysqli_fetch_assoc($result)) {
        $roles[] = $row;
    }
    return $roles;
}

function obtenerMedicos() {
    global $conexion;
    $query = "SELECT e.nombre, e.apellido, m.especialidad, m.id 
              FROM medicos m 
              JOIN empleados e ON m.id_empleado = e.id";
    $result = mysqli_query($conexion, $query);
    $medicos = [];
    while($row = mysqli_fetch_assoc($result)) {
        $medicos[] = $row;
    }
    return $medicos;
}

function obtenerPacientesPorGenero() {
    global $conexion;
    $query = "SELECT 
        CASE 
            WHEN u.id_paciente IS NOT NULL THEN 'Paciente con cuenta'
            ELSE 'Paciente sin cuenta'
        END as estado,
        COUNT(*) as total
    FROM pacientes p
    LEFT JOIN usuario u ON p.id = u.id_paciente
    GROUP BY 
        CASE 
            WHEN u.id_paciente IS NOT NULL THEN 'Paciente con cuenta'
            ELSE ' Paciente sin cuenta'
        END";
    $result = mysqli_query($conexion, $query);
    $generos = [];
    while($row = mysqli_fetch_assoc($result)) {
        $generos[] = $row;
    }
    return $generos;
}