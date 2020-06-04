<?php

use Skuth\Page;
use Skuth\Model\Distributors;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get("/distribuidor/{dist}", function(Request $req, Response $res, $args) {

  $distribuidor = $args["dist"];

  $dist = new Distributors();
  $d = $dist->getByUrl($distribuidor);

  $page = new Page();
  
  $page->setTpl("info", ["content"=>$d["distributor_name"], "desc"=>$d["distributor_description"], "pics"=>$d["distributor_pictures"], "banner"=>$d["distributor_banner"]]);

  return $res;

});

?>