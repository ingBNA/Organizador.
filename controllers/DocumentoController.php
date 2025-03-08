<?php require_once('Model/Documento.php');?>
<?php 
    class DocumentoController{
        function __construct(){
            if(session_status() === PHP_SESSION_NONE){ 
                session_start();    //creamos una instancia para mandarlo al controlador
            }
        } 
        function index(){
            require_once('index.php');
        }
        //listamos todos los documento
        public function listarDocumento(){
            //mostramos los documentos
            
            $documentos = Documento::obtenerDocumentos();
            require_once('Views/Documentos/listaDocumentos.php');
        }
        public function subirDocumento(){
            
            if(isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK){
                $nombreArchivo = $_FILES['archivo']['name'];
                $rutaTemporal = $_FILES['archivo']['tmp_name'];
                $rutaDestino = 'uploads/' . $nombreArchivo;
                
                if(move_uploaded_file($rutaTemporal, $rutaDestino)){
                    //Guardamos el archivo en la base de datos
                    Documento::guardarDocumento($nombreArchivo, $rutaDestino);
                    header('Location: index.php?controller=documento&action=listarDocumento');
                    echo "El archivo se ah subido correctamente";
                }else{
                    echo "Error al subir el archivo.";
                }
            }else{
                echo "No se ah seleccionado ningun archivo.";
            }
        }
        //Descargamos los documentos necesarios 
        // NO DESCARGA documentos(arroja a login)
        public function descargarDocumento() {
            if (isset($_GET['id_documento'])) {
                // Obtener el documento de la base de datos usando el ID
                $documento = Documento::obtenerDocumentoPorId($_GET['id_documento']);
                
                if ($documento) {
                    $nombreArchivo = $documento['archivo'];
                    
                    // Eliminar "uploads/" si ya está presente en el nombre del archivo
                    if (strpos($nombreArchivo, 'uploads/') === false) {
                        $rutaArchivo = 'uploads/' . $nombreArchivo; // Solo añadir 'uploads/' si no está presente
                    } else {
                        $rutaArchivo = $nombreArchivo;  // Si ya tiene 'uploads/', usarlo tal cual
                    }
        
                    // Mostrar el nombre y la ruta para depurar
                    echo "Nombre del archivo: " . $nombreArchivo . "<br>";
                    echo "Ruta del archivo: " . $rutaArchivo . "<br>";
        
                    // Verificar si el archivo existe en el servidor
                    if (file_exists($rutaArchivo)) {
                        // Configurar los headers para la descarga
                        header('Content-Description: File Transfer');
                        header('Content-Type: application/octet-stream');
                        header('Content-Disposition: attachment; filename="' . basename($nombreArchivo) . '"');
                        header('Expires: 0');
                        header('Cache-Control: must-revalidate');
                        header('Pragma: public');
                        header('Content-Length: ' . filesize($rutaArchivo));
        
                        // Limpiar el buffer de salida antes de leer el archivo
                        ob_clean();
                        flush();
        
                        // Enviar el archivo al navegador para la descarga
                        readfile($rutaArchivo);
                        exit;
                    } else {
                        echo "El archivo no existe en el servidor.";
                    }
                } else {
                    echo "Documento no encontrado en la base de datos.";
                }
            } else {
                die("No se especificó un documento para descargar.");
            }
        }
        
        
        //ELIMINA 
        public static function eliminarDocumento($id_documento) {
            if (isset($id_documento)) {
                // Obtenemos la info para eliminar el documento
                $documento = Documento::obtenerDocumentoPorId($id_documento);
                
                if ($documento) {
                    $archivoEliminado = 'uploads/' . $documento['archivo'];
        
                    // Eliminamos el archivo del sistema de archivos
                    if (file_exists($archivoEliminado)) {
                        unlink($archivoEliminado); // Borramos el archivo en uploads
                    }
                    // Eliminamos el registro de la base de datos
                    Documento::eliminarDocumento($id_documento);
                    header('Location: index.php?controller=documento&action=listarDocumento');
                    exit;
                } else {
                    die("Documento no encontrado");
                }
            } else {
                die("ID del documento no especificado");
            }
        }
    
}

?>