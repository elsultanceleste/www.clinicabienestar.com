<?php
require_once('../config/conexion.php');

if ($_POST['accion'] == 'cargar') {
    $query = "SELECT 
    u.cod_usuario,
    u.correo,
    r.nombre AS rol,
    CASE 
        WHEN u.estado = 1 THEN 'Activo'
        WHEN u.estado = 0 THEN 'Inactivo'
        ELSE 'Desconocido'
    END AS estado,
    CASE 
        WHEN u.id_paciente IS NOT NULL THEN CONCAT(p.nombre, ' ', p.apellido)
        WHEN u.id_empleado IS NOT NULL THEN CONCAT(e.nombre, ' ', e.apellido)
        ELSE 'Sin propietario'
    END AS propietario
FROM 
    usuario u
LEFT JOIN pacientes p ON u.id_paciente = p.id
LEFT JOIN empleados e ON u.id_empleado = e.id
LEFT JOIN rol r ON (p.id_rol = r.id OR e.id_rol = r.id)";
    $result = mysqli_query($conexion, $query);
    $datos = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $datos[] = $row;
    }
    echo json_encode($datos);
    mysqli_close($conexion);
}elseif($_POST['accion'] == 'cambiarEstado'){

    $id = $_POST['cod_usuario'];
    $estado = $_POST['estado']=== 'Activo' ? 1 : 0;
    $query = "UPDATE usuario SET estado = $estado WHERE cod_usuario = $id";
    $result = mysqli_query($conexion, $query);
    if($result){
        echo 'El estado se ha cambiado correctamente';
    }else{
        echo 'Error al cambiar el estado';
    }
    mysqli_close($conexion);
}elseif($_POST['accion'] == 'regenerarContrasena') {
    $id = $_POST['cod_usuario'];
    $contraseña_plana = bin2hex(random_bytes(4));
    $contraseña_encriptada = password_hash($contraseña_plana, PASSWORD_DEFAULT);
    $query = "UPDATE usuario SET passwd = '$contraseña_encriptada' WHERE cod_usuario = $id";
    $result = mysqli_query($conexion, $query);
    
    if($result){
        $correo = $_POST['correo'];
        $nombre = $_POST['nombre'];
        $asunto = "Recuperación de contraseña";
                $para = $correo;
                $encabezado = "MIME-Version: 1.0\r\n";
                $encabezado .= "Content-type:text/html;charset=UTF-8\r\n";
                $encabezado .= "From: Clinica Bienestar <noreply@tuservidor.com>\r\n";
        
                $cuerpo = '
                <!DOCTYPE html>
                <html>
                <head>
                <meta charset="UTF-8">
                <title>Bienvenido</title>
                </head>
                <body style="margin: 0; padding: 0; background-color: #f1f1f1;">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #f1f1f1; padding: 20px;">
                    <tr>
                        <td align="center">
                            <table role="presentation" width="500" cellspacing="0" cellpadding="0" border="0" style="background-color: #ffffff; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); padding: 20px; text-align: center;">
                                <tr>
                                    <td>
                                        <h1>Bienvenido, ' . $nombre . '</h1>
                                        <p>Se le ha generado una nueva contraseña para acceder a la plataforma de la Clínica Bienestar</p>
                                        <p>
                                            <strong>Contraseña:</strong> ' . $contraseña_plana . '
                                        </p>
                                        <p>Esta sera su nueva contraseña, le recomendamos cambiarla una vez que ingrese al sistema.</p>
                                        <p>Para cualquier consulta, contáctanos.</p>
                                        <p style="margin-top: 20px; font-weight: bold;">Clinica Bienestar</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                </body>
                </html>
                ';
        
                if (mail($para, $asunto, $cuerpo, $encabezado)) {
                    echo json_encode(["estado" => "exitoso", "mensaje" => "Contraseña regenerada y correo enviado"]);
                } else {
                    echo json_encode(["estado" => "alerta", "mensaje" => "Se regeneró la contraseña, pero no se pudo enviar el correo"]);
                }
    }else {
        echo json_encode(["estado" => "alerta", "mensaje" => "Error al regenerar la contraseña"]);

    }

}
