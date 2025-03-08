<?php 
    class Alumno{

        private $id;
        private $nombre;
        private $matricula;
        private $grupo; 
        private $telefono;
        private $tutor;
        private $telefono_tutor;
        private $estado;
        private $fecha_registro;
     

        function __construct($id=null,$nombre=null,$matricula=null, $grupo=null, $telefono=null, $tutor=null, $telefono_tutor=null,$estado=null, $fecha_registro=null){
            //Iniciamos la conexion hacia la base de datos
            $this->id= $id;
            $this->nombre = $nombre;
            $this->matricula= $matricula;
            $this->grupo = $grupo;
            $this->telefono = $telefono;
            $this->tutor =$tutor;
            $this->telefono_tutor =$telefono_tutor;
            $this->estado = $estado;
            $this->fecha_registro = $fecha_registro;
         
            
             //se establece un valor por defecto para la propiedad de estado 
        }
        public function getId(){
            return $this->id;
        }
        public function setId($id){
            $this->id =$id;
        }
        public function getNombre(){
            return $this->nombre;
        }
        public function setNombre($nombre){
            $this->nombre =$nombre;
        }
        public function getMatricula(){
            return $this->matricula;
        }
        public function setMatricula($matricula){
            $this->matricula = $matricula; 
        }
        public function getGrupo(){
            return $this->grupo;
        }
        public function setGrupo($grupo){
            $this->grupo = $grupo;
        }
        public function getTelefono(){
            return $this->telefono;
        }
        public function setTelefono($telefono){
            $this->telefono =$telefono;
        } 
        public function getTutor(){
            return $this->tutor;
        }
        public function setTutor($tutor){
            $this->tutor=$tutor;
        }
        public function getTelefonoTutor(){
            return $this->telefono_tutor;
        }
        public function setTelefonoTutor($telefono_tutor){
            $this->telefono_tutor = $telefono_tutor;
        }
        public function getEstado(){
            return $this->estado;
        }
        public function setEstado($estado) {
            // Asegúrate de que solo se asignen los valores válidos
            if ($estado === "activo" || $estado === "en riesgo" || $estado === null) {
                $this->estado = $estado;
            } else {
                $this->estado = null; // Si el estado no es válido, lo dejamos como null
            }
        }
        public function getFechaRegistro() {
            return $this->fecha_registro;
        }
    
        public function setFechaRegistro($fecha_registro) {
            $this->fecha_registro = $fecha_registro;
        }
       
        //guardamos los datos
        public static function save($alumno){
            try{
                $db=Db::getConnect();

                $stmt= $db->prepare('INSERT INTO alumno (nombre, matricula,grupo, telefono, tutor, telefono_tutor, estado) VALUES (:nombre,:matricula,:grupo ,:telefono,:tutor,:telefono_tutor,:estado)');
                
                $nombre = $alumno->getNombre();
                $matricula = $alumno->getMatricula();
                $grupo= $alumno->getGrupo();
                $telefono = $alumno->getTelefono();
                $tutor = $alumno->getTutor();
                $telefono_tutor = $alumno->getTelefonoTutor();
                $estado = $alumno->getEstado(); 
               
                //Asignamos valores
                $stmt->bindParam(':nombre', $nombre);
                $stmt->bindParam(':matricula', $matricula);
                $stmt->bindParam(':grupo', $grupo);
                $stmt->bindParam(':telefono', $telefono);
                $stmt->bindParam(':tutor', $tutor);
                $stmt->bindParam(':telefono_tutor', $telefono_tutor);
                $stmt->bindParam(':estado', $estado);
              
                
                //ejecutamos la consulta 
                 if ($stmt->execute()){
                    return true; //exito al guardar
                 } else{
                    //capturamos el error de la consulta
                    $errorInfo = $stmt->errorInfo();
                    echo "Error al guardar: ". $errorInfo[2];
                    return false;
                 }
            } catch(PDOException $e){
                echo "error de conexion". $e->getMessage();
                return false;
            }
        }
        //Recuperamos los datos guardados y los mostramos mediante una lista 
        public static function all(){
            $db=Db::getConnect();
            $listaAlumnos=[];

            $select=$db->query('SELECT * FROM alumno order by id');

            foreach($select->fetchAll() as $alumno){
                $listaAlumnos[]= new Alumno($alumno['id'],$alumno['nombre'],$alumno['matricula'],$alumno['grupo'],$alumno['telefono'],$alumno['tutor'],$alumno['telefono_tutor'],$alumno['estado'], $alumno['fecha_registro']);
            }
            return $listaAlumnos;
        }  
        //Realizar buscador general
        //buscar informacion para realizarlo 
        public static function searchById($id){
            $db=Db::getConnect();
            $query = $db->prepare('SELECT * FROM alumno WHERE id =:id');
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();

            $result = $query->fetch(PDO::FETCH_ASSOC);
            if($result){
                return new Alumno(
                    $result['id'],
                    $result['nombre'],
                    $result['matricula'],
                    $result['grupo'],
                    $result['telefono'],
                    $result['tutor'],
                    $result['telefono_tutor'],
                    $result['estado']
                );
            }else{
                //manejo en caseo de no encontrar nada
                return null;
            }
        }
        //actualizamos datos 
        public static function update($alumno){
        try{
        $db=Db::getConnect();
        $update=$db->prepare('UPDATE alumno SET nombre = :nombre, matricula = :matricula, grupo = :grupo, telefono = :telefono, tutor = :tutor, telefono_tutor = :telefono_tutor, estado=:estado WHERE id = :id');
        $update->bindValue(':nombre', $alumno->getNombre());
        $update->bindValue(':matricula', $alumno->getMatricula());
        $update->bindValue(':grupo', $alumno->getGrupo());
        $update->bindValue(':telefono', $alumno->getTelefono());
        $update->bindValue(':tutor', $alumno->getTutor());
        $update->bindValue(':telefono_tutor', $alumno->getTelefonoTutor());
        $update->bindValue('estado', $alumno->getEstado());
        $update->bindValue(':id', $alumno->getId());
        
        if($update->execute()){
            return true;
        }else{
            //captura de error
            $errorInfo =$update->errorInfo();
            echo "Error al guardar datos:" . $errorInfo[2];
            return false;
        }
        }catch(PDOException $e){
            echo "Error de conexion: ". $e->getMessage();
            return false;
        }
    }
   
        //eliminamos al alumno junto con todos los datos 
        public static function delete($id){
            $db=Db::getConnect();
            $delete=$db->prepare('DELETE FROM alumno WHERE id=:id');
            $delete->bindParam(':id',$id, PDO::PARAM_INT);
            return $delete->execute();
        }
        //Realizar un conteo de registros por mes
        //para cada lista(general, de materia y apoyo y salud)
    }

?>