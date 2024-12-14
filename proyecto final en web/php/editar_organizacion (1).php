<?php
// Incluir la conexión
include 'conexion.php';

// Verificar si el usuario está logueado (esto es un ejemplo básico)
session_start();
$usuario_id = $_SESSION['id']; // Asumiendo que el ID del usuario está guardado en la sesión

// Consulta para obtener los datos del perfil
$query = "SELECT * FROM organizaciones WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si se obtuvieron datos
if ($result->num_rows > 0) {
    while ($usuario = $result->fetch_assoc()) {
        // Obtener los datos del usuario
        $_SESSION['rutEmpresa'] = $usuario['rutEmpresa']; // Rut del voluntario
        $_SESSION['personalidadJuridica'] = $usuario['personalidadJuridica']; // Nombre del voluntario
        $_SESSION['nombreFantasia'] = $usuario['nombreFantasia']; // Apellido del voluntario
    }

    $sql="UPDATE organizaciones SET personalidadJuridica=?, nombreFantasia=?, descripcion=?, email=?, telefono=?, personaCargo=?, direccion=?, password=? WHERE rutEmpresa=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $_POST['personalidadJuridica'], $_POST['nombreFantasia'], $_POST['descripcion'], $_POST['email'], $_POST['telefono'], $_POST['personaCargo'], $_POST['direccion'], $_POST['password'], $_SESSION['rutEmpresa']);
    
    try {
        if ($stmt->execute()) {
        echo "Datos actualizados correctamente.";
        $_SESSION['password'] = $_POST['password']; // Actualizar la contraseña en la sesión
        header("Location: ../templates/dashboard_organizacion.php?success=" . urlencode('Registro exitoso'));
    } 
    } catch (Exception $e) {
        echo "Error al actualizar los datos: " . $e->getMessage();
    }
    
} else {
    header("Location: ../templates/dashboard_organizacion.php?error=" . urlencode('No se actualizaron datos.')); 
}
?>