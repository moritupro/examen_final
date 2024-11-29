<?php
$host = 'localhost';
$usuario = 'root';
$clave = '';
$base_de_datos = 'practica_final';

$conn = new mysqli($host, $usuario, $clave, $base_de_datos);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$sql = "CREATE TABLE IF NOT EXISTS calificaciones (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nombre_estudiante VARCHAR(100) NOT NULL,
    materia VARCHAR(100) NOT NULL,
    calificacion DECIMAL(5,2) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabla 'calificaciones' creada exitosamente.";
} else {
    echo "Error al crear la tabla: " . $conn->error;
}

$conn->close();
?>
