<?php
session_start();

if (isset($_SESSION['usuario'])) {
    header("Location: paso10_despues.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <h1>Crear Cuenta</h1>

    <form method="POST" action="autenticacion.php">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" placeholder="Ingrese su nombre" required>
        <br><br>

        <label for="correo">Correo:</label>
        <input type="email" name="correo" id="correo" placeholder="Ingrese su correo" required>
        <br><br>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" placeholder="Ingrese su contraseña" required>
        <br><br>

        <label for="confirmar_password">Confirmar Contraseña:</label>
        <input type="password" name="confirmar_password" id="confirmar_password" placeholder="Confirmar contraseña" required>
        <br><br>

        <button type="submit">Registrarse</button>
    </form>

    <br>
    <p>¿Ya tienes cuenta? <a href="paso10.php">Inicia sesión aquí</a></p>
</body>
</html>
