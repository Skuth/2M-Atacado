<?php if(!class_exists('Rain\Tpl')){exit;}?><?php $siteData = $GLOBALS["siteData"]; ?>
  <div class="distributor">
    <div class="distributor-slider">
      <?php $distributors = getDistributors(); ?>
      <?php $counter1=-1;  if( isset($distributors) && ( is_array($distributors) || $distributors instanceof Traversable ) && sizeof($distributors) ) foreach( $distributors as $key1 => $value1 ){ $counter1++; ?>
        <?php if( $value1["distributor_id"] > 0 ){ ?>
        <a href="/distribuidor/<?php echo htmlspecialchars( $value1["distributor_href"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
          <img src="./assets/distribuidores/<?php echo htmlspecialchars( $value1["distributor_logo"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt="Logo da empresa <?php echo htmlspecialchars( $value1["distributor_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
        </a>
        <?php } ?>
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
    <div class="footer-info">
      <ul>
        <li><span><strong>Formas de pagamento</strong></span></li>
        <li class="payments">
          <i class="icofont-real"></i>
          <i class="icofont-elo"></i>
          <i class="icofont-american-express"></i>
          <i class="icofont-visa"></i>
          <i class="icofont-mastercard"></i>
        </li>
      </ul>
    </div>
  </footer>
  <div class="footer-rights">
    <?php $year = 2020; ?>
    <?php $cyear = date('Y'); ?>
    <p>&copy; Todos os direitos reservados para <?php echo htmlspecialchars( $siteData["site_data_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?> - <?php echo htmlspecialchars( $year, ENT_COMPAT, 'UTF-8', FALSE ); ?> <?php if( $cyear != $year ){ ?> - <?php echo htmlspecialchars( $cyear, ENT_COMPAT, 'UTF-8', FALSE ); ?> <?php } ?></p>
  </div>

  <script src="./assets/js/sweetalert2@9.js"></script>

  <script type="text/javascript" src="./assets/js/jquery-3.5.1.min.js"></script>
  <script type="text/javascript" src="./assets/js/jquery-migrate-1.2.1.min.js"></script>
  <script type="text/javascript" src="./assets/js/slick.min.js"></script>

  <script src="./assets/js/script.min.js?v=<?php echo htmlspecialchars( $GLOBALS['version'], ENT_COMPAT, 'UTF-8', FALSE ); ?>"></script>
</body>
</html>