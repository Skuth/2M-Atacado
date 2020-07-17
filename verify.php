<?php

use Skuth\Model\Cart;
use Skuth\Model\Products;

// $prods = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/precos-att-att.json");
// $prods = json_decode($prods);

// $p = new Products();
// $json = [];

// foreach ($prods as $key => $value) {
//   $ref = $value->Ref;

//   $r = $p->getByRefFull($ref);
//   if(count($r) > 0) {

//     // if (strcmp($r["product_name"], $value->Produto) >= -3) {
//     //   // var_dump(TRUE);
//     //   // $p->updatePrice($r["product_ref"], $value->Preco);

//     //   // var_dump($value->Ref);
//     //   // var_dump($value->Produto);
//     //   // var_dump($value->Preco);

//     // } else {
//     //   var_dump(FALSE);
//     // }
//   } else {
//     $j = [
//       "Ref"=>$value->Ref,
//       "Produto"=>$value->Produto,
//       "Preco"=>$value->Preco
//     ];

//     array_push($json, $j);

//     // $s = $p->getBySearch($value->Produto);
//     // if (count($s[0]) > 0) {
//     //   $s = $s[0][0];
//     //   var_dump($s["product_ref"]);
//     //   var_dump($s["product_name"]);
//     //   var_dump($s["product_price"]);
//     //   $pic = implode(",", $s["product_pictures"]);
//     //   // $a = $p->editProd($s["product_id"], $s["product_name"], $s["brand_id"], $value->Ref, $s["department_id"], $s["product_description"], $pic, $value->Preco, 0);
//     //   // var_dump($a);
//     // }
//     // echo "-----------------------------------------------------";
//   }
// }

// file_put_contents($_SERVER["DOCUMENT_ROOT"]."/cad.json", json_encode($json));

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