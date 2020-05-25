<?php

use Skuth\PageAdmin;
use Skuth\Model\Panel;
use Skuth\Model\Products;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get("/admin/cupons", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 10) return $res->withHeader("Location", "/admin/dashboard");

  
  $page = new PageAdmin(["data"=>["page"=>createPage("Cupons", "cupons")]]);
  
  $page->setTpl("cupons", ["cupons"=>[1,1,1,1]]);
  
  return $res;
  
});

// Add cupons features

?>