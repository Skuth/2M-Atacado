<?php

use Skuth\PageAdmin;
use Skuth\Model\Panel;
use Skuth\Model\Distributors;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get("/admin/distribuidores", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  $page = new PageAdmin(["data"=>["page"=>createPage("distribuidores", "distribuidores")]]);

  $dist = new Distributors();

  $d = $dist->getAll();

  $page->setTpl("distributors", ["distribuidores"=>$d]);

  return $res;

});

$app->get("/admin/distribuidor/novo", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  $page = new PageAdmin(["data"=>["page"=>createPage("Cadastrando distribuidor", "distribuidor/novo")]]);

  $page->setTpl("dist-cad");

  return $res;

});

$app->post("/admin/distribuidor/novo", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");
  
  $fileFolder = $_SERVER["DOCUMENT_ROOT"]."/assets/distribuidores/";

  if (isset($_POST["save"])) {

    $name = $_POST["distribuidor"];
    $address = $_POST["endereco"];
    $href = $_POST["href"];
    $desc = filterDesc($_POST["descricao"]);
    $logo = uploadImage($_FILES["logo"], "distribuidores");
    $banner = uploadImage($_FILES["banner"], "distribuidores");

    
    $fotos = $_FILES["fotos"];
    $pics = [];
    
    if (strlen($fotos["name"][0]) > 0) {
      for ($i=0; $i < count($fotos["name"]); $i++) { 
        $pic = [
          "name"=>$fotos["name"][$i],
          "type"=>$fotos["type"][$i],
          "tmp_name"=>$fotos["tmp_name"][$i],
          "error"=>$fotos["error"][$i],
          "size"=>$fotos["size"][$i],
        ];
        
        array_push($pics, uploadImage($pic, "distribuidores"));
      }
    }

    if (count($pics) > 0) {
      $pics = implode(",", $pics);
    } else {
      $pics = NULL;
    }

    $distribuitor = new Distributors();

    if ($distribuitor->cadDist($name, $address, $href, $desc, $logo, $banner, $pics) == true) {
      return $res->withHeader("Location", "/admin/distribuidores?cad=true");
    } else {
      deleteImage($logo, "distribuidores");
      deleteImage($banner, "distribuidores");

      if ($pics !== NULL) {
        $pics = explode(",", $pics);

        for ($i=0; $i < count($pics); $i++) { 
          deleteImage($pics[$i], "distribuidores");
        }
      }

      return $res->withHeader("Location", "/admin/distribuidores?cad=false");
    }
    
  }

  return $res;

});

$app->get("/admin/distribuidor/editar/{id}", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  $id = $args["id"];

  $distribuitor = new Distributors();
  $dist = $distribuitor->getById($id);

  $dist["distributor_description"] = parseDesc($dist["distributor_description"]);

  $page = new PageAdmin(["data"=>["page"=>createPage("Editando distribuidor", "distribuidor/editar/".$id)]]);

  $page->setTpl("dist-edit", ["distribuidor"=>$dist]);

  return $res;

});

$app->post("/admin/distribuidor/editar", function(Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  if (isset($_POST["save"])) {

    $dist = new Distributors();
    $d = $dist->getById($_POST["id"]);

    $id = $_POST["id"];
    $name = $_POST["distribuidor"];
    $address = $_POST["endereco"];
    $href = $_POST["href"];
    $desc = filterDesc($_POST["descricao"]);

    $oldLogo = $d["distributor_logo"];
    $oldBanner = $d["distributor_banner"];
    $oldPictures = $d["distributor_pictures"];

    $logo = ($_FILES["logo"]["error"] != 0) ? $oldLogo : uploadImage($_FILES["logo"], "distribuidores");
    $banner = ($_FILES["banner"]["error"] != 0) ? $oldBanner : uploadImage($_FILES["banner"], "distribuidores");
    $fotos = $_FILES["fotos"];

    $pics = [];

    $oldPics = true;

    if (count($fotos["name"]) > 0 && strlen($fotos["name"][0]) > 0) {
      for ($i=0; $i < count($fotos["name"]); $i++) { 
        $pic = [
          "name"=>$fotos["name"][$i],
          "type"=>$fotos["type"][$i],
          "tmp_name"=>$fotos["tmp_name"][$i],
          "error"=>$fotos["error"][$i],
          "size"=>$fotos["size"][$i],
        ];
        
        $oldPics = false;

        array_push($pics, uploadImage($pic, "distribuidores"));
      }

      

      $pics = implode(",", $pics);
    } else {
      $pics = $oldPictures;
    }

    $distribuitor = new Distributors();

    if ($distribuitor->editDist($id, $name, $address, $href, $desc, $logo, $banner, $pics) == true) {
      if ($oldPics == false) {
        $olds = explode(",", $oldPictures);
        foreach ($olds as $key => $value) {
          deleteImage($value, "distribuidores");
        }
      }
      if ($logo != $oldLogo) {
        deleteImage($oldLogo, "distribuidores");
      }
      if ($banner != $oldBanner) {
        deleteImage($oldBanner, "distribuidores");
      }
      return $res->withHeader("Location", "/admin/distribuidores?edit=true");
    } else {
      if ($logo != $oldLogo) {
        deleteImage($logo, "distribuidores");
      }
      if ($banner != $oldBanner) {
        deleteImage($banner, "distribuidores");
      }
      if ($oldPics == false) {
        $news = explode(",", $pics);
        foreach ($news as $key => $value) {
          deleteImage($value, "distribuidores");
        }
      }
      return $res->withHeader("Location", "/admin/distribuidores?edit=false");
    }

  }

  return $res;

});

$app->get("/admin/distribuidor/remover/{id}", function (Request $req, Response $res, $args) {

  if (Panel::verifyUser() !== true ) return $res->withHeader("Location", "/admin/login");

  if ($_SESSION["user"]["type"] < 2) return $res->withHeader("Location", "/admin/dashboard");

  $id = $args["id"];

  $distribuitor = new Distributors();

  $r = $distribuitor->removeDist($id);

  if ($r["status"] == true) {
    deleteImage($r["logo"], "distribuidores");
    deleteImage($r["banner"], "distribuidores");

    $pics = explode(",", $r["pics"]);

    for ($i=0; $i < count($pics); $i++) { 
      deleteImage($pics[$i], "distribuidores");
    }
    return $res->withHeader("Location", "/admin/distribuidores?remove=true");
  } else {
    return $res->withHeader("Location", "/admin/distribuidores?remove=false");
  }

  return $res;

}); 

?>