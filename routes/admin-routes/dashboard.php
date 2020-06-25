<?php

use Skuth\PageAdmin;
use Skuth\Model\Panel;
use Skuth\Model\Products;
use Skuth\Model\Order;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get("/admin/dashboard", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  $prods = new Products();

  $sum = $prods->getSum();

  $orderOpen = Order::countOpen();

  $orderCount = Order::countOrders();

  $produtos = $prods->getAll("ORDER BY product_views DESC LIMIT 6");

  $page = new PageAdmin(["data"=>["page"=>createPage("dashboard", "dashboard")]]);

  $page->setTpl("dashboard", ["produtos"=>$produtos, "sum"=>$sum, "oOpen"=>$orderOpen, "oCount"=>$orderCount]);

  return $res;

});

$app->get("/admin/notificacoes", function(Request $req, Response $res, $args) {

  if (isset($GLOBALS["lowStock"])) {
    $lowStock = $GLOBALS["lowStock"];

    $page = new PageAdmin(["data"=>["page"=>createPage("notificações", "notificacoes")]]);
    $page->setTpl("notificacoes", ["lowStock"=>$lowStock]);
  }

  return $res;

});

?>