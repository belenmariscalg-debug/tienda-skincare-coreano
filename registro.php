<?php
include("conexion.php");
$mensaje = "";

if(isset($_POST['registrar'])){
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    $sql = "INSERT INTO usuarios(nombre,correo,password) VALUES('$nombre','$correo','$password')";
    
    if(mysqli_query($conexion,$sql)){
        $mensaje = "<p style='color:green; margin-bottom:15px;'>¡Usuario registrado con éxito! <a href='login.php'>Inicia sesión aquí</a></p>";
    } else {
        $mensaje = "<p style='color:red; margin-bottom:15px;'>Error al registrar</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro | Skincare Coreano</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<header>
    <div class="logo">Skincare Coreano</div>
    <nav>
        <a href="index.php">Inicio</a>
        <a href="carrito.php">Carrito</a>
        <a href="login.php">Login</a>
        <a href="registro.php">Registro</a>
    </nav>
</header>

<div class="contenedor-formulario">
    <form class="formulario" method="POST">
        <h2>Crear Cuenta</h2>
        <?php echo $mensaje; ?>
        <input type="text" name="nombre" placeholder="Nombre completo" required>
        <input type="email" name="correo" placeholder="Correo electrónico" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button name="registrar">Registrarse</button>
    </form>
</div>

<footer>
    <p>© 2026 Skincare Coreano Shop</p>
</footer>

</body>
</html>