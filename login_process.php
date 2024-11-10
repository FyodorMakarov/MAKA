<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "restaurante");

if (!$con) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

// Consultar el usuario
$query = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
$resultado = mysqli_query($con, $query);

if ($resultado && mysqli_num_rows($resultado) > 0) {
    $usuario_data = mysqli_fetch_assoc($resultado);

    // Verificar la contraseña (puedes usar password_hash en el registro)
    if ($contrasena == $usuario_data['contrasena']) {
        $_SESSION['usuario'] = $usuario;
        header("Location: inicio.html"); // Redirigir al menú principal
        exit();
    } else {
        echo "Contraseña incorrecta.";
    }
} else {
    echo "Usuario no encontrado.";
}

mysqli_close($con);
?>
