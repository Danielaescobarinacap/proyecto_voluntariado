<?php
// Incluimos la conexión a la base de datos
include 'conexion.php';

// Habilitar errores para depuración (temporal)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verificamos si se enviaron los datos mediante POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitizar los datos de entrada
    $identification = $_POST['identification'];

    // Validación de campos
    if ($identification == 'voluntario') {
        // Voluntario
        $rut = $_POST['rut'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = filter_var(trim($_POST['emailVoluntario']), FILTER_SANITIZE_EMAIL);
        $telefono = $_POST['telefonoVoluntario'];
        $habilidades = $_POST['habilidades'];
        $direccion = $_POST['direccion'];
        $password = $_POST['passwordVoluntario'];
        $confirmPassword = $_POST['confirmPasswordVoluntario'];

        // Validación de contraseñas
        if ($password !== $confirmPassword) {
            header("Location: ../index.html?error=" . urlencode('Las contraseñas no coinciden'));
            exit();
        }

        // Verificar si el correo o el RUT ya están registrados
        $stmt = $conn->prepare("SELECT * FROM voluntarios WHERE email = ? OR rut = ? LIMIT 1");
        $stmt->bind_param("ss", $email, $rut);
        
        if (!$stmt->execute()) {
            // Si la consulta falla, mostrar el error
            die("Error en la consulta: " . $stmt->error);
        }

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Si ya existe el correo o el RUT
            header("Location: ../index.html?error=" . urlencode('El correo o el RUT ya están registrados'));
            exit();
        }

        // No se realiza encriptación de la contraseña
        // Directamente se usa la contraseña tal como está
        $hashedPassword = $password;  // La contraseña en texto plano

        // Insertar el nuevo voluntario en la base de datos
        $stmt = $conn->prepare("INSERT INTO voluntarios (rut, nombre, apellido, email, telefono, habilidades, direccion, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $rut, $nombre, $apellido, $email, $telefono, $habilidades, $direccion, $hashedPassword);

        if ($stmt->execute()) {
            header("Location: ../index.html?success=" . urlencode('Registro exitoso'));
        } else {
            // Mostrar error si no se pudo insertar
            header("Location: ../index.html?error=" . urlencode('Error al registrar el voluntario: ' . $stmt->error));
        }
    } elseif ($identification == 'organizacion') {
        // Organización
        $rutEmpresa = $_POST['rutEmpresa'];
        $personalidadJuridica = $_POST['personalidadJuridica'];
        $nombreFantasia = $_POST['nombreFantasia'];
        $personaCargo = $_POST['personaCargo'];
        $descripcionOrganizacion = $_POST['descripcionOrganizacion'];
        $emailOrganizacion = filter_var(trim($_POST['emailOrganizacion']), FILTER_SANITIZE_EMAIL);
        $telefonoOrganizacion = $_POST['telefonoOrganizacion'];
        $direccionOrganizacion = $_POST['direccionOrganizacion'];
        $passwordOrganizacion = $_POST['passwordOrganizacion'];
        $confirmPassword = $_POST['confirmPasswordOrganizacion'];

        // Validación de contraseñas
        if ($passwordOrganizacion !== $confirmPassword) {
            header("Location: ../index.html?error=" . urlencode('Las contraseñas no coinciden'));
            exit();
        }

        // Verificar si el correo o el RUT ya están registrados
        $stmt = $conn->prepare("SELECT * FROM organizaciones WHERE email = ? OR rutEmpresa = ? LIMIT 1");
        $stmt->bind_param("ss", $emailOrganizacion, $rutEmpresa);

        if (!$stmt->execute()) {
            die("Error en la consulta: " . $stmt->error);
        }

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Si ya existe el correo o el RUT
            header("Location: ../index.html?error=" . urlencode('El correo o el RUT ya están registrados'));
            exit();
        }

        // No se realiza encriptación de la contraseña
        // Directamente se usa la contraseña tal como está
        //$hashedPassword = $password;  // La contraseña en texto plano

        // Insertar la organización en la base de datos
        $stmt = $conn->prepare("INSERT INTO organizaciones (rutEmpresa, personalidadJuridica, nombreFantasia, descripcion, email, telefono, personaCargo,direccion, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $rutEmpresa, $personalidadJuridica, $nombreFantasia,$descripcionOrganizacion, $emailOrganizacion, $telefonoOrganizacion, $personaCargo, $direccionOrganizacion, $passwordOrganizacion);

        if ($stmt->execute()) {
            header("Location: ../index.html?success=" . urlencode('Registro exitoso'));
        } else {
            header("Location: ../index.html?error=" . urlencode('Error al registrar la organización: ' . $stmt->error));
        }
    } else {
        header("Location: ../index.html?error=" . urlencode('Tipo de identificación no válido'));
    }
}

// Cerrar conexión
$conn->close();
?>
