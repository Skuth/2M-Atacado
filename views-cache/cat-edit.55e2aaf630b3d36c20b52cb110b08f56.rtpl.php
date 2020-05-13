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
              <h3 class="mb-0">Cadastrando categoria</h3>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form method="POST" action="/admin/categoria/editar">
            <div class="pl-lg-4">

              <div class="row">

                <input type="hidden" name="id" value="<?php echo htmlspecialchars( $cat["category_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">

                <div class="col-lg-12">
                  <div class="form-group">
                    <label class="form-control-label">Categoria</label>
                    <input type="text" class="form-control" name="categoria" required value="<?php echo htmlspecialchars( $cat["category_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
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