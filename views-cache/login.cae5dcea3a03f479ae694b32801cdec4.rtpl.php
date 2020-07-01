<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="container">
  <?php if( isset($cart) && $cart == TRUE ){ ?>
  <h2 class="text-center">Faça login para continuar</h2>
  <?php }else{ ?>
  <h2 class="text-center">Entrar</h2>
  <?php } ?>

  <form onsubmit="return clienteLogin(event)" class="form-login">
    <div class="form-login-control">
      <input type="text" id="login" name="login" maxlength="14" required>
      <label for="login">CPF ou CNPJ</label>
    </div>
    <div class="form-login-control">
      <input type="password" id="password" name="password" required>
      <label for="password">Senha</label>
    </div>

    <div class="form-login-control">
      <button type="submit" class="btn btn-circle btn-blue btn-medium">
        <span>Entrar</span><i class="icofont-login"></i>
      </button>
    </div>
  </form>
</div>