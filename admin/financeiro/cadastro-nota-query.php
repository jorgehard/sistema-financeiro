<?php 
	require_once("../config.php");
	require_once("../validar_session.php");
	getData();
	getNivel();
	
	$valor_vencimento = str_replace("R$ ", "", $valor_vencimento); 
	$valor_vencimento = str_replace(".", "", $valor_vencimento); 
	$valor_vencimento = str_replace(",", ".", $valor_vencimento);
	
	if($numero == ''){ 
		/*if($tipo_nota == '0'){*/
			$numero = rand(1,99999999);
			echo '
			<center style="margin-bottom:20px">
			<p class="text-success">Tem certeza que deseja salvar uma <b>nota sem numero</b>?</p>
				<a href="javascript:void(0)" class="btn btn-success btn-sm" style="width:150px;" onclick=\'ldy("financeiro/cadastro-nota-query.php?tipo_nota='.$tipo_nota.'&obra='.$obra.'&empresa='.$empresa.'&numero='.$numero.'&recebimento='.$recebimento.'&observacoes='.$observacoes.'&parcelas='.$parcelas.'&data_vencimento='.$data_vencimento.'&valor_vencimento='.$valor_vencimento.'",".retorno")\'>Sim</a>
				
				<a href="#" class="btn btn-danger btn-sm" style="width:150px" autofocus onclick=\'ldy("financeiro/cadastro-nota.php",".conteudo")\'>Não</a>
			</center>';
		/*}else if($tipo_nota == '1'){
			$numero = @mysql_result(mysql_query("SELECT numero FROM notas_nf WHERE obra = '$obra' AND tipo_nota = '1' ORDER BY numero DESC LIMIT 1"),0,"numero");
			$numero += 1;
		}else if($tipo_nota == '2'){
			$numero = @mysql_result(mysql_query("SELECT numero FROM notas_nf WHERE obra = '$obra' AND tipo_nota = '2' ORDER BY numero DESC LIMIT 1"),0,"numero");
			$numero += 1;
		}else if($tipo_nota == '3'){
			$numero = @mysql_result(mysql_query("SELECT numero FROM notas_nf WHERE obra = '$obra' AND tipo_nota = '3' ORDER BY numero DESC LIMIT 1"),0,"numero");
			$numero += 1;
		}*/
		
		exit;
	}
	if(mysql_num_rows(mysql_query("SELECT * FROM notas_nf WHERE numero = '$numero' AND empresa = '$empresa' AND tipo_nota = '$tipo_nota'")) > 0){ 
		echo '<script>window.alert("Esta nota de numero '.$numero.' ja esta cadastrada nesta empresa, tente novamente utilizando outro numero!")</script>'; 
		exit; 
	}

	$id_login = $_SESSION['id_usuario_logado'];
	$query = mysql_query("INSERT INTO notas_nf (obra,empresa,recebimento,numero,user,data,observacoes,tipo_nota) VALUES ('$obra', '$empresa', '$recebimento', '$numero', '$id_login', now(), '$observacoes', '$tipo_nota')");
	$id_nf = mysql_insert_id();
	$mes_v = 0;
	for ($i = 1; $i <= $parcelas; $i++) {
		$data_result = new DateTime($data_vencimento);
		$data_result->add(new DateInterval('P'.$mes_v.'M'));
		$data_result=$data_result->format('Y-m-d');
		$query = mysql_query("INSERT INTO notas_nf_venc (nota, valor, data, valor_pagamento, data_pagamento, parcela) VALUES ('$id_nf', '$valor_vencimento', '$data_result', '$valor_vencimento', '$data_result', '$i')");
		$mes_v += 1;
	}
	if($query) {
		if($tipo_nota == '0'){
			echo '<script>ldy("financeiro/itens-nota.php?id='.$id_nf.'&controle_nota=1", ".conteudo");</script>'; 
		}else if($tipo_nota == '1'){
			echo '<script>ldy("financeiro/itens-nota.php?id='.$id_nf.'&controle_nota=1", ".conteudo");</script>'; 
		}else{
			echo '<script>ldy("financeiro/itens-nota.php?id='.$id_nf.'&controle_nota=1", ".conteudo");</script>'; 
		}
	}
?>