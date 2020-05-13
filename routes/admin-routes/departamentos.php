<?php

use Skuth\PageAdmin;
use Skuth\Model\Panel;
use Skuth\Model\Departments;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get("/admin/departamentos", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  $dep = new Departments();
  $d = $dep->getAll();

  $page = new PageAdmin(["data"=>["page"=>createPage("departamentos", "departamentos")]]);
  
  $page->setTpl("departments", ["departamentos"=>$d]);

  return $res;

});

$app->get("/admin/departamento/novo", function(Request $req, Response $res, $args) {

  $page = new PageAdmin(["data"=>["page"=>createPage("Cadastrar departamentos", "departamentos/novo")]]);

  $page->setTpl("dep-cad");

  return $res;

});

?>