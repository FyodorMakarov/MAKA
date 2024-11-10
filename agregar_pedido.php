<?php
include('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_platillo = $_POST['id_platillo'];
    $id_cliente = $_POST['id_cliente'];
    $mesa = $_POST['mesa'];
    $subtotal = $_POST['subtotal'];
    $iva = $_POST['iva'];
    $total = $_POST['total'];

    // Insertar el pedido en la base de datos
    $sql = "INSERT INTO pedidos (id_platillo, id_cliente, mesa, subtotal, iva, total) 
            VALUES ('$id_platillo', '$id_cliente', '$mesa', '$subtotal', '$iva', '$total')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Nuevo pedido agregado correctamente.";
        header("Location: consulta_pedidos.php"); // Redirigir a la página de consulta
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
    <title>Agregar Pedido</title>
</head>
<body>

    <h1>Agregar Pedido</h1>

    <form method="POST" action="">
        ID Platillo: <input type="number" name="id_platillo" required><br>
        ID Cliente: <input type="number" name="id_cliente" required><br>
        Mesa: <input type="number" name="mesa" required><br>
        Subtotal: <input type="number" name="subtotal" required><br>
        IVA: <input type="number" name="iva" required><br>
        Total: <input type="number" name="total" required><br>
        <input type="submit" value="Agregar Pedido">
    </form>

</body>
</html>

<?php
$conn->close();
?>
