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

  public function getAll($param = "") {
    $sql = new Sql();

    $query = "SELECT * FROM products ".$param;

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

  public function cadProd($nome, $ref, $price, $stock, $dist, $dep, $cat, $desc, $pics) {
    $sql = new Sql();

    $query = "INSERT INTO products 
    (product_name, brand_id, product_ref, category_id, department_id, product_description, product_pictures, product_price, product_stock)
    VALUES (:nome, :dist, :ref, :cat, :dep, :desc, :pics, :price, :stock)";

    $params = [
      "nome"=>$nome,
      "dist"=>$dist,
      "ref"=>$ref,
      "cat"=>$cat,
      "dep"=>$dep,
      "desc"=>$desc,
      "pics"=>$pics,
      "price"=>$price,
      "stock"=>$stock
    ];

    return $sql->query($query, $params);
  }
}

?>