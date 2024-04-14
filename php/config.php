<?php

    define('DB_SERVER', 'localhost');   //cambiar
    define('DB_USERNAME', 'root');      //cambiar
    define('DB_PASSWORD', '');
    define('DB_NAME', 'db_comentarios');
    define('DB_PORT','3308');           //cambiar
    
    /* conecxion*/
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);
    
    // connection
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    /*
    require_once "Comentario.php";
    // archivo de GET para los comentarios
    class MySql{
        
        public $_connection;
        function __construct(){
            $this->_connection= mysqli_connect("localhost", "root", "", "db_comentarios", 3308);
            if (!$this->_connection)
                echo "Sin exito";
        }
    }*/

?>