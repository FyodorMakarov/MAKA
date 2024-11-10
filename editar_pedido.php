<?php
// Verificar que se ha pasado el ID del pedido
if (isset($_GET['id_pedido'])) {
    $id_pedido = $_GET['id_pedido'];

    // Conectar a la base de datos
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consultar los datos del pedido
    $sql = "SELECT * FROM pedidos WHERE id_pedido = $id_pedido";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Cargar los datos del pedido
        $row = $result->fetch_assoc();
        $id_platillo = $row['id_platillo'];
        $id_cliente = $row['id_cliente'];
        $mesa = $row['mesa'];
        $subtotal = $row['subtotal'];
        $iva = $row['iva'];
        $total = $row['total'];
    } else {
        echo "No se encontró el pedido.";
        exit();
    }

    // Cerrar la conexión
    $conn->close();
}
?>

<!-- Formulario para editar el pedido -->
<form action="actualizar_pedido.php" method="POST">
    <input type="hidden" name="id_pedido" value="<?php echo $id_pedido; ?>">
    <label for="id_platillo">ID Platillo:</label>
    <input type="text" name="id_platillo" value="<?php echo $id_platillo; ?>"><br><br>
    <label for="id_cliente">ID Cliente:</label>
    <input type="text" name="id_cliente" value="<?php echo $id_cliente; ?>"><br><br>
    <label for="mesa">Mesa:</label>
    <input type="text" name="mesa" value="<?php echo $mesa; ?>"><br><br>
    <label for="subtotal">Subtotal:</label>
    <input type="text" name="subtotal" value="<?php echo $subtotal; ?>"><br><br>
    <label for="iva">IVA:</label>
    <input type="text" name="iva" value="<?php echo $iva; ?>"><br><br>
    <label for="total">Total:</label>
    <input type="text" name="total" value="<?php echo $total; ?>"><br><br>
    
    <input type="submit" value="Actualizar Pedido">
</form>
