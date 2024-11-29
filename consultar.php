<?php
include 'conexion.php';

$sql = "SELECT * FROM calificaciones";
$result = $conn->query($sql);

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
        <h2>Lista de Calificaciones</h2>

        <?php
        if ($result->num_rows > 0) {
            echo "<table>
                    <tr>
                        <th>ID</th>
                        <th>Nombre del Estudiante</th>
                        <th>Materia</th>
                        <th>Calificación</th>
                    </tr>";

            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['id'] . "</td>
                        <td>" . $row['nombre_estudiante'] . "</td>
                        <td>" . $row['materia'] . "</td>
                        <td>" . $row['calificacion'] . "</td>
                      </tr>";
            }

            echo "</table>";
        } else {
            echo "<p class='no-records'>No hay registros en la base de datos.</p>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
