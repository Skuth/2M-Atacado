<?php

use Skuth\PageAdmin;
use Skuth\Model\Panel;
use Skuth\Model\Order;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get("/admin/pedidos", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if (isset($_GET["pagina"])) {
    $pagina = $_GET["pagina"];
  } else {
    $pagina = 1;
  }

  $limit = 6;
  $offset = ($pagina - 1) * $limit;

  
  $orders = Order::getOrders("LIMIT ".$limit." OFFSET ".$offset);

  $page = new PageAdmin(["data"=>["page"=>createPage("pedidos", "pedidos")]]);
  $page->setTpl("pedidos", ["pedidos"=>$orders["orders"], "count"=>$orders["count"], "pagina"=>$pagina, "limit"=>$limit, "url"=>"pedidos"]);

  return $res;

});

$app->get("/admin/pedidos/aberto", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if (isset($_GET["pagina"])) {
    $pagina = $_GET["pagina"];
  } else {
    $pagina = 1;
  }

  $limit = 6;
  $offset = ($pagina - 1) * $limit;

  
  $orders = Order::getOrders("WHERE order_status=1 LIMIT ".$limit." OFFSET ".$offset);

  $page = new PageAdmin(["data"=>["page"=>createPage("pedidos", "pedidos/aberto")]]);
  $page->setTpl("pedidos", ["pedidos"=>$orders["orders"], "count"=>$orders["count"], "pagina"=>$pagina, "limit"=>$limit, "url"=>"pedidos/aberto"]);

  return $res;

});

$app->get("/admin/pedido/editar/{id}", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  $id = $args["id"];

  $order = Order::getOrderById($id);
  
  $page = new PageAdmin(["data"=>["page"=>createPage("atualizar pedido", "pedido/editar/".$id)]]);
  $page->setTpl("pedido-att", ["order"=>$order]);

  return $res;

});

$app->post("/admin/pedido/atualizar", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if (isset($_POST["save"])) {
    $id = $_POST["id"];
    $status = $_POST["status"];
    $paymentStatus = $_POST["payment-status"];

    if (Order::updateOrder($id, $status, $paymentStatus) === TRUE) {
      return $res->withHeader("Location", "/admin/pedidos?update=true");
    } else {
      return $res->withHeader("Location", "/admin/pedidos?update=false");
    }
  }

  return $res;

});


?>