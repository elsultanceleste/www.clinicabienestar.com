const ctx = document.getElementById('grafica');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
      datasets: [{
        label: 'Cantidad',
        data: [12, 19, 20, 70, 40,15,50,25,29,15,20,46],
        barThickness: 20,
        backgroundColor: 'rgba(65, 123, 97 ,0.5)',
        borderColor: '#417b61',
        borderWidth: 1,
      }]
    },
    options: {
        Plugins:{
            legend:{
                display:false
            }
        },
       
      scales: {
        y: {
          beginAtZero: true,
          grid:{
            display: false
          },
          ticks: {
            display: true
          },
          border:{
            display: false
          },
          
        },

        x:{
            grid:{
                display: false
            },
            border:{
                display: false
            },
        }
      }
    }
  });