<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />
	<title>Test Nuevo Bot&oacute;n de Pago</title>
	<?php 
		include 'librerias/lib.inc';
		include 'librerias/funciones.php';
	?>
</head>
<body>
<?php
	if (isset($_POST['amount'])){
		$sessionToken = getGUID();
		echo $sessionToken."<hr>";
		$merchantid = MERCHANT;
		$amount = $_POST['amount'];
		$sessionKey = create_token($amount,"dev",MERCHANT,AccessKey,SecretAccessKey,$sessionToken);
		//guarda_sessionKey($sessionKey);
		echo $sessionKey."<br>".$sessionToken."<br>".$merchantid;
		$arrayPost = array("sessionToken"=>$sessionToken,"merchantId"=>MERCHANT,"amount"=>$amount);
		$url = "boton.php";
		guarda_sessionToken($sessionToken);
		$html = post_form($arrayPost,$url);
		echo $html;
		exit;
	}

?>
<form name="f1" action="index.php" method="post">
<input type="tel" class="button" name="amount" value="1.00">
<input type="submit" name="enviar" value="Crear bot&oacute;n">
</form>
</body>
</html>