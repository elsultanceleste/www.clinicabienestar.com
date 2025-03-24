let formRol = document.getElementById("formNuevoRol");

formRol.addEventListener("submit", (e) => {
  e.preventDefault();

  let dato = new FormData(formRol);
  dato.append("accion", "agregar");
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "./php/roles.php", true);

  xhr.addEventListener("load", (e) => {
    console.log(xhr.response);

    let respuesta = xhr.response;
    if (respuesta == 1) {
        
      Swal.fire({
        icon: "success",
        title: "¡Éxito!",
        text: "Rol agregado con exito",
      });
      formRol.reset();
      roles();
    } else if (respuesta == 2) {
      Swal.fire({
        icon: "error",
        title: "Error!",
        text: "Error al agregar el rol",
      });
    } else if (respuesta == 3) {
      Swal.fire({
        icon: "error",
        title: "BAYA!",
        text: "El rol ya existe",
      });
    }
  });
  xhr.send(dato);
});

//traer roles

function roles() {
  let dato = new FormData();
  dato.append("accion", "traer");
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "./php/roles.php", true);
  xhr.addEventListener("load", (e) => {
    let tabla = document.getElementById("tablaRol");
    tabla.innerHTML = "";
    let respuesta = JSON.parse(xhr.response);
    console.log(respuesta);
    
    for (let rol of respuesta) {
      tabla.innerHTML += `
            <tr>
                <td>${rol.id}</td>
                <td>${rol.nombre}</td>
            </tr>
            `;
    }
  });
  xhr.send(dato);
}

roles();
