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

  public static function verifyLogin($on = 1) {
    if ($on == 1) {
      if (isset($_SESSION["client"])) {
        return true;
      } else {
        return false;
      }
    } elseif ($on == 0) {
      if (!isset($_SESSION["client"])) {
        return true;
      } else {
        return false;
      }
    }
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

  public static function cadAddress($values) {
    $sql = new Sql();

    if (isset($_SESSION[self::CLIENT])) {

      $id = $_SESSION[self::CLIENT]["client_id"];

      $query = "INSERT INTO client_address
      (client_id, client_address_name, client_address_contact, client_address_cep, client_address_cidade, client_address_bairro, client_address_rua, client_address_numero, client_address_complemento)
      VALUES(:id, :nome, :contato, :cep, :cidade, :bairro, :rua, :numero, :compemento)";

      $params = ["id"=>$id];

      foreach ($values as $key => $value) {
        $params[$key] = $value;
      }

      return $sql->query($query, $params);
    }
  }

  public static function getClients($param) {
    $sql = new Sql();

    $query = "SELECT client_id, client_name, client_cnpj, client_ie, client_cpf, client_address, client_email, client_phone, client_type, client_status, client_last_connect, client_last_ip_connect, client_points FROM clients ORDER BY client_id DESC ".$param;

    $count = $sql->select("SELECT count(client_id) FROM clients");

    if (count($count) > 0) {
      $count = $count[0]["count(client_id)"];
    } else {
      $count = 0;
    }

    return ["clients"=>$sql->select($query), "count"=>$count];
  }

  public static function getClientsDisableds($param) {
    $sql = new Sql();

    $query = "SELECT client_id, client_name, client_cnpj, client_ie, client_cpf, client_address, client_email, client_phone, client_type, client_status, client_last_connect, client_last_ip_connect, client_points FROM clients WHERE client_status=0 ORDER BY client_id DESC ".$param;

    $count = $sql->select("SELECT count(client_id) FROM clients WHERE client_status=0");

    if (count($count) > 0) {
      $count = $count[0]["count(client_id)"];
    } else {
      $count = 0;
    }

    return ["clients"=>$sql->select($query), "count"=>$count];
  }

  public static function getClientOn() {
    $sql = new Sql();

    if (isset($_SESSION[self::CLIENT])) {

      $id = $_SESSION[self::CLIENT]["client_id"];

      $query = "SELECT client_id, client_name, client_cnpj, client_ie, client_cpf, client_address, client_email, client_phone, client_type, client_status, client_last_connect, client_last_ip_connect, client_points FROM clients WHERE client_id=:id LIMIT 1";
      $param = ["id"=>$id];
      
      $res = $sql->select($query, $param);
      
      if (count($res) > 0) {
        return $res[0];
      } else {
        return $res;
      }
    }
  }

  public static function getClientById($id) {
    $sql = new Sql();

    $query = "SELECT client_id, client_name, client_cnpj, client_ie, client_cpf, client_address, client_email, client_phone, client_type, client_status, client_last_connect, client_last_ip_connect, client_points FROM clients WHERE client_id=:id LIMIT 1";
    $param = ["id"=>$id];
    
    $res = $sql->select($query, $param);
    
    if (count($res) > 0) {
      return $res[0];
    } else {
      return $res;
    }
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

  public function cadClient($key, $data) {
    $k = $this->registerKeyVerify($key);
    $k["status"] = "success";

    if ($k["status"] == "error") return $k;

    $type = $data["type"];
    $name = $data["nome"];
    $cnpj = (isset($data["cnpj"])) ? parseCpfCnpj($data["cnpj"]) : "";
    $ie = (isset($data["ie"])) ? parseCpfCnpj($data["ie"]) : "";
    $cpf = (isset($data["cpf"])) ? parseCpfCnpj($data["cpf"]) : "";
    $email = $data["email"];
    $phone = $data["phone"];
    $password = $data["password"];

    if ($type == 0) {
      if (strlen($cpf) !== 11) {
        return $this->parseReturn("error", "Cpf inválido!");
      }
    }

    if ($type == 1) {
      if (strlen($cnpj) !== 14) {
        return $this->parseReturn("error", "Cnpj inválido!");
      }
    }

    $sql = new Sql();

    $emailVerify = $sql->select("SELECT client_email FROM clients WHERE client_email=:email LIMIT 1", ["email"=>$email]);

    if (count($emailVerify) > 0 && $emailVerify[0]["client_email"] == $email) return $this->parseReturn("error", "E-mail já registrado!");

    $opts = [
      "cost"=>12
    ];

    $password = password_hash($password, PASSWORD_BCRYPT, $opts);
    
    if ($type == 1) {
      $cnpjVerify = $sql->select("SELECT client_cnpj FROM clients WHERE client_cnpj=:cnpj LIMIT 1", ["cnpj"=>$cnpj]);
      
      if (count($cnpjVerify) > 0 && $cnpjVerify[0]["client_cnpj"] == $cnpj) return $this->parseReturn("error", "Cnpj já registrado!");
   
      $query = "INSERT INTO clients (client_name, client_cnpj, client_ie, client_password, client_email, client_phone, client_type)
      VALUES (:name, :cnpj, :ie, :pass, :email, :phone, :type)";
      
      $params = [
        "name"=>$name,
        "cnpj"=>$cnpj,
        "ie"=>$ie,
        "pass"=>$password,
        "email"=>$email,
        "phone"=>$phone,
        "type"=>$type
      ];
    } else {
      $cpfVerify = $sql->select("SELECT client_cpf FROM clients WHERE client_cpf=:cpf LIMIT 1", ["cpf"=>$cpf]);

      if (count($cpfVerify) > 0 && $cpfVerify[0]["client_cpf"] == $cpf) return $this->parseReturn("error", "Cpf já registrado!");

      $query = "INSERT INTO clients (client_name, client_cpf, client_password, client_email, client_phone, client_type)
      VALUES (:name, :cpf, :pass, :email, :phone, :type)";

      $params = [
        "name"=>$name,
        "cpf"=>$cpf,
        "pass"=>$password,
        "email"=>$email,
        "phone"=>$phone,
        "type"=>$type
      ];
    }

    if ($sql->query($query, $params) == true) {
      $q = "DELETE FROM client_register_key WHERE register_key=:key";
      $p = ["key"=>$key];
      $sql->query($q, $p);

      return $this->parseReturn("success", "Cliente cadastrado com sucesso!");
    } else {
      return $this->parseReturn("error", "Falha ao cadastrar cliente!");
    }
  }

  public function editClient($id, $data) {
    $sql = new Sql();

    $name = $data["nome"];
    $cnpj = (isset($data["cnpj"])) ? formatString($data["cnpj"]) : NULL;
    $ie = (isset($data["ie"])) ? formatString($data["ie"]) : NULL;
    $cpf = (isset($data["cpf"])) ? formatString($data["cpf"]) : NULL;
    $email = $data["email"];
    $phone = formatString($data["phone"]);
    $password = $data["pass"];

    $query = "UPDATE clients SET client_name=:nome, client_cnpj=:cnpj, client_ie=:ie, client_cpf=:cpf, client_email=:email, client_phone=:phone WHERE client_id=:id";

    $params = [
      ":nome"=>$name,
      ":cnpj"=>$cnpj,
      ":ie"=>$ie,
      ":cpf"=>$cpf,
      ":email"=>$email,
      ":phone"=>$phone,
      ":id"=>$id
    ];

    $pe = $this->editPassword($id, $password);

    if ($pe["status"] != "error") {

      if ($sql->query($query, $params) == TRUE) {  
        return true;
      } else {
        return false;
      }

    } else {
      return $pe;
    }
  }

  public function editPassword($id, $pass) {
    $sql = new Sql();

    if ($pass == "password") return $this->parseReturn("info", "Nada alterado!");

    $opts = [
      "cost"=>12
    ];

    $pass = password_hash($pass, PASSWORD_BCRYPT, $opts);

    $query = "UPDATE clients SET client_password=:pass WHERE client_id=:id";

    $params = [
      "id"=>$id,
      "pass"=>$pass
    ];

    if ($sql->query($query, $params) == TRUE) {
      return $this->parseReturn("success", "Senha alterada com sucesso!");
    } else {
      return $this->parseReturn("error", "Falha ao alterar a senha!");
    }
  }

  public function removeClient($id) {
    $sql = new Sql();

    $query = "DELETE FROM clients WHERE client_id=:id";
    $param = ["id"=>$id];

    if ($sql->query($query, $param) == TRUE) {
      return $this->parseReturn("success", "Usuário removido com sucesso!");
    } else {
      return $this->parseReturn("error", "Falha ao remover usuário!");
    }
  }

  public function activateClient($id) {
    $sql = new Sql();

    $query = "UPDATE clients SET client_status=:status WHERE client_id=:id";
    $params = ["status"=>1, "id"=>$id];

    $res = $sql->query($query, $params);

    if ($res == TRUE) {
      return $this->parseReturn("success", "Usuário ativado com sucesso!");
    } else {
      return $this->parseReturn("error", "Falha ao ativar usuário!");
    }
  }

  public function deactivateClient($id) {
    $sql = new Sql();

    $query = "UPDATE clients SET client_status=:status WHERE client_id=:id";
    $params = ["status"=>0, "id"=>$id];

    $res = $sql->query($query, $params);

    if ($res == TRUE) {
      return $this->parseReturn("success", "Usuário desativado com sucesso!");
    } else {
      return $this->parseReturn("error", "Falha ao desativar usuário!");
    }
  }

  public static function countClients() {
    $sql = new Sql();

    $count = $sql->select("SELECT count(*) FROM clients");

    if (count($count) > 0) {
      return $count[0]["count(*)"];
    } else {
      return 0;
    }
  }

  public static function addPoints($id, $points) {
    $sql = new Sql();

    $points = intval($points);

    $q = "UPDATE clients SET client_points=client_points+:points WHERE client_id=:id";
    $p = ["points"=>$points, "id"=>$id];
    $sql->query($q, $p);
  }
}

?>