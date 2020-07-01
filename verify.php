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

function updateMonthVerify() {
  // atualizar json
  // last-month-verify: date
}

function updateDayVerify() {
  // atualizar json
  // last-day-verify: date
}

function verifyMonth() {
  // verificar se está no mesmo mês -> return (true, false)
  $r = true;

  if ($r == TRUE) {
    updateMonthVerify();
    return TRUE;
  } else {
    return FALSE;
  }
}

function verifyDay() {
  // verificar se está no mesmo dia -> return (true, false)
  $r = true;

  if ($r == TRUE) {
    updateDayVerify();
    return TRUE;
  } else {
    return FALSE;
  }
}

function updateProductViews() {
  // atualizar produtos
}

function updateOffers() {
  // verificar ofertas
}

function checkUpdates() {
  // Verificar datas comparando com JSON, se for TRUE chamar funções de update
  if (verifyDay() == TRUE) {
    updateOffers();
  }

  if (verifyMonth() == TRUE) {
    updateProductViews();
  }
}

?>