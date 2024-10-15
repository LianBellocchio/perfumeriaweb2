<?php

// Definición de las constantes de conexión a la base de datos
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'perfumeria');

// Función para conectar a la base de datos
function connect() {
    
    // Crear la conexión
    $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // Verificar si la conexión tiene algún error
    if ($connection->connect_error) {
        die("Error de conexión: " . $connection->connect_error);
    }

    // Retornar la conexión exitosa
    return $connection;
}
?>
