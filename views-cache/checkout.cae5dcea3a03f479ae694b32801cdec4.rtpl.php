<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="container">
  <div class="checkout-container">
    <div class="checkout-container-left">

      <div class="checkout-box">
        <h2 class="shipment-title">Opções de envio para</h2>
        <div class="shipment-box">

          <div class="shipment-icon">
            <i class="icofont-location-pin"></i>
          </div>

          <div class="shipment-content">
            <?php if( count($address) > 0 ){ ?>
              <?php $fullAddress = $address["client_address_rua"] ." - ". $address["client_address_cidade"] .", ". $address["client_address_estado"] ." - CEP ". $address["client_address_cep"]; ?>
              <?php if( strlen($fullAddress) > 70 ){ ?>
                <?php $fullAddress = substr($fullAddress, 0, 70)."..."; ?>
              <?php } ?>
            <p class="address"><?php echo htmlspecialchars( $fullAddress, ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p class="person">Flávio Gomes - 22992917796</p>
            <?php }else{ ?>
            <p class="address">Retirar na loja</p>
            <p class="person"><?php echo htmlspecialchars( $GLOBALS["siteData"]["site_data_address"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <?php } ?>
          </div>

          <div class="shipment-options">
            <a href="#">Editar</a>
          </div>

        </div>
      </div>

      <?php $counter1=-1;  if( isset($products) && ( is_array($products) || $products instanceof Traversable ) && sizeof($products) ) foreach( $products as $key1 => $value1 ){ $counter1++; ?>
      <div class="checkout-box product-content">
        <span class="product-title">
          Encomenda <?php echo htmlspecialchars( $key1 + 1, ENT_COMPAT, 'UTF-8', FALSE ); ?>
        </span>
        <div class="product-content-box">

          <div class="product-picture">
            <img src="./assets/produtos/<?php echo htmlspecialchars( $value1["product_pictures"]["0"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt="Imagem do produto <?php echo htmlspecialchars( $value1["product_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" width="60">
          </div>

          <div class="product-content">
            <p><?php echo htmlspecialchars( $value1["product_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <p>Quantidade: <?php echo htmlspecialchars( $value1["quantity"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
            <?php if( $value1["product_price_off"] != NULL ){ ?>
              <?php $price = $value1["product_price_off"]; ?>
            <?php }else{ ?>
              <?php $price = $value1["product_price"]; ?>
            <?php } ?>
            <?php $price = formatMoney($price); ?>
            <?php $price = explode(",", $price); ?>
            <p>R$ <?php echo htmlspecialchars( $price["0"], ENT_COMPAT, 'UTF-8', FALSE ); ?> <sup><?php echo htmlspecialchars( $price["1"], ENT_COMPAT, 'UTF-8', FALSE ); ?></sup> unid.</p>
          </div>

        </div>
      </div>
      <?php } ?>

      <div class="checkout-box">
        <div class="checkout-shipment-total">
          <?php $shipmentPrice = formatMoney($shipmentPrice); ?>
          <?php $shipmentPrice = explode(",", $shipmentPrice); ?>
          <span>Custo do envio</span>
          <span>R$ <?php echo htmlspecialchars( $shipmentPrice["0"], ENT_COMPAT, 'UTF-8', FALSE ); ?> <sup><?php echo htmlspecialchars( $shipmentPrice["1"], ENT_COMPAT, 'UTF-8', FALSE ); ?></sup></span>
        </div>
      </div>

    </div>
    
    <div class="checkout-container-right">
      <div class="checkout-info divider">
        <h3 class="checkout-info-title">Resumo da compra</h3>
      </div>

      <?php $cartPrice = formatMoney($cart["cart_total"]); ?>
      <?php $cartPrice = explode(",", $cartPrice); ?>

      <div class="checkout-info divider">
        <p>Produtos (<?php echo htmlspecialchars( $cart["products_total"], ENT_COMPAT, 'UTF-8', FALSE ); ?>) <span>R$ <?php echo htmlspecialchars( $cartPrice["0"], ENT_COMPAT, 'UTF-8', FALSE ); ?> <sup><?php echo htmlspecialchars( $cartPrice["1"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span></p>
        <p>Envio <span>R$ <?php echo htmlspecialchars( $shipmentPrice["0"], ENT_COMPAT, 'UTF-8', FALSE ); ?> <sup><?php echo htmlspecialchars( $shipmentPrice["1"], ENT_COMPAT, 'UTF-8', FALSE ); ?></sup></span></p>
      </div>

      <?php $cartSubtotal = formatMoney($cart["cart_total_shipment"]); ?>
      <?php $cartSubtotal = explode(",", $cartSubtotal); ?>

      <div class="checkout-info">
        <p>Total <span><?php echo htmlspecialchars( $cartSubtotal["0"], ENT_COMPAT, 'UTF-8', FALSE ); ?> <sup><?php echo htmlspecialchars( $cartSubtotal["1"], ENT_COMPAT, 'UTF-8', FALSE ); ?></sup></span></p>
      </div>

      <div class="checkout-button">
        <?php if( isset($address["client_address_id"]) ){ ?>
          <?php $addressId = $address["client_address_id"]; ?>
        <?php }else{ ?>
          <?php $addressId = 0; ?>
        <?php } ?>
        <a onclick="return checkout(this)" class="btn btn-circle btn-blue btn-medium" data-cartId="<?php echo htmlspecialchars( $cart["cart_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" data-addressId="<?php echo htmlspecialchars( $addressId, ENT_COMPAT, 'UTF-8', FALSE ); ?>">Comprar</a>
      </div>
    </div>
  </div>
</div>