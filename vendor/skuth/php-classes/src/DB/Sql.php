<?php

namespace Skuth\DB;

use Skuth\DB\Config;

class Sql extends Config {
  private $conn;

  public function __construct() {
    $this->conn = new \PDO("mysql:host=".self::HOSTNAME.";dbname=".self::DBNAME, self::USERNAME, self::PASSWORD);
    $this->conn->exec("SET NAMES utf8");
  }

  public function setParams($stmt, $params = array()) {
    foreach ($params as $key => $value) {
      $this->bindParam($stmt, $key, $value);
    }
  }

  public function bindParams($stmt, $key, $value) {
    $stmt->bindparam($key, trim(strip_tags($value)));
  }

  public function query($query, $params = array()) {
    $stmt = $this->conn->prepare($query);
    $this->setParams($stmt, $params);
    $stmt->execute();
  }

  public function select($query, $params = array()) {
    $stmt = $this->conn->prepare($query);
    $this->setParams($stmt, $params);
    $stmt->execute();
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }
}

?>