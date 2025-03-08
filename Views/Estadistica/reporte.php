<?php require_once 'Views/menu.php';?>

<link rel="stylesheet" href="assets/reporte.css">

<h1>Generador de reportes</h1>
<div class="opciones">
<form method="POST" action="index.php?controller=estadistica&action=generarReporte">
    <label for="tipoReporte">Seleccione el reporte</label>
    <!--tendra que ser por separado -->
    <select  class="seleccion" name="tipoReporte" id="tipoReporte">
        <option value="general">Reporte  por cada registro</option>
        <option value="mensual">Reporte por mes</option>
        
        
    </select>
    <br><br>
    <label  for="tipoGrafica">Seleccione el tipo de gráfica</label>
    <select  class="" name="tipoGrafica" id="tipoGrafica">
        <option value="bar">Barra Horizontal</option>
        <option value="pie">Gráfica de Pastel</option>
        <option value="line">Gráfica Lineal</option>
        <option value="radar">Gráfica de Radar</option>
        <option value="polarArea">Gráfica de Polar Area</option>
        <!--<option value="multiAxisLine">Grafica de multi Axis</option>-->
    </select>
    <br><br>

    <button type="submit" class="reporte">Generar reporte</button>
</form>




<!--Se agregara de forma manual un generador de reportes-->
    <br>
    ----o generalo de la forma manual----<br><br>
    <a class="manual" href="index.php?controller=graficoManual&action=manual">reporte manual</a></>


       
</div>
<?php 
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        //llamamos al controlador 
        require_once 'controllers/ReportController.php';
        $controller = new ReportController();
        $controller->generarReporte();
    }
?>
