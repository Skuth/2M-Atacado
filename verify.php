<?php

use Skuth\Model\Cart;
use Skuth\Model\Products;

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

function getJson() {
  $json = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/verify.json");
  $json = json_decode($json, true);
  return $json;
}

function saveJson($json) {
  file_put_contents($_SERVER["DOCUMENT_ROOT"]."/verify.json", json_encode($json));
}

function updateMonthVerify() {
  $month = date("m", strtotime("+1 month"));

  $json = getJson();
  $json["next-month-check"] = $month;

  saveJson($json);
}

function updateDayVerify() {
  $day = date("d", strtotime("+1 day"));
  $json = getJson();
  $json["next-day-check"] = $day;

  saveJson($json);
}

function verifyMonth() {
  $month = date("m");
  $json = getJson();
  $r = ($json["next-month-check"] == $month || $json["next-month-check"] < $month);

  if ($r == TRUE) {
    updateMonthVerify();
    return TRUE;
  } else {
    return FALSE;
  }
}

function verifyDay() {
  $day = date("d");
  $json = getJson();
  $r = ($json["next-day-check"] == $day || $json["next-day-check"] < $day);

  if ($r == TRUE) {
    updateDayVerify();
    return TRUE;
  } else {
    return FALSE;
  }
}

function updateProductViews() {
  Products::updateProductViews();
}

function updateOffers() {
  Products::updateOffers();
}

function checkUpdates() {
  if (verifyDay() == TRUE) {
    updateOffers();
  }

  if (verifyMonth() == TRUE) {
    updateProductViews();
  }
}

checkUpdates();

?>