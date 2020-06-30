<?php

namespace Skuth\Model;
use Skuth\DB\Sql;

class Cards {

  public static function getCards() {
    $sql = new Sql();
    
    $res = $sql->select("SELECT * FROM cards LIMIT 3");

    return $res;
  }

  public static function getCardById($id) {
    $sql = new Sql();
    
    $res = $sql->select("SELECT * FROM cards WHERE id=:id LIMIT 1", ["id"=>$id]);

    if (count($res) > 0) {
      return $res[0];
    } else {
      return $res;
    }
  }

  public static function updateCard($id, $data) {
    $sql = new Sql();

    $pic = $data["picture"];
    $title = $data["title"];
    $price = $data["price"];
    $url = $data["url"];

    $query = "UPDATE cards SET picture=:pic, title=:title, price=:price, url=:url WHERE id=:id";

    $params = [
      "pic"=>$pic,
      "title"=>$title,
      "price"=>$price,
      "url"=>$url,
      "id"=>$id
    ];

    $res = $sql->query($query, $params);

    return $res;
  }

}

?>