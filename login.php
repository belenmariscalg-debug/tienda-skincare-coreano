<?php
session_start();
include("conexion.php");

$mensaje = "";

if(isset($_POST['login'])){
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE correo='$correo' AND password='$password'";
    $resultado = mysqli_query($conexion,$sql);

    if(mysqli_num_rows($resultado) > 0){
        $_SESSION['usuario'] = $correo;
        header("Location: index.php");
    }else{
        $mensaje = "<p style='color:red; margin-bottom:15px;'>Datos incorrectos</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login | Skincare Coreano</title>
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
        <h2>Iniciar Sesión</h2>
        <?php echo $mensaje; ?>
        <input type="email" name="correo" placeholder="Tu Correo Electrónico" required>
        <input type="password" name="password" placeholder="Tu Contraseña" required>
        <button name="login">Entrar</button>
    </form>
</div>

<footer>
    <p>© 2026 Skincare Coreano Shop</p>
</footer>

</body>
</html>