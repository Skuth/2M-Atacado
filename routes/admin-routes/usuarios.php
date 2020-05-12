<?php

use Skuth\PageAdmin;
use Skuth\Model\Panel;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get("/admin/login", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== false ) return $res->withHeader("Location", "/admin/dashboard");

  $page = new PageAdmin(["nav"=>false]);

  $page->setTpl("login");

  return $res;

});

$app->post("/admin/login", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== false ) return $res->withHeader("Location", "/admin/login");

  $panel = new Panel(); 

  if(isset($_POST["user"]) && isset($_POST["pass"])) {
    $user = $_POST["user"];
    $pass = $_POST["pass"];

    if($panel->login($user, $pass)) {
      return $res->withHeader("Location", "/admin/dashboard");
    } else {
      return $res->withHeader("Location", "/admin/login?error=1");
    }

  }

  return $res;

});

$app->get("/admin/logout", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  unset($_SESSION["user"]);

  return $res->withHeader("Location", "/admin/login");

});

$app->get("/admin/perfil/{id}", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true) return $res->withHeader("Location", "/admin/login");

  $id = $args["id"];

  if ($_SESSION["user"]["id"] != $id && $_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/perfil/".$_SESSION["user"]["id"]);

  if ($id == 100 && $_SESSION["user"]["type"] < 3) return $res->withHeader("Location", "/admin/perfil/".$_SESSION["user"]["id"]);

  $panel = new Panel();

  $user = $panel->getUserById($id);

  if (count($user) <= 0) return $res->withHeader("Location", "/admin/perfil/".$_SESSION["user"]["id"]);

  $page = new PageAdmin(["data"=>["page"=>createPage("meu perfil", "perfil/".$id)]]);

  $page->setTpl("profile", ["user"=>$user]);

  return $res;

});

$app->get("/admin/usuarios", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true) return $res->withHeader("Location", "/admin/login");

  $nav = getNav();

  if ($nav[1]["nivel"] > $_SESSION["user"]["type"]) return $res->withHeader("Location", "/admin/dashboard");

  $panel = new Panel();

  $users = $panel->listAll();

  $page = new PageAdmin(["data"=>["page"=>createPage("usuários", "usuarios")]]);

  $page->setTpl("users", ["users"=>$users]);

  return $res;

});

$app->get("/admin/usuarios/novo", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true) return $res->withHeader("Location", "/admin/login");

  return $res;

});

$app->get("/admin/usuarios/editar/{id}", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true) return $res->withHeader("Location", "/admin/login");

  $id = $args["id"];

  if ($_SESSION["user"]["id"] != $id && $_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/usuarios/editar/".$_SESSION["user"]["id"]);

  if ($id == 100 && $_SESSION["user"]["type"] < 3) return $res->withHeader("Location", "/admin/usuarios/editar/".$_SESSION["user"]["id"]);

  $panel = new Panel();

  $user = $panel->getUserById($id);

  if (count($user) <= 0) return $res->withHeader("Location", "/admin/usuarios/editar/".$_SESSION["user"]["id"]);

  $page = new PageAdmin(["data"=>["page"=>createPage("editando usuário de id ".$id, "usuarios/editar/".$id)]]);

  $page->setTpl("user-edit", ["user"=>$user]);

  return $res;

});

$app->POST("/admin/usuarios/editar", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true) return $res->withHeader("Location", "/admin/login");

  var_dump($_POST);

  if (isset($_POST["update"])) {
    $id = $_POST["id"];
    $fname = $_POST["nome"];
    $lname = $_POST["sobrenome"];
    $user = $_POST["usuario"];
    $pass = ($_POST["senha"] == "password") ? NULL : $_POST["senha"];
    $type = $_POST["cargo"];

    $panel = new Panel();

    $r = $panel->editUser($id, $fname, $lname, $user, $pass, $type);

    if ($r == true) {
      return $res->withHeader("Location", "/admin/perfil/".$id."?msg=success");
    } else {
      return $res->withHeader("Location", "/admin/perfil/".$id."?msg=error");
    }
  }

  return $res;

});

$app->delete("/admin/usuarios/remover", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true) return $res->withHeader("Location", "/admin/login");

  $id = $args["id"];

  echo json_encode("Remover usuario de id ".$id);

  return $res;

});


?>