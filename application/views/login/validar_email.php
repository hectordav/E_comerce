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
          <form class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>login/guardar_reg_usuario" method="POST"  enctype="multipart/form-data">
            <div class="account-top" align="center">
              <h3>Se ha enviado un Email Para Activar su Cuenta</h3>
            </div>
           <br>
           <br>
           <br>
            <a href="<?=$this->config->base_url()?>pagina_principal/home" class="btn btn-success" title="">Menu Principal</a>
           </form>
            </div>
</div>
