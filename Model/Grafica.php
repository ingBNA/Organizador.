<?php 
class Grafica {
    private $db;

    public function __construct($db = null) {
        if ($db === null) {
            $this->db = Db::getConnect(); // Conexión a la base de datos
        } else {
            $this->db = $db;
        }
    }
    
    //por cada nuevo registro
    // Enfermedades por id
// Enfermedades por ID
public function contarEnfermedadesPorId() {
    $sql = "SELECT id AS id, COUNT(*) AS total_enfermedades
            FROM apoyo
            WHERE enfermedad IS NOT NULL
            GROUP BY id
            ORDER BY id DESC";
    $result = $this->db->query($sql);
    $data = $result->fetchAll(PDO::FETCH_ASSOC);
    
    // Asegurarnos de que siempre regrese un array con el id, incluso si no hay enfermedades
    if (empty($data)) {
        return [['id' => null, 'total_enfermedades' => 0]]; // Cambia según como desees manejar esto
    }
    
    return $data;
}

// Problemas por ID
public function contarProblemasPorId() {
    $sql = "SELECT id AS id, COUNT(*) AS total_problemas
            FROM apoyo
            WHERE ayuda IS NOT NULL
            GROUP BY id
            ORDER BY id DESC";
    $result = $this->db->query($sql);
    $data = $result->fetchAll(PDO::FETCH_ASSOC);
    
    // Asegurarnos de que siempre regrese un array con el id, incluso si no hay problemas
    if (empty($data)) {
        return [['id' => null, 'total_problemas' => 0]]; // Cambia según como desees manejar esto
    }
    
    return $data;
}

// Alumnos por id
public function contarAlumnosPorId() {
    $sql = "SELECT id AS id, COUNT(*) AS total_alumnos
            FROM alumno
            GROUP BY id
            ORDER BY id DESC";
    $result = $this->db->query($sql);
    return $result->fetchAll(PDO::FETCH_ASSOC);
}

// Materias con problemas por id
public function contarMateriasPorId() {
    $sql = "SELECT id AS id, COUNT(*) AS total_materias
            FROM materia
            WHERE problema IS NOT NULL
            GROUP BY id
            ORDER BY id DESC";
    $result = $this->db->query($sql);
    return $result->fetchAll(PDO::FETCH_ASSOC);
}

//CONTAR POR MES LA GRAFICA
//contar que tambien venga por id y mes, para verificar cuantos se registraron 
//en total
// Enfermedades por mes
// Enfermedades por mes
public function contarEnfermedadesPorMes() {
    $sql = "SELECT DATE_FORMAT(fecha_registro, '%Y-%m') AS mes, COUNT(*) AS total_enfermedades
            FROM apoyo
            WHERE enfermedad IS NOT NULL
            GROUP BY DATE_FORMAT(fecha_registro, '%Y-%m')
            ORDER BY mes";
    $result = $this->db->query($sql);
    return $result->fetchAll(PDO::FETCH_OBJ);
}

// Problemas por mes
public function contarProblemasPorMes() {
    $sql = "SELECT DATE_FORMAT(fecha_registro, '%Y-%m') AS mes, COUNT(*) AS total_problemas
            FROM apoyo
            WHERE ayuda IS NOT NULL
            GROUP BY DATE_FORMAT(fecha_registro, '%Y-%m')
            ORDER BY mes";
    $result = $this->db->query($sql);
    return $result->fetchAll(PDO::FETCH_OBJ);
}

// Alumnos por mes
public function contarAlumnosPorMes() {
    $sql = "SELECT DATE_FORMAT(fecha_registro, '%Y-%m') AS mes, COUNT(*) AS total_alumnos
            FROM alumno
            GROUP BY DATE_FORMAT(fecha_registro, '%Y-%m')
            ORDER BY mes";
    $result = $this->db->query($sql);
    return $result->fetchAll(PDO::FETCH_OBJ);
}

// Materias con problemas por mes
public function contarMateriasPorMes() {
    $sql = "SELECT DATE_FORMAT(fecha_registro, '%Y-%m') AS mes, COUNT(*) AS total_materias
            FROM materia
            WHERE problema IS NOT NULL
            GROUP BY DATE_FORMAT(fecha_registro, '%Y-%m')
            ORDER BY mes";
    $result = $this->db->query($sql);
    return $result->fetchAll(PDO::FETCH_OBJ);
}


//SEMESTRE VERIFICAR
//mismo metodo, realizacion por id y por semestre, abarca ca 5 o 6 meses 
// Enfermedades por semestre
//verificar si se debe de cambiar por mes a otra forma para sacar el semestre
}

?>