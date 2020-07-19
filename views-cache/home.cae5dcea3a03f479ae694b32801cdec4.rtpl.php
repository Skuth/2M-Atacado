<?php if(!class_exists('Rain\Tpl')){exit;}?><?php $siteUrl = getSiteUrl(); ?>

<div class="container">
  <div class="slide">
    <div class="controls">
      <span><i class="icofont-thin-left"></i></span>
      <span><i class="icofont-thin-right"></i></span>
    </div>
    <div class="container-header-slider">
      <?php $counter1=-1;  if( isset($sliders) && ( is_array($sliders) || $sliders instanceof Traversable ) && sizeof($sliders) ) foreach( $sliders as $key1 => $value1 ){ $counter1++; ?>
        <?php $verify = strpos($value1["slider_href"], $siteUrl); ?>
        <?php if( $value1["slider_status"] == 1 ){ ?>
        <a class="banner" <?php if( $value1["slider_href"] != NULL ){ ?>href="<?php echo htmlspecialchars( $value1["slider_href"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"<?php } ?> <?php if( $verify === false ){ ?>rel="noreferrer"<?php } ?>>
          <picture>
            <?php $images = getImages($value1["slider_img"]); ?>
            <source srcset="./assets/banner/<?php echo htmlspecialchars( $images['webp'], ENT_COMPAT, 'UTF-8', FALSE ); ?>" type="image/webp">
            <source srcset="./assets/banner/<?php echo htmlspecialchars( $images['jpg'], ENT_COMPAT, 'UTF-8', FALSE ); ?>" type="image/jpeg"> 
            <img src="./assets/banner/<?php echo htmlspecialchars( $images['jpg'], ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt="<?php echo htmlspecialchars( $value1["slider_description"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
          </picture>
        </a>
        <?php } ?>
      <?php } ?>
    </div>
  </div>

  <div class="departments">
    <h2>Departamentos</h2>
    <div class="departments-container">
      <?php $counter1=-1;  if( isset($departments) && ( is_array($departments) || $departments instanceof Traversable ) && sizeof($departments) ) foreach( $departments as $key1 => $value1 ){ $counter1++; ?>
      <a class="box" href="/produtos/departamento/<?php echo htmlspecialchars( $value1["department_href"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
        <div class="icon">
          <i class="<?php echo htmlspecialchars( $value1["department_icon"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"></i>
        </div>
        <div class="text">
          <p><?php echo htmlspecialchars( $value1["department_text"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
        </div>
      </a>
      <?php } ?>
    </div>
  </div>
</div>

<div class="products-card">
  <div class="card-container">

    <?php $color = array("", "red", "orange"); ?>

    <?php $counter1=-1;  if( isset($cards) && ( is_array($cards) || $cards instanceof Traversable ) && sizeof($cards) ) foreach( $cards as $key1 => $value1 ){ $counter1++; ?>

    <a class="card" href="produtos/departamento/<?php echo htmlspecialchars( $value1["url"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
      <div class="card-header">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 340.931 175.06">
          <path class="card-svg-header <?php echo htmlspecialchars( $color["$key1"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" d="M113,6042.624s87.134,78.225,173.486,44.7,89.451-108.392,131.993-143.073c9.711-9.248,35.452-23.635,35.452-23.635L113,5920.971Z" transform="translate(-113 -5920.615)"/>
        
          <?php $price = formatMoney(floatval($value1["price"])); ?>
          <?php $price = explode(",", $price); ?>

          <text x="60" y="50"><?php echo htmlspecialchars( $value1["title"], ENT_COMPAT, 'UTF-8', FALSE ); ?></text>
          <text x="60" y="90">a partir de</text>
          <text x="60" y="135" class="textrice">R$ <tspan ><?php echo htmlspecialchars( $price["0"], ENT_COMPAT, 'UTF-8', FALSE ); ?></tspan ><tspan >,<?php echo htmlspecialchars( $price["1"], ENT_COMPAT, 'UTF-8', FALSE ); ?></tspan ></text>
        </svg>
      </div>
      <div class="card-image">
        <picture>
          <?php $images = getImages($value1["picture"]); ?>
          <source srcset="./assets/cards/<?php echo htmlspecialchars( $images['webp'], ENT_COMPAT, 'UTF-8', FALSE ); ?>" type="image/webp">
          <source srcset="./assets/cards/<?php echo htmlspecialchars( $images['jpg'], ENT_COMPAT, 'UTF-8', FALSE ); ?>" type="image/jpeg"> 
          <img src="./assets/cards/<?php echo htmlspecialchars( $images['jpg'], ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt="Foto do card de <?php echo htmlspecialchars( $value1["title"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
        </picture>
      </div>
    </a>

    <?php } ?>

  </div>
</div>

<?php if( count($prodOffers) > 0 ){ ?>
<div class="products-box">
  <div class="products-box-header">
    <div class="title">
      <p>Ofertas</p>
    </div>
  </div>

  <div class="product-box-container" id="products-off">
    <?php $counter1=-1;  if( isset($prodOffers) && ( is_array($prodOffers) || $prodOffers instanceof Traversable ) && sizeof($prodOffers) ) foreach( $prodOffers as $key1 => $value1 ){ $counter1++; ?>
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
        <picture>
          <?php $images = getImages($value1["product_pictures"]["0"]); ?>
          <source srcset="./assets/produtos/<?php echo htmlspecialchars( $images['webp'], ENT_COMPAT, 'UTF-8', FALSE ); ?>" type="image/webp">
          <source srcset="./assets/produtos/<?php echo htmlspecialchars( $images['jpg'], ENT_COMPAT, 'UTF-8', FALSE ); ?>" type="image/jpeg"> 
          <img src="./assets/produtos/<?php echo htmlspecialchars( $images['jpg'], ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt="Foto do produto - <?php echo htmlspecialchars( $value1["product_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?> | Ref: <?php echo htmlspecialchars( $value1["product_ref"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
        </picture>
      </div>
      <div class="product-brand">
        <?php if( $value1["distributor_id"] > 0 ){ ?>
          <span>
            <picture>
              <?php $images = getImages($value1["distributor_logo"]); ?>
              <source srcset="./assets/distribuidores/<?php echo htmlspecialchars( $images['webp'], ENT_COMPAT, 'UTF-8', FALSE ); ?>" type="image/webp">
              <source srcset="./assets/distribuidores/<?php echo htmlspecialchars( $images['jpg'], ENT_COMPAT, 'UTF-8', FALSE ); ?>" type="image/jpeg"> 
              <img src="./assets/distribuidores/<?php echo htmlspecialchars( $images['jpg'], ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt="Logo do distribuidor - <?php echo htmlspecialchars( $value1["distributor_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </picture>
          </span>
        <?php } ?>
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
  <div class="btn-container btn-container-center">
    <a href="/produtos/ofertas" class="btn btn-center btn-circle btn-blue btn-big btn-cap">Ver todas</a>
  </div>
</div>
<?php } ?>

<div class="products-box">
  <div class="products-box-header">
    <div class="title">
      <p>Mais vistos</p>
    </div>
  </div>

  <div class="product-box-container">
    <?php $counter1=-1;  if( isset($prodViews) && ( is_array($prodViews) || $prodViews instanceof Traversable ) && sizeof($prodViews) ) foreach( $prodViews as $key1 => $value1 ){ $counter1++; ?>
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
        <picture>
          <?php $images = getImages($value1["product_pictures"]["0"]); ?>
          <source srcset="./assets/produtos/<?php echo htmlspecialchars( $images['webp'], ENT_COMPAT, 'UTF-8', FALSE ); ?>" type="image/webp">
          <source srcset="./assets/produtos/<?php echo htmlspecialchars( $images['jpg'], ENT_COMPAT, 'UTF-8', FALSE ); ?>" type="image/jpeg"> 
          <img src="./assets/produtos/<?php echo htmlspecialchars( $images['jpg'], ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt="Foto do produto - <?php echo htmlspecialchars( $value1["product_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?> | Ref: <?php echo htmlspecialchars( $value1["product_ref"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
        </picture>
      </div>
      <div class="product-brand">
        <?php if( $value1["distributor_id"] > 0 ){ ?>
          <span>
            <picture>
              <?php $images = getImages($value1["distributor_logo"]); ?>
              <source srcset="./assets/distribuidores/<?php echo htmlspecialchars( $images['webp'], ENT_COMPAT, 'UTF-8', FALSE ); ?>" type="image/webp">
              <source srcset="./assets/distribuidores/<?php echo htmlspecialchars( $images['jpg'], ENT_COMPAT, 'UTF-8', FALSE ); ?>" type="image/jpeg"> 
              <img src="./assets/distribuidores/<?php echo htmlspecialchars( $images['jpg'], ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt="Logo do distribuidor - <?php echo htmlspecialchars( $value1["distributor_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </picture>
          </span>
        <?php } ?>
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
  <div class="btn-container btn-container-center">
    <a href="/produtos" class="btn btn-center btn-circle btn-blue btn-big btn-cap">Ver mais</a>
  </div>
</div>

<div class="products-box">
  <div class="products-box-header">
    <div class="title">
      <p>Alguns produtos</p>
    </div>
  </div>

<div class="product-box-container">
  <?php $counter1=-1;  if( isset($prodRandom) && ( is_array($prodRandom) || $prodRandom instanceof Traversable ) && sizeof($prodRandom) ) foreach( $prodRandom as $key1 => $value1 ){ $counter1++; ?>
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
      <picture>
        <?php $images = getImages($value1["product_pictures"]["0"]); ?>
        <source srcset="./assets/produtos/<?php echo htmlspecialchars( $images['webp'], ENT_COMPAT, 'UTF-8', FALSE ); ?>" type="image/webp">
        <source srcset="./assets/produtos/<?php echo htmlspecialchars( $images['jpg'], ENT_COMPAT, 'UTF-8', FALSE ); ?>" type="image/jpeg"> 
        <img src="./assets/produtos/<?php echo htmlspecialchars( $images['jpg'], ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt="Foto do produto - <?php echo htmlspecialchars( $value1["product_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?> | Ref: <?php echo htmlspecialchars( $value1["product_ref"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
      </picture>
    </div>
    <div class="product-brand">
      <?php if( $value1["distributor_id"] > 0 ){ ?>
      <span>
        <picture>
          <?php $images = getImages($value1["distributor_logo"]); ?>
          <source srcset="./assets/distribuidores/<?php echo htmlspecialchars( $images['webp'], ENT_COMPAT, 'UTF-8', FALSE ); ?>" type="image/webp">
          <source srcset="./assets/distribuidores/<?php echo htmlspecialchars( $images['jpg'], ENT_COMPAT, 'UTF-8', FALSE ); ?>" type="image/jpeg"> 
          <img src="./assets/distribuidores/<?php echo htmlspecialchars( $images['jpg'], ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt="Logo do distribuidor - <?php echo htmlspecialchars( $value1["distributor_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
        </picture>
      </span>
      <?php } ?>
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
<div class="btn-container btn-container-center">
  <a href="/produtos" class="btn btn-center btn-circle btn-blue btn-big btn-cap">Ver todos</a>
</div>
</div>