<?php
// Datos de conexi��n
$servername = "shared10"; // Nombre del servidor (puede ser "localhost" si es en el mismo servidor)
$username = "voluntam_puchum"; // Nombre de usuario
$password = "Adrastea01."; // Contrase�0�9a
$dbname = "voluntam_voluntariado"; // Nombre de la base de datos
$port = "3306"; // Puerto de la base de datos

// Crear conexi��n
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Verificar conexi��n
if ($conn->connect_error) {
    die("Conexi��n fallida: " . $conn->connect_error);
} else {
   // echo "�0�3Conectado exitosamente!";
}
?>
