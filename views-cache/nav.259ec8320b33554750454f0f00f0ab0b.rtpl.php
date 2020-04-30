<?php if(!class_exists('Rain\Tpl')){exit;}?><nav class="navigation <?php echo htmlspecialchars( $navStyle, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
  <div class="navigation-header">
    <div class="header-container">
      <a href="./"><img src="./assets/img/logo.png" alt="Logo 2M Atacado"></a>
    </div>
  </div>
  <div class="navigation-links">
    <div class="links-container">
      <ul class="left">
        <li><a href="./">Inicio</a></li>
        <li><a href="#">Home</a></li>
        <li><a href="#">Home</a></li>
        <li><a href="#">Home</a></li>
      </ul>
      <ul class="right">
        <li><a href="#">
          <i class="icofont-bag"></i>
          <?php if( isset($_SESSION['cart']) ){ ?>
          <span class="badge" id="cart">0</span>
          <?php } ?>
        </a></li>
        <li><a href="#"><i class="icofont-search"></i></a></li>
      </ul>
    </div>
  </div>
</nav>