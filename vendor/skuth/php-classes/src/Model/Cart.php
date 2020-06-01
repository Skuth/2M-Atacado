<?php

namespace Skuth\Model;
use Skuth\DB\Sql;

class Cart {
  public static function getCartItem($id) {
    $sql = new Sql();
    $query = "SELECT * FROM cart WHERE client_session=:id LIMIT 1";
    $param = ["id"=>$id];
    $r = $sql->select($query, $param);

    if (count($r) > 0) {
      return $r[0];
    } else {
      return $r;
    }
  }

  public static function createCartItem($id, $pid, $pq, $pp, $ct) {
    $sql = new Sql();
    $query = "INSERT INTO cart
    (client_session, products_id, products_quantity, products_price, cart_total)
    VALUES(:id, :pid, :pq, :pp, :ct)";
    $params = [
      "id"=>$id,
      "pid"=>$pid,
      "pq"=>$pq,
      "pp"=>$pp,
      "ct"=>$ct
    ];
    
    $sql->query($query, $params);
  }

  public static function updateCartItem($id, $pid, $pq, $pp, $ct) {
    $sql = new Sql();
    $query = "UPDATE cart SET products_id=:pid, products_quantity=:pq, products_price=:pp, cart_total=:ct WHERE client_session=:id";
    $params = [
      "id"=>$id,
      "pid"=>$pid,
      "pq"=>$pq,
      "pp"=>$pp,
      "ct"=>$ct
    ];

    $sql->query($query, $params);
  }

  public static function removeCartItem($id) {
    $sql = new Sql();
    $query = "DELETE FROM cart WHERE client_session=:id";
    $param = ["id"=>$id];
    
    $sql->query($query, $param);
  }
}

?>