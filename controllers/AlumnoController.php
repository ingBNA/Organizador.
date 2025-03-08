<?php 
    class AlumnoController{

        function __construct(){
            if(session_status() === PHP_SESSION_NONE){
            session_start(); // se crea una instancia para mandarlo al controlador
            
            }    
        }

        function index(){
            require_once ('index.php');
        }
        //aqui entra modulo alumnos
        function modulos(){
            require_once('Views/modulos/listaModulos.php');
        }
        //entra a creacion de datos
        function ModuloAlumno(){
            require_once('Views/modulos/ModuloAlumno.php');
        }
        //No tocar save, se mueve todo
        //al menos para agregar, no para modificar.
        function save(){
        
            if (!empty($_POST['nombre']) &&!empty($_POST['matricula']) &&!empty ($_POST['grupo']) &&!empty($_POST['telefono']) &&!empty($_POST['tutor']) &&!empty($_POST['telefono_tutor']) &&!empty($_POST['estado'])) {
                $alumno = new Alumno(
                null,    
                $_POST['nombre'],
                $_POST['matricula'],
                $_POST['grupo'],
                $_POST['telefono'],
                $_POST['tutor'],
                $_POST['telefono_tutor'],
                $_POST['estado']
            );
            //establecemos el estado correctamente 
          

            //Guardamos al alumno a la DB
            $resultado = Alumno::save($alumno);
            if($resultado){
                $_SESSION['mensaje'] = 'Alumno guardado correctamente';
                header('Location: index.php?controller=alumno&action=listaAlumno');
                exit();
            }
            else{
                echo "error al guardar el alumno: " . $resultado;
            }


            }
        }
        //mandamos al require_once el modulo alumnos 
        function listaAlumno() {
            $listaAlumnos= Alumno::all();
            require_once('Views/Listas/listaAlumnos.php');
        }
     
        //actualizacion de datos del alumnno y ver la actualizacion 
        function updateAlumno(){
            //var_dump($_GET);
            if(isset($_GET['id']) && !empty($_GET['id'])){
                $id = $_GET['id'];

                $alumno = Alumno::searchById($id);
                
                if ($alumno) {
                    require_once('Views/modulos/updateAlumno.php');
                } else {
                    echo "No se encontró el alumno con ID:" . htmlspecialchars($id);
                }
            } else {
               // var_dump($_GET);
                echo "ID del alumno no especificado.";
            }
            
        }
          
            //buscar informacion acerca de actualizar los datos
            //revisar todos los controladores de la clase Alumno 
            //solo hay un error al actualiza 
        function update(){  
            if (isset($_POST['id']) && !empty($_POST['id'])) {
                $alumno = new Alumno(
                    $_POST['id'], //Id establecido correctamene, verificar correctamente 
                    $_POST['nombre'] ?? '',
                    $_POST['matricula'] ?? '',
                    $_POST['grupo'] ?? '',
                    $_POST['telefono'] ?? '',
                    $_POST['tutor'] ?? '',
                    $_POST['telefono_tutor'] ?? '',
                    $_POST['estado']?? ''
                );
            
                $resultado = Alumno::update($alumno);
            
                if ($resultado) {
                    //verificar si quitandolo ya no arroja a listaAlumno cuando se actualize
                    header('Location: index.php?controller=alumno&action=listaAlumno');
                    exit();
                } else {
                    echo "Error al actualizar los datos.";
                }
            } else {
                var_dump($_POST);
                echo "ID del alumno no encontrada.";
            }
        }
      
        function delete(){
            //Eliminar alumno por ID
            if(isset($_GET['id'])&& is_numeric($_GET['id'])){
            $id=$_GET['id'];
            //llamamos la funcion delete para Alumno
            Alumno::delete($id);
            header('Location: index.php?controller=alumno&action=listaAlumno');
            exit();
        }
    }

    }    

?>