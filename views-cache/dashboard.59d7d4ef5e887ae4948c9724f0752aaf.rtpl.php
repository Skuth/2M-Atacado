<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
  <div class="container-fluid">
    <div class="header-body">
      <!-- Card stats -->
      <div class="row">

        <div class="col-xl-4 col-lg-6">
          <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0">Pedidos em aberto</h5>
                  <span class="h2 font-weight-bold mb-0">325</span>
                </div>
                <div class="col-auto">
                  <div class="icon icon-shape bg-red text-white rounded-circle shadow">
                    <i class="ni ni-archive-2"></i>
                  </div>
                </div>
              </div>
              <p class="mt-3 mb-0 text-muted text-sm">
                <span class="text-success mr-2"><i class="fas fa-arrow-down"></i> 7.58%</span>
                <span class="text-nowrap">Des da última semana</span>
              </p>
            </div>
          </div>
        </div>

        <div class="col-xl-4 col-lg-6">
          <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0">Pedidos hoje</h5>
                  <span class="h2 font-weight-bold mb-0">30</span>
                </div>
                <div class="col-auto">
                  <div class="icon icon-shape bg-green text-white rounded-circle shadow">
                    <i class="ni ni-bag-17"></i>
                  </div>
                </div>
              </div>
              <p class="mt-3 mb-0 text-muted text-sm">
                <span class="text-warning mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                <span class="text-nowrap">Des de ontem</span>
              </p>
            </div>
          </div>
        </div>

        <div class="col-xl-4 col-lg-6">
          <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0">Visitas mensais</h5>
                  <span class="h2 font-weight-bold mb-0"><?php echo htmlspecialchars( $sum["SUM(product_views)"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                </div>
                <div class="col-auto">
                  <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                    <i class="fas fa-eye"></i>
                  </div>
                </div>
              </div>
              <p class="mt-3 mb-0 text-muted text-sm">
                <?php $percentage = getPercentage($sum["SUM(product_views_old)"], $sum["SUM(product_views)"]); ?>
                <?php if( substr($percentage, 0, 1) == '-' ){ ?>
                <?php $percentage = str_replace("-", "", $percentage); ?>
                <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> <?php echo htmlspecialchars( $percentage, ENT_COMPAT, 'UTF-8', FALSE ); ?>%</span>
                <?php }elseif( $percentage == 0 ){ ?>
                <span class="text-primary mr-2"><i class="fas fa-minus"></i> <?php echo htmlspecialchars( $percentage, ENT_COMPAT, 'UTF-8', FALSE ); ?>%</span>
                <?php }else{ ?>
                <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> <?php echo htmlspecialchars( $percentage, ENT_COMPAT, 'UTF-8', FALSE ); ?>%</span>
                <?php } ?>
                <span class="text-nowrap">Desde o último mês</span>
              </p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<div class="container-fluid mt--7">
  <div class="row">
    <div class="col-xl-12 mb-5 mb-xl-0">
      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Produtos mais acessados</h3>
            </div>
            <div class="col text-right">
              <a href="/admin/produtos" class="btn btn-sm btn-primary">Ver todos</a>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush">
            <thead class="thead-light text-center">
              <tr>
                <th scope="col">Produto</th>
                <th scope="col">Ref</th>
                <th scope="col">Nome</th>
                <th scope="col">Visitas</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody class="text-center">
              <?php $counter1=-1;  if( isset($produtos) && ( is_array($produtos) || $produtos instanceof Traversable ) && sizeof($produtos) ) foreach( $produtos as $key1 => $value1 ){ $counter1++; ?>
              <tr>
                <th scope="row">
                  <img src="./assets/produtos/<?php echo htmlspecialchars( $value1["product_pictures"]["0"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" width="50">
                </th>
                <td><b><?php echo htmlspecialchars( $value1["product_ref"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b></td>
                <td><b><?php echo htmlspecialchars( $value1["product_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b></td>
                <td><b><?php echo htmlspecialchars( $value1["product_views"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b></td>
                <td>
                  <?php $prodPer = getPercentage($value1["product_views_old"], $value1["product_views"]); ?>
                  <?php if( substr($prodPer, 0, 1) == '-' ){ ?>
                  <?php $prodPer = str_replace("-", "", $prodPer); ?>
                  <i class="fas fa-arrow-down text-danger mr-3"></i> <span class="text-danger"><?php echo htmlspecialchars( $prodPer, ENT_COMPAT, 'UTF-8', FALSE ); ?>%</span> <span class="text-muted">Desde o último mês</span>
                  <?php }elseif( $prodPer == 0 ){ ?>
                  <i class="fas fa-minus text-primary mr-3"></i> <span class="text-primary"><?php echo htmlspecialchars( $prodPer, ENT_COMPAT, 'UTF-8', FALSE ); ?>%</span> <span class="text-muted">Desde o último mês</span>
                  <?php }else{ ?>
                  <i class="fas fa-arrow-up text-success mr-3"></i> <span class="text-success"><?php echo htmlspecialchars( $prodPer, ENT_COMPAT, 'UTF-8', FALSE ); ?>%</span> <span class="text-muted">Desde o último mês</span>
                  <?php } ?>
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