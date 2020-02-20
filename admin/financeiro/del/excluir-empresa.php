<?php include("../../config.php");

	if(@$ac=='excluir') { 
			$descricao = "EMPRESA - ID: ".$id." / Nome: ".$nome." / CNPJ: ".$cnpj."";
			$query1 = mysql_query("DELETE FROM empresa_cadastro WHERE id = '$id'"); 
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
	
	$equipamento = mysql_query("SELECT * FROM empresa_cadastro WHERE id = '$id'") or die (mysql_error());
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
		$nome = $l['razao_social'];
		$cnpj = $l['cnpj'];
	}
	echo '
		<center>
			<div class="alert alert-danger" style="font-size:12px">
				Tem certeza que deseja excluir a empresa <strong>'.$cnpj.' - '.$nome.'</strong> permanentemente?
			</div>
		</center>';
	echo '
		<div class="ajax">
			<center>
			<a href="javascript:void(0)" class="btn btn-success btn-sm" style="width:150px; margin-right:20px;" onclick=\'ldy("financeiro/del/excluir-empresa.php?ac=excluir&id='.$id.'&nome='.$nome.'&cnpj='.$cnpj.'&login='.$login_usuario.'",".ajax")\'>Sim</a>
		
			<a href="#" class="btn btn-danger btn-sm" style="width:150px" autofocus onclick=\'$(".modal").modal("hide")\'>Não</a>
			</center>
		</div>';
		
?>
