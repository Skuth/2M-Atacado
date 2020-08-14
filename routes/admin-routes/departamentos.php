<?php

use Skuth\PageAdmin;
use Skuth\Model\Panel;
use Skuth\Model\Departments;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get("/admin/categorias", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  $dep = new Departments();
  $d = $dep->getAll();

  $page = new PageAdmin(["data"=>["page"=>createPage("categorias", "departamentos")]]);
  
  $page->setTpl("departments", ["departamentos"=>$d]);

  return $res;

});

$app->get("/admin/categoria/novo", function(Request $req, Response $res, $args) {

  $page = new PageAdmin(["data"=>["page"=>createPage("Cadastrar categoria", "departamento/novo")]]);

  $page->setTpl("dep-cad");

  return $res;

});

$app->post("/admin/categoria/novo", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  if (isset($_POST["save"])) {
    $icon = $_POST["icone"];
    $department = ucfirst($_POST["departamento"]);
    $href = $_POST["href"];

    $dep = new Departments();
    
    if ($dep->cadDep($icon, $department, $href) == true) {
      return $res->withHeader("Location", "/admin/categorias?cad=true");
    } else {
      return $res->withHeader("Location", "/admin/categorias?cad=false");
    }
  }

  return $res;

});

$app->get("/admin/categoria/editar/{id}", function (Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  $id = $args["id"];

  $dep = new Departments();

  $d = $dep->getById($id);

  $page = new PageAdmin(["data"=>["page"=>createPage("Editando categoria", "departamento/editar/".$id)]]);

  $page->setTpl("dep-edit", ["department"=>$d]);

  return $res;

});

$app->post("/admin/categoria/editar", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  if (isset($_POST["save"])) {
    $id = $_POST["id"];
    $icon = $_POST["icone"];
    $department = ucfirst($_POST["departamento"]);
    $href = $_POST["href"];

    $dep = new Departments();

    if ($dep->editDep($id, $icon, $department, $href) == true) {
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

  $dep = new Departments();

  if ($dep->removeDep($id) == true) {
    return $res->withHeader("Location", "/admin/categorias?remove=true");
  } else {
    return $res->withHeader("Location", "/admin/categorias?remove=false");
  }

  return $res;

});

?>