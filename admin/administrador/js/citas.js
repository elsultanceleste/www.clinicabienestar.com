document.addEventListener('DOMContentLoaded', function() {
    cargarContadores();
    cargarCitasPendientes();
    cargarCitasAtendidas();
});

function cargarContadores() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', './php/citas.php?accion=contadores', true);
    xhr.onload = function() {
        if(xhr.status === 200) {
            const contadores = JSON.parse(xhr.responseText);
            document.querySelector('.text-warning').nextElementSibling.textContent = contadores.pendientes;
            document.querySelector('.text-black').nextElementSibling.textContent = contadores.atendidas;
            document.querySelector('.text-primary').nextElementSibling.textContent = contadores.nuevas;
        }
    };
    xhr.send();
}

function cargarCitasPendientes() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', './php/citas.php?accion=pendientes', true);
    xhr.onload = function() {
        if(xhr.status === 200) {
            
            const citas = JSON.parse(xhr.responseText);
            const tbody = document.querySelector('#pending table tbody');
            tbody.innerHTML = '';
            
            citas.forEach(cita => {
                tbody.innerHTML += `
                    <tr>
                        <td>${cita.nombre_paciente} ${cita.apellido_paciente}</td>
                        <td>${cita.fecha_cita} ${cita.hora_cita}</td>
                        <td>${cita.motivo}</td>
                        <td>
                            <button class="btn btn-success btn-sm" onclick="prepararAtencion(${cita.id})">
                                <i class="fa-regular fa-calendar-check"></i> Atender
                            </button>
                            <button class="btn btn-info btn-sm" onclick="verDetalles(${cita.id})">
                                <i class="fa-regular fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                `;
            });
        }
    };
    xhr.send();
}

function cargarCitasAtendidas() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', './php/citas.php?accion=atendidas', true);
    xhr.onload = function() {

        if(xhr.status === 200) {
            const citas = JSON.parse(xhr.responseText);
            const tbody = document.querySelector('#attended table tbody');
            tbody.innerHTML = '';
            
            citas.forEach(cita => {
                tbody.innerHTML += `
                    <tr>
                        <td>${cita.nombre_paciente} ${cita.apellido_paciente}</td>
                        <td>${cita.fecha_cita}</td>
                        <td>${cita.diagnostico}</td>
                        <td>
                            <button class="btn btn-primary btn-sm" onclick="verHistorial(${cita.paciente_id})">
                                <i class="fa-regular fa-file-lines"></i>
                            </button>
                        </td>
                    </tr>
                `;
            });
        }
    };
    xhr.send();
}

function prepararAtencion(citaId) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `./php/citas.php?accion=obtener_cita&id=${citaId}`, true);
    xhr.onload = function() {
        if(xhr.status === 200) {

            const cita = JSON.parse(xhr.responseText);
            document.getElementById('cita_id').value = cita.id;
            document.getElementById('paciente_nombre').value = `${cita.nombre_paciente} ${cita.apellido_paciente}`;
            document.getElementById('fecha_hora').value = `${cita.fecha_cita} ${cita.hora_cita}`;
            
            const modal = new bootstrap.Modal(document.getElementById('modalAtender'));
            modal.show();
        }
    };
    xhr.send();
}

let formularioAtencion = document.getElementById("formAtencion");
formularioAtencion.addEventListener('submit', function(event) {
    event.preventDefault();
    const formData = new FormData(formularioAtencion);
    const xhr = new XMLHttpRequest();
    xhr.open('POST', './php/citas.php?accion=atender', true);
    
    xhr.onload = function() {
        if(xhr.status === 200) {
            console.log(xhr.response);
            
            const response = JSON.parse(xhr.responseText);
            if(response.success) {
                alert('Cita atendida correctamente');
                cargarContadores();
                cargarCitasPendientes();
                cargarCitasAtendidas();
                bootstrap.Modal.getInstance(document.getElementById('modalAtender')).hide();
            } else {
                alert('Error al guardar la atención');
            }
        }
    };
    xhr.send(formData); 
})

function verDetalles(citaId) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `./php/citas.php?accion=detalles&id=${citaId}`, true);
    xhr.onload = function() {
        if(xhr.status === 200) {
            console.log(xhr.response);
            
            const detalles = JSON.parse(xhr.responseText);
            // Actualizar el contenido del modal de detalles
            document.getElementById('nombrePaciente').textContent = detalles.nombre_completo;
            document.getElementById('detalle_fecha').textContent = detalles.fecha_hora;
            document.getElementById('detalle_motivo').textContent = detalles.motivo;
            document.getElementById('detalle_historial').innerHTML = detalles.historial_html;
            
            const modal = new bootstrap.Modal(document.getElementById('modalDetalles'));
            modal.show();
        }
    };
    xhr.send();
}

function verHistorial(pacienteId) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `./php/citas.php?accion=historial&id=${pacienteId}`, true);
    xhr.onload = function() {
        if(xhr.status === 200) {
            
            const historial = JSON.parse(xhr.responseText);
            console.log(historial);
            
            // Actualizar datos del paciente
            document.getElementById('historial_nombre').textContent = historial.paciente.nombre_completo;
            document.getElementById('historial_edad').textContent = historial.paciente.edad;
            document.getElementById('historial_sangre').textContent = historial.paciente.grupo_sanguineo;
            document.getElementById('historial_alergias').textContent = historial.paciente.alergias;
            document.getElementById('id_paciente').value = historial.paciente.id;

            
            // Actualizar timeline
            const timeline = document.querySelector('.timeline');
            timeline.innerHTML = '';
            historial.consultas.forEach(consulta => {
                timeline.innerHTML += `
                    <div class="timeline-item">
                        <div class="timeline-date">${consulta.fecha}</div>
                        <div class="timeline-content">
                            <h6>DIAGNOSTICO: ${consulta.diagnostico}</h6>
                            <p>DETALLES: ${consulta.detalles}</p>
                            <p class="text-muted small">Dr. ${consulta.medico}</p>
                        </div>
                    </div>
                `;
            });
            
            const modal = new bootstrap.Modal(document.getElementById('modalHistorial'));
            modal.show();
        }
    };
    xhr.send();
}

function imprimirHistorial() {
    const pacienteId =  document.getElementById('id_paciente').value;
    window.open(`./php/historial.php?id=${pacienteId}`, '_blank');
}