<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="container">
  <div class="slide">
    <div class="controls">
      <span><i class="icofont-thin-left"></i></span>
      <span><i class="icofont-thin-right"></i></span>
    </div>
    <div class="container-header-slider">
      <?php $counter1=-1;  if( isset($sliders) && ( is_array($sliders) || $sliders instanceof Traversable ) && sizeof($sliders) ) foreach( $sliders as $key1 => $value1 ){ $counter1++; ?>
        <?php if( $value1["slider_status"] == 1 ){ ?>
        <a class="banner" <?php if( $value1["slider_href"] != NULL ){ ?>href="<?php echo htmlspecialchars( $value1["slider_href"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"<?php } ?>>
          <img src="./assets/banner/<?php echo htmlspecialchars( $value1["slider_img"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt="<?php echo htmlspecialchars( $value1["slider_description"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
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

    <a class="card" href="/departamentos/ferramentas">
      <div class="card-header">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 340.931 175.06">
          <path class="card-svg-header" d="M113,6042.624s87.134,78.225,173.486,44.7,89.451-108.392,131.993-143.073c9.711-9.248,35.452-23.635,35.452-23.635L113,5920.971Z" transform="translate(-113 -5920.615)"/>
        
          <text x="60" y="50">Ferramentas</text>
          <text x="60" y="90">a partir de</text>
          <text x="60" y="135" class="textrice">R$ <tspan >89</tspan ><tspan >,99</tspan ></text>
        </svg>
      </div>
      <div class="card-image">
        <img src="https://brasmetal.com/wp-content/uploads/2019/02/Imagens-recortadas_48.png" alt="">
      </div>
    </a>

    <a class="card" href="/departamentos/ferramentas">
      <div class="card-header">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 340.931 175.06">
          <path class="card-svg-header red" d="M113,6042.624s87.134,78.225,173.486,44.7,89.451-108.392,131.993-143.073c9.711-9.248,35.452-23.635,35.452-23.635L113,5920.971Z" transform="translate(-113 -5920.615)"/>
        
          <text x="60" y="50">Ferramentas</text>
          <text x="60" y="90">a partir de</text>
          <text x="60" y="135" class="textrice">R$ <tspan >89</tspan ><tspan >,99</tspan ></text>
        </svg>
      </div>
      <div class="card-image">
        <img src="https://brasmetal.com/wp-content/uploads/2019/02/Imagens-recortadas_48.png" alt="">
      </div>
    </a>

    <a class="card" href="/departamentos/ferramentas">
      <div class="card-header">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 340.931 175.06">
          <path class="card-svg-header orange" d="M113,6042.624s87.134,78.225,173.486,44.7,89.451-108.392,131.993-143.073c9.711-9.248,35.452-23.635,35.452-23.635L113,5920.971Z" transform="translate(-113 -5920.615)"/>
        
          <text x="60" y="50">Ferramentas</text>
          <text x="60" y="90">a partir de</text>
          <text x="60" y="135" class="textrice">R$ <tspan >89</tspan ><tspan >,99</tspan ></text>
        </svg>
      </div>
      <div class="card-image">
        <img src="https://brasmetal.com/wp-content/uploads/2019/02/Imagens-recortadas_48.png" alt="">
      </div>
    </a>

  </div>
</div>

<div class="products-box">
  <div class="products-box-header">
    <div class="title">
      <p>Ofertas</p>
    </div>
  </div>

  <div class="product-box-container" id="products-off">
    <?php $counter1=-1; $newvar1=array(1,1,1,1); if( isset($newvar1) && ( is_array($newvar1) || $newvar1 instanceof Traversable ) && sizeof($newvar1) ) foreach( $newvar1 as $key1 => $value1 ){ $counter1++; ?>
    <a class="product-box" href="/produto/nome-do-produto/<?php echo htmlspecialchars( $key1, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
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
  <div class="btn-container btn-container-center">
    <a href="/produtos/ofertas" class="btn btn-center btn-circle btn-blue btn-big btn-cap">Ver todas</a>
  </div>
</div>

<div class="products-box">
  <div class="products-box-header">
    <div class="title">
      <p>Mais vistos</p>
    </div>
  </div>

  <div class="product-box-container">
    <?php $counter1=-1; $newvar1=array(1,1,1,1); if( isset($newvar1) && ( is_array($newvar1) || $newvar1 instanceof Traversable ) && sizeof($newvar1) ) foreach( $newvar1 as $key1 => $value1 ){ $counter1++; ?>
    <a class="product-box" href="/produto/nome-do-produto/<?php echo htmlspecialchars( $key1, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
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
    <?php $counter1=-1; $newvar1=array(1,1,1,1); if( isset($newvar1) && ( is_array($newvar1) || $newvar1 instanceof Traversable ) && sizeof($newvar1) ) foreach( $newvar1 as $key1 => $value1 ){ $counter1++; ?>
    <a class="product-box" href="/produto/nome-do-produto/<?php echo htmlspecialchars( $key1, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
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
          <p>R$ <span>39</span><span>,00</span></p>
        </div>
      </div>
    </a>
    <?php } ?>
  </div>
  <div class="btn-container btn-container-center">
    <a href="/produtos" class="btn btn-center btn-circle btn-blue btn-big btn-cap">Ver todos</a>
  </div>
</div>