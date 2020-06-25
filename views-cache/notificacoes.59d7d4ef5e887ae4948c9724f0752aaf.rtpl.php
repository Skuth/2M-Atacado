<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="header bg-gradient-primary pb-8 pt-5 pt-md-8"></div>

<div class="container-fluid mt--7">
  <div class="row">
    <div class="col-xl-12 mb-5 mb-xl-0">
      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Notificações</h3>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush">
            <thead class="thead-light text-center">
              <tr>
                <th scope="col">Foto</th>
                <th scope="col">Nome</th>
                <th scope="col">Estoque</th>
                <th scope="col">Ação</th>
              </tr>
            </thead>
            <tbody class="text-center">
              <?php $counter1=-1;  if( isset($lowStock) && ( is_array($lowStock) || $lowStock instanceof Traversable ) && sizeof($lowStock) ) foreach( $lowStock as $key1 => $value1 ){ $counter1++; ?>
              <tr>
                <td><img src="./assets/produtos/<?php echo htmlspecialchars( $value1["product_pictures"]["0"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" width="60"></td>
                <td><b><?php echo htmlspecialchars( $value1["product_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b></td>
                <?php if( $value1["product_stock"] >= 3 ){ ?>
                <?php $class = "badge-info"; ?>
                <?php }elseif( $value1["product_stock"] >= 2 ){ ?>
                <?php $class = "badge-warning"; ?>
                <?php }elseif( $value1["product_stock"] <= 0 ){ ?>
                <?php $class = "badge-danger"; ?>
                <?php }else{ ?>
                <?php $class = "badge-danger"; ?>
                <?php } ?>
                <td><span class="badge badge-pill <?php echo htmlspecialchars( $class, ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["product_stock"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span></td>
                <td>
                  <a class="btn btn-icon btn-primary btn-sm" href="/admin/produto/editar/<?php echo htmlspecialchars( $value1["product_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><i class="fas fa-edit"></i></a>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>