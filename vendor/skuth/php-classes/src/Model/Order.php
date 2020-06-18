<?php

namespace Skuth\Model;
use Skuth\DB\Sql;

class Order {
  public static function createOrder($cId, $cart, $oAddr) {
    $sql = new Sql();

    $query = "INSERT INTO `order` (client_id, products_id, products_quantity, products_price, order_subtotal, order_address_id) VALUES (:cId, :pIds, :pQts, :pPrcs, :oSub, :oAddr)";
    $params = [
      "cId"=>intval($cId),
      "pIds"=>$cart["products_id"],
      "pQts"=>$cart["products_quantity"],
      "pPrcs"=>$cart["products_price"],
      "oSub"=>floatval($cart["cart_total"]),
      "oAddr"=>$oAddr,
    ];

    $r = $sql->query($query, $params);

    if ($r === TRUE) {
      $id = explode(",", $cart["products_id"]);

      $q = "UPDATE products SET product_stock = product_stock - ".intval($cart["products_quantity"]).", product_stock_quantity_off = product_stock_quantity_off - ".intval($cart["products_quantity"])." WHERE product_id=:id";
      foreach ($id as $key => $value) {
        $p = ["id"=>$value];
        $sql->query($q, $p);

        $prod = $sql->select("SELECT * FROM products WHERE product_id=:id", ["id"=>$value]);

        if (isset($prod[0])) {
          if ($prod[0]["product_stock_quantity_off"] == 0) {
            $qP = "UPDATE products SET product_price_off = NULL, product_price_off_days = NULL, product_stock_quantity_off = NULL WHERE product_id=:id";
            $pP = ["id"=>$value];
            $sql->query($qP, $pP);
          }
        }
      }
    }

    return $r;
  }

  public static function getByClientId($clientId) {
    $sql = new Sql();

    $query = "SELECT * FROM `order` WHERE client_id=:cId";
    $param = ["cId"=>$clientId];

    return $sql->select($query, $param);
  }
}

?>