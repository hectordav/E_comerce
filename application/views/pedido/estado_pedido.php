
<div class="cart-items">
	<div class="container">
 <div class="animated bounceInDown" align="left">
  <?= validation_errors('<div class="alert alert-danger">','</div> ')?>
    </div> 
	<?php if ($pedido): ?>
		<?php foreach ($pedido as $key): ?>
			<?php if ($key->estado_pedido=="Recibido x la Empresa"): ?>
	<label><h3>Estado de Pedido</h3></label>
	
	<div class="btn-group btn-group-justified" role="group" aria-label="...">
  <div class="btn-group" role="group">
    <button type="button" class="btn btn-primary" disabled="true" >Recibido</button>
  </div>
  <div class="btn-group" role="group">
    <button type="button" class="btn btn-default" disabled="true">Procesado</button>
  </div>
  <div class="btn-group" role="group">
    <button type="button" class="btn btn-default" disabled="true">Enviado</button>
  </div>
</div>
			<?php endif ?>
				<?php if ($key->estado_pedido=="Procesado"): ?>
	<label><h3>Estado de Pedido</h3></label>
	
	<div class="btn-group btn-group-justified" role="group" aria-label="...">
  <div class="btn-group" role="group">
    <button type="button" class="btn btn-default" disabled="true" >Recibido</button>
  </div>
  <div class="btn-group" role="group">
    <button type="button" class="btn btn-primary" disabled="true">Procesado</button>
  </div>
  <div class="btn-group" role="group">
    <button type="button" class="btn btn-default" disabled="true">Enviado</button>
  </div>
</div>
			<?php endif ?>
		<?php if ($key->estado_pedido=="Enviado"): ?>
	<label><h3>Estado de Pedido</h3></label>
	
	<div class="btn-group btn-group-justified" role="group" aria-label="...">
  <div class="btn-group" role="group">
    <button type="button" class="btn btn-default" disabled="true" >Recibido</button>
  </div>
  <div class="btn-group" role="group">
    <button type="button" class="btn btn-default" disabled="true">Procesado</button>
  </div>
  <div class="btn-group" role="group">
    <button type="button" class="btn btn-primary" disabled="true">Enviado</button>
  </div>
</div>
			<?php endif ?>
		<?php endforeach ?>
	<?php endif ?>
	<hr>
			 <h3 align="left">Mi Pedido:</h3>
<?php if ($pedido): ?>
	<?php foreach ($pedido as $key): ?>
		<div align="right">
			<label># Factura</label>
			<?=$key->num_fact?>
		</div>
		<div align="right">
		<?$fecha=date('d-m-Y',strtotime($key->fecha_pedido))?>
			<label>Fecha</label> <?=$fecha?>
		</div>
		<div align="left">
			<label>Direccion de Envio:</label>
			<?=$key->direccion_envio?>
		</div>
		<hr>
		
	<?php endforeach ?>
<?php endif ?>
				 <?php if ($det_pedido): ?>
				 	<?php foreach ($det_pedido as $key): ?>
						 		<?php if ($pedido): ?>
	<div align="left">
		<label><h3>Detalle de Pedido</h3></label>
	</div>
									<?php foreach ($pedido as $key_2): ?>
				<div class="cart-header">
				 <div class="cart-sec simpleCart_shelfItem">		
					<div class="cart-item cyc">
							 <img src="<?=$this->config->base_url()?>assets/img/<?=$key->adjunto_1?>" class="img-responsive" alt="">
					</div>
					   <div class="cart-item-info">
					<h2><?=$key->nombre?></h2>	<h3><span><?=$key->descripcion?></span></h3>
						<ul class="qty">
							<li><p>Cantidad: <?=$key->cantidad_det_pedido?></p></li>
						</ul>
						<ul class="qty">
							<li><p>Talla: <?=$key->descripcion_talla?></p></li>
						</ul>
						<ul class="qty">
							<li><p>Color: <?=$key->descripcion_color?></p></li>
						</ul>
							 <div class="delivery" align="right">
							 <p><h3>Precio: <?=$key->total_det_pedido?></h3></p>
						
							 <div class="clearfix"></div>
				        </div>	
					   </div>
					   <div class="clearfix"></div>	
				  </div>
								  <?php endforeach ?>
							<?php endif ?>
				 	<?php endforeach ?>
				 <?php endif ?>

			 </div>
			 <hr>
			 <?php if ($pedido): ?>
				<?php foreach ($pedido as $key): ?>
<form class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>pedido/guardar_cambiar_estado" method="POST"  enctype="multipart/form-data">
            <div class="account-top" align="center">
			<div align="right">
			<input type="hidden" name="txt_id_pedido" value="<?=$key->id_pedido?>">
			<?php if ($tipo_moneda): ?>
					<?php foreach ($tipo_moneda as $key2): ?>
										
				<label><h2><strong>Total:&nbsp;</strong><?=$key->total_fact?>&nbsp;<?=$key2->simbolo?></h2></label>
					<?php endforeach ?>				
			<?php endif ?>
			</div>
		<hr>
			<div align="left">
		<p></p>

			<div align="left">
			<p></p>
<div class="form-group">
              <label>Nuevo Estado</label>
                 <select class="form-control" name="id_estado_pedido" id="id_estado_pedido" data-show-subtext="true" data-live-search="true"  required="required">
                    <option value="">Seleccione Estado de Pedido</option>
                     <?php
                     if ($estado_pedido) {
                     foreach ($estado_pedido as $i) {
                             echo '<option value="'. $i->id .'">'.$i->descripcion.'</option>';
                            }
                     }else{
                     }
                        ?>
              </select>
  </div>
 <div class="form-group">
		<label><h3>Observaciones de la Empresa</h3></label>
		<textarea name="txt_observaciones" class="form-control" rows="6"><?=$key->observaciones_pedido?></textarea>
				<?php endforeach ?>
			<?php endif ?>
			</div>
	
			 <div class="form-group" align="center">
          <button type="submit" class="btn btn-lg btn-success"><i class="fa fa-save"></i>&nbsp;Guardar</button>
          <a href="<?=$this->config->base_url()?>pedido" title="" class="btn btn-warning btn-lg"><i class="fa fa-exclamation-triangle"></i>&nbsp;Volver</a>
            </div>
			</div>
		 </div>
		</div>
		<br>
		<br>
		<br>
		<br>
		<br>
