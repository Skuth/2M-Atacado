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
              <h3 class="mb-0">Cadastrando usuário</h3>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form method="POST" action="/admin/usuarios/novo">
            <div class="pl-lg-4">

              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <label class="form-control-label">Usuário</label>
                    <input type="text" id="input-username" class="form-control" required name="usuario" placeholder="Nome de usuário">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <label class="form-control-label">Cargo</label>
                    <select class="form-control" name="cargo">
                      <option value="1">Funcionário</option>
                      <option value="2">Administrador</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label">Nome</label>
                    <input type="text" class="form-control" name="nome" required placeholder="Nome">
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label">Sobrenome</label>
                    <input type="text" class="form-control" name="sobrenome" required placeholder="Sobrenome">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-12">
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