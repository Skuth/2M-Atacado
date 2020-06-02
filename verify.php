<?php

use Skuth\Model\Cart;

function getCardFromCookie() {
  $cart = [];
  if (isset($_COOKIE["cartId"])) {
    $cartId = $_COOKIE["cartId"];
    $cartItems = Cart::getCartItem($cartId);

    if (count($cartItems) > 0) {
      $cartProdIds = explode(",", $cartItems["products_id"]);
      $cartProdQ = explode(",", $cartItems["products_quantity"]);
      
      foreach ($cartProdIds as $key => $value) {
        $c = [
          "id"=>$value,
          "quantity"=>$cartProdQ[$key]
        ];

        array_push($cart, $c);
      }

      if (count($_SESSION["cart"]) <= 0 && count($cart) > 1) {
        $_SESSION["cart"] = $cart;
      }
    }
  }
  return $cart;
}

getCardFromCookie();

?>