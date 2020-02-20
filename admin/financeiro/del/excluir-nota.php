<?php include("../../config.php");

	if(@$ac=='excluir') { 
		if(mysql_num_rows(mysql_query("SELECT * FROM notas_numerario_itens WHERE id_nota = $id_retirada")) == 0 ){
			$query1 = mysql_query("DELETE FROM notas_nf WHERE id = $id_retirada"); 
			$query2 = mysql_query("DELETE FROM notas_nf_venc WHERE nota = $id_retirada");
			$query3 = mysql_query("DELETE FROM notas_itens_add WHERE nota = $id_retirada");
			echo '<script>$("#cupom'.$id_retirada.'").hide()</script>';
			
			if($query1 && $query2 && $query3) { 
				echo '<center><p class="text-success">Informações deletada com <strong>sucesso!</strong></p>
					<a href="#" class="btn btn-danger btn-sm" style="width:150px" autofocus onclick=\'$(".modal").modal("hide")\'>Fechar</a>
				</center>'; 
			}else{ 
				echo '<p class="text-danger">'.mysql_error().'</p>'; 
			}
		}else{
			$numerario = mysql_result(mysql_query("SELECT notas_numerario.numero FROM notas_numerario INNER JOIN notas_numerario_itens ON notas_numerario.id = notas_numerario_itens.id_numerario WHERE id_nota = $id_retirada"),0,"numero");
			
			echo '<center><p class="text-danger">Nota fiscal lançada no numerario - Numero:<strong> '.$numerario.'</strong>, favor apagar a nota do numerario antes de tentar novamente!!!!</p>
				<a href="#" class="btn btn-danger btn-sm" style="width:150px" autofocus onclick=\'$(".modal").modal("hide")\'>Fechar</a>
			</center>'; 
		}
		exit;
	}
	
	$equipamento = mysql_query("SELECT * FROM notas_nf WHERE id = '$id_retirada'") or die (mysql_error());
	if( mysql_num_rows($equipamento) == 0 )
	{
		echo '
			<center>
				<div class="alert alert-danger" style="font-size:12px">
					Nota não encontrada!!!
				</div>
			</center>';
		echo '
			<div class="ajax">
				<center>			
					<a href="#" class="btn btn-danger btn-sm" style="width:150px" autofocus onclick=\'$(".modal").modal("hide")\'>Sair</a>
				</center>
			</div>';
		exit;
	}
	while($l = mysql_fetch_array($equipamento)){
		$numero = $l['numero'];
		$recebimento = $l['recebimento'];
	}
	echo '
		<center>
			<div class="alert alert-danger" style="font-size:12px">
				Tem certeza que deseja excluir a nota <strong>'.$numero.' - '.implode("/",array_reverse(explode("-",$recebimento))).'</strong> permanentemente?
			</div>
		</center>';
	echo '
		<div class="ajax">
			<center>
			<a href="javascript:void(0)" class="btn btn-success btn-sm" style="width:150px; margin-right:20px;" onclick=\'ldy("financeiro/del/excluir-nota.php?ac=excluir&id_retirada='.$id_retirada.'",".ajax")\'>Sim</a>
		
			<a href="#" class="btn btn-danger btn-sm" style="width:150px" autofocus onclick=\'$(".modal").modal("hide")\'>Não</a>
			</center>
		</div>';
?>
