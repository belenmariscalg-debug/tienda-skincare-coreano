<?php
session_start();
include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tu Carrito | Skincare Coreano</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<header>
    <div class="logo">Skincare Coreano</div>
    <nav>
        <a href="index.php">Inicio</a>
        <a href="carrito.php">Carrito</a>
        <?php
        if(isset($_SESSION['usuario'])){
            echo '<a href="logout.php">Cerrar sesión</a>';
        }else{
            echo '<a href="login.php">Login</a> <a href="registro.php">Registro</a>';
        }
        ?>
    </nav>
</header>

<main style="padding: 40px 20px;">
    <h2 style="text-align: center; margin-bottom: 20px;">Tu Carrito de Compras</h2>
    
    <div class="contenedor-carrito">
        <?php
        $total = 0;
        if(isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])){
            foreach($_SESSION['carrito'] as $id){
                $sql = "SELECT * FROM productos WHERE id=$id";
                $resultado = mysqli_query($conexion, $sql);
                $fila = mysqli_fetch_assoc($resultado);
                
                if($fila){
                    echo "<div class='item-carrito'>";
                    echo "<span>" . $fila['nombre'] . "</span>";
                    echo "<span>$" . number_format($fila['precio'], 2) . "</span>";
                    echo "</div>";
                    $total += $fila['precio'];
                }
            }
            echo "<div class='total-carrito'>Total: $" . number_format($total, 2) . "</div>";
            echo '<a href="finalizar_compra.php" class="btn-finalizar">Finalizar Compra</a>';
        } else {
            echo "<p style='text-align:center; font-size:18px;'>Tu carrito está vacío. ¡Ve a la tienda a agregar productos!</p>";
        }
        ?>
    </div>
</main>

<footer>
    <p>© 2026 Skincare Coreano Shop</p>
</footer>

</body>
</html>