<?php

  setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
  date_default_timezone_set('America/Sao_Paulo');

  session_start();

  use Psr\Http\Message\ServerRequestInterface;
  use Slim\Factory\AppFactory;
  use Slim\Psr7\Response;

  if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = [];
  }

  $GLOBALS["version"] = "1-20-07-19";
  $GLOBALS["sitemap"] = "teste";

  require_once($_SERVER["DOCUMENT_ROOT"]."/vendor/autoload.php");

  $app = AppFactory::create();

  $errorMiddleware = $app->addErrorMiddleware(true, true, true);

  require_once($_SERVER["DOCUMENT_ROOT"]."/verify.php");
  require_once($_SERVER["DOCUMENT_ROOT"]."/routes/site.php");
  require_once($_SERVER["DOCUMENT_ROOT"]."/routes/admin.php");
  require_once($_SERVER["DOCUMENT_ROOT"]."/routes/api.php");

  $app->run();

?>