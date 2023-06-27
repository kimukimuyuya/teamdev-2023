<?php
session_start();

$id = $_POST['user_id'];

if(!empty($id)){
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
array_push($_SESSION['cart'], $id);
}

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();

$_SESSION['cart'] = $cart;
header('Location: index.php');
exit;
?>