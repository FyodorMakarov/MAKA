<?php
// Establece la conexión con la base de datos
$servername = "localhost";  // Cambia esto según tu servidor
$username = "root";         // Cambia esto si tu usuario es diferente
$password = "";             // Cambia esto si tienes una contraseña
$dbname = "restaurante";    // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Lógica para agregar un cliente
if (isset($_POST['agregar'])) {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];
    $id_pedido = $_POST['id_pedido'];

    $sql = "INSERT INTO Clientes (nombre, telefono, correo, direccion, id_pedido) 
            VALUES ('$nombre', '$telefono', '$correo', '$direccion', '$id_pedido')";

    if ($conn->query($sql) === TRUE) {
        echo "Nuevo cliente agregado correctamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Lógica para eliminar un cliente
if (isset($_GET['delete'])) {
    $id_cliente = $_GET['delete'];

    $sql = "DELETE FROM Clientes WHERE id_cliente = $id_cliente";

    if ($conn->query($sql) === TRUE) {
        echo "Cliente eliminado correctamente";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Lógica para actualizar un cliente
if (isset($_POST['actualizar'])) {
    $id_cliente = $_POST['id_cliente'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];
    $id_pedido = $_POST['id_pedido'];

    $sql = "UPDATE Clientes SET nombre='$nombre', telefono='$telefono', correo='$correo', direccion='$direccion', id_pedido='$id_pedido' 
            WHERE id_cliente=$id_cliente";

    if ($conn->query($sql) === TRUE) {
        echo "Cliente actualizado correctamente";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Obtener todos los clientes para mostrar
$sql = "SELECT * FROM Clientes";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Clientes</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <h1>Consulta de Clientes</h1>

    <!-- Formulario para agregar un cliente -->
    <h2>Agregar Cliente</h2>
    <form method="POST" action="consulta_alumnos.php">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="text" name="telefono" placeholder="Teléfono" required>
        <input type="email" name="correo" placeholder="Correo" required>
        <input type="text" name="direccion" placeholder="Dirección" required>
        <input type="number" name="id_pedido" placeholder="ID Pedido" required>
        <button type="submit" name="agregar">Agregar</button>
    </form>

    <!-- Mostrar tabla de clientes -->
    <h2>Clientes Registrados</h2>
    <table border="1">
        <tr>
            <th>ID Cliente</th>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Correo</th>
            <th>Dirección</th>
            <th>ID Pedido</th>
            <th>Acciones</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['id_cliente'] . "</td>
                        <td>" . $row['nombre'] . "</td>
                        <td>" . $row['telefono'] . "</td>
                        <td>" . $row['correo'] . "</td>
                        <td>" . $row['direccion'] . "</td>
                        <td>" . $row['id_pedido'] . "</td>
                        <td>
                            <a href='consulta_alumnos.php?delete=" . $row['id_cliente'] . "'>Eliminar</a>
                            <a href='editar_cliente.php?id_cliente=" . $row['id_cliente'] . "'>Editar</a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No hay clientes registrados.</td></tr>";
        }
        ?>
    </table>

</body>
</html>

<?php
// Cerrar la conexión
$conn->close();
?>
