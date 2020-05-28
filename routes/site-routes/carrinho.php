<?php

use Skuth\Page;
use Skuth\Model\Products;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get("/carrinho", function(Request $req, Response $res, $args) {

  $page = new Page();

  $cart = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];

  $prod = new Products();

  $c = [];
  $q = 0;
  $t = 0;
  
  foreach ($cart as $key => $value) {
    $q += $value["quantity"];
    $p = $prod->getById($value["id"]);

    if ($p["product_stock"] < $value["quantity"]) {
      $value["quantity"] = $p["product_stock"];
    }

    if ($p["product_stock_quantity_off"] != NULL && $p["product_stock_quantity_off"] < $value["quantity"]) {
      $value["quantity"] = $p["product_stock_quantity_off"];
    }


    $p["quantity"] = $value["quantity"];
    $price = floatval($p["product_price"]);
    $p["product_price"] = ($price * intval($value["quantity"]));

    if ($p["product_price_off"] != NULL) {
      $priceOff = floatval($p["product_price_off"]);
      $p["product_price_off"] = ($priceOff * intval($value["quantity"]));
    }
    
    for ($i=0; $i < $value["quantity"]; $i++) { 
      if ($p["product_price_off"] != NULL) {
        $t += $p["product_price_off"];
      } else {
        $t += $p["product_price"];
      }
    }

    array_push($c, $p);
  }

  $page->setTpl("cart", ["cart"=>$c, "quantity"=>$q, "total"=>$t]);

  return $res;

});

$app->POST("/addcart/{action}", function(Request $req, Response $res, $args) {

  function cartUpdate($data) {
    return $_SESSION["cart"] = $data;
  }

  $action = $args["action"];

  if ($action == "add" || $action == "remove") {
    if ($action == "add") {
      $addData = (isset($_POST["data"])) ? $_POST["data"] : "";

      if (isset($_SESSION["cart"]) && count($_SESSION["cart"]) > 0) {
        $cart = $_SESSION["cart"];

        foreach ($cart as $key => $value) {
          if (isset($value["id"]) && $value["id"] == $addData["id"]) {
            $cart[$key]["quantity"] = $value["quantity"] + $addData["quantity"];
          break;
          } else {
            if ($key == count($cart) - 1) {
              array_push($cart, $addData);
            }
          }
        }

        if (count($addData) > 0) {
          cartUpdate($cart);
        }
      } else {
        cartUpdate([$addData]);
      }
    } else if (isset($_SESSION["cart"]) && $action == "remove") {
      $removeId = isset($_POST["id"]) ? $_POST["id"] : 0;

      $cart = $_SESSION["cart"];

      foreach ($cart as $key => $value) {
        if ($value["id"] == $removeId) {
          unset($cart[$key]);
        }
      }

      $cart = (count($cart) > 0) ? $cart : [];
      cartUpdate($cart);
    }
  }

  return $res;

});

?>