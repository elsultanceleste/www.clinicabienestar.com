<?php
require("../config/conexion.php");

// Inicialización de variables
$correo = isset($_POST['email']) ? trim($_POST['email']) : '';
$passwd = isset($_POST['password']) ? trim($_POST['password']) : '';

// Validar que se hayan enviado los datos necesarios
if (empty($correo) || empty($passwd)) {
    echo 101; // Error: Faltan datos requeridos
    exit;
}


// Preparar consulta para buscar el usuario por correo electrónico
$query = "SELECT * FROM usuario WHERE correo = ?";
$stmt = mysqli_prepare($conexion, $query);
mysqli_stmt_bind_param($stmt, "s", $correo);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($resultado) > 0) {
    $dato = mysqli_fetch_assoc($resultado);

    // Verificar si la contraseña coincide con el hash almacenado
    if (password_verify($passwd, $dato['passwd'])) {
        //verificar estad 
        if ($dato['estado'] == 1) {
            $id_empleado = $dato['id_empleado'];
            $query = "SELECT e.id, e.nombre, e.apellido, e.email,  r.nombre as rol
            from empleados e 
            INNER JOIN rol r ON e.id_rol = r.id
            WHERE e.id='$id_empleado';";
            $stmt = mysqli_prepare($conexion, $query);
            mysqli_stmt_execute($stmt);
            $datos = mysqli_stmt_get_result($stmt);
            $datosEmpleado = mysqli_fetch_assoc($datos);
            session_start();
            $_SESSION['id'] = $id_empleado;
            $_SESSION['nombre'] = $datosEmpleado['nombre'];
            $_SESSION['rol'] = $datosEmpleado['rol'];
            $_SESSION['apellidos'] = $datosEmpleado['apellido'];
            $_SESSION['email'] = $datosEmpleado['email'];
            if ($_SESSION['rol'] =='Administrador') {
                echo 1;
            }else if ($_SESSION['rol']=='Medico') {
                $query ="SELECT id, especialidad FROM medicos WHERE id_empleado = '$id_empleado'";
                $stmt = mysqli_prepare($conexion, $query);
                mysqli_stmt_execute($stmt);
                $datos = mysqli_stmt_get_result($stmt);
                $datosMedico = mysqli_fetch_assoc($datos);
                $_SESSION['id_medico'] = $datosMedico['id'];
                $_SESSION['especialidad'] = $datosMedico['especialidad'];
                echo 2;
            }else if ($_SESSION['rol']=='Recepcionista'){
                echo 3;
            }
        } else {
            echo 102; // Error: Usuario inactivo
        }
    } else {
        echo 100; // Error: Contraseña incorrecta
    }
} else {
    echo 111; // Error: Usuario no encontrado
}

// Cerrar la conexión
mysqli_close($conexion);
