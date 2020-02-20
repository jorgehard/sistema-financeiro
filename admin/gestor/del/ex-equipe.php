<?php include("../../config.php");

	if(@$ac=='excluir') { 
		$query = mysql_query("delete from equipes where id = '$id'"); 
		if($query) { 
			echo '<center><p class="text-success">Informações deletada com sucesso!!!</p>
						<a href="#" class="btn btn-danger btn-sm" style="width:150px" autofocus onclick=\'$(".modal").modal("hide")\'>Fechar</a>
			</center>'; 
			echo '<script>$("#cupom'.$id.'").hide()</script>';
		}else{ 
			echo '<p class="text-danger">'.mysql_error().'</p>'; 
		}
		exit;
	}
	
	$equipamento = mysql_query("SELECT * FROM equipes WHERE id = '$id'") or die (mysql_error());
	if( mysql_num_rows($equipamento) == 0 )
	{
		echo '
			<center>
				<div class="alert alert-danger" style="font-size:12px">
					EQUIPE não encontrada!!!
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
	}
	echo '
		<center>
			<div class="alert alert-danger" style="font-size:12px">
				Tem certeza que deseja excluir esta equipe <strong>'.$nome.'</strong> permanentemente?
			</div>
		</center>';
	echo '
		<div class="ajax">
			<center>
			<a href="javascript:void(0)" class="btn btn-success btn-sm" style="width:150px; margin-right:20px;" onclick=\'ldy("gestor/del/ex-equipe.php?ac=excluir&id='.$id.'",".ajax")\'>Sim</a>
		
			<a href="#" class="btn btn-danger btn-sm" style="width:150px" autofocus onclick=\'$(".modal").modal("hide")\'>Não</a>
			</center>
		</div>';
?>
