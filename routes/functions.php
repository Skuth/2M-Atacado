<?php

use Skuth\Model\Departments;
use Skuth\Model\Distributors;
use Skuth\Model\SiteData;

function setSiteData() {
  $sd = new SiteData();
  $data = $sd->getData();
  $GLOBALS["siteData"] = $data;
}

setSiteData();

function formatMoney($money) {
  $money = str_replace(",", ".", $money);
  $fmt = numfmt_create("pt_BR", NumberFormatter::CURRENCY);
  $formated = $fmt->formatCurrency($money,  "BRL");
  $formated = str_replace("R$", "", $formated);
  return $formated;
}

function filterName($name) {
  $name = strtr(utf8_decode($name), utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝº'), 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY-');
  $name = str_replace(" ", "-", $name);
  $name = strtolower($name);
  return $name;
}

function parseProductDesc($desc) {

  $desc = explode("#", $desc);
  foreach ($desc as $key => $value) {
    $desc[$key] = explode("{", $desc[$key]);
    $desc[$key] = str_replace("}", "", $desc[$key]);
  }

  $parses = [];

  foreach ($desc as $key => $value) {
    if(count($desc[$key]) > 1 && $desc[$key][0] !== "script") {   
      if($desc[$key][0] == "br") {
        $res = "<".$desc[$key][0].">";
      } else {
        $res = "<".$desc[$key][0].">".$desc[$key][1]."</".$desc[$key][0].">";
      }
      array_push($parses, $res);
    }
  }
  
  $parses = implode("", $parses);

  return $parses;
  
}

function getPricePercentage($old, $new) {
  if ($old > 0 && $new > 0) {
    $p = ($new - $old) / $old * 100;
    $p =  number_format($p, 0, ".", "");
    $p = str_replace("-", "", $p);
    if ($p == 0) $p = 1;
    return $p;
  } else {
    return 0;
  }
}

function getDepartments() {
  $departments = new Departments();
  return $departments->getAll();
}

function getDistributors() {
  $distributors = new Distributors();
  return $distributors->getAll();
}

function getSiteUrl() {
  return $_SERVER["REQUEST_SCHEME"]."://".$_SERVER["HTTP_HOST"];
}

function seoDescFilter($desc) {
  $desc = str_replace("}", "", $desc);
  $desc = explode("#", $desc);
  $text = [];
  foreach ($desc as $key => $value) {
    $value = explode("{", $value);
    unset($value[0]);
    $text = array_merge($text, $value);
  }
  $text = implode("", $text);
  $text = str_replace("\n", ", ", $text);
  return $text;
}

function createSeoTags($title = "Inicio", $desc = "", $tags = "", $thumbnail = "assets/img/banner.png", $product = FALSE, $productInfo = []) {
  $seoTags = [
    "title"=>$title,
    "desc"=>$desc,
    "tags"=>$tags,
    "thumbnail"=>$thumbnail,
    "product"=>$product,
  ];

  if ($product == TRUE) {
    $prodInfo = [
      "productInfo"=>[
        "brand"=>$productInfo["distributor_name"],
        "ref"=>$productInfo["product_ref"],
        "price"=>$productInfo["product_price"],
        "priceOff"=>$productInfo["product_price_off"],
        "offDate"=>$productInfo["product_price_off_days"]
      ]
    ];

    $seoTags = array_merge($seoTags, $prodInfo);
  }
  
  $GLOBALS["seoTags"] = $seoTags;
}

createSeoTags();

function getShipmentPrice($address) {
  $city = $address["client_address_cidade"];
  
  switch ($city) {
    case 'Cabo Frio':
      return 5;
      break;
    
    default:
      return 0;
      break;
  }
}

?>