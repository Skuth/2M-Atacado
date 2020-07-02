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
            <h5 class="h3"><?php echo htmlspecialchars( $client["client_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?>#<?php echo htmlspecialchars( $client["client_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h5>
            <div class="h5 font-weight-300"><span class="badge badge-pill badge-info"><?php if( $client["client_type"] == 1 ){ ?>Empresa<?php }else{ ?>Pessoal<?php } ?></span></div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-8 order-xl-1">
      <div class="card">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col-8">
              <h3 class="mb-0">Cliente: <?php echo htmlspecialchars( $client["client_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?>#<?php echo htmlspecialchars( $client["client_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
            </div>
            <div class="col-4 text-right">
              <a href="/admin/cliente/editar/<?php echo htmlspecialchars( $client["client_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-sm btn-primary">Editar</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form>
            <h6 class="heading-small text-muted mb-4">Informação de cliente</h6>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <?php if( $client["client_cpf"] != NULL ){ ?>
                    <label class="form-control-label">Nome</label>
                    <?php }else{ ?>
                    <label class="form-control-label">Razão social</label>
                    <?php } ?>
                    <input type="text" id="input-username" class="form-control" disabled value="<?php echo htmlspecialchars( $client["client_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                  </div>
                </div>
                <?php if( $client["client_cpf"] != '' ){ ?>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label">Cpf</label>
                    <input type="text" class="form-control" disabled value="<?php echo htmlspecialchars( $client["client_cpf"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                  </div>
                </div>
                <?php } ?>
                <?php if( $client["client_cnpj"] != '' ){ ?>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label">Cnpj</label>
                    <input type="text" class="form-control" disabled value="<?php echo htmlspecialchars( $client["client_cnpj"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                  </div>
                </div>
                <?php } ?>
                <?php if( $client["client_ie"] != '' ){ ?>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label">Inscrição Estadual</label>
                    <input type="text" class="form-control" disabled value="<?php echo htmlspecialchars( $client["client_ie"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                  </div>
                </div>
                <?php } ?>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label">Email</label>
                    <input type="email" class="form-control" disabled value="<?php echo htmlspecialchars( $client["client_email"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label">Telefone</label>
                    <input type="text" class="form-control" disabled value="<?php echo formatPhone($client["client_phone"]); ?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label">Tipo de cliente</label>
                    <br>
                    <span class="badge badge-pill badge-info"><?php if( $client["client_type"] == 1 ){ ?>Empresa<?php }else{ ?>Pessoal<?php } ?></span>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label">Status do cliente</label>
                    <br>
                    <span class="badge badge-pill badge-info"><?php if( $client["client_status"] == 1 ){ ?>Ativado<?php }else{ ?>Desativado<?php } ?></span>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label">Última conexão</label>
                    <?php $lc = date('d/m/Y H:i:s', strtotime($client["client_last_connect"])); ?>
                    <br>
                    <span class="badge badge-pill badge-info"><?php echo htmlspecialchars( $lc, ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label">Último ip conectado</label>
                    <br>
                    <span class="badge badge-pill badge-info"><?php echo htmlspecialchars( $client["client_last_ip_connect"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>