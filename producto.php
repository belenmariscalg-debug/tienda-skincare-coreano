<?php
session_start();
include("conexion.php");

// 1. Verificar si recibimos un ID por la URL
if (isset($_GET['id'])) {
    // Usamos intval() por seguridad para asegurarnos de que sea un número
    $id_producto = intval($_GET['id']); 

    // 2. Consultar la información de ese producto en específico
    $sql = "SELECT * FROM productos WHERE id = $id_producto";
    $resultado = mysqli_query($conexion, $sql);

    // 3. Comprobar si el producto existe en la base de datos
    if (mysqli_num_rows($resultado) > 0) {
        $producto = mysqli_fetch_assoc($resultado);
    } else {
        $error = "El producto que buscas no existe.";
    }
} else {
    $error = "No se ha seleccionado ningún producto.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo isset($producto) ? $producto['nombre'] : 'Producto no encontrado'; ?> - Skincare Coreano</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        /* Estilos rápidos para acomodar el detalle del producto (puedes pasarlos a tu estilos.css) */
        .detalle-contenedor {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 40px;
            padding: 50px 20px;
            max-width: 900px;
            margin: 0 auto;
        }
        .detalle-imagen img {
            max-width: 400px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .detalle-info h1 {
            font-size: 2rem;
            margin-bottom: 10px;
        }
        .detalle-info .precio {
            font-size: 1.5rem;
            color: #d15c7e; /* Un color acorde al tema skincare */
            font-weight: bold;
            margin-bottom: 20px;
        }
        .detalle-info .descripcion {
            margin-bottom: 30px;
            line-height: 1.6;
        }
        .btn-volver {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #555;
        }
    </style>
</head>

<body>

<header>
    <div class="logo">
        Skincare Coreano
    </div>
    <nav>
        <a href="index.php">Inicio</a>
        <?php $cart_count = isset($_SESSION['carrito']) && is_array($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0; ?>
        <a href="carrito.php">Carrito (<span id="cart-count"><?php echo $cart_count; ?></span>)</a>

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

<section id="detalle-producto">
    <?php if (isset($error)): ?>
        
        <div style="text-align: center; padding: 100px;">
            <h2><?php echo $error; ?></h2>
            <a href="index.php" class="btn-volver">⬅ Volver a la tienda</a>
        </div>

    <?php else: ?>

        <div class="detalle-contenedor">
            <div class="detalle-imagen">
                <img src="img/<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>">
            </div>

            <div class="detalle-info">
                <h1><?php echo $producto['nombre']; ?></h1>
                <p class="precio">$<?php echo $producto['precio']; ?></p>
                
                <p class="descripcion">
                    <?php echo isset($producto['descripcion']) ? $producto['descripcion'] : 'Este increíble producto de skincare coreano te ayudará a lograr ese efecto "glass skin". Añádelo a tu rutina diaria para mejores resultados.'; ?>
                </p>

                <button class="btn-agregar" data-id="<?php echo $producto['id']; ?>">Agregar al carrito</button>
                <br>
                <a href="index.php" class="btn-volver">⬅ Volver a la tienda</a>
            </div>
        </div>

    <?php endif; ?>
</section>

<footer>
    <p>© 2026 Skincare Coreano Shop</p>
</footer>

<script>
document.addEventListener('click', function(e){
  if(e.target.matches('.btn-agregar')){
    var btn = e.target;
    var id = btn.getAttribute('data-id');
    btn.disabled = true;
    var original = btn.innerText;
    btn.innerText = 'Añadiendo...';
    fetch('agregar_carrito.php', {
      method: 'POST',
      headers: {'Content-Type':'application/x-www-form-urlencoded','X-Requested-With':'XMLHttpRequest','Accept':'application/json'},
      body: 'id=' + encodeURIComponent(id)
    }).then(function(res){ return res.json(); }).then(function(data){
      if(data.success){
        btn.innerText = 'Añadido';
        var countEl = document.getElementById('cart-count');
        if(countEl) countEl.innerText = data.count;
        setTimeout(function(){ btn.innerText = original; btn.disabled = false; }, 1200);
      } else {
        btn.innerText = 'Error';
        setTimeout(function(){ btn.innerText = original; btn.disabled = false; }, 1200);
      }
    }).catch(function(){
      btn.innerText = 'Error';
      setTimeout(function(){ btn.innerText = original; btn.disabled = false; }, 1200);
    });
  }
});
</script>

</body>
</html>