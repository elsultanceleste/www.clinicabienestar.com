
function cargarUsuarios() {

    let dato = new FormData();
    dato.append('accion', 'cargar');
    let xhr = new XMLHttpRequest();
    xhr.open('POST', './php/usuarios.php', true);

    xhr.addEventListener('load',()=>{
        let tablaUsuario = document.getElementById('tablaUsuarios');
        let respuesta = JSON.parse(xhr.response);
        
        tablaUsuario.innerHTML = '';
        for (let usuario of respuesta) {

            let estadoClase = usuario.estado === 'Inactivo' ? 'bg-danger' : 'bg-success';
        
            tablaUsuario.innerHTML += `
                <tr>
                    <td>${usuario.cod_usuario}</td>
                    <td>${usuario.correo}</td>
                    <td>${usuario.propietario}</td>
                    <td><span class="badge bg-primary">${usuario.rol}</span></td>
                    <td><span class="badge ${estadoClase}">${usuario.estado}</span></td>
                    <td class="d-flex justify-content-center align-items-center">
                        <div class="form-check form-switch d-flex justify-content-center">
                            <input class="form-check-input" type="checkbox" item="${usuario.cod_usuario}" id="estadoUsuario" ${usuario.estado === 'Activo' ? 'checked' : ''}>
                        </div>
                        <a type="button" class="btn btn-primary btn-sm" onclick="actualizarPassword(${usuario.cod_usuario},'${usuario.correo}','${usuario.propietario}')"><i class="fa-solid fa-arrow-rotate-right"></i></a>
                    </td>
                </tr>
            `;
        }

        // Evento para cambiar el estado del usuario
        document.getElementById('tablaUsuarios').addEventListener('change', (e)=>{
            if(e.target.id === 'estadoUsuario'){
                let dato = new FormData();
                dato.append('accion', 'cambiarEstado');
                dato.append('cod_usuario', e.target.getAttribute('item'));
                dato.append('estado', e.target.checked? 'Activo' : 'Inactivo');
                
                let xhr = new XMLHttpRequest();
                xhr.open('POST', './php/usuarios.php', true);
                xhr.addEventListener('load',()=>{
                    cargarUsuarios();
                    
                });
                xhr.send(dato);
            }
        });


        
    });
    xhr.send(dato);

    
}

cargarUsuarios();

function actualizarPassword(id_usuario, correo, nombre) {
    let dato = new FormData();
    dato.append('accion', 'regenerarContrasena');
    dato.append('cod_usuario', id_usuario);
    dato.append('correo', correo);
    dato.append('nombre', nombre);
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
    xhr.open('POST', './php/usuarios.php', true);
    xhr.addEventListener('load',()=>{
        console.log(xhr.response);

        let respuesta = JSON.parse(xhr.response);
        if(respuesta.estado === 'exitoso'){
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: respuesta.mensaje,
            });
        }else{
            Swal.fire({
              icon: "alert",
              title: "¡Error!",
              text: respuesta.mensaje,
            });
        }
    });
    xhr.send(dato);
}