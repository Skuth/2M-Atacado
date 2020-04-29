<?php

namespace Skuth\Model;
use Skuth\DB\Sql;

class Departments {
  public function getAll() {
    $sql = new Sql();
    $query = "SELECT * FROM departments";

    return $sql->select($query);
  }
}

?>