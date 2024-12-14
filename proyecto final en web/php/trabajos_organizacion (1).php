<?php
include '../php/conexion.php';

$query = "SELECT id, titulo, descripcion, horario, dias, ubicacion, estado FROM trabajos";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['titulo']) . "</td>";
        echo "<td>" . htmlspecialchars($row['descripcion']) . "</td>";
        echo "<td>" . htmlspecialchars($row['horario']) . "</td>";
        echo "<td>" . htmlspecialchars($row['dias']) . "</td>";
        echo "<td>" . htmlspecialchars($row['ubicacion']) . "</td>";
        echo "<td>
                <form action='../php/editar_estado.php' method='POST'>
                    <input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>
                    <select name='estado' onchange='this.form.submit()'>
                        <option value='Activo' " . ($row['estado'] === 'Activo' ? 'selected' : '') . ">Activo</option>
                        <option value='Inactivo' " . ($row['estado'] === 'Inactivo' ? 'selected' : '') . ">Inactivo</option>
                    </select>
                </form>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7' class='no-data'>No hay trabajos registrados</td></tr>";
}

$conn->close();
?>
