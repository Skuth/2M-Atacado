<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="header bg-gradient-primary pb-8 pt-5 pt-md-8"></div>

<div class="container-fluid mt--7">
  <div class="row">
    <div class="col-xl-12 mb-5 mb-xl-0">
      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Promoções</h3>
            </div>
            <?php $userOn=$_SESSION["user"]; ?>
          </div>
        </div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush">
            <thead class="thead-light text-center">
              <tr>
                <th scope="col">Foto</th>
                <th scope="col">Ref</th>
                <th scope="col">Nome</th>
                <th scope="col">Preço</th>
                <th scope="col">Preço com desconto</th>
                <th scope="col">Ação</th>
              </tr>
            </thead>
            <tbody class="text-center">
              <?php $counter1=-1;  if( isset($produtos) && ( is_array($produtos) || $produtos instanceof Traversable ) && sizeof($produtos) ) foreach( $produtos as $key1 => $value1 ){ $counter1++; ?>
              <tr>
                <td><img src="./assets/produtos/<?php echo htmlspecialchars( $value1["product_pictures"]["0"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" width="50"></td>
                <td><b><?php echo htmlspecialchars( $value1["product_ref"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b></td>
                <td><b><?php echo htmlspecialchars( $value1["product_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b></td>
                <td><b>R$ <?php echo formatMoney($value1["product_price"]); ?></b></td>
                <td><b>R$ <?php echo formatMoney($value1["product_price_off"]); ?></b></td>
                <td>
                  <?php if( $userOn['type'] > 1 ){ ?>
                  <a class="btn btn-icon btn-success btn-sm" href="/admin/produto/promocao/<?php echo htmlspecialchars( $value1["product_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><i class="fas fa-percentage"></i></a>
                  <a class="btn btn-icon btn-danger btn-sm" onclick="return confirm('Deseja mesmo remover essa promoção?')" href="/admin/promocao/remover/<?php echo htmlspecialchars( $value1["product_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><i class="fas fa-trash"></i></a>
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

<br><br>