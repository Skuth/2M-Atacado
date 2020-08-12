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
  
  if (isset($_GET["pagina"])) {
    $pagina = trim(strip_tags(intval($_GET["pagina"])));
  } else {
    $pagina = 1;
  }

  if ($pagina == 0) {
    $pagina = 1;
  }

  $prod = new Products();
  
  $total = $prod->getTotal();

  $totalPage = 100;

  $totalPages = ceil($total / $totalPage);

  $offset = ($pagina - 1) * $totalPage;

  if (isset($_GET["s"])) {
    $s = $_GET["s"];

    $s = str_replace("-", "/", $s);
    $s = urldecode($s);
    $s = trim(strip_tags($s));

    $produtos = $prod->getBySearch($s, 1000, $pagina);

    if (count($produtos[0]) > 0) {
      $totalPages = 1;
      $produtos = $produtos[0];
    } else {
      return $res->withHeader("Location", "/admin/produtos");
    }

  } else {
    $produtos = $prod->getAll("LIMIT ".$totalPage." OFFSET ".$offset);
  }

  $page = new PageAdmin(["data"=>["page"=>createPage("Produtos", "produtos")]]);
  
  $page->setTpl("produtos", ["produtos"=>$produtos, "pagina"=>$pagina, "totalPages"=>$totalPages]);

  return $res;

});

$app->get("/admin/produto/novo",function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  $dist = new Distributors();
  $d = $dist->getAll();

  $dep = new Departments();
  $dp = $dep->getAll();

  $page = new PageAdmin(["data"=>["page"=>createPage("Cadastrando produto", "produto/novo")]]);

  $page->setTpl("prod-cad", ["dist"=>$d, "dep"=>$dp]);

  return $res;

});

