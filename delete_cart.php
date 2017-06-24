<?php 
session_start();
$id=trim($_GET['id']);
$cart = $_SESSION['cart'];
foreach($cart as $key => $val) {	
    if( $val->id == $id ) {
        unset($_SESSION['cart'][$key]);
        break;
    }
}
header('location:add_to_cart.php');
?>