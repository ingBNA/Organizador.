<?php 
    class Maestro{
        private $id;
        private $nombre;
        private $telefono;
        private $numero_empleado;
        private $correo;
        private $especialidad;

        function __construct($id=null,$nombre=null,$telefono=null,$numero_empleado=null,$correo=null,$especialidad=null){
            $this->id=$id;
            $this->nombre = $nombre;
            $this->telefono = $telefono;
            $this->numero_empleado = $numero_empleado;
            $this->correo = $correo;
            $this->especialidad = $especialidad;
        }

        
        public function getId(){
            return $this->id;
        }
        public function setId($id){
            $this->id=$id;
        }
        public function getNombre(){
            return $this->nombre;
        }
        public function setNombre($nombre){
            $this->nombre=$nombre;
        }
        public function getTelefono(){
            return $this->telefono;
        }
        public function setTelefono($telefono){
            $this->telefono=$telefono;
        }
        public function getNumeroEmpleado(){
            return $this->numero_empleado;
        }
        public function setNumeroEmpleado($numero_empleado){
            $this->numero_empleado=$numero_empleado;
        }
        public function getCorreo(){
            return $this->correo;
        }
        public function setCorreo($correo){
            $this->correo=$correo;
        }
        public function getEspecialidad(){
            return $this->especialidad;
        }
        public function setEspecialidad($especialidad){
            $this->especialidad=$especialidad;
        }

        public static function save($maestro){
           try{
            $db=Db::getConnect();

            $stmt=$db->prepare('INSERT INTO maestro (nombre, telefono, numero_empleado,correo,especialidad) VALUES (:nombre, :telefono, :numero_empleado, :correo,:especialidad)');
            
            $nombre = $maestro->getNombre();
            $telefono = $maestro->getTelefono();
            $numero_empleado = $maestro->getNumeroEmpleado();
            $correo = $maestro->getCorreo();
            $especialidad = $maestro->getEspecialidad();
            //se asigna valores
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':numero_empleado',$numero_empleado);
            $stmt->bindParam(':correo',$correo);
            $stmt->bindParam(':especialidad',$especialidad);

            if($stmt->execute()){
                //Guardar los datos con exito
                return true;
            }else{
                //capturamos el error de la consulta
                $errorInfo = $stmt->errorInfo();
                echo "Error al guardar: ". $errorInfo[2];
                return false;
            }
            } catch(PDOException $e){
                echo "error de conexion".$e->getMessage();
                return false;
            }
        }
        //si marca error aqui, verificamos la listAlumnos para subir los datos y cambiarlo a mestro
        public static function all(){
            $db=Db::getConnect();
            $listaMaestros=[];

            $select=$db->query('SELECT * FROM maestro order by id');

            foreach($select->fetchAll() as $maestro){
                $listaMaestros[]= new Maestro ($maestro['id'],$maestro['nombre'],$maestro['telefono'],$maestro['numero_empleado'],$maestro['correo'],$maestro['especialidad']);

            }
            return $listaMaestros;
        }
        public static function searchById($id){
            $db=Db::getConnect();
            $query = $db->prepare('SELECT * FROM maestro where id =:id');
            $query->bindParam(':id',$id, PDO::PARAM_INT);
            $query->execute();

            $result = $query->fetch(PDO::FETCH_ASSOC);
            if($result){
                return new Maestro(
                    $result['id'],
                    $result['nombre'],
                    $result['telefono'],
                    $result['numero_empleado'],
                    $result['correo'],
                    $result['especialidad']
                );
            }
        }
        public static function Update($maestro){
            try{
            $db=Db::getConnect();
            $update=$db->prepare('UPDATE maestro SET nombre=:nombre, telefono=:telefono, numero_empleado=:numero_empleado, correo=:correo, especialidad=:especialidad WHERE id = :id');
            $update->bindValue(':nombre',$maestro->getNombre());
            $update->bindValue(':telefono',$maestro->getTelefono());
            $update->bindValue(':numero_empleado',$maestro->getNumeroEmpleado());
            $update->bindValue(':correo',$maestro->getCorreo());
            $update->bindValue(':especialidad',$maestro->getEspecialidad());
            $update->bindValue(':id', $maestro->getId());
        
            if($update->execute()){
                return true;
            }else{
                $errorInfo = $update->errorInfo();
                echo "Error al guardar datos:" . $errorInfo[2];
                return false;
            }
            }catch(PDOException $e){
                echo "Error de conexion: ". $e->getMessage();
                return false;
            }
        }
        public static function delete($id){
            $db=Db::getConnect();
            $delete=$db->prepare('DELETE FROM maestro WHERE id=:id');
            $delete->bindParam(':id',$id, PDO::PARAM_INT);
            return $delete->execute();
        }

    }