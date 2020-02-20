<?php 
	require_once("../config.php");
	require_once("../validar_session.php");
	getData();
	getNivel();
?>
<script src="../js/combobox-resume.js"></script>

<?php
if(@$up == 'taxas'){
	$valorInput2 = str_replace("R$ ", "", $valorInput2); 
	$valorInput2 = str_replace(".", "", $valorInput2); 
	$valorInput2 = str_replace(",", ".", $valorInput2);
	
	$query2 = mysql_query("INSERT INTO conta_taxas (obra, conta, valor, data_operacao, obs) VALUES ('$obra2', '$conta2', '$valorInput2', '$dataInput2', '$obsInput2')");
	if($query2) {
		echo '<div class="alert alert-success" id="alert1">
			<strong>Sucesso!!!</strong> Taxas cadastradas com sucesso.
			</div>';
	}else{
		echo mysql_error();
	}
	exit;
}
if(@$up == 'transferencia'){
	$valorInput = str_replace("R$ ", "", $valorInput); 
	$valorInput = str_replace(".", "", $valorInput); 
	$valorInput = str_replace(",", ".", $valorInput);

	$query1 = mysql_query("INSERT INTO conta_operacoes (obra, conta_entrada, conta_saida, valor_operacao , data_operacao, obs) VALUES ('$obra', '$conta_entrada', '$conta_saida', '$valorInput', '$dataInput', '$obsInput')");
	if($query1) {
		echo '<div class="alert alert-success" id="alert1">
						<strong>Sucesso!!!</strong> Transferência cadastrada com sucesso.
					</div>';
	}else{
		echo mysql_error();
	}
	exit;
}
if($atu=='ac2'){
	echo '<div class="col-xs-6" style="padding:5px; margin-bottom:10px">';
	echo '<label for="" style="width:100%"><small>Filial:</small> 
			<select name="obra2" class="form-control input-sm" style="width:100%" required>';
			$obras = mysql_query("select * from notas_obras where cidade IN($cidade) and id in($obra_usuario) AND id <> '0' AND status = '0' order by descricao asc");
			while($l = mysql_fetch_array($obras)) {
				echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>';
			}
		echo '</select>
	</label>';
	echo '</div>';
	echo '<div class="col-xs-6" style="padding:5px; margin-bottom:10px">';
	echo '<label for="" style="width:100%"><small>Data Operação:</small> 
			<input type="date" name="dataInput2" class="form-control input-sm" style="width:100%" required />
	</label>';
	echo '</div>';
		echo '<div class="col-xs-6 alert alert-danger" style="padding:5px; text-align:center; border:none; border-radius:0px;">';
	echo '<label for="" style="width:100%"><small>Conta:</small> 
			<select name="conta2" class="form-control input-sm" style="width:100%" required>';
			$obras = mysql_query("select * from equipes where obra IN($cidade) AND status = '0' order by nome asc");
			while($l = mysql_fetch_array($obras)) {
				echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>';
			}
		echo '</select>
	</label>';
	echo '</div>';
	echo '<div class="col-xs-6 alert alert-danger" style="padding:5px; text-align:center; border:none; border-radius:0px;">';
	echo '<label for="" style="width:100%"><small>Valor:</small> 
			<input type="text" onInput="$(this).maskMoney({symbol:\'R$ \',showSymbol:true, thousands:\'.\', decimal:\',\', symbolStay: true});" placeholder="R$" name="valorInput2" class="form-control input-sm" style="width:100%" required />
	</label>';
	echo '</div>';
	
	exit;
}
if($atu=='ac'){
	echo '<div class="col-xs-12" style="padding:0px; margin-bottom:10px">';
	echo '<label for="" style="width:100%"><small>Filial:</small> 
			<select name="obra" class="form-control input-sm" style="width:100%" required>';
			$obras = mysql_query("select * from notas_obras where cidade IN($cidade) and id in($obra_usuario) AND id <> '0' AND status = '0' order by descricao asc");
			while($l = mysql_fetch_array($obras)) {
				echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>';
			}
		echo '</select>
	</label>';
	echo '</div>';
	echo '<div class="col-xs-6 alert alert-danger" style="padding:5px; text-align:center; border:none; border-radius:0px;">';
	echo '<label for="" style="width:100%"><small>Conta de Saida:</small> 
			<select name="conta_saida" class="form-control input-sm" style="width:100%" required>';
			$obras = mysql_query("select * from equipes where obra IN($cidade) AND status = '0' order by nome asc");
			while($l = mysql_fetch_array($obras)) {
				echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>';
			}
		echo '</select>
	</label>';
	echo '</div>';
	echo '<div class="col-xs-6 alert" style="padding:5px; text-align:center;">';
	echo '<label for="" style="width:100%"><small>Valor:</small> 
			<input type="text" onInput="$(this).maskMoney({symbol:\'R$ \',showSymbol:true, thousands:\'.\', decimal:\',\', symbolStay: true});" placeholder="R$" name="valorInput" class="form-control input-sm" style="width:100%" required />
	</label>';
	echo '</div>';
	
	
	echo '<div class="col-xs-6 alert alert-success" style="padding:5px; text-align:center; border:none; border-radius:0px;">';
	echo '<label for="" style="width:100%"><small>Conta de Entrada:</small> 
			<select name="conta_entrada" class="form-control input-sm" style="width:100%" required>';
			$obras = mysql_query("select * from equipes where obra IN($cidade) AND status = '0' order by nome asc");
			while($l = mysql_fetch_array($obras)) {
				echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>';
			}
		echo '</select>
	</label>';
	echo '</div>';
	
	echo '<div class="col-xs-6 alert" style="padding:5px; text-align:center;">';
	echo '<label for="" style="width:100%"><small>Data Operação:</small> 
			<input type="date" name="dataInput" class="form-control input-sm" style="width:100%" required />
	</label>';
	echo '</div>';
	exit;
}
?>
<div class="retorno"> </div>
	<div class="col-xs-2" style="padding:0px 10px;">
					<nav class="navbar-lateral">
						<div class="container-fluid" style="padding:0px">
							<div class="sessao-lateral">
								<?php
								$hr_v = date("H");
								if($hr_v >= 12 && $hr<18) {
									$resp = "Boa tarde";
								}else if ($hr_v >= 0 && $hr_v <12 ){
									$resp = "Bom dia";
								}else{
									$resp = "Boa noite";
								}
								echo $resp.', <span style="font-weight:bold" class="text-warning">'.strtoupper($nome_login).'</span>';
								?>
							</div>
							<div class="sessao-lateral">
								<span class="linha"><?= strtoupper("Litoral Rent Locadora E Construcoes Ltda"); ?></span>
								<span class="linha">CNPJ: 024.094.902/0001-00</span>
								<span class="linha">Telefone: (13) 3043-4211</span>
							</div>
							<div class="sessao-lateral">
								<span class="linha">Ultimo Login:</span>
								<?php
									$data_view_h = new DateTime($ultimo_login_view);
									echo '<span class="linha">'.$data_view_h->format('d/m/Y H:i').'</span>';
								 ?>
							</div>
							<div class="sessao-lateral-2">
								<h4 class="title-box-2"> <i class="fa fa-money" aria-hidden="true"></i> Saldo da Conta</h4>
								<div class="sessao-body-2">
									- informações<br/>
									- informações<br/>
									- informações<br/>
									- informações<br/>
								
								</div>
							</div>
							<div class="sessao-lateral-2">
								<h4 class="title-box-2"> <i class="fa fa-money" aria-hidden="true"></i> Outras funções</h4>
								<div class="sessao-body-2">
									- informações<br/>
									- informações<br/>
									- informações<br/>
									- informações<br/>
								
								</div>
							</div>
						</div>
					</nav>
	</div>
	<div class="col-xs-10" style="padding:0px 10px;">
		<div class="ajax1"></div>
		<div class="col-xs-6">
			<form action="javascript:void(0)" class="formulario-info" onSubmit="post(this,'financeiro/cadastro-transferencia.php?up=transferencia','.ajax1')">
			<div class="container-fluid box-dashboard">
				<div class="panel panel-default" style="width:100%; margin:0px;">
					<h4 class="title-box"> <i class="fa fa-files-o" aria-hidden="true"></i> Controle de Transferências
						<a href="#" onclick="ldy('financeiro/cadastro-transferencia.php','.conteudo')" class="pull-right button-top-box"><i class="fa fa-repeat"></i></a>
					</h4>
					<div class="panel-body " style="padding:20px; background:#FFF;">
						<div class="col-xs-12 col-md-12">
							<label for="" style="width:100%"><small>Empresa:</small><br/>
								<select name="cidade" onChange="$('#itens-obra').load('financeiro/cadastro-transferencia.php?atu=ac&cidade=' + $(this).val() + '');" style="width:100%" class="form-control input-sm" required> 
									<option value="" disabled selected>Selecione uma obra</option>
										<?php
												$cidade = @mysql_query("select * from notas_obras_cidade WHERE id IN($cidade_usuario) AND id <> '0' order by nome asc");
												while($l = @mysql_fetch_array($cidade)) {
													echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>';
												}
										?>	
								</select>
							</label>
							<label id="itens-obra" style="width:100%">
								<div class="col-xs-12" style="padding:0px; margin-bottom:10px">
									<label for="" style="width:100%"><small>Filial:</small> 
										<select name="obra" class="form-control input-sm" style="width:100%" required>
											<option value="">Selecione uma obra</option>
										</select>
									</label>
								</div>	
								<div class="col-xs-6 alert alert-danger" style="padding:5px; text-align:center; border:none; border-radius:0px;">
									<label for="" style="width:100%"><small>Conta de Saida:</small> 
										<select name="conta" class="form-control input-sm" style="width:100%" disabled >
											<option value=""> - </option>
										</select>
									</label>
								</div>
								<div class="col-xs-6 alert" style="padding:5px; text-align:center;">
									<label for="" style="width:100%"><small>Valor:</small> 
										<input type="text" onInput="$(this).maskMoney({symbol:'R$ ',showSymbol:true, thousands:'.', decimal:',', symbolStay: true});" placeholder="R$" name="valorInput" class="form-control input-sm" style="width:100%" disabled />
									</label>
								</div>
								<div class="col-xs-6 alert alert-success" style="padding:5px; text-align:center; border:none; border-radius:0px;">
									<label for="" style="width:100%"><small>Conta de Entrada:</small> 
										<select name="conta" class="form-control input-sm" style="width:100%" disabled >
											<option value="">-</option>
										</select>
									</label>
								</div>
								<div class="col-xs-6 alert" style="padding:5px; text-align:center">
									<label for="" style="width:100%"><small>Data Operação:</small> 
										<input type="date" name="dataInput" class="form-control input-sm" style="width:100%" disabled />
									</label>
								</div>
							</label>
							<div class="col-xs-12" style="padding:0px">
								<label for="" style="width:100%"><small>Observações:</small>
									<textarea id="summernote" cols="100" rows="10" class="form-control input-sm" name="obsInput" style="resize:none; height:55px"></textarea>
								</label>
							</div>
							
						</div>
						<div class="col-xs-12" style="text-align:center">
							<label for="" style="width:80% !important;">
								<input type="submit" value="Cadastrar" style="width:100%; height:40px; margin-top:10px; color:#FFF; border-radius:5px" class="btn btn-primary btn-sm">
							</label>
						</div>
					</div>
				</div>
			</div>
			</form>
		</div>
		<!--- TAXAS E JUROS --------->
		<div class="col-xs-6">
			<form action="javascript:void(0)" class="formulario-info" onSubmit="post(this,'financeiro/cadastro-transferencia.php?up=taxas','.ajax1')">
			<div class="container-fluid box-dashboard">
				<div class="panel panel-default" style="width:100%; margin:0px;">
					<h4 class="title-box"> <i class="fa fa-files-o" aria-hidden="true"></i> Lançamento Taxas & Juros
						<a href="#" onclick="ldy('financeiro/cadastro-transferencia.php','.conteudo')" class="pull-right button-top-box"><i class="fa fa-repeat"></i></a>
					</h4>
					<div class="panel-body " style="padding:20px; background:#FFF;">
						<div class="col-xs-12 col-md-12">
							<label for="" style="width:100%"><small>Empresa:</small><br/>
								<select name="cidade" onChange="$('#itens-obra22').load('financeiro/cadastro-transferencia.php?atu=ac2&cidade=' + $(this).val() + '');" style="width:100%" class="form-control input-sm" required> 
									<option value="" disabled selected>Selecione uma obra</option>
										<?php
												$cidade = @mysql_query("select * from notas_obras_cidade WHERE id IN($cidade_usuario) AND id <> '0' order by nome asc");
												while($l = @mysql_fetch_array($cidade)) {
													echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>';
												}
										?>	
								</select>
							</label>
							<label id="itens-obra22" style="width:100%">
								<div class="col-xs-6" style="padding:5px; margin-bottom:10px">
									<label for="" style="width:100%"><small>Filial:</small> 
										<select name="obra2" class="form-control input-sm" style="width:100%" disabled >
											<option value="">Selecione uma obra</option>
										</select>
									</label>
								</div>
								<div class="col-xs-6" style="padding:5px; margin-bottom:10px">
									<label for="" style="width:100%"><small>Data Operação:</small> 
										<input type="date" name="dataInput2" class="form-control input-sm" style="width:100%" disabled />
									</label>
								</div>
								<div class="col-xs-6 alert alert-danger" style="padding:5px; text-align:center; border:none; border-radius:0px;">
									<label for="" style="width:100%"><small>Conta:</small> 
										<select name="conta2" class="form-control input-sm" style="width:100%" disabled>
											<option value="">Selecione uma obra</option>
										</select>
									</label>
								</div>
								<div class="col-xs-6 alert alert-danger" style="padding:5px; text-align:center; border:none; border-radius:0px;">
									<label for="" style="width:100%"><small>Valor:</small> 
										<input type="text" onInput="$(this).maskMoney({symbol:'R$ ',showSymbol:true, thousands:'.', decimal:',', symbolStay: true});" placeholder="R$" name="valorInput2" class="form-control input-sm" style="width:100%" disabled />
									</label>
								</div>
							</label>
							<div class="col-xs-12" style="padding:0px">
								<label for="" style="width:100%"><small>Observações:</small>
									<textarea id="summernote" cols="100" rows="10" class="form-control input-sm" name="obsInput2" style="resize:none; height:55px"></textarea>
								</label>
							</div>
						</div>
						<div class="col-xs-12" style="text-align:center">
							<label for="" style="width:80% !important;">
								<input type="submit" value="Cadastrar" style="width:100%; height:40px; margin-top:10px; color:#fff; border-radius:5px" class="btn btn-primary btn-sm">
							</label>
						</div>
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>