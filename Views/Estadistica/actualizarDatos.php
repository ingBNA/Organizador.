<?php
require_once 'Grafica.php';

$grafica = new Grafica();

// Obtener los datos de cada categoría para todos los meses del año
$enfermedadesPorMes = $grafica->contarEnfermedadesPorMes();
$problemasPorMes = $grafica->contarProblemasPorMes();
$alumnosPorMes = $grafica->contarAlumnosPorMes();
$materiasPorMes = $grafica->contarMateriasPorMes();

// Formatear los datos para asegurar que se incluyan los 12 meses en cada categoría
$datosPorMes = function($array) {
    $resultado = array_fill(1, 12, 0); // Llenar los 12 meses con valor 0
    foreach ($array as $registro) {
        $mes = (int)$registro['mes']; // Convertir el mes a entero
        $resultado[$mes] = (int)$registro['total'];
    }
    return $resultado;
};

// Preparar los datos en formato JSON
$data = [
    'enfermedadesPorMes' => $datosPorMes($enfermedadesPorMes),
    'problemasPorMes' => $datosPorMes($problemasPorMes),
    'alumnosPorMes' => $datosPorMes($alumnosPorMes),
    'materiasPorMes' => $datosPorMes($materiasPorMes)
];

header('Content-Type: application/json');
echo json_encode($data);
?>

