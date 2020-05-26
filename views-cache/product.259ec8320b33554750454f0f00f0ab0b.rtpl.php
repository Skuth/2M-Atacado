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
      <a href="/distribuidor/<?php echo htmlspecialchars( $produto["distributor_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo filterName($produto["distributor_name"]); ?>">
        <img src="./assets/distribuidores/<?php echo htmlspecialchars( $produto["distributor_logo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt="Logo da distribuidora <?php echo htmlspecialchars( $produto["distributor_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" width="50" class="product-page-brand">
      </a>
      <span class="ref">REF: <?php echo htmlspecialchars( $produto["product_ref"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
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
      <a href="#" class="btn btn-blue btn-circle btn-medium">Adicionar ao carrinho</a>
    </div>
    <div class="product-page-description">
      <h3>Descrição</h3>
      <div class="product-page-description-box">
        <?php $desc = parseProductDesc($produto["product_description"]); ?>
        <?php echo htmlspecialchars( $desc, ENT_COMPAT, 'UTF-8', FALSE ); ?>
        {autoescape="false"}<?php echo htmlspecialchars( $desc, ENT_COMPAT, 'UTF-8', FALSE ); ?>{/autoescape}
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
      <?php $counter1=-1; $newvar1=array(1,1,1,1); if( isset($newvar1) && ( is_array($newvar1) || $newvar1 instanceof Traversable ) && sizeof($newvar1) ) foreach( $newvar1 as $key1 => $value1 ){ $counter1++; ?>
      <a class="product-box" href="#">
        <div class="product-picture">
          <img src="https://www.texturasdobrasil.com.br/image/cache/data/massa%20corrida%20coral%202-800x800.png" alt="Foto do produto">
        </div>
        <div class="product-brand">
          <span>
            <img src="https://logodownload.org/wp-content/uploads/2019/07/coral-logo.png" alt="">
          </span>
        </div>
        <div class="product-info">
          <p class="title">Massa corrida</p>
          <div class="product-price">
            <s class="old-price">R$ <span>59</span><span>,00</span></s>
            <p>R$ <span>39</span><span>,00</span></p>
          </div>
        </div>
      </a>
      <?php } ?>
    </div>
  </div>
</div>