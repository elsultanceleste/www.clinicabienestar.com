<?php
//EJECUTAR EL CODIGO SOLO UNA VEZ PARA CREAR EL ADMINISTRADOR POR DEFECTO
require_once('../config/conexion.php');

// Datos del administrador
$admin_email = 'admin@clinicabienestar.com';
$admin_password = 'admin123';
$hashed_password = password_hash($admin_password, PASSWORD_BCRYPT);
//rol por defecto
$rolPorDefecto = "INSERT INTO rol (nombre) VALUES ('Administrador');";
if (mysqli_query($conexion, $rolPorDefecto)) {
    // Insertar empleado
    $query_empleado = "INSERT INTO empleados (perfil, nombre, apellido, telefono, nacionalidad, email, direccion, id_rol) 
VALUES ('Administrador', 'Admin', 'Sistema', '999999999', 'EcuatoGuineana', ?, 'Clínica Bienestar', 1)";

    $stmt = mysqli_prepare($conexion, $query_empleado);
    mysqli_stmt_bind_param($stmt, "s", $admin_email);
    mysqli_stmt_execute($stmt);
    $id_empleado = mysqli_insert_id($conexion);

    // Insertar usuario
    $query_usuario = "INSERT INTO usuario (correo, passwd, estado, id_empleado) VALUES (?, ?, 1, ?)";
    $stmt = mysqli_prepare($conexion, $query_usuario);
    mysqli_stmt_bind_param($stmt, "ssi", $admin_email, $hashed_password, $id_empleado);

    if (mysqli_stmt_execute($stmt)) {
        echo "Administrador creado exitosamente\n";
        echo "Email: admin@clinicabienestar.com\n";
        echo "Contraseña: admin123";
    } else {
        echo "Error al crear el administrador: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
}
