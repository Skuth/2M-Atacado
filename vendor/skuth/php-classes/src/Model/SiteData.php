<?php

namespace Skuth\Model;
use Skuth\DB\Sql;

class SiteData {
  public function getAll() {
    $sql = new Sql();
    $query = "SELECT * FROM site_data";
    return $sql->select($query);
  }
}

?>