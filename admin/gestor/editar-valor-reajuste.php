<?php
include("../config.php");
include("../validar_session.php");
date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_MONETARY,"pt_BR", "ptb");
$today = getdate(); 

	if($today['mon'] < 10) { 
		$today['mon'] = '0'.$today['mon'];
	} else { 
		$today['mon'] = $today['mon'];
	} 
	if($today['mday'] < 10){ 
		$today['mday'] = '0'.$today['mday']; 
	}else{ 
		$today['mday'] = $today['mday']; 
	}  
	$todayTotal = $today['year'].'-'.$today['mon'].'-'.$today['mday'];
	$inicioMes = $today['year'].'-'.$today['mon'].'-01';
?>
<div class="retorno"></div>
	<?php
		if(isset($ac)){
			if($ac == 'update'){
				$obr = mysql_num_rows(mysql_query("SELECT * FROM ae_reajuste WHERE obra = $obra"));
				if($obr != 0){
					mysql_query("UPDATE ae_reajuste SET `desembolso_d`='$desembolso_d', `desembolso_i`='$desembolso_i', `reajuste_d`='$reajuste_d', `reajuste_i`='$reajuste_i' WHERE obra = $obra");
				}else{
					mysql_query("INSERT INTO ae_reajuste (obra, desembolso_d, desembolso_i, reajuste_d, reajuste_i) VALUES ($obra, $desembolso_d, $desembolso_i, $reajuste_d, $reajuste_i)");
				}
				exit;	
			}
			if($ac == 'select'){
				$medisql = mysql_query("select * from ae_reajuste WHERE obra = $obra");
				$c = mysql_fetch_array($medisql);
			}
		}
			echo '<div id="itens">';
			echo '<form action="javascript:void(0)" id="form'.$id.'" onSubmit=\'post("#form'.$id.'","gestor/editar-valor-reajuste.php?ac=update",".retorno")\' class="form-inline small">';
			echo '<table class="table table-bordered table-striped table-min" border="1">';
			echo '<thead><tr>
					<th style="text-align:center">Obra</th>
					<th style="text-align:center">Desembolso (Despesa)</th>
					<th style="text-align:center">Desembolso (Investimento)</th>
					<th style="text-align:center">Reajuste (Despesa)</th>
					<th style="text-align:center">Reajuste (Investimento)</th>
					</tr></thead>';
			echo '<tr>';
			echo '	<td style="width:25%">
						<label class="small" style="width:100%; margin:3px;">';
							echo '<select name="obra" onChange="$(\'#itens\').load(\'gestor/editar-valor-reajuste.php?ac=select&obra=\' + $(this).val() + \'\');" class="form-control input-sm" style="width:100%" required>';
							echo '<option value="" selected disabled>S/OBRA</option>';
							$sql = mysql_query("SELECT * FROM notas_obras WHERE id IN($obra_usuario) ORDER BY descricao ASC");
							while($l = mysql_fetch_array($sql)){
								if($l['id'] == $c['obra']){
									echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>';
								}else{
									echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>';
								}
							}
							echo '</select>
						</label>
					</td>';
				echo '	<td style="width:20%">
							<label class="small" style="width:100%; margin:3px;">
								<input type="number" step="0.01" value="'.$c['desembolso_d'].'" name="desembolso_d" class="form-control input-sm" style="width:100%" placeholder="R$" required />
							</label>
						</td>';
				echo '	<td style="width:20%">
							<label class="small" style="width:100%; margin:3px;">
								<input type="number" step="0.01" value="'.$c['desembolso_i'].'" name="desembolso_i" class="form-control input-sm" style="width:100%" placeholder="R$" required />
							</label>
						</td>';
				echo '	<td style="width:20%">
							<label class="small" style="width:100%; margin:3px;">
								<input type="number" step="0.01" value="'.$c['reajuste_d'].'" name="reajuste_d" class="form-control input-sm" style="width:100%" placeholder="R$" required />
							</label>
						</td>';
				echo '	<td style="width:20%">
							<label class="small" style="width:100%; margin:3px;">
								<input type="number" step="0.01" value="'.$c['reajuste_i'].'" name="reajuste_i" class="form-control input-sm" style="width:100%" placeholder="R$" required />
							</label>
						</td>';
			echo '	<td style="width:9%; text-align:center">
						<label class="small" style="width:100%; margin:3px;">
							<button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-ok-circle" style="text-align:center; width:100%"></span> &nbsp; </button>
						</label>
					</td>';
			echo '</tr>';
			echo '</table>';
			echo '</form>';  
			echo '</div>';
	?>