<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_estudiante'])) {
    $id = $_POST['id_estudiante'];

    if (!empty($id)) {
        $sql_delete = "DELETE FROM calificaciones WHERE id = ?";
        $stmt = $conn->prepare($sql_delete);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "<p class='success'>Registro eliminado correctamente.</p>";
        } else {
            echo "<p class='error'>Error al eliminar el registro.</p>";
        }
    } else {
        echo "<p class='error'>Por favor, selecciona un estudiante válido.</p>";
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
        <h1>Eliminar Calificación</h1>
        <form method="POST">
            <label for="id_estudiante">Selecciona un estudiante para eliminar:</label>
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
            <button type="submit">Eliminar</button>
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
