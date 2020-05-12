<?php

use Skuth\PageAdmin;
use Skuth\Model\Painel;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

function getNav() {
  $navItems = [
    [
      "name"=>"dashboard",
      "href"=>"dashboard",
      "icon"=>"ni ni-tv-2",
      "color"=>"text-primary",
      "nivel"=>0
    ],
    [
      "name"=>"usuarios",
      "href"=>"usuarios",
      "icon"=> "fas fa-users",
      "color"=>"text-danger",
      "nivel"=>1
    ]
  ];

  return $navItems;
}

function createPage($p, $h) {
  $page = [
    "page"=>$p,
    "href"=>$h
  ];

  return $page;
}

function getUserSession() {
  if(isset($_SESSION["user"])) {
    $user = $_SESSION["user"];

    return $user;
  } else {
    return NULL;
  }
}

$app->get("/admin", function(Request $req, Response $res, $args) {

  return $res->withHeader("Location", "admin/dashboard");

});

$app->get("/admin/login", function(Request $req, Response $res, $args) {

  if (Painel::verifyUser() !== false ) return $res->withHeader("Location", "/admin/dashboard");

  $page = new PageAdmin(["nav"=>false]);

  $page->setTpl("login");

  return $res;

});

$app->post("/admin/login", function(Request $req, Response $res, $args) {

  if (Painel::verifyUser() !== false ) return $res->withHeader("Location", "/admin/login");

  $painel = new Painel(); 

  if(isset($_POST["user"]) && isset($_POST["pass"])) {
    $user = $_POST["user"];
    $pass = $_POST["pass"];

    if($painel->login($user, $pass)) {
      return $res->withHeader("Location", "/admin/dashboard");
    } else {
      return $res->withHeader("Location", "/admin/login?error=1");
    }

  }

  return $res;

});

$app->get("/admin/logout", function(Request $req, Response $res, $args) {

  if (Painel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  unset($_SESSION["user"]);

  return $res->withHeader("Location", "/admin/login");

});

$app->get("/admin/dashboard", function(Request $req, Response $res, $args) {

  if (Painel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  $page = new PageAdmin(["data"=>["page"=>createPage("dashboard", "dashboard")]]);

  $page->setTpl("dashboard");

  return $res;

});

$app->get("/admin/usuarios", function(Request $req, Response $res, $args) {

  if (Painel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  $page = new PageAdmin(["data"=>["page"=>createPage("usuarios", "usuarios")]]);

  $painel = new Painel();

  $users = $painel->listAll();

  $page->setTpl("users", ["users"=>$users]);

  return $res;

}); 

?>