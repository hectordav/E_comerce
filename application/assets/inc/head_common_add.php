<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php
    foreach($css_files as $file): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
    <?php endforeach; ?>
    <title>Scrolling Nav - Start Bootstrap Template</title>

    <link href="<?= $this->config->base_url();?>assets/css/animate.min.css" rel="stylesheet">
    <link href="<?=$this->config->base_url()?>assets/css/menu_rosado.css" rel="stylesheet">
    <script src="<?= $this->config->base_url();?>/assets/js/portada/jquery-1.11.1.min.js"></script>
    <link href="<?= $this->config->base_url();?>/assets/css/portada/style.css" rel='stylesheet' type='text/css' />
     <link href="<?= $this->config->base_url();?>/assets/css/portada/megamenu.css" rel="stylesheet" type="text/css" media="all" />
     <script type="text/javascript" src="<?= $this->config->base_url();?>/assets/js/portada/megamenu.js"></script>
   <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,300italic,600,700' rel='stylesheet' type='text/css'>
     <!--  <script>$(document).ready(function(){$(".megamenu").megamenu();});</script> -->
    <script src="<?= $this->config->base_url();?>/assets/js/portada/menu_jquery.js"></script>
    <script src="<?= $this->config->base_url();?>/assets/js/portada/simpleCart.min.js"> </script>
 <link href='//fonts.googleapis.com/css?family=Roboto+Slab:300,400,700' rel='stylesheet' type='text/css'>
    <script src="<?php echo $this->config->base_url();?>assets/js/jquery-1.9.1.js" type="text/javascript"></script>
     <script src="<?= $this->config->base_url();?>assets/js/bootstrap.min.js"></script>
    
    <link href="<?=$this->config->base_url()?>assets/css/scrolling-nav.css" rel="stylesheet">
    <link href="<?=$this->config->base_url()?>assets/css/menu_rosado.css" rel="stylesheet">
 <style>
        .product-image img {
    width: 547px;
    height: 333px;
}
.product_gallery a {
    width: 100px;
    height: 100px;
    float: left;
    margin: 10px;
    border: 1px solid #e5e5e5;
}

.product_gallery a img {
    width: 100%;
    margin-top: 15px;
}
.x_content {
    padding: 0 5px 6px;
    position: relative;
    width: 100%;
    float: left;
    clear: both;
    margin-top: 5px;
}
    </style>
</head>
