<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="row">
    <div class="col-xl-12 order-xl-1">
      <div class="card">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col-8">
              <h3 class="mb-0">Cadastrando produto</h3>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form method="POST" action="/admin/produto/novo" enctype="multipart/form-data">
            <div class="pl-lg-4">

              <div class="row">
                <div class="col-lg-8">
                  <div class="form-group">
                    <label class="form-control-label">Nome</label>
                    <input type="text" class="form-control" required name="nome" placeholder="Nome">
                  </div>
                </div>

                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Ref</label>
                    <input type="number" class="form-control" required name="ref" placeholder="Ref">
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label">Preço</label>
                    <input type="number" step="0.01" class="form-control" required name="preco" placeholder="Preço">
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label">Estoque</label>
                    <input type="number" class="form-control" required name="estoque" placeholder="Estoque">
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label">Distribuidor</label>
                    <select class="form-control" name="dist" required>
                      <option value="" disabled selected>Selecione um distribuidor</option>
                      <?php $counter1=-1;  if( isset($dist) && ( is_array($dist) || $dist instanceof Traversable ) && sizeof($dist) ) foreach( $dist as $key1 => $value1 ){ $counter1++; ?>
                      <option value="<?php echo htmlspecialchars( $value1["distributor_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["distributor_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label">Departamento</label>
                    <select class="form-control" name="dep" required>
                      <option value="" disabled selected>Selecione um departamento</option>
                      <?php $counter1=-1;  if( isset($dep) && ( is_array($dep) || $dep instanceof Traversable ) && sizeof($dep) ) foreach( $dep as $key1 => $value1 ){ $counter1++; ?>
                      <option value="<?php echo htmlspecialchars( $value1["department_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["department_text"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="col-lg-12">
                  <div class="form-group">
                    <label>Descrição</label>
                    <textarea class="form-control" name="descricao" rows="6" required placeholder="Descrição"></textarea>
                  </div>
                </div>

                <div class="col-lg-12 mb-5">
                  <div class="custom-file">
                    <label class="form-control-label">Fotos</label>
                    <input type="file" class="form-control" multiple required accept="image/x-png,image/jpg,image/jpeg" name="fotos[]">
                  </div>
                </div>
              </div>

              <button class="btn btn-icon btn-primary" type="submit" name="save">
                <span class="btn-inner--icon"><i class="fas fa-save"></i></span>
                <span class="btn-inner--text">Cadastrar</span>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <br><br>