<?php

namespace Skuth\Model;
use Skuth\DB\Sql;

class Clients {
  CONST CLIENT = "client";

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
}

// $opts = [
//   "cost"=>12
// ];

// $pass = password_hash($res[0]["client_password"], PASSWORD_BCRYPT, $opts);

?>