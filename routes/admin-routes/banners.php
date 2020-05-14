<?php

use Skuth\PageAdmin;
use Skuth\Model\Panel;
use Skuth\Model\Sliders;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get("/admin/banners", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  $sliders = new Sliders();

  $s = $sliders->getAll();

  $page = new PageAdmin(["data"=>["page"=>createPage("banners", "banners")]]);

  $page->setTpl("banners", ["sliders"=>$s]);

  return $res;

});

?>