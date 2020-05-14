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
              <h3 class="mb-0">Cadastrando banner</h3>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form method="POST" action="/admin/banner/novo" enctype="multipart/form-data">
            <div class="pl-lg-4">

              <div class="row">
                <div class="col-lg-5">
                  <div class="form-group">
                    <label class="form-control-label">Descrição</label>
                    <input type="text" class="form-control" name="descricao" required placeholder="Descrição">
                  </div>
                </div>

                <div class="col-lg-5">
                  <div class="form-group">
                    <label class="form-control-label">Url de redirecionamento</label>
                    <input type="text" class="form-control" name="href" placeholder="Url">
                  </div>
                </div>

                <div class="col-lg-2">
                  <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status">
                      <option value="1" selected>Ativado</option>
                      <option value="0">Desativado</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row mb-4">
                <div class="col-lg-12">
                  <div class="custom-file">
                    <input type="file" accept="image/x-png,image/jpg,image/jpeg" name="banner" required>
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