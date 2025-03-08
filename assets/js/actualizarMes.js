let miGrafica; // Definimos miGrafica en un ámbito del archivo

function actualizarGrafica() {
    fetch('Views/estadistica/actualizarDatos.php') 
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor');
            }
            return response.json();
        })
        .then(data => {
            // Definimos las etiquetas y los conteos para mostrar
            let dataLabels = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
            let dataCounts = [
                data.enfermedadesPorMes.reduce((total, mes) => total + mes.cantidad, 0), // Suponiendo que tienes esta estructura
                data.problemasPorMes.reduce((total, mes) => total + mes.cantidad, 0),
                data.alumnosPorMes.reduce((total, mes) => total + mes.cantidad, 0),
                data.materiasPorMes.reduce((total, mes) => total + mes.cantidad, 0)
            ];

            // Destruir la gráfica anterior si existe
            if (miGrafica) {
                miGrafica.destroy();
            }
            // Crear una nueva gráfica con los datos mensuales
            crearGrafica(dataLabels, dataCounts);
        })
        .catch(error => console.error('Error al actualizar los datos:', error));
}

// Actualizamos a tiempo real, cada 10000 ms (10 segundos) como ejemplo
setInterval(actualizarGrafica, 10000);

function crearGrafica(dataLabels, dataCounts) {
    let ctx = document.getElementById('miGrafica').getContext('2d');
    miGrafica = new Chart(ctx, {
        type: 'bar', // Puedes cambiar el tipo de gráfica según lo necesites
        data: {
            labels: dataLabels,
            datasets: [{
                label: 'Reporte mensual',
                data: dataCounts,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true 
                }
            }
        }
    });
}

// Llamar a la función una vez al iniciar para cargar la gráfica inicialmente
actualizarGrafica();