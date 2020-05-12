<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="product-container">
  <div class="product-page-container">
    <div class="product-page-picture">
      <div class="product-page-carrossel">
        <div class="product-page-carrossel-box">
          <img src="https://www.texturasdobrasil.com.br/image/cache/data/massa%20corrida%20coral%202-800x800.png" alt="Carrossel image">
        </div>
        <div class="product-page-carrossel-box">
          <img src="https://www.texturasdobrasil.com.br/image/cache/data/massa%20corrida%20coral%202-800x800.png" alt="Carrossel image">
        </div>
        <div class="product-page-carrossel-box">
          <img src="https://www.texturasdobrasil.com.br/image/cache/data/massa%20corrida%20coral%202-800x800.png" alt="Carrossel image">
        </div>
      </div>
      <div class="product-page-center-image">
        <img src="https://www.texturasdobrasil.com.br/image/cache/data/massa corrida coral 2-800x800.png" alt="Center image">
      </div>
    </div>
    <div class="product-page-info">
      <h2>Massa corrida uso interno cinza 20kg</h2>
      <img src="https://logodownload.org/wp-content/uploads/2019/07/coral-logo.png" alt="Logo Marca" width="50" class="product-page-brand">
      <span class="ref">REF: 051984156</span>
      <div class="product-price">
        <s class="old-price">R$ <span>59</span><span>,00</span></s>
        <p>R$ <span>39</span><span>,00</span></p>
      </div>
      <a href="#" class="btn btn-blue btn-circle btn-medium">Adicionar ao carrinho</a>
    </div>
    <div class="product-page-description">
      <h3>Descrição</h3>
      <div class="product-page-description-box">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam nam atque maxime reiciendis quis eaque natus! Explicabo nemo aliquam et iusto cum, quisquam, impedit, expedita unde numquam fugiat repudiandae maxime!</p>
        <br>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam nam atque maxime reiciendis quis eaque natus! Explicabo nemo aliquam et iusto cum, quisquam, impedit, expedita unde numquam fugiat repudiandae maxime!</p>
        <br>
        <b>Random text</b>
        <br>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam nam atque maxime reiciendis quis eaque natus! Explicabo nemo aliquam et iusto cum, quisquam, impedit, expedita unde numquam fugiat repudiandae maxime!</p>
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