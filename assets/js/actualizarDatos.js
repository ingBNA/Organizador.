let miGrafica;

function actualizarGrafica() {
    fetch('Views/estadistica/actualizarDatos.php')
        .then(response => response.json())
        .then(data => {
            // Configuración de etiquetas para cada mes
            const dataLabels = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

            // Crear datasets para cada tipo de dato
            const datasets = [
                {
                    label: 'Enfermedades',
                    data: data.enfermedadesPorMes,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Problemas',
                    data: data.problemasPorMes,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Alumnos',
                    data: data.alumnosPorMes,
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Materias',
                    data: data.materiasPorMes,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }
            ];

            // Destruir la gráfica anterior si existe y crear una nueva
            if (miGrafica) {
                miGrafica.destroy();
            }
            crearGrafica('bar', dataLabels, datasets);
        })
        .catch(error => console.error('Error al actualizar los datos:', error));
}

setInterval(actualizarGrafica, 1000);

function crearGrafica(tipoGrafica, dataLabels, datasets) {
    let ctx = document.getElementById('miGrafica').getContext('2d');
    miGrafica = new Chart(ctx, {
        type: tipoGrafica,
        data: {
            labels: dataLabels,
            datasets: datasets
        },
        options: {
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Meses del Año'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Cantidad'
                    }
                }
            }
        }
    });
}

