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
          <form class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>login/cambiar_password_2" method="POST"  enctype="multipart/form-data">
          <?php if ($id_usuario): ?>
          
          <input type="hidden" name="txt_id_usuario" value="<?=$id_usuario?>">
         
          <?php endif ?>

              <div class="address" align="left">
              <span>Clave</span>
            <input type="password" class="form-control" name="txt_clave_1" value="<?= set_value("txt_clave_1")?>" required >
            </div>
            <div class="address" align="left">
              <span>Repita su Clave</span>
            <input type="password" class="form-control" name="txt_clave_2" value="<?= set_value("txt_clave_2")?>" required >
            </div>
            <br>
            <input type="submit" class="form-control btn-success" value="Cambiar Password">
           <br>
           <br>
           <br>
         
           </form>
            </div>
</div>
