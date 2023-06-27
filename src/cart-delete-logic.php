<?php
session_start();
$id = $_GET['id'];

if(isset($_SESSION['cart']) && is_array($_SESSION['cart'])){
    if (($key = array_search($id, $_SESSION['cart'])) !== false) {
        unset($_SESSION['cart'][$key]);
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    } 
}

header('Location: cart.php');
exit;
?>