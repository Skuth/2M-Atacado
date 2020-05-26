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
              <h3 class="mb-0">Editando produto</h3>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form method="POST" action="/admin/produto/editar" enctype="multipart/form-data">
            <div class="pl-lg-4">

              <input type="hidden" name="id" value="<?php echo htmlspecialchars( $produto["product_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">

              <div class="row">
                <div class="col-lg-8">
                  <div class="form-group">
                    <label class="form-control-label">Nome</label>
                    <input type="text" class="form-control" required name="nome" value="<?php echo htmlspecialchars( $produto["product_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                  </div>
                </div>

                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Ref</label>
                    <input type="number" class="form-control" required name="ref" value="<?php echo htmlspecialchars( $produto["product_ref"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label">Preço</label>
                    <input type="number" step="0.01" class="form-control" required name="preco" value="<?php echo htmlspecialchars( $produto["product_price"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label">Estoque</label>
                    <input type="number" class="form-control" required name="estoque" value="<?php echo htmlspecialchars( $produto["product_stock"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                  </div>
                </div>

                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Distribuidor</label>
                    <select class="form-control" name="dist">
                      <option value="" disabled>Selecione um distribuidor</option>
                      <?php $counter1=-1;  if( isset($dist) && ( is_array($dist) || $dist instanceof Traversable ) && sizeof($dist) ) foreach( $dist as $key1 => $value1 ){ $counter1++; ?>
                      <option value="<?php echo htmlspecialchars( $value1["distributor_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" <?php if( $produto["brand_id"] == $value1["distributor_id"] ){ ?>active<?php } ?>><?php echo htmlspecialchars( $value1["distributor_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Departamento</label>
                    <select class="form-control" name="dep">
                      <option value="" disabled>Selecione um departamento</option>
                      <?php $counter1=-1;  if( isset($dep) && ( is_array($dep) || $dep instanceof Traversable ) && sizeof($dep) ) foreach( $dep as $key1 => $value1 ){ $counter1++; ?>
                      <option value="<?php echo htmlspecialchars( $value1["department_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" <?php if( $produto["department_id"] == $value1["department_id"] ){ ?>active<?php } ?>><?php echo htmlspecialchars( $value1["department_text"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Categoria</label>
                    <select class="form-control" name="cat">
                      <option value="" disabled>Selecione uma categoria</option>
                      <?php $counter1=-1;  if( isset($cat) && ( is_array($cat) || $cat instanceof Traversable ) && sizeof($cat) ) foreach( $cat as $key1 => $value1 ){ $counter1++; ?>
                      <option value="<?php echo htmlspecialchars( $value1["category_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" <?php if( $produto["category_id"] == $value1["category_id"] ){ ?>active<?php } ?>><?php echo htmlspecialchars( $value1["category_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="col-lg-12">
                  <div class="form-group">
                    <label>Descrição</label>
                    <textarea class="form-control" name="descricao" rows="6" required><?php echo htmlspecialchars( $produto["product_description"], ENT_COMPAT, 'UTF-8', FALSE ); ?></textarea>
                  </div>
                </div>

                <div class="col-lg-12 mb-5">
                  <div class="custom-file">
                    <label class="form-control-label">Fotos</label>
                    <input type="file" class="form-control" multiple accept="image/x-png,image/jpg,image/jpeg" name="fotos[]">
                  </div>
                </div>
              </div>

              <button class="btn btn-icon btn-primary" type="submit" name="save">
                <span class="btn-inner--icon"><i class="fas fa-save"></i></span>
                <span class="btn-inner--text">Salvar</span>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <br><br>