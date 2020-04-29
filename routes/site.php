<?php

use Skuth\Page;
use Skuth\Model\Departments;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get("/", function(Request $req, Response $res, $args) {

  $page = new Page(["data"=>["navStyle"=>"banner"]]);

  $_SESSION["cart"] = [1];

  $departments = new Departments();
  $d = $departments->getAll();

  $page->setTpl("home", ["departments"=>$d]);

  return $res;
  
});

?>