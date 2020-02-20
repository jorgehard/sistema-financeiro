<?php include("../../config.php"); include("../../validar_session.php");
	if(@$ac=='excluir') { 
		if(mysql_num_rows(mysql_query("SELECT * FROM pedido_compras_itens WHERE id_pedido = $id")) == 0 ){
			$query = mysql_query("DELETE FROM pedido_compras WHERE id = $id"); 
			echo '<script>$("#val'.$id.'").hide()</script>';
			if($query) { 
				echo '<center><p class="text-success">Informações deletada com <strong>sucesso!</strong></p>
					<a href="#" class="btn btn-danger btn-sm" style="width:150px" autofocus onclick=\'$(".modal").modal("hide")\'>Fechar</a>
				</center>'; 
			}else{ 
				echo '<p class="text-danger">'.mysql_error().'</p>'; 
			}
		}else{
			echo '<center><p class="text-danger"><strong>Error!!!</strong>Este pedido ainda possui lançamentos de material cadastrados dentro dele, por favor tente excluir todos os itens e tente novamente!!!!</p>
				<a href="#" class="btn btn-danger btn-sm" style="width:150px" autofocus onclick=\'$(".modal").modal("hide")\'>Fechar</a>
			</center>'; 
		}
		exit;
	}
	
	$pedido = mysql_query("SELECT * FROM pedido_compras WHERE id = '$id'") or die (mysql_error());
	if( mysql_num_rows($pedido) == 0 )
	{
		echo '
			<center>
				<div class="alert alert-danger" style="font-size:12px">
					Pedido de compra não encontrado, tente novamente!!!
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
	while($l = mysql_fetch_array($pedido)){
		$data = $l['data'];
		$fornecedor = $l['fornecedor'];
	}
	echo '
		<center>
			<div class="alert alert-danger" style="font-size:12px">
				Tem certeza que deseja excluir o pedido Data: <strong>'.implode("/",array_reverse(explode("-",$data))).'</strong>  Empresa: <strong>'.mysql_result(mysql_query("SELECT * FROM notas_empresas WHERE id = $fornecedor"),0,"nome").'</strong> permanentemente?
			</div>
		</center>';
	echo '
		<div class="ajax">
			<center>
			<a href="javascript:void(0)" class="btn btn-success btn-sm" style="width:150px; margin-right:20px;" onclick=\'ldy("almoxarifado/del/excluir-pedido-compra.php?ac=excluir&id='.$id.'",".ajax")\'>Sim</a>
		
			<a href="#" class="btn btn-danger btn-sm" style="width:150px" autofocus onclick=\'$(".modal").modal("hide")\'>Não</a>
			</center>
		</div>';
?>
