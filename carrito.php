<?php

session_start();
include("conexion.php");

$total = 0;

if(isset($_SESSION['carrito'])){

    foreach($_SESSION['carrito'] as $id){

        $sql = "SELECT * FROM productos WHERE id=$id";
        $resultado = mysqli_query($conexion,$sql);

        $fila = mysqli_fetch_assoc($resultado);

        echo $fila['nombre'];
        echo "$".$fila['precio']."<br>";

        $total += $fila['precio'];
    }
}

echo "<h2>Total: $$total</h2>";

?>