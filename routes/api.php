<?php

use Skuth\Model\Api;
use Skuth\Model\Products;
use Skuth\Model\Departments;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->post("/api/notification[/{action}]", function(Request $req, Response $res, $args) {

  $status = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/assets/admin/status.json");

  $status = json_decode($status, true);
  
  echo json_encode($status);

  if(isset($args["action"]) && $args["action"] == "update") {
    $status["status"] = ($status["status"] + 1);
  }

  if(isset($args["action"]) && $args["action"] == "reset") {
    $status["status"] = 0;
  }

  $status = json_encode($status);

  file_put_contents($_SERVER["DOCUMENT_ROOT"]."/assets/admin/status.json", $status);

  return $res;

});

// $app->get("/api/sitemap", function(Request $req, Response $res, $args) {

//   // $prods = new Products();
//   // $p = $prods->getAll();
  
//   // foreach ($p as $key => $value) {
//   //   $slug = filterName($value['product_name']);
//   //   $code = "
//   //   <url>
//   //     <loc>https://2matacado.com.br/produto/{$value['product_ref']}/{$slug}</loc>
//   //     <lastmod>2020-08-13T17:00:00+03:00</lastmod>
//   //     <priority>1.0</priority>
//   //   </url>\n";
//   //   echo $code;
//   // }

//   // $dep = new Departments();
//   // $d = $dep->getAll();

//   // foreach ($d as $key => $value) {
//   //   $code = "
//   //   <url>
//   //     <loc>https://2matacado.com.br/distribuidor/{$value['department_href']}</loc>
//   //     <lastmod>2020-08-13T17:00:00+03:00</lastmod>
//   //     <priority>0.6</priority>
//   //   </url>\n
//   //   ";

//   //   echo $code;
//   // }

//   // return $res;

// });

?>