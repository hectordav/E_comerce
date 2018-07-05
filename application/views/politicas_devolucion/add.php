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
	<label>Politicas de Devolucion</label>
	<hr>
	<form action="<?=$this->config->base_url()?>politicas_devolucion/guardar_politicas_devolucion" method="post" accept-charset="utf-8">
		<textarea name="txt_descripcion">Describe las Politicas de Devolucion</textarea>
	<div align="right">
		<button class="btn btn-success">Guardar</button>
	</form>
	</div>
	
	</div>

</div>