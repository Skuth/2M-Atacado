<?php if(!class_exists('Rain\Tpl')){exit;}?><nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
  <div class="container-fluid">
    <!-- Toggler -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Brand -->
    <a class="navbar-brand pt-0" href="/admin">
      <img src="../assets/img/logo.png" class="navbar-brand-img" alt="Logo">
    </a>
    <!-- User -->
    <?php $user = getUserSession(); ?>
    <ul class="nav align-items-center d-md-none">
      <li class="nav-item dropdown">
        <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <div class="media align-items-center">
            <span class="avatar avatar-sm rounded-circle">
              <img alt="Image placeholder" src="./assets/admin/img/theme/avatar.png">
            </span>
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
          <div class=" dropdown-header noti-title">
            <h6 class="text-overflow m-0">Bem vindo!</h6>
          </div>
          <a href="/admin/perfil/<?php echo htmlspecialchars( $user["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="dropdown-item">
            <i class="ni ni-single-02"></i>
            <span>Meu perfil</span>
          </a>
          <a href="/admin/logout" class="dropdown-item">
            <i class="fas fa-sign-out-alt"></i>
            <span>Sair</span>
          </a>
        </div>
      </li>
    </ul>
    <!-- Collapse -->
    <div class="collapse navbar-collapse" id="sidenav-collapse-main">
      <!-- Collapse header -->
      <div class="navbar-collapse-header d-md-none">
        <div class="row">
          <div class="col-6 collapse-brand">
            <a href="/admin">
              <img src="../assets/img/logo.png">
            </a>
          </div>
          <div class="col-6 collapse-close">
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
              <span></span>
              <span></span>
            </button>
          </div>
        </div>
      </div>
      <!-- Navigation -->
      <ul class="navbar-nav">
        
        <?php $navItems = getNav(); ?>
        <?php $counter1=-1;  if( isset($navItems) && ( is_array($navItems) || $navItems instanceof Traversable ) && sizeof($navItems) ) foreach( $navItems as $key1 => $value1 ){ $counter1++; ?>
        <?php if( $value1["nivel"] <= $user["type"] ){ ?>
        <li class="nav-item">          
          <?php if( isset($value1["submenu"]) ){ ?>
          <a class="nav-link collapsed" href="#navbar-dashboards" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-dashboards">
            <i class="<?php echo htmlspecialchars( $value1["icon"], ENT_COMPAT, 'UTF-8', FALSE ); ?> <?php echo htmlspecialchars( $value1["color"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"></i> <?php echo ucfirst($value1["name"]); ?>
          </a>
          <div class="collapse" id="navbar-dashboards">
            <ul class="nav nav-sm flex-column">
              <li class="nav-item">
                <a href="/admin/<?php echo htmlspecialchars( $value1["href"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="nav-link">
                  <span class="sidenav-normal"> <?php echo ucfirst($value1["name"]); ?> </span>
                </a>
              </li>
              <?php $counter2=-1;  if( isset($value1["submenu"]) && ( is_array($value1["submenu"]) || $value1["submenu"] instanceof Traversable ) && sizeof($value1["submenu"]) ) foreach( $value1["submenu"] as $key2 => $value2 ){ $counter2++; ?>
              <li class="nav-item">
                <a href="/admin/<?php echo htmlspecialchars( $value2["href"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="nav-link">
                  <span class="sidenav-normal"> <?php echo ucfirst($value2["name"]); ?> </span>
                </a>
              </li>
              <?php } ?>
            </ul>
          </div>
          <?php }else{ ?>
          <li class="nav-item"></li>
            <a class="nav-link" href="/admin/<?php echo htmlspecialchars( $value1["href"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              <i class="<?php echo htmlspecialchars( $value1["icon"], ENT_COMPAT, 'UTF-8', FALSE ); ?> <?php echo htmlspecialchars( $value1["color"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"></i> <?php echo ucfirst($value1["name"]); ?>
            </a>
          </li>
          <?php } ?>
        </li>
        <?php } ?>
        <?php } ?>
        
      </ul>
    </div>
  </div>
</nav>

<div class="main-content" id="panel">
  <!-- Topnav -->
  <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
    <div class="container-fluid">
      <!-- Brand -->
      <?php if( isset($page) ){ ?>
      <a class="h4 mb-0 text-white text-uppercase d-none d-md-inline-block d-lg-inline-block" href="/admin/<?php echo htmlspecialchars( $page["href"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $page["page"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a>
      <?php }else{ ?>
      <a class="h4 mb-0 text-white text-uppercase d-none d-md-inline-block d-lg-inline-block" href="/admin/dashboard">dashboard</a>
      <?php } ?>
      <!-- User -->
      <ul class="navbar-nav align-items-center d-none d-md-flex">
        <?php $lowStock = $GLOBALS["lowStock"]; ?>
        <ul class="navbar-nav align-items-center  ml-md-auto ">
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="ni ni-bell-55"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-xl  dropdown-menu-right  py-0 overflow-hidden">
            <!-- Dropdown header -->
            <div class="px-3 py-3">
              <h6 class="text-sm text-muted m-0">Você tem <strong class="text-primary"><?php echo count($lowStock); ?></strong> notificações.</h6>
            </div>
            <!-- List group -->
            <div class="list-group list-group-flush">

              <?php $counter1=-1;  if( isset($lowStock) && ( is_array($lowStock) || $lowStock instanceof Traversable ) && sizeof($lowStock) ) foreach( $lowStock as $key1 => $value1 ){ $counter1++; ?>
              <?php if( $key1 < 4 ){ ?>
              <div class="list-group-item list-group-item-action">
                <div class="row align-items-center">
                  <div class="col-auto">
                    <!-- Avatar -->
                    <img alt="Image placeholder" src="./assets/produtos/<?php echo htmlspecialchars( $value1["product_pictures"]["0"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="avatar rounded-circle">
                  </div>
                  <div class="col ml--2">
                    <div class="d-flex justify-content-between align-items-center">
                      <div>
                        <h4 class="mb-0 text-sm"><?php echo htmlspecialchars( $value1["product_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h4>
                      </div>
                    </div>
                    <?php if( $value1["product_stock"] > 0 ){ ?>
                    <p class="text-sm mb-0">Você está ficando sem estoque, no momento você tem <?php echo htmlspecialchars( $value1["product_stock"], ENT_COMPAT, 'UTF-8', FALSE ); ?> em estoque!</p>
                    <?php }else{ ?>
                    <p class="text-sm mb-0">Você está sem estoque, <?php echo htmlspecialchars( $value1["product_stock"], ENT_COMPAT, 'UTF-8', FALSE ); ?> em estoque!</p>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <?php } ?>
              <?php } ?>

            </div>
            <!-- View all -->
            <?php if( count($lowStock) > 4 ){ ?>
            <a href="/admin/notificacoes" class="dropdown-item text-center text-primary font-weight-bold py-3">Ver todas</a>
            <?php } ?>
          </div>
        </li>
      </ul>
        <li class="nav-item dropdown">
          <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <img alt="Image placeholder" src="./assets/admin/img/theme/avatar.png">
              </span>
              <div class="media-body ml-2 d-none d-lg-block">
                <span class="mb-0 text-sm font-weight-bold"><?php echo htmlspecialchars( $user["name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
              </div>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Bem vindo!</h6>
            </div>
            <a href="/admin/perfil/<?php echo htmlspecialchars( $user["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span>Meu perfil</span>
            </a>
            <a href="/admin/logout" class="dropdown-item">
              <i class="fas fa-sign-out-alt"></i>
              <span>Sair</span>
            </a>
          </div>
        </li>
      </ul>
    </div>
  </nav>
  <!-- Header -->