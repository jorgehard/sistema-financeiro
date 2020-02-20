<?php
	require_once("../config.php");
	require_once("../validar_session.php");
	getNivel();
	getData();
?>

<script src="../js/combobox-resume.js"></script>

<script>
$(document).ready(function() {
    $("#btnPrint").printPage();
});
</script>

<?php

if(@$ac=='definir-equipe') { 
	$sql = mysql_query("update notas_retirada SET `equipe`='$equipe', `data_ref`='$data_ref' WHERE id = '$id_retirada'");
	if($sql) {
		echo '<script>window.top.window.alert("Atualizada com sucesso'.$data_ref.'!")</script>';
	}
	exit;
}
if(@$ac == 'ins') {
	try
	{
		$categoria = mysql_result(mysql_query("SELECT categoria FROM notas_itens WHERE id = ".$item.""),0,"categoria");
		if($categoria == '3'){
			$prazo_ca2 = @mysql_result(mysql_query("SELECT tec_cadastro_ca.prazo_ca FROM tec_cadastro_ca INNER JOIN tec_itens_ca ON tec_cadastro_ca.id = tec_itens_ca.id_ca WHERE tec_itens_ca.material = ".$item." ORDER BY prazo_ca DESC"),0,"prazo_ca");
				
			if($todayTotal >= $prazo_ca2){
					echo '<span class="text-danger"> EQUIPAMENTO COM PRAZO VENCIDO - POR FAVOR CONSULTAR O TECNICO DE SEGURANÇA!!!</span>';
					exit;
				}else{
				
					$vencimento_ca = mysql_result(mysql_query("SELECT tec_itens_ca.vencimento FROM tec_cadastro_ca INNER JOIN tec_itens_ca ON tec_cadastro_ca.id = tec_itens_ca.id_ca WHERE tec_itens_ca.material = ".$item." ORDER BY tec_cadastro_ca.id DESC"),0,"vencimento");
				
					if($vencimento_ca == ''){
						$vencimento_ca = '0000-00-00';
					}else{
						$vencimento_ca = date('Y-m-d', strtotime("+".$vencimento_ca." days"));
					}
				}
			}else{
				$vencimento_ca = '0000-00-00';
			}
		} 
		catch (Exception $e) 
		{
			echo 'ERROR: Algo aconteceu, tente novamente';
			exit;
		}
		
		mysql_query("insert into notas_retirada_itens (id_retirada,id_item,quantidade,prazo_ca) values ('$retirada','$item','$quantidade','$vencimento_ca')");
		
		echo '<script> $(".conteudo").load("almoxarifado/incluir-itens-retirada.php?retirada='.$retirada.'"); $("#form1").each(function(){   this.reset(); }); </script>';
		
		exit;
} ?>


<h3><small>Adicionar itens a solicitação de retirada </small></h3>
<?php

	echo '
	<a href="#" onclick=\'$(".conteudo").load("almoxarifado/cadastro-retirada.php")\' class="btn btn-info btn-sm pull-right" style="letter-spacing:5px; position:relative; bottom:10px; font-family: \'Oswald\', sans-serif;"><span class="glyphicon glyphicon-plus"></span> CADASTRAR NOVA</a>

	<a id="btnPrint" href="almoxarifado/imprimir-saida-material.php?id=<?php echo $retirada; ?>" onclick=\'$(".conteudo").load("almoxarifado/cadastro-retirada.php")\' class="btn btn-warning btn-sm pull-right" style="letter-spacing:5px; margin:0px 10px; position:relative; bottom:10px; font-family: \'Oswald\', sans-serif;"><span class="glyphicon glyphicon-plus"></span> IMPRIMIR</a>';
	
	$sql = mysql_query("select *, notas_retirada.id as id_retirada, notas_retirada.obra as obra_correto from notas_retirada, equipes where notas_retirada.equipe = equipes.id and notas_retirada.id = $retirada") or die (mysql_error());
	while($l = mysql_fetch_array($sql)) { extract($l); }
?>

<form action="javascript:void(0)" onsubmit='post(this,"almoxarifado/incluir-itens-retirada.php?ac=definir-equipe&id_retirada=<?php echo $id_retirada; ?>",".sql")' class="formulario-info">
	<span class="label label-info">Informações</span> 
	<table class="table table-responsive table-condensed table-blue" style="font-size:12px">
		<thead>
			<tr>
				<th>Obra</th>
				<th>Funcionario</th>
				<th>Data</th>
				<th>Data Ref</th>
				<th>Equipe</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td width="20%">
					<?php echo mysql_result(mysql_query("select * from notas_obras where id = $obra_correto"),0,"descricao"); ?>
				</td>
				<td width="20%">
					<?php echo mysql_result(mysql_query("select * from rh_funcionarios where id = $funcionario"),0,"nome"); ?>
				</td>
				<td width="10%">
					<?php echo implode("/",array_reverse(explode("-",$data))); ?>
				</td>
				<td>
					<label><input type="date" name="data_ref" value="<?php echo $data_ref; ?>" class="form-control input-xs"></label>
				</td>
				<td>
					<label>
						<select name="equipe" class="form-control input-sm combobox">
							<?php
							$sql = mysql_query("select * from equipes where status = 0 and oculto = 1 order by nome asc");
							while($l = mysql_fetch_array($sql))  {
								if($equipe==$l['id']) { 
									echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>'; 
								} else { 
									echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>';  
								}
							}
							?>
						</select>
					</label>
				</td>
				<td width="10%">
					<label>
						<input type="submit" value="Salvar" style="border:none; width:100%" class="btn btn-primary btn-sm">
					</label>
				</td>
			</tr>
		</tbody>
	</table>
</form>

<script> $(".ajax").load("almoxarifado/lista-itens-retirada.php?retirada=<?php echo $retirada ?>"); </script>

<span class="label label-success">Adicionar Itens</span>

<div class="alert alert-success" style="margin-top:10px" role="alert">
	<form action="javascript:void(0)" id="form1" onSubmit="post('#form1','almoxarifado/incluir-itens-retirada.php?ac=ins&retirada=<?php echo $retirada; ?>','.ajax')" class="formulario-success">
		<div class="container-fluid" style="padding:0px">
			<div class="col-xs-4" style="padding:2px">
				<label><small>Selecionar material:</small>
					<select name="item" class="form-control input-sm combobox" required>
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
			<div class="col-xs-2" style="padding:2px">
				<label><small>Quantidade:</small> 
					<input type="number" step="0.1" name="quantidade" class="form-control input-sm integer" value="" required>
				</label>
			</div>
			<div class="col-xs-2" style="padding:2px">
				<label><br/>
					<input type="submit" value="Adicionar" style="width:100%" class="btn btn-success btn-sm">
				</label>
			</div>
		</div>
	</form>
</div>

<div class="ajax"></div>
<div class="sql"></div>
