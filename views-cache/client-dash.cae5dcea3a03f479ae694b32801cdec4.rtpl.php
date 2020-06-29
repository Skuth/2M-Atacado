<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="container">
  <div class="purchases-container">
    <div class="purchases-content">

      <div class="purchases-title">
        <h2>Compras</h2>
      </div>

      <?php if( count($orders) == 0 ){ ?>

      <div class="purchase-empty">
        <span class="bold">Opss!</span>
        <span>Você ainda não comprou nada, clique <a href="/produtos">Aqui</a> para conferir nossos produtos.</span>
      </div>

      <?php }else{ ?>

      <?php $counter1=-1;  if( isset($orders) && ( is_array($orders) || $orders instanceof Traversable ) && sizeof($orders) ) foreach( $orders as $key1 => $value1 ){ $counter1++; ?>
      <div class="purchase-box">
        <div class="purchase-info">
          <?php $prods = ""; ?>
          <?php $max = 3; ?>
          <?php $count = count($value1["produtos"]); ?>
          <?php if( $count > $max ){ ?><?php $count = $max; ?><?php } ?>
        <div class="purchase-picture" style="--main-items-count: <?php echo htmlspecialchars( $count, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            <?php $counter2=-1;  if( isset($value1["produtos"]) && ( is_array($value1["produtos"]) || $value1["produtos"] instanceof Traversable ) && sizeof($value1["produtos"]) ) foreach( $value1["produtos"] as $key2 => $value2 ){ $counter2++; ?>

            <?php if( $prods == '' ){ ?>
              <?php $prods = $value2["product_name"]; ?>
            <?php }else{ ?>
              <?php $prods = $prods.", ".$value2["product_name"]; ?>
            <?php } ?>
            
            <?php if( ($key2 + 1) <= $max ){ ?>
            <img src="./assets/produtos/<?php echo htmlspecialchars( $value2["product_pictures"]["0"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt="Foto do produto <?php echo htmlspecialchars( $value2["product_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            <?php } ?>
            <?php } ?>
          </div>
          <?php if( count($value1["produtos"]) > 1 ){ ?>
          <div class="purchase-products-info">
            <p class="product-title"><?php echo substr($prods, 0, 40); ?>...</p>
            <p>Quantidade de produtos: <?php echo count($value1["produtos"]); ?></p>
            <p>Tota: R$ <?php echo formatMoney($value1["order_subtotal"]); ?></p>
          </div>
          <?php }else{ ?>
          <div class="purchase-products-info">
            <p class="product-title"><?php echo htmlspecialchars( $value1["produtos"]["0"]["product_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p>Quantidade: 1</p>
            <p>Tota: R$ <?php echo formatMoney($value1["products_price"]); ?> x unidade</p>
          </div>
          <?php } ?>
        </div>
        <div class="status">
          <?php $z = $value1["order_payment_status"]; ?>
          <?php if( $z == 1 ){ ?>
          <span class="badge badge-circle badge-warning">Pagamento na retirada</span>
          <?php }elseif( $z == 2 ){ ?>
          <span class="badge badge-circle badge-primary">Em análise</span>
          <?php }elseif( $z == 3 ){ ?>
          <span class="badge badge-circle badge-success">Aprovado</span>
          <?php }elseif( $z == 4 ){ ?>
          <span class="badge badge-circle badge-danger">Recusado</span>
          <?php } ?>
          <br>
          <?php $i = $value1["order_status"]; ?>
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
        <div class="purchase-details">
          <a href="/cliente/compra/<?php echo htmlspecialchars( $value1["order_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">Ver detalhes</a>
        </div>
      </div>
      <?php } ?>

      <?php } ?>

    </div>
  </div>
</div>