<?php
session_start();

session_destroy();

header("Location: login.php");
<div class="logout">

    <a href="logout.php">Cerrar sesión</a>

</div>
?>