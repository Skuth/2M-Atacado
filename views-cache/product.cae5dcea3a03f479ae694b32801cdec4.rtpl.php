<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="product-container">
  <div class="product-page-container">
    <div class="product-page-picture">
      <div class="product-page-carrossel">
        <?php $counter1=-1;  if( isset($produto["product_pictures"]) && ( is_array($produto["product_pictures"]) || $produto["product_pictures"] instanceof Traversable ) && sizeof($produto["product_pictures"]) ) foreach( $produto["product_pictures"] as $key1 => $value1 ){ $counter1++; ?>
        <div class="product-page-carrossel-box">
          <img src="./assets/produtos/<?php echo htmlspecialchars( $produto["product_pictures"]["$key1"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt="Imagem <?php echo htmlspecialchars( $key1 + 1, ENT_COMPAT, 'UTF-8', FALSE ); ?> do produto - <?php echo htmlspecialchars( $produto["product_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
        </div>
        <?php } ?>
      </div>
      <div class="product-page-center-image">
        <img src="./assets/produtos/<?php echo htmlspecialchars( $produto["product_pictures"]["0"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt="Imagem do produto - <?php echo htmlspecialchars( $produto["product_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
      </div>
    </div>
    <div class="product-page-info">
      <h2><?php echo htmlspecialchars( $produto["product_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h2>
      <a href="/distribuidor/<?php echo htmlspecialchars( $produto["distributor_href"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
        <img src="./assets/distribuidores/<?php echo htmlspecialchars( $produto["distributor_logo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt="Logo da distribuidora <?php echo htmlspecialchars( $produto["distributor_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" width="50" class="product-page-brand">
      </a>
      <span class="ref">REF: <?php echo htmlspecialchars( $produto["product_ref"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
      <?php $percentage = getPricePercentage($produto["product_price"], $produto["product_price_off"]); ?>
      <?php if( $produto["product_price_off"] != NULL ){ ?>

        <span class="product-percentage"><?php echo htmlspecialchars( $percentage, ENT_COMPAT, 'UTF-8', FALSE ); ?> % de desconto</span>

        <?php if( $produto["product_price_off_days"] != NULL ){ ?>
        <?php $date = $produto["product_price_off_days"]; ?>
        <span class="product-span">Oferta disponível até dia <?php echo date('d/m/Y', strtotime($date)); ?></span>
        <?php } ?>

        <?php if( $produto["product_stock_quantity_off"] != NULL ){ ?>
        <?php $stock = $produto["product_stock_quantity_off"]; ?>
        <span class="product-span">Últimos <?php echo htmlspecialchars( $stock, ENT_COMPAT, 'UTF-8', FALSE ); ?> disponíveis com desconto</span>
        <?php } ?>

      <?php } ?>
      <div class="product-quantity-box">
        <p class="product-action" onclick="handleQuantity('-')">-</p>
        <p class="product-quantity" id="product-quantity" data-stock="<?php echo htmlspecialchars( $produto["product_stock"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php if( $produto["product_stock"] == 0 ){ ?>0<?php }else{ ?>1<?php } ?></p>
        <p class="product-action" onclick="handleQuantity('+')">+</p>
      </div>
      <span class="product-span text-muted"><?php echo htmlspecialchars( $produto["product_stock"], ENT_COMPAT, 'UTF-8', FALSE ); ?> disponíveis no estoque</span>
      <div class="product-price">
        <?php $price = formatMoney($produto["product_price"]); ?>
        <?php $price = explode(",", $price); ?>
        
        <?php if( $produto["product_price_off"] != NULL ){ ?>
        <?php $priceOff = formatMoney($produto["product_price_off"]); ?>
        <?php $priceOff = explode(",", $priceOff); ?>
        <s class="old-price">R$ <span><?php echo htmlspecialchars( $price["0"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span><span>,<?php echo htmlspecialchars( $price["1"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span></s>
        <p>R$ <span><?php echo htmlspecialchars( $priceOff["0"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span><span>,<?php echo htmlspecialchars( $priceOff["1"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span></p>
        <?php }else{ ?>
        <p>R$ <span><?php echo htmlspecialchars( $price["0"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span><span>,<?php echo htmlspecialchars( $price["1"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span></p>
        <?php } ?>
      </div>
      <?php if( $produto["product_stock"] >= 1 ){ ?>
      <a onclick="addCart(<?php echo htmlspecialchars( $produto["product_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>)" class="btn btn-blue btn-circle btn-medium">Adicionar ao carrinho</a>
      <?php } ?>
    </div>
    <div class="product-page-description">
      <h3>Descrição</h3>
      <div class="product-page-description-box">
        <?php $desc = parseProductDesc($produto["product_description"]); ?>
        <?php echo $desc; ?>
      </div>
    </div>
  </div>
  
  <div class="products-box">
    <div class="products-box-header">
      <div class="title">
        <p>Quem viu gostou</p>
      </div>
    </div>
    
    <div class="product-box-container">
      <?php $counter1=-1;  if( isset($produtosRandom) && ( is_array($produtosRandom) || $produtosRandom instanceof Traversable ) && sizeof($produtosRandom) ) foreach( $produtosRandom as $key1 => $value1 ){ $counter1++; ?>
      <?php $name = filterName($value1["product_name"]); ?>
      
      <?php $percentage = getPricePercentage($value1["product_price"], $value1["product_price_off"]); ?>
      
      <?php $price = formatMoney($value1["product_price"]); ?>
      <?php $price = explode(",", $price); ?>
      
      <?php if( $value1["product_price_off"] != NULL ){ ?>
      <?php $priceOff = formatMoney($value1["product_price_off"]); ?>
      <?php $priceOff = explode(",", $priceOff); ?>
      <?php } ?>
      <a class="product-box" href="/produto/<?php echo htmlspecialchars( $value1["product_ref"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $name, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
        <?php if( $value1["product_price_off"] != NULL ){ ?>
        <span class="product-percentage"><?php echo htmlspecialchars( $percentage, ENT_COMPAT, 'UTF-8', FALSE ); ?> %</span>
        <?php } ?>
        <div class="product-picture">
          <img src="./assets/produtos/<?php echo htmlspecialchars( $value1["product_pictures"]["0"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt="Foto do produto - <?php echo htmlspecialchars( $value1["product_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?> | Ref: <?php echo htmlspecialchars( $value1["product_ref"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
        </div>
        <div class="product-brand">
          <span>
            <img src="./assets/Distribuidores/<?php echo htmlspecialchars( $value1["distributor_logo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt="Logo do distribuidor - <?php echo htmlspecialchars( $value1["distributor_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
          </span>
        </div>
        <div class="product-info">
          <p class="title"><?php echo ucfirst($value1["product_name"]); ?></p>
          <div class="product-price">
            
            <?php if( $value1["product_price_off"] != NULL ){ ?>
            <s class="old-price">R$ <span><?php echo htmlspecialchars( $price["0"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span><span>,<?php echo htmlspecialchars( $price["1"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span></s>
            <p>R$ <span><?php echo htmlspecialchars( $priceOff["0"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span><span>,<?php echo htmlspecialchars( $priceOff["1"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span></p>
            <?php }else{ ?>
            <p>R$ <span><?php echo htmlspecialchars( $price["0"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span><span>,<?php echo htmlspecialchars( $price["1"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span></p>
            <?php } ?>
            
          </div>
        </div>
      </a>
      <?php } ?>
    </div>
  </div>
</div>