<?php

use Skuth\Page;
use Skuth\Model\Clients;
use Skuth\Model\Order;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get("/cliente/login", function(Request $req, Response $res, $args) {

  if (Clients::verifyLogin()) return $res->withHeader("Location", "/cliente/dashboard");

  createSeoTags("Entrar");

  $page = new Page();
  $page->setTpl("login");

  return $res;

});

$app->post("/cliente/login", function(Request $req, Response $res, $args) {

  if (Clients::verifyLogin()) return $res->withHeader("Location", "/cliente/dashboard");

  if (isset($_POST["login"]) && isset($_POST["password"])) {
    $login = parseCpfCnpj(trim(strip_tags($_POST["login"])));
    $pass = trim(strip_tags($_POST["password"]));

    $client = new Clients();
    $l = $client->login($login, $pass);
    echo json_encode($l);
  }

  return $res;

});

$app->get("/cliente/cadastrar", function(Request $req, Response $res, $args) {

  if (Clients::verifyLogin()) return $res->withHeader("Location", "/cliente/dashboard");

  $chave = (isset($_GET["chave"])) ? $_GET["chave"] : "";

  createSeoTags("Cadastrar");

  $page = new Page();
  $page->setTpl("client-cad", ["chave"=>$chave]);

  return $res;

});

$app->post("/cliente/cadastrar", function(Request $req, Response $res, $args) {

  if (Clients::verifyLogin()) return $res->withHeader("Location", "/cliente/dashboard");
  
  $data = (isset($_POST["data"])) ? $_POST["data"] : "";
  $chave = (isset($data["chave"])) ? $data["chave"] : "";
  
  $clients = new Clients();
  $r = $clients->cadClient($chave, $data);
  
  echo json_encode($r);

  return $res;

});

$app->get("/cliente/logout", function(Request $req, Response $res, $args) {

  if (Clients::verifyLogin(0)) return $res->withHeader("Location", "/cliente/login");

  unset($_SESSION["client"]);
  return $res->withHeader("Location", "/");

});

$app->get("/cliente/dashboard", function(Request $req, Response $res, $args) {

  if (Clients::verifyLogin(0)) return $res->withHeader("Location", "/cliente/login");

  if (isset($_SESSION["client"]) && $_SESSION["client"] !== "") {
    $clientId = $_SESSION["client"]["client_id"];

    createSeoTags("Compras");

    $orders = Order::getByClientIdFull($clientId);

    $page = new Page();
    $page->setTpl("client-dash", ["orders"=>$orders]);
  }

  return $res;

});

$app->get("/cliente/compra/{id}", function(Request $req, Response $res, $args) {

  $id = $args["id"];

  $order = Order::getOrderByIdFull($id);

  createSeoTags("Detalhes da compra #".$id);

  $page = new Page();
  $page->setTpl("client-purchase-view", ["order"=>$order]);

  return $res;

});

?>