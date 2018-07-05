 <div class="container">
				<div class="recommand-section">
					<div class="recommand-section-head text-center">
						<h3 class="tittle fea">Productos Recomendados</h3>
					</div>
					<div class="recommand-section-grids">

						<div class="standards">
						<h5>Categorias<i class="glyphicon glyphicon-tag"></i></h5>
						<ul class="selectors_wrapper">
						<?php if ($categoria): ?>
							<?php foreach ($categoria as $key): ?>
								<li class="selector "><a class="sin_raya" href="<?=$this->config->base_url()?>pagina_principal/categoria/<?= $key->id?>" title=""><?=$key->descripcion?></li></a>
					
						<?php endforeach ?>
						<?php endif ?>
						</ul>
						<div class="standard_content">
							<div class="standard active" data-selector="1">
							<?php if ($producto_recomendado): ?>
								<?php foreach ($producto_recomendado as $key): ?>
									
							<div class="tag-grid x_panel">
								<div class="tag-wrapper">		
									<a href="<?=$this->config->base_url()?>pagina_principal/ver_articulo/<?=$key->id_producto?>"><img src="<?=$this->config->base_url()?>assets/img/<?=$key->adjunto_1?>" class="img-responsive"/></a>
									<div class="r-title">
										<h3><?=$key->nombre?></h3>
										
									</div>
								</div>
								<div class="atc"><a class="sin_raya" href="<?=$this->config->base_url()?>pagina_principal/ver_articulo/<?=$key->id_producto?>">Ver</a></div>
					       </div>
					   			<?php endforeach ?>
							<?php endif ?>

					
						<div class="clearfix"></div>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					</div>
				</div>
			</div>