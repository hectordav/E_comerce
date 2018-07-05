<div align="center">
  
 
<div class="col-md-8 col-md-offset-2" align="center" style="padding: 100px;">
<div class="animated bounceInDown">
  <?$correcto =$this->session->flashdata('alerta');?> 
         <?php if ($correcto): ?>
         <div class="animated bounceInDown">
           <div class="alert alert-danger alert-dismissible">             
           <strong><?= $correcto?></strong>
            <br>
            </div>
        </div> <?php endif ?>
<!-- la parte de la validacion -->
<?= validation_errors('<div class="alert alert-danger ">','</div> ')?>
</div>
          <form class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>login/reset_password" method="POST"  enctype="multipart/form-data">
            <div class="address" align="left">
              <span>Login/Email</span>
            <input type="email" class="form-control" name="txt_login" value="<?= set_value("txt_login")?>" required >
            </div>
             <br>
            <input type="submit" class="form-control btn-success" value="Enviar">   
           <br>
           <br>
           <br>         
           </form>
            </div>
</div>
