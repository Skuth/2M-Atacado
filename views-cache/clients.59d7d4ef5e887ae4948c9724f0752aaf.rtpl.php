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
              <h3 class="mb-0">Clientes</h3>
              <?php }else{ ?>
              <h3 class="mb-0">Clientes desativados</h3>
              <?php } ?>
            </div>
            <?php $userOn=$_SESSION["user"]; ?>
            <div class="col text-right">
              <span onclick="generateKey()" class="btn btn-sm btn-primary">Criar chave</span>
            <?php if( count($nUrl) == 1 ){ ?>
              <a href="/admin/clientes/desativados" class="btn btn-sm btn-primary">Desativados</a>
            <?php }else{ ?>
              <a href="/admin/clientes" class="btn btn-sm btn-primary">Todos</a>
            <?php } ?>
          </div>
          </div>
        </div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush">
            <thead class="thead-light text-center">
              <tr>
                <th scope="col">Nome</th>
                <th scope="col">Cpf / Cnpj</th>
                <th scope="col">Inscrição Estadual</th>
                <th scope="col">Tipo de conta</th>
                <th scope="col">Status da conta</th>
                <th scope="col">ÚLTIMA CONEXÃO</th>
                <th scope="col">ÚLTIMO IP CONECTADO</th>
                <th scope="col">Ação</th>
              </tr>
            </thead>
            <tbody class="text-center">
              <?php $counter1=-1;  if( isset($clients) && ( is_array($clients) || $clients instanceof Traversable ) && sizeof($clients) ) foreach( $clients as $key1 => $value1 ){ $counter1++; ?>
              <tr>
                <td><b><?php echo htmlspecialchars( $value1["client_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b></td>
                <td><b>
                  <?php if( $value1["client_cnpj"] != '' ){ ?>
                    <?php $doc = $value1["client_cnpj"]; ?>
                  <?php }else{ ?>
                    <?php $doc = $value1["client_cpf"]; ?>
                  <?php } ?>

                  <?php $doc = formatCnpjCpf($doc); ?>
                  <?php echo htmlspecialchars( $doc, ENT_COMPAT, 'UTF-8', FALSE ); ?>
                </b></td>
                <?php $ie = formatCnpjCpf($value1["client_ie"]); ?>
                <td><b><?php if( $ie != '' ){ ?> <?php echo htmlspecialchars( $ie, ENT_COMPAT, 'UTF-8', FALSE ); ?> <?php }else{ ?> -------- <?php } ?></b></td>
                <td><b>
                  <?php if( $value1["client_type"] == 1 ){ ?>
                    Empresa
                  <?php }else{ ?>
                    Pessoal
                  <?php } ?>
                </b></td>
                <td><b>
                  <?php if( $value1["client_status"] == 1 ){ ?>
                    <span class="badge badge-pill badge-success">Ativada</span>
                    <?php }else{ ?>
                    <span class="badge badge-pill badge-danger">Desativada</span>
                  <?php } ?>
                </b></td>
                <td><b><?php echo date('d/m/Y H:i:s', strtotime($value1["client_last_connect"])); ?></b></td>
                <td><b><?php echo htmlspecialchars( $value1["client_last_ip_connect"], ENT_COMPAT, 'UTF-8', FALSE ); ?></b></td>
                <td>
                  <a class="btn btn-icon btn-default btn-sm" href="/admin/cliente/visualizar/<?php echo htmlspecialchars( $value1["client_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><i class="fas fa-eye"></i></a>
                  <a class="btn btn-icon btn-primary btn-sm" href="/admin/cliente/editar/<?php echo htmlspecialchars( $value1["client_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><i class="fas fa-edit"></i></a>
                  <?php if( $userOn["type"] >= 2 ){ ?>
                  <?php if( $value1["client_status"] == 0 ){ ?>
                  <a class="btn btn-icon btn-info btn-sm" onclick="return confirm('Deseja mesmo ativar esse cliente?')" href="/admin/cliente/ativar/<?php echo htmlspecialchars( $value1["client_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><i class="far fa-check-circle"></i></a>
                  <?php }else{ ?>
                  <a class="btn btn-icon btn-info btn-sm" onclick="return confirm('Deseja mesmo desativar esse cliente?')" href="/admin/cliente/desativar/<?php echo htmlspecialchars( $value1["client_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><i class="far fa-times-circle"></i></a>
                  <?php } ?>
                  <a class="btn btn-icon btn-danger btn-sm" onclick="return confirm('Deseja mesmo remover esse cliente?')" href="/admin/cliente/remover/<?php echo htmlspecialchars( $value1["client_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><i class="fas fa-trash"></i></a>
                  <?php } ?>
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