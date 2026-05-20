<?php
include("conexion.php");

if(isset($_POST['registrar'])){

    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    $sql = "INSERT INTO usuarios(nombre,correo,password)
            VALUES('$nombre','$correo','$password')";

    mysqli_query($conexion,$sql);

    echo "Usuario registrado";
}
?>

<form method="POST">

<input type="text" name="nombre" placeholder="Nombre">
<input type="email" name="correo" placeholder="Correo">
<input type="password" name="password" placeholder="Contraseña">

<button name="registrar">Registrarse</button>

</form>