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
              <h3 class="mb-0">Cadastrando departamentos</h3>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form method="POST" action="/admin/usuarios/novo">
            <div class="pl-lg-4">

              <div class="row">
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Icone</label>
                    <input type="text" class="form-control" name="icone" required placeholder="Icone">
                  </div>
                </div>

                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Departamento</label>
                    <input type="text" class="form-control" name="departamento" required placeholder="Departamento">
                  </div>
                </div>

                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Senha</label>
                    <input type="password" class="form-control" name="senha" required placeholder="Senha">
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