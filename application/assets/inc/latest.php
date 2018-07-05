    <!--//fashion-->
	    <!--/start-latest-->
		<div class="collection-section">
		 <div class="container"> 

		     <h3 class="tittle fea">Coleccion Destacada</h3>
				
		   <div class="fashion-info">
				<?php if ($coleccion): ?>
					<?$b=0;?>
					<?php foreach ($coleccion as $key): ?>
					<?php if ($b==0): ?>
							<div class="col-md-4 fashion-grids">
					<figure class="effect-bubba">
						<img src="<?=$this->config->base_url()?>assets/img/<?=$key->adjunto_1?>" alt=""/>
						<figcaption>
							<h4><?=$key->nombre?></h4>
							<p class="cart"><a href="single.html">Shop</a></p>				
						</figcaption>			
					</figure>		
				</div>
						<?php endif ?>
						<?php if ($b==1): ?>
									<div class="col-md-4 fashion-grids">
					<figure class="effect-bubba">
						<img src="<?=$this->config->base_url()?>assets/img/<?=$key->adjunto_1?>" alt=""/>
						<figcaption>
							<h4><?=$key->nombre?></h4>
								<p class="cart"><a href="single.html">Shop</a></p>				
						</figcaption>			
					</figure>		
				</div>
							<?php endif ?>
							<?php if ($b==2): ?>
							<div class="col-md-4 fashion-grids">
					<figure class="effect-bubba">
						<img src="<?=$this->config->base_url()?>assets/img/<?=$key->adjunto_1?>" alt=""/>
						<figcaption>
							<h4><?=$key->nombre?></h4>
							<p class="cart"><a href="single.html">Shop</a></p>							
						</figcaption>			
					</figure>		
				</div>	
							<?php endif ?>
							<?$b++;?>	
					<?php endforeach ?>
				<?php endif ?>
	
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
       <!--//latest-->