<?php
class Search {
    public static function searchGeneral($query) {
        $db = Db::getConnect();
        $query = strtolower(trim($query)); // Limpiar y estandarizar la búsqueda

        $results = [];

        // Buscar en la tabla de alumnos
        $alumnoQuery = $db->prepare('SELECT "alumno" as type, id, nombre,matricula,grupo,telefono,tutor,telefono_tutor,estado,fecha_registro FROM alumno WHERE LOWER(nombre) LIKE :query OR LOWER(matricula) LIKE :query');
        $searchTerm = "%" . $query . "%";
        $alumnoQuery->bindParam(':query', $searchTerm, PDO::PARAM_STR);
        $alumnoQuery->execute();
        $results = array_merge($results, $alumnoQuery->fetchAll(PDO::FETCH_ASSOC));
        // Buscar en la tabla de apoyo
        $apoyoQuery = $db->prepare('SELECT "apoyo" as type, id, nombre, matricula, grupo, enfermedad, ayuda, solucion, fecha_registro FROM apoyo WHERE LOWER(nombre) LIKE :query OR LOWER(matricula) LIKE :query');
        $apoyoQuery->bindParam(':query', $searchTerm, PDO::PARAM_STR);
        $apoyoQuery->execute();
        $results = array_merge($results, $apoyoQuery->fetchAll(PDO::FETCH_ASSOC));

// Buscar en la tabla de materia
        $materiaQuery = $db->prepare('SELECT "materia" as type, id, nombre, matricula, grupo, problema, solucion, fecha_registro FROM materia WHERE LOWER(nombre) LIKE :query OR LOWER(matricula) LIKE :query');
        $materiaQuery->bindParam(':query', $searchTerm, PDO::PARAM_STR);
        $materiaQuery->execute();
        $results = array_merge($results, $materiaQuery->fetchAll(PDO::FETCH_ASSOC));
        // Buscar en la tabla de maestros
        $maestroQuery = $db->prepare('SELECT "maestro" as type, id, nombre,numero_empleado , especialidad FROM maestro WHERE LOWER(nombre) LIKE :query OR LOWER(especialidad) LIKE :query');
        $maestroQuery->bindParam(':query', $searchTerm, PDO::PARAM_STR);
        //Error en la linea 20
        $maestroQuery->execute();
        $results = array_merge($results, $maestroQuery->fetchAll(PDO::FETCH_ASSOC));

        // Buscar en la tabla de documentos
        $documentoQuery = $db->prepare('SELECT "documentos" as type, id_documento, nombre, archivo FROM documentos WHERE LOWER(nombre) LIKE :query OR LOWER(archivo) LIKE :query');
        $documentoQuery->bindParam(':query', $searchTerm, PDO::PARAM_STR);
        $documentoQuery->execute();
        $results = array_merge($results, $documentoQuery->fetchAll(PDO::FETCH_ASSOC));

        return $results; // Retornar todos los resultados
    }
}

?>