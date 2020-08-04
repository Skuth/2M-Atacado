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
              <h3 class="mb-0">Enviar arquivo de atualização</h3>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form method="POST" action="/admin/produtos/atualizar" enctype="multipart/form-data">
            <div class="pl-lg-4">
              
              <div class="row mb-4">
                <div class="col-lg-12">

                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" checked name="stock" id="stock">
                    <label class="custom-control-label" for="stock">Atualizar estoque</label>
                  </div>

                  <div class="custom-control custom-checkbox mt-2">
                    <input type="checkbox" class="custom-control-input" name="price" id="price">
                    <label class="custom-control-label" for="price">Atualizar preço</label>
                  </div>

                </div>
              </div>

              <div class="row mb-4">
                <div class="col-lg-12">
                  <div class="custom-file">
                    <input type="file" accept="text/plain" name="data" required>
                  </div>
                </div>
              </div>

              <button class="btn btn-icon btn-primary" type="submit" name="update">
                <span class="btn-inner--icon"><i class="fas fa-save"></i></span>
                <span class="btn-inner--text">Atualizar</span>
              </button>
            </div>
          </form>

          <?php if( isset($_GET['update']) ){ ?>
            <?php $update = $_GET['update']; ?>
            <?php if( $update == 'true' ){ ?>
            <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
              <span class="alert-icon"><i class="ni ni-like-2"></i></span>
              <span class="alert-text"><strong>Sucesso!</strong> Banco de dados atualizado!</span>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?php }else{ ?>
            <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
              <span class="alert-icon"><i class="ni ni-like-2"></i></span>
              <span class="alert-text"><strong>Erro!</strong> Ouve uma falha ao atualizar o banco de dados!</span>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?php } ?>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>