<?php

use Skuth\Page;
use Skuth\Model\Departments;
use Skuth\Model\Distributors;
use Skuth\Model\Products;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

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
  $p = $prod->getAllFull("ORDER BY product_id DESC");
  $fText = "Todos produtos";

  if(isset($args["filtro"])) {
    $filtro = $args["filtro"];
    
    if($filtro === "distribuidor" || $filtro === "ofertas" || $filtro === "departamento") {
      switch ($filtro) {

        case 'distribuidor':
          $distribuidor = isset($args["param"]) ? $args["param"] : NULL;
          if ($distribuidor == NULL) return $res->withHeader("Location", "/produtos");
          
          $dist = $args["param"];
          foreach ($p as $key => $value) {
            if ($value["distributor_href"] != $dist) {
              unset($p[$key]);
            }
          }

          $fText = "Produtos do distribuidor - ".ucfirst($dist);
          
          break;

        case 'departamento':
          $departamento = isset($args["param"]) ? $args["param"] : NULL;
          if ($departamento == NULL) return $res->withHeader("Location", "/produtos");

          $dep = $args["param"];
          foreach ($p as $key => $value) {
            if ($value["department_href"] != $dep) {
              unset($p[$key]);
            }
          }

          $fText = "Produtos do departamento - ".ucfirst($dep);

          break;

        case 'ofertas':
          // listar ofertas
          foreach ($p as $key => $value) {
            if ($value["product_price_off"] == NULL) {
              unset($p[$key]);
            }
          }

          $fText = "Ofertas";
          break;

      }
    } else {
      return $res->withHeader("Location", "/produtos");
    }
  }

  if (count($p) <= 0 && isset($args["filtro"])) return $res->withHeader("Location", "/produtos");

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
  
  $page->setTpl("products", ["produtos"=>$p, "departamentos"=>$d, "distribuidores"=>$dis, "filterText"=>$fText]);

  return $res;

});

?>