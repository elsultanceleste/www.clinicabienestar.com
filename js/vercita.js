let xhr = new XMLHttpRequest();

xhr.open("POST","./php/vercita.php",true);

xhr.addEventListener('load',()=>{
    let ans = JSON.parse(xhr.response);
    let body = document.getElementById('tbody');

    ans.forEach(e => {
        body.innerHTML+=`
            <tr>
                <td class="text-center">${e.nombre_medico}</td>
                <td class="text-center">${e.fecha_cita}</td>
                <td class="text-center">${e.hora_cita}</td>
                <td class="text-center">${e.motivo}</td>
                <td class="text-center">${e.estado}</td>
            </tr>
        `  
    });
    
});

xhr.send();