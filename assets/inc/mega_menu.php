		<ul class="megamenu skyblue" id="rcorners1" style="color: #FFFFFF">
			<li class="active grid"><a class="color1 sin_raya" href="<?=$this->config->base_url()?>pagina_principal">Home</a></li>
			<?php if ($genero): ?>
				<?php foreach ($genero as $key): ?>
			<li class="grid"><a class="color1" href="#"><?=$key->descripcion?></a>
				<div class="megapanel">
					<div class="row">
					<?php if ($key->descripcion=="Masculino"): ?>
								<?php if ($categoria1): ?>
								<?php foreach ($categoria1 as $key2): ?>
								<div class="col1">
							<div class="h_nav">
								<a class=" sin_raya " href="<?=$this->config->base_url()?>pagina_principal/categoria/<?= $key2->id?>" title=""><h4><?= $key2->descripcion?></h4></a>
								</div>
							</div>
							<?php endforeach ?>
							<?php endif ?>
						<?php else: ?>
					<?php if ($categoria2): ?>
						<?php foreach ($categoria2 as $key2): ?>	
							<div class="col1">
							<div class="h_nav">
									<a class="sin_raya" href="<?=$this->config->base_url()?>pagina_principal/categoria/<?= $key2->id?>" title=""><h4><?= $key2->descripcion?></h4></a>
							</div>
						</div>			
							<?php endforeach ?>
							<?php endif ?>
						<?php endif ?>
				</li>
					<?php endforeach ?>
			<?php endif ?>
				<!-- ************ -->		
		 </ul> 
	</div>
</div>
</div>
</nav>