<?php

use Skuth\PageAdmin;
use Skuth\Model\Panel;
use Skuth\Model\Products;
use Skuth\Model\Category;
use Skuth\Model\Distributors;
use Skuth\Model\Departments;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require_once($_SERVER["DOCUMENT_ROOT"]."/routes/functions.php");

$app->get("/admin/produtos", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");
  
  $prod = new Products();

  $produtos = $prod->getAll();

  $page = new PageAdmin(["data"=>["page"=>createPage("Produtos", "produtos")]]);
  
  $page->setTpl("produtos", ["produtos"=>$produtos]);

  return $res;

});

$app->get("/admin/produto/visualizar/{id}", function(Request $req, Response $res, $args) {

  $id = $args["id"];

  $prod = new Products();

  $produto = $prod->getById($id);

  var_dump($produto);

  return $res;

});

$app->get("/admin/produto/novo",function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  $page = new PageAdmin(["data"=>["page"=>createPage("Cadastrando produto", "produto/novo")]]);

  $page->setTpl("prod-cad");

  return $res;

});

$app->post("/admin/produto/novo",function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  if (isset($_POST["save"])) {
    var_dump($_POST);
  }

  return $res;

});

?>