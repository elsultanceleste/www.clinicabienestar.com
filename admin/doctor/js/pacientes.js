document.addEventListener('DOMContentLoaded', function() {
    cargarPacientes();
});

function cargarPacientes() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', './php/pacientes.php?accion=listar', true);
    xhr.onload = function() {
        if(xhr.status === 200) {
            const pacientes = JSON.parse(xhr.responseText);
            const tbody = document.querySelector('table tbody');
            tbody.innerHTML = '';
            
            pacientes.forEach((paciente, index) => {
                tbody.innerHTML += `
                    <tr>
                        <th scope="row">${index + 1}</th>
                        <td>${paciente.nombre}</td>
                        <td>${paciente.apellido}</td>
                        <td>${paciente.edad}</td>
                        <td>${paciente.genero}</td>
                        <td>${paciente.direccion}</td>
                        <td>${paciente.telefono}</td>
                        <td>
                            <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Historial">
                                <a href="#" class="btn btn-primary btn-sm" onclick="verHistorial(${paciente.id})" data-bs-toggle="modal" data-bs-target="#modalHistorial">
                                    <i class="fa-solid fa-book-medical"></i>
                                </a>
                            </span>
                        </td>
                    </tr>
                `;
            });
        }
    };
    xhr.send();
}

function verHistorial(pacienteId) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `./php/pacientes.php?accion=historial&id=${pacienteId}`, true);
    xhr.onload = function() {
        if(xhr.status === 200) {
            console.log(JSON.parse(xhr.responseText));
            
            const historial = JSON.parse(xhr.responseText);
            const tbody = document.querySelector('#modalHistorial tbody');
            // const nombrePaciente = document.querySelector('#nombrePaciente');
            
            tbody.innerHTML = '';
            
            if(historial.length > 0) {
                // nombrePaciente.textContent = `Historial de ${historial[0].nombre} ${historial[0].apellido}`;
                
                historial.forEach(registro => {
                    const fecha = new Date(registro.fecha).toLocaleDateString();
                    tbody.innerHTML += `
                        <tr>
                            <td>${fecha}</td>
                            <td>${registro.diagnostico}</td>
                            <td>${registro.tratamiento}</td>
                            <td>${registro.Receta}</td>
                            <td>
                                <div class="btn-group">
                                    <button onclick="generarPDF(${registro.id})" class="btn btn-primary btn-sm">
                                        <i class="fas fa-file-pdf"></i> PDF
                                    </button>
                                    <button onclick="editarHistorial(${registro.id})" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditarHistorial">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                });
            } else {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="5" class="text-center">No hay registros de historial médico</td>
                    </tr>
                `;
            }
        }
    };
    xhr.send();
}

function editarHistorial(historialId) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `./php/pacientes.php?accion=obtenerHistorial&id=${historialId}`, true);
    xhr.onload = function() {
        if(xhr.status === 200) {
            const registro = JSON.parse(xhr.responseText);
            document.getElementById('editDiagnostico').value = registro.diagnostico;
            document.getElementById('editTratamiento').value = registro.tratamiento;
            document.getElementById('editReceta').value = registro.receta;
            document.getElementById('historialId').value = registro.id;
        }
    };
    xhr.send();
}

function generarPDF(historialId) {
    window.open(`./php/generar_pdf.php?id=${historialId}`, '_blank');
}