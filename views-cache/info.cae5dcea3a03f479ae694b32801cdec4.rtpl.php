<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="container">
  <div class="reader-container">

    <div class="reader-header">
      <div class="reader-text">
        <h2><?php echo htmlspecialchars( $content, ENT_COMPAT, 'UTF-8', FALSE ); ?></h2>
      </div>
      <div class="reader-image">
        <?php if( isset($banner) && strlen($banner) > 0 ){ ?>
        <img src="./assets/distribuidores/<?php echo htmlspecialchars( $banner, ENT_COMPAT, 'UTF-8', FALSE ); ?>" <?php if( isset($type) && $type == 1 ){ ?> alt="Banner Sobre nós" <?php }else{ ?> alt="Banner da distribuidora <?php echo htmlspecialchars( $content, ENT_COMPAT, 'UTF-8', FALSE ); ?>" <?php } ?>>
        <?php }else{ ?>
        <img src="./assets/img/banner-info.webp" <?php if( isset($type) && $type == 1 ){ ?> alt="Banner <?php echo htmlspecialchars( $content, ENT_COMPAT, 'UTF-8', FALSE ); ?>" <?php }else{ ?> alt="Banner da distribuidora <?php echo htmlspecialchars( $content, ENT_COMPAT, 'UTF-8', FALSE ); ?>" <?php } ?>">
        <?php } ?>
      </div>
    </div>

    <div class="header-content">
      <?php echo parseProductDesc($desc); ?>

      <?php if( isset($btn) && strlen($btn) > 0 ){ ?>
      <div class="btn-container btn-container-center">
        <a href="/produtos/distribuidor/<?php echo htmlspecialchars( $btn, ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-circle btn-blue btn-medium">Ver produtos</a>
      </div>
      <?php } ?>

      <?php if( isset($pics) && count($pics) > 0 ){ ?>
      <div class="content-image">
        <div id="reader-pictures">
          <?php $counter1=-1;  if( isset($pics) && ( is_array($pics) || $pics instanceof Traversable ) && sizeof($pics) ) foreach( $pics as $key1 => $value1 ){ $counter1++; ?>
          <img src="./assets/distribuidores/<?php echo htmlspecialchars( $value1, ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt="Imagem <?php echo htmlspecialchars( $key1 + 1, ENT_COMPAT, 'UTF-8', FALSE ); ?> da distribuidora <?php echo htmlspecialchars( $content, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
          <?php } ?>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
</div>

<script>
  window.addEventListener("load", () => {
    let footer = document.querySelector(".distributor")
    footer.style.marginTop = "-50px"
    footer.style.zIndex = "3"
    readerSlide()
  })
</script>