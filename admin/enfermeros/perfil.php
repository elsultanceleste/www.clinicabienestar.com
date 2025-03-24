<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración de Cuenta</title>
    <!-- CLASES -->
    <?php include './components/estilos.php'?>
    
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Configuración de perfil</h2>
        <div class="container Confi d-flex">
            <div class="ConfiP">
                <img src="./img/logoCLinica2.png" alt="">
            </div>
            <div class="confInfo  h-50 w-50 text-center  mt-3">
                <p class="h3 text-center mt-4 titulo">Enfermero</p>
                <div class="confDatos">
                    <p class="h4">Nombre: <span class="h4 fs-5">Zabulon</span></p>
                    <p class="h4">Apellidos: <span class="h4 fs-5">Sima oluy</span></p>
                    <p class="h4">Usuario: <span class="h4 fs-5">Dylan08</span></p>
                    <p class="h4">Ultima modificacion: <span class="h4 fs-5">2025-01-09 18:50</span></p>
                </div>
            </div>
            <div class="confiAccio">
                <button type="button" class="btn btnActua" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Actualizar
                </button>
                <a href="" class="btn btn-danger"> Cerrar Sesion</a>

            </div>

                        
            <a href="./" class="btn btn-secondary btnVolver">   <i class="fa-solid fa-arrow-left"></i> Volver</a>
        </div>
    </div>

    <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modificar datos</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre">
                </div>
                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos">
                </div>
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuario</label>
                    <input type="text" class="form-control" id="usuario" name="usuario">
                </div>

                <div class="mb-3">
                    <label for="perfil" class="form-label">Perfil</label>
                    <input type="file" class="form-control" id="perfil" name="perfil">
                    
                    
                    
                </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn guardar" >Guardar cambios</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cerrar</button>
      </div>
    </div>
  </div>
</div>

    <!-- FOOTER -->
    <?php require( './components/footer.php'); ?>
</body>
</html>