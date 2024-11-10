<?php
include 'conexion.php';

if (isset($_GET['id_cliente'])) {
    $id_cliente = $_GET['id_cliente'];

    // Obtener el cliente a editar
    $sql = "SELECT * FROM clientes WHERE id_cliente=$id_cliente";
    $result = $conn->query($sql);
    $cliente = $result->fetch_assoc();
}

if (isset($_POST['editar'])) {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];
    $id_pedido = $_POST['id_pedido'];

    $sql_update = "UPDATE clientes SET nombre='$nombre', telefono='$telefono', correo='$correo', 
                   direccion='$direccion', id_pedido='$id_pedido' WHERE id_cliente=$id_cliente";

    if ($conn->query($sql_update) === TRUE) {
        echo "Cliente actualizado exitosamente";
        header('Location: clientes.php');
    } else {
        echo "Error al actualizar el cliente: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
</head>
<body>

<h1>Editar Cliente</h1>

<form action="editar_cliente.php?id_cliente=<?php echo $id_cliente; ?>" method="POST">
    <input type="text" name="nombre" value="<?php echo $cliente['nombre']; ?>" required>
    <input type="text" name="telefono" value="<?php echo $cliente['telefono']; ?>" required>
    <input type="email" name="correo" value="<?php echo $cliente['correo']; ?>" required>
    <input type="text" name="direccion" value="<?php echo $cliente['direccion']; ?>" required>
    <input type="number" name="id_pedido" value="<?php echo $cliente['id_pedido']; ?>" required>
    <input type="submit" name="editar" value="Actualizar Cliente">
</form>

</body>
</html>
