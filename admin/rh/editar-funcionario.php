<?php
	require_once("../config.php");
	require_once("../validar_session.php");
	getData();
	getNivel();
?>
<script src="../js/combobox-resume.js"></script>
<?php
	if($situ_tipo == 'demi'){
		if($situacao == 1){
			echo '<div class="col-md-2" style="padding:3px;">';
				echo '<label style="width:100%">Demissão: ';
				echo '<input type="date" name="demissao" class="form-control input-sm" value="'.$demissao.'" required />';
				echo '</label>';
			echo '</div>';
			echo '<div class="col-md-4" style="padding:3px;">';
				echo '<label style="width:100%">Deficiencia: ';
				echo '<input type="text" name="deficiencia" class="form-control input-sm" value="'.$deficiencia.'" disabled />';
				echo '</label>';
			echo '</div>';
		}else if ($situacao == 12){
			echo '<div class="col-md-2" style="padding:3px;">';
				echo '<label style="width:100%">Demissão: ';
				echo '<input type="date" name="demissao" class="form-control input-sm" value="'.$demissao.'" disabled/>';
				echo '</label>';
			echo '</div>';
			echo '<div class="col-md-4" style="padding:3px;">';
				echo '<label style="width:100%">Deficiencia: ';
				echo '<input type="text" name="deficiencia" class="form-control input-sm" value="'.$deficiencia.'" required/>';
				echo '</label>';
			echo '</div>';
		}else{
			echo '<div class="col-md-2" style="padding:3px;">';
				echo '<label style="width:100%">Demissão: ';
				echo '<input type="date" name="demissao" class="form-control input-sm" value="'.$demissao.'" disabled/>';
				echo '</label>';
			echo '</div>';
			echo '<div class="col-md-4" style="padding:3px;">';
				echo '<label style="width:100%">Deficiencia: ';
				echo '<input type="text" name="deficiencia" class="form-control input-sm" value="'.$deficiencia.'" disabled />';
				echo '</label>';
			echo '</div>';
		}
		exit;
	}
	if($city=='ok'){
		$cidade_obra = mysql_result(mysql_query("SELECT cidade FROM notas_obras WHERE id = $obra_2"),0,"cidade");
		echo '<label style="width:100%">Equipe: <br/>
				<select name="equipe" class="form-control input-sm combobox" required>
					<option value="" selected disabled>Selecione uma equipe</option>';
						$sss = mysql_query("select * from equipes WHERE obra = '$cidade_obra' AND status = '0' order by nome asc"); 
						while($l = mysql_fetch_array($sss)) {
							if($equipe==$l['id']) {
								echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>'; 
							} else { 
								if($equipe == '0' || $acesso_login == 'MASTER'){
									echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>'; 
								}
							}
						}
						echo '	</select>
						</label>';	
		exit;
	}
	if($city=='ok2'){
		$cidade_obra = mysql_result(mysql_query("SELECT cidade FROM notas_obras WHERE id = $obra_2"),0,"cidade");
		echo '<label style="width:100%">Equipe: <br/>
				<select name="equipe" class="form-control input-sm combobox" required>
					<option value="" selected disabled>Selecione uma equipe</option>';
						$sss = mysql_query("select * from equipes WHERE (obra = '$cidade_obra' OR emp = '1') AND status = '0' order by nome asc"); 
						while($l = mysql_fetch_array($sss)) {
							if($equipe==$l['id']) {
								echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>'; 
							} else { 
								if($equipe == '0' || $acesso_login == 'MASTER'){
									echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>'; 
								}
							}
						}
						echo '	</select>
						</label>';	
		exit;
	}
	if($casado == 'ok'){
		if($casado_brasileira == 'SIM'){
			echo '
					Nome do conjuge: 
					<input type="text" name="nome_conjuge" value="'.$nome_conjuge.'" class="form-control input-sm" required/>
							';
		}else{
			echo '
					Nome do conjuge: 
					<input type="text" name="nome_conjuge" value="&nbsp;" class="form-control input-sm" disabled/>
							';
		}
		exit;
	}
	if(@$ac == 'update0') {
		$query = mysql_query("UPDATE `rh_funcionarios` SET `nome`='$nome',`equipe`='$equipe', `funcao`='$funcao',`exp`='$exp',`expdias`='$expdias',`admissao`='$admissao', `demissao`='$demissao',`numero_ordem`='$numero_ordem',`numero_matricula`='$numero_matricula',`nome_pai`=UPPER('$nome_pai'),`nome_mae`=UPPER('$nome_mae'),`nacionalidade_pai`='$nacionalidade_pai',`nacionalidade_mae`='$nacionalidade_mae',`nascimento`='$nascimento',`nacionalidade`='$nacionalidade',`estado_civil`='$estado_civil',`local_nascimento`='$local_nascimento',`estado`='$estado',`rg`='$rg',`carteira_profissional`='$carteira_profissional',`serie`='$serie',`carteira_reservista`='$carteira_reservista',`carteira_reservista_categoria`='$carteira_reservista_categoria',`cpf`='$cpf',`titulo_eleitor`='$titulo_eleitor',`carteira_saude`='$carteira_saude',`tem_filhos_brasileiros`='$tem_filhos_brasileiros',`grau_instrucao`='$grau_instrucao',`nome_conjuge`='$nome_conjuge',`quantidade_filhos`='$quantidade_filhos',`endereco`='$endereco',`cidade_servico`='$cidade_servico',`pis_cadastro`='$pis_cadastro',`pis_numero`='$pis_numero',`pis_banco`='$pis_banco',`pis_endereco`='$pis_endereco',`pis_numbanco`='$pis_numbanco',`pis_agencia`='$pis_agencia',`data_registro`='$data_registro',`comissoes`='$comissoes',`tarefa`='$tarefa',`forma_pagamento`='$forma_pagamento',`optante_fgts`='$optante_fgts',`data_opcao_fgts`='$data_opcao_fgts',`data_retratacao_fgts`='$data_retratacao_fgts',`banco_depositario`='$banco_depositario',`vale_transporte`='$vale_transporte',`vale_qtd`='$vale_qtd',`vale_empresa`='$vale_empresa',`vale_empresa2`='$vale_empresa2',`trabalho_periodo`='$trabalho_periodo',`trabalho_entrada`='$trabalho_entrada',`trabalho_refeicao`='$trabalho_refeicao',`trabalho_saida`='$trabalho_saida',`trabalho_periodo2`='$trabalho_periodo2',`trabalho_entrada2`='$trabalho_entrada2',`trabalho_refeicao2`='$trabalho_refeicao2',`trabalho_saida2`='$trabalho_saida2',`vale_alimentacao`='$vale_alimentacao',`vale_refeicao`='$vale_refeicao', `cnh`='$cnh', `venc_cnh`='$venc_cnh', `categoria_cnh`='$categoria_cnh',`obra` ='$obra',`telefone`='$telefone',`celular`='$celular',`situacao`='$situacao', `vale_qtd2`='$vale_qtd2', `casado_brasileira`='$casado_brasileira', `naturalizado`='$naturalizado', `trabalho_descanso`='$trabalho_descanso', `deficiencia`='$deficiencia', `adm`='$adm', `adm_obs`='$adm_obs', `tipo_emp`='$tipo_emp' WHERE id = '$id'");		
		if($query) { 
			echo "<script>alert('INFORMACOES ATUALIZADAS COM SUCESSO!!!');</script>"; 
		} else { 
			echo "<script>alert('".mysql_error()."');</script>"; 
		}
		exit;
	} 	
	if(@$ac == 'update1') {
		$query = mysql_query("UPDATE `rh_funcionarios` SET `nome`='$nome',`equipe`='$equipe', `admissao`='$admissao', `demissao`='$demissao', `rg`='$rg', `cpf`='$cpf', `cidade_servico`='$cidade_servico', `obra` ='$obra', `telefone`='$telefone', `celular`='$celular', `situacao`='$situacao', `deficiencia`='$deficiencia', `adm`='$adm', `adm_obs`='$adm_obs', `tipo_emp`='$tipo_emp', `funcao`='$funcao', `empresa_emp`='$empresa_emp' WHERE id = '$id'");		
		if($query) { 
			echo "<script>alert('INFORMACOES ATUALIZADAS COM SUCESSO!!!');</script>"; 
		} else { 
			echo "<script>alert('".mysql_error()."');</script>"; 
		}
		exit;
	} 
	$sql = mysql_query("select * from rh_funcionarios where id = '$id'"); 
	while($l=mysql_fetch_array($sql)) { 
		extract($l); 
		if($trabalho_entrada=='') { $trabalho_entrada = '07:00'; } 
		if($trabalho_refeicao=='') { $trabalho_refeicao = '12:00 - 13:00'; } 
		if($trabalho_saida=='') { $trabalho_saida = '17:00'; } 
		if($trabalho_periodo=='') { $trabalho_periodo = 'SEG a QUI'; } 
		
		if($trabalho_entrada2=='') { $trabalho_entrada2 = '07:00'; } 
		if($trabalho_refeicao2=='') { $trabalho_refeicao2 = '12:00 - 13:00'; } 
		if($trabalho_saida2=='') { $trabalho_saida2 = '16:00'; } 
		if($trabalho_periodo2=='') { $trabalho_periodo2 = 'SEXTA'; } 
		
		if($trabalho_descanso=='') { $trabalho_descanso = 'SAB/DOM'; } 
		
		if($pis_banco=='') { $pis_banco = 'C.E.F'; }
		if($pis_endereco=='') { $pis_endereco = 'AV. NOVE DE JULHO, 194 - SJCAMPOS/SP'; }
		if($pis_numbanco=='') { $pis_numbanco = '104'; }
		if($pis_agencia=='') { $pis_agencia = '1400'; }
		if($banco_depositario=='') { $banco_depositario = 'CAIXA ECONOMICA FEDERAL'; }
		if($optante_fgts=='') { $optante_fgts = 'SIM'; }
		if($forma_pagamento=='') { $forma_pagamento = 'MENSAL'; }
		if($vale_alimentacao=='') { $vale_alimentacao = 164.86 ; }
		if($vale_refeicao=='') { $vale_refeicao = 17.58 ; }
		if($vale_empresa=='') { $vale_empresa = '0'; }
	}
	if($tipo_emp2 == ''){
		$tipo_emp2 = $tipo_emp;
	}
	if($tipo_emp2 == "0") { 
		$tipo_emp = $tipo_emp2;
	?>
	<form action="javascript:void(0)" onSubmit="post(this,'rh/editar-funcionario.php?ac=update0&id=<?php echo $id ?>','.ajax');" class="small formulario-info" enctype="multipart/form-data" style="font-size:11px">
		<div class="panel panel-info">
			<div class="panel-heading" style="font-weight:bold; text-align:center; font-family: 'Oswald', sans-serif; letter-spacing:3px;">DADOS CADASTRAIS <span class="pull-right"><small>id:</small><?= $id ?></span></div>
			<div class="panel-body">
				<div class="col-md-2">
					<div style="position:relative; top:0px;">
						<?php
							if($imagem=='') { 
								echo '<img src="rh/imagens/sem_foto.png" width="100%" class="img-rounded" style="border:1px solid #D9EDF7">';
							} else { 
								echo '<img src="rh/imagens/'.$imagem.'" width="100%" class="img-rounded"  style="border:1px solid #D9EDF7">'; 
							}			
						?>
						<a href="#" class="btn btn-info btn-xs" style="font-size:13px; padding:5px; position:absolute; bottom:5px; right:5px; font-family: 'Oswald', sans-serif; letter-spacing:3px;" onClick='window.open("rh/editar-imagem.php?id=<?php echo $id ?>", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=100, left=500, width=500, height=500")'><span class="glyphicon glyphicon-picture"></span> Alterar </a>
					</div>
					<p style="text-align:center; width:100%; margin-top:20px;"><b>Tipo de funcionario:</b></p>
					<div class="col-md-12" style="padding:0px; text-align:center">
						<div class="col-md-6" style="padding:3px;  text-align:center">
							<input type="radio" name="tipo_emp" value="0" onChange="$('.retorno').load('rh/editar-funcionario.php?id=<?php echo $id ?>&tipo_emp2=' + $(this).val() + '');" style="height: 19px; width: 19px;" checked>
							<small style="font-size:15px; position:relative; bottom:3px; font-weight:bold; font-family: 'Oswald', sans-serif;">Funcionário</small>
						</div>
						<div class="col-md-6" style="padding:3px; text-align:center">
							<input type="radio" name="tipo_emp" value="1" onChange="$('.retorno').load('rh/editar-funcionario.php?id=<?php echo $id ?>&tipo_emp2=' + $(this).val() + '');" style="margin-left:10px; height: 19px; width: 19px;">
							<small style="font-size:15px; position:relative; bottom:3px; font-weight:bold; font-family: 'Oswald', sans-serif;">Empresa</small>
						</div>
					</div>
					<div class="col-md-12" style="padding:0px; text-align:center">
						<a href="#" onclick='$("#myModal2").modal("show"); ldy("rh/imprimir-contratos.php?id=<?php echo $id;?>",".modal-body")' style="margin-top:20px; width: 100%; height:40px; padding-top:5px; font-size:15px; font-family: 'Oswald', sans-serif; letter-spacing:3px;" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-print"></span> Impressão</a>
					</div>
				</div>
				<div class="col-md-10">
					<div class="col-md-8" style="padding:3px">
						<label style="width:100%">
							Nome Completo: 
							<input type="text" name="nome" value="<?php echo $nome ?>" class="form-control input-sm" required />
						</label>
					</div>
					<div class="col-md-2" style="padding:3px">
						<label style="width:100%">
							N° Ordem: 
							<input type="text" name="numero_ordem" value="<?php echo $numero_ordem ?>" class="form-control input-sm" />
						</label>
					</div>
					<div class="col-md-2" style="padding:3px">
						<label style="width:100%">
							N° Matrícula:
							<input type="text" name="numero_matricula" value="<?php echo $numero_matricula ?>" class="form-control input-sm" />
						</label>
					</div>
					<div class="col-md-4" style="padding:3px">
						<label style="width:100%">Situação: <br/>
							<select class="form-control input-sm" name="situacao" onChange="$('.item-situ').load('rh/editar-funcionario.php?situ_tipo=demi&situacao=' + $(this).val() + '');">
								<?php 
									$situacoes = mysql_query("select * from rh_situacao where status = '0' AND id <> '0' order by ordem asc"); 
									while($l=mysql_fetch_array($situacoes)) {
										if($situacao==$l['id']){ 
											echo '<option value="'.$l['id'].'" style="color:#EC971F" selected>'.$l['descricao'].' *** </option>'; 
										} else { 
											echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>';
										}  
									} 
								?>	
							</select>
						</label>
					</div>
					<div class="col-md-4" style="padding:3px">
						<label style="width:100%">Obra/Contrato:
							<select class="form-control input-sm" name="obra" style="width:100%" onChange="$('#itens-rh').load('rh/editar-funcionario.php?city=ok&obra_2=' + $(this).val() + '');">
							<?php 
								$obras = mysql_query("select * from  notas_obras WHERE id IN(0,$obra_usuario) order by descricao asc"); 
								while($l=mysql_fetch_array($obras)) {
									if($obra==$l['id']) { 
										echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>'; 
									} else { 
										if($acesso_login == 'MASTER' || $acesso_login == 'MODERADOR'){
											echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>'; 
										}
									} 
								}  	
							?>		
							</select>
						</label>
					</div>
					<div class="col-md-4" style="padding:3px">
						<label id="itens-rh" style="width:100%">
							<label style="width:100%">Equipe: <br/>
								<select name="equipe" class="form-control input-sm combobox" style="width:100%" required>
									<option value="" selected disabled>Selecione uma equipe</option>
									<?php
									$cidade_2 = mysql_result(mysql_query("SELECT cidade FROM notas_obras WHERE id = $obra"),0,"cidade");
									$sss = mysql_query("select * from equipes WHERE obra = '$cidade_2' AND status = '0' order by nome asc"); 
									while($l = mysql_fetch_array($sss)) {
										if($equipe==$l['id']) {
											echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>'; 
										} else { 
											if($equipe == '0' || $acesso_login == 'MASTER'){
												echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>'; 
											}
										}
									}
									?>
								</select>
							</label>	
						</label>
					</div>
					<div class="col-md-6" style="padding:0px;">
						<div class="col-md-9" style="padding:3px">
							<label style="width:100%">
								Pai: <input type="text" name="nome_pai" value="<?php echo $nome_pai ?>" class="form-control input-sm" size="30" />
							</label>
						</div>
						<div class="col-md-3" style="padding:3px">
							<label style="width:100%">
								Nacionalidade: <input type="text" name="nacionalidade_pai" value="<?php echo $nacionalidade_pai ?>" class="form-control input-sm" />
							</label>
						</div>
						<div class="col-md-9" style="padding:3px">
							<label style="width:100%">
								Mãe: <input type="text" name="nome_mae" value="<?php echo $nome_mae ?>" class="form-control input-sm up" />
							</label>
						</div>
						<div class="col-md-3" style="padding:3px">
							<label style="width:100%">
								Nacionalidade: <input type="text" name="nacionalidade_mae" value="<?php echo $nacionalidade_mae ?>" class="form-control input-sm" />
							</label>
						</div>
						<div class="col-md-3" style="padding:3px">
							<label style="width:100%">Casado:
								<select name="casado_brasileira" onChange="$('#itens-casado').load('rh/editar-funcionario.php?casado=ok&nome_conjuge=<?php echo $nome_conjuge; ?>&casado_brasileira=' + $(this).val() + '');" class="form-control input-sm" required>
									<?php 
										if($casado_brasileira == "SIM"){
											echo '<option value="SIM" selected>SIM</option>';
											echo '<option value="NÃO">NÃO</option>';
										}else{
											echo '<option value="SIM">SIM</option>';
											echo '<option value="NÃO" selected>NÃO</option>';
										}
									?>
								</select>
							</label>
						</div>
						<div class="col-md-9" style="padding:3px">
							<label id="itens-casado" style="width:100%">
								<?php
									if($casado_brasileira == 'SIM'){
										echo '
												Nome do conjuge: 
												<input type="text" name="nome_conjuge" value="'.$nome_conjuge.'" class="form-control input-sm" required/>
														';
									}else{
										echo '
												Nome do conjuge: 
												<input type="text" name="nome_conjuge" value="&nbsp;" class="form-control input-sm" disabled/>
														';
									}
								?>
							</label>
						</div>
						<div class="col-md-3" style="padding:3px">
							<label style="width:100%">Filhos Brasileiros?
								<select name="tem_filhos_brasileiros" class="form-control input-sm" required>
									<?php 
										if($tem_filhos_brasileiros == "SIM"){
											echo '<option value="SIM" selected>SIM</option>';
											echo '<option value="NÃO">NÃO</option>';
										}else{
											echo '<option value="SIM">SIM</option>';
											echo '<option value="NÃO" selected>NÃO</option>';
										}
									?>
								</select>
							</label>
						</div>
						<div class="col-md-3" style="padding:3px">
							<label style="width:100%">Quantos filhos:
								<select name="quantidade_filhos" class="form-control input-sm" required>
									<?php 
										for($fil = 0; $fil<=6; $fil++){
											if($quantidade_filhos == $fil){
												echo '<option value="'.$fil.'" selected>'.$fil.'</option>'; 
											}else{
												echo '<option value="'.$fil.'">'.$fil.'</option>'; 
											}
										}
									?>
								</select>
							</label>
						</div>
						<div class="col-md-3" style="padding:3px">
							<label style="width:100%">
								Residencial:
								<input type="text" name="telefone" value="<?php echo $telefone ?>" class="form-control input-sm" placeholder="(__)____-____" onFocus="$(this).mask('(99)9999-9999')" />
							</label>
						</div>
						<div class="col-md-3" style="padding:3px">
							<label style="width:100%">
								Celular:
								<input type="text" name="celular" value="<?php echo $celular ?>" class="form-control input-sm" placeholder="(__)_____-____" onFocus="$(this).mask('(99)99999-999?9')" />
							</label>
						</div>
					</div>
					<div class="col-md-6" style="padding:0px;">
						<div class="col-md-3" style="padding:3px">
							<label style="width:100%">
								Data Nascimento: 
								<input type="date" name="nascimento" value="<?php echo $nascimento ?>" class="form-control input-sm"/>
							</label>
						</div>
						<div class="col-md-3" style="padding:3px">
							<label style="width:100%">
								Local nascimento:
								<input type="text" name="local_nascimento" value="<?php echo $local_nascimento ?>" class="form-control input-sm"/>
							</label>
						</div>
						<div class="col-md-3" style="padding:3px">
							<label style="width:100%">
								Nacionalidade: 
								<input type="text" name="nacionalidade" value="<?php echo $nacionalidade ?>" class="form-control input-sm" />
							</label>
						</div>
						<div class="col-md-3" style="padding:3px">
							<label style="width:100%"> 
								Estado Civíl: 
								<select class="form-control input-sm" name="estado_civil" value="<?php echo $estado_civil ?>">
									<?php 
										$estadosc = mysql_query("select * from  rh_estado_civil order by descricao asc"); 
										while($l=mysql_fetch_array($estadosc)) {
											if($estado_civil==$l['id']) { 
												echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>'; 
											} else { 
												echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>';
											} 	
										}  	
									?>		
								</select>
							</label>
						</div>
						<div class="col-md-3" style="padding:3px">
							<label style="width:100%">
								Estado: <input type="text" name="estado" value="<?php echo $estado ?>" class="form-control input-sm"/>
							</label>	
						</div>
						<div class="col-md-3" style="padding:3px">
							<label style="width:100%">
								Identidade (RG): <input type="text" name="rg" placeholder="__.___.___-_" value="<?php echo $rg ?>" class="form-control input-sm" />
							</label>	
						</div>
						<div class="col-md-3" style="padding:3px">
							<label style="width:100%">
								CPF:<input type="text" name="cpf" onFocus="$(this).mask('999.999.999-99')" value="<?php echo $cpf ?>" class="form-control input-sm"/>
							</label>
						</div>
						<div class="col-md-3" style="padding:3px">
							<label style="width:100%">
								C. Profissional: <input type="text" name="carteira_profissional" value="<?php echo $carteira_profissional ?>" class="form-control input-sm" />
							</label>	
						</div>
						<div class="col-md-3" style="padding:3px">
							<label style="width:100%">
								Série:<input type="text" name="serie" value="<?php echo $serie ?>" class="form-control input-sm" />
							</label>
						</div>
						<div class="col-md-3" style="padding:3px">
							<label style="width:100%">
								Reservista: <input type="text" name="carteira_reservista" value="<?php echo $carteira_reservista ?>" class="form-control input-sm" />
							</label>
						</div>
						<div class="col-md-3" style="padding:3px">
							<label style="width:100%">
								Categoria: <input type="text" name="carteira_reservista_categoria" value="<?php echo $carteira_reservista_categoria ?>" class="form-control input-sm" />
							</label>
						</div>
						<div class="col-md-3" style="padding:3px">
							<label style="width:100%">
								Titulo de Eleitor:<input type="text" name="titulo_eleitor" onFocus="$(this).mask('999999999?9999')" value="<?php echo $titulo_eleitor ?>" class="form-control input-sm" maxlength="13" />
							</label>
						</div>
						<div class="col-md-3" style="padding:3px">
							<label style="width:100%">
								Carteira de Saúde:<input type="text" name="carteira_saude" value="<?php echo $carteira_saude ?>" class="form-control input-sm" />
							</label>
						</div>
						<div class="col-md-3" style="padding:3px">
							<label style="width:100%">Naturalizado?
								<select name="naturalizado" class="form-control input-sm" required>
									<?php 
										if($naturalizado == "SIM"){
											echo '<option value="SIM" selected>SIM</option>';
											echo '<option value="NÃO">NÃO</option>';
										}else{
											echo '<option value="SIM">SIM</option>';
											echo '<option value="NÃO" selected>NÃO</option>';
										}
									?>
								</select>
							</label>
						</div>
						<div class="col-md-3" style="padding:3px">
							<label style="width:100%">Grau de instrução: 
								<select class="form-control input-sm" name="grau_instrucao">
								<?php 
										$sql = mysql_query("select * from rh_grau_escolaridade order by id asc"); 
										while($l=mysql_fetch_array($sql)) {
											if($grau_instrucao==$l['id']) { 
												echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>'; 
											}else { 
												echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>';
											} 	
										}  	
								?>		
								</select>
							</label>	
						</div>
						<div class="col-md-3" style="padding:3px">
							<label style="width:100%">
								Cidade de serviço: 
								<select name="cidade_servico" class="form-control input-sm" required>
									<?php 
										$cidade = mysql_query("SELECT * FROM cidade");
										while($c = mysql_fetch_array($cidade)){
											if($c['nome'] == $cidade_servico){
												echo '<option value="'.$c['nome'].'" selected>'.$c['nome'].'</option>';
											}else{
												echo '<option value="'.$c['nome'].'">'.$c['nome'].'</option>';
											}
										}
									?>
								</select>
							</label>
						</div>
					</div>
					<div class="col-md-12" style="padding:0px;">
						<label style="width:100%">
							Endereço Completo: <input type="text" name="endereco" value="<?php echo $endereco ?>" class="form-control input-sm"/>
						</label>
					</div>
					<div class="col-md-12" style="padding:0px;">
						<label style="width:100%">Obs:
							<textarea name="adm_obs" class="form-control input-sm" style="resize:none; text-align:left"><?php echo $adm_obs; ?></textarea>
						</label>
					</div>
				</div>
			</div>
		</div>
		<!-- INFORMAÇÕES DO CARGO -->
		<div class="row">
			<div class="col-md-8">
				<div class="panel panel-info">
					<div class="panel-heading" style="font-weight:bold; text-align:center; font-family: 'Oswald', sans-serif; letter-spacing:3px;">INFORMAÇÕES DO CARGO</div>
					<div class="panel-body">
						<div class="col-md-12" style="padding:0px;">
						<div class="col-md-6" style="padding:3px;">
							<label style="width:100%">Cargo: <br/>
								<select class="form-control input-sm combobox" name="funcao">
									<option value="0"></option>
										<?php 
											$funcoes = mysql_query("select * from rh_funcoes where status = '0' order by descricao asc"); while($l=mysql_fetch_array($funcoes)) {
												if($funcao==$l['id']) { echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>'; }
												else { echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>'; }  	
											} 
										?>	
								</select>
							</label>
						</div>
						<div class="col-md-2" style="padding:3px;">
							<label style="width:100%">Salario:<br/>
								<input type="text" name="salario" class="form-control input-sm" value="<?php echo number_format(mysql_result(mysql_query("select salario from rh_funcoes WHERE id = $funcao order by descricao asc"),0,"salario"),2,",",".");?>" disabled />
							</label>
						</div>
						<div class="col-md-2" style="padding:3px;">
							<label style="width:100%">Experiência:<br/>
								<select class="form-control input-sm" name="exp">
								<?php  
								if($exp==0){
									echo '<option value="1">SIM</option>';
									echo '<option value="0" selected>NÃO</option>';
								}else{
									echo '<option value="1" selected>SIM</option>';
									echo '<option value="0">NÃO</option>';
								}
								?>
								</select>
							</label>
						</div>
						<div class="col-md-2" style="padding:3px;">						
							<label style="width:100%">Dias da Experiência: <br/>
								<select class="form-control input-sm" name="expdias" >
									<?php 
									if($expdias == '1'){
										echo '
										
										<option value="0">Sem Exp</option>
										<option value="1" selected>45+45</option>
										<option value="2">30+60</option>
										';
									}else if($expdias == '2'){
										echo '
										
										<option value="0">Sem Exp</option>
										<option value="1">45+45</option>
										<option value="2" selected>30+60</option>
										';
									}else{
										echo '
										<option value="0">Sem Exp</option>
										<option value="1">45+45</option>
										<option value="2">30+60</option>
										';
									}
									?>
								</select>
							</label>
						</div>
					</div>
						<div class="col-md-2" style="padding:3px;">	
							<label style="width:100%">Comissões: 
								<input type="number" step="0.1" name="comissoes" class="form-control input-sm" value="<?php echo $comissoes ?>" />
							</label>
						</div>
						<div class="col-md-2" style="padding:3px;">	
							<label style="width:100%">Tarefa: 
								<input type="text" name="tarefa" class="form-control input-sm" value="<?php echo $tarefa ?>">
							</label>
						</div>
						<div class="col-md-2" style="padding:3px;">	
							<label style="width:100%">F. Pagamento: 
								<input type="text" name="forma_pagamento" class="form-control input-sm"  size="10" value="<?php echo $forma_pagamento ?>">
							</label>
						</div>
						<div class="col-md-2" style="padding:3px;">	
							<label style="width:100%">CNH: 
								<input type="text" name="cnh" class="form-control input-sm"  size="15" value="<?php echo $cnh ?>">
							</label>	
						</div>
						<div class="col-md-2" style="padding:3px;">		
							<label style="width:100%">Venc CNH: 
								<input type="date" name="venc_cnh" class="form-control input-sm"  size="15" value="<?php echo $venc_cnh ?>">
							</label>	
						</div>
						<div class="col-md-2" style="padding:3px;">		
							<label style="width:100%">Categoria CNH:
								<input type="text" name="categoria_cnh" class="form-control input-sm"  size="5" value="<?php echo $categoria_cnh ?>">
							</label>
						</div>
						<div class="col-md-2" style="padding:3px;">	
							<label style="width:100%">Admissão: 
								<input type="date" name="admissao" class="form-control input-sm" value="<?php echo $admissao ?>" required />
							</label>
						</div>
						<div class="col-md-2" style="padding:3px;">	
							<label style="width:100%">Registro: 
								<input type="date" name="data_registro" class="form-control input-sm" value="<?php echo $data_registro ?>" required />
							</label>
						</div>
						<div class="item-situ">
							<div class="col-md-2" style="padding:3px;">	
								<label style="width:100%">Demissão: 
									<?php 
									if($situacao == 1){
										echo '<input type="date" name="demissao" class="form-control input-sm" value="'.$demissao.'" required/>';
									}else{
										echo '<input type="date" name="demissao" class="form-control input-sm" value="" disabled/>';
										echo '<input type="hidden" name="demissao" value="0000-00-00">';
									}
									?>
								</label>
							</div>
							<div class="col-md-4" style="padding:3px;">	
								<label style="width:100%">Deficiencia: 
									<?php 
									if($situacao == 12){
										echo '<input type="text" name="deficiencia" class="form-control input-sm" value="'.$deficiencia.'" />';
									}else{
										echo '<input type="text" name="deficiencia" class="form-control input-sm" value="'.$deficiencia.'"  disabled />';
										echo '<input type="hidden" name="deficiencia" value="NENHUMA">';
									}
									?>
								</label>
							</div>
						</div>
						<div class="col-md-2" style="padding:3px;">	
							<label style="width:100%">Administrativo:
								<select name="adm" class="form-control input-sm">
									<?php 
										if($adm == '1'){
											echo '<option value="0">NÃO</option>';
											echo '<option value="1" selected>SIM</option>';
										}else{
											echo '<option value="1">SIM</option>';
											echo '<option value="0" selected>NÃO</option>';
										}
									?>
								</select>
							</label>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-info">
				<div class="panel-heading" style="font-weight:bold; text-align:center; font-family: 'Oswald', sans-serif; letter-spacing:3px;">BENEFICIOS</div>
					<div class="panel-body">
						<div class="col-md-6" style="padding:0px;">
							<div class="col-md-12" style="padding:3px;">
								<label style="width:100%">Vale Trans.:?
									<select name="vale_transporte" class="form-control input-sm">
										<?php 
											if($vale_transporte == "SIM"){
												echo '<option value="SIM" selected>SIM</option>';
												echo '<option value="NÃO">NÃO</option>';
											}else{
												echo '<option value="SIM">SIM</option>';
												echo '<option value="NÃO" selected>NÃO</option>';
											}
										?>
									</select>
								</label>
							</div>
							<div class="vale-situ">
								<div class="col-md-12" style="padding:3px;">
									<label style="width:100%">Valor 1:
										<!--<input type="hidden" name="vale_empresa" value="'.$t['nome'].'">-->
										<input type="number" step="0.01" name="vale_qtd" class="form-control input-sm"  value="<?php echo $vale_qtd ?>">
									</label>
								</div>
								<div class="col-md-12" style="padding:3px;">
									<label style="width:100%">Valor 2:
										<!--<input type="hidden" name="vale_empresa2" value="'.$t['nome'].'">-->
										<input type="number" step="0.01" name="vale_qtd2" class="form-control input-sm"  value="<?php echo $vale_qtd2 ?>">
									</label>
								</div>
							</div>
						</div>
						<div class="col-md-6" style="padding:0px;">
							<div class="col-md-12" style="padding:3px;">
								<label style="width:100%">Alimentação (Mensal): 
									<input type="number" step="any" name="vale_alimentacao" class="form-control input-sm"  value="<?php echo $vale_alimentacao ?>">
								</label>
							</div>		
							<div class="col-md-12" style="padding:3px;">							
								<label style="width:100%">Refeição (Diario): 
									<input type="number" step="any" name="vale_refeicao" class="form-control input-sm" value="<?php echo $vale_refeicao ?>">
								</label>
							</div>
						</div>
					</div>	
				</div>
			</div>
		</div>
		<!-- INFORMAÇÕES DO PIS E FGTS -->
		<div class="row">
			<div class="col-md-7">
				<div class="panel panel-info">
					<div class="panel-heading" style="font-weight:bold; text-align:center; font-family: 'Oswald', sans-serif; letter-spacing:3px;">INFORMAÇÕES DO PIS</div>
					<div class="panel-body">
						<div class="col-md-2" style="padding:3px">
							<label style="width:100%">
								Cadastrado em: <input type="date" name="pis_cadastro" value="<?php echo $pis_cadastro ?>" class="form-control input-sm" />
							</label>
						</div>
						<div class="col-md-2" style="padding:3px">
							<label style="width:100%">
								Numero PIS: <input type="text" name="pis_numero" value="<?php echo $pis_numero ?>" class="form-control input-sm" />
							</label>	
						</div>
						<div class="col-md-1" style="padding:3px">
							<label style="width:100%">
								Banco: <input type="text" name="pis_banco" value="<?php echo $pis_banco ?>" class="form-control input-sm" />
							</label>
						</div>
						<div class="col-md-5" style="padding:3px">
							<label style="width:100%">
								Endereço: <input type="text" name="pis_endereco" value="<?php echo $pis_endereco ?>" class="form-control input-sm" />
							</label>
						</div>
						<div class="col-md-1" style="padding:3px">
							<label style="width:100%">
								Banco: <input type="text" name="pis_numbanco" value="<?php echo $pis_numbanco ?>" class="form-control input-sm" />
							</label>
						</div>
						<div class="col-md-1" style="padding:3px">
							<label style="width:100%">
								Agência: <input type="text" name="pis_agencia" value="<?php echo $pis_agencia ?>" class="form-control input-sm" />
							</label>		
						</div>
					</div>
				</div>	
			</div>
			<div class="col-md-5">
				<div class="panel panel-info">
					<div class="panel-heading" style="font-weight:bold; text-align:center; font-family: 'Oswald', sans-serif; letter-spacing:3px;">FGTS</div>
					<div class="panel-body">
						<div class="col-md-2" style="padding:3px">
							<label style="width:100%">Optante:
								<select name="optante_fgts" class="form-control input-sm">
								<?php 
									if($optante_fgts == "SIM"){
										echo '<option value="SIM" selected>SIM</option>';
										echo '<option value="NÃO">NÃO</option>';
									}else{
										echo '<option value="SIM">SIM</option>';
										echo '<option value="NÃO" selected>NÃO</option>';
									}
								?>
								</select>
							</label>	
						</div>
						<div class="col-md-3" style="padding:3px">
							<label style="width:100%">
								Data Opção: <input type="date" name="data_opcao_fgts" value="<?php echo $data_opcao_fgts ?>" class="form-control input-sm" />
							</label>	
						</div>
						<div class="col-md-3" style="padding:3px">
							<label style="width:100%">
								Retratação: <input type="date" name="data_retratacao_fgts" value="<?php echo $data_retratacao_fgts ?>" class="form-control input-sm" />
							</label>
						</div>
						<div class="col-md-4" style="padding:3px">
							<label style="width:100%">Banco Depositário: <input type="text" name="banco_depositario" value="<?php echo $banco_depositario ?>" class="form-control input-sm"></label>	
						</div>
					</div>
				</div>	
			</div>
		</div>
		<!-- INFORMAÇÕES DO HORARIO -->
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-info">
					<div class="panel-heading" style="font-weight:bold; text-align:center; font-family: 'Oswald', sans-serif; letter-spacing:3px;">HORÁRIOS</div>
					<div class="panel-body">
						<div class="col-md-10" style="padding:0px;">
							<div class="col-md-3" style="padding: 3px;">
								<label style="width:100%">Periodo: 
									<select name="trabalho_periodo" class="form-control input-sm">
										<?php 
										if($trabalho_periodo == 'SEG a QUI'){
											echo '
											<option value="SEG a QUI" selected>SEG A QUI</option>
											<option value="SEG a SEX">SEG A SEX</option>
											<option value="SEG a SAB">SEG A SAB</option>
											';
										}else if($trabalho_periodo == 'SEG a SEX'){
											echo '
											<option value="SEG a QUI">SEG A QUI</option>
											<option value="SEG a SEX" selected>SEG A SEX</option>
											<option value="SEG a SAB">SEG A SAB</option>
											';
										}else if($trabalho_periodo == 'SEG a SAB'){
											echo '
											<option value="SEG a QUI">SEG A QUI</option>
											<option value="SEG a SEX">SEG A SEX</option>
											<option value="SEG a SAB" selected>SEG A SAB</option>
											';
										}
										?>
									</select>
								</label>
							</div>
							<div class="col-md-3" style="padding: 3px;">
								<label style="width:100%">Entrada: 
									<input type="text" class="form-control input-sm" name="trabalho_entrada" onfocus="$(this).mask('99:99')" value="<?php echo $trabalho_entrada ?>">
								</label>
							</div>
							<div class="col-md-3" style="padding: 3px;">
								<label style="width:100%">Descanso/Almoço: 
									<input type="text" class="form-control input-sm" name="trabalho_refeicao" onfocus="$(this).mask('99:99 - 99:99')" value="<?php echo $trabalho_refeicao ?>">
								</label>
							</div>
							<div class="col-md-3" style="padding: 3px;">
								<label style="width:100%">Saída: 
									<input type="text" class="form-control input-sm" name="trabalho_saida" onfocus="$(this).mask('99:99')" value="<?php echo $trabalho_saida ?>">
								</label>
							</div>
							<div class="col-md-3" style="padding: 3px;">
								<label style="width:100%">Periodo Extra: 
									<select name="trabalho_periodo2" class="form-control input-sm">
									<?php 
										if($trabalho_periodo2 == 'SEXTA'){
											echo '
											<option value="SEXTA" selected>SEXTA</option>
											<option value="SABADO">SABÁDO</option>
											';
										}else if($trabalho_periodo2 == 'SABADO'){
											echo '
											<option value="SEXTA">SEXTA</option>
											<option value="SABADO" selected>SABÁDO</option>
											';
										}
									?>
									</select>
								</label>
							</div>
							<div class="col-md-3" style="padding: 3px;">
								<label style="width:100%">Entrada: 
									<input type="text" class="form-control input-sm" name="trabalho_entrada2" onfocus="$(this).mask('99:99')" value="<?php echo $trabalho_entrada2 ?>">
								</label>
							</div>
							<div class="col-md-3" style="padding: 3px;">
								<label style="width:100%">Descanso/Almoço: 
									<input type="text" class="form-control input-sm" name="trabalho_refeicao2" onfocus="$(this).mask('99:99 - 99:99')" value="<?php echo $trabalho_refeicao2 ?>">
								</label>
							</div>
							<div class="col-md-3" style="padding: 3px;">
								<label style="width:100%">Saída: 
									<input type="text" class="form-control input-sm" name="trabalho_saida2" onfocus="$(this).mask('99:99')" value="<?php echo $trabalho_saida2 ?>">
								</label>
							</div>
						</div>
						<div class="col-md-2" style="padding:3px;">
							<label style="width:100%;">Descanso:
								<input type="text" class="form-control input-sm" name="trabalho_descanso" value="<?php echo $trabalho_descanso ?>">
							</label>
						</div>
					</div>
				</div>
			</div>
		</div>
		<center style="margin-bottom:40px;  border-radius:5px;">
			<button type="submit" class="btn btn-success btn-sm" style="width:50%; height:50px; font-size:13px;"><span class="glyphicon glyphicon-floppy-disk"></span> Salvar Informações</button>
		</center>
	</form>
<?php } else if($tipo_emp2 == "1") { 
			$tipo_emp = $tipo_emp2; ?>
		<form action="javascript:void(0)" onSubmit="post(this,'rh/editar-funcionario.php?ac=update1&id=<?php echo $id ?>','.ajax');" class="small formulario-info" enctype="multipart/form-data" style="font-size:11px">
		<div class="panel panel-info">
			<div class="panel-heading" style="font-weight:bold; text-align:center; font-family: 'Oswald', sans-serif; letter-spacing:3px;">Dados Cadastrais</div>
			<div class="panel-body">
				<div class="col-md-2">
					<div style="position:relative; top:0px;">
						<?php
							if($imagem=='') { 
								echo '<img src="rh/imagens/sem_foto.png" width="100%" class="img-rounded" style="border:1px solid #D9EDF7">';
							} else { 
								echo '<img src="rh/imagens/'.$imagem.'" width="100%" class="img-rounded" style="border:1px solid #D9EDF7">'; 
							}			
						?>
						<a href="#" class="btn btn-info btn-xs" style="font-size:13px; padding:5px; position:absolute; bottom:5px; right:5px; font-family: 'Oswald', sans-serif; letter-spacing:3px;" onClick='window.open("rh/editar-imagem.php?id=<?php echo $id ?>", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=100, left=500, width=500, height=500")'><span class="glyphicon glyphicon-picture"></span> Alterar </a>
					</div>
					<p style="text-align:center; width:100%; margin-top:20px;"><b>Tipo de funcionario:</b></p>
					<div class="col-md-12" style="padding:0px; text-align:center">
						<div class="col-md-6" style="padding:3px;  text-align:center">
							<input type="radio" name="tipo_emp" value="0" onChange="$('.retorno').load('rh/editar-funcionario.php?id=<?php echo $id ?>&tipo_emp2=' + $(this).val() + '');" style="height: 19px; width: 19px;">
							<small style="font-size:15px; position:relative; bottom:3px; font-weight:bold; font-family: 'Oswald', sans-serif;">Funcionário</small>
						</div>
						<div class="col-md-6" style="padding:3px; text-align:center">
							<input type="radio" name="tipo_emp" value="1" onChange="$('.retorno').load('rh/editar-funcionario.php?id=<?php echo $id ?>&tipo_emp2=' + $(this).val() + '');" style="margin-left:10px; height: 19px; width: 19px;" checked>
							<small style="font-size:15px; position:relative; bottom:3px; font-weight:bold; font-family: 'Oswald', sans-serif;">Empresa</small>
						</div>
					</div>
					<div class="col-md-12" style="padding:0px; text-align:center">
						<a href="#" onclick='$("#myModal2").modal("show"); ldy("rh/imprimir-contratos.php?id=<?php echo $id;?>",".modal-body")' style="margin-top:20px; width: 100%; height:40px; padding-top:5px; font-size:15px; font-family: 'Oswald', sans-serif; letter-spacing:3px;" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-print"></span> Impressão</a>
					</div>
				</div>
				<div class="col-md-10">
					<div class="col-md-12" style="padding:0px">
						<div class="col-md-8" style="padding:3px">
							<label style="width:100%">
								Nome Completo: 
								<input type="text" name="nome" value="<?php echo $nome ?>" class="form-control input-sm" required />
							</label>
						</div>
						<div class="col-md-4" style="padding:3px">
							<label style="width:100%">Cargo: <br/>
								<select class="form-control input-sm combobox" name="funcao" style="width:100%">
									<option value="0"></option>
									<?php 
										$funcoes = mysql_query("select * from rh_funcoes where status = '0' order by descricao asc"); while($l=mysql_fetch_array($funcoes)) {
											if($funcao==$l['id']) { echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>'; }
											else { echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>'; }  	
										} 
									?>	
								</select>
							</label>
						</div>
					</div>
					<div class="col-md-4" style="padding:3px">
						<label style="width:100%">Situação: <br/>
							<select class="form-control input-sm" name="situacao" onChange="$('.item-situ').load('rh/editar-funcionario.php?situ_tipo=demi&situacao=' + $(this).val() + '');">
								<?php 
									$situacoes = mysql_query("select * from rh_situacao where status = '0' AND id <> '0' order by ordem asc"); while($l=mysql_fetch_array($situacoes)) {
										if($situacao==$l['id']){ 
											echo '<option value="'.$l['id'].'" style="color:#EC971F" selected>'.$l['descricao'].' *** </option>'; 
										} else { 
											echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>';
										}  	
									} 
								?>	
							</select>
						</label>
					</div>
					<div class="col-md-4" style="padding:3px">
						<label style="width:100%">Obra/Contrato:
							<select class="form-control input-sm" name="obra" style="width:100%" onChange="$('#itens-rh').load('rh/editar-funcionario.php?city=ok2&obra_2=' + $(this).val() + '');">
							<?php 
								$obras = mysql_query("select * from  notas_obras WHERE id IN(0,$obra_usuario) order by descricao asc"); 
								while($l=mysql_fetch_array($obras)) {
									if($obra==$l['id']) { 
										echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>'; 
									} else { 
										if($acesso_login == 'MASTER' || $acesso_login == 'MODERADOR'){
											echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>'; 
										}
									} 	
								}  	
							?>		
							</select>
						</label>
					</div>
					<div class="col-md-4" style="padding:3px">
						<label id="itens-rh" style="width:100%">
							<label style="width:100%">Equipe: <br/>
								<select name="equipe" class="form-control input-sm combobox" style="width:100%" required>
									<option value="" selected disabled>Selecione uma equipe</option>
									<?php
									$cidade_2 = mysql_result(mysql_query("SELECT cidade FROM notas_obras WHERE id = $obra"),0,"cidade");
									$sss = mysql_query("select * from equipes WHERE (obra = '$cidade_2' OR emp = '1') AND status = '0' order by nome asc"); 
									while($l = mysql_fetch_array($sss)) {
										if($equipe==$l['id']) {
											echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>'; 
										} else { 
											if($equipe == '0' || $acesso_login == 'MASTER'){
												echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>'; 
											}
										}
									}
									?>
								</select>
							</label>	
						</label>
					</div>
					<div class="col-md-6" style="padding:0px;">
						<div class="col-md-3" style="padding:3px">
							<label style="width:100%">
								Residencial:
								<input type="text" name="telefone" value="<?php echo $telefone ?>" class="form-control input-sm" placeholder="(__)____-____" onFocus="$(this).mask('(99)9999-9999')" />
							</label>
						</div>
						<div class="col-md-3" style="padding:3px">
							<label style="width:100%">
								Celular:
								<input type="text" name="celular" value="<?php echo $celular ?>" class="form-control input-sm" placeholder="(__)_____-____" onFocus="$(this).mask('(99)99999-999?9')" />
							</label>
						</div>
						<div class="col-md-3" style="padding:3px">
							<label style="width:100%">
								Identidade (RG): <input type="text" name="rg" placeholder="__.___.___-_" value="<?php echo $rg ?>" class="form-control input-sm"/>
							</label>	
						</div>
						<div class="col-md-3" style="padding:3px">
							<label style="width:100%">
								CPF:<input type="text" name="cpf" onFocus="$(this).mask('999.999.999-99')" value="<?php echo $cpf ?>" class="form-control input-sm"/>
							</label>
						</div>
					</div>
					<div class="col-md-6" style="padding:0px;">
						<div class="col-md-12" style="padding:3px;">
							<label style="width:100%">Empresa: <br/>
								<select name="empresa_emp" class="form-control input-sm combobox" style="width:100%" required>
									<option value="">Selecione uma empresa</option>
									<?php 
										$cidade = mysql_query("SELECT * FROM notas_empresas");
										while($c = mysql_fetch_array($cidade)){
											if($c['id'] == $empresa_emp){
												echo '<option value="'.$c['id'].'" selected>'.$c['cnpj'].' - '.$c['nome'].'</option>';
											}else{
												echo '<option value="'.$c['id'].'">'.$c['cnpj'].' - '.$c['nome'].'</option>';
											}
										}
									?>
								</select>
							</label>
						</div>
					</div>
					<div class="col-md-12" style="padding:0px;">
						<div class="col-md-2" style="padding:3px;">	
							<label style="width:100%">Admissão: 
								<input type="date" name="admissao" class="form-control input-sm" value="<?php echo $admissao ?>" required />
							</label>
						</div>
						<div class="item-situ">
							<div class="col-md-3" style="padding:3px;">	
								<label style="width:100%">Demissão: 
									<?php 
									if($situacao == 1){
										echo '<input type="date" name="demissao" class="form-control input-sm" value="'.$demissao.'" />';
									}else{
										echo '<input type="date" name="demissao" class="form-control input-sm" value="" disabled/>';
										echo '<input type="hidden" name="demissao" value="0000-00-00">';
									}
									?>
								</label>
							</div>
							<div class="col-md-3" style="padding:3px;">	
								<label style="width:100%">Deficiencia: 
									<?php 
									if($situacao == 12){
										echo '<input type="text" name="deficiencia" class="form-control input-sm" value="'.$deficiencia.'" />';
									}else{
										echo '<input type="text" name="deficiencia" class="form-control input-sm" value="'.$deficiencia.'"  disabled />';
										echo '<input type="hidden" name="deficiencia" value="NENHUMA">';
									}
									?>
								</label>
							</div>
						</div>
						<div class="col-md-2" style="padding:3px;">	
							<label style="width:100%">Administrativo:
								<select name="adm" class="form-control input-sm">
									<?php 
										if($adm == '1'){
											echo '<option value="0">NÃO</option>';
											echo '<option value="1" selected>SIM</option>';
										}else{
											echo '<option value="1">SIM</option>';
											echo '<option value="0" selected>NÃO</option>';
										}
									?>
								</select>
							</label>
						</div>
						<div class="col-md-2" style="padding:3px;">	
							<label style="width:100%">
								Cidade de serviço: 
								<select name="cidade_servico" class="form-control input-sm" required>
									<?php 
										$cidade = mysql_query("SELECT * FROM cidade");
										while($c = mysql_fetch_array($cidade)){
											if($c['nome'] == $cidade_servico){
												echo '<option value="'.$c['nome'].'" selected>'.$c['nome'].'</option>';
											}else{
												echo '<option value="'.$c['nome'].'">'.$c['nome'].'</option>';
											}
										}
									?>
								</select>
							</label>
						</div>
					</div>
					<div class="col-md-12" style="padding:3px;">
						<label style="width:100%">Obs:
							<textarea name="adm_obs" class="form-control input-sm" style="resize:none; text-align:left"><?php echo $adm_obs; ?></textarea>
						</label>
					</div>
				</div>
			</div>
		</div>
		<center style="margin-bottom:10px;  border-radius:5px; margin-bottom:20px;">
			<button type="submit" class="btn btn-success btn-sm" style="width:400px; height:40px; font-size:13px;"><span class="glyphicon glyphicon-floppy-disk"></span> Salvar Dados</button>
		</center>
	</form>
<?php } ?>
	<!-- LISTA HISTORICO -->
	<div class="panel panel-success">
			<div class="panel-heading" style="font-weight:bold; text-align:center; font-family: 'Oswald', sans-serif; letter-spacing:3px;"><small>Historico do Funcionário</small></div>
			<div class="panel-body">
			<form class="form-inline formulario-success" action="javascript:void(0)" onSubmit="post(this,'rh/lista-historico.php?ac=add&funcionario=<?php echo $id ?>','.historico')">
				<div class="col-md-2" style="padding: 3px">
					<label style="width:100%"> 
						<small>Data:</small><br/>
						<input type="date" class="form-control input-sm" value="<?php echo $todayTotal; ?>" style="width:100%" name="data" required> 
					</label>
				</div>
				<div class="col-md-8" style="padding: 3px">
					<label style="width:100%">
						<small>Observações:</small><br/>
						<input type="text" class="form-control input-sm" name="mensagem" style="width:100%;" required>
					</label>
				</div>
				<div class="col-md-2" style="padding: 3px">
					<label style="width:100%">
						<br/>
						<input type="submit" class="btn btn-success btn-sm" style="width:100%" value="Adicionar"/>
					</label>
				</div>
				<script>ldy("rh/lista-historico.php?funcionario=<?php echo $id ?>",".historico");</script>
				<div class="historico"></div>
			</form>
		</div>
	</div>	
	<!-- LISTA HISTORICO CURSOS -->
	<div class="panel panel-success">
			<div class="panel-heading" style="font-weight:bold; text-align:center; font-family: 'Oswald', sans-serif; letter-spacing:3px;"><small>Cursos do Funcionário</small></div>
			<div class="panel-body">
			<form class="form-inline formulario-success" action="rh/upload-curso.php?funcionario=<?php echo $id ?>" target="_blank" enctype="multipart/form-data" method="POST">
				<div class="col-xs-8" style="padding:0px">
				<div class="col-md-3" style="padding: 3px">
					<label style="width:100%"> 
						<small>Data:</small><br/>
						<input type="date" class="form-control input-sm" value="<?php echo $todayTotal; ?>" style="width:100%" name="data" required> 
					</label>
				</div>
				<div class="col-md-3" style="padding: 3px">
					<label style="width:100%"> 
						<small>Vencimento:</small><br/>
						<input type="date" class="form-control input-sm" style="width:100%" name="vencimento" required> 
					</label>
				</div>
				<div class="col-md-6" style="padding: 3px">
					<label style="width:100%">
						<small>Observações:</small><br/>
						<input type="text" class="form-control input-sm" name="obs" style="width:100%;" required>
					</label>
				</div>
				<div class="col-md-6" style="padding: 3px">
					<label style="width:100%">
						<small>Cursos:</small><br/>
						<select class="form-control input-sm combobox" name="curso">
							<?php 
								$cursos = mysql_query("select * from rh_cursos order by descricao asc"); 
								while($l=mysql_fetch_array($cursos)) {
									echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>'; 
								}  	
							?>	
						</select>
					</label>
				</div>
				<div class="col-md-6" style="padding: 3px">
					<label for='selecao-arquivo' style="width:100%; cursor: pointer;">
						<small>Anexar PDF:</small><br/>
						<input id='selecao-arquivo' type="file" accept="application/pdf" class="form-control input-sm" name="anexo" style="width:100%; background:transparent" required>
					</label>
				</div>
				</div>
				<div class="col-xs-4" style="padding: 3px">
					<label style="width:100%">
						<br/>
						<input type="submit" class="btn btn-success btn-sm pull-right" style="width:50%; height:80px" value="Adicionar"/>
					</label>
				</div>
				<script>ldy("rh/lista-cursos.php?funcionario=<?php echo $id ?>",".cursos");</script>
				<div class="cursos"></div>
			</form>
		</div>
	</div>
	<?php if($tipo_emp2 == "0") { ?>
	<div class="panel panel-success">
		<div class="panel-heading" style="font-weight:bold; text-align:center; font-family: 'Oswald', sans-serif; letter-spacing:3px;"><small>Beneficiários</small></div>
		<div class="panel-body">
			<form class="form-inline formulario-success" action="javascript:void(0)" onSubmit="post(this,'rh/lista-benef.php?ac=add&funcionario=<?php echo $id ?>','.benef')">
				<div class="col-md-6" style="padding: 3px;">
					<label style="width:100%"> 
						<small>Nome:</small><br/> 
						<input type="text" class="form-control input-sm" name="nome" style="width:100%"> 
					</label>	
				</div>
				<div class="col-md-2" style="padding: 3px;">
					<label style="width:100%"> 
						<small>Parentesco:</small><br/> 
						<select name="parentesco" class="form-control input-sm" style="width:100%">
							<option value="FILHO">FILHO</option>
							<option value="FILHA">FILHA</option>
						</select>
					</label>
				</div>
				<div class="col-md-2" style="padding: 3px;">
					<label style="width:100%"> 
						<small>Nascimento:</small><br/> 
						<input type="date" class="form-control input-sm" name="nascimento" style="width:100%"> 
					</label>
				</div>
				<div class="col-md-2" style="padding: 3px;">
					<label style="width:100%"> <br/>
						<input type="submit" class="btn btn-success btn-sm" value="Adicionar" style="width:100%">
					</label>
				</div>
				<script>ldy("rh/lista-benef.php?funcionario=<?php echo $id ?>",".benef");</script>
				<div class="benef"></div>
			</form>
		</div>
	</div>
	<div class="panel panel-success">
		<div class="panel-heading" style="font-weight:bold; text-align:center; font-family: 'Oswald', sans-serif; letter-spacing:3px;"><small>Historico de Ferias</small></div>
		<div class="panel-body">
			<form class="form-inline formulario-success" action="javascript:void(0)" onSubmit="post(this,'rh/lista-ferias.php?ac=add&funcionario=<?php echo $id ?>','.ferias')">
				<div class="col-md-1" style="padding: 3px;">
					<label style="width:100%"> 
						<small>Dias:</small><br/>
						<input type="text" class="form-control input-sm" style="width:100%" name="dias" required> 
					</label>
				</div>
				<div class="col-md-3" style="padding: 3px;">
					<label style="width:100%"> 
						<small>Data:</small><br/>
						<input type="date" class="form-control input-sm" style="width:100%" name="data" required> 
					</label>	
				</div>
				<div class="col-md-6" style="padding: 3px;">
					<label style="width:100%">
						<small>Observações:</small><br/>
						<input type="text" class="form-control input-sm" style="width:100%" name="obs" required> 
					</label>
				</div>
				<div class="col-md-2" style="padding: 3px;">
					<label style="width:100%"> <br/>
						<input type="submit" class="btn btn-success btn-sm" value="Adicionar" style="width:100%">
					</label>
				</div>
				<script>ldy("rh/lista-ferias.php?funcionario=<?php echo $id ?>",".ferias");</script>
				<div class="ferias"></div>
			</form>
		</div>
	</div>
	<?php } ?>
	
	<div class="ajax"></div>
	
	<div class="modal" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:auto;">
		<div class="modal-dialog" style="width:900px;">
			<div class="modal-content" style="width:900px; padding-bottom:10px;">
				<div class="modal-header" style="width:895px">
					<button type="button" class="close" style="color:#C9302C; opacity:1; " onclick="$('.modal').modal('hide'); $('.modal-body').empty()" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Impressão</h4>
				</div>
				<div class="modal-body" style="width:895px; max-height:500px; overflow:auto; border-bottom:1px solid #E5E5E5;">
					Aguarde um momento &nbsp;&nbsp; <img src="../../imagens/loading.gif" alt="Carregando" width="20px"/>
				</div>
			</div>
		</div>
	</div>
	<div class="modal" id="myModalLista" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:auto;">
		<div class="modal-dialog" style="width:50%">
			<div class="modal-content"> 
				<div class="modal-header box box-info" style="margin:0px;">
					<button type="button" class="close" style="color:#C9302C; opacity:1; " onclick="$('.modal').modal('hide'); $('.modal-body').empty()" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Editar Informações</h4>
				</div>
				<div class="modal-body">
					Aguarde um momento &nbsp;&nbsp; <img src="../style/img/loading.gif" alt="Carregando" width="20px"/>
				</div>
			</div>
		</div>
	</div>