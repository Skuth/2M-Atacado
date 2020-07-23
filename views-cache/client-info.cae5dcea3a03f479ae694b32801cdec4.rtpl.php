<?php if(!class_exists('Rain\Tpl')){exit;}?><?php $siteData = $GLOBALS["siteData"]; ?>
<div class="container">
  <div class="purchases-container">
    <div class="purchases-content">

      <div class="purchases-title">
        <h2>Minha conta</h2>
      </div>

      <div class="purchase-box view-order">

        <div class="purchase-view-status no-border">

          <div class="box">
            <span class="title h3">Meus dados</span>
          </div>

          <div class="box">
            <span class="title">Meus pontos:</span>
            <span class="badge badge-circle badge-primary"><?php echo htmlspecialchars( $user["client_points"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
            <br><br>
            <span class="title">Razão social:</span>
            <span class="badge badge-circle badge-primary"><?php echo htmlspecialchars( $user["client_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
            <br><br>
            <?php if( $user["client_type"] == 1 ){ ?>
            <span class="title">CNPJ:</span>
            <span class="badge badge-circle badge-primary"><?php echo formatCnpjCpf($user["client_cnpj"]); ?></span>
            <br><br>
            <span class="title">Inscrição Estadual:</span>
            <span class="badge badge-circle badge-primary"><?php if( $user["client_ie"] != '' ){ ?><?php echo formatCnpjCpf($user["client_ie"]); ?><?php }else{ ?>----------<?php } ?></span>
            <?php }else{ ?>
            <span class="title">CPF:</span>
            <span class="badge badge-circle badge-primary"><?php echo formatCnpjCpf($user["client_cpf"]); ?></span>
            <?php } ?>
            <br><br>
            <span class="title">E-mail:</span>
            <span class="badge badge-circle badge-primary"><?php echo htmlspecialchars( $user["client_email"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
            <br><br>
            <span class="title">Contato:</span>
            <span class="badge badge-circle badge-primary"><?php echo formatPhone($user["client_phone"]); ?></span>
          </div>

          <div class="divider"></div>

          <div class="box">
            <span class="title h3">Meu endereço</span>
          </div>

          <div class="box">
            <span class="title">Contato:</span>
            <span class="badge badge-circle badge-primary"><?php echo formatPhone($address["client_address_contact"]); ?></span>
            <br><br>
            <span class="title">Cep:</span>
            <span class="badge badge-circle badge-primary"><?php echo formatCep($address["client_address_cep"]); ?></span>
            <br><br>
            <span class="title">Cidade:</span>
            <span class="badge badge-circle badge-primary"><?php echo htmlspecialchars( $address["client_address_cidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
            <br><br>
            <span class="title">Bairro:</span>
            <span class="badge badge-circle badge-primary"><?php echo htmlspecialchars( $address["client_address_bairro"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
            <br><br>
            <span class="title">Rua:</span>
            <span class="badge badge-circle badge-primary"><?php echo htmlspecialchars( $address["client_address_rua"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
            <br><br>
            <span class="title">Número:</span>
            <span class="badge badge-circle badge-primary"><?php echo htmlspecialchars( $address["client_address_numero"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
            <br><br>
            <?php if( $address["client_address_complemento"] != '' ){ ?>
            <span class="title">Complemento:</span>
            <span class="badge badge-circle badge-primary"><?php echo htmlspecialchars( $address["client_address_complemento"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
            <?php } ?>
          </div>

        </div>

      </div>

    </div>
  </div>
</div>