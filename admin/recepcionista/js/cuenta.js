document.getElementById('FormactualizarCuenta').addEventListener('submit', function(e) {
    e.preventDefault();
    console.log("Formulario enviado");
    
    
    if(document.getElementById('passwordNueva').value !== document.getElementById('passwordConfirmar').value) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Las contraseñas no coinciden'
        });
        return;
    }
    
    const datos = new FormData();
    datos.append('email', document.getElementById('email').value);
    datos.append('passwordActual', document.getElementById('passwordActual').value);
    datos.append('passwordNueva', document.getElementById('passwordNueva').value);
    datos.append('accion', 'actualizarCuenta');
    
    const xhr = new XMLHttpRequest();
    xhr.open('POST', './php/cuenta.php', true);
    
    xhr.onload = function() {
        if (xhr.status === 200) {
            console.log(xhr.response);
            
            const data = JSON.parse(xhr.responseText);
            if(data.status === 'success') {
                document.getElementById('FormactualizarCuenta').reset();
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: 'Cuenta actualizada correctamente'
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message || 'Error al actualizar la cuenta'
                });
            }
        }
    };
    
    xhr.onerror = function() {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error de conexión'
        });
    };
    
    xhr.send(datos);
});


