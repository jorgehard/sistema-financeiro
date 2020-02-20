<?php
	include("../config.php");
	include("../validar_session.php");
	getData();
	getNivel();
?>
<style>
	@media print
	{
		table, tr, thead, tbody, td, th{
			border:1px solid #000 !important;
		}
	}
</style>

<script src="../js/combobox-resume.js"></script>

<?php
	if(@$ac=='salvar-info'){
		$sql_fornecedor = mysql_query("UPDATE `pedido_compras` SET `fornecedor` = '$fornecedorInput', `equipe` = '$equipeInput' WHERE `id` = '$id'"); 
		if($sql_fornecedor) { 
			echo '<script>window.alert("Informações atualizadas com sucesso!");</script>';
			echo '<span class="text-success">Informações atualizadas com sucesso</span>';
		} else { 
			echo '<script>window.alert("'.mysql_error().'");</script>'; 
		}
		exit; 
	}

	if(@$op=='inserir') {
		mysql_query("insert into pedido_compras_itens (id_pedido,material,qtd,vlr) values ('$pedido','$item','$qtd','$vlr')");
	}
	if(@$op=='del') { 
		$query = mysql_query("delete from pedido_compras_itens where id = '$id'");
		if($query){
			echo '<span class="text-success">Item excluido com sucesso!!!</span>';
			echo '<script>$("#itemval'.$id.'").hide()</script>';
		}else{
			echo mysql_error(); 
		}
		exit;
	}
	if(@$ac=='listar') {
		echo '<table class="table table-bordered table-condensed table-blue small">';
		echo '<thead><tr class="small"><th>Descricao</th><th style="text-align:center">Qtd</th><th style="text-align:center">Vlr UN</th><th>Excluir</th></tr></thead><tbody>';
		$sql = mysql_query("SELECT * FROM pedido_compras_itens WHERE id_pedido = '$pedido' ORDER BY id DESC");
		while($s = mysql_fetch_array($sql)){
			$id = $s['id'];
			echo '<tr id="itemval'.$id.'">';
				echo '<td>'.mysql_result(mysql_query("SELECT * FROM notas_itens WHERE id = $s[material]"),0,"descricao").'</td>';
				echo '<td>'.number_format($s['qtd'],2,",",".").'</td>';
				echo '<td>'.number_format($s['vlr'],2,",",".").'</td>';
				
				echo '<td style="width:5%"><a href="#" title="Excluir Item" class="btn btn-danger btn-xs hidden-print" style="width:100%;"  onClick=\'ldy("almoxarifado/editar-cadastro-compras.php?op=del&id='.$id.'",".ajaxedit")\'> <b><i class="fa fa-trash" aria-hidden="true"></i></b> </a></td>';
			
			echo '</tr>';
			
		}
		echo '</tbody></table>';
		exit;
	}
?>

<div class="container-fluid hidden-print" style="padding:0px 0px 15px 0px; margin-bottom:20px; border-bottom:1px solid #CCC">
<h4 style="font-family: 'Oswald', sans-serif;letter-spacing:8px;"><small>Informações de compra</small>
<?php
	if($stu != '1'){
		echo '<td><a href="#" onclick=\'$(".modal").modal("hide"); $(".conteudo").load("almoxarifado/cadastro-compras.php")\' style="width:auto; padding:5px;" class="btn btn-primary btn-xs pull-right"><span class="pull-left glyphicon glyphicon-plus"></span> ADICIONAR / VOLTAR</a></td>';
	}
