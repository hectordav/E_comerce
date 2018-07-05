<div class="container">
<br>
  <div class="row">
  <ul class="nav nav-tabs">
  <li role="presentation"><a href="<?=$this->config->base_url()?>pedido">Pedidos</a></li>
  <li role="presentation"><a href="<?=$this->config->base_url()?>cliente">Clientes</a></li>
  <li role="presentation"><a href="<?=$this->config->base_url()?>producto">Productos</a></li>
  <li role="presentation"><a href="<?= $this->config->base_url()?>inventario_producto">Inventario</a></li>
  <li role="presentation" class="active"><a href="<?=$this->config->base_url()?>principal/config_inicial">Config Inicial</a></li>
   <li role="presentation" ><a href="<?=$this->config->base_url()?>principal/config_general">Config General</a></li>
</ul>
  </div>
</div>
<section id="intro" class="intro-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
	    	<div class="x_panel">
        <div class="animated bounceInDown" align="left">
      
  <?= validation_errors('<div class="alert alert-danger">','</div> ')?>
    </div> 
  				<div class="animated fadeIn" align="left">
             <label><h3><strong>Agregar Producto en la Seccion Banner</strong></h3></label>
             <hr>
        <form  role="form" action="<?php echo $this->config->base_url();?>banner/guardar_banner" method="POST"  enctype="multipart/form-data">
            <div class="form-group">
              <label>Genero</label>
              <select class="form-control" name="id_genero" id="id_genero" data-show-subtext="true" data-live-search="true"  required="required">
                    <option value="">Seleccione Genero</option>
                     <?php
                     if ($genero) {
                     foreach ($genero as $i) {
                             echo '<option value="'. $i->id .'">'.$i->descripcion.'</option>';
                            }
                     }else{
                     }
                        ?>
              </select>
            </div>
               <div class="form-group">
              <label>Categoria</label>
              <select class="form-control" name="id_categoria" id="id_categoria" data-show-subtext="true" data-live-search="true"  required="required">
                <option value="">Seleccione Categoria</option>
                     
              </select>
            </div>
            <div class="form-group">
              <label>Sub Categoria</label>
              <select class="form-control" name="id_sub_categoria" id="id_sub_categoria" data-show-subtext="true" data-live-search="true"  required="required">
                <option value="">Seleccione Sub Categoria</option>
                     
              </select>
            </div>
             <div class="form-group">
              <label>Producto</label>
              <select class="form-control" name="id_producto" id="id_producto" data-show-subtext="true" data-live-search="true"  required="required">
                    <option value="">Seleccione Producto</option>
              </select>
            </div>
          
            <hr>
            <div class="form-group" align="center">
              <button type="submit" class="btn btn-lg btn-success"><i class="fa fa-save"></i>&nbsp;Guardar</button>
              <a href="<?=$this->config->base_url()?>banner" title="" class="btn btn-warning btn-lg"><i class="fa fa-exclamation-triangle"></i>&nbsp;Volver</a>
            </div>
          </form>  
          
  				</div>
	    	</div>
		  </div>
    </div>
  </div>
    </section>