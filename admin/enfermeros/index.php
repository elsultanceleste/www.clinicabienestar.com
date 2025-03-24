<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enfermero</title>
    <?php include './components/estilos.php'?>
</head>
<body>

<div class="general d-flex col-sm-12 col-md-12">

<?php include './components/sidebar.php'; ?>
<?php include './components/sidebarResponsive.php'; ?>

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
                    <i class="fa-solid fa-user"></i> Enfermeros
                </a>
                
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="./perfil.php">Perfil</a></li>
                    <li><a class="dropdown-item" href="./cuenta.php">Cuenta</a></li>
                    <li><a class="dropdown-item" href="#">Cerrar sesión</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- RESUMEN -->

    <div class="container">
        <div class="row">

            <div class=" col-12 col-md-6 col-lg-4">
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title text-center">Pacientes Ingresados</h5> 
                        <div class=" w-100 d-flex align-items-center justify-content-center gap-3 ">
                            <i class="fa-solid fa-user fs-3"></i>
                            <span class="fs-3">150</span>
                        </div>
                        
                    </div>
                </div>
            </div>
            
            <div class=" col-12 col-md-6 col-lg-4">
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title text-center">Total de Farmacos</h5> 
                        <div class=" w-100 d-flex align-items-center justify-content-center gap-3 ">
                        <i class="fa-solid fa-calendar-check fs-3"></i>
                            <span class="fs-3">15</span>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class=" col-12 col-md-6 col-lg-4">
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title text-center">Pacientes Atendidos</h5> 
                        <div class=" w-100 d-flex align-items-center justify-content-center gap-3 ">
                        <i class="fa-regular fa-calendar-check fs-3"></i>
                            <span class="fs-3">15</span>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

           <!-- GRAFICA -->
        <div class="grafica col-12 pt-3 d-flex justify-content-center flex-column">
            <div class="container">
                <h3 class="text-center">Pacientes atendidos por mes</h3>
            </div>
            <div class="container col-lg-10">
                <canvas id="grafica" class="graf" width="100" height="50"></canvas>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <?php require( './components/footer.php'); ?>
</body>
</html>