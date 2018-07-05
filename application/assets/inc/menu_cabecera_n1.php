<body>
<!--start-home-->
<div class="top_bg" id="home">
  <div class="container">
    <div class="header_top">
      <div class="top_right">
       <ul>
         <li style="border-right: 0px solid #fff; */"><a class="sin_raya"href="<?=$this->config->base_url()?>pagina_principal/home"><h4>En Curvas</h4></a></li>
       </ul>
      </div>
      <div class="top_left">
        <a class="sin_raya" href="<?=$this->config->base_url()?>login/cerrar_sesion" title=""><h6><span></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CERRAR SESION &nbsp;</h6></a>
      </div>
      <div class="top_left">
        <a class="sin_raya" href="<?=$this->config->base_url()?>pedido/grilla"  title=""><h6><span></span>&nbsp;&nbsp;&nbsp;PEDIDOS</h6></a>
      </div>
       <div class="top_left">
        <a class="sin_raya" href="<?=$this->config->base_url()?>pedido/grilla"  title=""><h6><span></span>&nbsp;&nbsp;&nbsp;Panel de Control</h6></a>
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

        <a class="sin_raya img-responsive" href="<?=$this->config->base_url()?>pagina_principal/home"><h1><img src="<?=$this->config->base_url()?>assets/img/logo.png" alt=""></h1> </a>
      </div>
      
      <div class="header_right">
      
      <div class="" align="right">
        
        <div class="clearfix"> </div>
      </div>         
    </div>
    <div class="clearfix"></div>
  
      </div>
  