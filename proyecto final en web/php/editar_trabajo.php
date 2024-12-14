<?php
include 'conexion.php'; // Asegúrate de que esta ruta sea correcta
session_start();

$sql = "SELECT id FROM trabajos WHERE id_organizacion = ?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['id']);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 0) {
    header("Location: dashboard_mis_trabajos.php?error=No se encontraron trabajos.");
    exit();
}

// Cargar los datos del trabajo para mostrar en el formulario
$query = "SELECT * FROM trabajos WHERE id = ? AND id_organizacion = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $id_trabajo, $_SESSION['id']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: ../templates/dashboard_mis_trabajos.php?error=Trabajo no encontrado.");
    exit();
}

$trabajo = $result->fetch_assoc();

// Procesar el formulario cuando se envíen los cambios
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_trabajo = ($_POST['id_trabajo']);
    $titulo = ($_POST['titulo']);
    $descripcion = ($_POST['descripcion']);
    $horario = ($_POST['horario']);
    $dias = ($_POST['dias']);
    $ubicacion = ($_POST['ubicacion']);
    $estado = ($_POST['estado']);

    $update_query = "UPDATE trabajos SET titulo = ?, descripcion = ?, horario = ?, dias = ?, ubicacion = ?, estado = ? WHERE id = ? AND id_organizacion = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("ssssssii", $titulo, $descripcion, $horario, $dias, $ubicacion, $estado, $id_trabajo, $_SESSION['id']);

    try {
         $update_stmt->execute();
        header("Location: ../templates/dashboard_mis_trabajos.php?success=El trabajo fue actualizado exitosamente.");
    } catch (Exception $e) {
        header("Location: ../templates/dashboard_mis_trabajos.php?error=No se pudo actualizar el trabajo.");
    }
    exit();
}
?>