<?php

use Skuth\PageAdmin;
use Skuth\Model\Panel;
use Skuth\Model\Order;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get("/admin/pedidos", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if (isset($_GET["pagina"])) {
    $pagina = trim(strip_tags(intval($_GET["pagina"])));
  } else {
    $pagina = 1;
  }

  if ($pagina == 0) {
    $pagina = 1;
  }

  
  $limit = 6;
  $offset = ($pagina - 1) * $limit;
  
  
  $orders = Order::getOrders("LIMIT ".$limit." OFFSET ".$offset);

  if (count($orders["orders"]) <= 0) {
    return $res->withHeader("Location", "/admin/pedidos?pagina=1");
  }
  
  $page = new PageAdmin(["data"=>["page"=>createPage("pedidos", "pedidos")]]);
  $page->setTpl("pedidos", ["pedidos"=>$orders["orders"], "count"=>$orders["count"], "pagina"=>$pagina, "limit"=>$limit, "url"=>"pedidos"]);

  return $res;

});

$app->get("/admin/pedidos/aberto", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if (isset($_GET["pagina"])) {
    $pagina = trim(strip_tags(intval($_GET["pagina"])));
  } else {
    $pagina = 1;
  }

  if ($pagina == 0) {
    $pagina = 1;
  }

  $limit = 6;
  $offset = ($pagina - 1) * $limit;

  
  $orders = Order::getOrders("WHERE order_status!=5 LIMIT ".$limit." OFFSET ".$offset);

  if (count($orders["orders"]) <= 0) {
    return $res->withHeader("Location", "/admin/pedidos/aberto?pagina=1");
  }

  $page = new PageAdmin(["data"=>["page"=>createPage("pedidos", "pedidos/aberto")]]);
  $page->setTpl("pedidos", ["pedidos"=>$orders["orders"], "count"=>$orders["count"], "pagina"=>$pagina, "limit"=>$limit, "url"=>"pedidos/aberto"]);

  return $res;

});

$app->get("/admin/pedido/atualizar/{id}", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  $id = $args["id"];

  $order = Order::getOrderById($id);
  
  $page = new PageAdmin(["data"=>["page"=>createPage("atualizando pedido #".$id, "pedido/atualizar/".$id)]]);
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

$app->get("/admin/pedido/visualizar/{id}", function(Request $req, Response $res, $args) {

  $id = $args["id"];
  
  $order = Order::getOrderByIdFull($id);

  
  $page = new PageAdmin(["data"=>["page"=>createPage("visualizando pedido #".$id, "pedido/visualizar/".$id)]]);
  $page->setTpl("pedidos-view", ["order"=>$order]);

  return $res;

});


?>