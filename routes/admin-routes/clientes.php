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

$app->get("/admin/cliente/ativar/{id}", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  $id = $args["id"];

  $clients = new Clients();

  $r = $clients->activateClient($id);

  if ($r["status"] == "success") {
    return $res->withHeader("Location", "/admin/clientes?activate=true");
  } else {
    return $res->withHeader("Location", "/admin/clientes?activate=false");
  }

  return $res;

});

$app->get("/admin/cliente/desativar/{id}", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  $id = $args["id"];

  $clients = new Clients();

  $r = $clients->deactivateClient($id);

  if ($r["status"] == "success") {
    return $res->withHeader("Location", "/admin/clientes?deactivate=true");
  } else {
    return $res->withHeader("Location", "/admin/clientes?deactivate=false");
  }

  return $res;

});


$app->get("/admin/cliente/remover/{id}", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  $id = $args["id"];

  $clients = new Clients();

  $r = $clients->removeClient($id);

  if ($r["status"] == "success") {
    return $res->withHeader("Location", "/admin/clientes?remove=true");
  } else {
    return $res->withHeader("Location", "/admin/clientes?remove=false");
  }

  return $res;

});

$app->get("/admin/cliente/editar/{id}", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  $id = $args["id"];

  $clients = new Clients();

  $r = $clients->getClientById($id);

  $page = new PageAdmin(["data"=>["page"=>createPage("Editando cliente ".$r["client_name"]."#".$id, "cliente/editar/".$id)]]);
  $page->setTpl("client-edit", ["client"=>$r]);

  return $res;

});

$app->post("/admin/cliente/editar/{id}", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  $id = $args["id"];
  $data = [];

  if (isset($_POST["update"])) {
    $data = [];

    foreach ($_POST as $key => $value) {
      if ($key != "update") {
        $data[$key] = $value;
      }
    }

    $clients = new Clients();
    $r = $clients->editClient($id, $data);

    if ($r == true) {
      return $res->withHeader("Location", "/admin/clientes?edit=true");
    } else {
      return $res->withHeader("Location", "/admin/clientes?edit=false");
    }
  }

  return $res;

});

$app->get("/admin/cliente/visualizar/{id}", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  $id = $args["id"];

  $clients = new Clients();

  $r = $clients->getClientById($id);

  $page = new PageAdmin(["data"=>["page"=>createPage("Visuzalizando cliente ".$r["client_name"]."#".$id, "cliente/visualizar/".$id)]]);
  $page->setTpl("client-view", ["client"=>$r]);

  return $res;

});


?>