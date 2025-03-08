<?php 
    class manualReport{
        
        function __construct(){
            if(session_status() === PHP_SESSION_NONE){
                session_start();  //creamos una instancia para mandarlo al controlador
            }
        }
        
        public function manual(){
            require_once 'Views/Estadistica/manual.php';
        }
    }
?>