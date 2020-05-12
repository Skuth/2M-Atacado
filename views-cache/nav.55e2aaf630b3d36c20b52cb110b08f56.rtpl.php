<?php if(!class_exists('Rain\Tpl')){exit;}?><nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
  <div class="container-fluid">
    <!-- Toggler -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Brand -->
    <a class="navbar-brand pt-0" href="/admin">
      <img src="./assets/admin/img/brand/blue.png" class="navbar-brand-img" alt="...">
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
              <img src="./assets/admin/img/brand/blue.png">
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
          <a class="nav-link" href="/admin/<?php echo htmlspecialchars( $value1["href"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            <i class="<?php echo htmlspecialchars( $value1["icon"], ENT_COMPAT, 'UTF-8', FALSE ); ?> <?php echo htmlspecialchars( $value1["color"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"></i> <?php echo ucfirst($value1["name"]); ?>
          </a>
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
      <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="/admin/<?php echo htmlspecialchars( $page["href"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $page["page"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a>
      <?php }else{ ?>
      <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="/admin/dashboard">dashboard</a>
      <?php } ?>
      <!-- User -->
      <ul class="navbar-nav align-items-center d-none d-md-flex">
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