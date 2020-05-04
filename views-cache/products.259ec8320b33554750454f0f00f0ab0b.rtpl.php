<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="container">
  <div class="products-container">

    <div class="products-container-sidebar">
      <div class="sidebar-box">
        <span>Marcas <i class="icofont-simple-down"></i></span>
        <ul class="sidebar-items">
          <li><a href="#">Item ( 14 )</a></li>
          <li><a href="#">Item ( 14 )</a></li>
        </ul>
      </div>
      <div class="sidebar-box">
        <span>Categorias <i class="icofont-simple-down"></i></span>
        <ul class="sidebar-items">
          <li><a href="#">Item ( 14 )</a></li>
          <li><a href="#">Item ( 1 )</a></li>
          <li><a href="#">Item ( 14 )</a></li>
          <li><a href="#">Item ( 4 )</a></li>
          <li><a href="#">Item ( 62 )</a></li>
          <li><a href="#">Item ( 14 )</a></li>
          <li><a href="#">Item ( 14 )</a></li>
          <li><a href="#">Item ( 5 )</a></li>
          <li><a href="#">Item ( 14 )</a></li>
          <li><a href="#">Item ( 12 )</a></li>
        </ul>
      </div>
    </div>

    <div class="products-container-content">

      <div class="products-header-container">
        <div class="text-info">
          <h2>Todos produtos</h2>
          <span>87 Produtos</span>
        </div>
      </div>

      <div class="product-box-container">
        <?php $counter1=-1; $newvar1=array(1,1,1,1,1,1,1,1,1,1,1,1); if( isset($newvar1) && ( is_array($newvar1) || $newvar1 instanceof Traversable ) && sizeof($newvar1) ) foreach( $newvar1 as $key1 => $value1 ){ $counter1++; ?>
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
              <p>R$ <span>39</span><span>,00</span></p>
            </div>
          </div>
        </a>
        <?php } ?>
      </div>

      <div class="pagination">
        <span class="arrow"><i class="icofont-rounded-left"></i></span>
        <div class="item">1</div>
        <div class="item active">2</div>
        <div class="item">3</div>
        <span class="arrow"><i class="icofont-rounded-right"></i></span>
      </div>

    </div>

  </div>
</div>