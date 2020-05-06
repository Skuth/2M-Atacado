<?php

use Skuth\Page;
use Skuth\Model\Departments;
use Skuth\Model\Sliders;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

function getDepartments() {
  $departments = new Departments();
  return $departments->getAll();
}

function getSiteUrl() {
  return $_SERVER["REQUEST_SCHEME"]."://".$_SERVER["HTTP_HOST"]."/";
}

$app->get("/", function(Request $req, Response $res, $args) {

  $page = new Page(["data"=>["navStyle"=>"banner"]]);

  $_SESSION["cart"] = [1];

  $departments = new Departments();
  $d = $departments->getAll();

  $slider = new Sliders();
  $s = $slider->getAll();

  $page->setTpl("home", ["departments"=>$d, "sliders"=>$s]);

  return $res;
  
});

$app->get("/produto/{name}", function(Request $req, Response $res, $args) {

  // produto/nome/id

  // Para editor

  // function parseStr($str) {

  //   $str = explode("#", $str);
  //   foreach ($str as $key => $value) {
  //     $str[$key] = explode("{", $str[$key]);
  //     $str[$key] = str_replace("}", "", $str[$key]);
  //   }

  //   $parses = [];

  //   foreach ($str as $key => $value) {
  //     if(count($str[$key]) > 1 && $str[$key][0] !== "script") {   
  //       if($str[$key][0] == "br") {
  //         $res = "<".$str[$key][0].">";
  //       } else {
  //         $res = "<".$str[$key][0].">".$str[$key][1]."</".$str[$key][0].">";
  //       }
  //       array_push($parses, $res);
  //     }
  //   }

  //   return $parses;
  // }

  $page = new Page();

  $page->setTpl("product");

  return $res;

});

$app->get("/produtos[/{param}]", function(Request $req, Response $res, $args) {

  // marca?=marca | categoria?=categoria

  $page = new Page();
  
  $page->setTpl("products");

  return $res;

});

$app->get("/sobre", function(Request $req, Response $res, $args) {

  $page = new Page();

  $page->setTpl("info");

  return $res;

});

?>