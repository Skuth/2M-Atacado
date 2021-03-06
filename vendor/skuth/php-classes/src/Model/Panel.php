<?php

namespace Skuth\Model;
use Skuth\DB\Sql;

class Panel {
  public function login($user, $pass) {
    $user = trim(strip_tags($user));
    $pass = trim(strip_tags($pass));

    if($user !== NULL && $pass !== NULL) {
      $sql = new Sql();
      $query = "SELECT id, fname, lname, type, password FROM panel WHERE user=:user LIMIT 1";
      $params = [
        "user"=>$user
      ];

      $res = $sql->select($query, $params);

      if(count($res) > 0 && password_verify($pass, $res[0]["password"])) {
        $res = $res[0];
        $_SESSION["user"] = [
          "id"=>$res["id"],
          "name"=>$res["fname"]." ".$res["lname"],
          "type"=>$res["type"]
        ];

        $q = "UPDATE panel SET last_connect=now(), last_ip_connect=:last_ip_connect WHERE id=:id";
        $p = ["id"=>$res["id"], "last_ip_connect"=>$_SERVER['REMOTE_ADDR']];
        $sql->query($q, $p);

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
    $query = "SELECT id, fname, lname, user, type, last_connect, last_ip_connect FROM panel";
    return $sql->select($query);
  }

  public function getUserById($id) {
    $sql = new Sql();
    $query = "SELECT id, fname, lname, user, password, type FROM panel WHERE id=:id LIMIT 1";
    $param = ["id"=>$id];
    $res = $sql->select($query, $param);
    if (isset($res[0])) {
      return $res[0];
    } else {
      return $res;
    }
  }

  public function cadUser($fname, $lname, $user, $pass, $type) {
    $sql = new Sql();

    $opts = [
      "cost"=>12
    ];

    $pass = password_hash($pass, PASSWORD_BCRYPT, $opts);

    $query = "INSERT INTO panel (fname, lname, user, password, type, last_ip_connect) VALUES (:fname, :lname, :user, :password, :type, :last_ip_connect)";
    $params = [
      "fname"=>$fname,
      "lname"=>$lname,
      "user"=>$user,
      "password"=>$pass,
      "type"=>$type,
      "last_ip_connect"=>$_SERVER['REMOTE_ADDR']
    ];

    return $sql->query($query, $params);
  }

  public function editUser($id, $fname, $lname, $user, $pass, $type) {
    $sql = new Sql();

    if ($pass == NULL) {
      $r = $sql->select("SELECT password FROM panel WHERE id=:id LIMIT 1", ["id"=>$id]);
      $pass = $r[0]["password"];
    }

    $opts = [
      "cost"=>12
    ];

    $pass = password_hash($pass, PASSWORD_BCRYPT, $opts);

    $query = "UPDATE panel SET fname=:fname, lname=:lname, user=:user, password=:pass, type=:type WHERE id=:id";
    $params = [
      "id"=>$id,
      "fname"=>$fname,
      "lname"=>$lname,
      "user"=>$user,
      "pass"=>$pass,
      "type"=>$type
    ];

    return $sql->query($query, $params);
  }

  public function removeUser($id) {
    $sql = new Sql();
    $query = "DELETE FROM panel WHERE id=:id";
    $param = ["id"=>$id];
    return $sql->query($query, $param);
  }
}

?>