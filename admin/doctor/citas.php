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
    <title>Dashboard Médico</title>
    <?php require_once('./components/liks.php') ?>
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
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="card-title text-center">Citas Pendientes</h5>
                                <div class="w-100 d-flex align-items-center justify-content-center gap-3 ">
                                    <i class="fa-solid fa-clock fs-3 text-warning"></i>
                                    <span class="fs-3">15</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="card-title text-center">Citas Atendidas</h5>
                                <div class="w-100 d-flex align-items-center justify-content-center gap-3 ">
                                    <i class="fa-solid fa-check-circle fs-3 text-black"></i>
                                    <span class="fs-3">89</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="card-title text-center">Solicitudes Nuevas</h5>
                                <div class="w-100 d-flex align-items-center justify-content-center gap-3 ">
                                    <i class="fa-solid fa-bell fs-3 text-primary"></i>
                                    <span class="fs-3">5</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid mt-3">
                <div class="row gap-3 justify-content-center">
                    <!-- Sección principal de citas con pestañas -->
                    <div class="col-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="pending-tab" data-bs-toggle="tab"
                                            data-bs-target="#pending" type="button" role="tab">
                                            Citas Pendientes
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="attended-tab" data-bs-toggle="tab"
                                            data-bs-target="#attended" type="button" role="tab">
                                            Citas Atendidas
                                        </button>
                                    </li>
                                </ul>

                                <div class="tab-content mt-3">
                                    <!-- Pestaña de Citas Pendientes -->
                                    <div class="tab-pane fade show active" id="pending" role="tabpanel">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Paciente</th>
                                                    <th>Fecha/Hora</th>
                                                    <th>Motivo</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>María González</td>
                                                    <td>2023-12-15 10:00</td>
                                                    <td>Control rutinario</td>
                                                    <td>
                                                    <td>
                                                        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalAtender">
                                                            <i class="fa-regular fa-calendar-check"></i> Atender
                                                        </button>
                                                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalDetalles">
                                                            <i class="fa-regular fa-eye"></i>
                                                        </button>
                                                    </td>
                                                    </td>
                                                </tr>
                                                <!-- Más filas -->
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Pestaña de Citas Atendidas -->
                                    <div class="tab-pane fade" id="attended" role="tabpanel">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Paciente</th>
                                                    <th>Fecha</th>
                                                    <th>Diagnóstico</th>
                                                    <th>Historial</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Juan Pérez</td>
                                                    <td>2023-12-14</td>
                                                    <td>Hipertensión controlada</td>
                                                    <td>
                                                    <td>
                                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalHistorial">
                                                            <i class="fa-regular fa-file-lines"></i>
                                                        </button>
                                                    </td>
                                                    </td>
                                                </tr>
                                                <!-- Más filas -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!-- Modal Atender Cita -->
    <div class="modal fade" id="modalAtender" tabindex="-1" aria-labelledby="modalAtenderLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="modalAtenderLabel"><i class="fa-solid fa-stethoscope me-2"></i>Atender Paciente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Update the form in modalAtender -->
                    <form id="formAtencion">
                        <input type="hidden" id="cita_id" name="cita_id">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Paciente</label>
                                <input type="text" class="form-control" id="paciente_nombre" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Fecha y Hora</label>
                                <input type="text" class="form-control" id="fecha_hora" readonly>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Diagnóstico</label>
                                <textarea class="form-control" name="diagnostico" rows="3" required></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tratamiento</label>
                                <textarea class="form-control" name="tratamiento" rows="3" required></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Receta</label>
                                <textarea class="form-control" name="receta" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success">Guardar Atención</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>

    <!-- Modal Ver Detalles -->
    <div class="modal fade" id="modalDetalles" tabindex="-1" aria-labelledby="modalDetallesLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="modalDetallesLabel"><i class="fa-solid fa-circle-info me-2"></i>Detalles de Cita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <dl class="row">
                        <dt class="col-sm-4">Paciente:</dt>
                        <dd id="nombrePaciente" class="col-sm-8">María González</dd>

                        <dt class="col-sm-4">Fecha/Hora:</dt>
                        <dd id="detalle_fecha" class="col-sm-8">2023-12-15 10:00</dd>

                        <dt class="col-sm-4">Motivo:</dt>
                        <dd id="detalle_motivo" class="col-sm-8">Control rutinario</dd>

                        <dt class="col-sm-4">Historial Médico:</dt>
                        <dd id="detalle_historial" class="col-sm-8">
                            <ul class="list-unstyled">
                                <li><span class="badge bg-primary">Última visita: 2023-11-10</span></li>
                                <li>Alergias: Ninguna registrada</li>
                                <li>Medicación actual: No especificada</li>
                            </ul>
                        </dd>
                    </dl>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ver Historial -->
    <div class="modal fade" id="modalHistorial" tabindex="-1" aria-labelledby="modalHistorialLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalHistorialLabel">
                        <i class="fa-solid fa-file-waveform me-2"></i>Historial Médico
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">Datos del Paciente</h6>
                                </div>
                                <div class="card-body">
                                    <input type="text" id="id_paciente" hidden>
                                    <p class="mb-1"><strong>Nombre:</strong> <span id="historial_nombre"></span></p>
                                    <p class="mb-1"><strong>Edad:</strong> <span id="historial_edad"></span> años</p>
                                    <p class="mb-1"><strong>Alergias:</strong> <span id="historial_alergias"></span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="timeline">
                                <!-- Timeline items will be dynamically inserted here by JavaScript -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="imprimirHistorial()">
                        <i class="fa-solid fa-print me-2"></i>Imprimir
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php include './components/sidebarResponsive.php'; ?>
    <?php require_once('./components/script.php') ?>

    <!-- Script para gráficos -->
    <script>
        // Código para inicializar gráficos (opcional)
        const ctx = document.getElementById('myChart');
        // ... Configuración de gráficos ...
    </script>

    <script src="./js/citas.js"></script>


</body>

</html>