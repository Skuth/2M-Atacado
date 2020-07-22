<?php

use Skuth\Page;
use Skuth\Model\Products;
use Skuth\Model\Cart;
use Skuth\Model\Clients;
use Skuth\Model\Order;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get("/carrinho", function(Request $req, Response $res, $args) {

  createSeoTags("Carrinho de compras");

  function createCartCookie() {
    $id = md5($_COOKIE["PHPSESSID"].getDate()[0]);
    setcookie("cartId", $id, time()+2592000, "/");
    return $id;
  }

  $cart = (isset($_SESSION["cart"]) && count($_SESSION["cart"]) > 0) ? $_SESSION["cart"] : [];

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
    $p = $prod->getById($value["id"]);
    
    if ($p["product_stock"] < $value["quantity"]) {
      $value["quantity"] = $p["product_stock"];
    }
    
    if ($p["product_stock_quantity_off"] != NULL && $p["product_stock_quantity_off"] < $value["quantity"]) {
      $value["quantity"] = $p["product_stock_quantity_off"];
    }

    $q += $value["quantity"];

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

    if ($value["quantity"] > 0) {
      array_push($c, $p);
    array_push($cartSet["products_id"], $p["product_id"]);
    array_push($cartSet["products_quantity"], $p["quantity"]);
    array_push($cartSet["products_price"], (isset($priceOff)) ? $priceOff : $price);
    }
  }

  foreach ($cartSet as $key => $value) {
    $cartSet[$key] = implode(",", $cartSet[$key]);
  }

  $cartSet["total"] = $t;

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

  $page = new Page();

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

  if (isset($_SESSION["client"])) { // remover !

    $cartId = $_COOKIE["cartId"];
    $cart = Cart::getCartItem($cartId);

    if (count($cart) > 0) {
      createSeoTags("Finalizar compra");

      $page = new Page();

      $clients = new Clients();

      if (isset($_GET["address"])) {
        $address = $clients->getAddress();
      } else {
        $address = [];
      }
      
      if (isset($_GET["payment"])) {
        $payment = $_GET["payment"];
        if ($payment > 1) {
          $payment = 0;
        }
      } else {
        $payment = 0;
      }
      
      $shipmentPrice = getShipmentPrice($address);
      $cart["shipmentPrice"] = $shipmentPrice;
      $cart["cart_total_shipment"] = floatval($cart["cart_total"]) + floatval($shipmentPrice);
      $cart["products_total"] = count(explode(",", $cart["products_quantity"]));

      $products = [];

      $prods = explode(",", $cart["products_id"]);
      $prodsQ = explode(",", $cart["products_quantity"]);

      $p = new Products();

      foreach ($prods as $key => $value) {
        $r = $p->getByIdFull($value);
        $r["quantity"] = $prodsQ[$key];
        if (count($r) > 0) {
          array_push($products, $r);
        }
      }
      
      $page->setTpl("checkout", ["products"=>$products, "cart"=>$cart, "shipmentPrice"=>$cart["shipmentPrice"], "address"=>$address, "payment"=>$payment]);
    } else {
      unset($_SESSION["cart"]);
      return $res->withHeader("Location", "/carrinho");
    }

  } else {

    $cart = [];

    if (isset($_COOKIE["cartId"])) {
      $cartId = $_COOKIE["cartId"];
      $cart = Cart::getCartItem($cartId);
    }

    if (count($cart) > 0) {
      createSeoTags("Faça login para continuar");

      $page = new Page();
      $page->setTpl("login", ["cart"=>true]);
    } else {
      unset($_SESSION["cart"]);
      return $res->withHeader("Location", "/carrinho");
    }

  }
  
  return $res;

});

$app->post("/checkout/order", function(Request $req, Response $res, $args) {

  function parseResponse($status, $message) {
    $r = [
      "status"=>$status,
      "message"=>$message
    ];

    return json_encode($r);
  }

  $addressId = (isset($_POST["addressId"])) ? $_POST["addressId"] : 0;
  $cartId = (isset($_COOKIE["cartId"])) ? $_COOKIE["cartId"] : 0;
  $client = (isset($_SESSION["client"])) ? $_SESSION["client"] : NULL;
  $pType = (isset($_POST["pType"])) ? $_POST["pType"] : 0;
  $pickUpDate = (isset($_POST["pickUpDate"])) ? $_POST["pickUpDate"] : "";

  if ($pType > 1) { $pType = 0; }

  if ($client !== NULL) {
    if ($cartId !== 0) {

      $cart = Cart::getCartItem($cartId);
  
      if (count($cart) > 0) {
        $clientId = $client["client_id"];

        $order = Order::createOrder($clientId, $cart, $addressId, $pType, $pickUpDate);
        
        $buyValue = $cart["cart_total"];
        $points = ($buyValue >= 100) ? (floor(intval($buyValue) / 99)) : 0;
        
        if ($order === TRUE) {
          echo parseResponse("success", "Compra efetuada com sucesso!");
          Clients::addPoints($clientId, $points);
          Cart::removeCartItem($cartId);
          unset($_SESSION["cart"]);
        } else {
          echo parseResponse("error", "Falha ao comprar, tente mais tarde ou contate o suporte!");
        }
      } else {
        echo parseResponse("error", "Você não tem nada no carrinho!");
      }
      
    } else {
      echo parseResponse("error", "Você não tem nada no carrinho!");
    }
  } else {
    echo parseResponse("error", "Você precisa estar logado para efetuar uma compra!");
  }

  return $res;

});

?>