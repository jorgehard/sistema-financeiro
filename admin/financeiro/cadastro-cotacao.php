<?php
	include("../config.php");
	include("../validar_session.php");
	getData();
	getNivel();
?>
<script src="../js/combobox-resume.js"></script>
<?php if($ac == 'atu'){ ?>
								<div class="col-xs-12" style="padding:2px">
									<label><small>Fornecedor 1:</small>
										<select name="fornecedor01" class="form-control input-sm combobox">
											<option value=""> </option>
											<?php
											$sql = mysql_query("select * from notas_empresas WHERE status = '0' order by nome asc");
											while($cot = mysql_fetch_array($sql)) {
												echo '<option value="'.$cot['id'].'">'.$cot['cnpj'].' - '.$cot['nome'].'</option>';
											}
											?>
										</select>
									</label>
								</div>
								<div class="col-xs-12" style="padding:2px">
									<label><small>Fornecedor 2:</small>
										<select name="fornecedor02" class="form-control input-sm combobox">
											<option value=""> </option>
											<?php
											$sql = mysql_query("select * from notas_empresas WHERE status = '0' order by nome asc");
											while($cot = mysql_fetch_array($sql)) {
												echo '<option value="'.$cot['id'].'">'.$cot['cnpj'].' - '.$cot['nome'].'</option>';
											}
											?>
										</select>
									</label>
								</div>
								<div class="col-xs-12" style="padding:2px">
									<label><small>Fornecedor 3:</small>
										<select name="fornecedor03" class="form-control input-sm combobox">
											<option value=""> </option>
											<?php
												$sql = mysql_query("select * from notas_empresas WHERE status = '0' order by nome asc");
												while($cot = mysql_fetch_array($sql)) {
													echo '<option value="'.$cot['id'].'">'.$cot['cnpj'].' - '.$cot['nome'].'</option>';
												}
											?>
										</select>
									</label>
								</div>
<?php exit; }
if($ac == 'salvar'){
	$id_usuario_atual = $_SESSION['id_usuario_logado'];
    $insert = mysql_query("INSERT INTO cadastro_cotacao (tipo_cotacao, cidade, data_cotacao, solicitante, data_prazo, forma_pagamento, fornecedor01, forma_pagamento01, prazo01, fornecedor02, forma_pagamento02, prazo02, fornecedor03, forma_pagamento03, prazo03, user_cadastro) VALUES ('$tipo_cotacao', '$cidade', '$data_cotacao', '$solicitante', '$data_prazo', '$forma_pagamento', '$fornecedor01', '$forma_pagamento01', '$prazo01', '$fornecedor02', '$forma_pagamento02', '$prazo02', '$fornecedor03', '$forma_pagamento03', '$prazo03', '$id_usuario_atual')");
	$i_id = mysql_insert_id();
    if($insert){
		echo '<script>ldy("financeiro/editar-cotacao.php?id='.$i_id.'",".conteudo")</script>';
		exit;
    }
    
}
if($atu=='ac'){
	echo "<script>$('.disabled-control').prop('disabled', false);</script>";
	exit;
}
?>
	<div class="container-fluid" style="padding:0px 0px 15px 0px;">
		<h3 style="font-family: 'Oswald', sans-serif;letter-spacing:5px; text-align:center"> 
			<p>		<img src="http://polemicalitoral.com.br/guaruja/imagens/logo.png" style="position:relative; bottom:10px;" width="50px"/> <small>CADASTRO DE <B>COTAÇÃO</B></small></p>
		</h3>
	</div>
	<div class="retorno"></div>
	<form action="javascript:void(0)" onSubmit="post(this,'financeiro/cadastro-cotacao.php?ac=salvar','.conteudo')" class="formulario-info">	
		<div class="panel panel-default" style="width:80%; margin:0 auto;">
			<div class="panel-body" style="padding:20px; background:#FFF;">
				<label><small>Obra:</small>
					<select name="cidade" onChange="$('#itens').load('financeiro/cadastro-cotacao.php?atu=ac&cidade=' + $(this).val() + '');" class="form-control input-sm" style="width:100%" required> 
						<option value="">Selecione uma obra</option>
						<?php
							$cidade_query = mysql_query("select * from notas_obras_cidade WHERE id IN(0,$cidade_usuario) order by nome asc");
							while($l = mysql_fetch_array($cidade_query)) {
								if($l['id'] == $cidade){
									echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>';
								}else{
									echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>';
								}
							}
						?>						
					</select>
				</label>
				<div id="itens" style="width:100%"></div>
				<label><small>Tipo:</small>
					<select name="tipo_cotacao" class="form-control input-sm disabled-control" required disabled>
						<option value="1">COMPRA MATERIAL</option>
						<option value="2">PRESTAÇÃO DE SERVIÇO</option>
						<option value="3">LOCAÇÃO EQUIPAMENTO</option>
					</select>
				</label>
				<label><small>Data da Cotação:</small>
					<input type="date" name="data_cotacao" value="<?php echo $todayTotal; ?>" class="form-control input-sm disabled-control" required disabled />
				</label>
				<label><small>Solicitante:</small>
					<input type="text" name="solicitante" class="form-control input-sm disabled-control" required disabled />
				</label>
				<label style="padding:10px 0px; font-size:12px"><small>Cadastre os Fornecedores: </small> 
				<a href="index.php?controleNovo=empresa" target="_blank" class="btn btn-xs pull-right btn-primary" >Nova Empresa <span class="glyphicon glyphicon-plus"></span></a>
				
				<a href="#" onclick="ldy('financeiro/cadastro-cotacao.php?ac=atu','#ajax-atualizar')" class="btn btn-xs pull-right btn-warning" style="margin:0px 10px">Atualizar Empresas <span class="glyphicon glyphicon-refresh"></span></a>
				
				
				</label>
				<div class="alert alert-info">
					<div class="container-fluid">
						<div class="col-xs-6" style="padding:0px">
							<div id="ajax-atualizar">
								<div class="col-xs-12" style="padding:2px">
									<label><small>Fornecedor 1:</small>
										<select name="fornecedor01" class="form-control input-sm combobox">
											<option value=""> </option>
											<?php
											$sql = mysql_query("select * from notas_empresas WHERE status = '0' order by nome asc");
											while($cot = mysql_fetch_array($sql)) {
												echo '<option value="'.$cot['id'].'">'.$cot['cnpj'].' - '.$cot['nome'].'</option>';
											}
											?>
										</select>
									</label>
								</div>
								<div class="col-xs-12" style="padding:2px">
									<label><small>Fornecedor 2:</small>
										<select name="fornecedor02" class="form-control input-sm combobox">
											<option value=""> </option>
											<?php
											$sql = mysql_query("select * from notas_empresas WHERE status = '0' order by nome asc");
											while($cot = mysql_fetch_array($sql)) {
												echo '<option value="'.$cot['id'].'">'.$cot['cnpj'].' - '.$cot['nome'].'</option>';
											}
											?>
										</select>
									</label>
								</div>
								<div class="col-xs-12" style="padding:2px">
									<label><small>Fornecedor 3:</small>
										<select name="fornecedor03" class="form-control input-sm combobox">
											<option value=""> </option>
											<?php
												$sql = mysql_query("select * from notas_empresas WHERE status = '0' order by nome asc");
												while($cot = mysql_fetch_array($sql)) {
													echo '<option value="'.$cot['id'].'">'.$cot['cnpj'].' - '.$cot['nome'].'</option>';
												}
											?>
										</select>
									</label>
								</div>
							</div>
						</div>
						<div class="col-xs-6" style="padding:0px">
							<div class="col-xs-6" style="padding:2px">
								<label for=""  style="width:100%"><small>Forma Pagamento:</small>
									<input type="text" name="forma_pagamento01" class="form-control input-sm" />
								</label>
							</div>
							<div class="col-xs-6" style="padding:2px">
								<label><small>Prazo:</small>
									<input type="date" name="prazo01" class="form-control input-sm" />
								</label>
							</div>
						</div>
						<div class="col-xs-6" style="padding:0px">
							<div class="col-xs-6" style="padding:2px">
								<label><small>Forma Pagamento:</small>
									<input type="text" name="forma_pagamento02" class="form-control input-sm" />
								</label>
							</div>
							<div class="col-xs-6" style="padding:2px">
								<label><small>Prazo:</small>
									<input type="date" name="prazo02" class="form-control input-sm" />
								</label>
							</div>
						</div>
						<div class="col-xs-6" style="padding:0px">
							<div class="col-xs-6" style="padding:2px">
								<label for=""  style="width:100%"><small>Forma Pagamento:</small>
									<input type="text" name="forma_pagamento03" class="form-control input-sm" />
								</label>
							</div>
							<div class="col-xs-6" style="padding:2px">
								<label for=""  style="width:100%"><small>Prazo:</small>
									<input type="date" name="prazo03" class="form-control input-sm" />
								</label>
							</div>
						</div>
					</div>
				</div>
				<label style="text-align:center">
					<input type="submit" style="width:50%; border:none" class="btn btn-primary btn-sm" value="Avançar >">
				</label>
			</div>
		</div>
	</form>

	<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" style="width:80%;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" onclick="$('.modal').modal('hide')" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Editar Usuario</h4>
				</div>
				<div class="modal-body">
					Aguarde um momento &nbsp;&nbsp; <img src="../../imagens/loading.gif" alt="Carregando" width="20px"/>
				</div>
			</div>
		</div>
	</div>