<?php
session_start();

// Soporta POST (AJAX) o GET (fallback)
$id = null;
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['id']) && is_numeric($_POST['id'])){
        $id = (int)$_POST['id'];
    }
} else {
    if(isset($_GET['id']) && is_numeric($_GET['id'])){
        $id = (int)$_GET['id'];
    }
}

$response = ['success' => false, 'count' => 0];

if($id !== null){
    if(!isset($_SESSION['carrito']) || !is_array($_SESSION['carrito'])){
        $_SESSION['carrito'] = array();
    }

    $_SESSION['carrito'][] = $id;
    $response['success'] = true;
    $response['count'] = count($_SESSION['carrito']);
}

// Detectar petición AJAX / JSON
$isAjax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') || (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false);

if($isAjax){
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
} else {
    // Fallback: redirigir a la página anterior o a index
    $redirect = isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php';
    header("Location: $redirect");
    exit;
}

?>

