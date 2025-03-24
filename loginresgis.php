<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/resgistro.css">
    <!-- <link rel="stylesheet" href="./css/all.css"> -->
</head>
<body>

    <div class="registro_dato">
        <p>Para realizar el registro se necesita que rellene toda la informacion que se le pide en el formulario</p>
        <p>Muchas Gracias!</p>
    </div>
    <form class="form" id="formulario" method="POST">
        <div class="sesion">
            <img src="./img/logoClinica2.png" alt="">
            <h2>REGISTRAR CUENTA</h2>
        </div>
       <div class="contenido">
            <div class="nombre">
                <div class="nom"><input name="nombre" class="form-control" placeholder="Nombre" type="text"></div>
                <div class="nom"><input name="apellidos" class="form-control" placeholder="Apellidos" type="text"></div>
            </div>
            <div class="nombre">
                <div class="nom"><input name="edad" class="form-control" placeholder="Edad" type="number"></div>
                <div class="nom">
                    <select name="genero" class="form-control" name="" id="">
                        <option value="">Genero</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                    </select>
                </div>
            </div>
            <div class="direccion">
                <input name="direccion" class="form-control" placeholder="Dirección" type="text">
            </div>
            <div class="nombre">
                <div class="nom"><input name="telefono" class="form-control" placeholder="telefono" type="text"></div>
                <div class="nom"><input name="correo" class="form-control" placeholder="Correo" type="email"></div>
            </div>
            <div class="contra">
                <input name="contra" class="form-control" placeholder="Introduzca su contraseña" type="password">
            </div>

       </div>
       <div class="submit">
        <input name="enviar" class="form-control btn btn-success" type="submit" value="Crear Cuenta" >
       </div>
    </form>

        <div class="volver">
            <a href="./login.php"><i class="fa-solid fa-door-open"></i>volver</a>
        </div>

    <!-- <div class="resgistro">
        <span>Si no tiene una cuenta porfavor,</span>
        <a href="">Crear cuenta</a>
    </div> -->

    <script src="./js/all.js"></script>
    <script scr="./js/bootstrap.js"></script>
    <script src="./js/registro.js"></script>
</body>
</html>