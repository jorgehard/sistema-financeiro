<?php
	include("../config.php");
	include("../validar_session.php");
	getData();
	getNivel();
?>
<script src="../js/combobox-resume.js"></script>

<style>
tbody td{
	font-size:11px;
	font-weight:bold;
}
tbody td a{
	font-size:10px !important;
	color:#000;
}
tbody tr:nth-child(odd){
  /*background-color: #d6fffa !important;*/
}
</style>
<script type="text/javascript">
$(document).ready(function(){
	$('.sel').multiselect({
		buttonClass: 'btn btn-sm', 
		numberDisplayed: 1,
		maxHeight: 500,
		includeSelectAllOption: true,
		selectAllText: "Selecionar todos",
		enableFiltering: true,
		enableCaseInsensitiveFiltering: true,
		selectAllValue: 'multiselect-all',
		buttonWidth: '100%'
	}); 
});
</script>

<?php 
if(@$ac=='salvar-pedido'){
	if($prm == '1'){
		$sql2 = mysql_query("update pedido_compras set pedido = '1', data_liberado = '$todayTotal' where id = $id");
		if($sql2) { 
			echo '<span class="btn btn-success btn-xs" style="font-size:10px;">LIBERADO</a>';
		}else{ 
			echo '<script>window.alert("'.mysql_error().'");</script>'; 
		}
	}
	exit;
}

if($atu == 'ac'){
echo '
	<div class="col-xs-6">
		<label style="width:100%"><small>Contrato:</small>
			<select name="obra" class="form-control input-sm" style="width:100%" required>';
				$obras = @mysql_query("select * from notas_obras where cidade IN($cidade) AND id IN($obra_usuario) order by descricao asc");
				while($l = @mysql_fetch_array($obras)) {
					echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>';
				}	
		echo '</select>
		</label>
	</div>
	<div class="col-xs-6">
		<label style="width:100%"><small>Equipe:</small><br/>
			<select name="equipe" style="width:100%" class="form-control input-sm combobox" required>';
				$sql = mysql_query("select * from equipes where status = 0 and oculto = 1 AND obra IN(0,$cidade) order by nome asc");
				while($l = mysql_fetch_array($sql)) { extract($l);
					echo '<option value="'.$id.'">'.$nome.'</option>';
				}				
			echo '</select>
		</label>
	</div>
	<div class="col-xs-6">
		<label style="width:100%"><small>Encarregado:</small>
			<select name="encarregado" class="form-control input-sm" style="width:100%" required>';
				$sql = mysql_query("select * from encarregados where oculto = 0 AND obra IN($cidade) order by nome asc");
				while($l = mysql_fetch_array($sql)) { extract($l);
					echo '<option value="'.$id.'">'.$nome.'</option>';
				}	
			echo '</select>
		</label>
	</div>
	<div class="col-xs-6">
		<label style="width:100%"><small>Retirado (Funcionario):</small><br/>
			<select name="funcionario" style="width:100%" class="form-control input-sm combobox" required>';
			$obra2 = mysql_query("SELECT id FROM notas_obras WHERE cidade IN(0,$cidade)");
			while($l = mysql_fetch_array($obra2)) { @$oba2 .= $l['id'].','; } $oba2 = substr($oba2,0,-1);
			$sql = mysql_query("select * from rh_funcionarios where obra IN($oba2) AND situacao <> '1' order by nome asc");
			while($l = mysql_fetch_array($sql)) { extract($l);
				echo '<option value="'.$id.'">'.$nome.'</option>';
			}		
			echo '</select>
		</label>
	</div>';
	exit;
}
if(@$ac == 'ins') {
		$sqlc = mysql_query("INSERT INTO pedido_compras (obra, equipe, fornecedor, data, encarregado, funcionario, tipo_pedido) values ('$obra', '$equipe', '$fornecedor', '$data', '$encarregado', '$funcionario', '$tipo_pedido')"); 
		$i_retirada = mysql_insert_id();
		if($sqlc) { 
			echo '<script> $(".conteudo").load("almoxarifado/editar-cadastro-compras.php?pedido='.$i_retirada.'"); </script>'; 
		}else{
			echo mysql_error(); 
		}	
	exit;
} 

?>
		<div class="container-fluid hidden-print" style="padding:0px 0px 15px 0px; margin-bottom:20px; border-bottom:1px solid #CCC">
		<img src="../imagens/logo.png" class="img-responsive" width="50px" style="float:left; margin-right:20px"/>
		<h3 style="font-family: 'Oswald', sans-serif; letter-spacing:5px;"> 
			Cadastro de Pedido de Compras <small><b>Após o cadastro, incluir os itens</b></small>
			<a href="javascript:window.print()" style="letter-spacing:8px; padding-left:40px; padding-right:40px;" class="hidden-xs hidden-print pull-right btn btn-warning btn-sm"> <span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir</a>
		</h3>
	</div>
