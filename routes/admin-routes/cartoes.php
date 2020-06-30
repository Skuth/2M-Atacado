<?php

use Skuth\PageAdmin;
use Skuth\Model\Panel;
use Skuth\Model\Cards;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get("/admin/cartoes", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  $cards = Cards::getCards();

  $page = new PageAdmin();
  $page->setTpl("cards", ["cards"=>$cards]);

  return $res;

});

$app->get("/admin/cartao/editar/{id}", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  $id = $args["id"];

  $cards = Cards::getCards();

  $page = new PageAdmin();
  $page->setTpl("card-edit", ["cards"=>$cards, "id"=>$id]);

  return $res;

});

$app->post("/admin/cartao/editar/{id}", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  $id = $args["id"];

  $card = Cards::getCardById($id);

  var_dump($card);

  if (isset($_POST["update"])) {

    $data = [];

    foreach ($_POST as $key => $value) {
      if ($key != "update") {
        $data[$key] = $value;
      }
    }

    $foto = $_FILES["foto"];
    $upFoto = $card["picture"];

    if ($foto["size"] != 0) {
      $upFoto = uploadImage($foto, "cards");
      $data["picture"] = $upFoto;
    } else {
      $data["picture"] = $card["picture"];
    }

    if (Cards::updateCard($id, $data) == true) {
      if ($card["picture"] != $upFoto) {
        deleteImage($card["picture"], "cards");
      }

      return $res->withHeader("Location", "/admin/cartoes?edit=true");
    } else {
      return $res->withHeader("Location", "/admin/cartoes?edit=false");
    }

  }

  return $res;

});



?>