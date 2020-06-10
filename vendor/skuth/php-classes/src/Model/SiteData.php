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

  public function updateData($address, $cnpj, $ie, $tel, $email, $hf) {
    $sql = new Sql();

    $query = "UPDATE site_data SET site_data_address=:address, site_data_cnpj=:cnpj, site_data_ie=:ie, site_data_tel=:tel, site_data_email=:email, site_data_oh=:hf WHERE site_data_id=:id";
    $params = [
      "address"=>$address,
      "cnpj"=>$cnpj,
      "ie"=>$ie,
      "tel"=>$tel,
      "email"=>$email,
      "hf"=>$hf,
      "id"=>1
    ];

    return $sql->query($query, $params);
  }
}

?>