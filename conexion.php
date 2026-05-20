<?php

$conexion = mysqli_connect(
    "localhost",
    "root",
    "",
    "skincare"
);

if(!$conexion){
    die("Error de conexión");
}

?>