$app->post("/admin/produto/novo",function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  if (isset($_POST["save"])) {
    $nome = $_POST["nome"];
    $ref = $_POST["ref"];
    $ref = str_pad($ref, 6, 0, STR_PAD_LEFT);
    $preco = $_POST["preco"];
    $preco = str_replace(",", ".", $preco);
    $estoque = $_POST["estoque"];
    $dist = $_POST["dist"];
    $dep = $_POST["dep"];
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

    if ($prod->cadProd($nome, $ref, $preco, $estoque, $dist, $dep, $descricao, $pics)) {
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

$app->get("/admin/produto/editar/{id}", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  $dist = new Distributors();
  $d = $dist->getAll();

  $dep = new Departments();
  $dp = $dep->getAll();

  $id = $args["id"];

  $prod = new Products();

  $p = $prod->getById($id);

  $page = new PageAdmin(["data"=>["page"=>createPage("Editando produto", "produto/editar/".$id)]]);

  $page->setTpl("prod-edit", ["dist"=>$d, "dep"=>$dp, "produto"=>$p]);

  return $res;
  
});

$app->post("/admin/produto/editar", function(Request $req, Response $res, $args) {

  if (isset($_POST["save"])) {
    $id = $_POST["id"];

    $prod = new Products();
    $produto = $prod->getById($id);

    $nome = $_POST["nome"];
    $ref = $_POST["ref"];
    $ref = str_pad($ref, 6, 0, STR_PAD_LEFT);
    $preco = $_POST["preco"];
    $preco = str_replace(",", ".", $preco);
    $estoque = $_POST["estoque"];
    $dist = $_POST["dist"];
    $dep = $_POST["dep"];
    $desc = filterDesc($_POST["descricao"]);
    $fotos = $_FILES["fotos"];
    $oldPictures = $produto["product_pictures"];

    $pics = [];

    $oldPics = true;

    if (count($fotos["name"]) > 0 && strlen($fotos["name"][0]) > 0) {
      for ($i=0; $i < count($fotos["name"]); $i++) { 
        $pic = [
          "name"=>$fotos["name"][$i],
          "type"=>$fotos["type"][$i],
          "tmp_name"=>$fotos["tmp_name"][$i],
          "error"=>$fotos["error"][$i],
          "size"=>$fotos["size"][$i],
        ];
        
        $oldPics = false;

        array_push($pics, uploadImage($pic, "produtos"));
      }

      $pics = implode(",", $pics);
    } else {
      $pics = $oldPictures;
      $pics = implode(",", $pics);
    }


    if ($prod->editProd($id, $nome, $dist, $ref, $dep, $desc, $pics, $preco, $estoque) == true) {
      if ($oldPics == false) {
        $olds = $oldPictures;
        foreach ($olds as $key => $value) {
          deleteImage($value, "produtos");
        }
      }
      return $res->withHeader("Location", "/admin/produtos?edit=true");
    } else {
      if ($oldPics == false) {
        $news = explode(",", $pics);
        foreach ($news as $key => $value) {
          deleteImage($value, "produtos");
        }
      }
      return $res->withHeader("Location", "/admin/produtos?edit=false");
    }
  }

  return $res;

});

$app->get("/admin/produto/promocao/{id}", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  $id = $args["id"];

  $prod = new Products();
  $p = $prod->getById($id);

  $page = new PageAdmin(["data"=>["page"=>createPage("Criando promoção", "produto/promocao/".$id)]]);

  $page->setTpl("prod-promo", ["prod"=>$p]);

  return $res;
  
});

$app->post("/admin/produto/promocao", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  if (isset($_POST["save"])) {
    $id = $_POST["id"];
    $priceOff = strlen($_POST["nPrice"] > 0) ? $_POST["nPrice"] : NULL;
    $dateOff = strlen($_POST["eDate"] > 0) ? $_POST["eDate"] : NULL;
    $stockOff = strlen($_POST["sDesc"] > 0) ? $_POST["sDesc"] : NULL;
    $stockOff = ($stockOff == 0) ? NULL : $stockOff;

    $prod = new Products();

    if ($prod->cadPromo($id, $priceOff, $dateOff, $stockOff)) {
      return $res->withHeader("Location", "/admin/promocoes?cad=true");
    } else {
      return $res->withHeader("Location", "/admin/promocoes?cad=false");
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

$app->get("/admin/produtos/atualizar", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  $page = new PageAdmin(["data"=>["page"=>createPage("Enviar arquivo de atualização", "produtos/atualizar")]]);

  $page->setTpl("prod-update-all");

  return $res;

});

$app->post("/admin/produtos/atualizar", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  if (isset($_FILES["data"])) {
    $stock = isset($_POST["stock"]) ? $_POST["stock"] : "off";
    $price = isset($_POST["price"]) ? $_POST["price"] : "off";

    $fname = $_FILES["data"]["tmp_name"];
    $ftype = $_FILES["data"]["type"];

    if ($ftype == "text/plain") {
  
      $data = csvToJson($fname);

      if ($stock != "off" || $price != "off") {
        if ($stock == "on") {
          Products::resetStock();
        }
        
        foreach ($data as $key => $value) {
          if ($stock == "on") {
            Products::updateStock($value["Produto"], intval($value["Quant s/Vnd"]));
          }

          if ($price == "on") {
            Products::updatePrice($value["Produto"], floatval($value["Unit s/Vnd"]));
          }
        }
      }

      return $res->withHeader("Location", "/admin/produtos/atualizar?update=true");

    } else {

      return $res->withHeader("Location", "/admin/produtos/atualizar?update=false");

    }
  }

  return $res;

});

$app->post("/admin/produtos/pdf", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  ini_set('memory_limit', '512M');
  ini_set("pcre.backtrack_limit", "1000000");

  $mpdf = new \Mpdf\Mpdf();

  $prods = new Products();
  $p = $prods->getToPdf();

  $htmlStyle = "<style>
    table { width: 100%; }
    th { background: #1A3795; color: #fff; padding: 10px 0; font-family: sans-serif; text-align: center; vertical-align: middle; }
    td { padding: 20px 0; font-family: sans-serif; text-align: center; vertical-align: middle; height: 60px; display: block; border-bottom: 1px solid #ddd; }
  </style>";

  $tableContent = "";

  foreach ($p as $key => $value) {
    $price = formatMoney($value["product_price"]);
    $tableContent = $tableContent."<tr>
      <td style='width: 100px;'><img src='{getSiteUrl()}/assets/produtos/{$value["product_pictures"][0]}' style='display: block; width: 60px;'></img></td>
      <td style='width: 100px;'>{$value["product_ref"]}</td>
      <td style='width: 60%;'>{$value["product_name"]}</td>
      <td style='width: 150px;'>R$ {$price}</td>
    </tr>";
  }
  
  $htmlBody = "
  <htmlpageheader name='header'>
    <table cellspacing='0' cellpadding='0'>
      <tr>
        <th style='width: 100px;'>Foto</th>
        <th style='width: 100px;'>Código</th>
        <th style='width: 60%;'>Descrição</th>
        <th style='width: 150px;'>Preço</th>
      </tr>
    </table>
  </htmlpageheader>
  
  <htmlpagefooter name='footer'>
    <table width='100%'>
      <tr>
        <td width='33%' align='center' style='padding: 0; vertical-align: bottom; border: 0;'>{PAGENO}/{nbpg}</td>
      </tr>
    </table>
  </htmlpagefooter>
  
  <sethtmlpageheader name='header' value='on' show-this-page='1'/>
  <sethtmlpagefooter name='footer' value='on' />
  
  <table cellspacing='0' cellpadding='0'>
  ".$tableContent."
  </table>";
  
  $html = $htmlStyle.$htmlBody;

  $path = $_SERVER["DOCUMENT_ROOT"]."/assets/admin/pdf/catalogo.pdf";
  
  $mpdf->WriteHTML($html);
  $mpdf->Output($path, \Mpdf\Output\Destination::FILE);

  echo json_encode(getSiteUrl()."/assets/admin/pdf/catalogo.pdf");

  return $res;

});

?>