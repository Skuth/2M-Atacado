<?php

namespace Skuth\Model;
use Skuth\DB\Sql;

class Sliders {
  public function getAll() {
    $sql = new Sql();
    $query = "SELECT * FROM sliders ORDER BY slider_id ASC";
    return $sql->select($query);
  }

  public function getById($id) {
    $sql = new Sql();
    $query = "SELECT * FROM sliders WHERE slider_id=:id LIMIT 1";
    $param = ["id"=>$id];
    $res = $sql->select($query, $param);

    if (count($res) > 0) {
      return $res[0];
    } else {
      return $res;
    }
  }

  public function cadSlider($img, $desc, $href, $status) {
    $sql = new Sql();
    $query = "INSERT INTO sliders (slider_img, slider_href, slider_description, slider_status) VALUES (:img, :href, :desc, :status)";
    $params = [
      "img"=>$img,
      "desc"=>$desc,
      "href"=>$href,
      "status"=>$status,
    ];
    
    return $sql->query($query, $params);
  }

  public function editSlider($id, $img, $desc, $href, $status) {
    $sql = new Sql();
    $query = "UPDATE sliders SET slider_img=:img, slider_href=:href, slider_description=:desc, slider_status=:status WHERE slider_id=:id";
    $params = [
      "id"=>$id,
      "img"=>$img,
      "desc"=>$desc,
      "href"=>$href,
      "status"=>$status,
    ];

    return $sql->query($query, $params);
  }

  public function removeSlider($id) {
    $sql = new Sql();

    $pic = $this->getById($id)["slider_img"];
    
    $query = "DELETE FROM sliders WHERE slider_id=:id";
    $param = ["id"=>$id];

    return [
      "status"=>$sql->query($query, $param),
      "pic"=>$pic
    ];
  }
}

?>