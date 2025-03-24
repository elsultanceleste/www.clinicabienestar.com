function cargarGraficaCitas() {
    let xhr = new XMLHttpRequest();
    xhr.open('POST', './php/graficaCitas.php', true);
    xhr.addEventListener('load', () => {
        console.log(xhr.response);
        
        let respuesta = JSON.parse(xhr.response);
        
        const ctx = document.getElementById('myChart').getContext('2d');

        new Chart(ctx, {
            type: "bar",
            data: {
                labels: [
                    "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
                    "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
                ],
                datasets: [
                    {
                        label: "Revision",
                        data: respuesta.map(dato => dato.revisiones || 0),
                        backgroundColor: ["#FFC10797"],
                        borderColor: ["#ffc107"],
                        borderWidth: 1.5,
                        borderRadius: 3,
                        barThickness: 20,
                    },
                    {
                        label: "Analisis",
                        data: respuesta.map(dato => dato.analisis || 0),
                        backgroundColor: ["#417B61D1"],
                        borderColor: ["#417B61FF"],
                        borderWidth: 1.5,
                        borderRadius: 3,
                        barThickness: 20,
                    },
                    {
                        label: "Consultas",
                        data: respuesta.map(dato => dato.consultas || 0),
                        backgroundColor: ["#007BFFA4"],
                        borderColor: ["#007bff"],
                        borderWidth: 1.5,
                        borderRadius: 3,
                        barThickness: 20,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            font: {
                                size: 14,
                                family: "Arial, sans-serif",
                            },
                            color: "#333",
                        },
                    },
                },
                scales: {
                    x: {
                        grid: {
                            display: false,
                        },
                        ticks: {
                            color: "#555",
                            font: {
                                size: 12,
                            },
                        },
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: "rgba(0, 0, 0, 0.1)",
                            borderDash: [5, 5],
                        },
                        ticks: {
                            color: "#555",
                            font: {
                                size: 12,
                            },
                        },
                    },
                },
            },
        });
    });
    xhr.send();
}

// Cargar la gráfica al iniciar
cargarGraficaCitas();