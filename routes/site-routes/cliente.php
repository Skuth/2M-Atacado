<?php

use Skuth\Page;
use Skuth\Model\Clients;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->post("/cliente/login", function(Request $req, Response $res, $args) {

  if (isset($_POST["submit"])) {
    var_dump($_POST);
    $login = parseCpfCnpj(trim(strip_tags($_POST["login"])));
    $pass = trim(strip_tags($_POST["password"]));

    var_dump($login);
    var_dump($pass);

    $client = new Clients();
    $client->login($login, $pass);
  }

  return $res;

});

?>