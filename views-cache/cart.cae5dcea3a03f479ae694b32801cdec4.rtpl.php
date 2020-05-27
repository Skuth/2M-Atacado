<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="cart-container">
  <div class="cart-content">
    <?php if( true == false ){ ?>
    <div class="cart-content-items">
      <?php $counter1=-1; $newvar1=array(1,1); if( isset($newvar1) && ( is_array($newvar1) || $newvar1 instanceof Traversable ) && sizeof($newvar1) ) foreach( $newvar1 as $key1 => $value1 ){ $counter1++; ?>
      <div class="box">
        <div class="picture">
          <img src="https://www.texturasdobrasil.com.br/image/cache/data/massa%20corrida%20coral%202-800x800.png" alt="">
        </div>
        <div class="info">
          <p class="title">Massa corrida</p>
          <div class="action">
            <p class="remove">Excluir</p>
          </div>
        </div>
        <div class="quantity">
          <p>1</p>
        </div>
        <div class="price">
          <span class="old-price">
            <span class="discount">30%</span>
            <s>R$ 59,00</s>
          </span>
          <span>R$ 39,00</span>
        </div>
      </div>
      <?php } ?>
    </div>
    <div class="cart-content-info">
      <div class="cart-info">
        <p>Produtos <span>2</span></p>
        <p>Total <span>R$ 78,00</span></p>
      </div>
    </div>
    <div class="cart-content-info">
      <a href="#" class="btn btn-circle btn-blue btn-medium">Confirmar orçamento</a>
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