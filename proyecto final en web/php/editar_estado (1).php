<?php
include '../php/conexion.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
    $estado = $_POST['estado'];

    if (empty($id) || empty($estado)) {
        header("Location: ../templates/dashboard_mis_trabajos.php?error=Error al actualizar el estado");
        exit;
    }

    $query = "UPDATE trabajos SET estado = ? WHERE id = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("si", $estado, $id);
        if ($stmt->execute()) {
            header("Location: ../templates/dashboard_mis_trabajos.php?success=Estado actualizado correctamente");
        } else {
            header("Location: ../templates/dashboard_mis_trabajos.php?error=Error al actualizar el estado");
        }
        $stmt->close();
    } else {
        header("Location: ../templates/dashboard_mis_trabajos.php?error=Error en la consulta SQL");
    }

    $conn->close();
} else {
    header("Location: ../templates/dashboard_mis_trabajos.php");
}
?>
