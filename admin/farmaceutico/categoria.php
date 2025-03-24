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
                <input class="buscarf col-8" type="text" placeholder="Buscar....">
                <input class="col-1 btn btn-success mx-1" type="submit">
            </div>
        </div>



    </div>

</div>
    <?php require( './components/footer.php'); ?>
</body>
</html>