<?php
// Establecer la conexión a la base de datos
$servername = "localhost";  // Cambia esto según tu servidor
$username = "root";         // Cambia esto si tu usuario es diferente
$password = "";             // Cambia esto si tienes una contraseña
$dbname = "restaurante";    // Nombre de la base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el ID del platillo está presente en la URL
if (isset($_GET['id_platillo'])) {
    $id_platillo = $_GET['id_platillo'];

    // Obtener los datos del platillo desde la base de datos
    $sql = "SELECT * FROM menu WHERE id_platillo = $id_platillo";
    $result = $conn->query($sql);

    // Verificar si el platillo existe
    if ($result->num_rows > 0) {
        $platillo = $result->fetch_assoc();
    } else {
        echo "Platillo no encontrado.";
        exit;
    }
} else {
    echo "ID de platillo no especificado.";
    exit;
}

// Lógica para actualizar el platillo
if (isset($_POST['actualizar'])) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $costo = $_POST['costo'];

    $sql = "UPDATE menu SET nombre='$nombre', descripcion='$descripcion', costo='$costo' 
            WHERE id_platillo=$id_platillo";

    if ($conn->query($sql) === TRUE) {
        echo "Platillo actualizado correctamente";
        header("Location: consulta_menu.php");  // Redirigir de vuelta a la pági
    }
}