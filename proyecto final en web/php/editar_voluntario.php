<?php
// Incluir la conexión
include 'conexion.php';

// Verificar si el usuario está logueado (esto es un ejemplo básico)
session_start();
$usuario_id = $_SESSION['id']; // Asumiendo que el ID del usuario está guardado en la sesión

// Consulta para obtener los datos del perfil
$query = "SELECT * FROM voluntarios WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si se obtuvieron datos
if ($result->num_rows > 0) {
    while ($usuario = $result->fetch_assoc()) {
        // Obtener los datos del usuario
        $_SESSION['rut'] = $usuario['rut']; // Rut del voluntario
        $_SESSION['nombre'] = $usuario['nombre']; // Nombre del voluntario
        $_SESSION['apellido'] = $usuario['apellido']; // Apellido del voluntario
    }

    $sql="UPDATE voluntarios SET nombre=?, apellido=?, email=?, telefono=?, habilidades=?, direccion=?, password=? WHERE rut=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $_POST['nombre'], $_POST['apellido'], $_POST['email'], $_POST['telefono'], $_POST['habilidades'], $_POST['direccion'], $_POST['password'], $_POST['rut']);
    
    try {
        $stmt->execute();
        echo "Datos actualizados correctamente.";
        $_SESSION['password'] = $_POST['password']; // Actualizar la contraseña en la sesión
        header("Location: ../templates/dashboard_voluntario.php?success=" . urlencode('Registro exitoso'));
    } catch (Exception $e) {
        echo "Error al actualizar los datos: " . $e->getMessage();
    }

} else {
    header("Location: ../templates/dashboard_voluntario.php?error=" . urlencode('No se actualizaron datos.')); 
}
?>