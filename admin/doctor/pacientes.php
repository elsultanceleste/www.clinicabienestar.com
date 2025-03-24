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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paciente</title>
    <?php require_once('./components/liks.php') ?>
</head>

<body>

    <div class="general d-flex col-sm-12 col-md-12">
        <?php require_once('./components/sidebar.php') ?>
        <?php require_once('./components/sidebarResponsive.php') ?>
        <div class="main col-12 col-lg-9 ">
            <div class="header container b p-2 d-flex justify-content-between w-100 align-items-center col-12 ">
                <div class="btn-menu">
                    <button class="btn d-block d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
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

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="text-center">Pacientes</h1>
                    </div>

                    <div class="col-12">
                        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                            <table class="table table-striped table-hover">
                                <thead class="table-success">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Apellidos</th>
                                        <th scope="col">Edad</th>
                                        <th scope="col">Sexo</th>
                                        <th scope="col">Dirección</th>
                                        <th scope="col">Teléfono</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <!-- Add this before closing body tag -->
                                
                                <!-- Update the table body to be empty initially -->
                                <tbody>
                                    <!-- Data will be loaded dynamically -->
                                </tbody>
                                
                            </table>
                        </div>
                    </div>

                    <!-- modal para ver Historial del paciente  -->
                    <div class="modal fade" id="modalHistorial" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Historial del Paciente</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Aquí irá el contenido del modal -->
                                    <!-- Update the modal table structure -->
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Fecha</th>
                                                <th>Diagnóstico</th>
                                                <th>Tratamiento</th>
                                                <th>Receta</th>
                                                <th>PDF</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Data will be loaded dynamically -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once('./components/script.php') ?>
    <script src="./js/pacientes.js"></script>



</body>

</html>