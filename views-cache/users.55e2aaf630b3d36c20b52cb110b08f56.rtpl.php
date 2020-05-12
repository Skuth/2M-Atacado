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

                <?php $userOn = $_SESSION["user"]; ?>
                <?php if( $userOn['type'] >= 2 ){ ?>
                <th scope="col">Última conexão</th>
                <th scope="col">Último IP conectado</th>
                <?php } ?>

                <th scope="col">Ação</th>
              </tr>
            </thead>
            <tbody class="text-center">
              <?php $counter1=-1;  if( isset($users) && ( is_array($users) || $users instanceof Traversable ) && sizeof($users) ) foreach( $users as $key1 => $value1 ){ $counter1++; ?>
              <?php if( $value1["type"] != 3 ){ ?>
              <tr>
                <td><?php echo htmlspecialchars( $value1["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                <td><?php echo htmlspecialchars( $value1["fname"], ENT_COMPAT, 'UTF-8', FALSE ); ?> <?php echo htmlspecialchars( $value1["lname"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                <td><?php echo htmlspecialchars( $value1["user"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                <td>
                  <?php if( $value1["type"] == 1 ){ ?>
                    Funcionário 
                  <?php }else{ ?>
                    Administrador
                  <?php } ?>
                </td>
                <?php if( $userOn['type'] >= 2 ){ ?>
                <td><?php echo date('d/m/Y H:i:s', strtotime($value1["last_connect"])); ?></td>
                <td><?php echo htmlspecialchars( $value1["last_ip_connect"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                <?php } ?>
                <td>
                  <a class="btn btn-icon btn-primary btn-sm" href="/admin/usuarios/editar/<?php echo htmlspecialchars( $value1["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><i class="fas fa-edit"></i></a>
                  <a class="btn btn-icon btn-danger btn-sm" href="/admin/usuarios/remover/<?php echo htmlspecialchars( $value1["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><i class="fas fa-trash"></i></a>
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