<?php
session_start();
include("conexion.php");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Skincare Coreano</title>

    <link rel="stylesheet" href="estilos.css">
</head>

<body>

<!-- NAVBAR -->

<header>

    <div class="logo">
        Skincare Coreano
    </div>

    <nav>

        <a href="index.php">Inicio</a>
        <a href="carrito.php">Carrito</a>

        <?php

        if(isset($_SESSION['usuario'])){
            echo '<a href="logout.php">Cerrar sesión</a>';
        }else{
            echo '
            <a href="login.php">Login</a>
            <a href="registro.php">Registro</a>
            ';
        }

        ?>

    </nav>

</header>

<!-- BANNER -->

<section class="banner">

    <div class="banner-texto">

        <h1>Descubre tu glow coreano ✨</h1>

        <p>
            Productos de skincare coreano para una piel perfecta.
        </p>

        <a href="#productos">Ver productos</a>

    </div>

</section>

<!-- PRODUCTOS -->

<section id="productos">

    <h2>Nuestros Productos</h2>

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

</section>

<!-- FOOTER -->

<footer>

    <p>© 2026 Skincare Coreano Shop</p>

</footer>

</body>
</html>