<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require_once("admin-functions.php");

$app->get("/admin", function(Request $req, Response $res, $args) {

  return $res->withHeader("Location", "admin/dashboard");

});

require_once("admin-routes/dashboard.php");
require_once("admin-routes/usuarios.php");
require_once("admin-routes/produtos.php");
require_once("admin-routes/marcas.php");
require_once("admin-routes/categorias.php");
require_once("admin-routes/banners.php");

?>