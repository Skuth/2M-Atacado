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
              <h3 class="mb-0">Editando distribuidor</h3>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form method="POST" action="/admin/distribuidor/editar" enctype="multipart/form-data">
            <div class="pl-lg-4">

              <input type="hidden" name="id" value="<?php echo htmlspecialchars( $distribuidor["distributor_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">

              <div class="row">
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Distribuidor</label>
                    <input type="text" class="form-control" name="distribuidor" required value="<?php echo htmlspecialchars( $distribuidor["distributor_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                  </div>
                </div>

                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Endereço</label>
                    <input type="text" class="form-control" name="endereco" required value="<?php echo htmlspecialchars( $distribuidor["distributor_address"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                  </div>
                </div>

                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Link</label>
                    <input type="text" class="form-control" name="href" required value="<?php echo htmlspecialchars( $distribuidor["distributor_href"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                  </div>
                </div>

                <div class="col-lg-12">
                  <div class="form-group">
                    <label>Descrição</label>
                    <textarea class="form-control" name="descricao" rows="10" required><?php echo htmlspecialchars( $distribuidor["distributor_description"], ENT_COMPAT, 'UTF-8', FALSE ); ?></textarea>
                  </div>
                </div>

                <div class="col-lg-6 mb-4">
                  <div class="custom-file">
                    <label class="form-control-label">Logo</label>
                    <input type="file" class="form-control" accept="image/x-png,image/jpg,image/jpeg" name="logo">
                  </div>
                </div>

                <div class="col-lg-6 mb-4">
                  <div class="custom-file">
                    <label class="form-control-label">Banner</label>
                    <input type="file" class="form-control" accept="image/x-png,image/jpg,image/jpeg" name="banner">
                  </div>
                </div>

                <div class="col-lg-12 mb-5">
                  <div class="custom-file">
                    <label class="form-control-label">Fotos</label>
                    <input type="file" class="form-control" multiple accept="image/x-png,image/jpg,image/jpeg" name="fotos[]">
                  </div>
                </div>
              </div>

              <button class="btn btn-icon btn-primary" type="submit" name="save">
                <span class="btn-inner--icon"><i class="fas fa-save"></i></span>
                <span class="btn-inner--text">Salvar</span>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>