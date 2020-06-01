<?php

use Skuth\Page;
use Skuth\Model\Products;
use Skuth\Model\Cart;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get("/carrinho", function(Request $req, Response $res, $args) {

  $page = new Page();

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

        $_SESSION["cart"] = $cart;
      }
    }
    return $cart;
  }

  $cart = (isset($_SESSION["cart"]) && count($_SESSION["cart"]) > 0) ? $_SESSION["cart"] : getCardFromCookie();

  $prod = new Products();

  $cartSet = [
    "products_id"=>[],
    "products_quantity"=>[],
    "products_price"=>[]
  ];
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

    if ($p["product_price_off"] != NULL) {
      $t += $p["product_price_off"];
    } else {
      $t += $p["product_price"];
    }

    $price = $p["product_price"];
    $priceOff = $p["product_price_off"];

    array_push($c, $p);
    array_push($cartSet["products_id"], $p["product_id"]);
    array_push($cartSet["products_quantity"], $p["quantity"]);
    array_push($cartSet["products_price"], (isset($priceOff)) ? $priceOff : $price);
  }

  foreach ($cartSet as $key => $value) {
    $cartSet[$key] = implode(",", $cartSet[$key]);
  }

  $cartSet["total"] = $t;

  function createCartCookie() {
    $id = md5($_COOKIE["PHPSESSID"].getDate()[0]);
    setcookie("cartId", $id, time()+2592000, "/");
    return $id;
  }

  $cartId = isset($_COOKIE["cartId"]) ? $_COOKIE["cartId"] : createCartCookie();

  $cartList = Cart::getCartItem($cartId);
  
  if (count($c) > 0) {
    if (count($cartList) > 0) {
      //update
      Cart::updateCartItem($cartId, $cartSet["products_id"], $cartSet["products_quantity"], $cartSet["products_price"], $cartSet["total"]);
    } else {
      //create
      Cart::createCartItem($cartId, $cartSet["products_id"], $cartSet["products_quantity"], $cartSet["products_price"], $cartSet["total"]);
    }
  } else {
    //remove
    Cart::removeCartItem($cartId);
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

$app->get("/checkout", function(Request $req, Response $res, $args) {

  // Check out
  //
  // Verificar login
  // Cadastrar user
  //
  // Puxar endereço do banco se existir
  // Pagina de cadastro de endereço
  // Opção pra mudar endereço
  //
  // Confirmar

  var_dump("Checkout page");
  return $res;

});

?>