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

  //$GLOBALS["version"] = "1-20-07-19";
  $GLOBALS["version"] = rand(1, 100000000000000000);

  require_once($_SERVER["DOCUMENT_ROOT"]."/vendor/autoload.php");

  $app = AppFactory::create();

  $debug = true;

  $errorMiddleware = $app->addErrorMiddleware($debug, $debug, $debug);

  require_once($_SERVER["DOCUMENT_ROOT"]."/verify.php");
  require_once($_SERVER["DOCUMENT_ROOT"]."/routes/site.php");
  require_once($_SERVER["DOCUMENT_ROOT"]."/routes/admin.php");
  require_once($_SERVER["DOCUMENT_ROOT"]."/routes/api.php");

  $app->run();

?>