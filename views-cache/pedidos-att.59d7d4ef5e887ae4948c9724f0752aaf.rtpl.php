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
              <h3 class="mb-0">Atualizando pedido</h3>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form method="POST" action="/admin/produto/editar" enctype="multipart/form-data">
            <div class="pl-lg-4">

              <input type="hidden" name="id" value="<?php echo htmlspecialchars( $produto["product_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">

                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label">Distribuidor</label>
                    <select class="form-control" name="dist">
                      <option value="" disabled>Selecione um distribuidor</option>
                      <?php $counter1=-1;  if( isset($dist) && ( is_array($dist) || $dist instanceof Traversable ) && sizeof($dist) ) foreach( $dist as $key1 => $value1 ){ $counter1++; ?>
                      <option value="<?php echo htmlspecialchars( $value1["distributor_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" <?php if( $produto["brand_id"] == $value1["distributor_id"] ){ ?>selected<?php } ?>><?php echo htmlspecialchars( $value1["distributor_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                      <?php } ?>
                    </select>
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

  <br><br>