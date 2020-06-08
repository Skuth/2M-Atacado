<?php

namespace Skuth\Model;
use Skuth\DB\Sql;

class SiteData {
  public function getData() {
    $sql = new Sql();
    $query = "SELECT * FROM site_data WHERE site_data_id=:id LIMIT 1";
    $res = $sql->select($query, ["id"=>1]);
    if (count($res) > 0) {
      $pics = $res[0]["site_data_pictures"];
      $pics = explode(",", $pics);
      if (isset($pics[0]) && count($pics) == 1 && $pics[0] == "") {
        $pics = [];
      }
      $res[0]["site_data_pictures"] = $pics;
      return $res[0];
    } else {
      return $res;
    }
  }
}

?>