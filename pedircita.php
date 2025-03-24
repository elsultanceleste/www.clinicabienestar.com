<?php

    // session_start();

    // $_SESSION['id_paciente'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="./css/all.css"> -->
    <link rel="stylesheet" href="./css/bootstrap.css">
    <!-- <link rel="stylesheet" href="./css/fontawesome.min.css"> -->
    <link rel="stylesheet" href="./css/pedircita.css">
    <link rel="stylesheet" href="./css/estilos.css">
    <link rel="stylesheet" href="./css/sweetalert2.css">
</head>
<body>
    <?php include "./header.php"?>

    <div class="banner_cita">
        <div class="cita_logo">
            <img src="./img/logoClinica2.png" alt="">
        </div>
        <div class="texto_grande">
            <h1>BIENVENIDOS!</h1>
        </div>
        <div class="subtexto">
            <h4>DÉJANOS TUS DATOS Y NOS PONDREMOS EN CONTACTO CONTIGO PARA CONCERTAR TU VISITA</h4>
        </div>
    </div>

    <div class="formul">
        <form class="informa" id="pedircita">
            <div class="soli">
                <h2>FORMULARIO DE SOLICITUD DE CITAS</h2>
            </div>
            <div class="nombre">
                <input name="id_paciente" class="form-control" type="hidden" value="<?php echo $_SESSION['id_paciente']?>" >
            </div>
            <div class="nombre">
                <input name="motivo" class="form-control" type="text" placeholder="Introduzca el motivo de la cita" >
            </div>

            <div class="contacto">

                <div class="telefono">
                    <select class="form-control cita" name="tipocita" id="" >
                        <option  value="">Seleccione el tipo de cita</option>
                        <option  value="Consulta">Consulta</option>
                        <option  value="Revision">Revision</option>
                        <option  value="Analisis">Analisis</option>
                    </select>
                </div>
                <div class="correo">
                    <select class="form-control" name="id_doctor" id="medico" >
                        <option value="">Seleccione su medico</option>
                    </select>
                </div>
            </div>
            <div class="contacto">

                <div class="telefono">
                    <input name="fecha" class="form-control" type="date" placeholder="Fecha_cita">
                </div>
                <div class="correo">
                    <input name="hora" class="form-control" type="time" placeholder="Hora_cita">
                </div>
            </div>

            <div class="enviar">
                <input name="enviar" type="submit" class="btn btn-success" value="Solicitar cita">
            </div>
        </form>
    </div>


    <script src="./js/all.js"></script>
    <script src="./js/bootstrap.js"></script>
    <script src="./js/sweetalert2.js"></script>
    <script src="./js/enviarcita.js"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
</body>
</html>