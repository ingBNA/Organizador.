<?php
require_once 'Model/search.php';
class SearchController {
    public function search() {
        // Verifica si hay un término de búsqueda
        if(isset($_POST['query'])){
            $query = $_POST ['query'];
            $results = search::searchGeneral($query);

            if($results && count($results) > 0){
                //mostramos la vista con los resultados 
                require_once('Views/searchResults.php');
            }else{
                echo " No se encontraron resultados.";
            }

        } else{
            echo "No se ah ingresado una consulta de busqueda.";
        }
    }

 
}
?>
