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
		$merchantid = "148131802";
		$amount = $_POST['amount'];
		$sessionKey = create_token($amount,"dev",$merchantid,"AKIAJRWJQBFYLRVB22ZQ","fzi9pi12Gm+isyQtICGNzJfYVN6ZFcMOI5+uM0cN",$sessionToken);
		guarda_sessionKey($sessionKey);
		echo $sessionKey."<br>".$sessionToken."<br>".$merchantid;
		$arrayPost = array("sessionToken"=>$sessionToken,"merchantId"=>$merchantid,"amount"=>$amount);
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