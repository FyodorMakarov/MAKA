<?php
include 'conexion.php';

// Obtener los registros de la tabla 'clientes'
$sql = "SELECT * FROM clientes";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Clientes</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>

<h1>Gestionar Clientes</h1>

<!-- Formulario para agregar un nuevo cliente -->
<form action="clientes.php" method="POST">
    <input type="text" name="nombre" placeholder="Nombre" required>
    <input type="text" name="telefono" placeholder="Teléfono" required>
    <input type="email" name="correo" placeholder="Correo" required>
    <input type="text" name="direccion" placeholder="Dirección" required>
    <input type="number" name="id_pedido" placeholder="ID Pedido" required>
    <input type="submit" name="agregar" value="Agregar Cliente">
</form>

<!-- Mostrar los registros de clientes -->
<table border="1">
    <thead>
        <tr>
            <th>ID Cliente</th>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Correo</th>
            <th>Dirección</th>
            <th>ID Pedido</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            // Mostrar cada cliente en una fila de la tabla
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['id_cliente'] . "</td>
                        <td>" . $row['nombre'] . "</td>
                        <td>" . $row['telefono'] . "</td>
                        <td>" . $row['correo'] . "</td>
                        <td>" . $row['direccion'] . "</td>
                        <td>" . $row['id_pedido'] . "</td>
                        <td>
                            <a href='editar_cliente.php?id_cliente=" . $row['id_cliente'] . "'>Editar</a> | 
                            <a href='clientes.php?borrar=" . $row['id_cliente'] . "'>Eliminar</a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No hay registros</td></tr>";
        }
        ?>
    </tbody>
</table>

<?php
// Agregar un nuevo cliente
if (isset($_POST['agregar'])) {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];
    $id_pedido = $_POST['id_pedido'];

    $sql_insert = "INSERT INTO clientes (nombre, telefono, correo, direccion, id_pedido) 
                   VALUES ('$nombre', '$telefono', '$correo', '$direccion', '$id_pedido')";

    if ($conn->query($sql_insert) === TRUE) {
        echo "Nuevo cliente agregado exitosamente";
        header('Location: clientes.php');
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }
}

// Eliminar un cliente
if (isset($_GET['borrar'])) {
    $id_cliente = $_GET['borrar'];

    $sql_delete = "DELETE FROM clientes WHERE id_cliente=$id_cliente";

    if ($conn->query($sql_delete) === TRUE) {
        echo "Cliente eliminado exitosamente";
        header('Location: clientes.php');
    } else {
        echo "Error al eliminar el cliente: " . $conn->error;
    }
}

$conn->close();
?>

</body>
</html>
