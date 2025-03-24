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
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <?php require_once('./components/liks.php') ?>
    <link rel="stylesheet" href="./css/sweetalert2.css">
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
                                <h4 class="mb-0">Perfil Profesional</h4>
                            </div>
                            <div class="card-body">
                                <form id="formPerfil">
                                    <div class="mb-3">
                                        <label class="form-label">Nombre Completo</label>
                                        <input type="text" class="form-control" id="nombre" value="<?php echo $_SESSION['nombre'] . ' ' . $_SESSION['apellidos']; ?>" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Especialidad</label>
                                        <input type="text" class="form-control" id="especialidad" value="<?php echo $_SESSION['especialidad']; ?>" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Experiencia</label>
                                        <input class="form-control" type="text" id="experiencia">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Idiomas</label>
                                        <input type="text" class="form-control" id="idioma">
                                    </div>
                    
                                    <button type="submit" class="btn btn-success">Actualizar Perfil</button>
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
    <script src="./js/perfil.js"></script>
    <script src="./js/sweetalert2.js"></script>
</body>
</html>