<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
  <div class="separator separator-bottom separator-skew zindex-100">
    <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
      <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
    </svg>
  </div>
</div>

<div class="container mt--8 pb-5">
  <div class="row justify-content-center">
    <div class="col-lg-5 col-md-7">
      <div class="card bg-secondary border-0 mb-0">
        <div class="card-body px-lg-5 py-lg-5">

          <form role="form" method="POST" action="/admin/login">
            <div class="form-group mb-3">
              <div class="input-group input-group-merge input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                </div>
                <input class="form-control" name="user" placeholder="Usuario" type="text">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group input-group-merge input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                </div>
                <input class="form-control" name="pass" placeholder="Senha" type="password">
              </div>
            </div>
            <button type="submit" class="btn btn-primary my-4">
              <i class="fas fa-sign-in-alt mr-1"></i> Entrar
            </button>
          </form>
          
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  window.addEventListener("load", () => {
    const body = document.getElementsByTagName("body")[0]
    body.classList.add("bg-default")
    console.log(body.classList)
  })
</script>