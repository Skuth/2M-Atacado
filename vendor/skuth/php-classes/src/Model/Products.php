<?php

namespace Skuth\Model;
use Skuth\DB\Sql;
use Skuth\Model\Distributors;
use Skuth\Model\Departments;

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

  public function getSum() {
    $sql = new Sql();

    $query = "SELECT SUM(product_views), SUM(product_views_old) FROM products";
    $res = $sql->select($query);

    if (count($res) > 0) {
      return $res[0];
    } else {
      return $res;
    }
  }

  public static function updateViews($ref) {
    $sql = new Sql();

    $query = "UPDATE products SET product_views = product_views + 1 WHERE product_ref=:ref";
    $param = ["ref"=>$ref];

    $sql->query($query, $param);
  }

  public static function updatePrice($ref, $price) {
    $sql = new Sql();

    $query = "UPDATE products SET product_price=:price WHERE product_ref=:ref";
    $param = ["price"=>$price, "ref"=>$ref];

    $sql->query($query, $param);
  }

  public function getTotal() {
    $sql = new Sql();

    return $sql->select("SELECT count(product_id) FROM products")[0]["count(product_id)"];
  }

  public function getPopular($limit = 6) {
    $sql = new Sql();

    $query = "SELECT * FROM products ORDER BY product_views DESC LIMIT ".$limit;

    $res = $sql->select($query);
    $res = $this->parseImage($res);

    return $res;
  }

  public function getAll($param = "") {
    $sql = new Sql();

    $query = "SELECT * FROM products ORDER BY product_id DESC ".$param;

    $res = $sql->select($query);
    $res = $this->parseImage($res);

    return $res;
  }

  public function getAllFull($params = "") {
    $sql = new Sql();

    $query = "SELECT * FROM products
    INNER JOIN distributors a ON a.distributor_id=products.brand_id
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

  public function getByRefFull($ref) {
    $sql = new Sql();

    $query = "SELECT * FROM products
    INNER JOIN distributors a ON a.distributor_id=products.brand_id
    INNER JOIN departments c ON c.department_id=products.department_id
    WHERE product_ref=:ref LIMIT 1";

    $param = ["ref"=>$ref];
    
    $res = $sql->select($query, $param);
    $res = $this->parseImage($res);
    
    if (count($res) > 0) {
      return $res[0];
    } else {
      return $res;
    }
  }

  public function getFullWithCount($params = "", $limite = 6, $pagina = 1) {
    $sql = new Sql();

    if (!is_int($pagina)) {
      $pagina = 1;
    }

    $offset = (($pagina - 1) * $limite);

    $query = "SELECT * FROM products
    INNER JOIN distributors a ON a.distributor_id=products.brand_id
    INNER JOIN departments c ON c.department_id=products.department_id ".$params."
    LIMIT ".$limite." OFFSET ".$offset;

    $res = $sql->select($query);
    $res = $this->parseImage($res);

    $count = $sql->select("SELECT count(1) FROM products");

    if (count($count) <= 0) {
      $count[0] = 0;
    }

    return [$res, $count[0]];
  }

  public function getBySearch($search, $limite = 6, $pagina = 1) {
    $sql = new Sql();

    if (!is_int($pagina)) {
      $pagina = 1;
    }

    $offset = (($pagina - 1) * $limite);

    $query = "SELECT * FROM products
    INNER JOIN distributors a ON a.distributor_id=products.brand_id
    INNER JOIN departments c ON c.department_id=products.department_id
    WHERE (product_name LIKE '%".$search."%') OR (product_ref LIKE '%".$search."%') LIMIT ".$limite." OFFSET ".$offset;

    
    $res = $sql->select($query);
    $res = $this->parseImage($res);

    $count = $sql->select("SELECT count(1) FROM products WHERE product_name LIKE '%$search%' ESCAPE '$'");
    
    if (count($count) <= 0) {
      $count[0] = 0;
    }

    return [$res, $count[0]];
  }

  public function getByDistFull($dist, $limite = 6, $pagina = 1) {
    $sql = new Sql();

    $d = new Distributors();
    $dc = $d->getById($dist);

    if (count($dc) <= 0) {
      return [[], 0];
    }

    if (!is_int($pagina)) {
      $pagina = 1;
    }

    $offset = (($pagina - 1) * $limite);

    $query = "SELECT * FROM products
    INNER JOIN distributors a ON a.distributor_id=products.brand_id
    INNER JOIN departments c ON c.department_id=products.department_id
    WHERE brand_id=:dist LIMIT ".$limite." OFFSET ".$offset;

    $param = ["dist"=>$dist];

    
    $res = $sql->select($query, $param);
    $res = $this->parseImage($res);

    $count = $sql->select("SELECT count(1) FROM products WHERE brand_id=:dist", $param);

    if (count($count) <= 0) {
      $count[0] = 0;
    }

    return [$res, $count[0]];
  }

  public function getByDeptFull($dep, $limite = 6, $pagina = 1) {
    $sql = new Sql();

    $d = new Departments();
    $dc = $d->getById($dep);

    if (count($dc) <= 0) {
      return [[], 0];
    }

    if (!is_int($pagina)) {
      $pagina = 1;
    }

    $offset = (($pagina - 1) * $limite);

    $query = "SELECT * FROM products
    INNER JOIN distributors a ON a.distributor_id=products.brand_id
    INNER JOIN departments c ON c.department_id=products.department_id
    WHERE products.department_id=:dep LIMIT ".$limite." OFFSET ".$offset;

    $param = ["dep"=>$dep];
    
    $res = $sql->select($query, $param);
    $res = $this->parseImage($res);

    $count = $sql->select("SELECT count(1) FROM products WHERE department_id=:dep", $param);

    if (count($count) <= 0) {
      $count[0] = 0;
    }

    return [$res, $count[0]];
    
    return $res;
  }

  public function getByOffers($limite = 6, $pagina = 1) {
    $sql = new Sql();

    if (!is_int($pagina)) {
      $pagina = 1;
    }

    $offset = (($pagina - 1) * $limite);

    $query = "SELECT * FROM products
    INNER JOIN distributors a ON a.distributor_id=products.brand_id
    INNER JOIN departments c ON c.department_id=products.department_id
    WHERE product_price_off IS NOT NULL LIMIT ".$limite." OFFSET ".$offset;
    
    $res = $sql->select($query);
    $res = $this->parseImage($res);

    $count = $sql->select("SELECT count(1) FROM products WHERE product_price_off IS NOT NULL");

    if (count($count) <= 0) {
      $count[0] = 0;
    }

    return [$res, $count[0]];
    
    return $res;
  }
  
  public function cadProd($nome, $ref, $price, $stock, $dist, $dep, $desc, $pics) {
    $sql = new Sql();

    $query = "INSERT INTO products 
    (product_name, brand_id, product_ref, department_id, product_description, product_pictures, product_price, product_stock)
    VALUES (:nome, :dist, :ref, :dep, :desc, :pics, :price, :stock)";

    $params = [
      "nome"=>$nome,
      "dist"=>$dist,
      "ref"=>$ref,
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

  public function editProd($id, $nome, $dist, $ref, $dep, $desc, $pics, $price, $stock) {
    $sql = new Sql();

    $p = $this->getById($id);

    if ($pics == NULL) {
      $pics = $p["product_pictures"];
      $pics = implode(",", $pics);
    }

    if ($price != $p["product_price"]) {
      $this->removePromo($id);
    }

    $query = "UPDATE products SET product_name=:nome, brand_id=:dist, product_ref=:ref, department_id=:dep, product_description=:desc, product_pictures=:pics, product_price=:price, product_stock=:stock WHERE product_id=:id";
    $params = [
      "id"=>$id,
      "nome"=>$nome,
      "dist"=>$dist,
      "ref"=>$ref,
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

  public static function getLowStock() {
    $sql = new Sql();

    $query = "SELECT * FROM products WHERE product_stock <= 5 ORDER BY product_stock ASC";

    $prod = new products();

    $res = $sql->select($query);
    $res = $prod->parseImage($res);

    return $res;
  }

  public static function getViews() {
    $sql = new Sql();

    $query = "SELECT product_id, product_views FROM products";
    
    return $sql->select($query);
  }

  public static function updateProductViews() {
    $sql = new Sql();

    $products = Products::getViews();

    foreach ($products as $key => $value) {
      $query = "UPDATE products SET product_views=0, product_views_old=:views WHERE product_id=:id";
      $params = ["id"=>$value["product_id"], "views"=>$value["product_views"]];
      $sql->query($query, $params);
    }
  }

  public static function updateOffers() {
    $sql = new Sql();

    $off = $sql->select("SELECT product_id, product_price_off_days FROM products WHERE product_price_off_days = CURDATE()");
    
    $p = new Products();

    foreach ($off as $key => $value) {
      $p->removePromo($value["product_id"]);
    }
  }
}

?>