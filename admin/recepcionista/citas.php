<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location:../');
}else if($_SESSION['rol'] == 'Administrador'){
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
    <title>Citas</title>
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
                            <i class="fa-solid fa-user"></i> Sr. <?php if (isset($_SESSION['nombre'])) echo $_SESSION['nombre'] ?>
                        </a>

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
                            <input type="text" placeholder="Buscar cita..." class="form-control">
                        </form>
                    </div>
                </div>
            </div>

            <!-- TABLA -->

            <div class="container w-100  mt-5 d-flex flex-column justify-content-center p-3">
                <p class="h4 w-100 text-center">CITAS</p>


                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-striped-columns">
                        <thead class="text-center">
                            <tr>

                                <th class="bg-success text-white" scope="col">#</th>
                                <th class="bg-success text-white" scope="col">Nombre</th>
                                <th class="bg-success text-white" scope="col">Apellidos</th>
                                <th class="bg-success text-white" scope="col">Fecha</th>
                                <th class="bg-success text-white" scope="col">Hora</th>
                                <th class="bg-success text-white" scope="col">Estado</th>
                                <th class="bg-success text-white" scope="col">Medico</th>
                                <th class="bg-success text-white" scope="col">decripcion</th>

                            </tr>
                        </thead>
                        <tbody class="text-center" id="tabla-citas">
                            <tr>
                                <th scope="row">1</th>
                                <td>Zabulon</td>
                                <td>Sima Oluy</td>
                                <td>2025-02-03</td>
                                <td>12:30</td>
                                <td>En espera</td>
                                <td>Dr. Rafael</td>
                                <td>
                                    Lorem, ipsum dolor sit
                                    amet consectetur adipisicing elit.
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">1</th>
                                <td>Zabulon</td>
                                <td>Sima Oluy</td>
                                <td>2025-02-03</td>
                                <td>12:30</td>
                                <td>En espera</td>
                                <td>Dr. Rafael</td>
                                <td>
                                    Lorem, ipsum dolor sit
                                    amet consectetur adipisicing elit.
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">1</th>
                                <td>Zabulon</td>
                                <td>Sima Oluy</td>
                                <td>2025-02-03</td>
                                <td>12:30</td>
                                <td>En espera</td>
                                <td>Dr. Rafael</td>
                                <td>
                                    Lorem, ipsum dolor sit
                                    amet consectetur adipisicing elit.
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">1</th>
                                <td>Zabulon</td>
                                <td>Sima Oluy</td>
                                <td>2025-02-03</td>
                                <td>12:30</td>
                                <td>En espera</td>
                                <td>Dr. Rafael</td>
                                <td>
                                    Lorem, ipsum dolor sit
                                    amet consectetur adipisicing elit.
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">1</th>
                                <td>Zabulon</td>
                                <td>Sima Oluy</td>
                                <td>2025-02-03</td>
                                <td>12:30</td>
                                <td>En espera</td>
                                <td>Dr. Rafael</td>
                                <td>
                                    Lorem, ipsum dolor sit
                                    amet consectetur adipisicing elit.
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">1</th>
                                <td>Zabulon</td>
                                <td>Sima Oluy</td>
                                <td>2025-02-03</td>
                                <td>12:30</td>
                                <td>En espera</td>
                                <td>Dr. Rafael</td>
                                <td>
                                    Lorem, ipsum dolor sit
                                    amet consectetur adipisicing elit.
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">1</th>
                                <td>Zabulon</td>
                                <td>Sima Oluy</td>
                                <td>2025-02-03</td>
                                <td>12:30</td>
                                <td>En espera</td>
                                <td>Dr. Rafael</td>
                                <td>
                                    Lorem, ipsum dolor sit
                                    amet consectetur adipisicing elit.
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">1</th>
                                <td>Zabulon</td>
                                <td>Sima Oluy</td>
                                <td>2025-02-03</td>
                                <td>12:30</td>
                                <td>En espera</td>
                                <td>Dr. Rafael</td>
                                <td>
                                    Lorem, ipsum dolor sit
                                    amet consectetur adipisicing elit.
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">1</th>
                                <td>Zabulon</td>
                                <td>Sima Oluy</td>
                                <td>2025-02-03</td>
                                <td>12:30</td>
                                <td>En espera</td>
                                <td>Dr. Rafael</td>
                                <td>
                                    Lorem, ipsum dolor sit
                                    amet consectetur adipisicing elit.
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">1</th>
                                <td>Zabulon</td>
                                <td>Sima Oluy</td>
                                <td>2025-02-03</td>
                                <td>12:30</td>
                                <td>En espera</td>
                                <td>Dr. Rafael</td>
                                <td>
                                    Lorem, ipsum dolor sit
                                    amet consectetur adipisicing elit.
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">1</th>
                                <td>Zabulon</td>
                                <td>Sima Oluy</td>
                                <td>2025-02-03</td>
                                <td>12:30</td>
                                <td>En espera</td>
                                <td>Dr. Rafael</td>
                                <td>
                                    Lorem, ipsum dolor sit
                                    amet consectetur adipisicing elit.
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

            <script src="./js/citas.js"></script>
        </div>
    </div>



</body>

</html>