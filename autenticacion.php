<?php
session_start();
include 'conexion.php';

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: autenticacion.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];

    if (!empty($usuario) && !empty($clave)) {
        $sql = "SELECT id, nombre FROM usuarios WHERE usuario = ? AND clave = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $usuario, $clave);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $user = $resultado->fetch_assoc();
            $_SESSION['usuario_id'] = $user['marco'];
            $_SESSION['usuario_nombre'] = $user['mori'];
            header("Location: consultar.php");
            exit();
        } else {
            $error = "Usuario o contraseña incorrectos.";
        }
    } else {
        $error = "Por favor, completa todos los campos.";
    }
}

if (isset($_SESSION['usuario_id'])) {
    echo "<!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Dashboard</title>
        <link rel='stylesheet' href='styles.css'>
    </head>
    <body>
        <h1>Bienvenido, " . htmlspecialchars($_SESSION['usuario_nombre']) . "!</h1>
        <p>Has iniciado sesión correctamente.</p>
        <a href='?logout=true'>Cerrar Sesión</a>
    </body>
    </html>";
    exit();
}

echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Iniciar Sesión</title>
    <link rel='stylesheet' href='styles.css'>
</head>
<body>
    <h1>Iniciar Sesión</h1>
    <form method='POST'>
        <label for='usuario'>Usuario:</label>
        <input type='text' name='usuario' id='usuario' required>
        <br><br>
        <label for='clave'>Contraseña:</label>
        <input type='password' name='clave' id='clave' required>
        <br><br>
        <button type='submit' name='login'>Iniciar Sesión</button>
    </form>";
if (isset($error)) {
    echo "<p style='color:red;'>$error</p>";
}
echo "</body>
</html>";

$conn->close();
?>
