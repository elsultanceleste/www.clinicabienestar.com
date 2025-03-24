<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                        <h5 class="card-title text-center">Total de Farmacos</h5> 
                        <div class=" w-100 d-flex align-items-center justify-content-center gap-3 ">
                            <i class="fa-solid fa-user fs-3"></i>
                            <span class="fs-3">1500</span>
                        </div>
                        
                    </div>
                </div>
            </div>
            
            <div class=" col-12 col-md-6 col-lg-4">
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title text-center">Farmacos vendidos</h5> 
                        <div class=" w-100 d-flex align-items-center justify-content-center gap-3 ">
                        <i class="fa-solid fa-calendar-check fs-3"></i>
                            <span class="fs-3">1000</span>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class=" col-12 col-md-6 col-lg-4">
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title text-center">Total de ventas</h5> 
                        <div class=" w-100 d-flex align-items-center justify-content-center gap-3 ">
                        <i class="fa-regular fa-calendar-check fs-3"></i>
                            <span class="fs-3">200</span>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

           <!-- GRAFICA -->
        <div class="grafica col-12 pt-3 d-flex justify-content-center flex-column">
            <div class="container">
                <h3 class="text-center">Ventas mensuales</h3>
            </div>
            <div class="container col-lg-10">
                <canvas id="farmacos" class="graf" width="100" height="40"></canvas>
            </div>
        </div>

        <!-- TABLA -->
         <div class="container  mt-4 table-responsive">
            <table class="table table-success table-striped">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Nombre del Farmaco</th>
                        <th class="text-center">Tipo</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">Precio</th>
                        <th class="text-center">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">1</td>
                        <td class="text-center">Aspirina</td>
                        <td class="text-center">Analgesico</td>
                        <td class="text-center">100</td>
                        <td class="text-center">$50.00</td>
                        <td class="text-center">$5000.00</td>
                    </tr>

                </tbody>
            </table>
         </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</div>
    <?php require( './components/footer.php'); ?>
</body>
</html>