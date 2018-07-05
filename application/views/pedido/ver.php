
<div class="cart-items">
	<div class="container">

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
		
			<div align="right">
			<?php if ($tipo_moneda): ?>
				<?php foreach ($tipo_moneda as $data_tm): ?>
				<label><h2><strong>Total:&nbsp;</strong><?=$key->total_fact?>&nbsp;<?=$data_tm->simbolo?></h2></label>
				<?php endforeach ?>
			<?php endif ?>
			</div>
		<hr>
			<div class=col-md-12 col-sm-12 col-xs-12 align="left">
	
		<p></p>
		<label><h3>Observaciones de la Empresa</h3></label>
		<textarea name="" class="form-control" readonly="true" rows="6"><?=$key->observaciones_pedido?></textarea>

				<?php endforeach ?>
			<?php endif ?>

			</div>
			<div align="right">
			<p></p>
				<a href="<?=$this->config->base_url()?>pedido/grilla" class="btn btn-warning btn-lg" title="">Volver a Pedidos</a>
			</div>
		 </div>
		</div>
		<br>
		<br>
		<br>
		<br>
		<br>
