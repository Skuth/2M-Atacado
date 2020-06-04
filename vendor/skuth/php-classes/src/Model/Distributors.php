<?php

namespace Skuth\Model;
use Skuth\DB\Sql;

class Distributors {
  private function parseImage($list): array {
    foreach ($list as $key => $value) {
      if (isset($list[$key]["distributor_pictures"]) && $list[$key]["distributor_pictures"] !== NULL) {
        $pics = [];

        $picList = explode(",", $list[$key]["distributor_pictures"]);

        foreach ($picList as $k => $v) {
          array_push($pics, $v);
        }

        $list[$key]["distributor_pictures"] = $pics;
      } else {
        $list[$key]["distributor_pictures"] = [];
      }
    }

    return $list;
  }

  public function getAll() {
    $sql = new Sql();
    $query = "SELECT * FROM distributors";

    return $sql->select($query);
  }

  public function getById($id) {
    $sql = new Sql();
    $query = "SELECT * FROM distributors WHERE distributor_id=:id LIMIT 1";
    $param = ["id"=>$id];
    $res = $sql->select($query, $param);
    $res = $this->parseImage($res);

    if (count($res) > 0) {
      return $res[0];
    } else {
      return $res;
    }
  }

  public function getByUrl($href) {
    $sql = new Sql();
    $query = "SELECT * FROM distributors WHERE distributor_href=:href LIMIT 1";
    $param = ["href"=>$href];
    $res = $sql->select($query, $param);
    $res = $this->parseImage($res);

    if (count($res) > 0) {
      return $res[0];
    } else {
      return $res;
    }
  }

  public function cadDist($name, $address, $href, $desc, $logo, $banner, $pics) {
    $sql = new Sql();
    $query = "INSERT INTO distributors (distributor_name, distributor_address, distributor_description, distributor_banner, distributor_logo, distributor_pictures, distributor_href) VALUES(:name, :address, :desc, :banner, :logo, :pictures, :href)";
    $params = [
      "name"=>$name,
      "address"=>$address,
      "desc"=>$desc,
      "banner"=>$banner,
      "logo"=>$logo,
      "pictures"=>$pics,
      "href"=>$href
    ];
    
    return $sql->query($query, $params);
  }

  public function editDist($id, $name, $address, $href, $desc, $logo, $banner, $pics) {
    $sql = new Sql();
    $query = "UPDATE distributors SET distributor_name=:name, distributor_address=:address, distributor_description=:desc, distributor_banner=:banner, distributor_logo=:logo, distributor_pictures=:pics, distributor_href=:href WHERE distributor_id=:id";
    $params = [
      "id"=>$id,
      "name"=>$name,
      "address"=>$address,
      "desc"=>$desc,
      "banner"=>$banner,
      "logo"=>$logo,
      "pics"=>$pics,
      "href"=>$href
    ];

    return $sql->query($query, $params);
  }

  public function removeDist($id) {
    $sql = new Sql();

    $dist = $this->getById($id);

    $logo = $dist["distributor_logo"];
    $banner = $dist["distributor_banner"];
    $pics = $dist["distributor_pictures"];

    $query = "DELETE FROM distributors WHERE distributor_id=:id";
    $param = ["id"=>$id];

    return [
      "status"=>$sql->query($query, $param),
      "logo"=>$logo,
      "banner"=>$banner,
      "pics"=>$pics
    ];
  }
}

?>