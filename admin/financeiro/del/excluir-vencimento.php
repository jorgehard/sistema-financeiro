<?php include("../../config.php");

	if(@$ac=='excluir') { 
		$query3 = mysql_query("DELETE FROM notas_nf_venc WHERE id = '$id_vencimento'");
		echo '<script>$("#venc'.$id_vencimento.'").hide()</script>';
		if($query3) { 
			echo '<center><p class="text-success">Informações deletada com <strong>sucesso!</strong></p>
					<a href="#" class="btn btn-danger btn-sm" style="width:150px" autofocus onclick=\'$(".modal").modal("hide")\'>Fechar</a>
				</center>'; 
		}else{ 
			echo '<p class="text-danger">'.mysql_error().'</p>'; 
		}
		exit;
	}
	
	$equipamento = mysql_query("SELECT * FROM notas_nf_venc WHERE id = '$id_vencimento'") or die (mysql_error());
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
		$data = $l['data'];
		$valor = $l['valor'];
	}
	echo '
		<center>
			<div class="alert alert-danger" style="font-size:12px">
				Tem certeza que deseja excluir o vencimento <strong>'.implode("/",array_reverse(explode("-",$data))).' de R$ '.number_format($valor, 2, ",", ".").'</strong> permanentemente?
			</div>
		</center>';
	echo '
		<div class="ajax">
			<center>
			<a href="javascript:void(0)" class="btn btn-success btn-sm" style="width:150px; margin-right:20px;" onclick=\'ldy("financeiro/del/excluir-vencimento.php?ac=excluir&id_vencimento='.$id_vencimento.'",".ajax")\'>Sim</a>
		
			<a href="#" class="btn btn-danger btn-sm" style="width:150px" autofocus onclick=\'$(".modal").modal("hide")\'>Não</a>
			</center>
		</div>';
?>
