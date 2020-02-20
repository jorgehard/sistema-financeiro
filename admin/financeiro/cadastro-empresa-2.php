<?php 
	include('../config.php');
	include('../validar_session.php'); 

	if($tipo == 'fisica'){
		echo "<script>$('.fisica').prop('disabled', false);</script>";
		echo "<script>$('.juridica').prop('disabled', true);</script>";
		echo "<script>$('.todosInput').prop('disabled', false);</script>";
	}else if($tipo == 'juridica'){
		echo "<script>$('.juridica').prop('disabled', false);</script>";
		echo "<script>$('.fisica').prop('disabled', true);</script>";
		echo "<script>$('.todosInput').prop('disabled', false);</script>";
	}
?>
	<script>
	  $(function () {
		$('input').iCheck({
		  checkboxClass: 'icheckbox_square-blue',
		  radioClass: 'iradio_square-blue',
		  increaseArea: '20%' // optional
		});
	  });
	</script>
<?php
	if(isset($ac)){
		if($tipo == 'fisica'){
			$count = mysql_num_rows(mysql_query("select * from notas_empresas where cpf = '$cpf'"));
			if($count != 0){
				echo '
				<div class="alert alert-danger" id="alert1">
					<h4>Pessoa Fisica já cadastrada!</h4>

					<p>O CPF: '.$cpf.' ja está cadastrada no sistema, favor consultar as empresas ja cadastradas e tentar novamente!!!</p>
				</div>';
			}else{
				$query = mysql_query("insert into notas_empresas (nome,rg,cpf,telefone_1,telefone_2,contato,endereco,email,cc,ag,banco, cc2, ag2, banco2, favorecido, cnpj_favorecido, tipo, cidade_emp, inicio_emp, tiposervico, valorporc, funcionarios, materiais, equipamentos, veiculo, abastecimento, descontar_funcionarios, descontar_materiais, descontar_equipamentos, descontar_veiculo, descontar_abastecimento, obs) values ('$nome','$rg','$cpf','$telefone_1','$telefone_2','$contato','$endereco','$email','$cc','$ag','$banco', '$cc2', '$ag2', '$banco2', '$favorecido', '$cnpj_favorecido', 1, '$cidade_emp', '$inicio_emp', '$tiposervico', '$valorporc', '$funcionarios', '$materiais', '$equipamentos', '$veiculo', '$abastecimento', '$descontar_funcionarios', '$descontar_materiais', '$descontar_equipamentos', '$descontar_veiculo', '$descontar_abastecimento', '$obs')") or die (mysql_error()); 
				
				if($query){
					echo '
					<div class="alert alert-success" id="alert1">
						<h4>Empresa Cadastrada!</h4>

						<p>O CPF: '.$cpf.' de seu portador '.$nome.' foi cadastrada com sucesso no sistema!!!</p>
					</div>';
				}
			}
			echo "<script> $('html, body').animate({ scrollTop: $('#alert1').offset().top }, 'slow'); </script>";
		}else if($tipo == 'juridica'){
			$count = mysql_num_rows(mysql_query("select * from notas_empresas where cnpj = '$cnpj'"));
			if($count != 0){
				echo '
				<div class="alert alert-danger" id="alert1">
					<h4>Empresa já cadastrada!</h4>

					<p>O CNPJ: '.$cnpj.' ja está cadastrada no sistema, favor consultar as empresas ja cadastradas e tentar novamente!!!</p>
				</div>';
			}else{
				$query = mysql_query("insert into notas_empresas (nome,cnpj,cc,ag,banco,telefone_1,telefone_2,endereco,email,ins_est,ins_mun,contato,fundada, cc2, ag2, banco2, favorecido, cnpj_favorecido, obs) values ('$nome','$cnpj','$cc','$ag','$banco','$telefone_1','$telefone_2','$endereco','$email','$ins_est','$ins_mun','$contato','$fundada', '$cc2', '$ag2', '$banco2', '$favorecido', '$cnpj_favorecido', '$obs')") or die (mysql_error());
				
				if($query){
					echo '
					<div class="alert alert-success" id="alert1">
						<h4>Empresa Cadastrada!</h4>

						<p>O CNPJ: '.$cnpj.' de nome '.$nome.' foi cadastrada com sucesso no sistema!!!</p>
					</div>';
				}
			}
			echo "<script> $('html, body').animate({ scrollTop: $('#alert1').offset().top }, 'slow'); </script>";
		}
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
			<div class="col-xs-4">
				<label><small>Razão Social:</small>
					<input type="text" name="nome" placeholder="Nome da Empresa" size="80" class="todosInput form-control input-sm" required disabled />
				</label>
			</div>
			<div class="col-xs-4">
				<label><small>RG:</small>
					<input type="text" name="rg" onfocus="$(this).mask('99.999.999-*')" placeholder="__.___.___-_" class="fisica form-control input-sm" disabled required />
				</label>
			</div>
			<div class="col-xs-4">
				<label><small>CPF:</small>
					<input type="text" name="cpf" placeholder="___.___.___-__" onfocus="$(this).mask('999.999.999-99')" class="fisica form-control input-sm" disabled required />
				</label>
			</div>
			<div class="col-xs-4">
				<label><small>CNPJ:</small>
					<input type="text" name="cnpj" onfocus="$(this).mask('99.999.999/9999-99')" placeholder="__.___.___/____-__" class="juridica form-control input-sm" disabled required />
				</label>
			</div>
			<div class="col-xs-4">
				<label><small>Inscrição Federal</small>
					<input type="text" name="ins_est" placeholder="Número Inscrição Federal" size="80" class="juridica form-control input-sm" disabled />
				</label>
			</div>
			<div class="col-xs-4">
				<label><small>Inscrição Municipal</small>
					<input type="text" name="ins_mun" placeholder="Número Inscrição Municipal" size="80" class="juridica form-control input-sm" disabled />
				</label>
			</div>
			<div class="col-xs-4">
				<label><small>Telefone:</small>
					<input type="text" name="telefone_1" onfocus="$(this).mask('(99) 9999-9999')" placeholder="(__) ____-____" size="80" class="todosInput form-control input-sm" disabled />
				</label>
			</div>
			<div class="col-xs-4">
				<label><small>Celular:</small>
					<input type="text" name="telefone_2"  onfocus="$(this).mask('(99) 99999999?9')" placeholder="(__) _________" size="80" class="todosInput form-control input-sm" disabled />
				</label>
			</div>
			<div class="col-xs-4">
				<label><small>Contato:</small>
					<input type="text" name="contato" placeholder="Responsável Legal" size="80" class="todosInput form-control input-sm" disabled />
				</label>
			</div>
			<div class="col-xs-4">
				<label><small>Endereço:</small>
					<input type="text" name="endereco" placeholder="Endereço para Cobrança" size="80" class="todosInput form-control input-sm" disabled />
				</label>
			</div>
			<div class="col-xs-4">
				<label><small>E-mail</small>
					<input type="email" name="email" placeholder="E-mail para contato" size="80" class="todosInput form-control input-sm" disabled />
				</label>
			</div>
			<div class="col-xs-12" style="padding:10px 0px">
				<div class="col-xs-4">
					<center><small>Conta Bancaria (Numero 1)</small></center>
					<div class="col-xs-12" style="padding:0px">
						<label><small>Conta:</small>
							<input type="text" name="cc" placeholder="Número da Conta"  class="todosInput form-control input-sm" disabled />
						</label>
					</div>
					<div class="col-xs-12" style="padding:0px">
						<label><small>Agência:</small>
							<input type="text" name="ag" placeholder="Agência e Digito" class="todosInput form-control input-sm" disabled />
						</label>
					</div>
					<div class="col-xs-12" style="padding:0px">
						<label><small>Banco:</small>
							<input type="text" name="banco" placeholder="Banco" class="todosInput form-control input-sm" disabled />
						</label>
					</div>
				</div>
				<div class="col-xs-4" >
					<center><small>Conta Bancaria (Numero 2)</small></center>
					<div class="col-xs-12" style="padding:0px">
						<label><small>Conta:</small>
							<input type="text" name="cc2" placeholder="Número da Conta"  class="todosInput form-control input-sm" disabled />
						</label>
					</div>
					<div class="col-xs-12" style="padding:0px">
						<label><small>Agência:</small>
							<input type="text" name="ag2" placeholder="Agência e Digito" class="todosInput form-control input-sm" disabled>
						</label>
					</div>
					<div class="col-xs-12" style="padding:0px">
						<label><small>Banco:</small>
							<input type="text" name="banco2" placeholder="Banco" class="todosInput form-control input-sm" disabled>
						</label>
					</div>
				</div>
				<div class="col-xs-4">
					<center><small>Favorecido</small></center>
					<div class="col-xs-12" style="padding:0px">
						<label><small>Favorecido:</small>
							<input type="text" name="favorecido" placeholder="Nome do favorecido"  class="todosInput form-control input-sm" disabled />
						</label>
					</div>
					<div class="col-xs-12" style="padding:0px">
						<label><small>CNPJ/CPF:</small>
							<input type="text" name="cnpj_favorecido" class="todosInput form-control input-sm" disabled />
						</label>
					</div>
				</div>
			</div>
			<div class="col-xs-12">
				<label>Observações:
					<textarea name="obs" class="todosInput form-control input-sm" style="resize:none"></textarea>
				</label>
			</div>
			<div class="box-footer" style="text-align:center;">
				<input type="submit" style="width:50%; margin:20px 0px;" class="btn btn-success btn-sm submit-empresa" value="Salvar">
			</div>
		</form>
	</div>
</section>

<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:auto;">
	<div class="modal-dialog">
		<div class="modal-content"> 
			<div class="modal-header box box-info" style="margin:0px;">
				<button type="button" class="close" onclick="$('.modal').modal('hide'); $('.modal-body').empty()" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Painel Situações</h4>
			</div>
			<div class="modal-body">
				Aguarde um momento &nbsp;&nbsp; <img src="../style/img/loading.gif" alt="Carregando" width="20px"/>
			</div>
		</div>
	</div>
</div>
