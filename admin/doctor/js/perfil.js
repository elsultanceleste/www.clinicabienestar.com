document.getElementById('formPerfil').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const datos = new FormData();
    datos.append('experiencia', document.getElementById('experiencia').value);
    datos.append('idiomas', document.getElementById('idioma').value);
    datos.append('accion', 'actualizarPerfil');
    
    const xhr = new XMLHttpRequest();
    xhr.open('POST', './php/perfil.php', true);
    
    xhr.onload = function() {
        if (xhr.status === 200) {
            
            const data = JSON.parse(xhr.responseText);
            if(data.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: 'Perfil actualizado correctamente'
                });
                document.getElementById('formPerfil').reset();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al actualizar el perfil'
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