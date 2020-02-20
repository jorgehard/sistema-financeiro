<?php include("../../config.php");

	if(@$ac=='excluir') { 
		$query1 = mysql_query("delete from ss_rm_itens where cod_rm = $id_retirada"); 
		$query2 = mysql_query("delete from ss_rm where id = $id_retirada");
		
		if($query1 && $query2) { 
			echo '<center><p class="text-success">Informações deletada com sucesso! <strong>Atualize a pagina!!!</strong></p>
						<a href="#" class="btn btn-danger btn-sm" style="width:150px" autofocus onclick=\'$(".modal").modal("hide")\'>Fechar</a></center>'; 
			echo '<script>$("#rm'.$id_retirada.'").hide()</script>';
		}else{ 
			echo '<p class="text-danger">'.mysql_error().'</p>'; 
		}
		exit;
	}
	
	$equipamento = mysql_query("SELECT * FROM ss_rm WHERE id = '$id_retirada'") or die (mysql_error());
	while($l = mysql_fetch_array($equipamento)){
		$numero = $l['numero'];
		$data = $l['data'];
	}
	echo '
		<center>
			<div class="alert alert-danger" style="font-size:12px">
				Tem certeza que deseja excluir a RM de Numero: <strong>'.$numero.' / DATA: '.implode("/",array_reverse(explode("-",$data))).'</strong> permanentemente?
			</div>
		</center>';
	echo '
		<div class="ajax">
			<center>
			<a href="javascript:void(0)" class="btn btn-success btn-sm" style="width:150px; margin-right:20px;" onclick=\'ldy("almoxarifado/del/excluir-rm.php?ac=excluir&id_retirada='.$id_retirada.'",".ajax")\'>Sim</a>
		
			<a href="#" class="btn btn-danger btn-sm" style="width:150px" autofocus onclick=\'$(".modal").modal("hide")\'>Não</a>
			</center>
		</div>';
?>