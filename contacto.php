<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="./css/all.css"> -->
    <link rel="stylesheet" href="./css/bootstrap.css">
    <!-- <link rel="stylesheet" href="./css/fontawesome.min.css"> -->
    <link rel="stylesheet" href="./css/estilos.css">
    <link rel="stylesheet" href="./css/contacto.css">
    <link rel="stylesheet" href="./css/footer2.css">
</head>
<body>
    <?php include "./header.php"?>

    <div class="banner_contact">
        <div class="banner_texto">
            <h1>CONTACTA CON NOSOTROS</h1>
        </div>
        <div class="banner_p">
            <p>si desea obtener alguna más informacion sobre nuestra clinica y los tratamientos que ofrecemos</p>
        </div>
    </div>

    <div class="container cont_contacto">
        <div class="caja">
            <div class="informe">
                <div class="con_text">
                    <h4>Informacion sobre nuestro contactos</h4>
                </div>
                <div class="con_texti">
                    <span><i class="fa-solid fa-phone"></i> +240 555435674</span>
                </div>
                <div class="con_texti">
                    <span><i class="fa-solid fa-location-dot"></i> Av.Calle-Bata</span>
                </div>
                <div class="con_texti">
                    <span><i class="fa-regular fa-envelope"></i> ClinicaBienestar@gmail.com</span>
                </div>
            </div>
        </div>
        <div class="form_envio">
            <form action="" class="for">
                <div class="nombre">
                    <input class="form-control" type="text" placeholder="Introduzca su nombre">
                </div>
                <div class="contact">
                    <div class="correo">
                        <input class="form-control" type="text" placeholder="Introduzca su correo">
                    </div>
                    <div class="asunto">
                        <input class="form-control" type="text" placeholder="Asunto">
                    </div>
                </div>
                <div class="mensaje">
                    <textarea class="form-control" name="" id="" placeholder="Mensaje"></textarea>
                </div>
                <div class="enviar">
                    <input class="btn btn-primary" type="submit">
                </div>
            </form>
        </div>
    </div>

    <?php include "./footer2.php"?>

    <script src="./js/all.js"></script>
    <script src="./js/bootstrap.js"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
</body>
</html>