<?php 
	include('../config.php');
	include('../validar_session.php'); 
	getNivel();
	getData();
	if(@$atu == 'tipoEmpresa'){
		if($tipo_in == '1'){
			echo "<script>$('.fisica').prop('disabled', false);</script>";
			echo "<script>$('.juridica').prop('disabled', true);</script>";
			echo "<script>$('.todosInput').prop('disabled', false);</script>";
		}else if($tipo_in == '0'){
			echo "<script>$('.juridica').prop('disabled', false);</script>";
			echo "<script>$('.fisica').prop('disabled', true);</script>";
			echo "<script>$('.todosInput').prop('disabled', false);</script>";
		}
		exit;
	}
?>
	<script>
	$(".force-uppercase").keyup(function(e){
		var start = e.target.selectionStart;
		var end = e.target.selectionEnd;
		e.target.value = e.target.value.toUpperCase();
		e.target.setSelectionRange(start, end);
	});
	</script>
<?php
	if(isset($ac)){
		$tamanho_input = strlen($cnpj_favorecido);
		if($tamanho_input == '0'){
			echo '';
		}else if($tamanho_input == '11'){
			$cnpj_favorecido = MaskPHP("###.###.###-##",$cnpj_favorecido);
		}else if($tamanho_input == '14'){
			$cnpj_favorecido = MaskPHP("##.###.###/####-##",$cnpj_favorecido);
		}else{
			echo "<script>alert('CNPJ OU CPF DO FAVORECIDO INVALIDO');</script>";
		}
		if($tipo == '1'){
			$count = mysql_num_rows(mysql_query("SELECT * FROM empresa_cadastro WHERE cnpj = '$cnpj' AND id <> '$id'"));
			if($count != 0){
				echo '
				<div class="alert alert-danger" id="alert1">
					<h4>Pessoa Fisica já cadastrada!</h4>

					<p>O CPF: '.$cnpj.' ja está cadastrada no sistema, favor consultar as empresas ja cadastradas e tentar novamente!!!</p>
				</div>';
			}else{
				$query = mysql_query("update empresa_cadastro set `razao_social` = '$razao_social', `rg` = '$rg', `cnpj` = '$cpf', `telefone_1` = '$telefone_1', `telefone_2` = '$telefone_2', `ins_est` = '$ins_est', `ins_mun` = '$ins_mun', `endereco` = '$endereco', `bairro`= '$bairro', `uf` = '$uf', `cidade` = '$cidade', `cep` = '$cep', `email` = '$email', `contato` = '$contato', `ag` = '$ag', `cc` = '$cc', `banco` = '$banco', `tipo` = '$tipo', `ag2`='$ag2', `cc2`='$cc2', `banco2`='$banco2', `favorecido`='$favorecido', `cnpj_favorecido`='$cnpj_favorecido', `obs`='$obs' where id = '$id'") or die (mysql_error());
				
				if($query){
					echo '
					<div class="alert alert-success" id="alert1">
						<h4>Empresa atualizada com sucesso!</h4>

						<p>O CPF: '.$cnpj.' de seu portador '.$nome.' foi editado com sucesso no sistema!!!</p>
					</div>';
				}
			}
		}else if($tipo == '0'){
			$count = mysql_num_rows(mysql_query("SELECT * FROM empresa_cadastro WHERE cnpj = '$cnpj' AND id <> '$id'"));
			if($count != 0){
				echo '
				<div class="alert alert-danger" id="alert1">
					<h4>Empresa já cadastrada!</h4>

					<p>O CNPJ: '.$cnpj.' ja está cadastrada no sistema, favor consultar as empresas ja cadastradas e tentar novamente!!!</p>
				</div>';
			}else{
				$query = mysql_query("update empresa_cadastro set `razao_social` = '$razao_social', `cnpj` = '$cnpj', `telefone_1` = '$telefone_1', `telefone_2` = '$telefone_2', `ins_est` = '$ins_est', `ins_mun` = '$ins_mun', `endereco` = '$endereco', `bairro`= '$bairro', `uf` = '$uf', `cidade` = '$cidade', `cep` = '$cep', `email` = '$email', `contato` = '$contato', `ag` = '$ag', `cc` = '$cc', `banco` = '$banco', `tipo` = '$tipo', `ag2`='$ag2', `cc2`='$cc2', `banco2`='$banco2', `favorecido`='$favorecido', `cnpj_favorecido`='$cnpj_favorecido', `obs`='$obs' where id = '$id'") or die (mysql_error());
				
				if($query){
					echo '
					<div class="alert alert-success" id="alert1">
						<h4>Empresa atualizada com sucesso!</h4>

						<p>O CNPJ: '.$cnpj.' de razao social '.$razao_social.' foi atualizada com sucesso!!!</p>
					</div>';
				}
			}
		}
		echo "<script> $('html, body').animate({ scrollTop: $('.navbar-topo1').offset().top }, 'slow'); </script>";
		exit;
	}
