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
              <h3 class="mb-0">Editando departamentos</h3>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form method="POST" action="/admin/departamento/editar">
            <div class="pl-lg-4">

              <input type="hidden" name="id" value="<?php echo htmlspecialchars( $department["department_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">

              <div class="row">
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Icone</label>
                    <input type="text" class="form-control" name="icone" required value="<?php echo htmlspecialchars( $department["department_icon"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                    <br>
                    <span class="text-muted">Escolha um icone : <a href="https://icofont.com/icons" target="_blank"> icones</a></span>
                  </div>
                </div>

                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Departamento</label>
                    <input type="text" class="form-control" name="departamento" required value="<?php echo htmlspecialchars( $department["department_text"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                  </div>
                </div>

                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Link</label>
                    <input type="text" class="form-control" name="href" required value="<?php echo htmlspecialchars( $department["department_href"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
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