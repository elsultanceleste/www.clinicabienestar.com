const FomNuevoPaciente = document.getElementById("nuevoPaciente");
const FormCita = document.getElementById("formCita");
const FormActualizar = document.getElementById("actualizarPaciente");

FomNuevoPaciente.addEventListener("submit", (e) => {
  e.preventDefault();
  let datos = new FormData(FomNuevoPaciente);
  datos.append("accion", "nuevoPaciente");
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "./php/pacientes.php", true);
  xhr.addEventListener("load", () => {
    console.log(xhr.response);

    let respuesta = JSON.parse(xhr.response);

    if (respuesta == 1) {
      Swal.fire({
        icon: "success",
        title: "Paciente agregado correctamente",
        confirmButtonText: "Aceptar",
      });
      cargarPaceintes();
      FomNuevoPaciente.reset();
    }
  });
  xhr.send(datos);
});

FormCita.addEventListener("submit", (e) => {
  e.preventDefault();
  let datos = new FormData(FormCita);
  datos.append("accion", "nuevaCita");
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "./php/pacientes.php", true);
  xhr.addEventListener("load", () => {
    console.log(xhr.response);
    let respuesta = JSON.parse(xhr.response);
    if (respuesta.status == "success") {
      Swal.fire({
        icon: "success",
        title: "Cita agendada correctamente",
        confirmButtonText: "Aceptar",
      });
      FormCita.reset();
    } else {
      Swal.fire({
        icon: "error",
        title: respuesta.message,
        confirmButtonText: "Aceptar",
      });
    }
  });
  xhr.send(datos);
});

FormActualizar.addEventListener("submit", (e) => {
  e.preventDefault();
  let datos = new FormData(FormActualizar);
  datos.append("accion", "actualizarPaciente");
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "./php/pacientes.php", true);
  xhr.addEventListener("load", () => {
    console.log(xhr.response);
    let respuesta = JSON.parse(xhr.response);
    if (respuesta.status == "success") {
      Swal.fire({
        icon: "success",
        title: "Paciente actualizado correctamente",
        confirmButtonText: "Aceptar",
      });
      cargarPaceintes();
      FormActualizar.reset();
      modalActualizarPaciente.hide();
    } else {
      Swal.fire({
        icon: "error",
        title: respuesta.message,
        confirmButtonText: "Aceptar",
      });
    }
  });
  xhr.send(datos);
});

function cargarPaceintes() {
  let xhr = new XMLHttpRequest();
  let datos = new FormData();
  datos.append("accion", "cargarPacientes");

  xhr.open("POST", "./php/pacientes.php", true);
  xhr.addEventListener("load", () => {
    let pacientes = JSON.parse(xhr.response);
    let tablaPacientes = document.getElementById("tablaPacientes");
    tablaPacientes.innerHTML = "";
    let alergias;

    for (let paciente of pacientes) {
      if (paciente.alergias == null) {
        alergias = "No hay alergias registradas";
      } else {
        alergias = paciente.alergias;
      }
      tablaPacientes.innerHTML += `
            <tr>
                                <th scope="row">${paciente.id}</th>
                                <td>${paciente.nombre}</td>
                                <td>${paciente.apellido}</td>
                                <td>${paciente.fecha_nacimiento}</td>
                                <td>${paciente.direccion}</td>
                                <td>${
                                  alergias || "No hay alergias registradas"
                                }</td>
                                <td>${paciente.telefono}</td>
                                <td>${paciente.genero}</td>
                                <td>
                                    <div class="btn-group">
                                        <a target="_blank" aria-label="Imprimir historial" href="./php/historial.php?id=${
                                          paciente.id
                                        }" class="btn btn-primary"><i class="fa-solid fa-book-medical"></i></a>

                                        <a class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalActualizarPaciente" onclick="formEditarPaciente(${
                                          paciente.id
                                        })"><i class="fa-solid fa-user-edit"></i></a>
                                        <a class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalCita" onclick="formCita(${
                                          paciente.id
                                        })" ><i class="fa-solid fa-calendar"></i></a>
                                    </div>
                                </td>

                            </tr>
            
            `;
    }
  });

  xhr.send(datos);
}

cargarPaceintes();

function formCita(id_paciente) {
  document.getElementById("id_paciente").value = id_paciente;
}

function traerMedicos() {
  let xhr = new XMLHttpRequest();
  let datos = new FormData();
  datos.append("accion", "traerMedicos");
  xhr.open("POST", "./php/pacientes.php", true);
  xhr.addEventListener("load", () => {
    let medicos = JSON.parse(xhr.response);
    let selectMedico = document.getElementById("medico");
    for (let medico of medicos) {
      selectMedico.innerHTML += `
                <option value="${medico.id}">${medico.nombre} - ${medico.especialidad}</option>
            `;
    }
  });
  xhr.send(datos);
}

traerMedicos();

function formEditarPaciente(id_paciente) {
  let xhr = new XMLHttpRequest();
  let datos = new FormData();
  datos.append("accion", "datosPaciente");
  datos.append("id_paciente", id_paciente);

  xhr.open("POST", "./php/pacientes.php", true);
  xhr.addEventListener("load", () => {
    if (xhr.status === 200) {
      let response = JSON.parse(xhr.response);

      if (response.status === "success") {
        let paciente = response.data;

        // Llenar el formulario con los datos del paciente
        document.getElementById("id_pacienteA").value = paciente.id;
        document.getElementById("nombreA").value = paciente.nombre;
        document.getElementById("apellidoA").value = paciente.apellido;
        document.getElementById("fechaNacimientoA").value =
          paciente.fecha_nacimiento;
        document.getElementById("direccionA").value = paciente.direccion;
        document.getElementById("telefonoA").value = paciente.telefono;
        document.getElementById("emailA").value = paciente.email;
        document.getElementById("alergiasA").value = paciente.alergias;
      } else {
        alert(response.message);
      }
    } else {
      alert("Error al cargar los datos del paciente");
    }
  });
  xhr.send(datos);
}

document.getElementById("buscarPaciente").addEventListener("keyup", function() {
    const busqueda = this.value;
    const datos = new FormData();
    datos.append("busqueda", busqueda);
    datos.append("accion", "buscar");

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "./php/buscar_pacientes.php", true);
    
    xhr.onload = function() {
        if (xhr.status === 200) {
            const data = JSON.parse(xhr.responseText);
            const tablaPacientes = document.getElementById("tablaPacientes");
            tablaPacientes.innerHTML = "";

            data.forEach((paciente, index) => {
                tablaPacientes.innerHTML += `
                    <tr>
                        <th scope="row">${index + 1}</th>
                        <td>${paciente.nombre}</td>
                        <td>${paciente.apellido}</td>
                        <td>${paciente.fecha_nacimiento}</td>
                        <td>${paciente.direccion}</td>
                        <td>${paciente.alergias || "No registradas"}</td>
                        <td>${paciente.telefono}</td>
                        <td>${paciente.genero}</td>
                        <td>
                            <div class="btn-group">
                                <a target="_blank" aria-label="Imprimir historial" href="./php/historial.php?id=${paciente.id}" class="btn btn-primary">
                                    <i class="fa-solid fa-book-medical"></i>
                                </a>
                                <a class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalActualizarPaciente" onclick="formEditarPaciente(${paciente.id})">
                                    <i class="fa-solid fa-user-edit"></i>
                                </a>
                                <a class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalCita" onclick="formCita(${paciente.id})">
                                    <i class="fa-solid fa-calendar"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                `;
            });
        }
    };

    xhr.onerror = function() {
        console.error("Error en la búsqueda");
    };

    xhr.send(datos);
});
