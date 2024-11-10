<?php
include('conexion.php');

// Obtener los pedidos
$sql = "SELECT * FROM pedidos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta Pedidos</title>
</head>
<body>

    <h1>Consulta de Pedidos</h1>

    <a href="agregar_pedido.php">Agregar Nuevo Pedido</a>

    <table border="1">
        <tr>
            <th>ID Pedido</th>
            <th>ID Platillo</th>
            <th>ID Cliente</th>
            <th>Mesa</th>
            <th>Subtotal</th>
            <th>IVA</th>
            <th>Total</th>
            <th>Acciones</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['id_pedido'] . "</td>
                        <td>" . $row['id_platillo'] . "</td>
                        <td>" . $row['id_cliente'] . "</td>
                        <td>" . $row['mesa'] . "</td>
                        <td>" . $row['subtotal'] . "</td>
                        <td>" . $row['iva'] . "</td>
                        <td>" . $row['total'] . "</td>
                        <td><a href='editar_pedido.php?id_pedido=" . $row['id_pedido'] . "'>Editar</a> | <a href='borrar_pedido.php?id_pedido=" . $row['id_pedido'] . "'>Borrar</a></td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No hay pedidos disponibles</td></tr>";
        }
        ?>
    </table>

</body>
</html>

<?php
$conn->close();
?>
