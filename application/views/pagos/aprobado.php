<div class="cart-items">
	<div class="container">
			 <h3 align="left">Pedido Aprobado:</h3>
			
			  <?php if ($num_pedido): ?>
			  	<br>
			<div>
				<label># pedido &nbsp;<?=$num_pedido?></label>
			</div>
			 <?php endif ?>
			 <?php if ($nombre_tarjeta): ?>
			 <div>
			 		<label>Nombre del tarjetaHabiente &nbsp;<?=$nombre_tarjeta?></label>
			 </div>
			 <?php endif ?>
			 <?php if ($num_tarjeta): ?>
			  <div>
			  	<label>Tarjeta num: <?=$num_tarjeta?></label>
			  </div>
			 <?php endif ?>
			 <?php if ($fecha_hora): ?>
			<div>
					<label>Fecha/hora: <?=$fecha_hora?></label>
			</div>
			 <?php endif ?>
			 <?php if ($moneda): ?>
				<div>
					<label>Moneda: Nuevo &nbsp;<?=$moneda?></label>
				</div>
				
			 <?php endif ?>
			  <?php if ($total_p): ?>
				<div>
					<label>Importe: &nbsp;<?=$total_p?></label>
				</div>
			 <?php endif ?>
			 <br>
				 <?php if ($det_pedido): ?>
				 	<?php foreach ($det_pedido as $key): ?>
						 	
				<div class="cart-header">
				 <div class="cart-sec simpleCart_shelfItem">		
					<div class="cart-item cyc">
					</div>
					   
					<div>
						<h4><?=$key->nombre?></h4>
					</div>
					<div>
						<h4><span><?=$key->descripcion?></span></h4>
					</div>
						<ul class="qty">
							<p>Cantidad: <?=$key->cantidad_det_pedido?></p>
						</ul>
						<p>Talla: <?=$key->descripcion_talla?></p>
						<p>Color: <?=$key->descripcion_color?></p>
						<p><h4>Precio: <?=$key->total_det_pedido?></h4></p>						
				  </div>
				 	<?php endforeach ?>
				 <?php endif ?>
			 </div>
			 <hr>
			<a class="sin_raya" href="<=$this->$this->config->base_url()?>pagina_principal/pol_ter_con" title="">Terminos y condiciones</a>
			<br>

			 <label>Nota: Debe imprimir y guardar el recibo de transaccion para sus archivos</label>
			 <div align="right">
			 	<a href="<?=$this->config->base_url()?>pagina_principal" class="btn btn-success btn-lg" title="">Aceptar</a>
			 </div>
			</div>
		 </div>
		</div>
