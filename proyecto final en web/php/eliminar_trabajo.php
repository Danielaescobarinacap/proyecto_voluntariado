<?php
include 'conexion.php';
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



if ($result) {
    $id = $result->fetch_assoc()['id'];
    $query = "DELETE FROM trabajos WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: ../templates/dashboard_mis_trabajos.php?success=El trabajo fue eliminado.");
    } else {
        header("Location: ../templates/dashboard_mis_trabajos.php?error=No se pudo eliminar el trabajo.");
    }
} else {
    header("Location: ../templates/dashboard_mis_trabajos.php?error=ID no válido.");
}
