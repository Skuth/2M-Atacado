<?php

namespace Skuth\Model;
use Skuth\DB\Sql;

class Products {
  private function parseImage($list): array {
    foreach ($list as $key => $value) {
      if (isset($list[$key]["product_pictures"]) && $list[$key]["product_pictures"] !== NULL) {
        $pics = [];

        $picList = explode(",", $list[$key]["product_pictures"]);

        foreach ($picList as $k => $v) {
          array_push($pics, $v);
        }

        $list[$key]["product_pictures"] = $pics;
      }
    }

    return $list;
  }

  public function getAll() {
    $sql = new Sql();

    $query = "SELECT * FROM products";

    $res = $sql->select($query);
    $res = $this->parseImage($res);

    return $res;
  }

  public function getAllFull() {
    $sql = new Sql();

    $query = "SELECT * FROM products
    INNER JOIN distributors a ON a.distributor_id=products.brand_id
    INNER JOIN category b ON b.category_id=products.category_id
    INNER JOIN departments c ON c.department_id=products.department_id";

    $res = $sql->select($query);
    $res = $this->parseImage($res);

    return $res;
  }

  public function getById($id) {
    $sql = new Sql();

    $query = "SELECT * FROM products WHERE product_id=:id LIMIT 1";

    $param = ["id"=>$id];

    $res = $sql->select($query, $param);
    $res = $this->parseImage($res);
    
    if (count($res) > 0) {
      return $res[0];
    } else {
      return $res;
    }
  }

  public function getByIdFull($id) {
    $sql = new Sql();

    $query = "SELECT * FROM products
    INNER JOIN distributors a ON a.distributor_id=products.brand_id
    INNER JOIN category b ON b.category_id=products.category_id
    INNER JOIN departments c ON c.department_id=products.department_id
    WHERE product_id=:id LIMIT 1";

    $param = ["id"=>$id];
    
    $res = $sql->select($query, $param);
    $res = $this->parseImage($res);
    
    if (count($res) > 0) {
      return $res[0];
    } else {
      return $res;
    }
  }
}

?>