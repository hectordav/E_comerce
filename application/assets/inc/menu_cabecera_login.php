<body>
<!--start-home-->
<div class="top_bg" id="home">
	<div class="container">
		<div class="header_top">
			<div class="top_right">
				<ul>
				 <ul>
           <li style="border-right: 0px solid #fff; */"><a class="sin_raya" href="<?=$this->config->base_url()?>pagina_principal/home"><h4>En Curvas</h4></a></li>
       </ul>
				</ul>
			</div>
			<div class="top_left">
				<a href="<?=$this->config->base_url()?>login/registro_usuario" title=""><h6><span></span>&nbsp;&nbsp;&nbsp;Registrese</h6></a>
			</div>
			<div class="top_left">
				<a href="<?=$this->config->base_url()?>login" title=""><h6><span></span>&nbsp;Inicia Sesion</h6></a>
			</div>
				<div class="clearfix"> </div>
		</div>
	</div>
</div>
<!--header-->

<div class="header_bg">
   <div class="container">
	<div class="header">
	  <div class="head-t">
	  <div class="col-md-3 col-sm-3 col-xs-12 col-md-offset-9">
	    <?$correcto =$this->session->flashdata('alerta');?> 
         <?php if ($correcto): ?>
	   	<div class="alert alert-info alert-dismissable animated bounceInDown">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  <i class="glyphicon glyphicon-shopping-cart"></i>&nbsp;&nbsp;<strong><?=$correcto?></strong>
			</div>
			 <?php endif ?>
			</div>
		 <div class="logo">
			 <a class="sin_raya " href="<?=$this->config->base_url()?>pagina_principal/home"><h1><img src="<?=$this->config->base_url()?>assets/img/logo.png" alt=""></h1> </a>
		  </div>
		  <div class="header_right">
			<div class="" align="right">
				<div class="clearfix"> </div>
			</div>				 
		</div>
		<div class="clearfix"></div>
	
	    </div>
	