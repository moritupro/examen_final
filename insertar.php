<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_estudiante = $_POST['nombre_estudiante'];
    $materia = $_POST['materia'];
    $calificacion = $_POST['calificacion'];

    $sql = "INSERT INTO calificaciones (nombre_estudiante, materia, calificacion) 
            VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssd", $nombre_estudiante, $materia, $calificacion);

    if ($stmt->execute()) {
        $mensaje = "Registro insertado correctamente.";
    } else {
        $mensaje = "Error al insertar el registro: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
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
        <h2>Registrar Calificación</h2>
        <form action="" method="POST">
            <label for="nombre_estudiante">Nombre del Estudiante:</label>
            <input type="text" id="nombre_estudiante" name="nombre_estudiante" required>

            <label for="materia">Materia:</label>
            <input type="text" id="materia" name="materia" required>

            <label for="calificacion">Calificación:</label>
            <input type="number" id="calificacion" name="calificacion" step="0.01" min="0" max="10" required>

            <input type="submit" value="Registrar">
        </form>
        <?php if (isset($mensaje)): ?>
            <p class="mensaje <?= strpos($mensaje, 'Error') !== false ? 'error' : '' ?>"><?= htmlspecialchars($mensaje) ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
