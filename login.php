<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/login.css">
    <!-- <link rel="stylesheet" href="./css/all.css"> -->
</head>
<body>
    <form class="form" method="POST" id="inicio">
        <div class="volver">
            <a href="./index.php"><i class="fa-solid fa-door-open"></i>volver</a>
        </div>
        <div class="sesion">
            <img src="./img/logoClinica2.png" alt="">
            <h2>INICIAR SESION</h2>
        </div>
       <div class="infor">
        <div class="texto">
            <label for="">Correo</label>
        </div>
        <input class="form-control" name="email" type="text" placeholder="Introduzca su correo">
        <div class="texto">
            <label for="">Password</label>
        </div>
        <input class="form-control" name="pwd" type="text" placeholder="Introduzca su contraseña">
       </div>
       <div class="submit">
        <input class="form-control btn btn-success" type="submit" value="Iniciar Sesioin">
       </div>
    </form>

    <div class="resgistro">
        <span>Si no tiene una cuenta porfavor,</span>
        <a href="./loginresgis.php">Crear cuenta</a>
    </div>

    <script src="./js/all.js"></script>
    <script scr="./js/bootstrap.js"></script>
    <script src="./js/login.js"></script>
</body>
</html>