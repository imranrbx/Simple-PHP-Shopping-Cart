<?php 
require "vendor/autoload.php";
require('db.php');
use voku\Cart\Cart;
use voku\Cart\Storage\Session;
use voku\Cart\Identifier\Cookie;
$cart = new Cart(new Session, new Cookie);
foreach ($cart->contents() as $item) {
  if($item->id == $_GET['id']){
  	$item->remove();
  }
}
header('location:add_to_cart.php');
?>