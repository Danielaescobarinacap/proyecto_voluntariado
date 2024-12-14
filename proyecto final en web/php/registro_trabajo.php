<?php
// Incluimos la conexión a la base de datos
include 'conexion.php';

session_start();

$id_organizacion = $_SESSION['id'];

// Habilitar errores para depuración (temporal)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verificamos si se enviaron los datos mediante POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
        // Organización
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $horario = $_POST['horario'];
        $dias = $_POST['dias'];
        $ubicacion = $_POST['ubicacion'];
        
        

        // Insertar la organización en la base de datos
        $stmt = $conn->prepare("INSERT INTO trabajos (titulo, descripcion, horario, dias, ubicacion, id_organizacion) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $titulo, $descripcion, $horario,$dias, $ubicacion, $id_organizacion);

        if ($stmt->execute()) {
            header("Location: ../templates/dashboard_organizacion.php?success=" . urlencode('Registro exitoso'));
        } else {
            header("Location: ../templates/dashboard_organizacion.php?error=" . urlencode('Error al registrar el trabajo: ' . $stmt->error));
        }
    
}

// Cerrar conexión
$conn->close();
?>
