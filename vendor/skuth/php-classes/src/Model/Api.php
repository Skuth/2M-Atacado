<?php

namespace Skuth\Model;
use Skuth\DB\Sql;
use Skuth\Model\Products;

class Api {

  public static function updateStock($ref, $stock) {
    return Products::updateStock($ref, $stock);
  }

}

?>