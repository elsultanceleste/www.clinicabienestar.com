let formulario = document.getElementById('pedircita');

formulario.addEventListener('submit',function(e){
    e.preventDefault();

    let xhr = new XMLHttpRequest();
    let datos = new FormData(formulario);
    
    xhr.open("POST","./php/enviarpeticion.php",true);

    xhr.addEventListener('load',()=>{
        let respuesta = JSON.parse(xhr.response);
        if(respuesta.status=='success'){
            formulario.reset();
            //sweetAlert2 de Cita agendada
            Swal.fire({
                icon: 'success',
                title: 'Cita agendada',
                text: 'Su cita ha sido agendada con éxito',
                showConfirmButton: false,
                timer: 1500
            });
        }
        
    });

    xhr.send(datos)
});

function idmedico(){
    let xhr = new XMLHttpRequest();
    xhr.open("POST","./php/medico.php",true);
    xhr.addEventListener('load',()=>{
        let id = JSON.parse(xhr.response);
        let medico = document.getElementById('medico')
        id.forEach(e => {
             medico.innerHTML+=`
                <option value="${e.medico_id}">${e.nombre_medico}-${e.especialidad}</option>
             `
        });
    });
    xhr.send();
}

idmedico();