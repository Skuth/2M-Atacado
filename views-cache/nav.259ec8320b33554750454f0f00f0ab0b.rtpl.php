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
            <li><a href="/produtos/departamento?nome=<?php echo htmlspecialchars( $value1["department_href"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><i class="<?php echo htmlspecialchars( $value1["department_icon"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"></i> <?php echo htmlspecialchars( $value1["department_text"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a></li>
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
            <li><a href="/distribuidor/<?php echo htmlspecialchars( $value1["department_href"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["department_text"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a></li>
            <?php } ?>
          </ul>
        </li>
        <?php } ?>
        <li><a href="/sobre">Sobre</a></li>
      </ul>
      <ul class="right">
        <li><a href="/carrinho">
          <i class="icofont-bag"></i>
          <?php if( isset($_SESSION['cart']) ){ ?>
            <?php $cart = $_SESSION["cart"]; ?>
            <?php if( count($cart) > 0 ){ ?>
            <span class="badge" id="cart"><?php echo count($cart); ?></span>
            <?php } ?>
          <?php } ?>
        </a></li>
        <li><a><i class="icofont-search"></i></a></li>
      </ul>
    </div>
  </div>
</nav>