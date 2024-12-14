<?php
session_start();
include ('../php/conexion.php'); // Asegúrate de que la conexión esté correcta

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Determinar si es voluntario o organización
    $tipo = $_POST['tipo']; // 'voluntario' o 'organizacion'

    // Consultar en la tabla correspondiente según el tipo
    if ($tipo === 'voluntario') {
        $query = "SELECT * FROM voluntarios WHERE email = ?";
    } else {
        $query = "SELECT * FROM organizaciones WHERE email = ?";
    }

    // Preparar y ejecutar la consulta
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);  // "s" es para string
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Obtener los datos del usuario
        $usuario = $result->fetch_assoc();
    

        // Verificar la contraseña (comparación directa sin hashing)
        if ($password === $usuario['password']) {
            // Iniciar sesión
            $_SESSION['id'] = $usuario['id']; // Id del usuario
            $_SESSION['email'] = $usuario['email']; // El email para verificar la sesión
            $_SESSION['tipo'] = $tipo; // Establecer el tipo de usuario

            // En caso de ser voluntario o organización, asignar el nombre correspondiente
            if ($tipo === 'voluntario') {
                $_SESSION['rut'] = $usuario['rut']; // Rut del voluntario
                $_SESSION['nombre'] = $usuario['nombre']; // Nombre del voluntario
                $_SESSION['apellido'] = $usuario['apellido']; // Apellido del voluntario
                $_SESSION['telefono']= $usuario['telefono'];
                $_SESSION['habilidades']= $usuario['habilidades'];
                $_SESSION['direccion']= $usuario['direccion'];
                $_SESSION['password']= $usuario['password'];
            } else {
                //$_SESSION['nombre'] = $usuario['email']; // Usamos el email como nombre en el caso de la organización
                
                
                $_SESSION['id'] = $usuario['id'];       
                $_SESSION['rutEmpresa'] = $usuario['rutEmpresa']; // Rut de la organización
                $_SESSION['personalidadJuridica'] = $usuario['personalidadJuridica'];
                $_SESSION['nombreFantasia'] = $usuario['nombreFantasia'];
                $_SESSION['descripcion'] = $usuario['descripcion'];
                $_SESSION['email'] = $usuario['email'];
                $_SESSION['telefono'] = $usuario['telefono'];
                $_SESSION['personaCargo']= $usuario['personaCargo'];
                $_SESSION['direccion'] = $usuario['direccion'];
                
                 $usuario_id = $_SESSION['id']; 
            }



         //   $_SESSION['tipo'] = $tipo; // Establecemos el tipo (voluntario/organizacion)

            // Redirigir según el tipo de usuario
            $dashboard = ($tipo === 'voluntario') ? 'dashboard_voluntario.php' : 'dashboard_organizacion.php';
            header("Location: ../templates/$dashboard");
            exit();
        } else {
            // Si la contraseña es incorrecta
            header("Location: ../index.html?error=Contraseña%20incorrecta");
            exit();
        }
    } else {
        // Si no se encuentra el usuario
        header("Location: ../index.html?error=Usuario%20no%20encontrado");
        exit();
    }
 
}
?>
