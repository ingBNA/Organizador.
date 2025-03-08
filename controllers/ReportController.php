<?php 
require_once 'Model/Grafica.php';

class ReportController {
    private $grafica;

    public function __construct() {
        $this->grafica = new Grafica(); // Instancia de la clase que maneja las consultas
    }

    // Método para seleccionar el reporte
    public function seleccionarReporte() {
        require_once 'views/estadistica/reporte.php';
    }

    // Método para generar el reporte general, mes, semestre y tota por cada base de datos
    public function generarReporte() {
        $tipoReporte = $_POST['tipoReporte']; // Tipo de reporte
        $tipoGrafica = $_POST['tipoGrafica']; // Tipo de gráfica seleccionada
    
        $datos = [];
    
        // Obtener los datos según el tipo de reporte seleccionado
        switch ($tipoReporte) {
            case 'general':
                $datos['enfermedades'] = $this->grafica->contarEnfermedadesPorId();  // Enfermedades por día
                $datos['problemas'] = $this->grafica->contarProblemasPorId();        // Problemas por día
                $datos['alumnos'] = $this->grafica->contarAlumnosPorId();                 // Total de alumnos
                $datos['materias'] = $this->grafica->contarMateriasPorId();         // Materias con problemas por día
                break;
            case 'mensual':
                $datos['enfermedades'] = $this->grafica->contarEnfermedadesPorMes();  // Enfermedades por mes
                $datos['problemas'] = $this->grafica->contarProblemasPorMes();        // Problemas por mes
                $datos['alumnos'] = $this->grafica->contarAlumnosPorMes();                 // Total de alumnos por mes
                $datos['materias'] = $this->grafica->contarMateriasPorMes();   
                
                //se agrera los reportes por totales de mes 
              
                break;
            // Puedes agregar más casos para otros tipos de reportes, como por semestre, etc.
            default:
                echo "No se encontraron datos para el reporte seleccionado.";
                break;
        }
    
        // Mostrar la vista con la gráfica y los datos obtenidos
        if (!empty($datos)) {
            require_once 'Views/estadistica/verReporte.php';
        }
    }

    // Método para actualizar los datos y retornarlos como JSON
    public function actualizarDatos() {
        // Recoger los datos de los diferentes métodos de la clase Grafica
        $datos = [];
        $datos['enfermedades'] = $this->grafica->contarEnfermedadesPorId(); // Enfermedades por día
        $datos['problemas'] = $this->grafica->contarProblemasPorId();       // Problemas por día
        $datos['alumnos'] = $this->grafica->contarAlumnosPorId();                // Total de alumnos
        $datos['materias'] = $this->grafica->contarMateriasPorId();        // Materias con problemas por día

        $datos['enfermedades'] = $this->grafica->contarEnfermedadesPorDiaYMes(); //enfermedades por dia y mes
        $datos['problemas'] = $this->grafica->contarProblemasPorDiaYMes();      //problemas por dia y mes
        $datos['alumnos'] = $this->grafica->contarAlumnosPorDiaYMes();
        $datos['materias'] =$this->grafica->contarMateriasPorDiaYMes();
        // Enviar los datos como respuesta en formato JSON
        header('Content-Type: application/json');
        echo json_encode($datos);
    }
}
?>
