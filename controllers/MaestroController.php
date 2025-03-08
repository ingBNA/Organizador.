<?php 
    class MaestroController{

        function __construct(){
            if(session_status() === PHP_SESSION_NONE){
                session_start();  //creamos una instancia para mandarlo al controlador
            }
        }
        
        function index(){
            require_once('index.php'); 
        }
        function modulos(){
            require_once('Views/modulos/listaModulos.php');
        }
        function ModuloMaestro(){
            require_once('Views/Modulos/moduloMaestro.php');
        }
        function save(){
            //revisar el proceso de alumnoController y alumno para guardar los datos
            if(!empty($_POST['nombre'] && !empty($_POST['telefono']) && !empty($_POST['numero_empleado']) && !empty($_POST['correo']) && !empty($_POST['especialidad']))){
          
            $maestro= new Maestro(null,
            $_POST['nombre'],
            $_POST['telefono'],
            $_POST['numero_empleado'],
            $_POST['correo'],
            $_POST['especialidad']
            );
            //lo mandamos a guardar al maestro a la DB
            $resultado = Maestro::save($maestro);
            if($resultado){
                header('Location: index.php?controller=maestro&action=ModuloMaestro');
                exit();
            }
            else{
                header('Location: index.php?controller=maestro&action=ModuloMaestro');
                exit();
            }
          }
        }
        //lo mandamos a modulo maestro 
        function listaMaestro(){
            //se obtiene la lista de todos los maestros y se convierte en una lista
            $listaMaestros= Maestro::all();
            require_once('Views/Listas/listaMaestros.php');
        }
        function updateMaestro(){
            if(isset($_GET['id']) && !empty($_GET['id'])){
                $id = $_GET['id'];

                $maestro = Maestro::searchById($id);

                if($maestro){
                    require_once('Views/modulos/updateMaestro.php');
                } else{
                    echo "No se encontro el maestro con ID.";
                }
            } else{
                echo "ID del maestro no especificado.";
            }
        }
        //Hacer mismo proceso como el AlumnoController y Alumno 
        //revisar por que arroja a else (no encuentra la id)
        function Update(){
          //Actualizacion del maestro 
          if(isset($_POST['id']) && !empty($_POST['id'])){
            $maestro = new Maestro(
                $_POST['id'],
                $_POST['nombre'] ?? '',
                $_POST['telefono'] ?? '',
                $_POST['numero_empleado'] ?? '',
                $_POST['correo'] ?? '',
                $_POST['especialidad'] ?? ''
            );

            $resultado = Maestro::Update($maestro);

            if($resultado){
                header('Location: index.php?controller=maestro&action=listaMaestro');
                exit();
            }else {
                echo "Error al actualizar los datos.";
            }
          }else{
            echo "ID del docente encontrada";
          }
        }
        //verificar si es Maestro o maestro
        function delete(){
            //Eliminar maestro por ID
            if(isset($_GET['id']) && is_numeric($_GET['id'])){
                $id = $_GET['id'];
                //llamamos la funcon delete para maestro
                Maestro::delete($id);
                header('Location: index.php?controller=maestro&action=listaMaestro');
                exit();
            }
        }
    }

?>