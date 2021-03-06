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
                  <span class="h2 font-weight-bold mb-0">34501</span>
                </div>
                <div class="col-auto">
                  <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                    <i class="fas fa-eye"></i>
                  </div>
                </div>
              </div>
              <p class="mt-3 mb-0 text-muted text-sm">
                <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
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
                  <i class="fas fa-arrow-up text-success mr-3"></i> <span class="text-success"><?php echo getPercentage($value1["product_views_old"], $value1["product_views"]); ?>%</span> <span class="text-muted">Desde o último mês</span>
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