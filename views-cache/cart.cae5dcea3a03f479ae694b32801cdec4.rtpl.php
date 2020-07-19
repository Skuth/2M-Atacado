<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="cart-container">
  <div class="cart-content">
    <?php if( count($cart) > 0 ){ ?>
    <div class="cart-content-items">
      <?php $counter1=-1;  if( isset($cart) && ( is_array($cart) || $cart instanceof Traversable ) && sizeof($cart) ) foreach( $cart as $key1 => $value1 ){ $counter1++; ?>
      <div class="box">
        <div class="picture">
          <picture>
            <?php $images = getImages($value1["product_pictures"]["0"]); ?>
            <source srcset="./assets/produtos/<?php echo htmlspecialchars( $images['webp'], ENT_COMPAT, 'UTF-8', FALSE ); ?>" type="image/webp">
            <source srcset="./assets/produtos/<?php echo htmlspecialchars( $images['jpg'], ENT_COMPAT, 'UTF-8', FALSE ); ?>" type="image/jpeg"> 
            <img src="./assets/produtos/<?php echo htmlspecialchars( $images['jpg'], ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt="Foto do produto - <?php echo htmlspecialchars( $value1["product_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?> | Ref: <?php echo htmlspecialchars( $value1["product_ref"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
          </picture>
        </div>
        <div class="info">
          <p class="title" onclick="location.href='produto/<?php echo htmlspecialchars( $value1["product_ref"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo filterName($value1["product_name"]); ?>'"><?php echo htmlspecialchars( $value1["product_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
          <div class="action">
            <p class="remove" onclick="removeCart(<?php echo htmlspecialchars( $value1["product_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>)">Excluir</p>
          </div>
        </div>
        <div class="quantity">
          <p><?php echo htmlspecialchars( $value1["quantity"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
        </div>
        <div class="price">
          <?php $percentage = getPricePercentage($value1["product_price"], $value1["product_price_off"]); ?>
      
          <?php $price = formatMoney($value1["product_price"]); ?>

          <?php if( $value1["product_price_off"] != NULL ){ ?>
          <?php $priceOff = formatMoney($value1["product_price_off"]); ?>
          <span class="old-price">
            <span class="discount"><?php echo htmlspecialchars( $percentage, ENT_COMPAT, 'UTF-8', FALSE ); ?>%</span>
            <s>R$ <?php echo htmlspecialchars( $price, ENT_COMPAT, 'UTF-8', FALSE ); ?></s>
          </span>
          <span>R$ <?php echo htmlspecialchars( $priceOff, ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
          <?php }else{ ?>
          <span>R$ <?php echo htmlspecialchars( $price, ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
          <?php } ?>

        </div>
      </div>
      <?php } ?>
    </div>
    <div class="cart-content-info">
      <div class="cart-info">
        <p>Produtos <span><?php echo htmlspecialchars( $quantity, ENT_COMPAT, 'UTF-8', FALSE ); ?></span></p>
        <p>Total <span>R$ <?php echo formatMoney($total); ?></span></p>
      </div>
    </div>
    <div class="cart-content-info">
      <a href="checkout" class="btn btn-circle btn-blue btn-medium">Continuar a compra</a>
    </div>
    <?php }else{ ?>
      <div class="cart-content-items">
        <div class="empty">
          <h2>O seu carrinho está vazio</h2>
          <p>Clique <a href="/produtos">aqui</a> para ver nossa pagina de produtos</p>
        </div>
      </div>
    <?php } ?>
  </div>
</div>