<?php
session_start();

// Incluir el archivo de conexi√≥n
if (!include '../php/conexion.php') {
    die("Error: No se pudo incluir el archivo de conexi√≥n.");
}

// Consulta a la base de datos para obtener todos los voluntarios
$query = "SELECT nombre, apellido, telefono, habilidades FROM voluntarios";
$stmt = $conn->prepare($query);
if (!$stmt) {
    die("Error al preparar la consulta: " . $conn->error);
}
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<ul>"; // Inicia la lista
    while ($voluntario = $result->fetch_assoc()) {
        echo "<li><strong>Nombre:</strong> " . htmlspecialchars($voluntario['nombre']) . "</li>";
        echo "<li><strong>Apellido:</strong> " . htmlspecialchars($voluntario['apellido']) . "</li>";
        echo "<li><strong>Tel√©fono:</strong> " . htmlspecialchars($voluntario['telefono']) . "</li>";
        echo "<li><strong>Habilidades:</strong> " . htmlspecialchars($voluntario['habilidades']) . "</li>";
        echo "<hr>"; // Separador entre voluntarios
    }
    echo "</ul>"; // Cierra la lista
} else {
    echo "<p>No se encontraron voluntarios.</p>";
}
?>
<!-- Bot®Æn para volver al men®≤ principal -->
<div style="margin-top: 20px;">
    <button onclick="window.location.href='../templates/dashboard_organizacion.php';" style="padding: 10px 20px; font-size: 16px; cursor: pointer;">
        Volver al Men®≤ Principal
    </button>
</div>
