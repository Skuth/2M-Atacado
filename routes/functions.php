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