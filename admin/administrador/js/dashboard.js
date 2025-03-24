document.addEventListener('DOMContentLoaded', function() {
    cargarConteos();
    cargarRoles();
    cargarMedicos();
    cargarGraficoPacientes();
});

function realizarPeticion(accion, respuesta) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `./php/dashboard.php?accion=${accion}`, true);
    xhr.onload = function() {
        if(xhr.status === 200) {
            
            const response = JSON.parse(xhr.responseText);
            respuesta(response);
        }
    };
    xhr.send();
}

function cargarConteos() {
    realizarPeticion('conteos', function(data) {
        document.getElementById('total-empleados').textContent = data.empleados;
        document.getElementById('total-pacientes').textContent = data.pacientes;
        document.getElementById('total-usuarios').textContent = data.usuarios;
    });
}

function cargarRoles() {
    realizarPeticion('roles', function(roles) {
        const tbody = document.querySelector('#tabla-roles tbody');
        tbody.innerHTML = '';
        roles.forEach((rol, index) => {
            tbody.innerHTML += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${rol.nombre}</td>
                    <td>${rol.cantidad}</td>
                </tr>
            `;
        });
    });
}

function cargarMedicos() {
    realizarPeticion('medicos', function(medicos) {
        const tbody = document.querySelector('#tabla-medicos tbody');
        tbody.innerHTML = '';
        medicos.forEach(medico => {
            tbody.innerHTML += `
                <tr>
                    <td>${medico.nombre}</td>
                    <td>${medico.apellido}</td>
                    <td>${medico.especialidad}</td>
                    <td class="d-flex flex-column flex-lg-row gap-1">
                        <button class="btn btn-success" onclick="editarMedico(${medico.id})">
                            <i class="fa fa-user-edit"></i>
                        </button>
                        <button class="btn btn-danger" onclick="eliminarMedico(${medico.id})">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `;
        });
    });
}

function cargarGraficoPacientes() {
    realizarPeticion('pacientes_genero', function(datos) {

        const ctx2 = document.getElementById('myChartpie').getContext('2d');
        console.log(datos);
        
        new Chart(ctx2, {
            type: 'pie',
            data: {
                labels:datos.map(item => item.estado),
                datasets: [{
                    data: datos.map(item => item.total), // Datos de ejemplo
                    backgroundColor: ['#006131FF', '#417b61'],
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: { size: 14 },
                            color: '#333'
                        }
                    }
                }
            }
        });
    });
}


function editarMedico(id) {
    realizarPeticion('obtener_medico&id=' + id, function(medico) {
        console.log(medico);
        
        document.getElementById('medico_id').value = medico.id;
        document.getElementById('especialidad').value = medico.especialidad;
        document.getElementById('titulo').value = medico.titulo_profesional;
        document.getElementById('experiencia').value = medico.experiencia;
        document.getElementById('idiomas').value = medico.idiomas;
        
        new bootstrap.Modal(document.getElementById('actualizarMedicoModal')).show();
    });
}

function actualizarMedico() {
    const formData = new FormData(document.getElementById('formActualizarMedico'));
    const xhr = new XMLHttpRequest();
    xhr.open('POST', './php/dashboard.php?accion=actualizar_medico', true);
    
    xhr.onload = function() {
        if(xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if(response.success) {
                alert('Médico actualizado correctamente');
                cargarMedicos(); // Recargar la tabla
                bootstrap.Modal.getInstance(document.getElementById('actualizarMedicoModal')).hide();
            } else {
                alert('Error al actualizar el médico');
            }
        }
    };
    
    xhr.send(formData);
}