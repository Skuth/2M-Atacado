<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="header bg-gradient-primary pb-8 pt-5 pt-md-8"></div>

<div class="container-fluid mt--7">
  <div class="row">
    <div class="col-xl-12 mb-5 mb-xl-0">
      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <?php $nUrl = explode("/", $url); ?>
            <div class="col">
              <?php if( count($nUrl) == 1 ){ ?>
              <h3 class="mb-0">Pedidos</h3>
              <?php }else{ ?>
              <h3 class="mb-0">Pedidos em aberto</h3>
              <?php } ?>
            </div>
            <?php $userOn=$_SESSION["user"]; ?>
            <?php if( count($nUrl) == 1 ){ ?>
            <div class="col text-right">
              <a href="/admin/pedidos/aberto" class="btn btn-sm btn-primary">Em aberto</a>
            </div>
            <?php }else{ ?>
            <div class="col text-right">
              <a href="/admin/pedidos" class="btn btn-sm btn-primary">Todos</a>
            </div>
            <?php } ?>
          </div>
        </div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush">
            <thead class="thead-light text-center">
              <tr>
                <th scope="col">Código</th>
                <th scope="col">CLiente</th>
                <th scope="col">Produtos</th>
                <th scope="col">Entrega</th>
                <th scope="col">Total</th>
                <th scope="col">Status</th>
                <th scope="col">Status de pagamento</th>
                <th scope="col">Ação</th>
              </tr>
            </thead>
            <tbody class="text-center">
              <?php $counter1=-1;  if( isset($pedidos) && ( is_array($pedidos) || $pedidos instanceof Traversable ) && sizeof($pedidos) ) foreach( $pedidos as $key1 => $value1 ){ $counter1++; ?>
              <tr>
                <td><b><?php echo htmlspecialchars( $value1["order_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b></td>
                <td><b><?php echo htmlspecialchars( $value1["client_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b></td>
                <?php $max = 20; ?>
                <?php $c = $value1["products_name"]; ?>
                <td><b><?php if( strlen($c) >= $max ){ ?> <?php echo substr($c, 0, $max); ?>... <?php }else{ ?> <?php echo htmlspecialchars( $c, ENT_COMPAT, 'UTF-8', FALSE ); ?> <?php } ?></b></td>
                <td>
                  <?php $x = $value1["order_address_id"]; ?>
                  <?php if( $x == 0 ){ ?>
                  <span class="badge badge-pill badge-default text-white">Retirar</span>
                  <?php }else{ ?>
                  <span class="badge badge-pill badge-primary">Entregar</span>
                  <?php } ?>
                </td>
                <td><b>R$ <?php echo formatMoney($value1["order_subtotal"]); ?></b></td>
                <td>
                  <?php $i = $value1["order_status"]; ?>
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
                  <?php } ?>
                </td>
                <td>
                  <?php $z = $value1["order_payment_status"]; ?>
                  <?php if( $z == 1 ){ ?>
                  <span class="badge badge-pill badge-warning">Pagamento na retirada</span>
                  <?php }elseif( $z == 2 ){ ?>
                  <span class="badge badge-pill badge-primary">Em análise</span>
                  <?php }elseif( $z == 3 ){ ?>
                  <span class="badge badge-pill badge-success">Aprovado</span>
                  <?php }elseif( $z == 4 ){ ?>
                  <span class="badge badge-pill badge-danger">Recusado</span>
                  <?php } ?>
                </td>
                <td>
                  <a class="btn btn-icon btn-default btn-sm" href="/admin/pedido/visualizar/<?php echo htmlspecialchars( $value1["order_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><i class="fas fa-eye"></i></a>
                  <a class="btn btn-icon btn-primary btn-sm" href="/admin/pedido/atualizar/<?php echo htmlspecialchars( $value1["order_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><i class="fas fa-edit"></i></a>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>

          <nav class="p-3">
            <ul class="pagination justify-content-center">
              <li class="page-item <?php if( $pagina == 1 ){ ?>disabled<?php } ?>">
                <a class="page-link" href="/admin/<?php echo htmlspecialchars( $url, ENT_COMPAT, 'UTF-8', FALSE ); ?>?pagina=<?php echo htmlspecialchars( $pagina - 1, ENT_COMPAT, 'UTF-8', FALSE ); ?>" tabindex="-1">
                  <i class="fa fa-angle-left"></i>
                </a>
              </li>
              <?php $c = ceil($count/$limit); ?>
              <?php if( $c > 0 ){ ?>
                <?php $counter1=-1; $newvar1=range(1, $c); if( isset($newvar1) && ( is_array($newvar1) || $newvar1 instanceof Traversable ) && sizeof($newvar1) ) foreach( $newvar1 as $key1 => $value1 ){ $counter1++; ?>
                <?php $key1 = $key1 + 1; ?>
                <li class="page-item <?php if( $key1 == $pagina ){ ?>active<?php } ?>"><a class="page-link" href="/admin/<?php echo htmlspecialchars( $url, ENT_COMPAT, 'UTF-8', FALSE ); ?>?pagina=<?php echo htmlspecialchars( $key1, ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $key1, ENT_COMPAT, 'UTF-8', FALSE ); ?></a></li>
                <?php } ?>
              <?php }else{ ?>
              <li class="page-item <?php if( 1 == $pagina ){ ?>active<?php } ?>"><a class="page-link" href="/admin/<?php echo htmlspecialchars( $url, ENT_COMPAT, 'UTF-8', FALSE ); ?>?pagina=1">1</a></li>
              <?php } ?>
              <li class="page-item <?php if( $c == $pagina ){ ?>disabled<?php } ?>">
                <a class="page-link" href="/admin/<?php echo htmlspecialchars( $url, ENT_COMPAT, 'UTF-8', FALSE ); ?>?pagina=<?php echo htmlspecialchars( $pagina + 1, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                  <i class="fa fa-angle-right"></i>
                </a>
              </li>
            </ul>
          </nav>

        </div>
      </div>
    </div>
  </div>
</div>

<br><br>