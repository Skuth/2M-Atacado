<?php

namespace Skuth\Model;

use Skuth\DB\Sql;

class Sliders {
  public function getAll() {
    $sql = new Sql();
    $query = "SELECT * FROM sliders";
    return $sql->select($query);
  }
}

?>