<div class="ajax"></div>
<div class="panel panel-info" style="width:100%; margin:0 auto;">
	<div class="panel-heading"><small style="font-family: 'Oswald', sans-serif; font-size:13px">Cadastrar Retirada</small></div>
	<div class="panel-body">		
		<form action="javascript:void(0)" onSubmit="post(this,'almoxarifado/cadastro-compras.php?ac=ins','.ajax')" class="formulario-info">
			<div class="col-xs-12" style="padding:0px">
				<div class="col-xs-6">					
					<label style="width:100%"><small>Data:</small>
						<input type="date" name="data" style="width:100%" value="<?php echo $todayTotal ?>" class="form-control input-sm" required/>
					</label>
				</div>
				<div class="col-xs-6">
					<label style="width:100%"><small>Obra:</small>
						<select name="cidade" onChange="$('#itens').load('almoxarifado/cadastro-compras.php?atu=ac&cidade=' + $(this).val() + '');" class="form-control input-sm" style="width:100%" required> 
							<option value="" selected disabled>Selecione uma opção</option>
							<?php
								$cidade = @mysql_query("select * from notas_obras_cidade WHERE id IN($cidade_usuario) order by nome asc");
								while($l = @mysql_fetch_array($cidade)) {
									echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>';
								}
							?>	
						</select>
					</label>
				</div>
			</div>
			<div class="col-xs-12" style="padding:0px">		
				<label id="itens" style="width:100%">	
					<div class="col-xs-6">
						<label style="width:100%"><small>Contrato:</small>
							<select name="obra" class="form-control input-sm" style="width:100%" required disabled>
								<option value="" selected></option>	
							</select>
						</label>
					</div>
					<div class="col-xs-6">
						<label style="width:100%"><small>Equipe:</small><br/>
							<select name="equipe" class="form-control input-sm" disabled>
								<option value="" selected> </option>	
							</select>
						</label>
					</div>
					<div class="col-xs-6">
						<label style="width:100%"><small>Encarregado:</small>
							<select name="obra" class="form-control input-sm" style="width:100%" required disabled>
								<option value="" selected></option>	
							</select>
						</label>
					</div>
					<div class="col-xs-6">
						<label style="width:100%"><small>Retirado (Funcionario):</small><br/>
							<select name="equipe" class="form-control input-sm" disabled>
								<option value="" selected> </option>	
							</select>
						</label>
					</div>
				</label>
			</div>
			<div class="col-xs-6">
				<label style="width:100%"><small>Fornecedor (Empresa): </small><br/>
					<select name="fornecedor" class="form-control input-sm combobox">
						<option value="0" selected>SEM FORNECEDOR</option>
						<?php
							$sql = mysql_query("select * from notas_empresas where status = 0 order by nome asc");
							while($l = mysql_fetch_array($sql)) { extract($l);
								echo '<option value="'.$id.'">'.$nome.'</option>';
							}
						?>				
					</select>
				</label>
			</div>
			<div class="col-xs-6">
				<label style="width:100%"><small>Tipo de Pedido:</small><br/>
					<select name="tipo_pedido" class="form-control input-sm" required>
						<option value="0">PEDIDO</option>
						<option value="1">COTAÇÃO</option>
					<select>
				</label>
			</div>
			<label style="text-align:center; width:100%">
				<input type="submit" value="Cadastrar" style="width:50%; margin-top:10px;" class="btn btn-success btn-sm">
			</label>
		</form>
	</div>
</div>

