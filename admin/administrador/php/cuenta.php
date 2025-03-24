<?php
session_start();
require_once('../../config/conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'])) {
    $response = array();
    
    if ($_POST['accion'] === 'actualizarCuenta') {
        $email = mysqli_real_escape_string($conexion, $_POST['email']);
        $passwordActual = $_POST['passwordActual'];
        $passwordNueva = $_POST['passwordNueva'];
        $id_empleado = $_SESSION['id'];
        
        // Verificar contraseña actual
        $query = "SELECT passwd FROM usuario WHERE id_empleado = ?";
        $stmt = mysqli_prepare($conexion, $query);
        mysqli_stmt_bind_param($stmt, "i", $id_empleado);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        $usuario = mysqli_fetch_assoc($resultado);
        
        if (password_verify($passwordActual, $usuario['passwd'])) {
            // Actualizar datos
            $passwordHash = password_hash($passwordNueva, PASSWORD_DEFAULT);
            $query = "UPDATE usuario SET correo = ?, passwd = ? WHERE id_empleado = ?";
            $stmt = mysqli_prepare($conexion, $query);
            mysqli_stmt_bind_param($stmt, "ssi", $email, $passwordHash, $id_empleado);
            
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['email'] = $email;
                $response['status'] = 'success';
                $response['message'] = 'Datos actualizados correctamente';
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Error al actualizar los datos';
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'La contraseña actual es incorrecta';
        }
    }
    
    echo json_encode($response);
} else {
    header('Location: ../dashboard.php');
}
?>