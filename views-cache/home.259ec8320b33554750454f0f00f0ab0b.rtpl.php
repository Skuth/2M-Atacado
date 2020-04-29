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
      <a class="box" href="/departments/<?php echo htmlspecialchars( $value1["href"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
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
