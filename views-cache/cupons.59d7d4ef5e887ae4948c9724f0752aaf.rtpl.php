<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="header bg-gradient-primary pb-8 pt-5 pt-md-8"></div>

<div class="container-fluid mt--7">
  <div class="row">
    <div class="col-xl-12 mb-5 mb-xl-0">
      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Cupons</h3>
            </div>
            <div class="col text-right">
              <a href="/admin/cupom/novo" class="btn btn-sm btn-primary">Cadastrar</a>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush">
            <thead class="thead-light text-center">
              <tr>
                <th scope="col">Cupom</th>
                <th scope="col">Desconto</th>
                <th scope="col">Categoria</th>
                <th scope="col">Uso</th>
                <th scope="col">Ação</th>
              </tr>
            </thead>
            <tbody class="text-center">
              <?php $counter1=-1;  if( isset($cupons) && ( is_array($cupons) || $cupons instanceof Traversable ) && sizeof($cupons) ) foreach( $cupons as $key1 => $value1 ){ $counter1++; ?>
              <tr>
                <td><b>CASA30</b></td>
                <td><b>30%</b></td>
                <td><b>Casa</b></td>
                <td><b>5 de 300</b></td>
                <td>
                  <a class="btn btn-icon btn-primary btn-sm" href="/admin/cupom/editar/<?php echo htmlspecialchars( $value1["category_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><i class="fas fa-edit"></i></a>
                  <a class="btn btn-icon btn-danger btn-sm" onclick="return confirm('Deseja mesmo remover essa cupom?')" href="/admin/cupom/remover/<?php echo htmlspecialchars( $value1["category_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><i class="fas fa-trash"></i></a>
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