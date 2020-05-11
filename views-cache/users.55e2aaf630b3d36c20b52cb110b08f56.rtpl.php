<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="header bg-gradient-primary pb-8 pt-5 pt-md-8"></div>

<div class="container-fluid mt--7">
  <div class="row">
    <div class="col-xl-12 mb-5 mb-xl-0">
      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Usuarios</h3>
            </div>
            <div class="col text-right">
              <a href="/admin/usuarios/novo" class="btn btn-sm btn-primary">Cadastrar</a>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush">
            <thead class="thead-light text-center">
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Nome</th>
                <th scope="col">User</th>
                <th scope="col">Tipo</th>
                <th scope="col">Ação</th>
              </tr>
            </thead>
            <tbody class="text-center">
              <?php $counter1=-1; $newvar1=array(1,1,1,1,1); if( isset($newvar1) && ( is_array($newvar1) || $newvar1 instanceof Traversable ) && sizeof($newvar1) ) foreach( $newvar1 as $key1 => $value1 ){ $counter1++; ?>
              <tr>
                <td><?php echo rand(1,100); ?></td>
                <td>Flavio Gomes</td>
                <td>theskuth</td>
                <td><?php echo rand(0, 1); ?></td>
                <td>
                  <a class="btn btn-icon btn-primary btn-sm" href="/admin/usuarios/editar/<?php echo rand(1,100); ?>"><i class="fas fa-edit"></i></a>
                  <a class="btn btn-icon btn-danger btn-sm" href="/admin/usuarios/remover/<?php echo rand(1,100); ?>"><i class="fas fa-trash"></i></a>
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