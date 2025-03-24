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
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <?php include './components/estilos.php' ?>
</head>

<body>

    <div class="general d-flex col-sm-12 col-md-12">

        <?php include './components/sidebar.php'; ?>


        <div class="main col-12 col-lg-9" style=" max-height: 100vh; overflow-y: auto;">

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
                            <li><a class="dropdown-item" href="./cuenta.php">Cuenta</a></li>
                            <li><a class="dropdown-item" href="../php/cerrarSesion.php">Cerrar sesión</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- RESUMEN -->

            <div class="container">
                <div class="row">

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="card-title text-center">Pacientes</h5>
                                <div class="w-100 d-flex align-items-center justify-content-center gap-3">
                                    <i class="fa-solid fa-user fs-3"></i>
                                    <span class="fs-3" id="total_pacientes">0</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="card-title text-center">Citas totales</h5>
                                <div class="w-100 d-flex align-items-center justify-content-center gap-3">
                                    <i class="fa-solid fa-calendar-check fs-3"></i>
                                    <span class="fs-3" id="total_citas">0</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="card-title text-center">Citas Pendientes</h5>
                                <div class="w-100 d-flex align-items-center justify-content-center gap-3">
                                    <i class="fa-regular fa-calendar-check fs-3"></i>
                                    <span class="fs-3" id="citas_pendientes">0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card   mt-5 ms-4">
            <div style="width: 90%; margin: auto; padding: 20px;">
                <canvas id="myChart"></canvas>
            </div>
            </div>



            <!-- TABLA -->

            <div class="container w-100  mt-5 d-flex flex-column justify-content-center p-3">
                <p class="h4 w-100 text-center">CITAS DE HOY</p>
                <div class="table-responsive">
                    <table class="table table-striped-columns">
                        <thead class="text-center">
                            <tr class="table-">
                                <th class="bg-success text-white" scope="col">#</th>
                                <th class="bg-success text-white" scope="col">Nombre</th>
                                <th class="bg-success text-white" scope="col">Apellidos</th>
                                <th class="bg-success text-white" scope="col">Hora</th>
                                <th class="bg-success text-white" scope="col">Estado</th>
                                <th class="bg-success text-white" scope="col">Medico</th>
                                <th class="bg-success text-white" scope="col">Tipo</th>
                            </tr>
                        </thead>
                        <tbody class="text-center" id="tabla_citas">
                            <!-- Data will be inserted here dynamically -->
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>



    <!-- ASIDE-RESPONSIVE -->

    <?php include './components/sidebarResponsive.php'; ?>


    <!-- FOOTER -->
    <?php require('./components/footer.php'); ?>


</body>

</html>

<!-- Add this before closing body tag -->
<script>
function cargarDashboard() {
    fetch('./php/dashboard_data.php')
        .then(response => response.json())
        .then(data => {
            document.getElementById('total_pacientes').textContent = data.total_pacientes;
            document.getElementById('total_citas').textContent = data.total_citas;
            document.getElementById('citas_pendientes').textContent = data.citas_pendientes;

            const tablaCitas = document.getElementById('tabla_citas');
            tablaCitas.innerHTML = '';
            
            data.citas_hoy.forEach((cita, index) => {
                tablaCitas.innerHTML += `
                    <tr>
                        <th scope="row">${index + 1}</th>
                        <td>${cita.nombre}</td>
                        <td>${cita.apellido}</td>
                        <td>${cita.hora_cita}</td>
                        <td>${cita.estado}</td>
                        <td>${cita.medico}</td>
                        <td>${cita.tipo}</td>
                    </tr>
                `;
            });
        })
        .catch(error => console.error('Error:', error));
}

// Load data when page loads
document.addEventListener('DOMContentLoaded', cargarDashboard);

// Refresh data every 5 minutes
setInterval(cargarDashboard, 300000);
</script>