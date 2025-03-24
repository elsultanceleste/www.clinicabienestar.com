<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location:../');
}else if($_SESSION['rol'] == 'administrador'){
    header('location:../administrador/dashboard.php');
    
}else if($_SESSION['rol'] == 'Medico'){
    header('location:../doctor/dashboard.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pacientes</title>
    <?php include './components/estilos.php' ?>



</head>

<body>

    <div class="general d-flex col-sm-12 col-md-12">

        <?php include './components/sidebar.php'; ?>


        <div class="main col-12 col-lg-9 ">

            <!-- HEADER -->

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

            <!-- RESUMEN -->

            <div class="container">
                <div class="row d-flex justify-content-center">

                    <div class="col-9 ">
                        <form action="" method="post">
                            <input id="buscarPaciente" type="text" placeholder="Buscar cita..." class="form-control">
                        </form>
                    </div>
                </div>
            </div>


            <!-- TABLA -->

            <div class="container w-100  mt-5 d-flex flex-column justify-content-center p-3">
                <p class="h4 w-100 text-center mb-5">Pacientes y Citas</p>


                <div class="col-12">
                    <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalPaciente">Nuevo paciente</a>
                </div>
                <div class="table-responsive mt-5 fs-6 ">
                    <table class="table table-striped-columns ">
                        <thead class="text-center">
                            <tr>

                                <th class="bg-success text-white" scope="col">#</th>
                                <th class="bg-success text-white" scope="col">Nombre</th>
                                <th class="bg-success text-white" scope="col">Apellidos</th>
                                <th class="bg-success text-white" scope="col">Fecha de nacimiento</th>
                                <th class="bg-success text-white" scope="col">Direccion</th>
                                <th class="bg-success text-white" scope="col">Alergias</th>
                                <th class="bg-success text-white" scope="col">Contacto</th>
                                <th class="bg-success text-white" scope="col">Genero</th>
                                <th class="bg-success text-white" scope="col">Acciones</th>

                            </tr>
                        </thead>
                        <tbody class="text-center" id="tablaPacientes">
                            <tr>
                                <th scope="row">1</th>
                                <td>Zabulon</td>
                                <td>Sima Oluy</td>
                                <td>32 años</td>
                                <td>22212345</td>
                                <td>12-12-2024</td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-primary"><i class="fa-solid fa-book-medical"></i></a>
                                        <a class="btn btn-success"><i class="fa-solid fa-hospital-user"></i></a>
                                        <a class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalCita"><i class="fa-solid fa-calendar"></i></a>
                                    </div>
                                </td>

                            </tr>

                            <tr>
                                <th scope="row">1</th>
                                <td>Zabulon</td>
                                <td>Sima Oluy</td>
                                <td>32 años</td>
                                <td>22212345</td>
                                <td>12-12-2024</td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-primary"><i class="fa-solid fa-book-medical"></i></a>
                                        <a class="btn btn-success"><i class="fa-solid fa-hospital-user"></i></a>
                                        <a class="btn btn-dark"><i class="fa-solid fa-calendar"></i></a>
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <th scope="row">1</th>
                                <td>Zabulon</td>
                                <td>Sima Oluy</td>
                                <td>32 años</td>
                                <td>22212345</td>
                                <td>12-12-2024</td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-primary"><i class="fa-solid fa-book-medical"></i></a>
                                        <a class="btn btn-success"><i class="fa-solid fa-hospital-user"></i></a>
                                        <a class="btn btn-dark"><i class="fa-solid fa-calendar"></i></a>
                                    </div>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>



            <!-- ASIDE-RESPONSIVE -->

            <?php include './components/sidebarResponsive.php'; ?>


            <!-- FOOTER -->
            <?php require('./components/footer.php'); ?>

            <div class="modal fade" id="modalPaciente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo paciente</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="nuevoPaciente">
                                <div class="mb-3">
                                    <label for="paciente" class="form-label">Nombre </label>
                                    <input type="text" class="form-control" id="paciente" name="nombre">
                                </div>
                                <div class="mb-3">
                                    <label for="apellidos" class="form-label">Apellidos</label>
                                    <input type="text" class="form-control" id="apellidos" name="apellido">
                                </div>
                                <div class="mb-3">
                                    <label for="edad" class="form-label">Fecha de nacimiento</label>
                                    <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento">
                                </div>

                                <div class="mb-3">
                                    <label for="telefono" class="form-label">Telefono</label>
                                    <input type="number" class="form-control" id="telefono" name="telefono">

                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Opcional">

                                </div>

                                <div class="mb-3">
                                    <label for="direccion" class="form-label">Direccion</label>
                                    <input type="text" class="form-control" id="direccion" name="direccion">

                                </div>

                                <div class="mb-3">
                                    <label for="medico" class="form-label">Alergias</label>
                                    <Textarea class="form-control" name="alergias" id="alergias"></Textarea>
                                </div>


                                <div class="mb-3">
                                    <label for="genero" class="form-label">Genero</label>

                                    <div class="generos">
                                        <input class="form-check-input" type="radio" name="genero" id="masculino" value="Masculino">
                                        <label class="form-check-label" for="masculino">Masculino</label>
                                        <input class="form-check-input" type="radio" name="genero" id="femenino" value="Femenino">
                                        <label class="form-check-label" for="femenino">Femenino</label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn guardar">Registar Paciente</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cerrar</button>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalActualizarPaciente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar paciente</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="actualizarPaciente">
                                <input type="hidden" id="id_pacienteA" name="id_pacienteA">
                                <div class="mb-3">
                                    <label for="paciente" class="form-label">Nombre </label>
                                    <input type="text" class="form-control" id="nombreA" name="nombreA">
                                </div>
                                <div class="mb-3">
                                    <label for="apellidos" class="form-label">Apellidos</label>
                                    <input type="text" class="form-control" id="apellidoA" name="apellidoA">
                                </div>
                                <div class="mb-3">
                                    <label for="edad" class="form-label">Fecha de nacimiento</label>
                                    <input type="date" class="form-control" id="fechaNacimientoA" name="fechaNacimientoA">
                                </div>

                                <div class="mb-3">
                                    <label for="telefono" class="form-label">Telefono</label>
                                    <input type="number" class="form-control" id="telefonoA" name="telefonoA">

                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="emailA" name="emailA" placeholder="Opcional">

                                </div>

                                <div class="mb-3">
                                    <label for="direccion" class="form-label">Direccion</label>
                                    <input type="text" class="form-control" id="direccionA" name="direccionA">

                                </div>

                                <div class="mb-3">
                                    <label for="medico" class="form-label">Alergias</label>
                                    <Textarea class="form-control" name="alergiasA" id="alergiasA"></Textarea>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn guardar">Guardar cambios</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cerrar</button>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal fade" id="modalCita" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Cita</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formCita" method="post">
                                <div class="mb-3">
                                    <input type="text" class="form-control d-none" id="id_paciente" name="id_paciente">
                                </div>
                                <div class="mb-3">
                                    <label for="medico" class="form-label">Medico</label>
                                    <select name="medico" id="medico" class="form-control">
                                        <option value="">Selecionar doctor</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="tipo" class="form-label">Tipo</label>
                                    <select name="tipo" id="tipo" class="form-control">
                                        <option value="">Seleccione el tipo de cita</option>
                                        <option value="Consulta">Consulta</option>
                                        <option value="Analisis">Analisis</option>
                                        <option value="Revision">Revision</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="hora" class="form-label">Dia</label>
                                    <input type="date" class="form-control" id="hora" name="fecha">
                                </div>
                                <div class="mb-3">
                                    <label for="hora" class="form-label">Hora</label>
                                    <input type="time" class="form-control" id="hora" name="hora">
                                </div>

                                <div class="mb-3">
                                    <label for="descripcion" class="form-label">Descripcion</label>
                                    <textarea name="descripcion" class="form-control" id="descripcion"></textarea>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn guardar">Agregar cita</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cerrar</button>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/pacientes.js"></script>


</body>

</html>