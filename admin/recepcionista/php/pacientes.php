<?php
require_once('../config/conexion.php');
if (isset($_POST['accion']) && $_POST['accion'] == 'nuevoPaciente') {

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $sexo = $_POST['genero'];
    $fechaNacimiento = $_POST['fechaNacimiento'];
    $correo = $_POST['email'];
    $alergias = $_POST['alergias'];

    $sql = "SELECT * FROM rol where nombre ='Paciente'";
    $result = mysqli_query($conexion, $sql);
    $datosRol = mysqli_fetch_assoc($result);
    $rol_id = $datosRol['id'];
    $sql = "INSERT INTO pacientes (nombre, apellido, telefono, direccion, genero, fecha_nacimiento, email, id_rol, alergias) VALUES ('$nombre', '$apellido', '$telefono', '$direccion', '$sexo', '$fechaNacimiento', '$correo', '$rol_id', '$alergias')";
    $result = mysqli_query($conexion, $sql);
    if ($result) {
        echo 1;
    } else {
        echo 2;
    }
} else if (isset($_POST['accion']) && $_POST['accion'] == 'cargarPacientes') {

    $sql = "SELECT * FROM pacientes";
    $result = mysqli_query($conexion, $sql);
    $datos = array();
    while ($fila = mysqli_fetch_assoc($result)) {
        $datos[] = $fila;
    }
    echo json_encode($datos);
    mysqli_close($conexion);
} else if (isset($_POST['accion']) && $_POST['accion'] == 'traerMedicos') {

    $sql = "SELECT m.id, e.nombre, e.apellido, m.especialidad 
FROM medicos m 
INNER JOIN empleados e ON m.id_empleado= e.id;";
    $result = mysqli_query($conexion, $sql);
    $datos = array();
    while ($fila = mysqli_fetch_assoc($result)) {
        $datos[] = $fila;
    }
    echo json_encode($datos);
    mysqli_close($conexion);
}elseif (isset($_POST['accion']) && $_POST['accion'] == 'nuevaCita') {
    // Obtener los datos del formulario
    $paciente_id = $_POST['id_paciente'];
    $medico_id = $_POST['medico'];
    $tipo = $_POST['tipo'];
    $fecha_cita = $_POST['fecha'];
    $hora_cita = $_POST['hora'];
    $descripcion = $_POST['descripcion'];

    // Validar que la hora no sea después de las 15:30
    $hora_limite = strtotime('15:30');
    $hora_seleccionada = strtotime($hora_cita);

    if ($hora_seleccionada > $hora_limite) {
        echo json_encode(['status' => 'error', 'message' => 'No se pueden solicitar citas después de las 15:30']);
        exit;
    }

    // Verificar si el médico ya tiene una cita programada para el día y hora seleccionados
    $sql_verificar = "SELECT * FROM citas 
                      WHERE medico_id = '$medico_id' 
                        AND fecha_cita = '$fecha_cita' 
                        AND hora_cita = '$hora_cita'";
    $result_verificar = mysqli_query($conexion, $sql_verificar);

    if (mysqli_num_rows($result_verificar) > 0) {
        echo json_encode(['status' => 'error', 'message' => 'El médico ya tiene una cita programada para este día y hora']);
        exit;
    }

    // Insertar la cita en la base de datos
    $sql_insertar = "INSERT INTO citas (paciente_id, medico_id, tipo, fecha_cita, hora_cita, motivo) 
                     VALUES ('$paciente_id', '$medico_id', '$tipo', '$fecha_cita', '$hora_cita', '$descripcion')";
    $result_insertar = mysqli_query($conexion, $sql_insertar);

    if ($result_insertar) {
        echo json_encode(['status' => 'success', 'message' => 'Cita registrada correctamente']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al registrar la cita']);
    }
}else if (isset($_POST['accion']) && $_POST['accion'] == 'actualizarPaciente') {
    $id_paciente = $_POST['id_pacienteA'];
    $nombre = $_POST['nombreA'];
    $apellido = $_POST['apellidoA'];
    $fecha_nacimiento = $_POST['fechaNacimientoA'];
    $direccion = $_POST['direccionA'];
    $telefono = $_POST['telefonoA'];
    $email = $_POST['emailA'];
    $alergias = $_POST['alergiasA'];

    // Consulta para actualizar los datos del paciente
    $sql = "UPDATE pacientes 
            SET nombre = '$nombre', 
                apellido = '$apellido', 
                fecha_nacimiento = '$fecha_nacimiento', 
                direccion = '$direccion', 
                telefono = '$telefono', 
                email = '$email', 
                alergias = '$alergias' 
            WHERE id = '$id_paciente'";

    $result = mysqli_query($conexion, $sql);

    if ($result) {
        echo json_encode(['status' => 'success', 'message' => 'Paciente actualizado correctamente']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al actualizar el paciente']);
    }
}else if (isset($_POST['accion']) && $_POST['accion'] == 'datosPaciente') {
    $id_paciente = $_POST['id_paciente'];

    // Consulta para obtener los datos del paciente
    $sql = "SELECT * FROM pacientes WHERE id = '$id_paciente'";
    $result = mysqli_query($conexion, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $paciente = mysqli_fetch_assoc($result);
        echo json_encode(['status' => 'success', 'data' => $paciente]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No se encontró el paciente']);
    }
}
?>
