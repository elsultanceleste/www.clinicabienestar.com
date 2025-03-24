<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location:../');
}else if($_SESSION['rol'] == 'Medico'){
    header('location:../doctor/dashboard.php');
    
}else if($_SESSION['rol'] == 'Recepcionista'){
    header('location:../recepcionista/dashboard.php');
}


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    <?php require_once('./components/liks.php') ?>
</head>

<body>
    <div class="general d-flex col-sm-12 col-md-12">
        <?php include './components/sidebar.php'; ?>

        <div class="main col-12 col-lg-9">
            <!-- Encabezado -->
            <div class="header container b p-2 d-flex justify-content-between w-100 align-items-center col-12">
                <div class="btn-menu">
                    <button class="btn d-block d-lg-none" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
                        <i class="fa-solid fa-bars fs-2"></i>
                    </button>
                </div>

                <div class="user">
                    <div class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user"></i> Dr.<?php if (isset($_SESSION['nombre'])) echo $_SESSION['nombre'] ?>
                        </a>

                        <!-- Replace the dropdown menu items with: -->
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="./perfil.php">Perfil</a></li>
                            <li><a class="dropdown-item" href="./cuenta.php">Cuenta</a></li>
                            <li><a class="dropdown-item" href="../php/cerrarSesion.php">Cerrar sesión</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Tarjetas resumen -->
            <!-- Sección después de la gestión de empleados y antes de los scripts -->
            <div class="container mt-4">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2 class="mb-0">Gestión de Usuarios</h2>
                        </div>

                        <!-- Tabla de usuarios -->
                        <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                            <table class="table table-hover table-bordered text-center">
                                <thead class="table-success">
                                    <tr>
                                        <th>ID</th>
                                        <th>Usuario</th>
                                        <th>Nombre</th>
                                        <th>Rol</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tablaUsuarios">
                                    <!-- Ejemplo de fila -->
                                    <tr>
                                        <td>001</td>
                                        <td>admin</td>
                                        <td>Administrador Sistema</td>
                                        <td>admin@clinica.com</td>
                                        <td><span class="badge bg-danger">Administrador</span></td>
                                        <td><span class="badge bg-success">Activo</span></td>
                                        <td>
                                            <div class="form-check form-switch d-flex justify-content-center">
                                                <input class="form-check-input" type="checkbox" id="estadoUsuario" checked>

                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>





            <?php include './components/sidebarResponsive.php'; ?>
            <?php require_once('./components/script.php') ?>


</body>

</html>