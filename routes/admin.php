<?php

use Skuth\PageAdmin;

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

$path = "/admin";

$app->get($path, function(Request $req, Response $res, $args) {

  return $res->withHeader("Location", "admin/dashboard");

});

$app->get($path."/login", function(Request $req, Response $res, $args) {

  $page = new PageAdmin(["nav"=>false]);

  $page->setTpl("login");

  return $res;

});

$app->get($path."/dashboard", function(Request $req, Response $res, $args) {

  $page = new PageAdmin(["data"=>["page"=>createPage("dashboard", "dashboard")]]);

  $page->setTpl("dashboard");

  return $res;

});

$app->get($path."/usuarios", function(Request $req, Response $res, $args) {

  $page = new PageAdmin(["data"=>["page"=>createPage("usuarios", "usuarios")]]);

  $page->setTpl("users");

  return $res;

}); 

?>