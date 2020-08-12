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
      "nivel"=>1
    ],
    [
      "name"=>"pedidos",
      "href"=>"pedidos",
      "icon"=>"ni ni-cart",
      "nivel"=>1,
      "submenu"=>[
        [
          "name"=>"abertos",
          "href"=>"pedidos/aberto"
        ]
      ]
    ],
    [
      "name"=>"clientes",
      "href"=>"clientes",
      "icon"=> "fas fa-users",
      "nivel"=>1,
      "submenu"=>[
        [
          "name"=>"Desativados",
          "href"=>"clientes/desativados"
        ]
      ]
    ],
    [
      "name"=>"usuarios",
      "href"=>"usuarios",
      "icon"=> "fas fa-address-card",
      "nivel"=>2
    ],
    [
      "name"=>"produtos",
      "href"=>"produtos",
      "icon"=>"ni ni-archive-2",
      "nivel"=>1
    ],
    [
      "name"=>"promoções",
      "href"=>"promocoes",
      "icon"=>"fas fa-percentage",
      "nivel"=>1
    ],
    [
      "name"=>"distribuidores",
      "href"=>"distribuidores",
      "icon"=>"ni ni-books",
      "nivel"=>2
    ],
    [
      "name"=>"departamentos",
      "href"=>"departamentos",
      "icon"=>"ni ni-scissors",
      "nivel"=>2
    ],
    [
      "name"=>"banners",
      "href"=>"banners",
      "icon"=>"ni ni-album-2",
      "nivel"=>2
    ],
    [
      "name"=>"administração",
      "href"=>"administracao",
      "icon"=>"fas fa-tools",
      "nivel"=>2
    ],
    [
      "name"=>"Cartões",
      "href"=>"cartoes",
      "icon"=>"fas fa-columns",
      "nivel"=>2
    ],
    [
      "name"=>"cupons",
      "href"=>"cupons",
      "icon"=>"fas fa-tag",
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

function uploadImage($image, $path, $name = "") {
  $fileFolder = $_SERVER["DOCUMENT_ROOT"]."/assets/".$path."/";
  chmod($fileFolder, 0777);
  
  $fileType = explode("/", $image["type"]);
  $fileError = $image["error"];
  
  $fileName = $image["name"];
  
  $fileExtension = explode(".", $fileName);
  $fileExtension = $fileExtension[count($fileExtension) - 1];
  
  $fileTmpName = $image["tmp_name"];
  
  if ($name == "") {
    $fileNewName = md5(date("dmYHis") . $fileName . $fileTmpName);
  } else {
    $fileNewName = $name;
  }
  
  $fileNewNameA = $fileNewName.".jpg";
  $fileNewNameB = $fileNewName.".webp";

  
  if ($fileError == 0 && $fileType[0] == "image") {
    if ($fileType[1] == "png" || $fileType[1] == "jpg" || $fileType[1] == "jpeg" || $fileType[1] == "webp") {

      if ($fileExtension != "jpg" && $fileExtension != "jpeg" && $name == "") {
        $i = ($fileExtension == "webp") ? imagecreatefromwebp($fileTmpName) : imagecreatefrompng($fileTmpName);
        list($w, $h) = getimagesize($fileTmpName);
        $o = imagecreatetruecolor($w, $h);
        $white = imagecolorallocate($o, 255, 255, 255);
        imagefilledrectangle($o, 0, 0, $w, $h, $white);
        imagecopy($o, $i, 0, 0, 0, 0, $w, $h);
        imagejpeg($o, $fileFolder.$fileNewNameA , 100);
        imagedestroy($i);
        imagedestroy($o);
      } else {
        move_uploaded_file($fileTmpName, $fileFolder.$fileNewNameA);
      }

      if (function_exists("imagewebp")) {

        $img = imagecreatefromjpeg($fileFolder.$fileNewNameA);
  
        imagewebp($img, $fileFolder.$fileNewNameB, 100);
        
        imagedestroy($img);

        deleteImage($fileNewNameA, $path);
        return $fileNewNameB;
        
      } else {
        
        $image = new Imagick($fileFolder.$fileNewNameA);
        
        $image->setImageCompression(100);
        $image->setOption("webp:lossless", "true");
        
        $image->writeImage($fileFolder.$fileNewNameB);
        
        deleteImage($fileNewNameA, $path);
        return $fileNewNameB;

      }

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

function csvToJson($fname) {
  $fp = fopen($fname, 'r');

  $key = fgetcsv($fp);

  $data = [];

  while($row = fgetcsv($fp)) {
    $line = array_combine($key, $row);
    array_push($data, $line);
  }

  fclose($fp);

  foreach ($data as $key => $value) {
    $data[$key] = str_replace('"', "", $value);
    $data[$key] = str_replace("'", "", $value);
  }

  return $data;
}

?>