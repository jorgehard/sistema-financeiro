<?php
	include("../config.php");
	include("../validar_session.php");
	getData();
	getNivel();

	if($inicial <> '' && $final <> '') { 
		$periodo = " and (recebimento between '$inicial' and '$final')"; 
	}else{ 
		$periodo = ''; 
	}
	$query = mysql_query("SELECT *, id as id_nota from notas_nf where numero like '%$busca%' $periodo AND obra IN($obra_2) LIMIT 50");
	
	while($l = mysql_fetch_array($query)) { extract($l);
		$vencimento = @mysql_result(mysql_query("select * from notas_nf_venc where nota = $id_nota order by data desc"),0,"data");
		$v_t = 0;
		$i_add = mysql_query("select * from notas_itens_add where nota = $id");
		while($l = mysql_fetch_array($i_add)) { 
			$descontovalor = $l['valor'] - $l['desconto'];
			$subtotal = $l['quantidade'] * $descontovalor;
			$vl_total = round($subtotal,3);
			$v_t += $vl_total;
		}
echo '<form action="javascript:void(0)" id="form'.$id.'" onSubmit=\'post("#form'.$id.'","financeiro/item-numerario-query.php?nota='.$id.'&numerario='.$numerario.'",".adicionadas")\' class="form-inline formulario-info">';
	echo '<div class="col-xs-12" style="padding:0px;">';
		echo '<div class="col-xs-1" style="padding:0px">';
			echo '<label><input type="text" value="'.$numero.'" name="numero" class="form-control input-sm" style="width:100%"/></label>';
		echo '</div>';		
		echo '<div class="col-xs-3" style="padding:0px">';
			echo '<div class="col-xs-6" style="padding:0px">';
				echo '<label class="small"><input type="date" value="'.$recebimento.'"  class="form-control input-sm" style="width:100%" disabled /></label>';
			echo '</div>';
			echo '<div class="col-xs-6" style="padding:0px">';
				echo '<label class="small"><input type="date" value="'.$vencimento.'" name="vencimento" style="width:100%" class="form-control input-sm"></label>';
			echo '</div>';
		echo '</div>';
		echo '<div class="col-xs-4" style="padding:0px">';
			echo '<div class="col-xs-6" style="padding:0px">';
				echo '<label class="small"><input type="text" style="width:100%" value="'.mysql_result(mysql_query("select * from notas_empresas where id = $empresa"),0,"nome").'" class="form-control input-sm" disabled /></label>';
			echo '</div>';
			echo '<div class="col-xs-6" style="padding:0px">';
				echo '<label class="small"><input type="text" value="'.@mysql_result(mysql_query("select * from equipes where id = $equipe"),0,"nome").'" style="width:100%" class="form-control input-sm" disabled /></label>';
			echo '</div>';
		echo '</div>';
		//
		$ag = mysql_result(mysql_query("SELECT ag FROM notas_empresas WHERE id = $empresa"),0,"ag");
		$cc = mysql_result(mysql_query("SELECT cc FROM notas_empresas WHERE id = $empresa"),0,"cc");
		$banco = mysql_result(mysql_query("SELECT banco FROM notas_empresas WHERE id = $empresa"),0,"banco");
		//
		echo '<div class="col-xs-1" style="padding:0px">';
		
        echo '<label class="small"><input type="number" value="'.number_format($v_t,"2",".","").'" name="valor" class="form-control input-sm" style="width:100%"></label>';
		echo '</div>';
		echo '<div class="col-xs-2" style="padding:0px">';
			echo '<label class="small"><select name="obs" class="form-control input-sm" style="width:100%">
					<option value="EM BRANCO">EM BRANCO</option>
					<option value="ANEXO BOLETO">ANEXO BOLETO</option>
					<option value="DEPOSITO EM CONTA '.$banco.' | AG: '.$ag.' | C/C: '.$cc.'">DEPOSITO EM CONTA '.$banco.' | AG: '.$ag.' | C/C: '.$cc.'</option>
				</select></label>';
		echo '</div>';
		echo '<div class="col-xs-1" style="padding:0px">';
		$verificar = mysql_result(mysql_query("SELECT COUNT(*) as resultado FROM notas_numerario_itens WHERE id_nota = '$id_nota'"),0,"resultado");
		if($verificar >= 1){
			echo '<label><button type="submit" class="btn btn-danger btn-sm" style="margin-left:10px" disabled><span class="glyphicon glyphicon-ok-circle"></span></button></label>';
		}else{
			echo '<label><button type="submit" class="btn btn-success btn-sm" style="margin-left:10px"><span class="glyphicon glyphicon-ok-circle"></span></button></label>';
		}
		echo '</div>';
	echo '</div>';
echo '</form>';  

	}
?>
</table>

