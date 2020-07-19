<?php

use Skuth\PageAdmin;
use Skuth\Model\Panel;
use Skuth\Model\Sliders;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get("/admin/banners", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  $sliders = new Sliders();

  $s = $sliders->getAll();

  $page = new PageAdmin(["data"=>["page"=>createPage("banners", "banners")]]);

  $page->setTpl("banners", ["sliders"=>$s]);

  return $res;

});

$app->get("/admin/banner/novo", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  $page = new PageAdmin(["data"=>["page"=>createPage("Cadastrando banner", "banner/novo")]]);

  $page->setTpl("banner-cad");

  return $res;

});

$app->post("/admin/banner/novo", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  if (isset($_POST["save"])) {

    $desc = $_POST["descricao"];
    $href = $_POST["href"];
    $status = $_POST["status"];
    $pic = uploadImage($_FILES["banner"], "banner");

    $sliders = new Sliders();

    if ($sliders->cadSlider($pic, $desc, $href, $status) == true) {
      return $res->withHeader("Location", "/admin/banners?cad=true");
    } else {
      deleteImage($pic, "banner");
      return $res->withHeader("Location", "/admin/banners?cad=false");
    }

  }

  return $res;

});

$app->get("/admin/banner/editar/{id}", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  $id = $args["id"];

  $sliders = new Sliders();

  $s = $sliders->getById($id);
  
  $page = new PageAdmin(["data"=>["page"=>createPage("Editando Banner", "banner/editar/".$id)]]);

  $page->setTpl("banner-edit", ["banner"=>$s]);

  return $res;

});

$app->post("/admin/banner/editar", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  if (isset($_POST["save"])) {
    $id = $_POST["id"];

    $desc = $_POST["descricao"];
    $href = $_POST["href"];
    $status = $_POST["status"];
    $pic = $_FILES["banner"];

    $sliders = new Sliders();
    $oldPic = $sliders->getById($id)["slider_img"];

    if ($pic["error"] != 0) {
      $pic = $oldPic;
    } else {
      $pic = uploadImage($pic, "banner");
    }

    if ($sliders->editSlider($id, $pic, $desc, $href, $status) == true) {
      if ($pic != $oldPic) {
        deleteImage($oldPic, "banner");
      }
      return $res->withHeader("Location", "/admin/banners?edit=true");
    } else {
      if ($pic != $oldPic) {
        deleteImage($pic, "banner");
      }
      return $res->withHeader("Location", "/admin/banners?edit=false");
    }
  }

  return $res;

});

$app->get("/admin/banner/remover/{id}", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  $id = $args["id"];

  $sliders = new Sliders();
  $s = $sliders->removeSlider($id);

  if ($s["status"] == true) {
    deleteImage($s["pic"], "banner");
    return $res->withHeader("Location", "/admin/banners?remove=true");
  } else {
    return $res->withHeader("Location", "/admin/banners?remove=false");
  }

  return $res;

});



?>