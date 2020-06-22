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

  $produtos = $prods->getAll("ORDER BY product_views DESC LIMIT 5");

  $page = new PageAdmin(["data"=>["page"=>createPage("dashboard", "dashboard")]]);

  $page->setTpl("dashboard", ["produtos"=>$produtos, "sum"=>$sum, "oOpen"=>$orderOpen]);

  return $res;

});

?>