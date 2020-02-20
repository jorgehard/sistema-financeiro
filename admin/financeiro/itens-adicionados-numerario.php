<?php
	include("../config.php");
	include("../validar_session.php");
	getData();
	getNivel();
	if(@$ac == 'del') { mysql_query("delete from notas_numerario_itens where id = $item"); }
    if(@$ac == 'update') {
		$vencimento = implode('-',array_reverse(explode('/',$vencimento)));
		$ordem_atual = mysql_result(mysql_query("select * from notas_numerario_itens where id = $item_n"),0,"ordem");
		mysql_query("update notas_numerario_itens set ordem = '$ordem_atual' where id_numerario = $numerario and ordem = $ordem");
		mysql_query("update notas_numerario_itens set vencimento = '$vencimento', ordem = '$ordem', numero = '$numero', valor = '$valor', obs = '$obs' where id = $item_n");
    }
	
	echo '<div class="col-xs-12" style="padding:20px 10px; background:#FFF">';
	$query = mysql_query("select * from notas_numerario_itens where id_numerario = '$numerario' order by ordem asc");
	while($l = mysql_fetch_array($query)) { extract($l);
	
    $vencimento = implode("/",array_reverse(explode("-",$vencimento)));
	$id_empresa = mysql_result(mysql_query("select * from notas_nf where id = $id_nota"),0,"empresa");
	//
		$ag = mysql_result(mysql_query("SELECT ag FROM notas_empresas WHERE id = $id_empresa"),0,"ag");
		$cc = mysql_result(mysql_query("SELECT cc FROM notas_empresas WHERE id = $id_empresa"),0,"cc");
		$banco = mysql_result(mysql_query("SELECT banco FROM notas_empresas WHERE id = $id_empresa"),0,"banco");
		//
	
	$nome_empresa = mysql_result(mysql_query("select * from notas_empresas where id = $id_empresa"),0,"nome");
	$v_t = 0;
	$i_add = mysql_query("select * from notas_itens_add where nota = $id_nota");
            while($l = mysql_fetch_array($i_add)) { $qtd = $l['quantidade']; $vl =  $l['valor'];
                	    $vl_total = $qtd*$vl;
                        $v_t += $vl_total;
            }

        echo '<form action="javascript:void(0)" class="form-inline formulario-info" id="form'.$id.'" onSubmit=\'post("#form'.$id.'","financeiro/itens-adicionados-numerario.php?ac=update&item_n='.$id.'&numerario='.$id_numerario.'",".adicionadas")\'>';
		echo '<div class="col-xs-12" style="padding:0px;">';
			echo '<div class="col-xs-1" style="padding:2px">';
				echo '<label><input type="text" value="'.$ordem.'" class="form-control input-sm" name="ordem" style="width:100%"></label>';
			echo '</div>';
			echo '<div class="col-xs-1" style="padding:2px">';
				echo '<label><input type="text" value="'.$numero.'" class="form-control input-sm" name="numero" style="width:100%"></label>';
			echo '</div>';
			echo '<div class="col-xs-1" style="padding:2px">';
				echo '<label><input type="text" value="'.$vencimento.'" class="form-control input-sm" name="vencimento" style="width:100%"></label>';
			echo '</div>';
			echo '<div class="col-xs-4" style="padding:0px">';
				echo '<div class="col-xs-6" style="padding:2px">';
					echo '<label><input type="text" value="'.$nome_empresa.'" class="form-control input-sm" style="width:100%" name="vencimento" disabled></label>';
				echo '</div>';
				echo '<div class="col-xs-6" style="padding:2px">';	
					echo '<label><input type="text" value="'.@mysql_result(mysql_query("select * from equipes where id = $equipe"),0,"nome").'" class="form-control input-sm" style="width:100%" name="equipe" disabled></label>';
				echo '</div>';
			echo '</div>';
			echo '<div class="col-xs-1" style="padding:2px">';
				echo '<label><input type="text" value="'.$valor.'" class="form-control input-sm" style="width:100%" name="valor"></label>';
			echo '</div>';
			echo '<div class="col-xs-2" style="padding:2px">';
				echo '<label><select name="obs" class="form-control input-sm" style="width:100%">';
				if($obs == 'EM BRANCO'){
					echo '<option value="EM BRANCO" selected>EM BRANCO</option>
					<option value="ANEXO BOLETO">ANEXO BOLETO</option>
					<option value="DEPOSITO EM CONTA '.$banco.' | AG: '.$ag.' | C/C: '.$cc.'">DEPOSITO EM CONTA '.$banco.' | AG: '.$ag.' | C/C: '.$cc.'</option>';
				}else if($obs == 'ANEXO BOLETO'){
					echo '<option value="EM BRANCO">EM BRANCO</option>
					<option value="ANEXO BOLETO" selected>ANEXO BOLETO</option>
					<option value="DEPOSITO EM CONTA '.$banco.' | AG: '.$ag.' | C/C: '.$cc.'">DEPOSITO EM CONTA '.$banco.' | AG: '.$ag.' | C/C: '.$cc.'</option>';
				}else if($obs == 'DEPOSITO EM CONTA '.$banco.' | AG: '.$ag.' | C/C: '.$cc.''){
					echo '<option value="EM BRANCO">EM BRANCO</option>
					<option value="ANEXO BOLETO">ANEXO BOLETO</option>
					<option value="DEPOSITO EM CONTA '.$banco.' | AG: '.$ag.' | C/C: '.$cc.'" selected>DEPOSITO EM CONTA '.$banco.' | AG: '.$ag.' | C/C: '.$cc.'</option>';
				}
				echo '</select></label>';
			echo '</div>';
			echo '<div class="col-xs-1" style="padding:0px 20px; text-align:center">';
				echo '<label><input type="submit" value="Salvar" class="btn btn-success btn-sm" style="width:100%"></label>';
			echo '</div>';
			echo '<div class="col-xs-1" style="padding:0px; text-align:center">';
				echo '<a href="#" onClick=\'ldy("financeiro/itens-adicionados-numerario.php?ac=del&numerario='.$numerario.'&item='.$id.'",".adicionadas")\' class="btn btn-danger btn-sm" style="padding-left:10px; padding-right:10px;"><span class="glyphicon glyphicon-trash"></span></a>';
			echo '</div>';
		echo '</div>';
	echo '</form>';


}

?>
</div>
