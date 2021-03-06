<?php

use Skuth\Model\Products;

$GLOBALS["lowStock"] = Products::getLowStock();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require_once("admin-functions.php");

$app->get("/admin", function(Request $req, Response $res, $args) {

  return $res->withHeader("Location", "admin/dashboard");

});

require_once("admin-routes/dashboard.php");
require_once("admin-routes/usuarios.php");
require_once("admin-routes/produtos.php");
require_once("admin-routes/promocoes.php");
require_once("admin-routes/cupons.php");
require_once("admin-routes/distribuidores.php");
require_once("admin-routes/departamentos.php");
require_once("admin-routes/banners.php");
require_once("admin-routes/admin.php");
require_once("admin-routes/pedidos.php");
require_once("admin-routes/clientes.php");
require_once("admin-routes/cartoes.php");

?>