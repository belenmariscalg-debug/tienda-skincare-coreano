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

            <button class="btn-agregar" data-id="<?php echo $fila['id']; ?>">Agregar al carrito</button>

        </div>

    <?php } ?>

    </div>

</section>

<!-- FOOTER -->

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