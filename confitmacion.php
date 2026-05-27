<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Compra Confirmada | Skincare Coreano</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<header>
    <div class="logo">Skincare Coreano</div>
    <nav>
        <a href="index.php">Inicio</a>
        <?php
        if(isset($_SESSION['usuario'])){
            echo '<a href="logout.php">Cerrar sesión</a>';
        }else{
            echo '<a href="login.php">Login</a>';
        }
        ?>
    </nav>
</header>

<main style="text-align:center; padding: 80px 20px;">
    <div style="background:white; max-width:500px; margin:auto; padding:50px; border-radius:20px; box-shadow:0px 5px 20px rgba(0,0,0,0.08);">
        <div style="font-size:70px; margin-bottom:20px;">🎉</div>
        <h2 style="font-size:30px; color:#333; margin-bottom:15px;">¡Compra realizada!</h2>
        <p style="font-size:18px; color:#888; margin-bottom:30px;">Gracias por tu compra. Tu pedido está en camino. 🌸</p>
        <a href="index.php" class="btn-finalizar">Seguir comprando</a>
    </div>
</main>

<footer>
    <p>© 2026 Skincare Coreano Shop</p>
</footer>

</body>
</html>