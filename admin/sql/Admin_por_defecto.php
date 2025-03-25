<?php
//EJECUTAR EL CODIGO SOLO UNA VEZ PARA CREAR EL ADMINISTRADOR POR DEFECTO
require_once('../config/conexion.php');

// Datos del administrador
$admin_email = 'admin@clinicabienestar.com';
$admin_password = 'admin123';
$hashed_password = password_hash($admin_password, PASSWORD_BCRYPT);

//roles por defecto
$roles = [
    "INSERT INTO rol (nombre) VALUES ('Administrador');",
    "INSERT INTO rol (nombre) VALUES ('Medico');",
    "INSERT INTO rol (nombre) VALUES ('Recepcionista');"
];

foreach ($roles as $index => $rolQuery) {
    mysqli_query($conexion, $rolQuery);
}

// Insertar empleado administrador
$query_empleado = "INSERT INTO empleados (perfil, nombre, apellido, telefono, nacionalidad, email, direccion, id_rol) 
VALUES ('Administrador', 'Admin', 'Sistema', '999999999', 'EcuatoGuineana', ?, 'Clínica Bienestar', 1)";

$stmt = mysqli_prepare($conexion, $query_empleado);
mysqli_stmt_bind_param($stmt, "s", $admin_email);
mysqli_stmt_execute($stmt);
$id_empleado = mysqli_insert_id($conexion);

// Insertar usuario administrador
$query_usuario = "INSERT INTO usuario (correo, passwd, estado, id_empleado) VALUES (?, ?, 1, ?)";
$stmt = mysqli_prepare($conexion, $query_usuario);
mysqli_stmt_bind_param($stmt, "ssi", $admin_email, $hashed_password, $id_empleado);
mysqli_stmt_execute($stmt);

// Datos del médico por defecto
$doctor_email = 'doctor@clinicabienestar.com';
$doctor_password = 'doctor123';
$doctor_hashed_password = password_hash($doctor_password, PASSWORD_BCRYPT);

// Insertar empleado médico
$query_doctor = "INSERT INTO empleados (perfil, nombre, apellido, telefono, nacionalidad, email, direccion, id_rol) 
VALUES ('Doctor', 'Juan', 'Médico', '888888888', 'EcuatoGuineana', ?, 'Clínica Bienestar', 2)";

$stmt = mysqli_prepare($conexion, $query_doctor);
mysqli_stmt_bind_param($stmt, "s", $doctor_email);
mysqli_stmt_execute($stmt);
$id_doctor_empleado = mysqli_insert_id($conexion);

// Insertar datos médicos específicos
$query_medico = "INSERT INTO medicos (especialidad, titulo_profesional, experiencia, idiomas, id_empleado) 
VALUES ('Oftalmología', 'Doctor en Medicina', 5, 'Español, Inglés', ?)";

$stmt = mysqli_prepare($conexion, $query_medico);
mysqli_stmt_bind_param($stmt, "i", $id_doctor_empleado);
mysqli_stmt_execute($stmt);

// Insertar usuario médico
$query_usuario = "INSERT INTO usuario (correo, passwd, estado, id_empleado) VALUES (?, ?, 1, ?)";
$stmt = mysqli_prepare($conexion, $query_usuario);
mysqli_stmt_bind_param($stmt, "ssi", $doctor_email, $doctor_hashed_password, $id_doctor_empleado);
mysqli_stmt_execute($stmt);

// Datos del recepcionista por defecto
$recep_email = 'recepcion@clinicabienestar.com';
$recep_password = 'recepcion123';
$recep_hashed_password = password_hash($recep_password, PASSWORD_BCRYPT);

// Insertar empleado recepcionista
$query_recep = "INSERT INTO empleados (perfil, nombre, apellido, telefono, nacionalidad, email, direccion, id_rol) 
VALUES ('Recepcionista', 'María', 'Recepción', '777777777', 'EcuatoGuineana', ?, 'Clínica Bienestar', 3)";

$stmt = mysqli_prepare($conexion, $query_recep);
mysqli_stmt_bind_param($stmt, "s", $recep_email);
mysqli_stmt_execute($stmt);
$id_recep = mysqli_insert_id($conexion);

// Insertar usuario recepcionista
$query_usuario = "INSERT INTO usuario (correo, passwd, estado, id_empleado) VALUES (?, ?, 1, ?)";
$stmt = mysqli_prepare($conexion, $query_usuario);
mysqli_stmt_bind_param($stmt, "ssi", $recep_email, $recep_hashed_password, $id_recep);

if (mysqli_stmt_execute($stmt)) {
    echo "<div style='
        background-color: #e8f5e9;
        border: 2px solid #4caf50;
        border-radius: 8px;
        padding: 20px;
        margin: 20px auto;
        max-width: 500px;
        text-align: center;
        font-family: Arial, sans-serif;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    '>";
    echo "<h2 style='color: #2e7d32; margin-bottom: 20px;'>¡Usuarios Creados Exitosamente! 🎉</h2>";
    echo "<div style='
        background-color: #fff;
        padding: 15px;
        border-radius: 6px;
        margin: 15px 0;
        border: 1px solid #a5d6a7;
    '>";
    echo "<h3 style='color: #1b5e20; margin-bottom: 15px;'>Datos de Acceso - Administrador</h3>";
    echo "<p style='color: #333; margin: 10px 0;'><strong>Email:</strong> <span style='color: #00796b;'>admin@clinicabienestar.com</span></p>";
    echo "<p style='color: #333; margin: 10px 0;'><strong>Contraseña:</strong> <span style='color: #00796b;'>admin123</span></p>";
    
    echo "<h3 style='color: #1b5e20; margin: 20px 0 15px;'>Datos de Acceso - Médico</h3>";
    echo "<p style='color: #333; margin: 10px 0;'><strong>Email:</strong> <span style='color: #00796b;'>doctor@clinicabienestar.com</span></p>";
    echo "<p style='color: #333; margin: 10px 0;'><strong>Contraseña:</strong> <span style='color: #00796b;'>doctor123</span></p>";
    
    echo "<h3 style='color: #1b5e20; margin: 20px 0 15px;'>Datos de Acceso - Recepcionista</h3>";
    echo "<p style='color: #333; margin: 10px 0;'><strong>Email:</strong> <span style='color: #00796b;'>recepcion@clinicabienestar.com</span></p>";
    echo "<p style='color: #333; margin: 10px 0;'><strong>Contraseña:</strong> <span style='color: #00796b;'>recepcion123</span></p>";
    echo "</div>";
    echo "<p style='color: #666; font-size: 0.9em; margin-top: 20px;'>Por favor, guarde estos datos en un lugar seguro y cámbielos después del primer inicio de sesión.</p>";
    echo "</div>";
    
    // Redirect after 15 seconds
    echo "<script>
        setTimeout(function() {
            window.location.href = '../../index.php';
        }, 15000);
    </script>";
} else {
    echo "Error al crear los usuarios: " . mysqli_error($conexion);
}

mysqli_close($conexion);
