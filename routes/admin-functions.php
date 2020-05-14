<?php

function getNav() {
  $navItems = [
    [
      "name"=>"dashboard",
      "href"=>"dashboard",
      "icon"=>"ni ni-tv-2",
      "color"=>"text-primary",
      "nivel"=>1
    ],
    [
      "name"=>"usuarios",
      "href"=>"usuarios",
      "icon"=> "fas fa-users",
      "color"=>"text-danger",
      "nivel"=>2
    ],
    [
      "name"=>"produtos",
      "href"=>"produtos",
      "icon"=>"ni ni-archive-2",
      "color"=>"text-info",
      "nivel"=>1
    ],
    [
      "name"=>"promoções",
      "href"=>"promocoes",
      "icon"=>"fas fa-percentage",
      "color"=>"text-success",
      "nivel"=>1
    ],
    [
      "name"=>"distribuidores",
      "href"=>"distribuidores",
      "icon"=>"ni ni-books",
      "color"=>"text-warning",
      "nivel"=>2
    ],
    [
      "name"=>"categorias",
      "href"=>"categorias",
      "icon"=>"fas fa-tags",
      "color"=>"text-primary",
      "nivel"=>2
    ],
    [
      "name"=>"departamentos",
      "href"=>"departamentos",
      "icon"=>"ni ni-scissors",
      "color"=>"text-danger",
      "nivel"=>2
    ],
    [
      "name"=>"banners",
      "href"=>"banners",
      "icon"=>"ni ni-album-2",
      "color"=>"text-info",
      "nivel"=>2
    ]
  ];

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

?>