<!DOCTYPE HTML>
<html>
<head>
<title>Encurvas</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="E-comerce" />
<script type="applijegleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="<?= $this->config->base_url();?>/assets/css/portada/bootstrap.css" rel='stylesheet' type='text/css' />
  <link href="<?=$this->config->base_url()?>assets/css/animate.min.css" rel="stylesheet">
<!-- Custom Theme files -->
<link href="<?= $this->config->base_url();?>/assets/css/portada/style.css" rel='stylesheet' type='text/css' />	
<script src="<?= $this->config->base_url();?>/assets/js/portada/jquery-1.11.1.min.js"></script>

<!-- start menu -->
<link href="<?= $this->config->base_url();?>/assets/css/portada/megamenu.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="<?= $this->config->base_url();?>/assets/js/portada/megamenu.js"></script>
<script>$(document).ready(function(){$(".megamenu").megamenu();});</script>
<script src="<?= $this->config->base_url();?>/assets/js/portada/menu_jquery.js"></script>
<script src="<?= $this->config->base_url();?>/assets/js/portada/simpleCart.min.js"> </script>
<!-- <script src="//cloud.tinymce.com/stable/tinymce.min.js"></script> -->
<script>tinymce.init({ selector:'textarea' });</script>
<!--web-fonts-->
 <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,300italic,600,700' rel='stylesheet' type='text/css'>
 <link href='//fonts.googleapis.com/css?family=Roboto+Slab:300,400,700' rel='stylesheet' type='text/css'>
<!--//web-fonts-->
 <script src="<?= $this->config->base_url();?>/assets/js/portada/scripts.js" type="text/javascript"></script>
<!-- <script src="js/modernizr.custom.js"></script> -->
<script type="text/javascript" src="<?= $this->config->base_url();?>assets/js/portada/move-top.js"></script>
<script type="text/javascript" src="<?= $this->config->base_url();?>/assets/js/portada/easing.js"></script>
<!--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--/script-->
<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},900);
				});
			});
</script>
<style>
.product-image {
    width: 300px;
    height: 300px;
}
.product_gallery a {
    width: 80px;
    height: 80px;
    float: left;
    margin: 10px;
    border: 0px solid #e5e5e5;
    margin-top: 50px;
   text-align: center;
}

.x_content {
    padding: 5px 6px;
    position: relative;
    width: 100%;
    float: left;
    clear: both;
    margin-top: 5px;
}
img {
    width:auto;
    max-width:100%;
}
a.sin_raya{
     text-decoration:none;
     color:black;
}
.x_panel {
    position: relative;
    margin-bottom: 10px;
    padding: 10px 17px;
    /*display: inline;*/
    background: #fff;
    border: 1px solid #E6E9ED;
    box-shadow: 2px 2px 5px #999;
    -webkit-column-break-inside: avoid;
    -moz-column-break-inside: avoid;
    column-break-inside: avoid;
    opacity: 1;
    -moz-transition: all .2s ease;
    -o-transition: all .2s ease;
    -webkit-transition: all .2s ease;
    -ms-transition: all .2s ease;
    transition: all .2s ease;

}


    </style>
<style>
    #rcorners1 {
    border-radius: 10px;
    padding: 7px;  
}
</style>
</head>