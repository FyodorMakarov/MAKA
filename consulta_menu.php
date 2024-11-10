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

// Lógica para agregar un platillo
if (isset($_POST['agregar'])) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $costo = $_POST['costo'];

    $sql = "INSERT INTO menu (nombre, descripcion, costo) 
            VALUES ('$nombre', '$descripcion', '$costo')";

    if ($conn->query($sql) === TRUE) {
        echo "Nuevo platillo agregado correctamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Lógica para eliminar un platillo
if (isset($_GET['delete'])) {
    $id_platillo = $_GET['delete'];

    $sql = "DELETE FROM menu WHERE id_platillo = $id_platillo";

    if ($conn->query($sql) === TRUE) {
        echo "Platillo eliminado correctamente";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Lógica para actualizar un platillo
if (isset($_POST['actualizar'])) {
    $id_platillo = $_POST['id_platillo'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $costo = $_POST['costo'];

    $sql = "UPDATE menu SET nombre='$nombre', descripcion='$descripcion', costo='$costo' 
            WHERE id_platillo=$id_platillo";

    if ($conn->query($sql) === TRUE) {
        echo "Platillo actualizado correctamente";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Obtener todos los platillos para mostrar
$sql = "SELECT * FROM menu";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta del Menú</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <h1>Consulta del Menú</h1>

    <!-- Formulario para agregar un platillo -->
    <h2>Agregar Platillo</h2>
    <form method="POST" action="consulta_menu.php">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="text" name="descripcion" placeholder="Descripción" required>
        <input type="number" name="costo" placeholder="Costo" required>
        <button type="submit" name="agregar">Agregar</button>
    </form>

    <!-- Mostrar tabla de platillos -->
    <h2>Platillos Registrados</h2>
    <table border="1">
        <tr>
            <th>ID Platillo</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Costo</th>
            <th>Acciones</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['id_platillo'] . "</td>
                        <td>" . $row['nombre'] . "</td>
                        <td>" . $row['descripcion'] . "</td>
                        <td>" . $row['costo'] . "</td>
                        <td>
                            <a href='consulta_menu.php?delete=" . $row['id_platillo'] . "'>Eliminar</a>
                            <a href='editar_platillo.php?id_platillo=" . $row['id_platillo'] . "'>Editar</a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No hay platillos registrados.</td></tr>";
        }
        ?>
    </table>

</body>
</html>

<?php
// Cerrar la conexión
$conn->close();
?>
