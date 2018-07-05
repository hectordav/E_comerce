		 <!--start-content-->
		 <!--start-banner-->
		    <div class="banner">
			    <div class="container">
				   <div class="banner-grids">
				   <?php if ($banner): 
				   $i=0;
				   ?>	
    						<?php foreach ($banner as $key): ?>
								    <div class="col-md-3" align="center">
										   <div class="x_panel">
										     <a href="<?=$this->config->base_url()?>pagina_principal/ver_articulo/<?=$key->id_producto?>" title="">
										     	<img src="<?=$this->config->base_url()?>assets/img/<?=$key->adjunto_1?>" class="img-responsive" alt="">
										     </a>
										   <h3 class="b-tittle"><?=$key->descripcion_categoria?></h3>
											 <a class="collection sin_raya" href="<?=$this->config->base_url()?>pagina_principal/categoria/<?=$key->id_categoria?>"></a>
										   </div>
									   </div>		 
					<?php endforeach ?>
				   <?php endif ?>
					    </div>						   
						   <div class="clearfix"> </div>
				   </div>
				</div>
			</div>