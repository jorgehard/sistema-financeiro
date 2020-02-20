<?php 
	include('../config.php');
	include('../validar_session.php'); 
	getNivel();
	getData();
	if($tipo == 'fisica'){
		echo "<script>$('.fisica').prop('disabled', false);</script>";
		echo "<script>$('.juridica').prop('disabled', true);</script>";
		echo "<script>$('.todosInput').prop('disabled', false);</script>";
	}else if($tipo == 'juridica'){
		echo "<script>$('.juridica').prop('disabled', false);</script>";
		echo "<script>$('.fisica').prop('disabled', true);</script>";
		echo "<script>$('.todosInput').prop('disabled', false);</script>";
	}
	if(@$ac=='busca-empresa') {
		$stm = mysql_query("SELECT * FROM empresa_cadastro WHERE cnpj = '$busca'");
		while($b = mysql_fetch_array($stm)) {
			echo '<script>alert("Empresa ja se encontra cadastrada em nosso sistema!!!")</script>'; 
			echo '<script>$("#razao_social").val("'.$b['razao_social'].'")</script>'; 
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
		if($tipo == 'fisica'){
			$count = mysql_num_rows(mysql_query("select * from empresa_cadastro where cnpj = '$cnpj'"));
			if($count != 0){
				echo '
				<div class="alert alert-danger" id="alert1">
					<h4>Pessoa Fisica já cadastrada!</h4>

					<p>O CPF: '.$cnpj.' ja está cadastrada no sistema, favor consultar as empresas ja cadastradas e tentar novamente!!!</p>
				</div>';
			}else{
				$query = mysql_query("insert into empresa_cadastro (razao_social, rg, cnpj, telefone_1, telefone_2, contato, endereco, bairro, uf, cidade, cep, email, cc, ag, banco, cc2, ag2, banco2, favorecido, cnpj_favorecido, tipo, obs) values ('$razao_social', '$rg', '$cpf', '$telefone_1', '$telefone_2', '$contato',  '$endereco', '$bairro', '$uf', '$cidade', '$cep', '$email', '$cc', '$ag', '$banco', '$cc2', '$ag2', '$banco2', '$favorecido', '$cnpj_favorecido', 1, '$obs')") or die (mysql_error()); 
				
				if($query){
					echo '
					<div class="alert alert-success" id="alert1">
						<h4>Empresa Cadastrada!</h4>

						<p>O CPF: '.$cnpj.' de seu portador '.$nome.' foi cadastrada com sucesso no sistema!!!</p>
					</div>';
				}
			}
		}else if($tipo == 'juridica'){
			$count = mysql_num_rows(mysql_query("select * from empresa_cadastro where cnpj = '$cnpj'"));
			if($count != 0){
				echo '
				<div class="alert alert-danger" id="alert1">
					<h4>Empresa já cadastrada!</h4>

					<p>O CNPJ: '.$cnpj.' ja está cadastrada no sistema, favor consultar as empresas ja cadastradas e tentar novamente!!!</p>
				</div>';
			}else{
				$query = mysql_query("INSERT INTO empresa_cadastro (razao_social, cnpj, cc, ag, banco, telefone_1, telefone_2, endereco, bairro, uf, cidade, cep, email, ins_est, ins_mun, contato, cc2, ag2, banco2, favorecido, cnpj_favorecido, obs) VALUES ('$razao_social', '$cnpj', '$cc', '$ag', '$banco', '$telefone_1', '$telefone_2', '$endereco', '$bairro', '$uf', '$cidade', '$cep', '$email', '$ins_est', '$ins_mun', '$contato', '$cc2', '$ag2', '$banco2', '$favorecido', '$cnpj_favorecido', '$obs')") or die (mysql_error());
				
				if($query){
					echo '
					<div class="alert alert-success" id="alert1">
						<h4>Empresa Cadastrada!</h4>

						<p>O CNPJ: '.$cnpj.' de nome '.$nome.' foi cadastrada com sucesso no sistema!!!</p>
					</div>';
				}
			}
		}
		echo "<script>$('.modal').modal('hide'); alert('Fornecedor cadastrado com sucesso');</script>";
		echo "<script>ldy('financeiro/cadastro-nota.php?atu=fornecedor','.fornecedorAtu');</script>";
		exit;
	}
?>
<div class="resultado"></div>
<form action="javascript:void(0)" class="formulario-info" onSubmit="post(this,'financeiro/cadastro-empresa.php?ac=ins','.body-empresa')">
	<div class="container" style="width:100%">
		<div class="col-xs-12" style="text-align:center; padding:0px 10px 10px 10px; margin-bottom:10px;">
			<h4 style="font-family: 'Oswald', sans-serif; letter-spacing:3px;"><small>Cadastrar novo fornecedor</small></h4>
		</div>
		<div class="col-xs-4">
			<label><small>Tipo de Empresa:</small>
				<select class="form-control input-sm" name="tipo" onChange="ldy('financeiro/cadastro-empresa.php?tipo=' + $(this).val(),'.body-empresa')" required>
					<option value="" selected disabled>Selecione uma opção</option>
					<option value="fisica" <?php if($tipo == 'fisica'){ echo 'selected';} ?>>Fisica</option>
					<option value="juridica" <?php if($tipo == 'juridica'){ echo 'selected';} ?>>	Jurídica</option>
				</select>
			</label>
		</div>
			<div class="col-xs-8">
				<label><small>Razão Social:</small>
					<input type="text" id="razao_social" name="razao_social" placeholder="Nome da Empresa" size="80" class="todosInput form-control input-sm force-uppercase" autocomplete="off" required disabled />
				</label>
			</div>
			<div class="col-xs-4">
				<label><small>RG:</small>
					<input type="text" name="rg" onfocus="$(this).mask('99.999.999-*')" placeholder="__.___.___-_" class="fisica form-control input-sm" disabled required />
				</label>
			</div>
			<div class="col-xs-4">
				<label><small>CPF:</small>
					<input type="text" name="cpf" placeholder="___.___.___-__" onfocus="$(this).mask('999.999.999-99')" autocomplete="off" class="fisica form-control input-sm" disabled required />
				</label>
			</div>
			<div class="col-xs-4">
				<label><small>CNPJ:</small>
					<input type="text" name="cnpj" onblur="$('#autoco').load('financeiro/cadastro-empresa.php?ac=busca-empresa&busca=' + $(this).val() + '');" onfocus="$(this).mask('99.999.999/9999-99')" placeholder="__.___.___/____-__" autocomplete="off" class="juridica form-control input-sm" disabled required />
					<div id="autoco"></div>
				</label>
			</div>
			<div class="col-xs-4">
				<label><small>Inscrição Estadual</small>
					<input type="text" name="ins_est" autocomplete="off" placeholder="Número Inscrição Estadual" size="80" class="juridica form-control input-sm" disabled />
				</label>
			</div>
			<div class="col-xs-4">
				<label><small>Inscrição Municipal</small>
					<input type="text" name="ins_mun" autocomplete="off" placeholder="Número Inscrição Municipal" size="80" class="juridica form-control input-sm" disabled />
				</label>
			</div>
			<div class="col-xs-4">
				<label><small>E-mail</small>
					<input type="email" name="email" autocomplete="off" placeholder="E-mail para contato" size="80" class="todosInput form-control input-sm" disabled />
				</label>
			</div>
			<div class="col-xs-4">
				<label><small>Contato:</small>
					<input type="text" name="contato" autocomplete="off" placeholder="Responsável Legal" size="80" class="todosInput form-control input-sm force-uppercase" disabled />
				</label>
			</div>
			<div class="col-xs-4">
				<label><small>Telefone:</small>
					<input type="text" name="telefone_1" autocomplete="off" onfocus="$(this).mask('(99) 9999-9999')" placeholder="(__) ____-____" size="80" class="todosInput form-control input-sm" disabled />
				</label>
			</div>
			<div class="col-xs-4">
				<label><small>Celular:</small>
					<input type="text" name="telefone_2" autocomplete="off" onfocus="$(this).mask('(99) 99999999?9')" placeholder="(__) _________" size="80" class="todosInput form-control input-sm" disabled />
				</label>
			</div>
			<div class="col-xs-4">
				<label><small>Endereço para Cobrança:</small>
					<input type="text" name="endereco" autocomplete="off" placeholder="Ex: Rua Antonio Emmerich, 723" size="150" class="todosInput form-control input-sm force-uppercase" disabled />
				</label>
			</div>
			
			<div class="col-xs-2">
				<label><small>Bairro:</small>
					<input type="text" name="bairro" placeholder="Bairro" size="80" class="todosInput form-control input-sm force-uppercase" disabled />
				</label>
			</div>
			<div class="col-xs-2">
				<label><small>Cidade:</small>
					<input type="text" name="cidade" placeholder="Cidade" size="80" class="todosInput form-control input-sm force-uppercase" disabled />
				</label>
			</div>
			
			<div class="col-xs-2">
				<label><small>UF:</small>
					<input type="text" name="uf" id="uf" onfocus="$(this).mask('aa')" placeholder="XX" placeholder="UF" size="80" class="todosInput form-control input-sm force-uppercase" disabled />
				</label>
			</div>
			<div class="col-xs-2">
				<label><small>CEP:</small>
					<input type="text" name="cep" autocomplete="off" onfocus="$(this).mask('99999-999')" placeholder="_____-___" class="todosInput form-control input-sm" disabled />
				</label>
			</div>
			<div class="col-xs-12" style="text-align:center; padding:20px 0px;">
				<label for="" style="width:40% !important;">
					<input type="submit" value="Cadastrar" style="width:100%; height:40px; margin-top:10px; color:#ccc; border-radius:5px" class="btn btn-primary btn-sm">
				</label>
			</div>
		</div>
</form>