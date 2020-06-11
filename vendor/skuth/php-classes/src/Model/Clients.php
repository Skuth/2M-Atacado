<?php

namespace Skuth\Model;
use Skuth\DB\Sql;

class Clients {
  public function login($login, $password) {
    $sql = new Sql();

    $query = "SELECT * FROM clients WHERE client_cnpj=:login OR client_cpf=:login LIMIT 1";
    $param = [
      "login"=>$login
    ];

    $res = $sql->select($query, $param);
    
    var_dump($res[0]);

    if (count($res) > 0) {
      if (password_verify($password, $res[0]["client_password"])) {
        var_dump(TRUE);   
      } else {
        // erro de senha
        var_dump(FALSE);
      }
    } else {
      // erro cpf ou cnpj
    }

  }
}

// $opts = [
//   "cost"=>12
// ];

// $pass = password_hash($res[0]["client_password"], PASSWORD_BCRYPT, $opts);

?>