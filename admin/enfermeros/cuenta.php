<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuenta</title>
    <?php include "./components/estilos.php" ?>
</head>
<body>
<div class="container mt-5">
        <h2 class="text-center">Condiguracion de cuenta</h2>
        <div class="container Confi d-flex">
            <div class="confInfo  h-50 w-50 text-center  mt-3">
                <p class="h3 text-center mt-4 titulo">Enfermero</p>
                <div class="confDatos d-flex gap-3">
                    <p class="h4">Usuario: <span class="h4 fs-5">Dylan08</span></p>
                    <p class="h4">Contraseña: <span class="h4 fs-5">********</span></p>
                </div>
            </div>
            <div class="confiAccio">
                <button type="button" class="btn btnActua" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Modificar Contraseña
                </button>
                <a href="" class="btn btn-danger"> Cerrar Sesion</a>

            </div>

                        
            <a href="./" class="btn btn-secondary btnVolver">   <i class="fa-solid fa-arrow-left"></i> Volver</a>
        </div>
    </div>

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
                    <label for="antigua" class="form-label">Antigua Contraseña</label>
                    <input type="password" class="form-control" id="antigua" name="antigua">
                </div>
                <div class="mb-3">
                    <label for="nuevo" class="form-label">Nueva Contraseña</label>
                    <input type="password" class="form-control" id="nuevo" name="nuevo">
                </div>
                <div class="mb-3">
                    <label for="confirmar" class="form-label">Confirmar Contraseña</label>
                    <input type="password" class="form-control" id="confirmar" name="confirmar">
                </div>

                
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn guardar" >Cambiar contraseña</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cerrar</button>
      </div>
    </div>
  </div>
</div>




<?php include "./components/footer.php" ?>

</body>
</html>