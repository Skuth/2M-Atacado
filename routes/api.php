<?php

use Skuth\Model\Api;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->post("/api/notification[/{action}]", function(Request $req, Response $res, $args) {

  $status = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/assets/admin/status.json");

  $status = json_decode($status, true);
  
  echo json_encode($status);

  if(isset($args["action"]) && $args["action"] == "update") {
    $status["status"] = ($status["status"] + 1);
  }

  if(isset($args["action"]) && $args["action"] == "reset") {
    $status["status"] = 0;
  }

  $status = json_encode($status);

  file_put_contents($_SERVER["DOCUMENT_ROOT"]."/assets/admin/status.json", $status);

  return $res;

});

?>