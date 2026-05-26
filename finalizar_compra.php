<?php
session_start();
include("conexion.php");

if(isset($_POST['finalizar'])){
    $usuario_id = 1;
    $total = 0;

    foreach($_SESSION['carrito'] as $id){
        $sql = "SELECT * FROM productos WHERE id=$id";
        $resultado = mysqli_query($conexion, $sql);
        $fila = mysqli_fetch_assoc($resultado);
        $total += $fila['precio'];
    }

    $sqlPedido = "INSERT INTO pedidos(usuario_id,total) VALUES('$usuario_id','$total')";
    mysqli_query($conexion, $sqlPedido);
    $pedido_id = mysqli_insert_id($conexion);

    foreach($_SESSION['carrito'] as $id){
        $sqlDetalle = "INSERT INTO detalle_pedido(pedido_id,producto_id,cantidad) VALUES('$pedido_id','$id',1)";
        mysqli_query($conexion, $sqlDetalle);
    }

    unset($_SESSION['carrito']);
    header("Location: confirmacion.php");
    exit;
}

$total = 0;
$productos_carrito = [];
if(isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])){
    foreach($_SESSION['carrito'] as $id){
        $sql = "SELECT * FROM productos WHERE id=$id";
        $resultado = mysqli_query($conexion, $sql);
        $fila = mysqli_fetch_assoc($resultado);
        if($fila){
            $productos_carrito[] = $fila;
            $total += $fila['precio'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Finalizar Compra | Skincare Coreano</title>
    <link rel="stylesheet" href="estilos.css?v=<?php echo time(); ?>"></head>
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
            echo '<a href="login.php">Login</a>';
        }
        ?>
    </nav>
</header>

<form method="POST">
<div class="checkout-container">

    <div class="checkout-izquierda">

        <div class="checkout-seccion">
            <h2>Finalizar Compra</h2>
        </div>

        <div class="checkout-seccion">
            <h3>Contacto</h3>
            <input type="email" name="correo" class="checkout-input" placeholder="Correo electrónico" required>
            <input type="tel" name="telefono" class="checkout-input" placeholder="Celular / WhatsApp">
        </div>

        <div class="checkout-seccion">
            <h3>Entrega</h3>
            <div class="checkout-fila">
                <input type="text" name="nombre" class="checkout-input" placeholder="Nombre" required>
                <input type="text" name="apellidos" class="checkout-input" placeholder="Apellidos" required>
            </div>
            <input type="text" name="calle" class="checkout-input" placeholder="Calle y Número Exterior e Interior" required>
            <input type="text" name="referencias" class="checkout-input" placeholder="Referencias (color de casa, entre calles...)">
            <input type="text" name="colonia" class="checkout-input" placeholder="Colonia - Coto - Fraccionamiento" required>
            <div class="checkout-fila">
                <input type="text" name="cp" class="checkout-input" placeholder="Código postal" required>
                <input type="text" name="ciudad" class="checkout-input" placeholder="Ciudad" required>
            </div>
            <input type="text" name="estado" class="checkout-input" placeholder="Estado" value="Querétaro">
        </div>

        <div class="checkout-seccion">
            <h3>Método de pago</h3>

            <div class="metodo-pago activo" onclick="seleccionarPago(this, 'tarjeta')">
                <input type="radio" name="metodo_pago" value="tarjeta" id="tarjeta" checked>
                <label for="tarjeta">Tarjeta de crédito / débito</label>
                <div class="metodo-iconos">
                    <span class="icono-pago">VISA</span>
                    <span class="icono-pago">MC</span>
                    <span class="icono-pago">AMEX</span>
                </div>
            </div>

            <div class="datos-tarjeta visible" id="datos-tarjeta">
                <input type="text" name="num_tarjeta" class="checkout-input" placeholder="Número de tarjeta" maxlength="19">
                <div class="checkout-fila">
                    <input type="text" name="vencimiento" class="checkout-input" placeholder="Fecha de vencimiento (MM/AA)" maxlength="5">
                    <input type="text" name="cvv" class="checkout-input" placeholder="CVV" maxlength="4">
                </div>
                <input type="text" name="titular" class="checkout-input" placeholder="Nombre del titular">
            </div>

            <div class="metodo-pago" onclick="seleccionarPago(this, 'paypal')">
                <input type="radio" name="metodo_pago" value="paypal" id="paypal">
                <label for="paypal">PayPal</label>
                <div class="metodo-iconos">
                    <span class="icono-pago" style="color:#003087;">PayPal</span>
                </div>
            </div>

            <div class="metodo-pago" onclick="seleccionarPago(this, 'mercadopago')">
                <input type="radio" name="metodo_pago" value="mercadopago" id="mercadopago">
                <label for="mercadopago">Mercado Pago</label>
                <div class="metodo-iconos">
                    <span class="icono-pago" style="color:#00b1ea;">MP</span>
                </div>
            </div>

            <div class="metodo-pago" onclick="seleccionarPago(this, 'spei')">
                <input type="radio" name="metodo_pago" value="spei" id="spei">
                <label for="spei">Transferencia Bancaria SPEI</label>
            </div>

        </div>

    </div>

    <div class="checkout-derecha">
        <h3 style="margin-bottom:20px;">Resumen del pedido</h3>

        <?php foreach($productos_carrito as $producto): ?>
        <div class="resumen-producto">
            <img src="img/<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>">
            <div class="resumen-producto-info">
                <p><?php echo $producto['nombre']; ?></p>
            </div>
            <span class="resumen-producto-precio">$<?php echo number_format($producto['precio'], 2); ?></span>
        </div>
        <?php endforeach; ?>

        <div class="resumen-total">
            <div class="resumen-fila">
                <span>Subtotal</span>
                <span>$<?php echo number_format($total, 2); ?></span>
            </div>
            <div class="resumen-fila">
                <span>Envío</span>
                <span style="color:#d48ca3;">Gratis</span>
            </div>
            <div class="resumen-fila total">
                <span>Total</span>
                <span>MXN $<?php echo number_format($total, 2); ?></span>
            </div>
        </div>

        <button type="submit" name="finalizar" class="btn-comprar">Finalizar Compra Segura</button>
    </div>

</div>
</form>

<footer>
    <p>© 2026 Skincare Coreano Shop</p>
</footer>

<script>
function seleccionarPago(elemento, metodo) {
    document.querySelectorAll('.metodo-pago').forEach(function(el){
        el.classList.remove('activo');
    });
    elemento.classList.add('activo');
    elemento.querySelector('input[type="radio"]').checked = true;

    var datosTarjeta = document.getElementById('datos-tarjeta');
    if(metodo === 'tarjeta'){
        datosTarjeta.classList.add('visible');
    } else {
        datosTarjeta.classList.remove('visible');
    }
}

document.querySelector('input[name="num_tarjeta"]').addEventListener('input', function(){
    var val = this.value.replace(/\D/g, '').substring(0, 16);
    this.value = val.replace(/(.{4})/g, '$1 ').trim();
});

document.querySelector('input[name="vencimiento"]').addEventListener('input', function(){
    var val = this.value.replace(/\D/g, '').substring(0, 4);
    if(val.length >= 2) val = val.substring(0,2) + '/' + val.substring(2);
    this.value = val;
});
</script>

</body>
</html>