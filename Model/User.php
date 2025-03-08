<?php
class User {
    private $db;
    private $id;
    private $nombre;
    private $apellidos;
    private $correo;
    private $contrasena;

    public function __construct($id=null,$nombre=null,$apellidos=null,$correo=null,$contrasena=null) {
        $this->db =Db::getConnect();
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->correo = $correo;
        $this->contrasena = $contrasena;
    }
    //Realizamos la creacion de usuario 
    //hashed para encriptar la contraseña
    public function createUser($nombre,$apellidos,$correo, $contrasena) {
        $hashedPassword = password_hash($contrasena, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("INSERT INTO usuario (nombre,apellidos,correo, contrasena) VALUES (:nombre,:apellidos,:correo, :contrasena)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':contrasena', $hashedPassword);
        return $stmt->execute();
    }
     //Obtenemos el usuario por el nombre del usuario
     public static function obtenerPorCorreo($correo){
        $db = Db::getConnect();
        $query = $db->prepare("SELECT * FROM usuario WHERE correo = :correo");
        $query->bindParam(':correo', $correo);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    //Actualizar contraseña
    public static function actualizarContraseña($user_id, $password_hash){
        $db = Db::getConnect();
        $query = $db->prepare("UPDATE usuario set contrasena = :contrasena WHERE id = :user_id");
        $query->bindParam(':contrasena', $password_hash);
        $query->bindParam(':user_id', $user_id);
        return $query->execute();
    }
    //configuramos  el logeo que tenga acceso con correo y contraseña
    public function login($correo, $contrasena) {
        $stmt = $this->db->prepare("SELECT * FROM usuario WHERE correo = :correo");
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($contrasena, $user['contrasena'])) {
            return $user;
        }
        return false;
    }
}
?>
