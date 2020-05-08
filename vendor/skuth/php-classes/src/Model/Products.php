<?php

namespace Skuth\Model;
use Skuth\DB\Sql;

class Products {
  public function getAll() {
    $sql = new Sql();
    $query = "SELECT * FROM products";
    return $sql->select($query);
  }
}

?>