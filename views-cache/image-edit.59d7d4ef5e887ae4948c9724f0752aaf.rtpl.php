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
              <h3 class="mb-0"><?php echo htmlspecialchars( $text, ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form method="POST" action="/admin/<?php echo htmlspecialchars( $action, ENT_COMPAT, 'UTF-8', FALSE ); ?>" enctype="multipart/form-data">
            <div class="pl-lg-4">

              <div class="row mb-4">
                <div class="col-lg-12">
                  <div class="custom-file">
                    <input type="file" accept="image/x-png,image/jpg,image/jpeg" name="foto" required>
                  </div>
                </div>
              </div>

              <button class="btn btn-icon btn-primary" type="submit" name="update">
                <span class="btn-inner--icon"><i class="fas fa-save"></i></span>
                <span class="btn-inner--text">Atualizar</span>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>