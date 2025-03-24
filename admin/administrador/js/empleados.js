let formNuevoEmpleado = document.getElementById("formNuevoEmpleado");
let selectRol = document.getElementById("rolEmpleado");


formNuevoEmpleado.addEventListener("submit", (e) => {
    e.preventDefault();
    let dato = new FormData(formNuevoEmpleado);
    var valorSeleccionado = dato.get('rol');
    
    // Obtener el texto de la opción seleccionada
    var select = document.querySelector('select[name="rol"]');
    var rolSelecionado = select.options[select.selectedIndex].text;
    console.log(rolSelecionado);
    const imagenInput = document.getElementById('perfil');
      const archivo = imagenInput.files[0];
      
      
    
  
    if (
      dato.get("nombre") === "" ||
      dato.get("apellidos") === "" ||
      dato.get("correo") === "" ||
      dato.get("telefono") === "" ||
      dato.get("rol") === "" ||
      dato.get("direccion") === "" || // Corregido el typo
      dato.get("nacionalidad") === ""
    ) {
      Swal.fire({
        icon: "error",
        title: "Error",
        text: "Todos los campos son obligatorios",
      });
      return;
    } else if (rolSelecionado == "Medico" && dato.get('especialidad') == ''){
      Swal.fire({
        icon: "error",
        title: "Error",
        text: "Debe introducir todos los datos del medico",
      });
      return;
    }else if (rolSelecionado == "Medico" && dato.get('titulo') == '' ){
      Swal.fire({
        icon: "error",
        title: "Error",
        text: "Debe introducir todos los datos del medico",
      });
      return;
    }else if (rolSelecionado == "Medico" && dato.get('anosExperiencia') == '' ){
      Swal.fire({
        icon: "error",
        title: "Error",
        text: "Debe introducir todos los datos del medico",
      });
      return;
    }else if (rolSelecionado == "Medico" && dato.get('idiomas') == '' ){
      Swal.fire({
        icon: "error",
        title: "Error",
        text: "Debe introducir todos los datos del medico",
      });
      return;
    }else if (rolSelecionado == "Medico" && dato.get('idiomas') == '' ){
    }else if (!archivo) {
      Swal.fire('Error', 'Selecciona una imagen', 'error');
      return;
    }
  
    dato.append("accion", "nuevoEmpleado");
  
    // Mostrar mensaje de carga
    Swal.fire({
      title: "Guardando...",
      text: "Por favor, espere",
      allowOutsideClick: false,
      allowEscapeKey: false,
      didOpen: () => {
        Swal.showLoading();
      }
    });

  
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "./php/empleados.php", true);
    
    xhr.addEventListener("load", () => {
        console.log(xhr.response);
        
      let respuesta = JSON.parse(xhr.responseText);
      
      if (respuesta.estado == 'exitoso') {
        formNuevoEmpleado.reset();
        cargarEmpleados();
        Swal.fire({
          icon: "success",
          title: respuesta.mensaje,
        });
        
        
      } else {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: respuesta.mensaje || "Ocurrió un problema",
        });
      }
    });
  
    xhr.send(dato);
  });
  

function traerRoles() {
  let dato = new FormData();
  dato.append("accion", "traerRoles");
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "./php/empleados.php", true);
  xhr.addEventListener("load", () => {
    let respuesta = JSON.parse(xhr.response);


    for (let rol of respuesta) {
      selectRol.innerHTML += `
            <option value="${rol.id}">${rol.nombre}</option>
        `;
    }
  });

  xhr.send(dato);
}

function cargarEmpleados() {
    let dato = new FormData();
    dato.append("accion", "cargarEmpleados");
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "./php/empleados.php", true);
    xhr.addEventListener("load", () => {
        console.log(JSON.parse(xhr.response));
        
        let respuesta = JSON.parse(xhr.response);
        let tablaEmpleados = document.getElementById("tablaEmpleados");
        tablaEmpleados.innerHTML = "";
        for (let empleado of respuesta) {
            tablaEmpleados.innerHTML += `
            <tr>
                                    <td>${empleado.id}</td>
                                    <td>${empleado.nombre}</td>
                                    <td> ${empleado.apellido}</td>
                                    <td>${empleado.email}</td>
                                    <td>${empleado.telefono}</td>
                                    <td>${empleado.rol}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditarEmpleado">
                                                <i class="fa-solid fa-pen"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                
            `;
        }
    });

    xhr.send(dato);
        
    
}

cargarEmpleados();

traerRoles();
