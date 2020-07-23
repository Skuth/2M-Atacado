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

function formatMoneyHide($money) {
  $money = explode(".", $money);
  $formated = substr($money[0], 0, 1);

  for ($i=0; $i < strlen($money[0]) - 1; $i++) { 
    $formated = $formated."X";
  }

  $formated = $formated.",";

  for ($i=0; $i < strlen($money[1]); $i++) { 
    $formated = $formated."X";
  }

  return $formated;
}

function filterName($name) {
  $name = strtr(utf8_decode($name), utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝº'), 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY-');
  $name = str_replace(" ", "-", $name);
  $name = str_replace("/", "", $name);
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

function createSeoTags($title = "Inicio", $desc = "", $tags = "", $thumbnail = "assets/img/banner.webp", $product = FALSE, $productInfo = []) {
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
  $city = (isset($address["client_address_cidade"])) ? $address["client_address_cidade"] : "";
  
  switch ($city) {
    case 'Cabo Frio':
      return 5;
      break;
    
    default:
      return 0;
      break;
  }
}

function formatString($string) {
  $string = preg_replace("/\s+/", "", $string);
  $string = str_replace("(", "", $string);
  $string = str_replace(")", "", $string);
  $string = str_replace("-", "", $string);
  $string = str_replace("/", "", $string);
  $string = str_replace(".", "", $string);
  return $string;
}

function formatCnpjCpf($doc) {
  $doc = preg_replace("/\D/", '', $doc);

  $doc = formatString($doc);

  if (strlen($doc) == 11) {
    $doc = preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $doc);
  } elseif (strlen($doc) == 8) {
    $doc = preg_replace("/(\d{2})(\d{3})(\d{2})(\d{1})/", "\$1.\$2.\$3-\$4", $doc);
  } else {
    $doc = preg_replace("/(\d{3})(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $doc);
  }
  
  return $doc;
}

function formatPhone($phone) {
  $phone = formatString($phone);
  if (strpos($phone, ",") == TRUE) {
    $phone = explode(",", $phone);
    foreach ($phone as $key => $value) {
      $value = preg_replace("/\D/", '', $value);
      if (strlen($value) == 11) {
        $phone[$key] = preg_replace("/(\d{2})(\d{1})(\d{4})(\d{4})/", "(\$1) \$2 \$3-\$4", $value);
      } elseif (strlen($phone) == 10) {
        $phone[$key] = preg_replace("/(\d{2})(\d{4})(\d{4})/", "(\$1) \$2-\$3", $value);
      } else {
        $phone[$key] = preg_replace("/(\d{4})(\d{4})/", "\$1-\$1", $value);
      }
    }
    $phone = implode(" | ", $phone);
  } else {
    $phone = preg_replace("/(\d{2})(\d{1})(\d{4})(\d{4})/", "(\$1) \$2 \$3-\$4", $phone);
    if (strlen($phone) == 11) {
      $phone = preg_replace("/(\d{2})(\d{1})(\d{4})(\d{4})/", "(\$1) \$2 \$3-\$4", $phone);
    } elseif (strlen($phone) == 10) {
      $phone = preg_replace("/(\d{2})(\d{4})(\d{4})/", "(\$1) \$2-\$3", $phone);
    } else {
      $phone = preg_replace("/(\d{4})(\d{4})/", "\$1-\$1", $phone);
    }
  }
  
  return $phone;
}

function formatCep($cep) {
  $cep = preg_replace("/(\d{5})(\d{3})/", "\$1-\$2", $cep);
  return $cep;
}

function getImages($image) {
  $imageWebp = $image;
  $imageJpg = str_replace(".webp", ".jpg", $image);

  return [
    "webp"=>$imageWebp,
    "jpg"=>$imageJpg
  ];
}

?>