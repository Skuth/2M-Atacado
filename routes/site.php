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

$app->get("/[inicio]", function(Request $req, Response $res, $args) {

  $page = new Page(["data"=>["navStyle"=>"banner"]]);

  $_SESSION["cart"] = [];

  $departments = new Departments();
  $d = $departments->getAll();

  $slider = new Sliders();
  $s = $slider->getAll();

  $page->setTpl("home", ["departments"=>$d, "sliders"=>$s]);

  return $res;
  
});

$app->get("/produto/{nome}/{id}", function(Request $req, Response $res, $args) {

  // produto/nome/id

  $page = new Page();

  $page->setTpl("product");

  return $res;

});

$app->get("/produtos[/{filtro}]", function(Request $req, Response $res, $args) {

  // marca?=marca | categoria?=categoria

  if(isset($args["filtro"])) {
    $param = $args["filtro"];
    
    if($param === "marca" || $param === "categoria" || $param === "ofertas" || $param === "departamento") {
      switch ($param) {
        case 'marca':
          $marca = isset($_GET["nome"]) ? $_GET["nome"] : NULL;

          // listar na marca
          break;
        case 'categoria':
          $categoria = isset($_GET["nome"]) ? $_GET["nome"] : NULL;

          // listar na categoria
          break;
        case 'departamento':
          $departamento = isset($_GET["nome"]) ? $_GET["nome"] : NULL;
  
          // listar na departamento
          break;
        case 'ofertas':
          // listar ofertas
          break;
      }
    } else {
      return $res->withHeader("Location", "/produtos");
    }
  }

  $page = new Page();
  
  $page->setTpl("products");

  return $res;

});

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

$app->get("/carrinho", function(Request $req, Response $res, $args) {

  $page = new Page();

  $page->setTpl("cart");

  return $res;

});

?>