<div class="container">
<br>
  <div class="row">
  <ul class="nav nav-tabs">
  <li role="presentation" ><a href="<?=$this->config->base_url()?>pedido">Pedidos</a></li>
  <li role="presentation"><a href="<?=$this->config->base_url()?>cliente/grilla">Clientes</a></li>
  <li role="presentation"><a href="<?=$this->config->base_url()?>producto">Productos</a></li>
  <li role="presentation" class="active"><a href="<?= $this->config->base_url()?>inventario_producto">Inventario</a></li>
  <li role="presentation"><a href="<?=$this->config->base_url()?>principal/config_inicial">Config Inicial</a></li>
   <li role="presentation"><a href="<?=$this->config->base_url()?>principal/config_general">Config General</a></li>
</ul>
  </div>
</div>
<section id="intro" class="intro-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
        <div class="animated bounceInDown" align="left">
      
  <?= validation_errors('<div class="alert alert-danger">','</div> ')?>
    </div> 
          <div class="animated fadeIn" align="left">
             <label><h3><strong>Restar Cantidad a Inventario</strong></h3></label>
             <hr>
        <form  role="form" action="<?php echo $this->config->base_url();?>inventario_producto/actualizar_cantidad" method="POST"  enctype="multipart/form-data">
            <div class="form-group">
             <?php if ($iva): ?>
                <?php foreach ($iva as $key): ?>
              <input type="hidden" name="txt_iva" id="txt_iva" value="<?=$key->descripcion?>">
              <?php endforeach ?>
              <?php endif ?>
              <label>Producto</label>
              <?php if ($producto): ?>
                <?php foreach ($producto as $key): ?>
                  <input type="text" class="form-control" name="" value="<?=$key->nombre?>" readonly>
                  <input type="hidden" name="txt_id_inventario" id="txt_id_inventario" value="<?=$key->id?>">
            </div>
               <div class="form-group">
              <label>Cantidad Anterior</label>
               <input type="text" name="txt_cantidad" id="txt_cantidad" class="form-control" value="<?=$key->cantidad?>" placeholder="Ingrese cantidad" readonly>
             
            </div>
            <div class="form-group">
              <label>Cantidad a Restar</label>
               <input type="number" name="txt_cantidad_1" id="txt_cantidad_1" onkeyup="fncRestarCantidad()" class="form-control" value="" placeholder="Ingrese Cantidad">
            </div>
               <div class="form-group">
              <label>Nueva Cantidad</label>
               <input type="text" name="txt_cantidad_2" id="txt_cantidad_2" class="form-control" value="<?= set_value("txt_cantidad_2")?>" readonly>
            </div>
              <?php endforeach ?>
              <?php endif ?>
            <hr>
            <div class="form-group" align="center">
              <button type="submit" class="btn btn-lg btn-success"><i class="fa fa-save"></i>&nbsp;Guardar</button>
              <a href="<?=$this->config->base_url()?>inventario_producto/grilla" title="" class="btn btn-warning btn-lg"><i class="fa fa-exclamation-triangle"></i>&nbsp;Volver</a>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
    </section>