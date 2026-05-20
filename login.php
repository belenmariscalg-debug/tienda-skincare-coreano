<?php
session_start();
include("conexion.php");

if(isset($_POST['login'])){

    $correo = $_POST['correo'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios
            WHERE correo='$correo'
            AND password='$password'";

    $resultado = mysqli_query($conexion,$sql);

    if(mysqli_num_rows($resultado) > 0){

        $_SESSION['usuario'] = $correo;

        header("Location: index.php");

    }else{
        echo "Datos incorrectos";
    }
}
?>

<form method="POST">

<input type="email" name="correo">
<input type="password" name="password">

<button name="login">Entrar</button>

</form>