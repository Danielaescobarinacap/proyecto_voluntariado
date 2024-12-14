<?php
session_start(); // Inicia la sesión
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Incluir el archivo de conexión
include '../php/conexion.php'; // Asegúrate de que este archivo existe y conecta correctamente a la base de datos

if (!$conn) { // Verifica si la conexión es válida
    die("Error: No se pudo conectar a la base de datos.");
}

// Obtener los datos del usuario logueado
$id_organizacion = isset($_SESSION['id_organizacion']) ? $_SESSION['id_organizacion'] : null;

// Verifica si el usuario está logueado como organizacion
if ($id_organizacion) {
    $id_organizacion = $_SESSION['id_organizacion']; // Si es un organizacion, toma su ID
} else {
    $id_organizacion = null; // Si no es vrganizacion, asigna null
}

// Procesar la encuesta al enviarla
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger los datos del formulario
    $trabajo = $_POST['trabajo'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $trato_usuario = $_POST['trato_usuario'];
    $trato_organizacion = $_POST['trato_organizacion'];
    $trato_voluntario = $_POST['trato_voluntario'];
    $cumplimiento_horarios = $_POST['cumplimiento_horarios'];
    $cumplimiento_objetivos = $_POST['cumplimiento_objetivos'];
    $satisfaccion_usuario = $_POST['satisfaccion_usuario'];
    $comentarios = $_POST['comentarios'];

    // Consulta para insertar los datos en la tabla encuesta_voluntario
    $query = "INSERT INTO encuesta_voluntario (id_organizacion, trabajo, fecha_inicio, fecha_fin, 
                                                trato_usuario, trato_organizacion, trato_voluntario, 
                                                cumplimiento_horarios, cumplimiento_objetivos, 
                                                satisfaccion_usuario, comentarios) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    if ($stmt) {
        $stmt->bind_param("issssssssss", $id_organizacion, $trabajo, $fecha_inicio, $fecha_fin, 
                          $trato_usuario, $trato_organizacion, $trato_voluntario, 
                          $cumplimiento_horarios, $cumplimiento_objetivos, 
                          $satisfaccion_usuario, $comentarios);

        if ($stmt->execute()) {
            // Mostrar mensaje de agradecimiento
            $message = "Hemos recibido su encuesta, los datos proporcionados serán de mucha utilidad, muchas gracias por participar.";
            echo "<script>alert('$message');</script>";

            // Redirigir a dashboard_voluntario.php después de 3 segundos (3000 milisegundos)
            echo "<script>
                    setTimeout(function() {
                        window.location.href = 'dashboard_organizacion.php'; // Redirige a dashboard_organizacion
                    }, 3000);
                  </script>";
        } else {
            echo "<p>Error al enviar la encuesta: " . $stmt->error . "</p>";
        }
        $stmt->close();
    } else {
        echo "<p>Error al preparar la consulta de encuesta: " . $conn->error . "</p>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encuesta de Satisfacción</title>
    <style>
        label, select, input, textarea { margin-bottom: 10px; }
    </style>
</head>
<body>

    <h1>Encuesta de Satisfacción</h1>

    <form method="POST" action="encuesta_vol.php">
        <!-- Trabajo -->
        <label for="trabajo">Trabajo:</label>
        <input type="text" id="trabajo" name="trabajo" required><br>

        <!-- Fecha inicio -->
        <label for="fecha_inicio">Fecha de inicio:</label>
        <input type="date" id="fecha_inicio" name="fecha_inicio" required><br>

        <!-- Fecha fin -->
        <label for="fecha_fin">Fecha de fin:</label>
        <input type="date" id="fecha_fin" name="fecha_fin" required><br>

        <!-- Trato con el usuario -->
        <label for="trato_usuario">Trato con el usuario:</label>
        <select id="trato_usuario" name="trato_usuario" required>
            <option value="1">1 - Muy Malo</option>
            <option value="2">2</option>
            <option value="3">3 - Regular</option>
            <option value="4">4</option>
            <option value="5">5 - Muy Bueno</option>
        </select><br>

        <!-- Trato con la organización -->
        <label for="trato_organizacion">Trato con la organización:</label>
        <select id="trato_organizacion" name="trato_organizacion" required>
            <option value="1">1 - Malo</option>
            <option value="2">2</option>
            <option value="3">3 - Regular</option>
            <option value="4">4</option>
            <option value="5">5 - Muy Bueno</option>
        </select><br>

        <!-- Trato con el voluntario -->
        <label for="trato_voluntario">Trato con el voluntario:</label>
        <select id="trato_voluntario" name="trato_voluntario" required>
            <option value="1">1 - Malo</option>
            <option value="2">2</option>
            <option value="3">3 - Regular</option>
            <option value="4">4</option>
            <option value="5">5 - Muy Bueno</option>
        </select><br>

        <!-- Cumplimiento de horarios -->
        <label for="cumplimiento_horarios">Cumplimiento de horarios:</label>
        <select id="cumplimiento_horarios" name="cumplimiento_horarios" required>
            <option value="1">1 - Malo</option>
            <option value="2">2</option>
            <option value="3">3 - Regular</option>
            <option value="4">4</option>
            <option value="5">5 - Muy Bueno</option>
        </select><br>

        <!-- Cumplimiento de objetivos -->
        <label for="cumplimiento_objetivos">Cumplimiento de objetivos:</label>
        <select id="cumplimiento_objetivos" name="cumplimiento_objetivos" required>
            <option value="1">1 - Malo</option>
            <option value="2">2</option>
            <option value="3">3 - Regular</option>
            <option value="4">4</option>
            <option value="5">5 - Muy Bueno</option>
        </select><br>

        <!-- Satisfacción del usuario -->
        <label for="satisfaccion_usuario">Satisfacción del usuario:</label>
        <select id="satisfaccion_usuario" name="satisfaccion_usuario" required>
            <option value="1">1 - Malo</option>
            <option value="2">2</option>
            <option value="3">3 - Regular</option>
            <option value="4">4</option>
            <option value="5">5 - Muy Bueno</option>
        </select><br>

        <!-- Comentarios -->
        <label for="comentarios">Comentarios:</label><br>
        <textarea id="comentarios" name="comentarios" rows="4" cols="50" maxlength="200"></textarea><br>

        <!-- Botón de envío -->
        <button type="submit">Enviar Encuesta</button>
    </form>

</body>
</html>