<h3 style="font-family: 'Oswald', sans-serif; letter-spacing:5px; text-align:center"> 
<small> Pedidos em aberto</small>
</h3>
<?php
echo '<table width="100%" class="table table-condensed table-bordered table-blue">';
		echo '<thead><tr class="small"><th>Nº:</th><th>Empresa:</th><th>Obra:</th><th>Encarregado:</th><th>Equipe:</th><th>Funcionario (Retirou):</th><th style="text-align:center">Data:</th><th style="text-align:center">Tipo:</th><th style="text-align:center">Status:</th><th style="text-align:center">Editar</th>';
		echo '<th style="text-align:center">Excluir</th>';
		echo '</tr></thead><tbody>';
		
    $sql = mysql_query("SELECT * FROM pedido_compras WHERE pedido = '0' ORDER BY pedido_compras.id DESC");
		
		while($l = mysql_fetch_array($sql)) { extract($l);
			echo '<tr id="val'.$id.'">';
				echo '<td>'.$id.'</td>';
				$fornecedor_nome = @mysql_result(mysql_query("SELECT * FROM notas_empresas WHERE id = '$fornecedor'"),0,"nome");
				
				if( strlen($fornecedor_nome) >= 30 ) {
					$fornecedor_nome = substr($fornecedor_nome, 0, 30).'...<span class="glyphicon glyphicon-eye-open"></span>';
				}else{
					$fornecedor_nome = $fornecedor_nome.'...<span class="glyphicon glyphicon-eye-open"></span>';
				}
				echo '<td><a href="#" onclick=\'$(".modal-body").load("financeiro/view-empresa.php?id='.$fornecedor.'")\' data-toggle="modal" data-target="#myModal"  class="btn btn-xs" style="margin:0px; padding:5px; font-weight:bold;">'.$fornecedor_nome.'</a></td>';
				
				
				echo '<td>'.mysql_result(mysql_query("SELECT * FROM notas_obras WHERE id = '$obra'"),0,"nome_exibir").'</td>';
				$encarregado_nome = mysql_result(mysql_query("SELECT * FROM encarregados WHERE id = '$encarregado'"),0,"nome");
				if( strlen($encarregado_nome) >= 30 ) {
					$encarregado_nome = substr($encarregado_nome, 0, 30).'...';
				}
				
				echo '<td>'.$encarregado_nome.'</td>';
				echo '<td>'.mysql_result(mysql_query("SELECT * FROM equipes WHERE id = '$equipe'"),0,"nome").'</td>';
				echo '<td>'.mysql_result(mysql_query("SELECT * FROM rh_funcionarios WHERE id = '$funcionario'"),0,"nome").'</td>';
				
				echo '<td style="text-align:center">'.implode("/",array_reverse(explode("-", $data))).'</td>';
				echo '<td style="text-align:center">';
				if($tipo_pedido == '0'){
					echo '<a href="#" class="btn btn-success btn-xs" style="font-size:10px; background-color:#F0946E; border:none; font-weight:bold">PEDIDO</a>';
				}else if($tipo_pedido == '1'){
					echo '<a href="#" class="btn btn-success btn-xs"  style="font-size:10px; font-weight:bold">COTAÇÃO</a>';
				}else if($tipo_pedido == '3'){
					echo '<a href="#" class="btn btn-success btn-xs"  style="font-size:10px; font-weight:bold">COTADO</a>';
				}
				echo '</td>';
				echo '<td style="text-align:center" id="atublock'.$id.'">';
				if($pedido == '0'){
					if($tipo_pedido == '0' || $tipo_pedido == '3'){
						echo '<a href="#" class="btn btn-warning btn-xs" onclick=\'ldy("almoxarifado/cadastro-compras.php?ac=salvar-pedido&prm=1&id='.$id.'","#atublock'.$id.'")\' style="font-size:10px; font-weight:bold">PENDENTE</a>';
					}else{
						echo '<a href="#" class="btn btn-warning btn-xs" style="font-size:10px; font-weight:bold" disabled>EM ANALISE</a>';
					}
				}else if($pedido == '1'){
					echo '<a href="#" class="btn btn-success btn-xs"  style="font-size:10px; font-weight:bold">LIBERADO</a>';
				}
				echo '</td>';
				echo '<td style="width:4%; text-align:center"><a href="#" onclick=\'$(".conteudo").load("almoxarifado/editar-cadastro-compras.php?pedido='.$id.'")\' class="btn btn-xs btn-primary" style="margin:0px; padding:5px; font-weight:bold; font-size:12px;"><span class="glyphicon glyphicon-pencil"></span></a></td>';
				
				echo '<td style="width:4%; text-align:center""><a href="#" onclick=\'$(".modal-body").load("almoxarifado/del/excluir-pedido-compra.php?id='.$id.'")\' data-toggle="modal" data-target="#myModal2"  class="buttonCel btn btn-xs btn-danger" style="margin:0px; padding:5px; font-weight:bold;"><span class="glyphicon glyphicon-trash"></span></a></td>';
			echo '</tr>';

		}
		echo '</tbody></table>';
?>
	<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="height:auto;">
		<div class="modal-dialog" style="width:80%;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" onclick="$('.modal').modal('hide')" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Visualizar empresa</h4>
				</div>
				<div class="modal-body">
					Aguarde um momento &nbsp;&nbsp; <img src="../../imagens/loading.gif" alt="Carregando" width="20px"/>
				</div>
			</div>
		</div>
	</div>
	<div class="modal" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:auto;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" onclick="$('.modal').modal('hide')" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Excluir</h4>
				</div>
				<div class="modal-body">
					Aguarde um momento &nbsp;&nbsp; <img src="../../imagens/loading.gif" alt="Carregando" width="20px"/>
				</div>
			</div>
		</div>
	</div>
	<div class="modal" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="height:auto;">
		<div class="modal-dialog" style="width:80%;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" onclick="$('.modal').modal('hide')" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Visualizar empresa</h4>
				</div>
				<div class="modal-body">
					Aguarde um momento &nbsp;&nbsp; <img src="../../imagens/loading.gif" alt="Carregando" width="20px"/>
				</div>
			</div>
		</div>
	</div>