<section id="intro" class="intro-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
	    	<div class="x_panel">
        <div class="animated bounceInDown" align="left">
      
  <?= validation_errors('<div class="alert alert-danger">','</div> ')?>
    </div> 
  				<div class="animated fadeIn" align="left">
             <label><h3><strong>Activar/Desactivar Usuario</strong></h3></label>
             <hr>
        <form  role="form" action="<?php echo $this->config->base_url();?>usuario/actualizar_estado" method="POST"  enctype="multipart/form-data">
            
               <div class="form-group">
              <label>Nombre</label>
              <?php if ($usuario): ?>
                <?php foreach ($usuario as $key): ?>
            <input type="hidden" name="txt_id_usuario" value="<?=$key->id_usuario?>">
            <input type="text" class="form-control" name="txt_nombre" value="<?= $key->nombre?>" placeholder="Ingrese Nombre"  readonly>
            </div>
            <div class="form-group">
              <label>Estado</label>
            <input type="text" class="form-control" name="txt_tipo_estado_usuario" value="<?= $key->estado_usuario?>" placeholder="" readonly>
            </div>
              <?php endforeach ?>
             <?php endif ?>
             <div class="form-group">
              <label>Nuevo Estado</label>
                 <select class="form-control" name="id_estado_usuario" id="id_estado_usuario" data-show-subtext="true" data-live-search="true"  required="required">
                    <option value="">Seleccione Estado</option>
                     <?php
                     if ($estado_usuario) {
                     foreach ($estado_usuario as $i) {
                             echo '<option value="'. $i->id .'">'.$i->descripcion.'</option>';
                            }
                     }else{
                     }
                        ?>
              </select>
            </div>
             
                 
             
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