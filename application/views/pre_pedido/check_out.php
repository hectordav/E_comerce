<div class="cart-items">
	<div class="container">
			 <h3 align="left">Mi Pedido:</h3>
				 <?php if ($det_pre_pedido): ?>
				 	<?php foreach ($det_pre_pedido as $key): ?>
						 		<?php if ($pre_pedido): ?>
									<?php foreach ($pre_pedido as $key_2): ?>
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
					 <div align="right"><a href="<?=$this->config->base_url()?>pre_pedido/borrar_producto/<?=$key->id_det_pedido?>/<?=$key_2->id?>" class="btn btn-danger" title=""><i class="glyphicon glyphicon-trash"></i>&nbsp;Borrar</a></div>						
				  </div>
								  <?php endforeach ?>
							<?php endif ?>
				 	<?php endforeach ?>
				 <?php endif ?>

			 </div>
			 <hr>
			 <?php if ($pre_pedido): ?>
				<?php foreach ($pre_pedido as $key): ?>
			<div align="right">
				<label><h2><strong>Total:&nbsp;</strong><?=$key->total?>&nbsp;</h2></label>
			</div>
		<hr>
	<div  class="col-md-12 col-sm-12 col-xs-12" align="center">
	<div class="col-md-4 col-sm-4 col-xs-4">
			
	</div>

<div class="col-md-4 col-sm-4 col-xs-4">
				<form action="<?=$this->config->base_url()?>pre_pedido/terminos_condiciones/<?=$key->id?>" method="post">
				<button type="submit" class="btn btn-default"><a href="<?=$this->config->base_url()?>pre_pedido/terminos_condiciones/<?=$key->id?>" title=""><img src="<?= $this->config->base_url();?>assets/img/paga_con_visa.png" width="150" height="50"></a></button>
				<br>
				</form>
</div>
<div class="col-md-4 col-sm-4 col-xs-4">

</div>
</div>
				<br>
				<p></p>

				<?php endforeach ?>
			<?php endif ?>
		
			</div>
		 </div>
		</div>
