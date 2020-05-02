<?php

use Skuth\Page;
use Skuth\Model\Departments;
use Skuth\Model\Slider;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get("/", function(Request $req, Response $res, $args) {

  $page = new Page(["data"=>["navStyle"=>"banner"]]);

  $_SESSION["cart"] = [1];

  $departments = new Departments();
  $d = $departments->getAll();

  $slider = new Slider();
  $s = $slider->getAll();

  $page->setTpl("home", ["departments"=>$d, "sliders"=>$s]);

  return $res;
  
});

$app->get("/sobre", function(Request $req, Response $res, $args) {

  $page = new Page();

  $page->setTpl("sobre");

  return $res;

});

?>