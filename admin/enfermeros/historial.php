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
            <div class="col-12 d-flex justify-content-center mt-4">
                <input class="col-8 buscar" type="text" placeholder="Buscar....">
                <input class="col-1 mx-1 btn btn-success" type="submit" >
            </div>
        </div>

           <!-- GRAFICA -->
        <div class="grafica col-12 pt-3 d-flex justify-content-center flex-column mt-4">
            <div class="container">
                <h3 class="text-center">Historial de los pacientes</h3>
            </div>
            <div class="container table-responsive">
                <table class="table mt-3 table-success table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Edad</th>
                            <th>Sexo</th>
                            <th>Dirección</th>
                            <th>Fecha Retiro</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Juan</td>
                            <td>Perez</td>
                            <td>25</td>
                            <td>Masculino</td>
                            <td>Ukomba</td>
                            <td>09-01-2025</td>
                            <td>
                                <i class="bi bi-trash3-fill"></i>
                                <i class="bi bi-pencil-square"></i>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Juan</td>
                            <td>Perez</td>
                            <td>25</td>
                            <td>Masculino</td>
                            <td>Ukomba</td>
                            <td>09-01-2025</td>
                            <td>
                                <i class="bi bi-trash3-fill"></i>
                                <i class="bi bi-pencil-square"></i>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Juan</td>
                            <td>Perez</td>
                            <td>25</td>
                            <td>Masculino</td>
                            <td>Ukomba</td>
                            <td>09-01-2025</td>
                            <td>
                                <i class="bi bi-trash3-fill"></i>
                                <i class="bi bi-pencil-square"></i>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Juan</td>
                            <td>Perez</td>
                            <td>25</td>
                            <td>Masculino</td>
                            <td>Ukomba</td>
                            <td>09-01-2025</td>
                            <td>
                                <i class="bi bi-trash3-fill"></i>
                                <i class="bi bi-pencil-square"></i>
                            </td>
                        </tr>
                </table>
            </div>
        </div>
    </div>

    <?php require( './components/footer.php'); ?>
</body>
</html>