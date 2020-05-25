<?php

use Skuth\PageAdmin;
use Skuth\Model\Panel;
use Skuth\Model\Products;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get("/admin/promocoes", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  $prod = new Products();

  $p = $prod->getAll();

  $produtos = [];

  foreach ($p as $key => $value) {
    if ($value["product_price_off"] !== NULL || $value["product_price_off_days"] !== NULL || $value["product_stock_quantity_off"] !== NULL) {
      array_push($produtos, $value);
    }
  }

  $page = new PageAdmin(["data"=>["page"=>createPage("Promoções", "promocoes")]]);
  
  $page->setTpl("promocao", ["produtos"=>$produtos]);

  return $res;

});

$app->get("/admin/promocao/remover/{id}", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  $id = $args["id"];

  $prod = new Products();

  if ($prod->removePromo($id)) {
    return $res->withHeader("Location", "/admin/promocoes?remove=true");
  } else {
    return $res->withHeader("Location", "/admin/promocoes?remove=false");
  }

  return $res;

});

?>