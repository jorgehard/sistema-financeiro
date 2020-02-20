<?php include("../../config.php");

	if(@$ac=='excluir') { 
			$descricao = "EMPRESA - ID: ".$id." / Nome: ".$nome." / Valor: ".$valor."";
			$query1 = mysql_query("DELETE FROM vale_transporte WHERE id = $id"); 
			$query2 = mysql_query("INSERT INTO log_delete (`descricao`, `data`, `user`) VALUES ('$descricao', now(), '$login')") or die (mysql_error());
			echo '<script>$("#empresa'.$id.'").hide()</script>';
			
		if($query1) { 
			echo '<center><p class="text-success">Informações deletada com <strong>sucesso!</strong></p>
				<a href="#" class="btn btn-danger btn-sm" style="width:150px" autofocus onclick=\'$(".modal").modal("hide")\'>Fechar</a>
			</center>'; 
		}else{ 
			echo '<p class="text-danger">'.mysql_error().'</p>'; 
		}
		exit;
	}
	
	$equipamento = mysql_query("SELECT * FROM vale_transporte WHERE id = '$id'") or die (mysql_error());
	if(mysql_num_rows($equipamento) == 0 )
	{
		echo '
			<center>
				<div class="alert alert-danger" style="font-size:12px">
					Empresa não encontrada!!!
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
		$nome = $l['nome'];
		$valor = $l['valor'];
	}
	echo '
		<center>
			<div class="alert alert-danger" style="font-size:12px">
				Tem certeza que deseja excluir a empresa <strong>'.$nome.'</strong> permanentemente?
			</div>
		</center>';
	echo '
		<div class="ajax">
			<center>
			<a href="javascript:void(0)" class="btn btn-success btn-sm" style="width:150px; margin-right:20px;" onclick=\'ldy("financeiro/del/excluir-transporte.php?ac=excluir&id='.$id.'&nome='.$nome.'&valor='.$valor.'&login='.$login_usuario.'",".ajax")\'>Sim</a>
		
			<a href="#" class="btn btn-danger btn-sm" style="width:150px" autofocus onclick=\'$(".modal").modal("hide")\'>Não</a>
			</center>
		</div>';
		
?>
