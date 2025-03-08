<?php
 
    class Apoyo{
        private $id;
        private $nombre;
        private $matricula;
        private $grupo;
        private $enfermedad;
        private $ayuda;
        private $solucion; 
        private $fecha_registro;

        function __construct($id=null, $nombre=null,$matricula=null,$grupo=null,$enfermedad=null, $ayuda=null, $solucion=null,$fecha_registro=null){
           //conectamos hacia la base de datos 
            $this->id=$id;
            $this->nombre=$nombre;
            $this->matricula=$matricula;
            $this->grupo=$grupo;
            $this->enfermedad=$enfermedad;
            $this->ayuda=$ayuda;
            $this->solucion=$solucion;
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
            $this->nombre =$nombre;
        }
        public function getMatricula(){
            return $this->matricula;
        }
        public function setMatricula($matricula){
            $this->matricula=$matricula;
        }
        public  function getGrupo(){
            return $this->grupo;
        }
        public function setGrupo($grupo){
            $this->grupo=$grupo;
        }
        public function getEnfermedad(){
            return $this->enfermedad;
        } 
        public function setEnfermedad($enfermedad){
            $this->enfermedad=$enfermedad;
        }
        public function getAyuda(){
            return $this->ayuda;
        }
        public function setAyuda($ayuda){
            $this->ayuda=$ayuda;
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

        public static function save($apoyo){
            try{
                $db=Db::getConnect();

                $stmt= $db->prepare('INSERT INTO apoyo(nombre,matricula,grupo,enfermedad,ayuda,solucion) VALUES(:nombre,:matricula,:grupo,:enfermedad,:ayuda,:solucion)');
                $nombre = $apoyo->getNombre();
                $matricula = $apoyo->getMatricula();
                $grupo = $apoyo->getGrupo();
                $enfermedad = $apoyo->getEnfermedad();
                $ayuda = $apoyo->getAyuda();
                $solucion = $apoyo->getSolucion();

                $stmt->bindParam(':nombre', $nombre);
                $stmt->bindParam(':matricula', $matricula);
                $stmt->bindParam(':grupo', $grupo);
                $stmt->bindParam(':enfermedad', $enfermedad);
                $stmt->bindParam(':ayuda', $ayuda);
                $stmt->bindParam(':solucion',$solucion);
                
                //ejecutamos la consulta
                if ($stmt->execute()){
                  return true; //exito al guardar
                }else{
                    //capturamos el error de la consulta
                    $errorInfo = $stmt->errorInfo();
                    echo "Error al guardar: ". $errorInfo[2];
                    return false;  
                }
            }catch(PDOException $e){
                echo "error de conexion". $e->getMessage();
                echo "Error al guardar: ". $errorInfo[2];
                return false;
            }

        }
        public static function all(){
          $db=Db::getConnect();
          $listaApoyo=[];

          $select = $db->query('SELECT * FROM apoyo ORDER BY id ');

          foreach($select->fetchAll() as $apoyo){
            $listaApoyo[] = new Apoyo($apoyo['id'],$apoyo['nombre'],$apoyo['matricula'],$apoyo['grupo'],$apoyo['enfermedad'],$apoyo['ayuda'],$apoyo['solucion'],$apoyo['fecha_registro']);
          }
          return $listaApoyo;
        }
        public static function searchById($id){
            $db=Db::getConnect();
            $query = $db->prepare('SELECT * FROM apoyo WHERE id =:id');
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();

            $result = $query->fetch(PDO::FETCH_ASSOC);
            if($result){
                return new Apoyo(
                    $result['id'],
                    $result['nombre'],
                    $result['matricula'],
                    $result['grupo'],
                    $result['enfermedad'],
                    $result['ayuda'],
                    $result['solucion']
                );
            }else{
                //manejo en caseo de no encontrar nada
                return null;
            }
        }
        public static function update($apoyo){
            try{
                $db=Db::getConnect();
                $update=$db->prepare('UPDATE apoyo SET nombre=:nombre,matricula=:matricula,grupo=:grupo,enfermedad=:enfermedad,ayuda=:ayuda,solucion=:solucion WHERE id=:id');
                
                $update->bindValue(':nombre', $apoyo->getNombre());
                $update->bindValue(':matricula',$apoyo->getMatricula());
                $update->bindValue(':grupo',$apoyo->getGrupo());
                $update->bindValue(':enfermedad', $apoyo->getEnfermedad());
                $update->bindValue(':ayuda', $apoyo->getAyuda());
                $update->bindValue(':solucion',$apoyo->getSolucion());
                $update->bindValue(':id',$apoyo->getId());

                if($update->execute()){
                    return true;
                }else{
                    //capturamos el error
                    $errorInfo =$update->errorInfo();
                    echo "Errpr al guardar datos:" .$errorInfo[2];
                    return false;
                }

            }catch(PDOException $e){
                echo "Error de conexion: ". $e->getMessage();
                return false;
            }
        }
        public static function delete($id){
            $db=Db::getConnect();
            $delete=$db->prepare('DELETE FROM apoyo WHERE id=:id');
            $delete->bindParam(':id',$id, PDO::PARAM_INT);
            return $delete->execute();
        }
    }
?>