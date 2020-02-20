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
	if($ac == 'ob3'){
		echo '<label style="width:100%"><small>Equipe: </small></label>';
			echo '<select name="equipe" onChange="$(\'#itens-medicao\').load(\'financeiro/editar-valor-emp.php?ac=select&equipe1=\' + $(this).val() + \'\');"  class="form-control input-sm" style="width:100%" required>';
					echo '<option value="" selected disabled>SELECIONE A EQUIPE</option>';
					$sql = mysql_query("SELECT * FROM equipes WHERE obra IN($obra1) AND emp = '1' ORDER BY nome ASC");
					while($l = mysql_fetch_array($sql)){
						echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>';
					}
			echo '</select>';
		exit;
	}
			if($ac == 'cadastro'){
				if(mysql_num_rows(mysql_query("SELECT * FROM ae_empreiteiro WHERE contrato = '$contratoCadastro' AND data = '$data' AND equipe = '$equipe1'")) > 0) { 
					echo '<div class="alert alert-danger" style="width:100%; padding:20px; margin:0 auto;">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				 			 <strong>Atenção!!!</strong> Medição já está cadastrada no sistema!!!
						</div>';	
					exit; 
				}else{
					$valor_pagar = 0;
					mysql_query("INSERT INTO ae_empreiteiro (contrato, retencao, medicao, data, equipe, valor_pagar, descontos, liquido) VALUES ('$contratoCadastro', '$retencao', '$medicao', '$data', '$equipe1', '$valor_pagar', '$descontos', '$liquido')");
					echo '<div class="alert alert-success" style="width:100%; padding:20px; margin:0 auto;">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				 			 <strong>Sucesso!!!</strong> Medição cadastrado com sucesso!!!
						</div>';
					echo '<script> ldy("financeiro/editar-valor-emp.php?ac=select&equipe1='.$equipe1.'","#itens-medicao"); </script>';
				}
				exit;
			}
			if($ac == 'update'){
				$valor_pagar = 0;
				$query1 = mysql_query("UPDATE ae_empreiteiro SET `contrato`='$contratoInput', `retencao`='$retencao', `medicao`='$medicao', `data`='$data', `valor_pagar`='$valor_pagar', `descontos`='$descontos', `liquido`='$liquido' WHERE id = $id");
				exit;
			}
			if($ac == 'select'){
				
				$cidade_equipe = mysql_result(mysql_query("SELECT obra FROM equipes WHERE id = '$equipe1'"),0,"obra");
				echo '<div class="cadastro-ajax"></div>';
				echo '<div class="alert alert-warning">';
				echo '<h5><strong>Cadastro de novas retenções</strong></h5>';
				echo '<form action="javascript:void(0)" id="formcadastro" onSubmit=\'post("#formcadastro","financeiro/editar-valor-emp.php?ac=cadastro&equipe1='.$equipe1.'",".cadastro-ajax")\' class="form-inline small">';
					
					echo '<table class="table table-bordered table-striped table-min" border="1">';
					echo '<thead>
							<tr>
								<th style="text-align:center"> Equipe </th>
								<th style="text-align:center"> Contrato </th>
								<th style="text-align:center"> Data </th>
								<th style="text-align:center"> Valor Medido</th>
								<th style="text-align:center"> Descontos</th>
								<th style="text-align:center"> Retenção </th>
								<th style="text-align:center"> Liquido</th>
								<th style="text-align:center"> </th>
							</tr>
							</thead>';
					echo '<tr>';
					echo '<td style="width:5%">
							<label class="small" style="width:100%; margin:3px;">
								<input type="text" name="equipe" class="form-control input-sm" value="'.$equipe1.'" style="width:100%" disabled/>
							</label>
						  </td>';
					echo '<td style="width:15%">
							<label class="small" style="width:100%; margin:3px;">
								<select name="contratoCadastro" class="form-control input-sm" style="width:100%" required>';
									echo '<option value="" disabled selected>Selecione um contrato</option>';
									$sql = mysql_query("SELECT * FROM notas_obras WHERE cidade IN(0,'$cidade_equipe') AND status = '0' ORDER BY descricao ASC");
									while($l = mysql_fetch_array($sql)){
										if($c['contrato'] == $l['id']){
											echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>';
										}else{
											echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>';
										}
									}
							echo '</select>
							</label>
						  </td>';
					echo '	<td style="width:10%"> 
								<label for="" style="width:100%">
									<input type="month" name="data" class="form-control input-sm" style="width:100%" required />
								</label>
							</td>';

					/*
					echo '	<td style="width:15%">
								<label class="small" style="width:100%; margin:3px;">
									<input type="number" step="0.01" name="valor_pagar" class="form-control input-sm" style="width:100%" placeholder="R$"/>
								</label>
							</td>';*/
					echo '	<td style="width:15%">
								<label class="small" style="width:100%; margin:3px;">
									<input type="number" step="0.01" name="medicao" class="form-control input-sm" style="width:100%" placeholder="R$" required />
								</label>
							</td>';
					echo '	<td style="width:15%">
								<label class="small" style="width:100%; margin:3px;">
									<input type="number" step="0.01" name="descontos" class="form-control input-sm" style="width:100%" placeholder="R$"/>
								</label>
							</td>';
					echo '	<td style="width:15%">
								<label class="small" style="width:100%; margin:3px;">
									<input type="number" step="0.01" name="retencao" class="form-control input-sm" style="width:100%" placeholder="R$"/>
								</label>
							</td>';
					echo '	<td style="width:15%">
								<label class="small" style="width:100%; margin:3px;">
									<input type="number" step="0.01" name="liquido" class="form-control input-sm" style="width:100%" placeholder="R$"/>
								</label>
							</td>';
					echo '	<td style="width:5%; text-align:center">
								<label class="small" style="width:100%; margin:3px;">
									<button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-ok-circle" style="text-align:center; width:100%"></span> &nbsp; </button>
								</label>
							</td>';
					echo '</tr>';
					echo '</table>';
					echo '</form>';  
				echo '</div>';
				echo '<hr/>';
				$medisql = mysql_query("select * from ae_empreiteiro WHERE equipe = $equipe1 ORDER BY id DESC");
				while($c = mysql_fetch_array($medisql)){
					echo '<form action="javascript:void(0)" id="form'.$c['id'].'" onSubmit=\'post("#form'.$c['id'].'","financeiro/editar-valor-emp.php?ac=update&id='.$c['id'].'",".retorno3")\' class="form-inline small">';
					echo '<table class="table table-bordered table-striped table-min" border="1">';
					echo '<thead>
							<tr>
								<th style="text-align:center"> Equipe </th>
								<th style="text-align:center"> Contrato </th>
								<th style="text-align:center"> Data </th>
								<th style="text-align:center"> Valor Medido</th>
								<th style="text-align:center"> Descontos</th>
								<th style="text-align:center"> Retenção </th>
								<th style="text-align:center"> Liquido</th>
								<th style="text-align:center"> </th>
							</tr>
							</thead>';
					echo '<tr>';
					echo '<td style="width:5%">
							<label class="small" style="width:100%; margin:3px;">
								<input type="text" name="equipe" class="form-control input-sm" value="'.$equipe1.'" style="width:100%" disabled/>
							</label>
						  </td>';
					echo '<td style="width:15%">
							<label class="small" style="width:100%; margin:3px;">
								<select name="contratoInput" class="form-control input-sm" style="width:100%" required>';
									echo '<option value="" disabled selected>Selecione um contrato</option>';
									$sql = mysql_query("SELECT * FROM notas_obras WHERE cidade IN(0,'$cidade_equipe') AND status = '0' ORDER BY descricao ASC");
									while($l = mysql_fetch_array($sql)){
										if($c['contrato'] == $l['id']){
											echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>';
										}else{
											echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>';
										}
									}
							echo '</select>
							</label>
						  </td>';
					echo '	<td style="width:10%"> 
								<label for="" style="width:100%">
									<input type="month" name="data" value="'.$c['data'].'" class="form-control input-sm" style="width:100%" required />
								</label>
							</td>';
					/*		
					echo '	<td style="width:15%">
								<label class="small" style="width:100%; margin:3px;">
									<input type="number" step="0.01" name="valor_pagar" value="'.$c['valor_pagar'].'"  class="form-control input-sm" style="width:100%" placeholder="R$"/>
								</label>
							</td>';*/
					echo '	<td style="width:15%">
								<label class="small" style="width:100%; margin:3px;">
									<input type="number" step="0.01" name="medicao" value="'.$c['medicao'].'"  class="form-control input-sm" style="width:100%" placeholder="R$" required />
								</label>
							</td>';
					echo '	<td style="width:15%">
								<label class="small" style="width:100%; margin:3px;">
									<input type="number" step="0.01" name="descontos" value="'.$c['descontos'].'" class="form-control input-sm" style="width:100%" placeholder="R$"/>
								</label>
							</td>';
					echo '	<td style="width:15%">
								<label class="small" style="width:100%; margin:3px;">
									<input type="number" step="0.01" name="retencao" value="'.$c['retencao'].'" class="form-control input-sm" style="width:100%" placeholder="R$"/>
								</label>
							</td>';
					echo '	<td style="width:15%">
								<label class="small" style="width:100%; margin:3px;">
									<input type="number" step="0.01" name="liquido" value="'.$c['liquido'].'" class="form-control input-sm" style="width:100%" placeholder="R$"/>
								</label>
							</td>';
					echo '	<td style="width:5%; text-align:center">
								<label class="small" style="width:100%; margin:3px;">
									<button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-ok-circle" style="text-align:center; width:100%"></span> &nbsp; </button>
								</label>
							</td>';
					echo '</tr>';
					echo '</table>';
					echo '</form>';  
				}
				exit;
			}

						echo '<label><small>Selecione a obra:</small></label>';
							echo '<select name="cidade" onChange="$(\'#itens-obra\').load(\'financeiro/editar-valor-emp.php?ac=ob3&obra1=\' + $(this).val() + \'\');"class="form-control input-sm" style="width:100%" required>';
							echo '<option value="" selected disabled>SELECIONE A OBRA</option>';
							$sql = mysql_query("SELECT * FROM notas_obras_cidade WHERE id IN($cidade_usuario) ORDER BY nome ASC");
							while($l = mysql_fetch_array($sql)){
								if($l['id'] == $cidade1){
									echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>';
								}else{
									echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>';
								}
							}
							echo '</select>';			
					echo '<label id="itens-obra" style="width:100%;">';
						echo '<label style="width:100%"><small>Equipe: </small></label>';
						echo '<select name="equipe" onChange="$(\'#itens-medicao\').load(\'financeiro/editar-valor-emp.php?ac=select&equipe1=\' + $(this).val() + \'\');" class="form-control input-sm" style="width:100%" required disabled>';
							echo '<option value="" selected disabled>SELECIONE A EQUIPE</option>';
							$sql = @mysql_query("SELECT * FROM equipes WHERE obra = '$obra1' AND emp = '1' ORDER BY descricao ASC");
							while($l = @mysql_fetch_array($sql)){
								if($l['id'] == $equipe1){
									echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>';
								}else{
									echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>';
								}
							}
						echo '</select>';
					echo '</label>';
	?>
	

<div id="itens-medicao"></div>
<div class="retorno3"></div>