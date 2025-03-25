<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $asunto = $_POST['asunto'];
    $mensaje = $_POST['mensaje'];

    // Email recipient
    $para = "zabusimaoluy@gmail.com";

    // Email headers
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: $email" . "\r\n";
    $headers .= "Reply-To: $email" . "\r\n";

    // Email template
    $email_template = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; }
            .container { padding: 20px; }
            .header { background-color: #00a8cc; color: white; padding: 20px; }
            .content { padding: 20px; background-color: #f9f9f9; }
            .footer { padding: 20px; background-color: #f1f1f1; font-size: 12px; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h2>Nuevo Mensaje de Contacto - Clínica Bienestar</h2>
            </div>
            <div class='content'>
                <p><strong>Nombre:</strong> $nombre</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Asunto:</strong> $asunto</p>
                <p><strong>Mensaje:</strong></p>
                <p>$mensaje</p>
            </div>
            <div class='footer'>
                <p>Este mensaje fue enviado desde el formulario de contacto de Clínica Bienestar.</p>
                <p>© " . date('Y') . " Clínica Ocular Bienestar. Todos los derechos reservados.</p>
            </div>
        </div>
    </body>
    </html>
    ";

    // Send email
    if(mail($para, "Nuevo contacto: $asunto", $email_template, $headers)) {
        echo json_encode(['status' => 'success', 'message' => '¡Mensaje enviado correctamente!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al enviar el mensaje']);
    }
} else {
    header("Location: ../index.php");
    exit();
}
?>