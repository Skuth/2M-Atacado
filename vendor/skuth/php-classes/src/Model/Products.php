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

  public function getTotal() {
    $sql = new Sql();

    return $sql->select("SELECT count(product_id) FROM products")[0]["count(product_id)"];
  }

  public function getAll($param = "") {
    $sql = new Sql();

    $query = "SELECT * FROM products ".$param;

    $res = $sql->select($query);
    $res = $this->parseImage($res);

    return $res;
  }

  public function getAllFull($params = "") {
    $sql = new Sql();

    $query = "SELECT * FROM products
    INNER JOIN distributors a ON a.distributor_id=products.brand_id
    INNER JOIN category b ON b.category_id=products.category_id
    INNER JOIN departments c ON c.department_id=products.department_id ".$params;

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

  public function cadPromo($id, $price, $date, $stock) {
    $sql = new Sql();

    $query = "UPDATE products SET product_price_off=:price, product_price_off_days=:date, product_stock_quantity_off=:stock WHERE product_id=:id";

    $params = [
      "id"=>$id,
      "price"=>$price,
      "date"=>$date,
      "stock"=>$stock
    ];

    return $sql->query($query, $params);
  }

  public function removePromo($id) {
    return $this->cadPromo($id, NULL, NULL, NULL);
  }

  public function editProd($id, $nome, $dist, $ref, $cat, $dep, $desc, $pics, $price, $stock) {
    $sql = new Sql();

    $p = $this->getById($id)["product_pictures"];

    if ($pics == NULL) {
      $pics = $p;
      $pics = implode(",", $pics);
    }

    $query = "UPDATE products SET product_name=:nome, brand_id=:dist, product_ref=:ref, category_id=:cat, department_id=:dep, product_description=:desc, product_pictures=:pics, product_price=:price, product_stock=:stock WHERE product_id=:id";
    $params = [
      "id"=>$id,
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

  public function removeProd($id) {
    $sql = new Sql();

    $prod = $this->getById($id);

    $pics = $prod["product_pictures"];

    $query = "DELETE FROM products WHERE product_id=:id";
    $param = ["id"=>$id];

    return [
      "status"=>$sql->query($query, $param),
      "pics"=>$pics
    ];
  }
}

?>