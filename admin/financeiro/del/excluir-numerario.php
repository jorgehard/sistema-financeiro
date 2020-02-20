<?php include("../../config.php");

	if(@$ac=='excluir') { 
		if(mysql_num_rows(mysql_query("SELECT * FROM notas_numerario_itens WHERE id_numerario = $id")) == 0 ){
			$query = mysql_query("DELETE FROM notas_numerario WHERE id = '$id' ");
			echo '<script>$("#linha'.$id.'").hide()</script>';
			if($query) { 
				echo '<center><p class="text-success">Informações deletada com <strong>sucesso!</strong></p>
					<a href="#" class="btn btn-danger btn-sm" style="width:150px" autofocus onclick=\'$(".modal").modal("hide")\'>Fechar</a>
				</center>'; 
			}else{ 
				echo '<p class="text-danger">'.mysql_error().'</p>'; 
			}
		}else{
			echo '<center><p class="text-danger">Numerario possui notas lançadas, favor apagar as notas do numerario antes de tentar novamente!!!!</p>
				<a href="#" class="btn btn-danger btn-sm" style="width:150px" autofocus onclick=\'$(".modal").modal("hide")\'>Fechar</a>
			</center>'; 
		}
		exit;
	}
	
	$numerario = mysql_query("SELECT * FROM notas_numerario WHERE id = '$id'") or die (mysql_error());
	if( mysql_num_rows($numerario) == 0 )
	{
		echo '
			<center>
				<div class="alert alert-danger" style="font-size:12px">
					Numerario não encontrado ou já excluido!!!
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
	while($l = mysql_fetch_array($numerario)){
		$numero = $l['numero'];
		$data = $l['data'];
	}
	echo '
		<center>
			<div class="alert alert-danger" style="font-size:12px">
				Tem certeza que deseja excluir o numerario <strong>'.$numero.' - '.implode("/",array_reverse(explode("-",$data))).'</strong> permanentemente?
			</div>
		</center>';
	echo '
		<div class="ajax">
			<center>
			<a href="javascript:void(0)" class="btn btn-success btn-sm" style="width:150px; margin-right:20px;" onclick=\'ldy("financeiro/del/excluir-numerario.php?ac=excluir&id='.$id.'",".ajax")\'>Sim</a>
		
			<a href="#" class="btn btn-danger btn-sm" style="width:150px" autofocus onclick=\'$(".modal").modal("hide")\'>Não</a>
			</center>
		</div>';
?>
