<?php
class ApoyoController{
    function __construct(){
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
    }
    function index(){
        require_once ('index.php');
    }
    //entra en modulos
    function modulos(){
        require_once('Views/modulos/listaModulos.php');
    }
    function ModuloApoyo(){
        require_once('Views/modulos/ModuloApoyo.php');
    }
    function save(){
          // Aquí validamos solo los campos que realmente son obligatorios, como "nombre", "grupo" y "matricula"
          //en caso de agregar otro obligatorio, llenarlo en post
        if(!empty($_POST['nombre'])&&!empty($_POST['matricula']) &&!empty($_POST['grupo']) ){
            $apoyo = new Apoyo(
                null,
                $_POST['nombre'],
                $_POST['matricula'],
                $_POST['grupo'],
                $_POST['enfermedad']?? '',
                $_POST['ayuda']?? '',
                $_POST['solucion']?? ''
            );
            //Guardamos el apoyo a la DB
            $resultado = Apoyo::save($apoyo);
            if($resultado){
                $_SESSION['mensaje'] = 'Alumno guardado correctamente';
                header('Location: index.php?controller=apoyo&action=apoyoSalud');
                exit();
            }
            else{
                echo "Error al guardar el alumno: ". $resultado;
            }
        }
    }
            function apoyoSalud(){
                $listaApoyo = Apoyo::all();
                require_once('Views/Listas/apoyoSalud.php');
            }
            //Actualizacioon de datos del alumno y ver la actualizacion
            function updateApoyo(){
                if(isset($_GET['id']) &&!empty($_GET['id'])){
                    $id =$_GET['id'];

                    $apoyo = Apoyo::searchById($id);

                    //falta agregar el update de apoyo
                    if($apoyo){
                        require_once('Views/modulos/updateApoyo.php');
                    }else{
                        echo "No se encontro el alumno con ID: " . htmlspecialchars($id);
                    }
                }else {
                    echo "ID no especificado";
                }
            }
            function update(){
                if(isset($_POST['id']) &&!empty($_POST['id'])){
                    $apoyo = new Apoyo(
                        $_POST['id'], //Id establecido correctamene, verificar correctamente 
                        $_POST['nombre'] ?? '',
                        $_POST['matricula'] ?? '',
                        $_POST['grupo'] ?? '',
                        $_POST['enfermedad'] ?? '',
                        $_POST['ayuda'] ?? '',
                        $_POST['solucion'] ?? '' 
                    );
                    $resultado = Apoyo::update($apoyo);

                    if($resultado){
                        header('Location: index.php?controller=apoyo&action=apoyoSalud');
                        exit();
                    }else {
                        echo "Error al actualizar los datos";
                    }
                }else{
                    echo "Id del alumno no encontrada";
                }
            }
            function delete(){
                //eliminamos el alumno por ID
                if(isset($_GET['id'])&& is_numeric($_GET['id'])){
                    $id=$_GET['id'];
                    //llamamos la funcion delete para Alumno
                    Apoyo::delete($id);
                    header('Location: index.php?controller=apoyo&action=apoyoSalud');
                    exit();
                }
            }
} 
?>