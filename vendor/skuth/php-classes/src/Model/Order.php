<?php

namespace Skuth\Model;
use Skuth\DB\Sql;
use Skuth\Model\Products;

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

    $query = "SELECT * FROM `order` WHERE client_id=:cId ORDER BY order_id DESC";
    $param = ["cId"=>$clientId];

    $r = $sql->select($query, $param);

    return $r;
  }

  public static function getByClientIdFull($clientId) {
    $sql = new Sql();
    $products = new Products();

    $query = "SELECT * FROM `order` WHERE client_id=:cId ORDER BY order_id DESC";
    $param = ["cId"=>$clientId];

    $r = $sql->select($query, $param);

    foreach ($r as $key => $value) {
      $r[$key]["produtos"] = [];
      $ids = explode(",", $value["products_id"]);
      $qts = explode(",", $value["products_quantity"]);
      $pp = explode(",", $value["products_price"]);

      $clientInfo = $sql->select("SELECT client_name, client_phone FROM clients WHERE client_id=:id", ["id"=>$value["client_id"]]);

      if (count($clientInfo) > 0) {
        $r[$key]["client_name"] = $clientInfo[0]["client_name"];
        $r[$key]["client_phone"] = $clientInfo[0]["client_phone"];
      } else {
        $r[$key]["client_name"] = "Cliente Id ".$r["client_id"];
        $r[$key]["client_phone"] = NULL;
      }

      foreach ($ids as $k => $v) {
        $p = $products->getById($v);
        $p["quantity"] = $qts[$k];
        $p["payed_price"] = $pp[$k];
        array_push($r[$key]["produtos"], $p);
      }

      if ($value["order_address_id"] >= 0) { 
        $address = $sql->select("SELECT * FROM client_address WHERE client_address_id=:id LIMIT 1", ["id"=>$value["order_address_id"]]);
        if (count($address) > 0) {
          $address = $address[0];
          $clientAddress = $address["client_address_rua"].", Número ".$address["client_address_numero"].", ".$address["client_address_estado"].", ".$address["client_address_cidade"]." - ".$address["client_address_bairro"]." CEP ".$address["client_address_cep"]." | Contato ".$address["client_address_contact"];
          if ($address["client_address_complemento"] != "") {
            $clientAddress = $clientAddress." Complemento ".$address["client_address_complemento"];
          }

          $r[$key]["client_address"] = $clientAddress;
        }
      }
    }

    return $r;
  }

  public static function getOrdersOpen($param) {
    $sql = new Sql();
    $products = new Products();

    if ($param != "") {
      $query = "SELECT * FROM `order` WHERE order_status!=5 ORDER BY order_id DESC ".$param;
    } else {
      $query = "SELECT * FROM `order` WHERE order_status!=5 ORDER BY order_id DESC";
    }
    
    $r = $sql->select($query);


    $count = $sql->select("SELECT count(order_id) FROM `order` WHERE order_status!=5");

    foreach ($r as $key => $value) {
      $r[$key]["products_name"] = [];
      $ids = explode(",", $value["products_id"]);

      $clientInfo = $sql->select("SELECT client_name, client_phone FROM clients WHERE client_id=:id", ["id"=>$value["client_id"]]);

      if (count($clientInfo) > 0) {
        $r[$key]["client_name"] = $clientInfo[0]["client_name"];
        $r[$key]["client_phone"] = $clientInfo[0]["client_phone"];
      } else {
        $r[$key]["client_name"] = "Cliente Id ".$r["client_id"];
        $r[$key]["client_phone"] = NULL;
      }

      foreach ($ids as $k => $v) {
        $p = $products->getById($v);
        array_push($r[$key]["products_name"], $p["product_name"]);
      }

      $r[$key]["products_name"] = implode(", ", $r[$key]["products_name"]);

      if ($value["order_address_id"] >= 0) { 
        $address = $sql->select("SELECT * FROM client_address WHERE client_address_id=:id LIMIT 1", ["id"=>$value["order_address_id"]]);
        if (count($address) > 0) {
          $address = $address[0];
          $clientAddress = $address["client_address_rua"].", Número ".$address["client_address_numero"].", ".$address["client_address_estado"].", ".$address["client_address_cidade"]." - ".$address["client_address_bairro"];
          if ($address["client_address_complemento"] != "") {
            $clientAddress = $clientAddress." Complemento ".$address["client_address_complemento"];
          }

          $r[$key]["client_address"] = $clientAddress;
        }
      }
    }

    if (count($count) > 0) {
      $count = $count[0]["count(order_id)"];
    } else {
      $count = 0;
    }

    return ["orders"=>$r,"count"=>$count];
  }

  public static function getOrders($param = "") {
    $sql = new Sql();
    $products = new Products();

    if ($param != "") {
      $query = "SELECT * FROM `order` ORDER BY order_id DESC ".$param;
    } else {
      $query = "SELECT * FROM `order` ORDER BY order_id DESC";
    }
    
    $r = $sql->select($query);

    $count = $sql->select("SELECT order_id FROM `order` ");
    $count = count($count);

    foreach ($r as $key => $value) {
      $r[$key]["products_name"] = [];
      $ids = explode(",", $value["products_id"]);

      $clientInfo = $sql->select("SELECT client_name, client_phone FROM clients WHERE client_id=:id", ["id"=>$value["client_id"]]);

      if (count($clientInfo) > 0) {
        $r[$key]["client_name"] = $clientInfo[0]["client_name"];
        $r[$key]["client_phone"] = $clientInfo[0]["client_phone"];
      } else {
        $r[$key]["client_name"] = "Cliente Id ".$r["client_id"];
        $r[$key]["client_phone"] = NULL;
      }

      foreach ($ids as $k => $v) {
        $p = $products->getById($v);
        array_push($r[$key]["products_name"], $p["product_name"]);
      }

      $r[$key]["products_name"] = implode(", ", $r[$key]["products_name"]);

      if ($value["order_address_id"] >= 0) { 
        $address = $sql->select("SELECT * FROM client_address WHERE client_address_id=:id LIMIT 1", ["id"=>$value["order_address_id"]]);
        if (count($address) > 0) {
          $address = $address[0];
          $clientAddress = $address["client_address_rua"].", Número ".$address["client_address_numero"].", ".$address["client_address_estado"].", ".$address["client_address_cidade"]." - ".$address["client_address_bairro"];
          if ($address["client_address_complemento"] != "") {
            $clientAddress = $clientAddress." Complemento ".$address["client_address_complemento"];
          }

          $r[$key]["client_address"] = $clientAddress;
        }
      }
    }

    if ($count > 0) {
      $count = $count;
    }

    return ["orders"=>$r,"count"=>$count];
  }

  public static function getOrderById($id) {
    $sql = new Sql();

    $query = "SELECT * FROM `order` WHERE order_id=:id LIMIT 1";
    $r = $sql->select($query, ["id"=>$id]);

    if (count($r) > 0) {
      return $r[0];
    } else {
      return $r;
    }
  }

  public static function getOrderByIdFull($id) {
    $sql = new Sql();
    $products = new Products();

    $query = "SELECT * FROM `order` WHERE order_id=:id LIMIT 1";
    $r = $sql->select($query, ["id"=>$id]);

    if (isset($r[0])) {
      foreach ($r as $key => $value) {
        $r[$key]["produtos"] = [];
        $ids = explode(",", $value["products_id"]);
        $qts = explode(",", $value["products_quantity"]);
        $pp = explode(",", $value["products_price"]);
  
        $clientInfo = $sql->select("SELECT client_name, client_phone FROM clients WHERE client_id=:id", ["id"=>$value["client_id"]]);

        if (count($clientInfo) > 0) {
          $r[$key]["client_name"] = $clientInfo[0]["client_name"];
          $r[$key]["client_phone"] = $clientInfo[0]["client_phone"];
        } else {
          $r[$key]["client_name"] = "Cliente Id ".$r["client_id"];
          $r[$key]["client_phone"] = NULL;
        }
  
        foreach ($ids as $k => $v) {
          $p = $products->getById($v);
          $p["quantity"] = $qts[$k];
          $p["payed_price"] = $pp[$k];
          array_push($r[$key]["produtos"], $p);
        }
  
        if ($value["order_address_id"] >= 0) { 
          $address = $sql->select("SELECT * FROM client_address WHERE client_address_id=:id LIMIT 1", ["id"=>$value["order_address_id"]]);
          if (count($address) > 0) {
            $address = $address[0];
            $clientAddress = $address["client_address_rua"].", Número ".$address["client_address_numero"].", ".$address["client_address_estado"].", ".$address["client_address_cidade"]." - ".$address["client_address_bairro"]." CEP ".$address["client_address_cep"]." | Contato ".$address["client_address_contact"];
            if ($address["client_address_complemento"] != "") {
              $clientAddress = $clientAddress." Complemento ".$address["client_address_complemento"];
            }
  
            $r[$key]["client_address"] = $clientAddress;
          }
        }
      }

      return $r[0];
    } else {
      return $r;
    }
  }

  public static function countOpen() {
    $sql = new Sql();

    $count = $sql->select("SELECT count(order_id) FROM `order` WHERE order_status=1");
    
    if (count($count) > 0) {
      return $count[0]["count(order_id)"];
    } else {
      return 0;
    }
  }

  public static function countOrders() {
    $sql = new Sql();

    $count = $sql->select("SELECT count(order_id) FROM `order`");
    
    if (count($count) > 0) {
      return $count[0]["count(order_id)"];
    } else {
      return 0;
    }
  }

  public static function updateOrder($id, $status, $pStatus) {
    $sql = new Sql();

    $query = "UPDATE `order` SET order_status=:oStatus, order_payment_status=:pStatus WHERE order_id=:id";
    $params = [
      "oStatus"=>$status,
      "pStatus"=>$pStatus,
      "id"=>$id
    ];

    return $sql->query($query, $params);
  }
}

?>