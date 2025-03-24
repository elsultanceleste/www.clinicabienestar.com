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
                    <a href="#" class="forgot-password">¿Olvidaste tu contraseña?</a>
                </div>
            </div>
        </div>
    </div>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./js/sweetalert2.js"></script>
    <script src="./js/login.js"></script>
</body>
</html>