<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/sweetalert2.css">
    <link rel="stylesheet" href="./css/login.css">

</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 login-container">
              
                <img src="./img/logoClinica2.png" alt="Logo de la empresa" class="logo">

            
                <h2 class="text-center mb-4">Iniciar Sesión</h2>


                <form id="login" method="POST">
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="ejemplo@correo.com" required>
                    </div>

                    
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="********" required>
                    </div>

                    
                    <button type="submit" class="btn btn-primary w-100 btn-login">Iniciar Sesión</button>
                </form>

                <!-- Enlace para recuperar contraseña -->
                <div class="text-center mt-3">
                    <a href="#" class="forgot-password" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">¿Olvidaste tu contraseña?</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Forgot Password -->
    <div class="modal fade" id="forgotPasswordModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Recuperar Contraseña</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="forgotPasswordForm">
                        <div class="mb-3">
                            <label for="recovery_email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="recovery_email" name="recovery_email" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Enviar Código de Verificación</button>
                    </form>
                    
                    <form id="verificationForm" style="display: none;">
                        <div class="mb-3">
                            <label for="verification_code" class="form-label">Código de Verificación</label>
                            <input type="text" class="form-control" id="verification_code" name="verification_code" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Verificar Código</button>
                    </form>

                    <form id="newPasswordForm" style="display: none;">
                        <div class="mb-3">
                            <label for="new_password" class="form-label">Nueva Contraseña</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirmar Contraseña</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Cambiar Contraseña</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./js/sweetalert2.js"></script>
    <script src="./js/login.js"></script>
    <script src="./js/password_recovery.js"></script>
</body>
</html>