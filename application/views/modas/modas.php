<div class="container">
<br>
  <div class="row">
  <ul class="nav nav-tabs">
  <li role="presentation"><a href="<?=$this->config->base_url()?>pedido">Pedidos</a></li>
  <li role="presentation"><a href="<?=$this->config->base_url()?>cliente/grilla">Clientes</a></li>
  <li role="presentation"><a href="<?=$this->config->base_url()?>producto">Productos</a></li>
  <li role="presentation"><a href="<?= $this->config->base_url()?>inventario_producto">Inventario</a></li>
  <li role="presentation" class="active"><a href="<?=$this->config->base_url()?>principal/config_inicial">Config Inicial</a></li>
   <li role="presentation" ><a href="<?=$this->config->base_url()?>principal/config_general">Config General</a></li>
</ul>
    </div>
</div>
<section id="intro" class="intro-section">
        <div class="container">
            <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
         <?$correcto =$this->session->flashdata('alerta');?> 
         <?php if ($correcto): ?>
         <div class="animated bounceInDown">
           <div class="alert alert-info alert-dismissible">             
           <strong><?= $correcto?></strong>
            <br>
            </div>
        </div> <?php endif ?>
            <div class="x_panel">

                <div class="animated fadeIn" align="center">
                    <?php echo $output; ?>
                </div>
            </div>
        </div>
            </div>
        </div>
    </section>