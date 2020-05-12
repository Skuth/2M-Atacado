<?php

use Skuth\PageAdmin;
use Skuth\Model\Panel;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get("/admin/dashboard", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  $page = new PageAdmin(["data"=>["page"=>createPage("dashboard", "dashboard")]]);

  $page->setTpl("dashboard");

  return $res;

});

?>