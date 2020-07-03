<?php if(!class_exists('Rain\Tpl')){exit;}?><?php $siteData = $GLOBALS["siteData"]; ?>
<nav class="navigation <?php if( isset($navStyle) ){ ?><?php echo htmlspecialchars( $navStyle, ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?>">
  <div class="navigation-header">
    <div class="header-container">
      <a href="./" class="logo-image"><img src="./assets/img/<?php echo htmlspecialchars( $siteData['site_data_logo'], ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt="Logo <?php echo htmlspecialchars( $siteData['site_data_name'], ENT_COMPAT, 'UTF-8', FALSE ); ?>"></a>
      <?php if( isset($_SESSION['client']) ){ ?>
      <ul class="client-submenu">
        <?php $client = $_SESSION["client"]["client_name"]; ?>
        <li onclick="openSub(this, event)"><a class="btn btn-circle"><i class="icofont-ui-user"></i> <?php if( strlen($client) >= 15 ){ ?> <?php echo substr($client, 0, 15); ?>... <?php }else{ ?> <?php echo htmlspecialchars( $client, ENT_COMPAT, 'UTF-8', FALSE ); ?> <?php } ?></a>
          <ul>
            <li><a href="/cliente/dashboard"><i class="icofont-bag"></i>Compras</a></li>
            <li><a href="/cliente/logout"><i class="icofont-logout"></i>Logout</a></li>
          </ul>
        </li>
      </ul>
      <?php }else{ ?>
      <a href="/cliente/login" class="btn btn-circle"><i class="icofont-sign-in"></i> Entrar</a>
      <?php } ?>
    </div>
  </div>
  <div class="navigation-links">
    <div class="links-container">
      <ol>
        <li><o href="#" id="mobile"><i class="icofont-navigation-menu"></i></o></li>
      </ol>
      <div id="mobileNav">
        <ul class="left">
          <li><a href="./">Inicio</a></li>
          <li><a href="/produtos">Produtos</a></li>
          <?php $departments = getDepartments(); ?>
          <?php if( $departments !== NULL ){ ?>
          <li class="submenu">
            <a>Departamentos <i class="icofont-rounded-down"></i></a>
            <ul>
              <?php $counter1=-1;  if( isset($departments) && ( is_array($departments) || $departments instanceof Traversable ) && sizeof($departments) ) foreach( $departments as $key1 => $value1 ){ $counter1++; ?>
              <li><a href="/produtos/departamento/<?php echo htmlspecialchars( $value1["department_href"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><i class="<?php echo htmlspecialchars( $value1["department_icon"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"></i> <?php echo htmlspecialchars( $value1["department_text"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a></li>
              <?php } ?>
            </ul>
          </li>
          <?php } ?>
          <?php $distributors = getDistributors(); ?>
          <?php if( $distributors !== NULL ){ ?>
          <li class="submenu">
            <a>Distribuidoras <i class="icofont-rounded-down"></i></a>
            <ul>
              <?php $counter1=-1;  if( isset($distributors) && ( is_array($distributors) || $distributors instanceof Traversable ) && sizeof($distributors) ) foreach( $distributors as $key1 => $value1 ){ $counter1++; ?>
              <?php if( $value1["distributor_id"] > 0 ){ ?><li><a href="/distribuidor/<?php echo htmlspecialchars( $value1["distributor_href"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["distributor_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a></li><?php } ?>
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
          <li class="search-sub" onclick="openSub(this, event)"><a><i class="icofont-search"></i></a>
          <ul>
            <li><input autofocus type="text" name="search" placeholder="Pesquisar" onkeydown="productSearch(this.value, event)"></li>
          </ul>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>