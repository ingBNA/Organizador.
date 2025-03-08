<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Mensual</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="asstes/js/actualizarDatos.js"></script>
</head>
<body>
    <h1>Reporte <?php echo htmlspecialchars($_POST['tipoReporte']); ?></h1>

    <!-- Div para mostrar los totales por categoría solo en el reporte mensual -->
    <div id="totalesMensuales" style="display: none;">
        <p id="totalEnfermedades"></p>
        <p id="totalProblemas"></p>
        <p id="totalAlumnos"></p>
        <p id="totalMaterias"></p>
    </div>

    <div style="width: 53%; height: 43%; overflow: hidden;">
        <canvas id="miGrafica" width="400" height="300"></canvas>
    </div>
    
    <script>
        var ctx = document.getElementById('miGrafica').getContext('2d');
        var tipoReporte = "<?php echo $tipoReporte; ?>";
        var dataLabels = [];
        var dataCounts = {
            enfermedades: [],
            problemas: [],
            alumnos: [],
            materias: []
        };
        //para mostrar las los resultados con el if, en caso sde ser varios 
        if (tipoReporte === 'general') {
            // Configuración para el reporte general
            dataLabels = ['Apoyo y salud', 'Alumnos', 'Materias'];
            dataCounts = {
                enfermedades: [<?php echo count($datos['enfermedades']); ?>],
                problemas: [],
                alumnos: [<?php echo count($datos['alumnos']); ?>],
                materias: [<?php echo count($datos['materias']); ?>]
            };
               // Mostrar el div de totales y asignar los valores por categoría
               document.getElementById('totalesMensuales').style.display = 'block';
            document.getElementById('totalEnfermedades').textContent = "Total de apoyo y salud registrados: " + dataCounts.enfermedades.reduce((a, b) => a + b, '');
            document.getElementById('totalAlumnos').textContent = "Total de alumnos registrados: " + dataCounts.alumnos.reduce((a, b) => a + b, '');
            document.getElementById('totalMaterias').textContent = "Total de materias registrados: " + dataCounts.materias.reduce((a, b) => a + b, '');

        } else if (tipoReporte === 'mensual') {
            // Configuración para el reporte mensual
            dataLabels = ['Apoyo y salud', 'Alumnos', 'Materias'];
            dataCounts = {
                enfermedades: [<?php echo count($datos['enfermedades']); ?>],
                problemas: [],
                alumnos: [<?php echo count($datos['alumnos']); ?>],
                materias: [<?php echo count($datos['materias']); ?>]
            };

            // Mostrar el div de totales y asignar los valores por categoría
            document.getElementById('totalesMensuales').style.display = 'block';
            document.getElementById('totalEnfermedades').textContent = "Total de apoyo y salud consecutivas por mes: " + dataCounts.enfermedades.reduce((a, b) => a + b, '');
            document.getElementById('totalAlumnos').textContent = "Total de meses consecutivas de alumnos " + dataCounts.alumnos.reduce((a, b) => a + b, '');
            document.getElementById('totalMaterias').textContent = "Total de materias consecutivas por mes: " + dataCounts.materias.reduce((a, b) => a + b, '');

        } 
        //mostramos los colores de cada grafica 
        var miGrafica = new Chart(ctx, {
            type: '<?php echo htmlspecialchars($_POST['tipoGrafica']); ?>',
            data: {
                labels: dataLabels, 
                datasets: [{
                    label: 'Registros',
                    data: Object.values(dataCounts).flat(),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
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
    </script>
</body>
</html>
