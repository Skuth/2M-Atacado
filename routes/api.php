<?php

use Skuth\Model\Api;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

CONST APIKEY = "kpfnmER7rQC7DRZszaxKZJcaXbbzcjQQubaLakqS";

function returnMessage($status, $message) {
  
  switch ($status) {
    case 1:
      $status = "success";
      break;
    case 2:
      $status = "error";
      break;
    case 3:
      $status = "info";
      break;
    default:
      $status = "success";
      break;
  }

  $msg = [
    "status"=>$status,
    "message"=>$message
  ];

  echo json_encode($msg);
}

$app->post("/api/produto/estoque/{ref}/{estoque}", function(Request $req, Response $res, $args) {

  $key = (isset($_POST["apikey"])) ? $_POST["apikey"] : NULL;

  if ($key == NULL) {
    returnMessage(2, "Você precisa informar uma chave.");
    return $res;
  }

  if ($key != APIKEY) {
    returnMessage(2, "Chave invalida.");
    return $res;
  }

  $ref = trim(strip_tags($args["ref"]));
  $estoque = trim(strip_tags($args["estoque"]));

  if (strlen($ref) < 6) {
    returnMessage(2, "O código precisa ter no mínimo 6 dígitos.");
    return $res;
  }

  if ($estoque < 0) {
    returnMessage(2, "A quantidade em estoque precisa ser maior ou igual a 0.");
    return $res;
  } 

  if (Api::updateStock($ref, $estoque)) {
    returnMessage(1, "Sucesso ao editar estoque do produto com código {$ref} para {$estoque}");
  } else {
    returnMessage(2, "Falha ao editar estoque do produto com código {$ref}");
  }

  return $res;

});

?>