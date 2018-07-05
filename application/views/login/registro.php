<div align="center">
  
 
<div class="col-md-8 col-md-offset-2" align="center" style="padding: 10px;">
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
          <form class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>login/guardar_reg_usuario" method="POST"  enctype="multipart/form-data">
            <div class="account-top" align="center">
              <h3>Registro de Usuario</h3>
            </div>
            <div class="address" align="left">
              <span>DNI</span>
              <input  class="form-control" name="txt_dni" value="<?= set_value("txt_dni")?>" required >
            </div>
            <div class="address" align="left">
              <span>Nombre</span>
              <input class="form-control" name="txt_nombre" value="<?= set_value("txt_nombre")?>" required >
            </div>
          	<div class="address" align="left">
              <span>Direccion</span>
            	<textarea name="txt_direccion_1" class="form-control"><?= set_value("txt_direccion_1")?></textarea>
            </div>
            <div class="address" align="left">
              <span>Direccion de Envio</span>
            	<textarea name="txt_direccion_2" class="form-control"><?= set_value("txt_direccion_2")?></textarea>
            </div>
            <div class="address" align="left">
              <span>Telf</span>
            <input class="form-control" name="txt_telf" value="<?= set_value("txt_telf")?>" required >
            </div>
             <div class="address" align="left">
              <span>Login/Email</span>
            <input type="email" class="form-control" name="txt_login" value="<?= set_value("txt_login")?>" required >
            </div>
             <div class="address" align="left">
              <span>Clave</span>
            <input type="password" class="form-control" name="txt_clave_1" value="<?= set_value("txt_clave_1")?>" required >
            </div>
            <div class="address" align="left">
              <span>Repita su Clave</span>
            <input type="password" class="form-control" name="txt_clave_2" value="<?= set_value("txt_clave_2")?>" required >
            </div>
            <input type="submit" class="form-control btn-success" value="Registrese">
           
            <div class="address" align="right">
                Ya esta registrado?&nbsp;&nbsp;<a href="<?=$this->config->base_url()?>login"><button type="button" class="btn btn-default">Inicie sesion</button></a>
            </div>
           </form>
            </div>
</div>
