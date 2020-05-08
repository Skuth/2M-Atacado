<?php

namespace Skuth\Model;
use Skuth\DB\Sql;

class Distributors {
  public function getAll() {
    $sql = new Sql();
    $query = "SELECT * FROM distributors";
    return $sql->select($query);
  }
}

?>