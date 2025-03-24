
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/estilos.css">
    <link rel="stylesheet" href="./css/equipo.css">
    <link rel="stylesheet" href="./css/all.css">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/footer2.css">
</head>
<body>
    <?php include "./header.php"?>

    <div class="banner_equipo" >
        <h1>Nuestra responsabilidad es cuidar de tus ojos.</h1>
        <a href="#todob">Ver todo el equipo</a>
    </div>

    <div class="container text_equipo">
        <h3>Nuestro Equipo de Especialistas</h3>
    </div>
    <div class="container equipo_info" id="infor">
            <!-- <div class="imagen">
                <div class="ima">
                    <img src="./img/historia.jpg" alt="">
                </div>
                <div class="nom_medico">
                    <p>Dr Santander Morgades</p>
                    <p>Especialidad: Cirujano de Cataratas</p>
                </div>
                <div class="leer_mas">
                    <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Conocer más</button>
                </div>
            </div> -->
            
    </div>

    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Informacion del medico</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="medicoinfo">
            <!-- <div class="doctor_img">
                <img src="./img/historia.jpg" alt="">
            </div>
            <div class="container-fluid d-flex justify-content-center">
                <div class="detalle_doc">
                    <p>Nombre: Andres</p>
                    <p>Apellidos: Santander Morgades</p>
                    <p>Nacionalidad: Turco</p>
                    <p>titulo Profecional: Ojologo</p>
                    <p>Especialidad: Cirujano de ojo</p>
                    <p>Años de experiencia: 10 años</p>
                    <p>Premios: Ninguno</p>
                    <p>Idiomas: Ingles,Español,frances</p>
                </div>
            </div> -->
      </div>
      <div class="modal-footer text-center">
        <p class="noti <?php if(isset($_SESSION['id_paciente'])){
            echo "d-none";
        }else{
            echo "d-block";
        }?>">Si desea pedir una cita con ese medico primero tiene que registrarse en el sistema, muchas gracias!</p>
        <button class="btn btn-primary <?php if(isset($_SESSION['id_paciente'])){
            echo "d-block";
        }else{
            echo "d-none";
        }?>" data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="btncita">Pedir Cita</button>
      </div>
    </div>
  </div>
</div>
<!-- <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Modal 2</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Hide this modal and show the first with the button below.
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Back to first</button>
      </div>
    </div>
  </div>
</div> -->

<!-- Segundo modal-->

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Realizar peticion de cita</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="formul">
        <form class="informa" method="POST" id="particular">
            <div class="nombre">
                <input name="id_paciente" class="form-control d-none" type="text" value="<?php echo $_SESSION['id_paciente']?>" >
            </div>
            <div class="nombre">
                <input name="motivo" class="form-control" type="text" placeholder="Introduzca el motivo de la cita" >
            </div>

            <div class="contacto">

                <div class="telefono">
                    <select class="form-control cita" name="tipocita" id="" >
                        <option  value="">Seleccione el tipo de cita</option>
                        <option  value="Consulta">Consulta</option>
                        <option  value="Refision">Revision</option>
                        <option  value="Refision">Analisis</option>
                    </select>
                </div>
                <div class="correo">
                    <select class="form-control" name="id_doctor" id="medicopropio" >
                        <!-- <option value="">Seleccione su medico</option> -->
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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-success" value="Solicitar cita">
            </div>
        </form>
    </div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
        <!-- <button type="button" class="btn btn-primary">Understood</button> -->
      </div>
    </div>
  </div>
</div>

</div>

<div class="container especialidades">
    <h3>Nuestras Especialidades</h3>
    <div class="esp_grid">
        <div class="esp_item">
            <i class="fa-solid fa-eye"></i>
            <h4>Oftalmología General</h4>
            <p>Diagnóstico y tratamiento integral de enfermedades oculares</p>
        </div>
        <div class="esp_item">
            <i class="fa-solid fa-glasses"></i>
            <h4>Cirugía Refractiva</h4>
            <p>Corrección de miopía, hipermetropía y astigmatismo</p>
        </div>
        <div class="esp_item">
            <i class="fa-solid fa-microscope"></i>
            <h4>Cirugía de Cataratas</h4>
            <p>Procedimientos avanzados con tecnología de última generación</p>
        </div>
    </div>
</div>

<div class="container compromiso">
    <h3>Nuestro Compromiso</h3>
    <div class="comp_content">
        <div class="comp_text">
            <p>En Clínica Bienestar, nuestro equipo médico está comprometido con brindar la mejor atención 
            oftalmológica. Cada especialista cuenta con amplia experiencia y formación continua para 
            garantizar los mejores resultados en cada tratamiento.</p>
        </div>
        <div class="comp_stats">
            <div class="stat_item">
                <h4><span data-counter="15">0</span>+</h4>
                <p>Años de Experiencia</p>
            </div>
            <div class="stat_item">
                <h4><span data-counter="20">0</span>+</h4>
                <p>Especialistas</p>
            </div>
            <div class="stat_item">
                <h4><span data-counter="50000">0</span>+</h4>
                <p>Pacientes Atendidos</p>
            </div>
        </div>
    </div>
</div>

<?php include "./footer2.php"?>

    <script src="./js/all.js"></script>
    <script src="./js/bootstrap.js"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="./js/infomedico.js"></script>
    <script src="./js/enviopublico.js"></script>
    <script src="./js/counter.js"></script>
</body>
</html>