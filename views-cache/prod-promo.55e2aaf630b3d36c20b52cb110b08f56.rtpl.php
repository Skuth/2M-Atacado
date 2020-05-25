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
              <h3 class="mb-2"><span>Produto: <?php echo htmlspecialchars( $prod["product_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span> | <span>Ref: <?php echo htmlspecialchars( $prod["product_ref"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span> | <span>Preço atual: <?php echo formatMoney($prod["product_price"]); ?></span></h3>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form method="POST" action="/admin/produto/promocao" enctype="multipart/form-data">
            <div class="pl-lg-4">

              <input type="hidden" name="id" value="<?php echo htmlspecialchars( $prod["product_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">

              <div class="row">
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Novo preço</label>
                    <input type="number" max="<?php echo htmlspecialchars( $prod["product_price"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" step="0.01" class="form-control" required name="nPrice" value="<?php echo htmlspecialchars( $prod["product_price_off"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" placeholder="Novo valor">
                  </div>
                </div>

                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="date-input" class="form-control-label">Fim do desconto</label>
                    <input class="form-control" type="date" name="eDate" min="<?php echo date('Y-m-d'); ?>" <?php if( $prod["product_price_off_days"] != NULL ){ ?> value="<?php echo htmlspecialchars( $prod["product_price_off_days"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" <?php } ?> id="date-input">
                  </div>
                </div>

                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Estoque com desconto</label>
                    <input type="number" class="form-control" name="sDesc" value="<?php echo htmlspecialchars( $prod["product_stock_quantity_off"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" max="<?php echo htmlspecialchars( $prod["product_stock"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" min="0" placeholder="Estoque com desconto">
                  </div>
                  <span class="text-muted">Estoque atual: <?php echo htmlspecialchars( $prod["product_stock"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
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