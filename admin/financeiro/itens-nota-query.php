<?php
	include("../config.php");
	include("../validar_session.php");
	getData();
	$valor = str_replace("R$ ", "", $valor);
	$valor = str_replace(".", "", $valor);
	$valor = str_replace(",", ".", $valor);
		if($tipo_nota == '1'){	
			$query = mysql_query("insert into notas_itens_add (nota, item, categoria, quantidade, valor, data_1, data_2) values ('$nota', '$item', '$categoria', '$quantidade', '$valor', '$data_1', '$data_2')");
		}else{
			$query = mysql_query("insert into notas_itens_add (nota, item, categoria, desconto, quantidade, valor) values ('$nota', '$item', '$categoria', '$desconto', '$quantidade', '$valor')");
		}
		if($query) {
			if($tipo_nota == '1'){
				echo '<script>$(".lista_itens").load("financeiro/itens-nota-lista-locacao.php?id='.$nota.'"); </script>';
			}else{
				echo '<script>$(".lista_itens").load("financeiro/itens-nota-lista.php?id='.$nota.'"); </script>';
			}
		}
?>
