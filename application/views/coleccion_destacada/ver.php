<section id="intro" class="intro-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
	    	<div class="x_panel">
        <div class="animated bounceInDown" align="left">
      
  <?= validation_errors('<div class="alert alert-danger">','</div> ')?>
    </div> 
  				<div class="animated fadeIn" align="left">
             <label><h3><strong>Ver Producto en La Seccion Coleccion Destacada</strong></h3></label>
             <hr>
        <form  role="form" action="<?php echo $this->config->base_url();?>banner/guardar_banner" method="POST"  enctype="multipart/form-data">
        <?php if ($producto): ?>
          <?php foreach ($producto as $key): ?>
          
            <div class="form-group">
              <label>Genero</label>
            <input type="text" class="form-control" name="txt_genero" id="txt_genero" value="<?=$key->descripcion_genero?>" placeholder="" readonly="true">
            </div>
               <div class="form-group">
              <label>Categoria</label>
             <input type="text" class="form-control" name="" value="<?=$key->descripcion_categoria?>" readonly="true">
            </div>
            <div class="form-group">
              <label>Sub Categoria</label>
             <input type="text" class="form-control" name="" value="<?=$key->descripcion_sub_categoria?>" readonly="true">
            </div>
             <div class="form-group">
              <label>Producto</label>
              <input type="text" class="form-control" name="" value="<?=$key->nombre?>" placeholder="" readonly="true">
            </div>
          <?php endforeach ?>
        <?php endif ?>
            <hr>
            <div class="form-group" align="center">
            
              <a href="<?=$this->config->base_url()?>coleccion_destacada" title="" class="btn btn-warning btn-lg"><i class="fa fa-exclamation-triangle"></i>&nbsp;Volver</a>
            </div>
          </form>  
          
  				</div>
	    	</div>
		  </div>
    </div>
  </div>
    </section>