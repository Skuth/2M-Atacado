<?php

namespace Skuth\Model;
use Skuth\DB\Sql;

class SiteData {
  public function getData() {
    $sql = new Sql();
    $query = "SELECT * FROM site_data WHERE site_data_id=:id LIMIT 1";
    $res = $sql->select($query, ["id"=>1]);
    if (count($res) > 0) {
      return $res[0];
    } else {
      return $res;
    }
  }
}

?>