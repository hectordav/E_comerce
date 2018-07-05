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
    <title>Encurvas</title>
  <script src="//cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
    <link href="<?= $this->config->base_url();?>assets/css/animate.min.css" rel="stylesheet">
    <link href="<?=$this->config->base_url()?>assets/css/scrolling-nav.css" rel="stylesheet">
    <link href="<?=$this->config->base_url()?>assets/css/menu_rosado.css" rel="stylesheet">
   <script src="<?= $this->config->base_url();?>/assets/js/portada/jquery-1.11.1.min.js"></script>
   <link href="<?= $this->config->base_url();?>/assets/css/portada/style.css" rel='stylesheet' type='text/css' />
   <link href="<?= $this->config->base_url();?>/assets/css/portada/megamenu.css" rel="stylesheet" type="text/css" media="all" />
   <script type="text/javascript" src="<?= $this->config->base_url();?>/assets/js/portada/megamenu.js"></script>
   <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,300italic,600,700' rel='stylesheet' type='text/css'>
   <script>$(document).ready(function(){$(".megamenu").megamenu();});</script>
<script src="<?= $this->config->base_url();?>/assets/js/portada/menu_jquery.js"></script>
<script src="<?= $this->config->base_url();?>/assets/js/portada/simpleCart.min.js"> </script>
 <link href='//fonts.googleapis.com/css?family=Roboto+Slab:300,400,700' rel='stylesheet' type='text/css'>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
<!--    <link href="<?=$this->config->base_url()?>assets/css/custom.css" rel="stylesheet"> -->
<!--   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
 
</head>
<style>
  a.sin_raya{
     text-decoration:none;
  .tile-stats {
    position: relative;
    display: block;
    margin-bottom: 12px;
    border: 1px solid #E4E4E4;
    -webkit-border-radius: 5px;
    overflow: hidden;
    padding-bottom: 5px;
    -webkit-background-clip: padding-box;
    -moz-border-radius: 5px;
    -moz-background-clip: padding;
    border-radius: 5px;
    background-clip: padding-box;
    background: #FFF;
    -moz-transition: all 300ms ease-in-out;
    -o-transition: all 300ms ease-in-out;
    -webkit-transition: all 300ms ease-in-out;
    transition: all 300ms ease-in-out;
}
}
.info-box {
  display: block;
  min-height: 90px;
  background: #fff;
  width: 100%;
  box-shadow: 0 1px 1px rgba(0, 0, 0, 2);
  border-radius: 2px;
  margin-bottom: 15px;
}
.info-box small {
  font-size: 14px;
}
.info-box .progress {
  background: rgba(0, 0, 0, 0.2);
  margin: 5px -10px 5px -10px;
  height: 2px;
}
.info-box .progress,
.info-box .progress .progress-bar {
  border-radius: 0;
}
.info-box .progress .progress-bar {
  background: #fff;
}
.info-box-icon {
  border-top-left-radius: 2px;
  border-top-right-radius: 0;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 2px;
  display: block;
  float: left;
  height: 90px;
  width: 90px;
  text-align: center;
  font-size: 45px;
  line-height: 90px;
  background: rgba(0, 0, 0, 0.2);
}
.info-box-icon > img {
  max-width: 100%;
}
.info-box-content {
  padding: 5px 10px;
  margin-left: 90px;
}
.info-box-number {
  display: block;
  font-weight: bold;
  font-size: 18px;
}
.progress-description,
.info-box-text {
  display: block;
  font-size: 14px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.info-box-text {
  text-transform: uppercase;
}
.info-box-more {
  display: block;
}
.bg-aqua {
  background-color: #0073b7 !important;
}
.bg-red {
  background-color: #DD4B39 !important;
}
.bg-yellow {
  background-color: #F39C12 !important;
}
.bg-yellow {
  background-color: #F39C12 !important;
}
.bg-verde {
  background-color: #00A65A !important;
}
.fa1{
  color: #fff;
    text-shadow: 1px 1px 1px #ccc;
}
</style>

