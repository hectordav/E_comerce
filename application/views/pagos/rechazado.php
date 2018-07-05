<div class="cart-items">
	<div class="container">
			 <h3 align="left">Error en el Pago:</h3>
			<label>existe un error en su pago, puede intentar realizar el pedido eligiendo otro sistema de pago o contactar con nosotros</label>
			
			  <?php if ($num_pedido): ?>
			  	<br>
			<div>
				<label># pedido &nbsp;<?=$num_pedido?></label>
			</div>
			 <?php endif ?>
			 <?php if ($error_code): ?>
			 <div>
			 		<label><?=$error_code?> &nbsp; <?=$error_message?></label>
			 </div>
			 <?php endif ?>
			 <?php if ($fecha_hora_pedido): ?>
			  <div>
			  	<label>Fecha/Hora: <?=$fecha_hora_pedido?></label>
			  </div>
			 <?php endif ?>
		
			 <div align="center"><br>
			 	<a href="<?=$this->config->base_url()?>pagina_principal" class="btn btn-success btn-lg" title="">Aceptar</a>
			 </div>
			</div>
		 </div>
		</div>
