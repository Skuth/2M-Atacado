<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="header bg-gradient-primary pb-8 pt-5 pt-md-8"></div>

<?php $card = 4; ?>

<div class="container-fluid mt--6">
  <div class="row card-wrapper">

    <div class="col-xl-<?php echo htmlspecialchars( $card, ENT_COMPAT, 'UTF-8', FALSE ); ?> mt-4">
      <div class="card">
        <div class="card-header">
          
          <h5 class="h3 mb-0">Compra #<?php echo htmlspecialchars( $order["order_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?> | Dia <?php echo date('d/m/Y', strtotime($order["order_date"])); ?> | Total <span class="badge badge-pill badge-info">R$ <?php echo formatMoney($order["order_subtotal"]); ?></span></h5>
        </div>

        <br>
        <?php $counter1=-1;  if( isset($order["produtos"]) && ( is_array($order["produtos"]) || $order["produtos"] instanceof Traversable ) && sizeof($order["produtos"]) ) foreach( $order["produtos"] as $key1 => $value1 ){ $counter1++; ?>
        <div class="card-body">
          <img src="../assets/produtos/<?php echo htmlspecialchars( $value1["product_pictures"]["0"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" width="80" class="mb-4">
          <p class="card-text mb-4"><strong><?php echo htmlspecialchars( $value1["product_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?> | Ref: <span class="badge badge-pill badge-info"><?php echo htmlspecialchars( $value1["product_ref"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span> | Quantidade: <span class="badge badge-pill badge-info"><?php echo htmlspecialchars( $value1["quantity"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span></strong></p>
          <p class="badge badge-pill badge-info badge-lg">R$ <?php echo formatMoney($value1["payed_price"]); ?></p>
        </div>
        <?php if( $key1 < (count($order["produtos"]) - 1) ){ ?>
        <hr>
        <?php } ?>
        <?php } ?>
      </div>
    </div>

    <div class="col-xl-<?php echo htmlspecialchars( $card, ENT_COMPAT, 'UTF-8', FALSE ); ?> mt-4">
      <div class="card">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col">
              <h5 class="h3 mb-0">Informações</h5>
            </div>
            <div class="col text-right">
              <a href="/admin/pedido/atualizar/<?php echo htmlspecialchars( $order["order_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-sm btn-primary">Atualizar</a>
            </div>
          </div>
        </div>

        <div class="card-body">
          <p class="card-text mb-4"><strong class="mr-2">Cliente</strong> <span class="badge badge-pill badge-info"><?php echo htmlspecialchars( $order["client_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?>#<?php echo htmlspecialchars( $order["client_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span></p>
          <?php if( isset($order["client_phone"]) && $order["client_phone"] != NULL ){ ?>
          <p class="card-text mb-4"><strong class="mr-2">Telefone</strong> <span class="badge badge-pill badge-info"><?php echo formatPhone($order["client_phone"]); ?></span></p>
          <?php } ?>
          <span class="card-text mr-2">Tipe de entrega</span>
          <?php $x = $order["order_address_id"]; ?>
          <?php if( $x == 0 ){ ?>
          <span class="badge badge-pill badge-default text-white">Retirar</span>
          <?php }else{ ?>
          <span class="badge badge-pill badge-primary">Entregar</span>
          <?php } ?>
          <br><br>
          <span class="card-text mr-2">Status do pagamento</span>
          <?php $z = $order["order_payment_status"]; ?>
          <?php if( $z == 1 ){ ?>
          <span class="badge badge-pill badge-warning">Pagamento na retirada</span>
          <?php }elseif( $z == 2 ){ ?>
          <span class="badge badge-pill badge-primary">Em análise</span>
          <?php }elseif( $z == 3 ){ ?>
          <span class="badge badge-pill badge-success">Aprovado</span>
          <?php }elseif( $z == 4 ){ ?>
          <span class="badge badge-pill badge-danger">Recusado</span>
          <?php } ?>
          <br><br>
          <span class="card-text mr-2">Status da compra</span>
          <?php $i = $order["order_status"]; ?>
          <?php if( $i == 1 ){ ?>
          <span class="badge badge-pill badge-warning">Aguardando atualização</span>
          <?php }elseif( $i == 2 ){ ?>
          <span class="badge badge-pill badge-primary">Em separação</span>
          <?php }elseif( $i == 3 ){ ?>
          <span class="badge badge-pill badge-info">Pronto para retirada</span>
          <?php }elseif( $i == 4 ){ ?>
          <span class="badge badge-pill badge-info">Saiu para entregar</span>
          <?php }elseif( $i == 5 ){ ?>
          <span class="badge badge-pill badge-success">Entregue</span>
          <?php }elseif( $i == 6 ){ ?>
          <span class="badge badge-pill badge-danger">Cancelada</span>
          <?php } ?>
        </div>
      </div>
    </div>

    <div class="col-xl-<?php echo htmlspecialchars( $card, ENT_COMPAT, 'UTF-8', FALSE ); ?> mt-4">
      <div class="card">
        <div class="card-header">
          
          <h5 class="h3 mb-0">Entrega</h5>
        </div>

        <div class="card-body">
          <p class="card-text mb-4"><strong>Local de entrega</strong></p>
          <?php if( isset($order["client_address"]) ){ ?>
          <span><?php echo htmlspecialchars( $order["client_address"], ENT_COMPAT, 'UTF-8', FALSE ); ?> | <?php echo htmlspecialchars( $order["client_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
          <?php }else{ ?>
          <span><strong>Retirar na loja</strong></span>
          <?php } ?>
        </div>
      </div>
    </div>

  </div>
</div>

<br><br>