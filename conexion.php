<?php
$host = 'localhost';
$usuario = 'root';
$clave = '';
$base_de_datos = 'practica_final';

$conn = new mysqli($host, $usuario, $clave, $base_de_datos);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
