	<!--products-->
	
	<div class="products">
		<div class="container">
	
		<?php if ($nombre_categoria): ?>
			<?php foreach ($nombre_categoria as $key): ?>
				
		<h5>Categoria/<?=$key->descripcion?></h5>
			<hr>
			<?php endforeach ?>
		<?php endif ?>
	
			<div class="products-grids">
				<div class="col-md-12">
				<?php if ($producto_categoria): ?>
					<?$q=0;?>
					<?php foreach ($producto_categoria as $key): ?>
						<?php if ($q==0): ?>
					
						<?php endif ?>

							<div class="products-grd x_panel">
							<div class="simpleCart_shelfItem prd" align="center">
								<a href="single.html">
										<img src="<?=$this->config->base_url()?>assets/img/<?=$key->adjunto_1?>" alt="" class="img-responsive" style="width: 180px; height: 180px"/>
								</a>
								<h4></h4>
								<p><a class="item_add sin_raya" href="#"><i class="glyphicon glyphicon-shopping-cart"></i> <span class=" item_price valsa"><?=$key->nombre?></span></a></p>
								<div class="pro-grd">
									<a class="sin_raya" href="<?=$this->config->base_url()?>pagina_principal/ver_articulo/<?=$key->id_producto?>">Ver</a>
								</div>
							</div>	
						</div>
						<?$q++;?>
						<?php if ($q==3 ||$q==6 ||$q==9|| $q==12 ||$q==15 ||$q==18 || $q==21 || $q==24 || $q==27): ?>
								<div class="clearfix"></div>
					</div>
						<div class="products-grid-lft">
						<?php endif ?>
					<?php endforeach ?>
				<?php endif ?>
				
						<div class="clearfix"></div>
					</div>
					
					
				</div>

	<!-- <div class="col-md-4 products-grid-right">
					<div class="standars">	
						<section>
					<h3>Categorias<i class="glyphicon glyphicon-tag"></i></h3>
						<ul class="">
						<?php if ($categoria): ?>
							<?php foreach ($categoria as $key): ?>
								<li class="selector active" data-selector="1"><?=$key->descripcion?></li>
					
						<?php endforeach ?>
						<?php endif ?>
						</ul>
						</section>
					</div>
				</div> -->
				<div class="clearfix"></div>
			</div>
		</div>
	</div>