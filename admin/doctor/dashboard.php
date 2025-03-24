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
    <title>Dashboard</title>
    <?php require_once('./components/liks.php') ?>
</head>

<body>
    <input type="text" class="d-none" id="id_medico" value="<?php if (isset($_SESSION['id'])) echo $_SESSION['id_medico'] ?>">

    <div class="general d-flex col-sm-12 col-md-12">

        <?php include './components/sidebar.php'; ?>


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
                    <div class=" col-12 col-md-6 col-lg-4">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="card-title text-center">Total de pacientes</h5>
                                <div class=" w-100 d-flex align-items-center justify-content-center gap-3 ">
                                    <i class="fa-solid fa-user fs-3"></i>
                                    <span class="fs-3" id="tPaceintes"></span>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class=" col-12 col-md-6 col-lg-4">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="card-title text-center">Citas de hoy</h5>
                                <div class=" w-100 d-flex align-items-center justify-content-center gap-3 ">
                                    <i class="fa-solid fa-user fs-3"></i>
                                    <span class="fs-3" id="tCitasHoy"></span>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class=" col-12 col-md-6 col-lg-4">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="card-title text-center">Consultas realizadas</h5>
                                <div class=" w-100 d-flex align-items-center justify-content-center gap-3 ">
                                    <i class="fa-solid fa-user fs-3"></i>
                                    <span class="fs-3" id="tConsulRealizadas"></span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid mt-3 ms-2 ">
                <div class="row gap-3 justify-content-center">
                    <div class=" card col-11 col-md-6 col-lg-7">
                        <p class="h4 text-center">Grafica de pacientes atendidos</p>

                        <div style="width: 100%; height: 200px;">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>

                    <div class=" card col-11 col-md-6 col-lg-4">
                        <p class="h4 text-center">Tipos de citas</p>

                        <div style="width: 100%; height: 200px;">
                            <canvas id="myChartpie">

                            </canvas>
                        </div>
                    </div>
                </div>
            </div>


            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="card-title text-center">Citas de hoy</h5>
                                <div class="" style="max-height: 220px; overflow-y: auto;">
                                    <table class="table table-striped" style="color: #417b61;">
                                        <thead>
                                            <tr>
                                                <th scope="col">Paciente</th>
                                                <th scope="col">Hora</th>
                                                <th scope="col">Tipo</th>
                                                <th scope="col">Motivo</th>
                                            </tr>
                                        </thead>
                                        <tbody id="citas_hoy">

                                        </tbody>

                                    </table>
                                    <div class="" id="vacio">

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>



    </div>

    <?php include './components/sidebarResponsive.php'; ?>

    <?php require_once('./components/script.php') ?>





</body>

</html>