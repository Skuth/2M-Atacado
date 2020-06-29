<?php

use Skuth\PageAdmin;
use Skuth\Model\Panel;
use Skuth\Model\Clients;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get("/admin/clientes", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if (isset($_GET["pagina"])) {
    $pagina = trim(strip_tags(intval($_GET["pagina"])));
  } else {
    $pagina = 1;
  }

  if ($pagina == 0) {
    $pagina = 1;
  }

  
  $limit = 6;
  $offset = ($pagina - 1) * $limit;
  
  
  $clients = Clients::getClients("LIMIT ".$limit." OFFSET ".$offset);

  if (count($clients["clients"]) <= 0 && $clients["count"] > 0) {
    return $res->withHeader("Location", "/admin/clientes?pagina=1");
  }
  
  $page = new PageAdmin(["data"=>["page"=>createPage("clientes", "clientes")]]);
  $page->setTpl("clients", ["clients"=>$clients["clients"], "count"=>$clients["count"], "pagina"=>$pagina, "limit"=>$limit, "url"=>"clientes"]);

  return $res;

});

$app->get("/admin/clientes/desativados", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if (isset($_GET["pagina"])) {
    $pagina = trim(strip_tags(intval($_GET["pagina"])));
  } else {
    $pagina = 1;
  }

  if ($pagina == 0) {
    $pagina = 1;
  }

  
  $limit = 6;
  $offset = ($pagina - 1) * $limit;
  
  
  $clients = Clients::getClients("WHERE client_status=0 LIMIT ".$limit." OFFSET ".$offset);
  
  $page = new PageAdmin(["data"=>["page"=>createPage("clientes desativados", "clientes/desativados")]]);
  $page->setTpl("clients", ["clients"=>$clients["clients"], "count"=>$clients["count"], "pagina"=>$pagina, "limit"=>$limit, "url"=>"clientes/desativados"]);

  return $res;

});

$app->post("/admin/clientes/chave", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  $chave = Clients::generateRegisterKey();

  echo json_encode($chave);

  return $res;

});


?>