<?php

use Skuth\Page;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get("/sobre[/{distribuidora}]", function(Request $req, Response $res, $args) {

  if(isset($args["distribuidora"])) {
    $dist = $args["distribuidora"];
    $r = $dist;
  } else {
    $r = "Sobre nós";
  }

  $page = new Page();

  $page->setTpl("info", ["content"=>$r]);

  return $res;

});

?>