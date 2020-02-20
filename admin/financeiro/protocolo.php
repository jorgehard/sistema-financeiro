<?php
	include("../config.php");
	include("../validar_session.php");
	getData();
	getNivel();

	if(@$ac=='up-numerario') {
		$sql = mysql_query("update notas_numerario set obs = '$obs', numero = '$numero' where id = '$id'");
		if($sql) { echo '<script>window.alert("Informações atualizadas com sucesso!");</script>'; }
		exit;
	}
?>
<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px;">
	<small>Inserir notas ao numerário</small>
	<p class="pull-right">
	<?php
		echo '<a href="financeiro/imprimir-numerario.php?id='.$id.'" target="_blank" class="btn btn-warning btn-xs" style="letter-spacing:5px; padding-left:40px; padding-right:40px; margin-right:20px"><span class="glyphicon glyphicon-print"></span> Imprimir</a>';
						
		echo '<a href="financeiro/imprimir-numerario-copia.php?id='.$id.'" target="_blank" class="btn btn-warning btn-xs" style="letter-spacing:5px; padding-left:40px; padding-right:40px;"><span class="glyphicon glyphicon-print"></span> Imprimir (Copia)</a>';
	?>
	</p>
</h3>
<?php

$sql = mysql_query("select * from notas_numerario WHERE id = $id");
while($l = mysql_fetch_array($sql)) { extract($l); }
echo '<form action="javascript:void(0)" onsubmit=\'post(this,"financeiro/protocolo.php?ac=up-numerario&id='.$id.'",".ajax")\' class="form-inline formulario-success">';
?>		
<table class="table table-striped table-condensed table-bordered table-green small" style="font-size:12px">
    <thead>
		<tr>
			<th>Obra:</th>
			<th>Data:</th>
			<th>Numero da Solicitação: </th>
			<th>Observações: </th>
			<th></th>
		</tr>
	</thead>
	<tbody>
  	<?php
        	echo '<tr>';
                echo '<td>'.mysql_result(mysql_query("select * from notas_obras where id = $obra"),0,"descricao").'</td>';
                echo '<td>'.date("d/m/Y", strtotime($data)).'</td>';
				echo '<td><label><input type="text" style="width:100%" name="numero" value="'.$numero.'"  class="form-control input-sm"/></label></td>';
                echo '<td><label><input type="text" style="width:100%" placeholder="Observações" class="form-control input-sm" name="obs" value="'.$obs.'" /></label></td>';
				echo '<td>
							<label style="text-align:center">
								<input type="submit" value="Salvar alterações" class="btn btn-success btn-sm" style="letter-spacing:2px; padding-left:20px; padding-right:20px;">
							</label></td>';
                echo '</tr>';
        ?>
		</tbody>
	</table>
</form>
<form action="javascript:void(0)" id="form1" onSubmit="post('#form1','financeiro/protocolo-filtro.php?obra_2=<?php echo $obra;?>&numerario=<?php echo $id; ?>','.retorno')" class="form-inline formulario-info">
	<table class="table table-striped table-condensed table-bordered table-blue small" style="font-size:12px">
		<thead>
			<tr>
				<th colspan="3">Pesquisar notas fiscais</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<div class="col-xs-12" style="padding:2px">
						<label>
							<input type="text"name="busca" placeholder="Pesquisar numero da nota fiscal" class="form-control input-sm" style="width:100%"/>
						</label> 
					</div>
				</td>
				<td>
					<div class="col-xs-7" style="padding:0px">
						<div class="col-xs-6" style="padding:2px">
							<label style="width:100%">
								<input type="date" name="inicial" value="<?php echo $inicioMes; ?>" max="<?php echo $todayTotal ?>" class="form-control input-sm" style="width:100%" />
							</label>
						</div>
						<div class="col-xs-6" style="padding:2px">
							<label style="width:100%">
								<input type="date" name="final" value="<?php echo $todayTotal; ?>" max="<?php echo $todayTotal ?>" class="form-control input-sm" style="width:100%" />
							</label>
						</div>
					</div>
				</td>
				<td>
					<div class="col-xs-12" style="padding:2px">
						<label style="text-align:center">
							<input type="submit" value="Localizar" class="btn btn-primary btn-sm" style="width:150px">
						</label>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
</form>

<div class="retorno"></div>

<script>ldy("financeiro/itens-adicionados-numerario.php?numerario=<?php echo $id; ?>",".adicionadas")</script>
<div class="adicionadas"></div>

<div class="ajax"></div>
