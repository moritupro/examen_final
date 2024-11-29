<?php
include 'conexion.php';

$sql_promedio = "SELECT materia, AVG(calificacion) AS promedio FROM calificaciones GROUP BY materia";
$result = $conn->query($sql_promedio);
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
        <h1>Reporte de Promedios por Materia</h1>
        <table>
            <thead>
                <tr>
                    <th>Materia</th>
                    <th>Promedio</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['materia']) . "</td>";
                        echo "<td>" . number_format($row['promedio'], 2) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2' class='no-data'>No hay datos disponibles</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
