<?php

namespace Skuth\Model;
use Skuth\DB\Sql;

class Departments {
  public function getAll() {
    $sql = new Sql();
    $query = "SELECT * FROM departments ORDER BY department_id ASC";

    return $sql->select($query);
  }

  public function getById($id) {
    $sql = new Sql();
    $query = "SELECT * FROM departments WHERE department_id=:id LIMIT 1";
    $param = ["id"=>$id];
    $res = $sql->select($query, $param);

    if (count($res) > 0) {
      return $res[0];
    } else {
      return $res;
    }
  }

  public function getDepId($href) {
    $sql = new Sql();
    $query = "SELECT * FROM departments WHERE department_href=:href LIMIT 1";
    $param = ["href"=>$href];
    $res = $sql->select($query, $param);

    if (count($res) > 0) {
      return $res[0];
    } else {
      return 0;
    }
  }

  public function getByUrl($href) {
    $sql = new Sql();
    $query = "SELECT * FROM departments WHERE department_href=:href LIMIT 1";
    $param = ["href"=>$href];
    $res = $sql->select($query, $param);
    $res = $this->parseImage($res);

    if (count($res) > 0) {
      return $res[0];
    } else {
      return $res;
    }
  }

  public function cadDep($icon, $dep, $href) {
    $sql = new Sql();
    $query = "INSERT INTO departments (department_icon, department_text, department_href) VALUES (:icon, :dep, :href)";
    $params = [
      "icon"=>$icon,
      "dep"=>$dep,
      "href"=>$href
    ];

    return $sql->query($query, $params);
  }

  public function editDep($id, $icon, $dep, $href) {
    $sql = new Sql();
    $query = "UPDATE departments SET department_icon=:icon, department_text=:dep, department_href=:href WHERE department_id=:id";
    $params = [
      "id"=>$id,
      "icon"=>$icon,
      "dep"=>$dep,
      "href"=>$href,
    ];
    
    return $sql->query($query, $params);
  }

  public function removeDep($id) {
    $sql = new Sql();
    $query = "DELETE FROM departments WHERE department_id=:id";
    $param = ["id"=>$id];
    
    return $sql->query($query, $param);
  }
}

?>