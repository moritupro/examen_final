<?php

$host = 'localhost'; 
$usuario = 'root'; 
$clave = ''; 

try {

    $conn = new PDO("mysql:host=$host", $usuario, $clave);
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "CREATE DATABASE IF NOT EXISTS practica_final";
    $conn->exec($sql); 
    
    echo "Base de datos 'practica_final' creada exitosamente.<br>";
    
       $conn->exec("USE practica_final");

    $query = "CREATE TABLE IF NOT EXISTS practica_final (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre_estudiante VARCHAR(100),
        materia VARCHAR(100),
        calificacion DECIMAL(5,2)
    )";
    
    $conn->exec($query);
    
    echo "Tabla 'practica_final' creada exitosamente.";
} catch (PDOException $e) {

    echo "Error: " . $e->getMessage();
}
?>