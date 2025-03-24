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
    <title>Gestion de Empleados</title>
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
            <!-- Dentro del body, después de la sección de roles y antes de los scripts -->
            <div class="container mt-4">
                <!-- Sección de Gestión de Empleados -->
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-around mb-3">
                            <h2 class="text-center">Gestión de Empleados</h2>
                            <div class="text-center">
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalNuevoEmpleado">
                                    <i class="fa-solid fa-user-plus"></i> Nuevo Empleado
                                </button>
                            </div>
                        </div>

                        <table class="table table-striped table-hover">
                            <thead class="table-success">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Email</th>
                                    <th>Teléfono</th>
                                    <th>Rol Asignado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="tablaEmpleados">
                                <!-- Ejemplo de fila -->
                                <tr>
                                    <td>10</td>
                                    <td>María</td>
                                    <td> González</td>
                                    <td>maria@clinica.com</td>
                                    <td>555-1234</td>
                                    <td>Administrador</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditarEmpleado">
                                                <i class="fa-solid fa-pen"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal para Nuevo Empleado -->
            <div class="modal fade" id="modalNuevoEmpleado" tabindex="-1" aria-labelledby="modalNuevoEmpleadoLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title" id="modalNuevoEmpleadoLabel">Registrar Nuevo Empleado</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formNuevoEmpleado" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="perfil" class="form-label">Perfil</label>
                                        <input type="file" class="form-control" id="perfil" name="perfil">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nombreEmpleado" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="nombreEmpleado" name="nombre">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="apellidos" class="form-label">Apellidos</label>
                                        <input type="text" class="form-control" id="apellidos" name="apellidos">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="emailEmpleado" class="form-label">Correo Electrónico</label>
                                        <input type="email" class="form-control" id="emailEmpleado" name="correo">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="telefonoEmpleado" class="form-label">Teléfono</label>
                                        <input type="text" class="form-control" id="telefonoEmpleado" name="telefono">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="direccionEmpleado" class="form-label">Dirección</label>
                                        <input type="text" class="form-control" id="apellidos" name="direccion">

                                    </div>
                                    <div class="col-md-6">
                                        <label for="nacionalidad" class="form-label">Nacionalidad</label>
                                        <input type="text" class="form-control" id="nacionalidad" name="nacionalidad">

                                    </div>


                                    <div class="col-md-12">
                                        <label for="rolEmpleado" class="form-label">Rol del Sistema</label>
                                        <select class="form-select" id="rolEmpleado" name="rol">
                                            <option value="">Seleccionar Rol</option>

                                        </select>
                                    </div>
                                    <span class="h5 text-center">Datos del Medico</span>

                                    <div class="col-md-6">
                                        <label for="titulo" class="form-label">Titulo profesional</label>
                                        <input type="text" class="form-control" id="titulo" name="titulo">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="especialidad" class="form-label">Especialidad</label>
                                        <input type="text" class="form-control" id="especialidad" name="especialidad">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="anosExperiencia" class="form-label">Años de experiencia</label>
                                        <input type="text" class="form-control" id="anosExperiencia" name="anosExperiencia">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="idiomas" class="form-label">Idiomas</label>
                                        <input type="text" class="form-control" id="idiomas" name="idiomas">
                                    </div>




                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-success">Registrar Empleado</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal para Editar Empleado (similar al de agregar) -->
            <div class="modal fade" id="modalEditarEmpleado" tabindex="-1" aria-labelledby="modalEditarEmpleadoLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title" id="modalNuevoEmpleadoLabel">Registrar Nuevo Empleado</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formNuevoEmpleado" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="row g-3">
                                <input type="hidden" name="id" id="empleadoId">
                                    <div class="col-md-12">
                                        <label for="perfil" class="form-label">Perfil</label>
                                        <input type="file" class="form-control" id="perfil" name="perfil">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nombreEmpleado" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="nombreEmpleado" name="nombre">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="apellidos" class="form-label">Apellidos</label>
                                        <input type="text" class="form-control" id="apellidos" name="apellidos">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="emailEmpleado" class="form-label">Correo Electrónico</label>
                                        <input type="email" class="form-control" id="emailEmpleado" name="correo">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="telefonoEmpleado" class="form-label">Teléfono</label>
                                        <input type="text" class="form-control" id="telefonoEmpleado" name="telefono">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="direccionEmpleado" class="form-label">Dirección</label>
                                        <input type="text" class="form-control" id="apellidos" name="direccion">

                                    </div>
                                    <div class="col-md-6">
                                        <label for="nacionalidad" class="form-label">Nacionalidad</label>
                                        <input type="text" class="form-control" id="nacionalidad" name="nacionalidad">

                                    </div>


                                    <div class="col-md-12">
                                        <label for="rolEmpleado" class="form-label">Rol del Sistema</label>
                                        <select class="form-select" id="rolEmpleado" name="rol">
                                            <option value="">Seleccionar Rol</option>

                                        </select>
                                    </div>




                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-success">Registrar Empleado</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



            <?php include './components/sidebarResponsive.php'; ?>
            <?php require_once('./components/script.php') ?>
        </div>


</body>

</html>