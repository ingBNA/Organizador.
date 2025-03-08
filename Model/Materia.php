<?php 
    class Materia{
        private $id;
        private $nombre;
        private $matricula;
        private $grupo;
        private $problema;
        private $solucion;
        private $fecha_registro;
    
        function __construct($id=null,$nombre=null,$matricula=null,$grupo=null,$problema=null,$solucion=null, $fecha_registro=null){
            //conexion a la base de datos
            $this->id = $id;
            $this->nombre = $nombre;
            $this->matricula = $matricula;
            $this->grupo = $grupo;
            $this->problema= $problema;
            $this->solucion = $solucion;
            $this->fecha_registro = $fecha_registro;
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
            $this->nombre= $nombre;
        }
        public function getMatricula(){
            return $this->matricula;
        }
        public function setMatricula($matricula){
            $this->matricula =$matricula;
        }
        public function getGrupo(){
            return $this->grupo;
        }
        public function setGrupo($grupo){
            $this->grupo= $grupo;
        }
        public function getProblema(){
            return $this->problema;
        }
        public function setProblema($problema){
            $this->problema=$problema;
        }
        public function getSolucion(){
            return $this->solucion;
        }
        public function setSolucion($solucion){
            $this->solucion=$solucion;
        }
        public function getFechaRegistro() {
            return $this->fecha_registro;
        }
    
        public function setFechaRegistro($fecha_registro) {
            $this->fecha_registro = $fecha_registro;
        }
        public static function save($materia){
            try{
                $db=Db::getConnect();
                $stmt= $db->prepare('INSERT INTO materia(nombre,matricula,grupo,problema,solucion)VALUES(:nombre,:matricula,:grupo,:problema,:solucion)');

                $nombre = $materia->getNombre();
                $matricula = $materia->getMatricula();
                $grupo= $materia->getGrupo();
                $problema = $materia->getProblema();
                $solucion = $materia->getSolucion();

                $stmt->bindParam(':nombre', $nombre);
                $stmt->bindParam(':matricula', $matricula);
                $stmt->bindParam(':grupo', $grupo);
                $stmt->bindParam(':problema' , $problema);
                $stmt->bindParam(':solucion',$solucion);

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
            public static function all(){
                $db=Db::getConnect();
                $problemaMateria=[];

                $select=$db->query('SELECT * FROM materia order by id');

                foreach($select->fetchAll() as $materia){
                 $problemaMateria[]= new Materia($materia['id'],$materia['nombre'],$materia['matricula'],$materia['grupo'],$materia['problema'],$materia['solucion'], $materia ['fecha_registro']);   
                } 
                return $problemaMateria;
            }
            public static function searchById($id){
             $db=Db::getConnect();
             $query = $db->prepare('SELECT * FROM materia WHERE id =:id');
             $query->bindParam(':id', $id, PDO::PARAM_INT);
             $query->execute();  
             
             $result = $query->fetch(PDO::FETCH_ASSOC);
             if($result){
               return new Materia(
                $result['id'],
                $result['nombre'],
                $result['matricula'],
                $result['grupo'],
                $result['problema'],
                $result['solucion']
               );
             }else{
                //manejo en caseo de no encontrar nada
                return null;
             }
            }
            public static function update($materia){
                try{
                    $db=Db::getConnect();
                    $update=$db->prepare('UPDATE materia SET nombre=:nombre,matricula=:matricula,grupo=:grupo,problema=:problema,solucion=:solucion WHERE id=:id'); 
                    $update->bindValue(':nombre', $materia->getNombre());
                    $update->bindValue(':matricula', $materia->getMatricula());
                    $update->bindValue(':grupo', $materia->getGrupo());
                    $update->bindValue(':problema',$materia->getProblema());
                    $update->bindValue(':solucion', $materia->getSolucion());
                    $update->bindValue(':id', $materia->getId());
                    
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
                 //eliminamos los datos de la lista
        public static function delete($id){
            $db=Db::getConnect();
            $delete=$db->prepare('DELETE FROM materia WHERE id=:id');
            $delete->bindParam(':id',$id, PDO::PARAM_INT);
            return $delete->execute();
        }
                    
    }
?>