<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="row">
    <div class="col-xl-12 order-xl-1">
      <div class="card">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col-8">
              <h3 class="mb-0">Administração do site</h3>
            </div>
            <div class="col-4 text-right">
              <a href="/admin/administracao/logo/editar" class="btn btn-sm btn-primary">Logo</a>
              <a href="/admin/administracao/banner/editar" class="btn btn-sm btn-primary">Banner</a>
              <a href="/admin/administracao/editar" class="btn btn-sm btn-primary">Editar</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form>
            <h6 class="heading-small text-muted mb-4">Informações de site</h6>
            <div class="pl-lg-4">
              <div class="row">

                <div class="col-lg-12">
                  <div class="form-group">
                    <label class="form-control-label"><i class="icofont-google-map"></i> Endereço</label>
                    <input type="text" id="input-username" name="address" class="form-control" disabled value="<?php echo htmlspecialchars( $data["site_data_address"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label"><i class="icofont-id-card"></i> CNPJ</label>
                    <input type="text" class="form-control" name="cnpj" disabled value="<?php echo htmlspecialchars( $data["site_data_cnpj"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label"><i class="icofont-files-stack"></i> Inscrição Estadual</label>
                    <input type="text" class="form-control" name="ie" disabled value="<?php echo htmlspecialchars( $data["site_data_ie"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label"><i class="icofont-phone"></i> Tel</label>
                    <input type="text" class="form-control" name="tel" disabled value="<?php echo htmlspecialchars( $data["site_data_tel"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label"><i class="icofont-ui-email"></i> E-mail</label>
                    <input type="email" class="form-control" name="email" disabled value="<?php echo htmlspecialchars( $data["site_data_email"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                  </div>
                </div>

                <div class="col-lg-12">
                  <div class="form-group">
                    <label class="form-control-label"><i class="icofont-clock-time"></i> Horário de funcionamento</label>
                    <input type="text" class="form-control" name="hf" disabled value="<?php echo htmlspecialchars( $data["site_data_oh"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                  </div>
                </div>

              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>