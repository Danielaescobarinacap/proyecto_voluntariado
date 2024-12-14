<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Trabajo</title>
    <link rel="stylesheet" href="../styles/styles.css"> <!-- Ajusta la ruta según tu estructura -->
</head>
<body>
    <h1>Editar Trabajo</h1>
    <form action="../php/editar_trabajo.php" method="POST">
        <input type="hidden" name="id_trabajo" value="<?php echo $_SESSION['id']; ?>">
        <table>
            <tr>
                <td>Título:</td>
                <td><input type="text" name="titulo" value="<?php echo $_SESSION['titulo']; ?>" required></td>
            </tr>
            <tr>
                <td>Descripción:</td>
                <td><textarea name="descripcion" required><?php echo $_SESSION['descripcion']; ?></textarea></td>
            </tr>
            <tr>
                <td>Horario:</td>
                <td><input type="text" name="horario" value="<?php echo $_SESSION['horario']; ?>" required></td>
            </tr>
            <tr>
                <td>Días:</td>
                <td><input type="text" name="dias" value="<?php echo $_SESSION['dias']; ?>" required></td>
            </tr>
            <tr>
                <td>Ubicación:</td>
                <td><input type="text" name="ubicacion" value="<?php echo $_SESSION['ubicacion']; ?>" required></td>
            </tr>
            <tr>
                <td>Estado:</td>
                <td>
                    <select name="estado" required>
                        <option value="activo" <?php if ($_SESSION['estado'] === 'activo') echo 'selected'; ?>>Activo</option>
                        <option value="inactivo" <?php if ($_SESSION['estado'] === 'inactivo') echo 'selected'; ?>>Inactivo</option>
                    </select>
                </td>
            </tr>
        </table>
        <br>
        <button type="submit" class="editar-button">Guardar Cambios</button>
        
    </form>

    <div id="messageContainer" style="display: none;"></div>
</body>
</html>