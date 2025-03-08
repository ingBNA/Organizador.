<?php 
    //para la lista de problema materia 
    class MateriaController{
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
            function ModuloMateria(){
                require_once('Views/modulos/ModuloMaterias.php');
            }
            function save(){
                if(!empty($_POST['nombre']) &&!empty($_POST['matricula']) &&!empty ($_POST['grupo'])&&!empty($_POST['problema'])&&!empty($_POST['solucion'])){
                    $materia = new Materia(
                        null,
                        $_POST['nombre'],
                        $_POST['matricula'],
                        $_POST['grupo'],
                        $_POST['problema'],
                        $_POST['solucion']
                    ); 
                }
                 //Guardamos al alumno a la DB
            $resultado = Materia::save($materia);
            if($resultado){
                $_SESSION['mensaje'] = 'Alumno guardado correctamente';
                header('Location: index.php?controller=materia&action=problemaMateria');
                exit();
            }
            else{
                echo "error al guardar el alumno: " . $resultado;
            }
        }
        function problemaMateria(){
            $problemaMaterias = Materia::all();
            require_once('Views/Listas/problemaMateria.php');
        }
        
        //actualizacion de datos del alumnno y ver la actualizacion 
        function updateMateria(){
            //var_dump($_GET);
            if(isset($_GET['id']) && !empty($_GET['id'])){
                $id = $_GET['id'];

                $materia = Materia::searchById($id);
                
                if ($materia) {
                    require_once('Views/modulos/updateMateria.php');
                } else {
                    echo "No se encontró el alumno con ID:" . htmlspecialchars($id);
                }
            } else {
               // var_dump($_GET);
                echo "ID del alumno no especificado.";
            }
            
        }
             //solo hay un error al actualiza 
             function update(){  
                if (isset($_POST['id']) && !empty($_POST['id'])) {
                    $materia = new Materia(
                        $_POST['id'], //Id establecido correctamene, verificar correctamente 
                        $_POST['nombre'] ?? '',
                        $_POST['matricula'] ?? '',
                        $_POST['grupo'] ?? '',
                        $_POST['problema'] ?? '',
                        $_POST['solucion']?? ''
                    );
                
                    $resultado = Materia::update($materia);
                
                    if ($resultado) {
                        //verificar si quitandolo ya no arroja a listaAlumno cuando se actualize
                        header('Location: index.php?controller=materia&action=problemaMateria');
                        exit();
                    } else {
                        echo "Error al actualizar los datos.";
                    }
                } else {
                    //var_dump($_POST);
                    echo "ID del alumno no encontrada.";
                }
            }
            function delete(){
                //Eliminar alumno por ID
                if(isset($_GET['id'])&& is_numeric($_GET['id'])){
                $id=$_GET['id'];
                //llamamos la funcion delete para Alumno
                Materia::delete($id);
                header('Location: index.php?controller=materia&action=problemaMateria');
                exit();
            }
        }
   }
?>