<?php

namespace Skuth\Model;
use Skuth\DB\Sql;

class Clients {

  CONST CLIENT = "client";
  const SECRET = "2matacado-clientes";

  private function parseReturn($status, $message) {
    $r = [
      "status"=>$status,
      "message"=>$message
    ];

    return $r;
  }

  public function login($login, $password) {
    $sql = new Sql();

    $query = "SELECT client_id, client_password, client_status, client_name FROM clients WHERE client_cnpj=:login OR client_cpf=:login LIMIT 1";
    $param = [
      "login"=>$login
    ];

    $res = $sql->select($query, $param);

    if (count($res) > 0) {

      if (password_verify($password, $res[0]["client_password"])) {
        
        $user = $res[0];

        if ($user["client_status"] == 1) {
          // login
          $q = "UPDATE clients SET client_last_connect=now(), client_last_ip_connect=:client_last_ip_connect WHERE client_id=:id";
          $p = ["id"=>$user["client_id"], "client_last_ip_connect"=>$_SERVER['REMOTE_ADDR']];
          $sql->query($q, $p);

          $_SESSION[self::CLIENT] = [
            "client_id"=>$user["client_id"],
            "client_name"=>$user["client_name"]
          ];

          return $this->parseReturn("success", "Logado com sucesso!");
        } else {
          return $this->parseReturn("error", "Conta não ativada!");
        }

      } else {
        return $this->parseReturn("error", "Senha incorreta!");
      }

    } else {
      return $this->parseReturn("error", "Cpf ou Cnpj inválidos!");
    }

  }

  public function getAddress() {
    $sql = new Sql();

    if (isset($_SESSION[self::CLIENT])) {
      $id = $_SESSION[self::CLIENT]["client_id"];

      $query = "SELECT * FROM client_address WHERE client_id=:id LIMIT 1";
      $param = ["id"=>$id];

      $res = $sql->select($query, $param);
      
      if (count($res) > 0) {
        return $res[0];
      } else {
        return [
          "client_address_id"=>0
        ];
      }
    } else {
      return $this->parseReturn("error", "Você precisa estar logado!");
    }
  }

  public function getAddressById($id) {
    $sql = new Sql();
    
    $query = "SELECT * FROM client_address WHERE client_id=:id LIMIT 1";
    $param = ["id"=>$id];
    
    $res = $sql->select($query, $param);
    
    if (count($res) > 0) {
      return $res[0];
    } else {
      return [
        "client_address_id"=>0
      ];
    }
  }

  public static function getClients($param) {
    $sql = new Sql();

    $query = "SELECT client_id, client_name, client_cnpj, client_ie, client_cpf, client_address, client_type, client_status, client_last_connect, client_last_ip_connect FROM clients ".$param;

    $count = $sql->select("SELECT count(client_id) FROM clients ".$param);

    if (count($count) > 0) {
      $count = $count[0]["count(client_id)"];
    } else {
      $count = 0;
    }

    return ["clients"=>$sql->select($query), "count"=>$count];
  }

  public static function generateRegisterKey() {
    $sql = new Sql();
  
    $date = getdate();
    $date = date("dmYHis", $date[0]);

    $opts = [
      "cost"=>12
    ];

    $key = base64_encode(password_hash($date.Clients::SECRET, PASSWORD_BCRYPT, $opts));

    $query = "INSERT INTO client_register_key (register_key) VALUES (:key)";

    $res = $sql->query($query, ["key"=>$key]);

    if ($res == true) {
      return getSiteUrl()."/cliente/cadastrar?chave=".$key;
    } else {
      return false;
    }
  }

  public function registerKeyVerify($key = "") {
    $sql = new Sql();

    if ($key == "") return $this->parseReturn("error", "Você precisa informar uma chave para se registrar!");

    $query = "SELECT * FROM client_register_key WHERE register_key=:key LIMIT 1";
    $param = ["key"=>$key];

    $res = $sql->select($query, $param);

    if (count($res) > 0) {
      $res = $res[0];

      $date = strtotime($res["register_date"]);

      $now = strtotime("now");
      $days = strtotime("+1 day");

      $time = $days - $now;

      $date += $time;

      $verify = ($now < $date);

      if ($verify == false) {
        $q = "DELETE FROM client_register_key WHERE register_id=:id";
        $sql->query($q, ["id"=>$res["register_id"]]);

        return $this->parseReturn("error", "Chave expirada!");
      }

      return $this->parseReturn("success", "Chave válida!");
    } else {
      return $this->parseReturn("error", "Chave não encontrada!");
    }
  }
}

// $opts = [
//   "cost"=>12
// ];

// $pass = password_hash($res[0]["client_password"], PASSWORD_BCRYPT, $opts);

?>