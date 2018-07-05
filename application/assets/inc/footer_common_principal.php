<!--start-bottom-->
		   <!--start-image-cursuals-->
                  <div class="scroll-slider">
							<div class="nbs-flexisel-container"><div class="nbs-flexisel-inner"><ul class="flexiselDemo3 nbs-flexisel-ul" style="left: -253.6px; display: block;">		<?php if ($slide): ?>
								<?php foreach ($slide as $key): ?>
									<li  class="nbs-flexisel-item" style="width: 253.6px;"><img src="<?php echo $this->config->base_url();?>assets/img/<?=$key->adjunto?>" alt=""/></li>
								<?php endforeach ?>
							<?php endif ?>				    					       
							
					
							</ul><div class="nbs-flexisel-nav-left" style="top: 21.5px;"></div><div class="nbs-flexisel-nav-right" style="top: 21.5px;"></div></div></div> 
							<br>
							<div class="clearfix"> </div>      
						  <!--start-image-->
								<script type="text/javascript" src="<?= $this->config->base_url();?>/assets/js/portada/jquery.flexisel.js"></script>
								<!--//end-->
								<script type="text/javascript">
								$(window).load(function() {
								    $(".flexiselDemo3").flexisel({
								        visibleItems: 5,
								        animationSpeed: 1000,
								        autoPlay: true,
								        autoPlaySpeed: 3000,            
								        pauseOnHover: true,
								        enableResponsiveBreakpoints: true,
								        responsiveBreakpoints: { 
								            portrait: { 
								                changePoint:480,
								                visibleItems: 2
								            }, 
								            landscape: { 
								                changePoint:640,
								                visibleItems: 3
								            },
								            tablet: { 
								                changePoint:768,
								                visibleItems: 3
								            }
								        }
								    });
								});
								</script>
						<!---->
				 	
			</div>
			<br>
<div class="col-md-12 col-sm-12 col-xs-12" align="center">
				<a href="" title=""><img width="80" height="80" src="<?php echo $this->config->base_url();?>assets/img/facebook-1.png" alt=""/></a>
				<a href="" title=""><img width="80" height="80" src="<?php echo $this->config->base_url();?>assets/img/instagram_logo.png" alt=""/></a>
				<a href="" title=""><img width="80" height="80" src="<?php echo $this->config->base_url();?>assets/img/youtube_logo.png" alt=""/></a>
			</div>
</div>
<br>
<br>
<br>
<br>

 <!--//end-bottom-->
		<!--start-footer-->
		<div align="right">
	     <div class="footer" style="background-color: #333;">
		   <div class="container">
			<a class="sin_raya" style="color: #FFFFFF;" href="<?=$this->config->base_url()?>pagina_principal/quienes_somos">Quienes Somos &nbsp;</a>
			<a class="sin_raya" style="color: #FFFFFF;" href="<?=$this->config->base_url()?>pagina_principal/tiendas">Nuestras Tiendas &nbsp;</a>
			<a class="sin_raya" style="color: #FFFFFF;" href="<?=$this->config->base_url()?>pagina_principal/contactanos">Contactanos &nbsp;</a>	
				<a class="sin_raya" style="color: #FFFFFF;" href="<?=$this->config->base_url()?>pagina_principal/pol_ter_con">&nbsp;&nbsp;Politicas,Terminos y Condiciones &nbsp;</a>
				<a class="sin_raya" style="color: #FFFFFF;" href="<?=$this->config->base_url()?>pagina_principal/politicas_devolucion">&nbsp;&nbsp;Politicas de devolucion &nbsp;</a>

			</div>
	</div>
	</div>
	 <!--/start-copyright-->
	 <div class="copy">
		<div class="container">
			
		</div>
	</div>
	 <!--//end-copyright-->
	<!--end-footer-->
 <!--//end-content-->
    	<!--start-smooth-scrolling-->
						<script type="text/javascript">
									$(document).ready(function() {
										/*
										var defaults = {
								  			containerID: 'toTop', // fading element id
											containerHoverID: 'toTopHover', // fading element hover id
											scrollSpeed: 1200,
											easingType: 'linear' 
								 		};
										*/
										
										$().UItoTop({ easingType: 'easeOutQuart' });
										
									});
								</script>
		<a href="#home" id="toTop" class="scroll" style="display: block;"><img src="<?=$this->config->base_url()?>assets/img/move-top.png" class="img-responsive" alt="" /></a>
</body>
</html>