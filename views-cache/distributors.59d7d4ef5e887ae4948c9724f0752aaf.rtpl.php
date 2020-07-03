<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="header bg-gradient-primary pb-8 pt-5 pt-md-8"></div>

<div class="container-fluid mt--7">
  <div class="row">
    <div class="col-xl-12 mb-5 mb-xl-0">
      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Distribuidores</h3>
            </div>
            <div class="col text-right">
              <a href="/admin/distribuidor/novo" class="btn btn-sm btn-primary">Cadastrar</a>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush">
            <thead class="thead-light text-center">
              <tr>
                <th scope="col">Logo</th>
                <th scope="col">Distribuidor</th>
                <th scope="col">Endereço</th>
                <th scope="col">Descrição</th>
                <th scope="col">Link</th>
                <th scope="col">Ação</th>
              </tr>
            </thead>
            <tbody class="text-center">
              <?php $counter1=-1;  if( isset($distribuidores) && ( is_array($distribuidores) || $distribuidores instanceof Traversable ) && sizeof($distribuidores) ) foreach( $distribuidores as $key1 => $value1 ){ $counter1++; ?>
              <?php if( $value1["distributor_id"] > 0 ){ ?>
              <tr>
                <td><img src="./assets/distribuidores/<?php echo htmlspecialchars( $value1["distributor_logo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" width="30"></td>
                <td><b><?php echo htmlspecialchars( $value1["distributor_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b></td>
                <td><?php echo htmlspecialchars( $value1["distributor_address"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                <td><?php echo substr($value1["distributor_description"], 0, 40); ?><?php if( strlen($value1["distributor_description"]) > 40 ){ ?>...<?php } ?></td>
                <td>/distribuidor/<?php echo htmlspecialchars( $value1["distributor_href"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                <td>
                  <a class="btn btn-icon btn-primary btn-sm" href="/admin/distribuidor/editar/<?php echo htmlspecialchars( $value1["distributor_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><i class="fas fa-edit"></i></a>
                  <a class="btn btn-icon btn-danger btn-sm" onclick="return confirm('Deseja mesmo remover esse distribuidor?')" href="/admin/distribuidor/remover/<?php echo htmlspecialchars( $value1["distributor_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><i class="fas fa-trash"></i></a>
                </td>
              </tr>
              <?php } ?>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>