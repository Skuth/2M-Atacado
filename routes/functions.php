<?php

use Skuth\Model\Departments;
use Skuth\Model\Distributors;

function formatMoney($money) {
  $money = str_replace(",", ".", $money);
  $fmt = numfmt_create("pt_BR", NumberFormatter::CURRENCY);
  $formated = $fmt->formatCurrency($money,  "BRL");
  $formated = str_replace("R$", "", $formated);
  return $formated;
}

function filterName($name) {
  $name = strtr(utf8_decode($name), utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'), 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
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
  return $_SERVER["REQUEST_SCHEME"]."://".$_SERVER["HTTP_HOST"]."/";
}


?>