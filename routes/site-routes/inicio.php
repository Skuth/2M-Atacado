<?php

use Skuth\Page;
use Skuth\Model\Departments;
use Skuth\Model\Sliders;
use Skuth\Model\Products;
use Skuth\Model\Cards;

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

  $cards = Cards::getCards();

  $page->setTpl("home", ["departments"=>$d, "sliders"=>$s, "prodRandom"=>$pr, "prodViews"=>$pv, "prodOffers"=>$po, "cards"=>$cards]);

  return $res;
  
});

$app->get("/offline", function(Request $req, Response $res, $args) {

  $page = new Page(["nav"=>false, "footer"=>false]);
  $page->setTpl("offline");
  
  return $res;

});


?>