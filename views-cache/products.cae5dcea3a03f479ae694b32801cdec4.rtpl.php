<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="container">
  <div class="products-container">

    <div class="products-container-sidebar">
      <div class="sidebar-box open">
        <span>Distribuidores <i class="icofont-simple-down"></i></span>
        <ul class="sidebar-items" style="max-height: 100vh;">
          <?php $counter1=-1;  if( isset($distribuidores) && ( is_array($distribuidores) || $distribuidores instanceof Traversable ) && sizeof($distribuidores) ) foreach( $distribuidores as $key1 => $value1 ){ $counter1++; ?>
          <li><a href="/produtos/distribuidor/<?php echo htmlspecialchars( $value1["distributor_href"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["distributor_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?> ( <?php echo htmlspecialchars( $value1["products_count"], ENT_COMPAT, 'UTF-8', FALSE ); ?> )</a></li>
          <?php } ?>
        </ul>
      </div>
      <div class="sidebar-box open">
        <span>Departamentos <i class="icofont-simple-down"></i></span>
        <ul class="sidebar-items" style="max-height: 100vh;">
          <?php $counter1=-1;  if( isset($departamentos) && ( is_array($departamentos) || $departamentos instanceof Traversable ) && sizeof($departamentos) ) foreach( $departamentos as $key1 => $value1 ){ $counter1++; ?>
          <li><a href="/produtos/departamento/<?php echo htmlspecialchars( $value1["department_href"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><i class="<?php echo htmlspecialchars( $value1["department_icon"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"></i> <?php echo htmlspecialchars( $value1["department_text"], ENT_COMPAT, 'UTF-8', FALSE ); ?> ( <?php echo htmlspecialchars( $value1["products_count"], ENT_COMPAT, 'UTF-8', FALSE ); ?> )</a></li>
          <?php } ?>
        </ul>
      </div>
    </div>

    <div class="products-container-content">

      <?php if( count($produtos) > 0 ){ ?>
      <div class="products-header-container">
        <div class="text-info">
          <h2><?php echo htmlspecialchars( $filterText, ENT_COMPAT, 'UTF-8', FALSE ); ?></h2>
          <span><?php echo htmlspecialchars( $prodCount, ENT_COMPAT, 'UTF-8', FALSE ); ?> Produtos</span>
        </div>
      </div>

      <div class="product-box-container">
        <?php $counter1=-1;  if( isset($produtos) && ( is_array($produtos) || $produtos instanceof Traversable ) && sizeof($produtos) ) foreach( $produtos as $key1 => $value1 ){ $counter1++; ?>
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
              <img src="./assets/distribuidores/<?php echo htmlspecialchars( $value1["distributor_logo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt="Logo do distribuidor - <?php echo htmlspecialchars( $value1["distributor_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
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

      <div class="pagination">
        <a class="arrow <?php if( $pagina <= 1 ){ ?>disabled<?php } ?>" href="<?php echo htmlspecialchars( $reqUrl, ENT_COMPAT, 'UTF-8', FALSE ); ?>?pagina=<?php echo htmlspecialchars( $pagina - 1, ENT_COMPAT, 'UTF-8', FALSE ); ?>"><i class="icofont-rounded-left"></i></a>
        
        <?php $counter1=-1; $newvar1=array(0,0,0); if( isset($newvar1) && ( is_array($newvar1) || $newvar1 instanceof Traversable ) && sizeof($newvar1) ) foreach( $newvar1 as $key1 => $value1 ){ $counter1++; ?>
        <?php $key1 = $key1 + 1 * $pagina; ?>
        <?php if( $pagina > 1 ){ ?> <?php $key1 -= 1; ?> <?php } ?>
        <?php if( $pagina == $paginas ){ ?> <?php $key1 -= 1; ?> <?php } ?>
        <?php if( $key1 > 0 && $key1 <= $paginas ){ ?>
        <a class="item <?php if( $pagina == $key1 ){ ?>active<?php } ?>" href="<?php echo htmlspecialchars( $reqUrl, ENT_COMPAT, 'UTF-8', FALSE ); ?>?pagina=<?php echo htmlspecialchars( $key1, ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $key1, ENT_COMPAT, 'UTF-8', FALSE ); ?></a>
        <?php } ?>
        <?php } ?>

        <a class="arrow <?php if( $pagina >= $paginas ){ ?>disabled<?php } ?>" href="<?php echo htmlspecialchars( $reqUrl, ENT_COMPAT, 'UTF-8', FALSE ); ?>?pagina=<?php echo htmlspecialchars( $pagina + 1, ENT_COMPAT, 'UTF-8', FALSE ); ?>"><i class="icofont-rounded-right"></i></a>
      </div>

      <?php }else{ ?>
      <div class="product-warning">
        <span>Opss!</span>
        <p>Não encontramos nada, que tal voltar para a lista</p>
        <p>Só clicar <a href="/produtos">aqui</a></p>
      </div>
      <?php } ?>

    </div>

  </div>
</div>