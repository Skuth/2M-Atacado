<?php

use Skuth\PageAdmin;
use Skuth\Model\Panel;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get("/admin/banners", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  var_dump("Banners");

  return $res;

});

?>