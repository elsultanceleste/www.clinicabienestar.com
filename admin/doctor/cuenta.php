<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location:../');
}else if($_SESSION['rol'] == 'Administrador'){
    header('location:../administrador/dashboard.php');
    
}else if($_SESSION['rol'] == 'Recepcionista'){
    header('location:../recepcionista/dashboard.php');
}

?>

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuenta</title>
    <?php require_once('./components/liks.php') ?>
</head>
<body>
    <div class="general d-flex">
        <?php include './components/sidebar.php'; ?>
        <div class="main col-12 col-lg-9">

            <div class="container mt-4">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header bg-success text-white">
                                <h4 class="mb-0">Configuración de Cuenta</h4>
                            </div>
                            <div class="card-body">
                                <form id="formCuenta">
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" value="<?php echo $_SESSION['email']; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Contraseña Actual</label>
                                        <input type="password" class="form-control" id="passwordActual">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nueva Contraseña</label>
                                        <input type="password" class="form-control" id="passwordNueva">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Confirmar Contraseña</label>
                                        <input type="password" class="form-control" id="passwordConfirmar">
                                    </div>
                                    <button type="submit" class="btn btn-success">Actualizar Cuenta</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include './components/sidebarResponsive.php'; ?>
    </div>
    <?php require_once('./components/script.php') ?>
    <script src="./js/cuenta.js"></script>
</body>
</html>