?>
</h4>
</div>
<div class="ajax1"></div>
<?php 
$detalhes = mysql_query("select * from pedido_compras where id = '$pedido'");
while($l = mysql_fetch_array($detalhes)) { 
?>
<form action="javascript:void(0)" onSubmit="post(this,'almoxarifado/editar-cadastro-compras.php?ac=salvar-info&id=<?php echo $pedido ?>','.ajax1');" class="formulario-success">
<table class="table table-condensed table-bordered table-green">
	<thead><tr class="small"><th>Obra:</th><th>Data:</th><th>Equipe:</th><th>Fornecedor</th><th></th></tr></thead>
	<tbody>
	<tr>
		<?php
			echo '<td>'.mysql_result(mysql_query("select * from notas_obras where id = ".$l['obra'].""),0,"descricao").'</td>';
			echo '<td>'.implode("/",array_reverse(explode("-", $l['data']))).'</td>';
			echo '<td class="formulario-normal">
			<select name="equipeInput" class="form-control input-sm combobox" id="equipeSelect">
			<option value="" disabled selected>SELECIONE UMA EQUIPE</option>';
			$equipe_view = mysql_query("select * from equipes order by nome asc");
			while($c = mysql_fetch_array($equipe_view)) {
				if($c['id'] == $l['equipe']){
					echo '<option value="'.$c['id'].'" selected>'.$c['nome'].'</option>';
				}else{
					echo '<option value="'.$c['id'].'">'.$c['nome'].'</option>';
				}
			}		
		echo '</select>';
		echo '</td>';
			echo '<td>';
			echo '<select name="fornecedorInput" class="form-control input-sm combobox" id="fornecedorSelect">
						<option value="" selected> </option>';
							$fornecedorSelect = mysql_query("select * from notas_empresas where status = 0 order by nome asc");
							while($xl = mysql_fetch_array($fornecedorSelect)) { 
								if($l['fornecedor'] == $xl['id']){
									echo '<option value="'.$xl['id'].'" selected>'.$xl['nome'].'</option>';
								}else{
									echo '<option value="'.$xl['id'].'">'.$xl['nome'].'</option>';
								}
							}
						
			echo '</select>';
			echo '</td>';
			echo '<td>';
				echo '<input type="submit" style="width:100%;" value="Adicionar" class="btn btn-success btn-sm" />';
			echo '</td>';
		?>
	</tr>
	</tbody>
</table>
</form>
<?php } ?>
<div class="alert alert-info" style="padding:5px 5px 0px 5px">
<form action="javascript:void(0)" onSubmit="post(this,'almoxarifado/editar-cadastro-compras.php?op=inserir&pedido=<?php echo $pedido ?>','.resultado22'); $('select').val('').selectpicker('refresh'); $('.ajax').val('')" class="formulario-info">
	<div class="container-fluid" style="padding:0px">
		<div class="col-xs-4" style="padding:2px">
	<label>Selecione o material:
		<select name="item" style="width:100%" class="form-control input-sm combobox" required>
			<option value="" disabled selected>Sem Material Selecionado</option>
			<?php
				$sql = mysql_query("select * from notas_itens where descricao like '%$q%' AND oculto <> 1 order by descricao asc");
				while($l = mysql_fetch_array($sql)) { extract($l);
					echo '<option value="'.$id.'">'.$descricao.'</option>';
				}
			?>
		</select>
	</label>
		</div>
		<div class="col-xs-1" style="padding:2px;">
			<label>Qtd: 
				<input type="number" name="qtd" style="width:100%" id="qtd" class="form-control input-sm" required>
			</label>
		</div>
		<div class="col-xs-1" style="padding:2px;">
			<label>Vlr UN: 
				<input type="number" name="vlr" style="width:100%" step="0.01" id="vlr" class="form-control input-sm" required>
			</label>
		</div>
		
		<div class="col-xs-2" style="padding:2px;">
			<label><br/>
				<input type="submit" style="width:100%; margin-left:10px" value="Adicionar" class="btn btn-success btn-sm" />
			</label>
		</div>
	</div>
</form>
</div>	
<div class="ajaxedit"></div>

<script>ldy("almoxarifado/editar-cadastro-compras.php?ac=listar&pedido=<?php echo $pedido ?>",".resultado22")</script>

<div class="resultado22"></div>