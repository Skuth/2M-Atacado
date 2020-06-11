<?php

use Skuth\Page;
use Skuth\Model\Clients;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get("/cliente/login", function(Request $req, Response $res, $args) {

  if (isset($_SESSION["client"])) {
    return $res->withHeader("Location", "/");
  }

  $page = new Page();
  $page->setTpl("login");

  return $res;

});

$app->post("/cliente/login", function(Request $req, Response $res, $args) {

  if (isset($_POST["login"]) && isset($_POST["password"])) {
    $login = parseCpfCnpj(trim(strip_tags($_POST["login"])));
    $pass = trim(strip_tags($_POST["password"]));

    $client = new Clients();
    $l = $client->login($login, $pass);
    echo json_encode($l);
  }

  return $res;

});

$app->get("/cliente/logout", function(Request $req, Response $res, $args) {

  unset($_SESSION["client"]);
  return $res->withHeader("Location", "/");

});

?>