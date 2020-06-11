<?php

use Skuth\PageAdmin;
use Skuth\Model\Panel;
use Skuth\Model\SiteData;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get("/admin/administracao", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  $sd = new SiteData();
  $data = $sd->getData();

  $page = new PageAdmin(["data"=>["page"=>createPage("administração", "administracao")]]);

  $page->setTpl("admin", ["data"=>$data]);

  return $res;

});

$app->get("/admin/administracao/editar", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  $sd = new SiteData();
  $data = $sd->getData();

  $page = new PageAdmin(["data"=>["page"=>createPage("editando informações do site", "administracao/editar")]]);

  $page->setTpl("admin-edit", ["data"=>$data]);

  return $res;

});

$app->post("/admin/administracao/editar", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  if (isset($_POST["save"])) {
    
    $sd = new SiteData();

    $address = $_POST["address"];
    $email = $_POST["email"];
    $hf = $_POST["hf"];

    $cnpj = parseCpfCnpj($_POST["cnpj"]);
    $cnpj = preg_replace("/(\d{3})(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj);
    
    $ie = parseCpfCnpj($_POST["ie"]);
    $ie = preg_replace("/(\d{2})(\d{3})(\d{2})(\d{1})/", "\$1.\$2.\$3-\$4", $ie);
    
    $tel = $_POST["tel"];
    if (strpos($tel, ",") == TRUE) {
      $tel = explode(",", $tel);
      foreach ($tel as $key => $value) {
        $value = parseCpfCnpj($value);
        $tel[$key] = preg_replace("/(\d{2})(\d{1})(\d{4})(\d{4})/", "(\$1) \$2 \$3-\$4", $value);
      }
      $tel = implode(" | ", $tel);
    } else {
      $tel = preg_replace("/(\d{2})(\d{1})(\d{4})(\d{4})/", "(\$1) \$2 \$3-\$4", $tel);
    }

    if ($sd->updateData($address, $cnpj, $ie, $tel, $email, $hf) == TRUE) {
      return $res->withHeader("Location", "/admin/administracao?edit=true");
    } else {
      return $res->withHeader("Location", "/admin/administracao?edit=false");
    }
  }

  return $res;

});


?>