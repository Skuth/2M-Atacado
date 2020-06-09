<?php

use Skuth\Page;
use Skuth\Model\Departments;
use Skuth\Model\Distributors;
use Skuth\Model\Products;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get("/produto/{ref}/{nome}", function(Request $req, Response $res, $args) {
  
  $ref = $args["ref"];

  $prod = new Products();
  $p = $prod->getByRefFull($ref);
  $pr = $prod->getAllFull("ORDER BY RAND() LIMIT 4");

  $desc = seoDescFilter($p["product_description"]);
  
  createSeoTags($p["product_name"], $desc, "teste, teste", "assets/produtos/".$p["product_pictures"][0], TRUE, $p);

  $page = new Page();

  $page->setTpl("product", ["produto"=>$p, "produtosRandom"=>$pr]);

  return $res;

});

$app->get("/produtos[/{filtro}[/{param}]]", function(Request $req, Response $res, $args) {
  
  $prod = new products();

  $department = new Departments();
  $distributor = new Distributors();
  $fText = "Todos produtos";
  $reqUrl = "/produtos";

  $limite = (3 * 3);
  
  if (isset($_GET["pagina"]) && $_GET["pagina"] > 0) {
    $pagina = intval($_GET["pagina"]);
  } else {
    $pagina = 1;
  }

  $p = $prod->getFullWithCount("ORDER BY product_id DESC", $limite, $pagina);

  if(isset($args["filtro"])) {
    $filtro = $args["filtro"];
    
    if($filtro === "distribuidor" || $filtro === "ofertas" || $filtro === "departamento") {
      switch ($filtro) {

        case 'distribuidor':
          $distribuidor = isset($args["param"]) ? $args["param"] : NULL;
          if ($distribuidor == NULL) return $res->withHeader("Location", "/produtos");
          
          $dist = $args["param"];
          $distId = $distributor->getDisId($dist);
          $p = $prod->getByDistFull($distId, $limite, $pagina);

          $fText = "Produtos do distribuidor - ".ucfirst($dist);

          $reqUrl = $reqUrl."/distribuidor/".$dist;
          
          break;

        case 'departamento':
          $departamento = isset($args["param"]) ? $args["param"] : NULL;
          if ($departamento == NULL) return $res->withHeader("Location", "/produtos");

          $dep = $args["param"];
          $depId = $department->getDepId($dep);
          
          $p = $prod->getByDeptFull($depId, $limite, $pagina);

          $fText = "Produtos do departamento - ".ucfirst($dep);

          $reqUrl = $reqUrl."/departamento/".$dep;

          break;

        case 'ofertas':
          $p = $prod->getByOffers($limite, $pagina);

          $fText = "Ofertas";

          $reqUrl = $reqUrl."/ofertas";
          break;
      }
    } else {
      return $res->withHeader("Location", "/produtos");
    }
  }

  $d = $department->getAll();
  $dis = $distributor->getAll();

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

  $tags = [];

  if (count($p[0]) > 0) {
    foreach ($p[0] as $key => $value) {
        array_push($tags, $value["product_name"]);
    }
  }

  foreach ($d as $key => $value) {
    array_push($tags, $value["department_text"]);
  }

  foreach ($dis as $key => $value) {
    array_push($tags, $value["distributor_name"]);
  }

  $tags = implode(", ", $tags);

  $total = ceil($p[1]["count(1)"] / $limite);

  createSeoTags($fText, "", $tags);

  $page = new Page();
  
  $page->setTpl("products", ["produtos"=>$p[0], "prodCount"=>$p[1]["count(1)"], "pagina"=>$pagina, "paginas"=>$total, "departamentos"=>$d, "distribuidores"=>$dis, "filterText"=>$fText, "reqUrl"=>$reqUrl]);

  return $res;

});

?>