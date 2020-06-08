<?php

use Skuth\Page;
use Skuth\Model\SiteData;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get("/sobre", function(Request $req, Response $res, $args) {

  $data = new SiteData();
  $sdata = $data->getData();

  $page = new Page();

  $page->setTpl("info", ["content"=>"Sobre nós", "desc"=>$sdata["site_data_description"], "pics"=>$sdata["site_data_pictures"], "banner"=>$sdata["site_data_banner"], "type"=>1]);

  return $res;

});

?>