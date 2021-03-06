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
          <form method="POST" action="/admin/pedido/atualizar" enctype="multipart/form-data">
            <div class="pl-lg-4">

              <input type="hidden" name="id" value="<?php echo htmlspecialchars( $order["order_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">

                <div class="row">

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label">Status de pagamento</label>
                      <select class="form-control" name="payment-status">
                        <option value="" disabled>Selecione um status</option>
                        <option value="1" <?php if( $order["order_payment_status"] == 1 ){ ?>selected<?php } ?>>Pagamento na retirada</option>
                        <option value="2" <?php if( $order["order_payment_status"] == 2 ){ ?>selected<?php } ?>>Em análise</option>
                        <option value="3" <?php if( $order["order_payment_status"] == 3 ){ ?>selected<?php } ?>>Aprovado</option>
                        <option value="4" <?php if( $order["order_payment_status"] == 4 ){ ?>selected<?php } ?>>Recusado</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label">Status</label>
                      <select class="form-control" name="status">
                        <option value="" disabled>Selecione um status</option>
                        <option value="1" <?php if( $order["order_status"] == 1 ){ ?>selected<?php } ?>>Aguardando atualização</option>
                        <option value="2" <?php if( $order["order_status"] == 2 ){ ?>selected<?php } ?>>Em separação</option>
                        <option value="3" <?php if( $order["order_status"] == 3 ){ ?>selected<?php } ?>>Pronto para retirada</option>
                        <option value="4" <?php if( $order["order_status"] == 4 ){ ?>selected<?php } ?>>Saiu para entregar</option>
                        <option value="5" <?php if( $order["order_status"] == 5 ){ ?>selected<?php } ?>>Entregue</option>
                        <option value="6" <?php if( $order["order_status"] == 6 ){ ?>selected<?php } ?>>Cancelada</option>
                      </select>
                    </div>
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