<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./css/estilos.css">
    <link rel="stylesheet" href="./css/all.css">
    <link rel="stylesheet" href="./css/bootstrap.css">
</head>
<body>

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
                    <i class="fa-solid fa-user"></i> Usuario
                </a>
                
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Perfil</a></li>
                    <li><a class="dropdown-item" href="#">Cuenta</a></li>
                    <li><a class="dropdown-item" href="#">Cerrar sesión</a></li>
                </ul>
            </div>
            </div>
        </div>
    </div>



</div>

<?php include './components/sidebarResponsive.php'; ?>


    

<script src="./js/all.js"></script>
<script src="./js/bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>