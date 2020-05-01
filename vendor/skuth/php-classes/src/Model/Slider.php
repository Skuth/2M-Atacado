<?php

namespace Skuth\Model;

use Skuth\DB\Sql;

class Slider {
  public function getAll() {
    $sql = new Sql();
    $query = "SELECT * FROM slider";
    return $sql->select($query);
  }
}

?>