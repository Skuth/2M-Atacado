<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="row">
    <div class="col-xl-4 order-xl-2">
      <div class="card card-profile">
        <img src="./assets/admin/img/theme/img-1-1000x600.jpg" alt="Image placeholder" class="card-img-top">
        <div class="row justify-content-center">
          <div class="col-lg-3 order-lg-2">
            <div class="card-profile-image">
              <img src="./assets/admin/img/theme/avatar.png" width="140" class="rounded-circle">
            </div>
          </div>
        </div>
        <div class="card-body pt-0 mt-8">
          <div class="text-center">
            <h5 class="h3"><?php echo htmlspecialchars( $user["fname"], ENT_COMPAT, 'UTF-8', FALSE ); ?> <?php echo htmlspecialchars( $user["lname"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h5>
            <div class="h5 font-weight-300"><span class="badge badge-pill badge-info"><?php if( $user["type"] == 1 ){ ?>Usuário<?php }elseif( $user["type"] == 2 ){ ?>Administrador<?php }else{ ?>Super Administrador<?php } ?></span></div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-8 order-xl-1">
      <div class="card">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col-8">
              <h3 class="mb-0">Meu perfil</h3>
            </div>
            <div class="col-4 text-right">
              <a href="/admin/usuarios/editar/<?php echo htmlspecialchars( $user["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-sm btn-primary">Editar</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form>
            <h6 class="heading-small text-muted mb-4">Informação de usuário</h6>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label">Usuário</label>
                    <input type="text" id="input-username" class="form-control" disabled value="<?php echo htmlspecialchars( $user["user"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label">Cargo</label>
                    <input type="text" class="form-control" disabled value="<?php if( $user["type"] == 1 ){ ?>Usuário<?php }elseif( $user["type"] == 2 ){ ?>Administrador<?php }else{ ?>Super Administrador<?php } ?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label">Nome</label>
                    <input type="text" class="form-control" disabled value="<?php echo htmlspecialchars( $user["fname"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label">Sobrenome</label>
                    <input type="text" class="form-control" disabled value="<?php echo htmlspecialchars( $user["lname"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>