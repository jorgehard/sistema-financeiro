<?php
	require_once("../config.php");
	require_once("../validar_session.php");
	getData();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<title> Litoral Rent</title>
	<link rel="icon" href="../../style/img/logo.ico" type="image/x-icon"/>
	<link rel="shortcut icon" href="../../style/img/imagens/logo.ico" type="image/x-icon"/>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"/>
	<link rel="stylesheet" href="../../style/css/bootstrap.min.css"/>
	<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'/>
	<link href='https://fonts.googleapis.com/css?family=Oswald:300' rel='stylesheet' type='text/css'/>
	<style>
		* {
			font-size: 13px;
		}
		table {
			width: 100%;
			margin: 0 0 10px 0;
		}
		table tr td, th {
			border-collapse:  collapse;
			border: 1px solid #000 !important;
			padding: 5px;
			font-size: 11px;
		}
		@page {
			size: A4;
		}
	</style>
</head>
<script>
window.onload = function() { 
	window.print(); 
}
</script>
<body>
<?php

$sql = mysql_query("SELECT * FROM empresa_cadastro WHERE id = '$id'");
while($xu = mysql_fetch_array($sql)){ extract($xu); }
?>
Ficha de Impressão em andamento
<?= $razao_social ?>
</body>
</html>