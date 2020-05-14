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
              <h3 class="mb-0">Editando banner</h3>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form method="POST" action="/admin/banner/editar" enctype="multipart/form-data">
            <div class="pl-lg-4">

              <input type="hidden" name="id" value="<?php echo htmlspecialchars( $banner["slider_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">

              <div class="row">
                <div class="col-lg-5">
                  <div class="form-group">
                    <label class="form-control-label">Descrição</label>
                    <input type="text" class="form-control" name="descricao" required value="<?php echo htmlspecialchars( $banner["slider_description"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                  </div>
                </div>

                <div class="col-lg-5">
                  <div class="form-group">
                    <label class="form-control-label">Url de redirecionamento</label>
                    <input type="text" class="form-control" name="href" value="<?php echo htmlspecialchars( $banner["slider_href"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                  </div>
                </div>

                <div class="col-lg-2">
                  <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status">
                      <option value="1" <?php if( $banner["slider_status"] == 1 ){ ?>selected<?php } ?>>Ativado</option>
                      <option value="0" <?php if( $banner["slider_status"] == 0 ){ ?>selected<?php } ?>>Desativado</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row mb-4">
                <div class="col-lg-12">
                  <div class="custom-file">
                    <input type="file" accept="image/x-png,image/jpg,image/jpeg" name="banner">
                  </div>
                </div>
              </div>

              <button class="btn btn-icon btn-primary" type="submit" name="save">
                <span class="btn-inner--icon"><i class="fas fa-save"></i></span>
                <span class="btn-inner--text">Cadastrar</span>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>