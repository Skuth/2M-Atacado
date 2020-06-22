<?php

function getNav() {
  $colors = [
    "text-primary",
    "text-danger",
    "text-info",
    "text-success",
    "text-warning"
  ];

  $navItems = [
    [
      "name"=>"dashboard",
      "href"=>"dashboard",
      "icon"=>"ni ni-tv-2",
      "color"=>"",
      "nivel"=>1
    ],
    [
      "name"=>"pedidos",
      "href"=>"pedidos",
      "icon"=>"ni ni-cart",
      "color"=>"",
      "nivel"=>1
    ],
    [
      "name"=>"usuarios",
      "href"=>"usuarios",
      "icon"=> "fas fa-users",
      "color"=>"",
      "nivel"=>2
    ],
    [
      "name"=>"produtos",
      "href"=>"produtos",
      "icon"=>"ni ni-archive-2",
      "color"=>"",
      "nivel"=>1
    ],
    [
      "name"=>"promoções",
      "href"=>"promocoes",
      "icon"=>"fas fa-percentage",
      "color"=>"",
      "nivel"=>1
    ],
    [
      "name"=>"distribuidores",
      "href"=>"distribuidores",
      "icon"=>"ni ni-books",
      "color"=>"",
      "nivel"=>2
    ],
    [
      "name"=>"departamentos",
      "href"=>"departamentos",
      "icon"=>"ni ni-scissors",
      "color"=>"",
      "nivel"=>2
    ],
    [
      "name"=>"banners",
      "href"=>"banners",
      "icon"=>"ni ni-album-2",
      "color"=>"",
      "nivel"=>2
    ],
    [
      "name"=>"administração",
      "href"=>"administracao",
      "icon"=>"fas fa-tools",
      "color"=>"",
      "nivel"=>2
    ],
    [
      "name"=>"cupons",
      "href"=>"cupons",
      "icon"=>"fas fa-tag",
      "color"=>"",
      "nivel"=>10
    ]
  ];

  $i = 0;

  foreach ($navItems as $key => $value) {
    $navItems[$key]["color"] = $colors[$i];

    if ($i >= (count($colors) - 1)) {
      $i = 0;
    } else {
      $i ++;
    }
  }

  return $navItems;
}

function createPage($p, $h) {
  $page = [
    "page"=>$p,
    "href"=>$h
  ];

  return $page;
}

function getUserSession() {
  if(isset($_SESSION["user"])) {
    $user = $_SESSION["user"];

    return $user;
  } else {
    return NULL;
  }
}

function filterDesc($desc) {
  $desc = explode("\n", $desc);

  for ($i=0; $i < count($desc); $i++) {
    if(empty(trim($desc[$i]))) {
      $desc[$i] = "#br{}";
    } else {
      if(substr(trim($desc[$i]), 0, 1) != "#") {
        $desc[$i] = "#p{".trim($desc[$i])."}";
      }
    }
  }

  $desc = implode("", $desc);

  return $desc;
}

function parseDesc($desc) {
  $desc = trim($desc);
  $desc = str_replace(" #", "\n#", $desc);

  return $desc;
}

function getPercentage($old, $new) {
  if ($old > 0 && $new > 0) {
    $p = ($new - $old) / $old * 100;
    return number_format($p, 2, ".", "");
  } else {
    return 0;
  }
}

function parseCpfCnpj($string) {
  $string = preg_replace("/\s+/", "", $string);
  $string = str_replace("(", "", $string);
  $string = str_replace(")", "", $string);
  $string = str_replace("-", "", $string);
  $string = str_replace("/", "", $string);
  $string = str_replace(".", "", $string);
  return $string;
}

function uploadImage($image, $path) {
  $fileFolder = $_SERVER["DOCUMENT_ROOT"]."/assets/".$path."/";
  
  $fileType = explode("/", $image["type"]);
  $fileError = $image["error"];
  
  $fileName = $image["name"];
  
  $fileExtension = explode(".", $fileName);
  $fileExtension = $fileExtension[count($fileExtension) - 1];
  
  $fileTmpName = $image["tmp_name"];
  
  $fileNewName = md5(date("dmYHis") . $fileName . $fileTmpName).".".$fileExtension;

  
  if ($fileError == 0 && $fileType[0] == "image") {
    if ($fileType[1] == "png" || $fileType[1] == "jpg" || $fileType[1] == "jpeg") {
      move_uploaded_file($fileTmpName, $fileFolder.$fileNewName);
      return $fileNewName;
    }
  }
}

function deleteImage($image, $path) {
  $fileFolder = $_SERVER["DOCUMENT_ROOT"]."/assets/".$path."/";
  chmod($fileFolder, 0777);
  
  if (file_exists($fileFolder.$image) && $image !== NULL && strlen($image) > 0) {
    unlink($fileFolder.$image);
  }
}

?>