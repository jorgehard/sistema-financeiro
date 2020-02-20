<?php 
	include("../../config.php");
	include("../../validar_session.php");

	if(@$ac=='excluir') { 
			$query1 = mysql_query("DELETE FROM rh_funcoes WHERE id = $id"); 
			echo '<script>$("#car'.$id.'").hide()</script>';
			
		if($query1) { 
			echo '<center><p class="text-success">Informações deletada com <strong>sucesso!</strong></p>
				<a href="#" class="btn btn-danger btn-sm" style="width:150px" autofocus onclick=\'$(".modal").modal("hide")\'>Fechar</a>
			</center>'; 
		}else{ 
			echo '<p class="text-danger">'.mysql_error().'</p>'; 
		}
		exit;
	}
	
	$fun = mysql_query("SELECT * FROM rh_funcoes WHERE id = '$id'") or die (mysql_error());
	if(mysql_num_rows($fun) == 0 )
	{
		echo '
			<center>
				<div class="alert alert-danger" style="font-size:12px">
					Cargo não encontrado ou ja deletado!!!
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
		$nome = $l['descricao'];
	}
	echo '
		<center>
			<div class="alert alert-danger" style="font-size:12px">
				Tem certeza que deseja excluir o cargo <strong>'.$nome.'</strong> permanentemente?
			</div>
		</center>';
	echo '
		<div class="ajax">
			<center>
			<a href="javascript:void(0)" class="btn btn-success btn-sm" style="width:150px; margin-right:20px;" onclick=\'ldy("rh/del/excluir-cargo.php?ac=excluir&id='.$id.'&descricao='.$nome.'",".ajax")\'>Sim</a>
		
			<a href="#" class="btn btn-danger btn-sm" style="width:150px" autofocus onclick=\'$(".modal").modal("hide")\'>Não</a>
			</center>
		</div>';
		
?>
