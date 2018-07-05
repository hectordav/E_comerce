         <!--/start-fashion-->
		<div class="fashion-section">
		 <div class="container x_panel"> 
		     <h3 class="tittle">De Moda</h3>
					<?php if ($modas): ?>
						 <div class="fashion-info">
						<?php $a=0; ?>
						<?php foreach ($modas as $key): ?>
							<?php if ($a==0): ?>
							<div class="col-md-4 col-sm-4 col-xs-4 fashion-grids">
							<figure class="tag-grid">
								<img src="<?=$this->config->base_url()?>assets/img/<?=$key->adjunto_1?>" alt="" class="img-responsive" style="width: 375px; height: 273px"/>
								<figcaption >
									<!-- <h4><?= $key->nombre?></h4> -->
									<p class="atc sin_raya"><a href="<?=$this->config->base_url()?>pagina_principal/ver_articulo/<?=$key->id_producto?>">Ver</a></p>				
								</figcaption>			
							</figure>		
						</div>	
							<?php endif ?>
							<?php if ($a==1): ?>
							<div class="col-md-4 col-sm-4 col-xs-4 fashion-grids">
								<figure class="tag-grid">
									<img src="<?=$this->config->base_url()?>assets/img/<?=$key->adjunto_1?>" alt="" class="img-responsive" style="width: 375px; height: 273px"/>
									<figcaption>
										<!-- <h4><?= $key->nombre?></h4> -->
											<p class="atc"><a href="<?=$this->config->base_url()?>pagina_principal/ver_articulo/<?=$key->id_producto?>">Ver</a></p>				
									</figcaption>			
								</figure>		
							</div>
							
							<?php endif ?>
							<?php if ($a==2): ?>
							<div class="col-md-4 col-sm-4 col-xs-4 fashion-grids">
								<figure class="tag-grid">
									<img src="<?=$this->config->base_url()?>assets/img/<?=$key->adjunto_1?>" alt="" class="img-responsive" style="width: 375px; height: 273px"/>
									<figcaption>
										<!-- <h4><?= $key->nombre?></h4> -->
										<p class="atc"><a href="<?=$this->config->base_url()?>pagina_principal/ver_articulo/<?=$key->id_producto?>">Ver</a></p>							
									</figcaption>			
								</figure>		
							</div>
							<?php endif ?>
							<?$a++;?>
						<?php endforeach ?>
					<?php endif ?>
				
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	