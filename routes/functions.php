<?php

function formatMoney($money) {
  $money = str_replace(",", ".", $money);
  $fmt = numfmt_create("pt_BR", NumberFormatter::CURRENCY);
  $formated = $fmt->formatCurrency($money,  "BRL");
  $formated = str_replace("R$", "", $formated);
  return $formated;
}

?>