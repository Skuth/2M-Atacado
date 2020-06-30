<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="header bg-gradient-primary pb-8 pt-5 pt-md-8"></div>

<?php $card = 4; ?>

<div class="container-fluid mt--6">
  <div class="row card-wrapper">

    <?php $counter1=-1;  if( isset($cards) && ( is_array($cards) || $cards instanceof Traversable ) && sizeof($cards) ) foreach( $cards as $key1 => $value1 ){ $counter1++; ?>

    <div class="col-xl-<?php echo htmlspecialchars( $card, ENT_COMPAT, 'UTF-8', FALSE ); ?> mb-4">
      <div class="card">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col">
              <h5 class="h3 mb-0">Cartão <?php echo htmlspecialchars( $key1 + 1, ENT_COMPAT, 'UTF-8', FALSE ); ?></h5>
            </div>
            <div class="col text-right">
              <a href="/admin/cartao/editar/<?php echo htmlspecialchars( $value1["id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-sm btn-primary">Editar</a>
            </div>
          </div>
        </div>

        <div class="card-body">
          <img src="./assets/cards/<?php echo htmlspecialchars( $value1["picture"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="mt-4 mb-4" width="120">
          <br>
          <span class="mr-2"><strong>Título</strong></span>
          <span class="badge badge-pill badge-info badge-lg"><?php echo htmlspecialchars( $value1["title"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
          <br><br>
          <span class="mr-2"><strong>Preço</strong></span>
          <span class="badge badge-pill badge-warning badge-lg">R$ <?php echo formatMoney($value1["price"]); ?></span>
          <br><br>
          <span class="mr-2"><strong>Url</strong></span>
          <span class="badge badge-pill badge-primary badge-lg"><?php echo htmlspecialchars( $value1["url"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
          <br><br>
        </div>
        
      </div>
    </div>

    <?php } ?>

  </div>
</div>

<br><br>