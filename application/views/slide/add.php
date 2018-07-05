<div class="container">
<br>
  <div class="row">
  <ul class="nav nav-tabs">
  <li role="presentation"><a href="<?=$this->config->base_url()?>pedido">Pedidos</a></li>
  <li role="presentation"><a href="<?=$this->config->base_url()?>cliente/grilla">Clientes</a></li>
  <li role="presentation"><a href="<?=$this->config->base_url()?>producto">Productos</a></li>
  <li role="presentation"><a href="<?= $this->config->base_url()?>inventario_producto">Inventario</a></li>
  <li role="presentation" class="active"><a href="<?=$this->config->base_url()?>principal/config_inicial">Config Inicial</a></li>
   <li role="presentation"><a href="<?=$this->config->base_url()?>principal/config_general">Config General</a></li>
</ul>
  </div>
</div>
<br><br>
<br>

<div class="container">
	<div class="row">
	<label>La imagen debe tener 197x68, fondo transparente y de ser posible color gris(usualmente se colocan logos)</label>
	<hr>
	<form action="<?=$this->config->base_url()?>slide/guardar_slide" method="post" accept-charset="utf-8" enctype="multipart/form-data">
		  <div class="form-group">
          <label>Adjunto 1</label>
          <input type="file" name="mi_archivo_1"> 
      </div>
	<div align="right">
		<button class="btn btn-success">Guardar</button>
	</form>
	</div>
	
	</div>

</div>