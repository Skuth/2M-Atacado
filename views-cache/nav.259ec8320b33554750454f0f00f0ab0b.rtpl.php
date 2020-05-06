<?php if(!class_exists('Rain\Tpl')){exit;}?><nav class="navigation <?php if( isset($navStyle) ){ ?><?php echo htmlspecialchars( $navStyle, ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?>">
  <div class="navigation-header">
    <div class="header-container">
      <a href="./"><img src="./assets/img/logo.png" alt="Logo 2M Atacado"></a>
    </div>
  </div>
  <div class="navigation-links">
    <div class="links-container">
      <ul class="left">
        <li><a href="./">Inicio</a></li>
        <?php $departments = getDepartments(); ?>
        <?php if( $departments !== NULL ){ ?>
        <li class="submenu">
          <a>Departamentos <i class="icofont-rounded-down"></i></a>
          <ul>
            <?php $counter1=-1;  if( isset($departments) && ( is_array($departments) || $departments instanceof Traversable ) && sizeof($departments) ) foreach( $departments as $key1 => $value1 ){ $counter1++; ?>
            <li><a href="/departamentos/<?php echo htmlspecialchars( $value1["href"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><i class="<?php echo htmlspecialchars( $value1["icon"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"></i> <?php echo htmlspecialchars( $value1["text"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a></li>
            <?php } ?>
          </ul>
        </li>
        <?php } ?>
        <?php $departments = getDepartments(); ?>
        <?php if( $departments !== NULL ){ ?>
        <li class="submenu">
          <a>Distribuidoras <i class="icofont-rounded-down"></i></a>
          <ul>
            <?php $counter1=-1;  if( isset($departments) && ( is_array($departments) || $departments instanceof Traversable ) && sizeof($departments) ) foreach( $departments as $key1 => $value1 ){ $counter1++; ?>
            <li><a href="/sobre/<?php echo htmlspecialchars( $value1["href"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["text"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a></li>
            <?php } ?>
          </ul>
        </li>
        <?php } ?>
        <li><a href="/sobre">Sobre</a></li>
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