<?php

namespace Skuth\Model;
use Skuth\DB\Sql;

class Category {
  public function getAll() {
    $sql = new Sql();
    $query = "SELECT * FROM category";
    return $sql->select($query);
  }

  public function getById($id) {
    $sql = new Sql();
    $query = "SELECT * FROM category WHERE category_id=:id LIMIT 1";
    $param = ["id"=>$id];
    $res = $sql->select($query, $param);
    if (count($res) > 0) {
      return $res[0];
    } else {
      return $res;
    }
  }

  public function cadCat($cat) {
    $sql = new Sql();
    $query = "INSERT INTO category (category_name) VALUES (:cat_name)";
    $param = ["cat_name"=>$cat];
    return $sql->query($query, $param);
  }

  public function editCat($id, $cat) {
    $sql = new Sql();
    $query = "UPDATE category SET category_name=:name WHERE category_id=:id";
    $params = ["name"=>$cat, "id"=>$id];
    return $sql->query($query, $params);
  }

  public function removeCat($id) {
    $sql = new Sql();
    $query = "DELETE FROM category WHERE category_id=:id";
    $param = ["id"=>$id];
    return $sql->query($query, $param);
  }
}

?>