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
      <div class="col-md-12 col-sm-12 col-xs-12 " >
	    	<div class="">
        <div class="animated bounceInDown " align="left">
      
  <?= validation_errors('<div class="alert alert-danger">','</div> ')?>
    </div> 
  				<div class="animated fadeIn" align="left">
         
             <hr>
      <?php if ($producto): ?>
        <?php foreach ($producto as $key): ?>
          
      
       
           <div class="x_content x_panel">
                    <div class="col-md-5 col-sm-5 col-xs-12" align="center">
                      <div class="product-image">
                        <img id="matrix" src="<?php echo $this->config->base_url();?>assets/img/<?=$key->adjunto_1?>"/>
                      </div>
                     <br>
                     
                  
                      <div class="product_gallery">
                         <a>
                          <img id="var_1" src="<?php echo $this->config->base_url();?>assets/img/<?=$key->adjunto_1?>"  onclick="cambiar()" />
                        </a>
                         <a>
                        
                          <img id="var_2" src="<?php echo $this->config->base_url();?>assets/img/<?=$key->adjunto_2?>" class="img-responsive" onclick="cambiar_2()" />
                        </a>
                        <a>
                          <img id="var_3" src="<?php echo $this->config->base_url();?>assets/img/<?=$key->adjunto_3?>" class="img-responsive" onclick="cambiar_3()"" alt="..."  />
                        </a>
                        <a>
                          <img id="var_4" src="<?php echo $this->config->base_url();?>assets/img/<?=$key->adjunto_4?>" class="img-responsive" onclick="cambiar_4()" alt="..."  />
                        </a>
                      </div>
                     
                    </div>
              
             <div class="col-md-4 col-sm-4 col-xs-12" style="border:0px solid #e5e5e5;">
              <br>
               <br>
               <h2 class="prod_title"><strong><?=$key->nombre?></strong></h2>
         
               <div>
               <br>
    <form action="<?=$this->config->base_url()?>pre_pedido/agregar_producto_carrito" method="post" accept-charset="utf-8">
                  <h3>Colores Disponibles</h3>
                <select name="id_color_producto" class="form-control">
                 <?php if ($color): ?>
                  <?php foreach ($color as $key): ?>
                  <option value="<?=$key->id_color_producto?>"><?=$key->descripcion_color?></option>
                  <?php endforeach ?>
                <?php endif ?>
                 </select>
              </div>
            
               <div>
               <br>
              <h3>Tallas disponibles</h3>
                        <select name="id_talla_producto" class="form-control">
                        <?php if ($talla): ?>
                          <?php foreach ($talla as $key): ?>
                             <option value="<?=$key->id_talla_producto?>"><?=$key->descripcion_talla?></option>
                          <?php endforeach ?>
                        <?php endif ?>
                        </select>
                      </div>
             </div>
             <!-- /content -->
      <div class="col-lg-3 col-md-3 col-sm-12">
            <div align="center">
        <table class="table-bordered">
      
      <?php if ($tipo_moneda): ?>
        <?php foreach ($tipo_moneda as $key_2): ?>
          <? $simbolo=$key_2->simbolo?>
        <?php endforeach ?>
        <?php endif ?>
        <?php if ($producto): ?>
          <?php foreach ($producto as $key): ?>
      <label><h3>Precio: <?=$key->total?> <?=$simbolo?></h3></label>
        <?php endforeach ?>
      <?php else: ?>
        
            
        <label><h3>Precio: <?=$key->total?></h3></label>
         
      <?php endif ?>
      <hr>
      <input type="hidden" name="txt_id_producto" value="<?=$key->id_producto?>">
           <select name="id_cantidad" class="select form-control" required="required">
              <option value="1">1 Unidad</option>
              <option value="2">2 Unidades</option>
              <option value="3">3 Unidades</option>
              <option value="4">4 Unidades</option>
              <option value="5">5 Unidades</option>
              <option value="6">6 Unidades</option>
              <option value="7">7 Unidades</option>
              <option value="8">8 Unidades</option>
              <option value="9">9 Unidades</option>
              <option value="11">11 Unidades</option>
              <option value="12">12 Unidades</option>
              <option value="13">13 Unidades</option>
              <option value="14">14 Unidades</option>
              <option value="15">15 Unidades</option>
              <option value="16">16 Unidades</option>
              <option value="17">17 Unidades</option>
              <option value="18">18 Unidades</option>
              <option value="19">19 Unidades</option>
              <option value="20">20 Unidades</option>
              <option value="21">21 Unidades</option>
              <option value="22">22 Unidades</option>
              <option value="23">23 Unidades</option>
              <option value="24">24 Unidades</option>
              <option value="25">25 Unidades</option>
              <option value="26">26 Unidades</option>
              <option value="27">27 Unidades</option>
              <option value="28">28 Unidades</option>
              <option value="29">29 Unidades</option>
              <option value="30">30 Unidades</option>
            </select>
            <br>
            <button type="submit" class="btn btn-info btn-lg"><i class="glyphicon glyphicon-shopping-cart"></i> &nbsp;Agregar a Carrito</button>
        </form>
        <hr>

    </div>
    </table>
          </div>
            </div>
          
            <br>
      <div class="col-md-12 col-sm-12 col-xs-12">
      <hr>
       <br>
       <br> 
        <h3>Descripcion del Producto</h3>
       <br>
       <?=$key->descripcion?>
         
          <?php endforeach ?>
      <?php endif ?>
      <br>
      <br>
      <br>
      </div>
       
  				</div>
	    	</div>
		  </div>
    </div>
  </div>
  <br>
    </section>