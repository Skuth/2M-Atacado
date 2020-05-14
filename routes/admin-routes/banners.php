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
    $pic = $_FILES["banner"];

    $fileFolder = $_SERVER["DOCUMENT_ROOT"]."/assets/banner/";

    $fileType = explode("/", $pic["type"]);
    $fileError = $pic["error"];

    $fileName = $pic["name"];

    $fileExtension = explode(".", $fileName);
    $fileExtension = $fileExtension[count($fileExtension) - 1];

    $fileTmpName = $pic["tmp_name"];

    $fileNewName = md5(date("dmYHis") . $fileName . $fileTmpName).".".$fileExtension;

    $sliders = new Sliders();

    if ($fileError == 0 && $fileType[0] == "image") {
      if ($fileType[1] == "png" || $fileType[1] == "jpg" || $fileType[1] == "jpeg") {
        if ($sliders->cadSlider($fileNewName, $desc, $href, $status) == true) {
          move_uploaded_file($fileTmpName, $fileFolder.$fileNewName);
          return $res->withHeader("Location", "/admin/banners?cad=true");
        } else {
          return $res->withHeader("Location", "/admin/banners?cad=false");
        }
      } else {
        return $res->withHeader("Location", "/admin/banners?type=false");
      }
    } else {
      return $res->withHeader("Location", "/admin/banners?file=false");
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
  
  $page = new PageAdmin(["data"=>["page"=>createPage("Editando Banner", "banner/novo")]]);

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
    $fileFolder = $_SERVER["DOCUMENT_ROOT"]."/assets/banner/";

    if ($pic["error"] != 0) {
      $pic = $oldPic;
    } else {

      $fileType = explode("/", $pic["type"]);
      $fileError = $pic["error"];

      $fileName = $pic["name"];

      $fileExtension = explode(".", $fileName);
      $fileExtension = $fileExtension[count($fileExtension) - 1];

      $fileTmpName = $pic["tmp_name"];

      $fileNewName = md5(date("dmYHis") . $fileName . $fileTmpName).".".$fileExtension;
    
      if ($fileType[1] == "png" || $fileType[1] == "jpg" || $fileType[1] == "jpeg") {
        $pic = $fileNewName;
        unlink($fileFolder.$oldPic);
        move_uploaded_file($fileTmpName, $fileFolder.$fileNewName);
      } else {
        return $res->withHeader("Location", "/admin/banners?type=false");
      }
    }

    if ($sliders->editSlider($id, $pic, $desc, $href, $status) == true) {
      return $res->withHeader("Location", "/admin/banners?edit=true");
    } else {
      if ($pic != $oldPic) {
        unlink($fileFolder.$pic);
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

  if ($sliders->removeSlider($id) == true) {
    return $res->withHeader("Location", "/admin/banners?remove=true");
  } else {
    return $res->withHeader("Location", "/admin/banners?remove=false");
  }

  return $res;

});



?>