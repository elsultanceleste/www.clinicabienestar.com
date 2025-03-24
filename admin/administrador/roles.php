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
    <title>Gestión de Roles</title>
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
            <div class="container mt-4">
                <!-- Sección de Gestión de Roles -->
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-around mb-3">
                            <h2 class="text-center">Gestión de Roles</h2>
                            <div class="text-center">
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAgregarRol">
                                    <i class="fa-solid fa-plus"></i> Nuevo Rol
                                </button>
                            </div>
                        </div>

                        <table class="table table-striped table-hover">
                            <thead class="table-success">
                                <tr class="text-center">
                                    <th>ID</th>
                                    <th>Nombre del Rol</th>
                                    
                                </tr>
                            </thead>
                            <tbody id="tablaRol" class="text-center">
                                <!-- role -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal para Agregar Rol -->
            <div class="modal fade" id="modalAgregarRol" tabindex="-1" aria-labelledby="modalAgregarRolLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title" id="modalAgregarRolLabel">Nuevo Rol del Sistema</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formNuevoRol">
                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="nombreRol" class="form-label">Nombre del Rol</label>
                                        <input type="text" class="form-control" id="nombreRol" required name="rol">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-success">Guardar Rol</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal para Editar Rol (similar al de agregar) -->
            <div class="modal fade" id="modalEditarRol" tabindex="-1" aria-labelledby="modalEditarRolLabel" aria-hidden="true">
                <!-- Contenido similar al modal de agregar pero con datos precargados -->
            </div>

        </div>
    </div>
   

    <?php include './components/sidebarResponsive.php'; ?>
    <?php require_once('./components/script.php') ?>

</body>

</html>