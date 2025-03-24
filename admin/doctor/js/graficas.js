
let id_medico = document.getElementById('id_medico').value;

function graficaAtendidos(id_medico) {
    let datos = new FormData();
    datos.append("id_medico", id_medico);
    datos.append("accion", "antendidos");
    
    let xhr = new XMLHttpRequest();
    xhr.open('POST', './php/graficaPaciente.php', true);
    xhr.addEventListener('load', () => {
        let respuesta = JSON.parse(xhr.response);
        const total = respuesta.map(dato => dato.total);
        const ctx = document.getElementById('myChart').getContext('2d');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: [
                    "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
                    "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
                ],
                datasets: [{
                    label: 'Pacientes Atendidos',
                    data: total,
                    borderColor: '#417b61',
                    backgroundColor: 'rgba(0, 123, 255, 0.2)',
                    borderWidth: 2,
                    pointBackgroundColor: '#417b61',
                    pointRadius: 5,
                    pointHoverRadius: 10,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    duration: 1500,
                    easing: 'easeOutBounce'
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            precision: 0
                        }
                    }
                }
            }
        });
    });
    xhr.send(datos);
}

function citas(id_medico) {

    let datos = new  FormData();
    datos.append("id_medico", id_medico);
    datos.append("accion","citas");
    let xhr = new XMLHttpRequest();
    xhr.open('POST', './php/graficaPaciente.php', true);
    xhr.addEventListener('load', ()=>{
        
        let respuesta = JSON.parse(xhr.response);
        
        const tipo = respuesta.map(dato=> dato.tipo);
        const total = respuesta.map(dato=> dato.cantidad);
        const ctx2 = document.getElementById('myChartpie').getContext('2d');
        new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: tipo,
                datasets: [{
                    data: total, // Datos de ejemplo
                    backgroundColor: ['#007bff', '#417b61', '#ffc107'],
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
    xhr.send(datos);
    
}

function citarHoy(id_medico) {
    let datos = new  FormData();
    datos.append("id_medico", id_medico);
    datos.append("accion","citas_hoy");
    let xhr = new XMLHttpRequest();
    xhr.open('POST', './php/graficaPaciente.php', true);
    xhr.addEventListener('load', ()=>{
        console.log(xhr.response);
        
        let respuesta = JSON.parse(xhr.response);
        if (respuesta.length > 0) {
            let tablaCitasHoy = document.getElementById('citas_hoy');
            tablaCitasHoy.innerHTML = '';
            for(let cita of respuesta){
                tablaCitasHoy.innerHTML+=`
                                        <tr>
                                                <td>${cita.nombre}</td>
                                                <td>${cita.hora}</td>
                                                <td>${cita.tipo}</td>
                                                <td>${cita.motivo}</td>
                                            </tr>
                `
            };
            
        }else{
            let tablaCitasHoy = document.getElementById('vacio');
            tablaCitasHoy.innerHTML = "<p class='text-center h6'>No hay citas para hoy.</p>";
        }
        
    });
    
    xhr.send(datos);
}
graficaAtendidos(id_medico);
citas(id_medico);

citarHoy(id_medico);

function resumen(id_medico) {
    let datos = new  FormData();
    datos.append("id_medico", id_medico);
    datos.append("accion","resumen");
    let xhr = new XMLHttpRequest();
    xhr.open('POST', './php/graficaPaciente.php', true);
    xhr.addEventListener('load', ()=>{
        
        let respuesta = JSON.parse(xhr.response);
        console.log(respuesta);
        
       document.getElementById('tPaceintes').textContent = respuesta[0].total_pacientes;
       document.getElementById('tCitasHoy').textContent = respuesta[0].citas_hoy;
       document.getElementById('tConsulRealizadas').textContent = respuesta[0].consultas_medico;



    });
    xhr.send(datos);
    
}

resumen(id_medico);


       
