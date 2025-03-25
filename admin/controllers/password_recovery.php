<?php
require_once('../config/conexion.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'send_code':
            $email = $_POST['email'];
            
            // Verify if email exists in database
            $query = "SELECT cod_usuario FROM usuario WHERE correo = ?";
            $stmt = mysqli_prepare($conexion, $query);
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                // Generate verification code
                $code = rand(100000, 999999);
                $_SESSION['recovery_code'] = $code;
                $_SESSION['recovery_email'] = $email;
                $_SESSION['code_timestamp'] = time();

                // Send email with verification code
                $to = $email;
                $subject = "Código de Recuperación de Contraseña";
                $message = "Su código de verificación es: " . $code;
                $headers = "From: noreply@clinicabienestar.com";

                if(mail($to, $subject, $message, $headers)) {
                    echo json_encode(['status' => 'success', 'message' => 'Código enviado']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Error al enviar el código']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Email no encontrado']);
            }
            break;

        case 'verify_code':
            $code = $_POST['code'];
            if (
                isset($_SESSION['recovery_code']) && 
                isset($_SESSION['code_timestamp']) && 
                $_SESSION['recovery_code'] == $code && 
                (time() - $_SESSION['code_timestamp']) < 600
            ) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Código inválido o expirado']);
            }
            break;

        case 'change_password':
            if (isset($_SESSION['recovery_email'])) {
                $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $email = $_SESSION['recovery_email'];

                $query = "UPDATE usuario SET passwd = ? WHERE correo = ?";
                $stmt = mysqli_prepare($conexion, $query);
                mysqli_stmt_bind_param($stmt, "ss", $new_password, $email);

                if (mysqli_stmt_execute($stmt)) {
                    // Clear recovery session data
                    unset($_SESSION['recovery_code']);
                    unset($_SESSION['recovery_email']);
                    unset($_SESSION['code_timestamp']);
                    
                    echo json_encode(['status' => 'success', 'message' => 'Contraseña actualizada']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Error al actualizar contraseña']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Sesión inválida']);
            }
            break;
    }
}
?>