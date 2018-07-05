<div align="center">
<div class="col-md-6 col-md-offset-3" align="center" style="padding: 10px;">
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
          <form class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>login/iniciar_sesion" method="POST"  enctype="multipart/form-data">
            <div class="account-top" align="center">
              <h3>Usuarios Registrados</h3>
            </div>
            <div class="address" align="left">
              <span>Email</span>
              <input type="email" class="form-control" name="txt_login" value="<?= set_value("txt_login")?>" required >
            </div>
            <div class="address" align="left">
              <span>Password</span>
              <input type="password" class="form-control" name="txt_password" value="<?= set_value("txt_password")?>" required >
            </div>
            <input type="submit" class="form-control btn-success" value="Login">
            <div class="address" align="right">
              <a class="forgot" href="<?=$this->config->base_url()?>login/olvido_password">Olvidó Su Password?</a>
             
            </div>
            <div class="address" align="right">
                No tiene Cuenta?&nbsp;<a href="<?=$this->config->base_url()?>login/registro_usuario" class="btn btn-default">Registresese</a>
            </div>
           </form>
            </div>
</div>
