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

  if ($_SESSION["user"]["id"] != $id) return $res->withHeader("Location", "/admin/perfil/".$_SESSION["user"]["id"]);

  $panel = new Panel();

  $user = $panel->getUserById($id);

  $page = new PageAdmin();

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

  return $res;

});

$app->get("/admin/usuarios/editar/{id}", function(Request $req, Response $res, $args) {

  $id = $args["id"];

  return $res;

});

$app->put("/admin/usuarios/editar/{id}", function(Request $req, Response $res, $args) {

  $id = $args["id"];

  echo json_encode("Editar usuario de id ".$id);

  return $res;

});

$app->delete("/admin/usuarios/remover/{id}", function(Request $req, Response $res, $args) {

  $id = $args["id"];

  echo json_encode("Remover usuario de id ".$id);

  return $res;

});


?>