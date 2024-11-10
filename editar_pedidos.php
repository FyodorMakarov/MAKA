<?php
include('conexion.php');

$id_pedido = $_GET['id_pedido'];  // Obtener el ID del pedido desde la URL

// Obtener los datos del pedido
$sql = "SELECT * FROM pedidos WHERE id_pedido = $id_pedido";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_platillo = $_POST['id_platillo'];
    $id_cliente = $_POST['id_cliente'];
    $mesa = $_POST['mesa'];
    $subtotal = $_POST['subtotal'];
    $iva = $_POST['iva'];
    $total = $_POST['total'];

    // Actualizar el pedido en la base de datos
    $sql = "UPDATE pedidos SET id_platillo='$id_platillo', id_cliente='$id_cliente', mesa='$mesa', 
            subtotal='$subtotal', iva='$iva', total='$total' WHERE id_pedido=$id_pedido";
    
    if ($conn->query($sql) === TRUE) {
        echo "Pedido actualizado correctamente.";
        header("Location: consulta_pedidos.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pedido</title>
</head>
<body>

    <h1>Editar Pedido</h1>

    <form method="POST" action="">
        ID Platillo: <input type="number" name="id_platillo" value="<?php echo $row['id_platillo']; ?>" required><br>
        ID Cliente: <input type="number" name="id_cliente" value="<?php echo $row['id_cliente']; ?>" required><br>
        Mesa: <input type="number" name="mesa" value="<?php echo $row['mesa']; ?>" required><br>
        Subtotal: <input type="number" name="subtotal" value="<?php echo $row['subtotal']; ?>" required><br>
        IVA: <input type="number" name="iva" value="<?php echo $row['iva']; ?>" required><br>
        Total: <input type="number" name="total" value="<?php echo $row['total']; ?>" required><br>
        <input type="submit" value="Actualizar Pedido">
    </form>

</body>
</html>

<?php
$conn->close();
?>
