<?php

use Skuth\PageAdmin;
use Skuth\Model\Panel;
use Skuth\Model\Category;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get("/admin/categorias", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  $cat = new Category();
  $c = $cat->getAll();

  $page = new PageAdmin(["data"=>["page"=>createPage("Categorias", "categorias")]]);
  
  $page->setTpl("categories", ["categorias"=>$c]);

  return $res;

});

$app->get("/admin/categoria/novo", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");
  
  $page = new PageAdmin(["data"=>["page"=>createPage("Cadastrar categorias", "categoria/novo")]]);

  $page->setTpl("cat-cad");

  return $res;

});

$app->post("/admin/categoria/novo", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  if (isset($_POST["save"])) {
    $categoria = $_POST["categoria"];

    $cat = new Category();
    
    if ($cat->cadCat($categoria) == true) {
      return $res->withHeader("Location", "/admin/categorias?cad=true");
    } else {
      return $res->withHeader("Location", "/admin/categorias?cad=false");
    }
  }

  return $res;

});

$app->get("/admin/categoria/editar/{id}", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  $id = $args["id"];

  $cat = new Category();

  $c = $cat->getById($id);
  
  $page = new PageAdmin(["data"=>["page"=>createPage("Editando categorias", "categoria/editar/".$id)]]);

  $page->setTpl("cat-edit", ["cat"=>$c]);

  return $res;

});

$app->post("/admin/categoria/editar", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  if (isset($_POST["save"])) {
    $id = $_POST["id"];
    $categoria = $_POST["categoria"];

    $cat = new Category();

    if ($cat->editCat($id, $categoria) == true) {
      return $res->withHeader("Location", "/admin/categorias?edit=true");
    } else {
      return $res->withHeader("Location", "/admin/categorias?edit=false");
    }
  }

  return $res;

});

$app->get("/admin/categoria/remover/{id}", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  $id = $args["id"];

  $cat = new Category();

  if ($cat->removeCat($id) == true) {
    return $res->withHeader("Location", "/admin/categorias?remove=true");
  } else {
    return $res->withHeader("Location", "/admin/categorias?remove=false");
  }

  return $res;

});

?>