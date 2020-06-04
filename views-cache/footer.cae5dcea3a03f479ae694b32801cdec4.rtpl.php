<?php if(!class_exists('Rain\Tpl')){exit;}?><?php $siteData = $GLOBALS["siteData"]; ?>  
  <div class="distributor">
    <div class="distributor-slider">
      <?php $distributors = getDistributors(); ?>
      <?php $counter1=-1;  if( isset($distributors) && ( is_array($distributors) || $distributors instanceof Traversable ) && sizeof($distributors) ) foreach( $distributors as $key1 => $value1 ){ $counter1++; ?>
      <a href="/distribuidor/<?php echo htmlspecialchars( $value1["distributor_href"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
        <img src="./assets/distribuidores/<?php echo htmlspecialchars( $value1["distributor_logo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt="Logo da empresa <?php echo htmlspecialchars( $value1["distributor_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
      </a>
      <?php } ?>
    </div>
    <div class="distributor-controls">
      <span id="left"><i class="icofont-thin-left"></i></span>
      <span id="right"><i class="icofont-thin-right"></i></span>
    </div>
  </div>

  <footer class="footer">
    <div class="footer-logo">
      <a href="./">
        <img src="./assets/img/<?php echo htmlspecialchars( $siteData['site_data_logo'], ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt="Logo da <?php echo htmlspecialchars( $siteData['site_data_name'], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
      </a>
    </div>
    <div class="footer-info">
      <ul>
        <li><i class="icofont-google-map"></i> Endereço: <span><?php echo htmlspecialchars( $siteData["site_data_address"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span></li>
        <li><i class="icofont-id-card"></i> CNPJ: <span><?php echo htmlspecialchars( $siteData["site_data_cnpj"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span></li>
        <li><i class="icofont-files-stack"></i> Inscrição Estadual: <span><?php echo htmlspecialchars( $siteData["site_data_ie"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span></li>
      </ul>
    </div>
    <div class="footer-contact">
      <ul>
        <li><i class="icofont-phone"></i> Tel: <span><?php echo htmlspecialchars( $siteData["site_data_tel"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span></li>
        <li><i class="icofont-ui-email"></i> E-mail: <span><?php echo htmlspecialchars( $siteData["site_data_email"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span></li>
        <li><i class="icofont-clock-time"></i> Horário de funcionamento: <span><?php echo htmlspecialchars( $siteData["site_data_oh"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span></li>
      </ul>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>

  <script type="text/javascript" src="./assets/js/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="./assets/js/jquery-migrate-1.2.1.min.js"></script>
  <script type="text/javascript" src="./assets/js/slick.min.js"></script>

  <script src="./assets/js/script.min.js?id=<?php echo rand(); ?>"></script>
</body>
</html>