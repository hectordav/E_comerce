<section id="intro" class="intro-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
	    	<div class="x_panel">
        <div class="animated bounceInDown" align="left">
      
  <?= validation_errors('<div class="alert alert-danger">','</div> ')?>
    </div> 
  				<div class="animated fadeIn" align="left">
             <label><h3><strong>Editar Usuario</strong></h3></label>
             <hr>
        <form  role="form" action="<?php echo $this->config->base_url();?>usuario/actualizar_usuario" method="POST"  enctype="multipart/form-data">
            <div class="form-group">
              <label>Nivel</label>
              <select class="form-control" name="id_nivel" id="id_nivel" data-show-subtext="true" data-live-search="true"  required="required">
                    <option value="">Seleccione Nivel</option>
                     <?php
                     if ($nivel) {
                     foreach ($nivel as $i) {
                             echo '<option value="'. $i->id .'">'.$i->descripcion.'</option>';
                            }
                     }else{
                     }
                        ?>
              </select>
            </div>
               <div class="form-group">
              <label>Nombre</label>
              <?php if ($usuario): ?>
                <?php foreach ($usuario as $key): ?>
            <input type="hidden" name="txt_id_usuario" value="<?=$key->id_usuario?>">
            <input type="text" class="form-control" name="txt_nombre" value="<?= $key->nombre?>" placeholder="Ingrese Nombre">
            </div>
            <div class="form-group">
              <label>Login</label>
             <input type="email" class="form-control" name="txt_login" value="<?= $key->login?>" placeholder="Ingrese Su email">
            </div>
             <div class="form-group">
              <label>Clave</label>
              <input type="password" class="form-control" name="txt_clave" value="" placeholder="Ingrese su Clave">
            </div>
             <div class="form-group">
              <label>Rep Clave</label>
           <input type="password" class="form-control" name="txt_clave_2" value="" placeholder="Repita su Clave">
            </div>
                 <?php endforeach ?>
              <?php endif ?>

            <hr>
            <div class="form-group" align="center">
              <button type="submit" class="btn btn-lg btn-success"><i class="fa fa-save"></i>&nbsp;Guardar</button>
              <a href="<?=$this->config->base_url()?>usuario/grilla" title="" class="btn btn-warning btn-lg"><i class="fa fa-exclamation-triangle"></i>&nbsp;Volver</a>
            </div>
          </form>  
          
  				</div>
	    	</div>
		  </div>
    </div>
  </div>
    </section>