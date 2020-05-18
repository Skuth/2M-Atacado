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
              <h3 class="mb-0">Cadastrando distribuidor</h3>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form method="POST" action="/admin/distribuidor/novo" enctype="multipart/form-data">
            <div class="pl-lg-4">

              <div class="row">
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Distribuidor</label>
                    <input type="text" class="form-control" name="distribuidor" required placeholder="Distribuidor">
                  </div>
                </div>

                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Endereço</label>
                    <input type="text" class="form-control" name="endereco" required placeholder="Endereço">
                  </div>
                </div>

                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Link</label>
                    <input type="text" class="form-control" name="href" required placeholder="Link">
                  </div>
                </div>

                <div class="col-lg-12">
                  <div class="form-group">
                    <label>Descrição</label>
                    <textarea class="form-control" name="descricao" rows="6" required placeholder="Descrição"></textarea>
                  </div>
                </div>

                <div class="col-lg-6 mb-4">
                  <div class="custom-file">
                    <label class="form-control-label">Logo</label>
                    <input type="file" class="form-control" accept="image/x-png,image/jpg,image/jpeg" name="logo" required>
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
                <span class="btn-inner--text">Cadastrar</span>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>