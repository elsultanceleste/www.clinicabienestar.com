function cargarCitas() {
    let dato = new FormData();
    dato.append("accion", "cargarCitas");
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "./php/citas.php", true);
    xhr.addEventListener("load", () => {
        console.log(JSON.parse(xhr.response));
        
        let respuesta = JSON.parse(xhr.response);
        let tablaCitas = document.getElementById("tabla-citas");
        tablaCitas.innerHTML = "";
        for (let cita of respuesta) {
            tablaCitas.innerHTML += `
            <tr>
                                <th scope="row">#${cita.id}</th>
                                <td>${cita.nombre}</td>
                                <td>${cita.apellido}</td>
                                <td>${cita.fecha_cita}</td>
                                <td>${cita.hora_cita}</td>
                                <td>${cita.estado}</td>
                                <td>Dr. ${cita.nombre_medico} ${cita.apellido_medico}</td>
                                <td>
                                ${cita.motivo}
                                </td>
                            </tr>
            `;
        }
    });

    xhr.send(dato);


}

cargarCitas();