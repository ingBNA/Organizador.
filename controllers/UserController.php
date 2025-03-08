<?php 
require_once 'Model/User.php';

class UserController {
    
    public function createUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $correo = $_POST['correo'];
            $contrasena = $_POST['contrasena'];

            $userModel = new User(null, $nombre, $apellidos, $correo, $contrasena);
            $userModel->createUser($nombre, $apellidos, $correo, $contrasena);
            header('Location: index.php?controller=user&action=login');
            exit();
        } else {
            require_once('Views/createUser.php');
        }
    }
    public function restablecerContraseña() {
        require_once 'Views/RestablecerContraseña.php';
    }

    public function mostrarFormularioCambioContraseña() {
        if (isset($_GET['user_id'])) {
            $user_id = $_GET['user_id'];
            require_once 'Views/cambioContraseña.php';
        } else {
            echo "No se ha especificado un usuario válido.";
        }
    }
    //verificar
    public function cambiarContraseña() {
        // Si se ha enviado el formulario (método POST)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verifica que todos los datos hayan sido enviados
            if (isset($_POST['user_id']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
                $user_id = $_POST['user_id'];
                $nueva_contraseña = $_POST['password'];
                $confirmar_contraseña = $_POST['confirm_password'];
    
                if ($nueva_contraseña === $confirmar_contraseña) {
                    // Hasheamos la nueva contraseña
                    $password_hash = password_hash($nueva_contraseña, PASSWORD_BCRYPT);
    
                    // Actualizamos la contraseña en la base de datos
                    $resultado = User::actualizarContraseña($user_id, $password_hash);
    
                    if ($resultado) {
                        echo "Contraseña actualizada exitosamente.";
                        header('Location: index.php?controller=user&action=login');
                        exit;
                    } else {
                        echo "Error al actualizar la contraseña.";
                    }
                } else {
                    echo "Las contraseñas no coinciden.";
                }
            } else {
                echo "Datos incompletos.";
            }
        } 
        // Si no se ha enviado el formulario, muestra el formulario (método GET)
        else {
            if (isset($_GET['user_id'])) {
                $user_id = $_GET['user_id'];
    
                // Incluye el formulario de cambio de contraseña
                require_once 'Views/cambioContraseña.php';
            } else {
                echo "Datos incompletos.";
            }
        }
    }
  
    //verificar
    public function procesarRestablecimiento() {
        if (isset($_POST['correo'])) {
            $email = $_POST['correo'];
            $usuario = User::obtenerPorCorreo($email);

            if ($usuario) {
                $user_id = $usuario['id'];
                header("Location: index.php?controller=user&action=cambiarContraseña&user_id=$user_id"); // Usar comillas dobles aquí
                exit;
            } else {
                echo "Correo no encontrado.";
            }
        } else {
            echo "Por favor, introduce un correo electrónico.";
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $correo = isset($_POST['correo']) ? $_POST['correo'] : null;
            $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : null;

            if ($correo && $contrasena) {
                $userModel = new User();
                $user = $userModel->login($correo, $contrasena);

                if ($user) {
                    session_start();
                    $_SESSION['user'] = $user;
                    header('Location: index.php?controller=user&action=home');
                    exit();
                } else {
                    $error = "Credenciales inválidas";
                    require_once 'Views/Login.php';
                }
            } else {
                $error = "Por favor, complete todos los campos.";
                require_once 'Views/Login.php';
            }
        } else {
            require_once 'Views/Login.php';
        }
    }

    public function listaModulos() {
        require_once 'Views/modulos/listaModulos.php';
    }

    public function listas() {
        require_once 'Views/Listas/Listas.php';
    }

    public function home() {
        session_start();
        if (isset($_SESSION['user'])) {
            require_once 'Views/menu.php';
        } else {
            header('Location: index.php?controller=user&action=login');
            exit();
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: index.php?controller=user&action=login');
        exit();
    }
}
?>


