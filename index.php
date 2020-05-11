<?php

  setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
  date_default_timezone_set('America/Sao_Paulo');

  session_start();

  use Psr\Http\Message\ServerRequestInterface;
  use Slim\Factory\AppFactory;
  use Slim\Psr7\Response;

  require_once(__DIR__."./vendor/autoload.php");

  $app = AppFactory::create();

  $errorMiddleware = $app->addErrorMiddleware(true, true, true);

  require_once(__DIR__."/routes/site.php");
  require_once(__DIR__."/routes/admin.php");

  $app->run();

?>