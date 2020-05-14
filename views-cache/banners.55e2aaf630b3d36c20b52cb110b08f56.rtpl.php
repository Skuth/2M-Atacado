<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="header bg-gradient-primary pb-8 pt-5 pt-md-8"></div>

<div class="container-fluid mt--7">
  <div class="row">
    <div class="col-xl-12 mb-5 mb-xl-0">
      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Banners</h3>
            </div>
            <div class="col text-right">
              <a href="/admin/banner/novo" class="btn btn-sm btn-primary">Cadastrar</a>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush">
            <thead class="thead-light text-center">
              <tr>
                <th scope="col">Banner</th>
                <th scope="col">Descrição</th>
                <th scope="col">Link</th>
                <th scope="col">Status</th>
                <th scope="col">Ação</th>
              </tr>
            </thead>
            <tbody class="text-center">
              <?php $counter1=-1;  if( isset($sliders) && ( is_array($sliders) || $sliders instanceof Traversable ) && sizeof($sliders) ) foreach( $sliders as $key1 => $value1 ){ $counter1++; ?>
              <tr>
                <td><img src="./assets/banner/<?php echo htmlspecialchars( $value1["slider_img"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" width="100"></td>
                <td><?php echo htmlspecialchars( $value1["slider_description"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                <td><?php echo htmlspecialchars( $value1["slider_href"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                <?php $s = $value1["slider_status"]; ?>
                <td><span class='badge badge-<?php if( $s == 1 ){ ?>success<?php }else{ ?>danger<?php } ?>'><?php if( $s == 1 ){ ?>Ativado<?php }else{ ?>Desativado<?php } ?></span></td>
                <td>
                  <a class="btn btn-icon btn-primary btn-sm" href="/admin/banner/editar/<?php echo htmlspecialchars( $value1["slider_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><i class="fas fa-edit"></i></a>
                  <a class="btn btn-icon btn-danger btn-sm" onclick="return confirm('Deseja mesmo remover essa banner?')" href="/admin/banner/remover/<?php echo htmlspecialchars( $value1["slider_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><i class="fas fa-trash"></i></a>
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