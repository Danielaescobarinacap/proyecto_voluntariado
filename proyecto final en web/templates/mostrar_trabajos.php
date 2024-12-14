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

// Consulta a la base de datos para obtener todos los trabajos
$query = "SELECT id, titulo, descripcion, horario, dias, ubicacion, estado, id_organizacion FROM trabajos";
$stmt = $conn->prepare($query);

if (!$stmt) {
    die("Error al preparar la consulta: " . $conn->error);
}

$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    echo "<ul>"; // Inicia la lista
    while ($trabajo = $resultado->fetch_assoc()) { // Usamos $trabajo en lugar de $trabajos
        echo "<li><strong>ID:</strong> " . htmlspecialchars($trabajo['id']) . "</li>";
        echo "<li><strong>Título:</strong> " . htmlspecialchars($trabajo['titulo']) . "</li>";
        echo "<li><strong>Descripción:</strong> " . htmlspecialchars($trabajo['descripcion']) . "</li>";
        echo "<li><strong>Horario:</strong> " . htmlspecialchars($trabajo['horario']) . "</li>";
        echo "<li><strong>Días:</strong> " . htmlspecialchars($trabajo['dias']) . "</li>";
        echo "<li><strong>Ubicacion:</strong> " . htmlspecialchars($trabajo['ubicacion']) . "</li>";
        echo "<li><strong>Estado:</strong> " . htmlspecialchars($trabajo['estado']) . "</li>";

        // Botón Postular
        echo "<form method='POST' action=''>";
        echo "<input type='hidden' name='id_trabajo' value='" . $trabajo['id'] . "'>";
        echo "<input type='hidden' name='id_organizacion' value='" . $trabajo['id_organizacion'] . "'>";
        echo "<input type='hidden' name='titulo' value='" . htmlspecialchars($trabajo['titulo']) . "'>";
        echo "<button type='submit' name='postular'>Postular</button>";
        echo "</form>";

        echo "<hr>"; // Separador entre trabajos
    }
    echo "</ul>"; // Cierra la lista
} else {
    echo "<p>No se encontraron trabajos disponibles.</p>";
}

// Procesar la postulación
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['postular'])) {
    $id_trabajo = $_POST['id_trabajo'];
    $id_organizacion = $_POST['id_organizacion'];
    $titulo = $_POST['titulo'];

    // Insertar en la tabla postulaciones
    $query_postulacion = "INSERT INTO postulacion (id_trabajo, titulo, id_organizacion) VALUES (?, ?, ?)";
    $stmt_postulacion = $conn->prepare($query_postulacion);

    if ($stmt_postulacion) {
        $stmt_postulacion->bind_param("iss", $id_trabajo, $titulo, $id_organizacion);
        if ($stmt_postulacion->execute()) {
            echo "<script>alert('Ya estás postulando');</script>";
        } else {
            echo "<p>Error al guardar la postulación: " . $stmt_postulacion->error . "</p>";
        }
        $stmt_postulacion->close();
    } else {
        echo "<p>Error al preparar la consulta de postulación: " . $conn->error . "</p>";
    }
}

$stmt->close();
$conn->close();
?>

<!-- Botón para volver al menú principal -->
<div style="margin-top: 20px;">
    <button onclick="window.location.href='../templates/dashboard_voluntario.php';" style="padding: 10px 20px; font-size: 16px; cursor: pointer;">
        Volver al menú principal
    </button>
</div>
