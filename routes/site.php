<?php

use Skuth\Page;
use Skuth\Model\Departments;
use Skuth\Model\Distributors;
use Skuth\Model\Sliders;
use Skuth\Model\Products;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require_once("functions.php");
require_once("admin-functions.php");

$app->get("/[inicio]", function(Request $req, Response $res, $args) {

  $page = new Page(["data"=>["navStyle"=>"banner"]]);

  $_SESSION["cart"] = [];

  $departments = new Departments();
  $d = $departments->getAll();

  $slider = new Sliders();
  $s = $slider->getAll();

  $prod = new Products();
  $pr = $prod->getAllFull("ORDER BY RAND() LIMIT 4");
  $pv = $prod->getAllFull("ORDER BY product_views DESC LIMIT 4");
  // $po = $prod->getAllFull("ORDER BY product_price_off DESC LIMIT 4");
  var_dump($po);

  $page->setTpl("home", ["departments"=>$d, "sliders"=>$s, "prodRandom"=>$pr, "prodViews"=>$pv]);

  return $res;
  
});

$app->get("/produto/{id}/{ref}/{nome}", function(Request $req, Response $res, $args) {
  
  $id = $args["id"];

  $prod = new Products();
  $p = $prod->getByIdFull($id);
  $pr = $prod->getAllFull("ORDER BY RAND() LIMIT 4");

  $page = new Page();

  $page->setTpl("product", ["produto"=>$p, "produtosRandom"=>$pr]);

  return $res;

});

$app->get("/produtos[/{filtro}[/{param}]]", function(Request $req, Response $res, $args) {

  // marca?=marca | categoria?=categoria
  
  $prod = new products();

  if(isset($args["filtro"])) {
    $filtro = $args["filtro"];
    
    if($filtro === "distribuidor" || $filtro === "categoria" || $filtro === "ofertas" || $filtro === "departamento") {
      switch ($filtro) {
        case 'distribuidor':
          $distribuidor = isset($args["param"]) ? $args["param"] : NULL;
          if ($distribuidor == NULL) return $res->withHeader("Location", "/produtos");
          // listar na categoria
          $p = $prod->getAllFull();
          break;
        case 'categoria':
          $categoria = isset($args["param"]) ? $args["param"] : NULL;
          if ($categoria == NULL) return $res->withHeader("Location", "/produtos");
          // listar na categoria
          $p = $prod->getAllFull();
          break;
        case 'departamento':
          $departamento = isset($args["param"]) ? $args["param"] : NULL;
          if ($departamento == NULL) return $res->withHeader("Location", "/produtos");
          // listar na departamento
          $p = $prod->getAllFull();
          break;
        case 'ofertas':
          // listar ofertas
          $p = $prod->getAllFull();
          break;
      }
    } else {
      return $res->withHeader("Location", "/produtos");
    }
  } else {
    $p = $prod->getAllFull();
  }

  $dep = new Departments();
  $d = $dep->getAll();

  $dist = new Distributors();
  $dis = $dist->getAll();

  foreach ($d as $k => $v) {
    $d[$k]["products_count"] = 0;
  }

  foreach ($dis as $k => $v) {
    $dis[$k]["products_count"] = 0;
  }

  foreach ($prod->getAll() as $key => $value) {
    foreach ($d as $k => $v) {
      if ($value["department_id"] == $v["department_id"]) $d[$k]["products_count"] += 1;
    }
    foreach ($dis as $k => $v) {
      if ($value["brand_id"] == $v["distributor_id"]) $dis[$k]["products_count"] += 1;
    }
  }

  $page = new Page();
  
  $page->setTpl("products", ["produtos"=>$p, "departamentos"=>$d, "distribuidores"=>$dis]);

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