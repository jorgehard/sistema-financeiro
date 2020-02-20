<?php 
	include("../../config.php");
	include("../../validar_session.php");

	if(@$ac=='excluir') { 
			$descricao = "FUNCIONARIO - ID: ".$id." / Nome: ".$nome." / Admissão: ".$admissao." / Obra: ".$obra."";
			$query2 = mysql_query("INSERT INTO log_delete (`descricao`, `data`, `user`) VALUES ('$descricao', now(), '$login')") or die (mysql_error());
			$query1 = mysql_query("DELETE FROM rh_funcionarios WHERE id = $id"); 
		if($query1) { 
			echo '<center><p class="text-success">Informações deletada com <strong>sucesso!</strong></p>
				<a href="#" class="btn btn-danger btn-sm" style="width:150px" autofocus onclick=\'$(".modal").modal("hide")\'>Fechar</a>
			</center>'; 
			echo '<script>$("#fun'.$id.'").hide()</script>';
		}else{ 
			echo '<p class="text-danger" style="text-align:center"><strong>ERROR!!! Usuario não foi deletado!!!<br/></strong><small>'.mysql_error().'</small></p>'; 
		}
		exit;
	}
	
	$fun = mysql_query("SELECT * FROM rh_funcionarios WHERE id = '$id'") or die (mysql_error());
	if(mysql_num_rows($fun) == 0 )
	{
		echo '
			<center>
				<div class="alert alert-danger" style="font-size:12px">
					Funcionario não encontrado ou ja deletado!!!
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
	while($l = mysql_fetch_array($fun)){
		$nome = $l['nome'];
		$admissao = $l['admissao'];
		$obra = $l['obra'];
	}
	echo '
		<center>
			<div class="alert alert-danger" style="font-size:12px">
				Tem certeza que deseja excluir o funcionario <strong>'.$nome.' - '.$obra.'</strong> permanentemente?
			</div>
		</center>';
	echo '
		<div class="ajax">
			<center>
			<a href="javascript:void(0)" class="btn btn-success btn-sm" style="width:150px; margin-right:20px;" onclick=\'ldy("rh/del/excluir-funcionario.php?ac=excluir&id='.$id.'&nome='.$nome.'&admissao='.$admissao.'&obra='.$obra.'&login='.$login_usuario.'",".ajax")\'>Sim</a>
		
			<a href="#" class="btn btn-danger btn-sm" style="width:150px" autofocus onclick=\'$(".modal").modal("hide")\'>Não</a>
			</center>
		</div>';
		
?>
