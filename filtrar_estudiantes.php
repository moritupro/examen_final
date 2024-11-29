<?php
include 'conexion.php';

$nombre_estudiante = '';
$result = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_estudiante = $_POST['nombre_estudiante'];
    $sql = "SELECT * FROM calificaciones WHERE nombre_estudiante LIKE ?";
    $stmt = $conn->prepare($sql);
    $like_nombre = "%" . $nombre_estudiante . "%";
    $stmt->bind_param("s", $like_nombre);
    $stmt->execute();
    $result = $stmt->get_result();
}
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
        <h2>Buscar Calificaciones por Nombre del Estudiante</h2>
        <form action="" method="POST">
            <label for="nombre_estudiante">Nombre del Estudiante:</label>
            <input type="text" id="nombre_estudiante" name="nombre_estudiante" value="<?php echo htmlspecialchars($nombre_estudiante); ?>" required>
            <input type="submit" value="Buscar">
        </form>

        <?php
        if ($result !== null) {
            if ($result->num_rows > 0) {
                echo "<table>
                        <tr>
                            <th>ID</th>
                            <th>Nombre del Estudiante</th>
                            <th>Materia</th>
                            <th>Calificación</th>
                        </tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row['id'] . "</td>
                            <td>" . $row['nombre_estudiante'] . "</td>
                            <td>" . $row['materia'] . "</td>
                            <td>" . $row['calificacion'] . "</td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "<p class='no-records'>No se encontraron registros para el nombre de estudiante '$nombre_estudiante'.</p>";
            }
        }
        
        $conn->close();
        ?>
    </div>
</body>
</html>
