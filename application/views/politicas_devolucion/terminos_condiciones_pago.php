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
<?php
if ($pre_pedido) {
	foreach ($pre_pedido as $key) {
	$numorden=15;     /*$key->id*/
	$amount=$key->total;
	}
}
$sessionToken = getGUID();
guarda_sessionToken($sessionToken);
$sessionToken = recupera_sessionToken();
$merchantid = "148009103";
$AccessKey="AKIAIV7F7AJDQBDGC6LA";
$SAK="S/WFmlxxpTqpNZRDUsLIT3FTP2Bw5/tfgV61xVII";
$evmt="dev";
$amount="1";
$SecretAccessKey="7SCfuuGqbLyLOhesDJEYtRouAb769Cbv2j+v4S02"; 
$sessionKey = create_token($amount,"dev",	$merchantid,$AccessKey,$SecretAccessKey,$sessionToken);
		//guarda_sessionKey($sessionKey);
$sessionKey."<br>".$sessionToken."<br>".$merchantid;
	/*$url = "$this->config->base_url()/pre_pedido/terminos_condiciones";*/
guarda_sessionToken($sessionToken);
$url=$this->config->base_url()."pagos_tarjeta/algo/".$evmt."/".$sessionToken;
	$formulario="
	<form action=\"$url\" method='post'>
		<script src=\"https://static-content.vnforapps.com/v1/js/checkout.js?qa=true\"
			data-sessiontoken=\"$sessionToken\"
			data-merchantid=\"$merchantid\"
			data-buttonsize=\"\"
			data-buttoncolor=\"\" 
			data-merchantlogo =\"http://labceperu.com/test/files/logo.png\"
			data-merchantname=\"\"
			data-formbuttoncolor=\"#0A0A2A\"
			data-showamount=\"\"
			data-purchasenumber=\"$numorden\"
			data-amount=\"1\"
			data-cardholdername=\"GLEIZER\"
			data-cardholderlastname=\"PANDURO\"
			data-cardholderemail=\"gleizerp@gmail.com\"
			data-usertoken=\"\"
			data-recurrence=\"false\"
			data-frequency=\"Quarterly\"
			data-recurrencetype=\"fixed\"
			data-recurrenceamount=\"200\"
			data-documenttype=\"0\"
			data-documentid=\"\"
			data-beneficiaryid=\"TEST1123\"
			data-productid=\"\"
			data-phone=\"\"
		/></script>
	</form>";
	echo $formulario;
?>
