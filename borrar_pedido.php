<?php
include('conexion.php');

$id_pedido = $_GET['id_pedido'];  // Obtener el ID del pedido desde la URL

// Eliminar el pedido de la base de datos
$sql = "DELETE FROM pedidos WHERE id_pedido = $id_pedido";

if ($conn->query($sql) === TRUE) {
    echo "Pedido eliminado correctamente.";
    header("Location: consulta_pedidos.php"); // Redirigir a la página de consulta
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
