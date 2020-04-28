<?php

use Skuth\Page;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get("/", function(Request $req, Response $res, $args) {

  $page = new Page(["data"=>["navStyle"=>"banner"]]);

  $page->setTpl("home");

  return $res;
  
});

?>