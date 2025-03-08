<?php 
    class Documento{
        //Metodo para obtener todos los documentos de la base de datos
        public static function obtenerDocumentos(){
            $db = Db::getConnect();
            $sql = $db->prepare('SELECT * FROM documentos');
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    //Guardamos el nuevo documento
    public static function guardarDocumento($nombre, $archivo){
        $db = Db::getConnect();
        $sql =  'INSERT INTO documentos (nombre, archivo) VALUES (:nombre, :archivo)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':archivo', $archivo);
        $stmt->execute();
    } 
    public static function obtenerDocumentoPorId($id_documento){
        $db = Db::getConnect();
        $query = $db->prepare ("SELECT * FROM documentos WHERE id_documento = :id_documento");
        $query->bindParam(':id_documento', $id_documento, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public static function eliminarDocumento($id_documento){
        $db = Db::getConnect();
        $delete = $db->prepare('DELETE  FROM documentos WHERE id_documento = :id_documento');
        $delete->bindParam(':id_documento', $id_documento, PDO::PARAM_INT);
        return $delete->execute();
    }
}
?> 