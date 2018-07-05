<div class="container">
	<div class="row">
	<div align="center">
		<label><h2><strong>Politicas terminos y condiciones</strong></h2></label>
	</div>
		<?php if ($pol_ter_con): ?>
	<?php foreach ($pol_ter_con as $key): ?>
		<?=$key->descripcion?>
	<?php endforeach ?>
<?php endif ?>
	</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<div align="center">

	<?php
srand (time());
//generamos un número aleatorio
    $numero_aleatorio = rand(1,1500);
if ($pre_pedido) {
	foreach ($pre_pedido as $key) {
	$numorden= $key->id;
	$amount=$key->total;
	}
}
$evmt="dev";
$url=$this->config->base_url()."pagos_tarjeta/visanet/".$evmt."/".$sessionToken;
	$formulario="
	<form action=\"$url\" method='post'>
		<script src=\"https://static-content.vnforapps.com/v1/js/checkout.js\"
			data-sessiontoken=\"$sessionToken\"
			data-merchantid=\"$merchantid\"
			data-buttonsize=\"\"
			data-buttoncolor=\"\" 
			data-merchantlogo =\"http://encurvas.com/assets/img/logo.png\"
			data-merchantname=\"\"
			data-formbuttoncolor=\"#0A0A2A\"
			data-showamount=\"\"
			data-purchasenumber=\"$numorden\"
			data-amount=\"$amount\"
			data-cardholdername=\"\"
			data-cardholderlastname=\"\"
			data-cardholderemail=\"\"
			data-usertoken=\"\"
			data-recurrence=\"false\"
			data-frequency=\"Quarterly\"
			data-recurrencetype=\"fixed\"
			data-recurrenceamount=\"200\"
			data-documenttype=\"0\"
			data-documentid=\"\"
			data-beneficiaryid=\"\"
			data-productid=\"\"
			data-phone=\"\"
		/></script>
	</form>";
	echo $formulario;
?>
<br>
</div>