?>
<div class="resultado"> </div>

	<?php
	$sql_consulta = mysql_query("select * from empresa_cadastro where id = '$id'");
	while($i = mysql_fetch_array($sql_consulta)) { 
		if($i['tipo'] == '1'){
			$cpf_input = $i['cnpj']; 
			echo "<script>$('.fisica').prop('disabled', false);</script>";
			echo "<script>$('.juridica').prop('disabled', true);</script>";
			echo "<script>$('.todosInput').prop('disabled', false);</script>";
		}else if($i['tipo'] == '0'){
			$cnpj_input = $i['cnpj'];
			echo "<script>$('.juridica').prop('disabled', false);</script>";
			echo "<script>$('.fisica').prop('disabled', true);</script>";
			echo "<script>$('.todosInput').prop('disabled', false);</script>";
		}
	?>
	<form action="javascript:void(0)" class="formulario-info" style="margin-top:10px" onSubmit="post(this,'financeiro/editar-empresa.php?ac=editar&id=<?= $i['id'] ?>','.resultado')">
		<div class="row" style="width:100%">
			<div class="col-xs-4">
				<label><small>Tipo de Empresa:</small>
					<select class="form-control input-sm" name="tipo" onChange="ldy('financeiro/editar-empresa.php?atu=tipoEmpresa&tipo_in=' + $(this).val(),'.ajax')" required>
						<option value="" selected disabled>Selecione uma opção</option>
						<option value="1" <?php if($i['tipo'] == '1'){ echo 'selected';} ?>>Fisica</option>
						<option value="0" <?php if($i['tipo'] == '0'){ echo 'selected';} ?>>Jurídica</option>
					</select>
				</label>
			</div>
			<div class="col-xs-8">
				<label><small>Razão Social:</small>
					<input type="text" id="razao_social" name="razao_social" placeholder="Nome da Empresa" value="<?= $i['razao_social'] ?>" class="todosInput form-control input-sm force-uppercase" autocomplete="off" required disabled />
				</label>
			</div>
			<div class="col-xs-4">
				<label><small>RG:</small>
					<input type="text" name="rg" onfocus="$(this).mask('99.999.999-*')" placeholder="__.___.___-_" value="<?= $i['rg'] ?>" class="fisica form-control input-sm" disabled required />
				</label>
			</div>
			<div class="col-xs-4">
				<label><small>CPF:</small>
					<input type="text" name="cpf" placeholder="___.___.___-__" onfocus="$(this).mask('999.999.999-99')" value="<?= $cpf_input ?>" autocomplete="off" class="fisica form-control input-sm" disabled required />
				</label>
			</div>
			<div class="col-xs-4">
				<label><small>CNPJ:</small>
					<input type="text" name="cnpj" onblur="$('#autoco').load('financeiro/cadastro-empresa.php?ac=busca-empresa&busca=' + $(this).val() + '');" onfocus="$(this).mask('99.999.999/9999-99')" placeholder="__.___.___/____-__" value="<?= $cnpj_input ?>" autocomplete="off" class="juridica form-control input-sm" disabled required />
					<div id="autoco"></div>
				</label>
			</div>
			<div class="col-xs-4">
				<label><small>Inscrição Estadual</small>
					<input type="text" name="ins_est" autocomplete="off" placeholder="Número Inscrição Estadual" value="<?= $i['ins_est'] ?>" class="juridica form-control input-sm" disabled />
				</label>
			</div>
			<div class="col-xs-4">
				<label><small>Inscrição Municipal</small>
					<input type="text" name="ins_mun" autocomplete="off" placeholder="Número Inscrição Municipal" value="<?= $i['ins_mun'] ?>" class="juridica form-control input-sm" disabled />
				</label>
			</div>
			<div class="col-xs-4">
				<label><small>E-mail</small>
					<input type="email" name="email" autocomplete="off" placeholder="E-mail para contato" value="<?= $i['email'] ?>" class="todosInput form-control input-sm" disabled />
				</label>
			</div>
			<div class="col-xs-4">
				<label><small>Contato:</small>
					<input type="text" name="contato" autocomplete="off" placeholder="Responsável Legal" value="<?= $i['contato'] ?>" class="todosInput form-control input-sm force-uppercase" disabled />
				</label>
			</div>
			<div class="col-xs-4">
				<label><small>Telefone:</small>
					<input type="text" name="telefone_1" autocomplete="off" onfocus="$(this).mask('(99) 9999-9999')" placeholder="(__) ____-____" value="<?= $i['telefone_1'] ?>" class="todosInput form-control input-sm" disabled />
				</label>
			</div>
			<div class="col-xs-4">
				<label><small>Celular:</small>
					<input type="text" name="telefone_2" autocomplete="off" onfocus="$(this).mask('(99) 99999999?9')" placeholder="(__) _________" value="<?= $i['telefone_2'] ?>" class="todosInput form-control input-sm" disabled />
				</label>
			</div>
			<div class="col-xs-4">
				<label><small>Endereço para Cobrança:</small>
					<input type="text" name="endereco" autocomplete="off" placeholder="Ex: Rua Antonio Emmerich, 723" value="<?= $i['endereco'] ?>" class="todosInput form-control input-sm force-uppercase" disabled />
				</label>
			</div>
			
			<div class="col-xs-2">
				<label><small>Bairro:</small>
					<input type="text" name="bairro" placeholder="Bairro" value="<?= $i['bairro'] ?>" class="todosInput form-control input-sm force-uppercase" disabled />
				</label>
			</div>
			<div class="col-xs-2">
				<label><small>Cidade:</small>
					<input type="text" name="cidade" placeholder="Cidade" value="<?= $i['cidade'] ?>" class="todosInput form-control input-sm force-uppercase" disabled />
				</label>
			</div>
			
			<div class="col-xs-2">
				<label><small>UF:</small>
					<input type="text" name="uf" id="uf" onfocus="$(this).mask('aa')" placeholder="XX" placeholder="UF" value="<?= $i['uf'] ?>" class="todosInput form-control input-sm force-uppercase" disabled />
				</label>
			</div>
			<div class="col-xs-2">
				<label><small>CEP:</small>
					<input type="text" name="cep" autocomplete="off" onfocus="$(this).mask('99999-999')" placeholder="_____-___" value="<?= $i['cep'] ?>" class="todosInput form-control input-sm" disabled />
				</label>
			</div>
			<div class="col-xs-12" style="padding:10px 0px;">
				<div class="col-xs-4">
					<center class="text-info" style="font-weight:bold"><small>Conta Bancaria (Numero 1)</small></center>
					<div class="col-xs-12" style="padding:0px">
						<label><small>Conta:</small>
							<input type="text" name="cc" autocomplete="off" placeholder="Número da Conta" value="<?=$i['cc'] ?>" class="todosInput form-control input-sm" disabled />
						</label>
					</div>
					<div class="col-xs-12" style="padding:0px">
						<label><small>Agência:</small>
							<input type="text" name="ag" autocomplete="off" placeholder="Agência e Digito" value="<?=$i['ag'] ?>" class="todosInput form-control input-sm" disabled />
						</label>
					</div>
					<div class="col-xs-12" style="padding:0px">
						<label><small>Banco:</small>
							<input type="text" value="<?=$i['banco'] ?>" name="banco" placeholder="Banco" class="todosInput form-control input-sm force-uppercase" disabled />
						</label>
					</div>
				</div>
				<div class="col-xs-4" >
					<center class="text-info" style="font-weight:bold"><small>Conta Bancaria (Numero 2)</small></center>
					<div class="col-xs-12" style="padding:0px">
						<label><small>Conta:</small>
							<input type="text" name="cc2" autocomplete="off" placeholder="Número da Conta" value="<?=$i['cc2'] ?>" class="todosInput form-control input-sm" disabled />
						</label>
					</div>
					<div class="col-xs-12" style="padding:0px">
						<label><small>Agência:</small>
							<input type="text" name="ag2" autocomplete="off" placeholder="Agência e Digito" value="<?=$i['ag2'] ?>" class="todosInput form-control input-sm" disabled>
						</label>
					</div>
					<div class="col-xs-12" style="padding:0px">
						<label><small>Banco:</small>
							<input type="text" name="banco2" placeholder="Banco" value="<?=$i['banco2'] ?>" class="todosInput form-control input-sm" disabled>
						</label>
					</div>
				</div>
				<div class="col-xs-4">
					<center class="text-info" style="font-weight:bold"><small>Favorecido</small></center>
					<div class="col-xs-12" style="padding:0px">
						<label><small>Favorecido:</small>
							<input type="text" name="favorecido" autocomplete="off" placeholder="Nome do favorecido"  value="<?=$i['favorecido'] ?>" class="todosInput form-control input-sm force-uppercase" disabled />
						</label>
					</div>
					<div class="col-xs-12" style="padding:0px">
						<label><small>CNPJ/CPF:</small>
							<input type="text" autocomplete="off" onfocus="$(this).mask('99999999999?999')" value="<?=$i['cnpj_favorecido'] ?>" name="cnpj_favorecido" class="todosInput form-control input-sm" disabled />
						</label>
					</div>
				</div>
			</div>
			<div class="col-xs-12">
				<label>Observações:
					<textarea name="obs" class="todosInput form-control input-sm force-uppercase" style="resize:none; height:70px;"><?= $i['obs'] ?></textarea>
				</label>
			</div>
			<div class="col-xs-12" style="text-align:center; padding:20px 0px;">
				<label for="" style="width:40% !important;">
					<input type="submit" value="Atualizar" style="width:100%; height:40px; margin-top:10px; color:#FFF; border-radius:5px" class="btn btn-success btn-sm">
				</label>
			</div>
		</div>
	</form>
<?php } ?>