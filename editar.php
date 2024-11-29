<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_estudiante'];
    $nueva_calificacion = $_POST['calificacion'];

    if (!empty($id) && is_numeric($nueva_calificacion)) {
        $sql_update = "UPDATE calificaciones SET calificacion = ? WHERE id = ?";
        $stmt = $conn->prepare($sql_update);
        $stmt->bind_param("di", $nueva_calificacion, $id);

        if ($stmt->execute()) {
            echo "<p class='success'>Calificación actualizada correctamente.</p>";
        } else {
            echo "<p class='error'>Error al actualizar la calificación.</p>";
        }
    } else {
        echo "<p class='error'>Por favor, selecciona un estudiante y proporciona una calificación válida.</p>";
    }
}

$sql_select = "SELECT id, nombre_estudiante FROM calificaciones";
$result = $conn->query($sql_select);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Título</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Actualizar Calificación</h1>
        <form method="POST">
            <label for="id_estudiante">Selecciona un estudiante:</label>
            <select name="id_estudiante" id="id_estudiante" required>
                <option value="">-- Seleccionar --</option>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['nombre_estudiante']) . "</option>";
                    }
                } else {
                    echo "<option value=''>No hay estudiantes disponibles</option>";
                }
                ?>
            </select>
            <br><br>
            <label for="calificacion">Nueva Calificación:</label>
            <input type="number" step="0.01" name="calificacion" id="calificacion" required>
            <br><br>
            <button type="submit">Actualizar</button>
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
