<?php
include("conexion.php");
?>

<!DOCTYPE html>
<html >

<head>
    <title>Tienda Skincare Coreano</title>

    <link rel="stylesheet" href="estilos.css">
</head>

<body>

    <header>
        <h1>Tienda Skincare Coreano</h1>
    </header>

    <div class="contenedor-productos">

    <?php

    $sql = "SELECT * FROM productos";
    $resultado = mysqli_query($conexion,$sql);

    while($fila = mysqli_fetch_assoc($resultado)){
    ?>

        <div class="producto">

            <img src="img/<?php echo $fila['imagen']; ?>">

            <h3><?php echo $fila['nombre']; ?></h3>

            <p>$<?php echo $fila['precio']; ?></p>

            <a href="agregar_carrito.php?id=<?php echo $fila['id']; ?>">
                Agregar al carrito
            </a>

        </div>

    <?php } ?>

    </div>

</body>
</html>