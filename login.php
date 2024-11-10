<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css.css">
</head>
<body>
    <center>
        <h2>Iniciar Sesión</h2>
        <form action="login_process.php" method="post">
            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" required><br><br>
            <label for="contrasena">Contraseña:</label>
            <input type="password" name="contrasena" required><br><br>
            <button type="submit">Ingresar</button>
        </form>
    </center>
</body>
</html>
