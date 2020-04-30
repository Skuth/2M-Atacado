<?php if(!class_exists('Rain\Tpl')){exit;}?>  
  <div class="distributor">
    <div class="distributor-slider">
      <?php $counter1=-1; $newvar1=array(1,1,1,1,1,1); if( isset($newvar1) && ( is_array($newvar1) || $newvar1 instanceof Traversable ) && sizeof($newvar1) ) foreach( $newvar1 as $key1 => $value1 ){ $counter1++; ?>
      <a href="/empresa/texsa">
        <img src="https://lh3.googleusercontent.com/proxy/q5pMChRuDp3f91D4tBGy2f2XEYjzaMiKXAiWtBrR548Aw_vDwQWurxJZJT4NVqGQjSsfWD6dWV2mvhwkwy1crgYn-NpGc38ZvJQUuohJplJuDs2pG9rT1Da9t-bdKbmD" alt="Logo da empresa">
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
        <img src="./assets/img/logo.png" alt="Logo da 2M Atacado">
      </a>
    </div>
    <div class="footer-info">
      <ul>
        <li><i class="icofont-google-map"></i> Endereço: <span>R. Curitiba, 653 - Jardim Olinda - CEP: 28911-140</span></li>
        <li><i class="icofont-id-card"></i> CNPJ: <span>84.483.803/0001-34</span></li>
        <li><i class="icofont-files-stack"></i> Inscrição Estadual: <span>90.901.27-3</span></li>
      </ul>
    </div>
    <div class="footer-contact">
      <ul>
        <li><i class="icofont-phone"></i> Tel: <span>(22) 9 9999-9999</span></li>
        <li><i class="icofont-ui-email"></i> E-mail: <span>contato@2matacado.com</span></li>
        <li><i class="icofont-clock-time"></i> Horário de funcionamento: <span>Seg. à Sex. das 8h às 17:45h</span></li>
      </ul>
    </div>
  </footer>

  <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
  <script src="./assets/js/script.min.js"></script>
</body>
</html>