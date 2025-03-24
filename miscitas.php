<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/miscitas.css">
    <link rel="stylesheet" href="./css/estilos.css">
</head>
<body>
    <?php require "./header.php"?>
    <div class="banner_cita">
        <div class="cita_logo">
            <img src="./img/logoClinica2.png" alt="">
        </div>
        <div class="cita_logo_text">
            <h2>MIS CITAS</h2>
        </div>
    </div>


    <div class="container d-flex justify-content-center flex-column">
        <div class="lista">
            <h3>LISTADO DE MIS CITAS</h3>
        </div>
        <div class="tabla overflow-scroll">
            <table class="table table-hover">
                <thead class=" table-dark">
                    <tr>
                        <th class="text-center">Nombre_Medico</th>
                        <th class="text-center">Fecha de la cita</th>
                        <th class="text-center">Hora</th>
                        <th class="text-center">Motivo</th>
                        <th class="text-center">Estado</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                        
                </tbody>
            </table>
        </div>
    </div>

    <script src="./js/all.js"></script>
    <script src="./js/bootstrap.js"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="./js/vercita.js"></script>
</body>
</html>