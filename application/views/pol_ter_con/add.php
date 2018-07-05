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
	<label>Politicas Terminos y Condiciones</label>
	<hr>
	<form action="<?=$this->config->base_url()?>pol_ter_con/guardar_pol_ter_con" method="post" accept-charset="utf-8">
		<textarea name="txt_descripcion">Describe las Politicas Terminos y Condiciones</textarea>
	<div align="right">
		<button class="btn btn-success">Guardar</button>
	</form>
	</div>
	
	</div>

</div>