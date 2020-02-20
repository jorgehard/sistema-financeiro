<?php
	include("../config.php");
	include("../validar_session.php");
	getData();
	getNivel();

	$pos = 0;

	foreach($lista as $idLista){
	   mysql_query("UPDATE rh_situacao SET ordem = '$pos' WHERE id = '$idLista'");
	   $pos++;
	}
?>