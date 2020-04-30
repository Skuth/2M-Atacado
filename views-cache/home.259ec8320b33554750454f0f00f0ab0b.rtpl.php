<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="container">
  <div class="slide">
    <div class="controls">
      <span><i class="icofont-thin-left"></i></span>
      <span><i class="icofont-thin-right"></i></span>
    </div>
    <div class="banner">
      <div class="text">
        <p>titulo do slider</p>
        <span>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Saepe unde velit quos, dolorum, nisi illo, iure voluptatem asperiores magni suscipit repellendus! Sequi vitae dolorem, deserunt labore magni iste distinctio dolorum.</span>
      </div>
      <img src="https://www.cimentoitambe.com.br/wp-content/uploads/2019/02/loja_material.jpg" alt="">
    </div>
  </div>

  <div class="departments">
    <h2>Departamentos</h2>
    <div class="departments-container">
      <?php $counter1=-1;  if( isset($departments) && ( is_array($departments) || $departments instanceof Traversable ) && sizeof($departments) ) foreach( $departments as $key1 => $value1 ){ $counter1++; ?>
      <a class="box" href="/departamentos/<?php echo htmlspecialchars( $value1["href"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
        <div class="icon">
          <i class="<?php echo htmlspecialchars( $value1["icon"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"></i>
        </div>
        <div class="text">
          <p><?php echo htmlspecialchars( $value1["text"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
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
        </svg>
        <div class="card-header-text">
          <p>Ferramentas</p>
          <p>a partir de</p>
          <p class="price">R$ <span>89</span><span>,99</span></p>
        </div>
      </div>
      <div class="card-image">
        <img src="https://brasmetal.com/wp-content/uploads/2019/02/Imagens-recortadas_48.png" alt="">
      </div>
    </a>

    <a class="card" href="/departamentos/ferramentas">
      <div class="card-header">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 340.931 175.06">
          <path class="card-svg-header red" d="M113,6042.624s87.134,78.225,173.486,44.7,89.451-108.392,131.993-143.073c9.711-9.248,35.452-23.635,35.452-23.635L113,5920.971Z" transform="translate(-113 -5920.615)"/>
        </svg>
        <div class="card-header-text">
          <p>Ferramentas</p>
          <p>a partir de</p>
          <p class="price">R$ <span>89</span><span>,99</span></p>
        </div>
      </div>
      <div class="card-image">
        <img src="https://brasmetal.com/wp-content/uploads/2019/02/Imagens-recortadas_48.png" alt="">
      </div>
    </a>

    <a class="card" href="/departamentos/ferramentas">
      <div class="card-header">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 340.931 175.06">
          <path class="card-svg-header orange" d="M113,6042.624s87.134,78.225,173.486,44.7,89.451-108.392,131.993-143.073c9.711-9.248,35.452-23.635,35.452-23.635L113,5920.971Z" transform="translate(-113 -5920.615)"/>
        </svg>
        <div class="card-header-text">
          <p>Ferramentas</p>
          <p>a partir de</p>
          <p class="price">R$ <span>89</span><span>,99</span></p>
        </div>
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

  <div class="product-box-container bg">
    <?php $counter1=-1; $newvar1=array(1,1,1,1); if( isset($newvar1) && ( is_array($newvar1) || $newvar1 instanceof Traversable ) && sizeof($newvar1) ) foreach( $newvar1 as $key1 => $value1 ){ $counter1++; ?>
    <a class="product-box" href="#">
      <div class="product-brand">
        <span>Coral</span>
      </div>
      <div class="product-picture">
        <img src="https://www.texturasdobrasil.com.br/image/cache/data/massa%20corrida%20coral%202-800x800.png" alt="Foto do produto">
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

<div class="products-box">
  <div class="products-box-header">
    <div class="title">
      <p>Mais vistos</p>
    </div>
  </div>

  <div class="product-box-container no-bg">
    <?php $counter1=-1; $newvar1=array(1,1,1,1); if( isset($newvar1) && ( is_array($newvar1) || $newvar1 instanceof Traversable ) && sizeof($newvar1) ) foreach( $newvar1 as $key1 => $value1 ){ $counter1++; ?>
    <a class="product-box" href="#">
      <div class="product-brand">
        <span>Coral</span>
      </div>
      <div class="product-picture">
        <img src="https://www.texturasdobrasil.com.br/image/cache/data/massa%20corrida%20coral%202-800x800.png" alt="Foto do produto">
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

<div class="products-box">
  <div class="products-box-header">
    <div class="title">
      <p>Alguns produtos</p>
    </div>
  </div>

  <div class="product-box-container">
    <?php $counter1=-1; $newvar1=array(1,1,1,1,1); if( isset($newvar1) && ( is_array($newvar1) || $newvar1 instanceof Traversable ) && sizeof($newvar1) ) foreach( $newvar1 as $key1 => $value1 ){ $counter1++; ?>
    <a class="product-box" href="#">
      <div class="product-brand">
        <span>Coral</span>
      </div>
      <div class="product-picture">
        <img src="https://www.texturasdobrasil.com.br/image/cache/data/massa%20corrida%20coral%202-800x800.png" alt="Foto do produto">
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
</div>