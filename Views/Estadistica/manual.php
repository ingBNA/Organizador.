<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador Gráfico</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="assets/manual.css">
    <style>
        .container { display: flex; gap: 20px; }
        .form-section { width: 41%; }
        .chart-section { width: 41%; }
        .input-group { display: flex; gap: 10px; margin-bottom: 10px; }
        .input-group input { flex: 1; }
    </style>
</head>
<body>
    <h1>Gráfica Manual</h1>
    <div class="container">
        <div class="form-section">
            <label for="tipoGrafico"><h2>Tipo de Gráfico</h2></label>
            <select id="tipoGrafico" onchange="actualizarGrafico()">
                <option value="pie">Gráfico Circular</option>
                <option value="bar">Gráfico de Barras</option>
                <option value="radar">Gráfico de Radar</option>
                <option value="line">Gráfico de Líneas</option>
                <option value="doughnut">Gráfico de Dona</option>
            </select>
            <div id="gastosContainer">
                <h2>Ingrese los datos</h2>
                <div class="input-group">
                    <input type="text" placeholder="Ingrese el nombre" class="categoria">
                    <input type="number" placeholder="Ingrese el total" class="cantidad">
                </div>
            </div>
            <button onclick="agregarGrafica()">+</button>
            <button onclick="actualizarGrafico()">Crear Gráfico</button>
            <button onclick="descargarGrafico()">Descargar Gráfico</button> <!-- Botón de descarga -->
        </div>
        <div class="chart-section">
            <canvas id="graficoGastos"></canvas>
        </div>
    </div>

    <script>
        let grafico;
        //metodo para agregar mas columnas para la grafica
        function agregarGrafica() {
            const container = document.getElementById("gastosContainer");
            const newInputGroup = document.createElement("div");
            newInputGroup.classList.add("input-group");
            newInputGroup.innerHTML = `
                <input type="text" placeholder="Ingrese el nombre" class="categoria">
                <input type="number" placeholder="Total" class="cantidad">
            `;
            container.appendChild(newInputGroup);
        }
        //obtenemos los datos para convertirlos 
        function obtenerDatos() {
            const categorias = document.querySelectorAll(".categoria");
            const cantidades = document.querySelectorAll(".cantidad");
            const labels = [];
            const data = [];

            categorias.forEach((cat, index) => {
                const categoria = cat.value;
                const cantidad = cantidades[index].value;
                if (categoria && cantidad) {
                    labels.push(categoria);
                    data.push(Number(cantidad));
                }
            });

            return { labels, data };
        }
        //actualizamos los datos si necesitamos editar 
        function actualizarGrafico() {
            const tipoGrafico = document.getElementById("tipoGrafico").value;
            const { labels, data } = obtenerDatos();

            if (grafico) {
                grafico.destroy();
            }
            //configuramos la grafica para poder mostrarla
            const ctx = document.getElementById("graficoGastos").getContext("2d");
            grafico = new Chart(ctx, {
                type: tipoGrafico,
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Reporte del Mes',
                        data: data,
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'],
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'right'
                        }
                    },
                    scales: tipoGrafico === 'bar' || tipoGrafico === 'line' ? {
                        y: {
                            beginAtZero: true
                        }
                    } : {}
                }
            });
        }
        //configuracion para descargar la grafica en forma de imagen
        function descargarGrafico() {
            const canvas = document.getElementById("graficoGastos");
            const image = canvas.toDataURL("image/png", 1.0).replace("image/png", "image/octet-stream");
            const link = document.createElement('a');
            link.href = image;
            link.download = 'grafico.png'; // Nombre del archivo a descargar
            link.click();
        }
    </script>
</body>
</html>