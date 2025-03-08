<?php
/**
 * Auth@r:Francisco Javier Hernandez Ballona
 * FECHA DE DESARROLLO: AGOSTO 15 DEL 2024
 */
require_once 'Db/DBConexion.php';
require_once 'Model/User.php';
require_once 'Model/Maestro.php';
require_once 'Model/Alumno.php';
require_once 'Model/Materia.php';
require_once 'Model/Apoyo.php';
require_once 'controllers/UserController.php';
require_once 'controllers/MaestroController.php';
require_once 'controllers/AlumnoController.php';
require_once 'controllers/SearchController.php';
require_once 'controllers/DocumentoController.php';
require_once 'controllers/MateriaController.php';
require_once 'controllers/ApoyoController.php';
require_once 'controllers/ReportController.php';
require_once 'controllers/manualReport.php';



//es el controlador principal para la funcion de todo el sistema
//Se agregara estadisticas los reportes por separado
$controllers = array(
    'alumno' => ['index', 'createUser', 'register', 'ModuloAlumno', 'save', 'listaAlumno', 'menu','update', 'updateAlumno', 'delete', 'error'],
    'maestro' => ['index', 'createUser', 'register', 'ModuloMaestro', 'save','listaMaestro',  'menu','Update','updateMaestro', 'delete', 'error'],
    'materia' =>['ModuloMateria', 'problemaMateria', 'updateMateria', 'save','delete','update','updateMateria'],
    'apoyo'=>['ModuloApoyo', 'save','delete','updateApoyo','update','apoyoSalud'],
    'documento' => ['index','listarDocumento','subirDocumento', 'descargarDocumento','eliminarDocumento','actualizarDatos'],
    'search'=> ['search'],
    'estadistica' =>['seleccionarReporte','generarReporte','obtenerDatosPorDia','actualizarDatos','obtenerDatosPorMes',],
    'graficoManual' =>['manual'],
    'user' => ['login','createUser','home','listaModulos','cambiarContraseña','procesarRestablecimiento','restablecerContraseña','Listas','logout']  // Controlador de usuario para login y logout
);

$controller = isset($_GET['controller']) ? $_GET['controller'] : 'user';
$action = isset($_GET['action']) ? $_GET['action'] : 'login';

if ($controller === 'documento' && $action === 'eliminarDocumento') {
    if (isset($_GET['id_documento'])) {
        $id_documento = $_GET['id_documento'];  // Capturamos el id_documento de la URL
        $controller = new DocumentoController();
        $controller->eliminarDocumento($id_documento);
        exit();  // Terminamos aquí después de eliminar el documento
    } else {
        die('ID del documento no proporcionado');  // Manejar el error si no se pasa el id_documento
    }
}

if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
        call($controller, $action);
    } else {
        call('user', 'login');  // Redirigir a login si la acción no existe
    }
} else {
    call('user', 'login');  // Redirigir a login si el controlador no existe
}
//agregamos switch para agregar los controladores y para que funcione los controladores
// 
function call($controller, $action) {
    switch ($controller) {
        case 'alumno':
            require_once('controllers/AlumnoController.php');
            $controller = new AlumnoController();
            break;
        case 'maestro':
            require_once('controllers/MaestroController.php');
            $controller = new MaestroController();
            break;
        case 'materia':
            require_once('controllers/MateriaController.php');
            $controller = new MateriaController();
            break;
        case 'apoyo':
            require_once('controllers/ApoyoController.php');
            $controller = new ApoyoController();
            break;
        case 'user':
            require_once('controllers/UserController.php');
            $controller = new UserController();
            break;
        case 'search':
            require_once('controllers/SearchController.php');
            $controller = new SearchController();
            break;
        case 'documento':
            require_once ('controllers/DocumentoController.php');
            $controller = new DocumentoController();
            break;
        case 'estadistica':
            require_once ('controllers/ReportController.php');
            $controller = new ReportController();
            break;
        case 'graficoManual':
            require_once('controllers/manualReport.php');
            $controller = new manualReport();
            break;
        default:
            // En caso de que no se encuentre el controlador
            call('user', 'login');
            return;
    }

    $controller->{$action}();
}
?>
