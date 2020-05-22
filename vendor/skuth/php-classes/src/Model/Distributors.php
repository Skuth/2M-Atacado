<?php

namespace Skuth\Model;
use Skuth\DB\Sql;

class Distributors {
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