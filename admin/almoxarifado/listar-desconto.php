<?php
	include("../config.php");
	include("../validar_session.php");
	getData();
	getNivel();

if(@$ac=='del') { 
	mysql_query("delete from notas_equipamentos_descontos where id = $id"); 
} 
if(@$ac=='add') { 
	$sql = mysql_query("INSERT INTO notas_equipamentos_descontos (`obs`,`valor`,`data_ref`, `tipo`, `equipamento`) VALUES ('$obs','$valor','$data', '$tipo', '$id')");
	if($sql) { 
		echo '<script>ldy("almoxarifado/listar-desconto.php?id='.$id.'",".listar-desconto")</script>'; 
	}else{
		echo 'Algo aconteceu de errado , atualize a pagina e tente novamente!!';
	}	
	exit;
} 

// LISTAR DESCONTO 
echo '<table class="table table-condensed table-striped table-bordered table-green" style="font-size:11px">';
	echo '<thead><tr><th>Descrição</th><th>Valor</th><th>Data</th><th>Tipo</th><th style="text-align:center" class="hidden-print">Excluir</th></tr></thead><tbody>';
	$sqlH = mysql_query("SELECT * FROM notas_equipamentos_descontos WHERE equipamento = '$id'"); 
	while($h = mysql_fetch_array($sqlH)) {
		echo '<tr>';
		echo '<td width="40%">'.$h['obs'].'</td>';
		echo '<td width="15%">'.$h['valor'].'</td>';
		echo '<td width="15%">'.implode("/",array_reverse(explode("-",$h['data_ref']))).'</td>';
		if($h['tipo'] == '1'){
			echo '<td width="15%">RESSARCIMENTO</td>';
		}else{
			echo '<td width="15%">DESCONTO</td>';
		}
		echo '<td width="15%" class="hidden-print" style="text-align:center">';
		if($acesso_login == 'MASTER' || $acesso_login == 'MODERADOR' || $acesso_login == 'EQUIPAMENTO'){
			echo '<a href="#" onclick=\'$(".listar-desconto").load("almoxarifado/listar-desconto.php?ac=del&id='.$h['id'].'")\' class="btn btn-xs btn-danger" style="margin:0px; padding:0px 5px; font-weight:bold;"><span class="glyphicon glyphicon-trash"></span></a>';
		}
		echo '</td>';
		echo '</tr>';
	}
	echo '</tbody></table>';
