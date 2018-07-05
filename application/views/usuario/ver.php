<section id="intro" class="intro-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
	    	<div class="x_panel">
        <div class="animated bounceInDown" align="left">
      
  <?= validation_errors('<div class="alert alert-danger">','</div> ')?>
    </div> 
  				<div class="animated fadeIn" align="left">
             <label><h3><strong>Ver Usuario</strong></h3></label>
             <hr>
        <form  role="form" action="<?php echo $this->config->base_url();?>usuario/guardar_usuario" method="POST"  enctype="multipart/form-data">
            <div class="form-group">
              <label>Nivel</label>
              <?php if ($usuario): ?>
                <?php foreach ($usuario as $key): ?>
                  
              <input type="text" class="form-control" name="" value="<?=$key->nivel?>" placeholder="" readonly>
            </div>
               <div class="form-group">
              <label>Nombre</label>
            <input type="text" class="form-control" name="txt_nombre" value="<?= $key->nombre?>" placeholder="Ingrese Nombre" readonly>
            </div>
            <div class="form-group">
              <label>Login</label>
             <input type="email" class="form-control" name="txt_login" value="<?= $key->login?>" placeholder="Ingrese Su email" readonly>
            </div>
             <div class="form-group">
                <?php endforeach ?>
              <?php endif ?>
            <hr>
            <div class="form-group" align="center">
              <a href="<?=$this->config->base_url()?>usuario/grilla" title="" class="btn btn-warning btn-lg"><i class="fa fa-exclamation-triangle"></i>&nbsp;Volver</a>
            </div>
          </form>  
          
  				</div>
	    	</div>
		  </div>
    </div>
  </div>
    </section>