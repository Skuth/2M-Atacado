<?php

use Skuth\PageAdmin;
use Skuth\Model\Panel;
use Skuth\Model\Products;

use Skuth\Model\Category;
use Skuth\Model\Distributors;
use Skuth\Model\Departments;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require_once($_SERVER["DOCUMENT_ROOT"]."/routes/functions.php");

$app->get("/admin/produtos", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");
  
  if (!isset($_GET["pagina"])) {
    $pagina = 1;
  } else {
    $pagina = $_GET["pagina"];
  }

  $prod = new Products();
  
  $total = $prod->getTotal();

  $totalPage = 5;

  $totalPages = ceil($total / $totalPage);

  $paginas = [];

  for ($i=0; $i < $totalPages; $i++) { 
    array_push($paginas, $i);
  }

  $offset = ($pagina - 1) * $totalPage;

  $produtos = $prod->getAll("LIMIT ".$totalPage." OFFSET ".$offset);

  $page = new PageAdmin(["data"=>["page"=>createPage("Produtos", "produtos")]]);
  
  $page->setTpl("produtos", ["produtos"=>$produtos, "total"=>$paginas, "pagina"=>$pagina, "totalPages"=>$totalPages]);

  return $res;

});

$app->get("/admin/produto/visualizar/{id}", function(Request $req, Response $res, $args) {

  $id = $args["id"];

  $prod = new Products();

  $produto = $prod->getById($id);

  var_dump($produto);

  return $res;

});

$app->get("/admin/produto/novo",function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  $cat = new Category();
  $c = $cat->getAll();

  $dist = new Distributors();
  $d = $dist->getAll();

  $dep = new Departments();
  $dp = $dep->getAll();

  $page = new PageAdmin(["data"=>["page"=>createPage("Cadastrando produto", "produto/novo")]]);

  $page->setTpl("prod-cad", ["cat"=>$c, "dist"=>$d, "dep"=>$dp]);

  return $res;

});

$app->post("/admin/produto/novo",function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  if (isset($_POST["save"])) {
    $nome = $_POST["nome"];
    $ref = $_POST["ref"];
    $preco = $_POST["preco"];
    $preco = str_replace(",", ".", $preco);
    $estoque = $_POST["estoque"];
    $dist = $_POST["dist"];
    $dep = $_POST["dep"];
    $cat = $_POST["cat"];
    $descricao = filterDesc($_POST["descricao"]);

    $fotos = $_FILES["fotos"];
    $pics = [];

    for ($i=0; $i < count($fotos["name"]); $i++) { 
      $pic = [
        "name"=>$fotos["name"][$i],
        "type"=>$fotos["type"][$i],
        "tmp_name"=>$fotos["tmp_name"][$i],
        "error"=>$fotos["error"][$i],
        "size"=>$fotos["size"][$i],
      ];

      array_push($pics, uploadImage($pic, "produtos"));
    }

    $pics = implode(",", $pics);

    $prod = new Products();

    if ($prod->cadProd($nome, $ref, $preco, $estoque, $dist, $dep, $cat, $descricao, $pics)) {
      return $res->withHeader("Location", "/admin/produtos?cad=true");
    } else {
      $pics = explode(",", $pics);
      foreach ($pics as $key => $value) {
        deleteImage($value, "produtos");
      }
      return $res->withHeader("Location", "/admin/produtos?cad=false");
    }
  }

  return $res;

});

$app->get("/admin/produto/remover/{id}", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  $id = $args["id"];

  $prod = new Products();

  $r = $produto = $prod->removeProd($id);

  if ($r["status"] == true) {
    foreach ($r["pics"] as $key => $value) {
      deleteImage($value, "produtos");
    }
    return $res->withHeader("Location", "/admin/produtos?remove=true");
  } else {
    return $res->withHeader("Location", "/admin/produtos?remove=false");
  }

  return $res;

});

?>