<?php

use Skuth\Page;
use Skuth\Model\Departments;
use Skuth\Model\Sliders;
use Skuth\Model\Products;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get("/[inicio]", function(Request $req, Response $res, $args) {

  $page = new Page(["data"=>["navStyle"=>"banner"]]);

  $departments = new Departments();
  $d = $departments->getAll();

  $slider = new Sliders();
  $s = $slider->getAll();

  $prod = new Products();
  $pr = $prod->getAllFull("ORDER BY RAND() LIMIT 4");
  $pv = $prod->getAllFull("ORDER BY product_views DESC LIMIT 4");
  $po = $prod->getAllFull("WHERE product_price_off IS NOT NULL LIMIT 4");

  $page->setTpl("home", ["departments"=>$d, "sliders"=>$s, "prodRandom"=>$pr, "prodViews"=>$pv, "prodOffers"=>$po]);

  return $res;
  
});


?>