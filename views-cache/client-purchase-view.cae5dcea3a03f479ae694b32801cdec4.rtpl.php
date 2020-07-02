<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="container">
  <div class="purchases-container">
    <div class="purchases-content">

      <div class="purchases-title">
        <h2>Compra #<?php echo htmlspecialchars( $order["order_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?> | Dia <?php echo date('d/m/Y', strtotime($order["order_date"])); ?> | R$ <?php echo formatMoney($order["order_subtotal"]); ?></h2>
      </div>

      <div class="purchase-box view-order">

        <div class="purchase-view-status">
          <div class="box">
            <span class="title">Tipe de entrega</span>
            <?php $x = $order["order_address_id"]; ?>
            <?php if( $x == 0 ){ ?>
            <span class="badge badge-circle badge-default text-white">Retirar</span>
            <br>
            <span class="map">Clique <a href="https://www.google.com/maps/place/R.+Curitiba,+653+-+Jardim+Olinda,+Cabo+Frio+-+RJ,+28911-140/@-22.8818045,-42.04757,21z/data=!4m5!3m4!1s0x971ad1c08e20f5:0x2b2541763f60b7e5!8m2!3d-22.881811!4d-42.047442" target="_blank">aqui</a> para abrir o mapa</span>
            <?php }else{ ?>
            <span class="badge badge-circle badge-primary">Entregar</span>
            <?php } ?>
          </div>
          <div class="box">
            <span class="title">Status do pagamento</span>
            <?php $z = $order["order_payment_status"]; ?>
            <?php if( $z == 1 ){ ?>
            <span class="badge badge-circle badge-warning">Pagamento na retirada</span>
            <?php }elseif( $z == 2 ){ ?>
            <span class="badge badge-circle badge-primary">Em análise</span>
            <?php }elseif( $z == 3 ){ ?>
            <span class="badge badge-circle badge-success">Aprovado</span>
            <?php }elseif( $z == 4 ){ ?>
            <span class="badge badge-circle badge-danger">Recusado</span>
            <?php } ?>
          </div>
          <div class="box">
            <span class="title">Status da compra</span>
            <?php $i = $order["order_status"]; ?>
            <?php if( $i == 1 ){ ?>
            <span class="badge badge-circle badge-warning">Aguardando atualização</span>
            <?php }elseif( $i == 2 ){ ?>
            <span class="badge badge-circle badge-primary">Em separação</span>
            <?php }elseif( $i == 3 ){ ?>
            <span class="badge badge-circle badge-info">Pronto para retirada</span>
            <?php }elseif( $i == 4 ){ ?>
            <span class="badge badge-circle badge-info">Saiu para entregar</span>
            <?php }elseif( $i == 5 ){ ?>
            <span class="badge badge-circle badge-success">Entregue</span>
            <?php }elseif( $i == 6 ){ ?>
            <span class="badge badge-circle badge-danger">Cancelada</span>
            <?php } ?>
          </div>
        </div>

        <div class="purchase-view-product-box">

          <?php $counter1=-1;  if( isset($order["produtos"]) && ( is_array($order["produtos"]) || $order["produtos"] instanceof Traversable ) && sizeof($order["produtos"]) ) foreach( $order["produtos"] as $key1 => $value1 ){ $counter1++; ?>
          <div class="purchase-product-box">
            <div class="product-picture">
              <img src="../assets/produtos/<?php echo htmlspecialchars( $value1["product_pictures"]["0"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt="Foto do <?php echo htmlspecialchars( $value1["product_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
            <div class="product-title">
              <span><?php echo htmlspecialchars( $value1["product_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
            </div>
            <div class="product-price">
              <span>Quantidade: <?php echo htmlspecialchars( $value1["quantity"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
              <br>
              <br>
              <span> R$ <?php echo formatMoney($value1["payed_price"]); ?></span>
            </div>
          </div>
          <?php } ?>

        </div>
      </div>

    </div>
  </div>
</div>