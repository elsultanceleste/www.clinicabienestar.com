
let xhr = new XMLHttpRequest();
xhr.open("GET","./php/vermedico.php",true);

xhr.addEventListener('load',function(){
    console.log(xhr.response);
    
    let medico = JSON.parse(xhr.response);
    let infor = document.getElementById('infor');

    if (medico.length > 0) {
        medico.forEach(e=>{
            infor.innerHTML+=`
                <div class="imagen">
                    <div class="ima">
                        <img src="./admin/administrador/img/perfiles/${e.perfil_medico}" alt="">
                    </div>
                    <div class="nom_medico">
                        <p>Dr  ${e.nombre_medico} ${e.apellido_medico}</p>
                        <p>Especialidad: ${e.especialidad}</p>
                    </div>
                    <div class="leer_mas">
                        <button onclick="medicopropio(${e.id_medico})" class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Conocer más</button>
                    </div>
                </div>
            `
        });
    }else{
        infor.innerHTML = `<div class="text-center">No hay medicos registrados</div>`
    }
});

xhr.send();

function medicopropio(id_medico){
    let datos = new FormData();
    datos.append('id_medico', id_medico);
    let xhr = new XMLHttpRequest();
    xhr.open("POST","./php/medicoproprio.php",true);

    xhr.addEventListener('load',function(){
        
        let respon = JSON.parse(xhr.response);
        let conten = document.getElementById('medicoinfo');

        respon.forEach(e => {
            conten.innerHTML=`
                <div class="doctor_img">
                    <img src="./admin/administrador/img/perfiles/${e.perfil_medico}" alt="">
                </div>
                <div class="container-fluid d-flex justify-content-center">
                    <div class="detalle_doc">
                        <p>Nombre: ${e.nombre_medico}</p>
                        <p>Apellidos: ${e.apellido_medico}</p>
                        <p>Nacionalidad: ${e.nacionalidad_medico}</p>
                        <p>titulo Profecional: ${e.titulo_profesional}</p>
                        <p>Especialidad: ${e.especialidad}</p>
                        <p>Años de experiencia: ${e.experiencia}</p>
                        <p>Idiomas: ${e.idiomas}</p>
                    </div>
                </div>
            `
            let cita = document.getElementById('btncita');
            cita.addEventListener('click',()=>{
                idmedico(e.medico_id);
            });
        });
    
    });

    xhr.send(datos);
}



function idmedico(id_medico){
    // console.log(id_medico);
    
    let date = new FormData();
    date.append('id_medico',id_medico);

    let xhr = new XMLHttpRequest();
    xhr.open("POST","./php/medic.php",true);
    xhr.addEventListener('load',()=>{
        console.log(xhr.response);
        
        let id = JSON.parse(xhr.response);
        let medico = document.getElementById('medicopropio')
        id.forEach(e => {
             medico.innerHTML+=`
                <option value="${e.medico_id}">${e.nombre_medico}-${e.especialidad}</option>
             `
        });
    });
    xhr.send(date);
}


