<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="container">
  <h2 class="text-center">Cadastrar endereço</h2>

  <form method="POST" onsubmit="return clientAddressRegister(event, this)" class="form-login form-register form-active">
    <div class="form-login-control">
      <input type="text" id="nome" name="nome" required>
      <label for="nome">Nome *</label>
    </div>
    
    <div class="form-login-control">
      <input type="tel" id="cep" name="cep" maxlength="8" minlength="8" required onchange="verifyCep(value)">
      <label for="cep">CEP *</label>
    </div>

    <div class="form-login-control">
      <input type="text" id="cidade" name="cidade" required>
      <label for="cidade">Cidade *</label>
    </div>

    <div class="form-login-control">
      <input type="text" id="bairro" name="bairro" required>
      <label for="bairro">Bairro *</label>
    </div>

    <div class="form-login-control">
      <input type="text" id="rua" name="rua" required>
      <label for="rua">Rua *</label>
    </div>

    <div class="form-login-control">
      <input type="tel" id="numero" name="numero" required>
      <label for="numero">Número *</label>
    </div>

    <div class="form-login-control">
      <input type="text" id="compemento" name="compemento">
      <label for="compemento">Complemento</label>
    </div>

    <div class="form-login-control">
      <input type="tel" id="contato" name="contato" required>
      <label for="contato">Contato *</label>
    </div>

    <div class="form-login-control">
      <button type="submit" class="btn btn-circle btn-blue btn-medium">
        <span>Salvar</span><i class="icofont-save"></i>
      </button>
    </div>
  </form>

</div>