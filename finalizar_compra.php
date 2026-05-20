<?php
session_start();
include("conexion.php");

$usuario_id = 1; // temporal
$total = 0;

foreach($_SESSION['carrito'] as $id){

    $sql = "SELECT * FROM productos WHERE id=$id";
    $resultado = mysqli_query($conexion,$sql);

    $fila = mysqli_fetch_assoc($resultado);

    $total += $fila['precio'];
}

$sqlPedido = "INSERT INTO pedidos(usuario_id,total)
              VALUES('$usuario_id','$total')";

mysqli_query($conexion,$sqlPedido);

$pedido_id = mysqli_insert_id($conexion);

foreach($_SESSION['carrito'] as $id){

    $sqlDetalle = "INSERT INTO detalle_pedido
                   (pedido_id,producto_id,cantidad)
                   VALUES('$pedido_id','$id',1)";

    mysqli_query($conexion,$sqlDetalle);
}

unset($_SESSION['carrito']);

echo "Compra realizada";

?>