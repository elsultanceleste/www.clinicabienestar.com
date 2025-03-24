<?php
    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="header_primer d-none d-lg-block">
        <div class="information">
           <div class="iconos">
                <span><i class="fa-solid fa-location-dot"></i>  Calle-Bata</span>
                <span><i class="fa-solid fa-envelope-open-text"></i>  ClinicaBienestar@gmail.com</span>
                <span><i class="fa-solid fa-phone"></i> +240 555605060</span>
           </div>
           <div class="admin <?php if(isset($_SESSION['id_paciente'])){
                        echo "d-none";
                        }else{
                            echo "d-block";
                        }?>">
                <a href="./login.php"><i class="fa-regular fa-circle-user"></i></a>
                <span>Login</span>
           </div>
        </div>
    </div>
    <header class="header">
        <div class="header_nav">
            <div class="logo">
                <img src="./img/logoClinica2.png" alt="">
                <h2 class=" d-none d-lg-block">CLINICA BIENESTAR</h2>
                <h4 class=" d-lg-none">CLINICA BIENESTAR</h4>
            </div>
            <div class="nav d-none d-lg-block">
                <nav>
                    <a href="./index.php">Inicio</a>
                    <a href="./sobre.php">Sobre Nosotros</a>
                    <a href="./equipo.php">Nuestro Equipo</a>
                    <a href="./contacto.php">Contacto</a>
                    <div class="dropdown ">
                        <a class="dropdown-toggle <?php if(isset($_SESSION['id_paciente'])){
                        echo "d-block";
                        }else{
                            echo "d-none";
                        }?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-gear"></i>
                        </a>

                        <ul class="dropdown-menu text-bg-dark">
                            <li class="lin"><a href="./pedircita.php" class="btn btn-primary dropdown-item" id="boton_cita">PEDIR CITA</a></li>
                            <li class="lin"><a href="./miscitas.php" class="btn btn-primary dropdown-item" id="boton_cita">Mis Citas</a></li>
                            <li class="lin"><a href="./php/sesiondes.php" class="btn btn-dark dropdown-item"><i class="fa-solid fa-arrow-right-from-bracket"></i>Cerrar Sesion</a></li>
                        </ul>
                    </div>    
                </nav>
            </div>

            <div class="hamburger-menu d-lg-none">
                <button class="btn btn-dark boton" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <div class="offcanvas offcanvas-start text-bg-success" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title fs-2" id="offcanvasMenuLabel">Menú</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <nav class="nav_menu">
                            <a href="./index.php" class="d-block mb-2">Inicio</a>
                            <a href="./sobre.php" class="d-block mb-2">Sobre Nosotros</a>
                            <a href="./equipo.php" class="d-block mb-2">Nuestro Equipo</a>
                            <a href="./contacto.php" class="d-block mb-2">Contacto</a>
                            <div class="dropdown">
                                <a class="dropdown-toggle <?php if(isset($_SESSION['id_paciente'])){ echo 'd-block'; }else{ echo 'd-none'; } ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-gear"></i> Opciones
                                </a>
                                <ul class="dropdown-menu text-bg-dark">
                                    <li class="lin"><a href="./pedircita.php" class="btn btn-primary dropdown-item" id="boton_cita">PEDIR CITA</a></li>
                                    <li class="lin"><a href="./miscitas.php" class="btn btn-primary dropdown-item" id="boton_cita">Mis Citas</a></li>
                                    <li class="lin"><a href="./php/sesiondes.php" class="btn btn-dark dropdown-item"><i class="fa-solid fa-arrow-right-from-bracket"></i>Cerrar Sesion</a></li>
                                </ul>
                            </div>
                            <div class="admin">
                                    <a href="./login.php"><i class="fa-regular fa-circle-user"></i></a>
                                    <span>Login</span>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    
</body>
</html>