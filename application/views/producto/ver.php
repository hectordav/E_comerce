<div class="container">
<br>
  <div class="row">
  <ul class="nav nav-tabs">
  <li role="presentation"><a href="<?=$this->config->base_url()?>pedido">Pedidos</a></li>
  <li role="presentation" ><a href="<?=$this->config->base_url()?>cliente/grilla">Clientes</a></li>
  <li role="presentation" class="active"><a href="<?=$this->config->base_url()?>producto">Productos</a></li>
  <li role="presentation"><a href="<?= $this->config->base_url()?>inventario_producto">Inventario</a></li>
  <li role="presentation"><a href="<?=$this->config->base_url()?>principal/config_inicial">Config Inicial</a></li>
   <li role="presentation"><a href="<?=$this->config->base_url()?>principal/config_general">Config General</a></li>
</ul>
  </div>
</div>
<script type="text/javascript"> 
 function cambiar() {
  id=document.getElementById('var_1').src;
  document.getElementById('matrix').src =  id;
 }
  function cambiar_2() {
  id=document.getElementById('var_2').src;
  document.getElementById('matrix').src =  id;
 }
  function cambiar_3() {
  id=document.getElementById('var_3').src;
  document.getElementById('matrix').src =  id;
 }
  function cambiar_4() {
  id=document.getElementById('var_4').src;
  document.getElementById('matrix').src =  id;
 } 
</script>
<section id="intro" class="intro-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
	    	<div class="x_panel">
        <div class="animated bounceInDown" align="left">
      
  <?= validation_errors('<div class="alert alert-danger">','</div> ')?>
    </div> 
  				<div class="animated fadeIn" align="left">
             <label><h3><strong>Producto</strong></h3></label>
             <hr>
      <?php if ($producto): ?>
        <?php foreach ($producto as $key): ?>
          
      
        <form  role="form" action="<?php echo $this->config->base_url();?>producto/ver_producto" method="POST"  enctype="multipart/form-data">
           <div class="x_content">
                    <div class="col-md-7 col-sm-7 col-xs-12">
                      <div class="product-image">
                        <img id="matrix" src="<?php echo $this->config->base_url();?>assets/img/<?=$key->adjunto_1?>"/>
                      </div>
                      <div class="product_gallery">
                         <a>
                          <img id="var_1" src="<?php echo $this->config->base_url();?>assets/img/<?=$key->adjunto_1?>"  onclick="cambiar()" />
                        </a>
                         <a>
                        
                          <img id="var_2" src="<?php echo $this->config->base_url();?>assets/img/<?=$key->adjunto_2?>"  onclick="cambiar_2()" />
                        </a>
                        <a>
                          <img id="var_3" src="<?php echo $this->config->base_url();?>assets/img/<?=$key->adjunto_3?>"  onclick="cambiar_3()"" alt="..."  />
                        </a>
                        <a>
                          <img id="var_4" src="<?php echo $this->config->base_url();?>assets/img/<?=$key->adjunto_4?>"  onclick="cambiar_4()" alt="..."  />
                        </a>
                      </div>
                    </div>
     
             <div class="col-md-5 col-sm-5 col-xs-12" style="border:0px solid #e5e5e5;">
               <h2 class="prod_title"><?=$key->nombre?></h2>
         <br>
               <div class="">
                        <h3>Color</h3>
                        <ul class="list-inline prod_color">
                          <li>
                          <?php if ($color): ?>
                            <?php foreach ($color as $key): ?>
                              <p><?=$key->descripcion_color?></p>
                            <?php endforeach ?>
                          <?php endif ?>
                          
                           
                          </li>
                        </ul>
              </div>
            
               <div class="">
               <br>
                        <h3>Tallas</h3>
                        <ul class="list-inline prod_color">
                         <?php if ($talla): ?>
                         <?php foreach ($talla as $key): ?>
                          <li>
                            <p><?=$key->descripcion_talla?></p>
                          </li>
                         <?php endforeach ?>
                         <?php endif ?>

                        </ul>
                      </div>
             </div>
            
            </div>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <h4 class="prod_title">Descripcion del Producto</h4>
        <hr>
        <?php if ($producto): ?>
          <?php foreach ($producto as $key): ?>
             <?=$key->descripcion?>
          <?php endforeach ?>
        <?php endif ?>
      
         <hr>
          <?php endforeach ?>
      <?php endif ?>
      </div>
            <div class="form-group" align="center">
              <a href="<?=$this->config->base_url()?>producto" title="" class="btn btn-warning btn-lg"><i class="fa fa-exclamation-triangle"></i>&nbsp;Volver</a>
            </div>
          
          </form>  
          
  				</div>
	    	</div>
		  </div>
    </div>
  </div>
    </section>