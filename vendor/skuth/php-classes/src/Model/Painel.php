<?php

namespace Skuth\Model;
use Skuth\DB\Sql;

class Painel {
  public function login($user, $pass) {
    $user = trim(strip_tags($user));
    $pass = trim(strip_tags($pass));

    if($user !== NULL && $pass !== NULL) {
      $sql = new Sql();
      $query = "SELECT * FROM painel WHERE user=:user && password=:password";
      $params = [
        "user"=>$user,
        "password"=>$pass
      ];

      $res = $sql->select($query, $params);

      if(count($res) > 0) {
        $_SESSION["user"] = [
          "id"=>$res[0]["id"],
          "name"=>$res[0]["name"],
          "type"=>$res[0]["type"]
        ];
        return true;
      } else {
        return false;
      }
    }
  }

  public static function verifyUser() {
    if(!isset($_SESSION["user"])) {
      return false;
    } else {
      return true;
    }
  }

  public function listAll() {
    $sql = new Sql();
    $query = "SELECT id, name, user, type FROM painel";
    return $sql->select($query);
  }
}

?>