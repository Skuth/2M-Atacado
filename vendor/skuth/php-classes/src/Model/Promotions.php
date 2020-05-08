<?php

namespace Skuth\Model;
use Skuth\DB\Sql;

class Promotions {
  public function getAll() {
    $sql = new Sql();
    $query = "SELECT * FROM promotions";
    return $sql->select($query);
  }
}

?>