<?php
// Datos de conexión
$servername = "shared10"; // Nombre del servidor (puede ser "localhost" si es en el mismo servidor)
$username = "voluntam_puchum"; // Nombre de usuario
$password = "Adrastea01."; // Contraseña
$dbname = "voluntam_voluntariado"; // Nombre de la base de datos
$port = "3306"; // Puerto de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} else {
   // echo "¡Conectado exitosamente!";
}
?>
