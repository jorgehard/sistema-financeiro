<?php
	include("../config.php");
	include("../validar_session.php");
	getData();
	getNivel();
?>
<script src="../js/combobox-resume.js"></script>

<script>
	$(document).ready(function(){
		$(".up").keyup(function() {
			$(this).val($(this).val().toUpperCase());
		});
	});
</script>
<?php 
if(@$ac == 'up') {
	$q = mysql_query("UPDATE notas_equipamentos SET obs = '$obs', obra = '$obra_opcao', local = '$local', equipe = '$equipe', placa = '$placa', patrimonio = '$patrimonio', marca = '$marca', patrimonio2 = '$patrimonio2', valor = '$valor', justificativa = '$justificativa', desconto = '$desconto', patrimonio2 = '$patrimonio2', dia_pagamento = '$dia_pagamento', chassi = '$chassi', ano = '$ano',empresa = '$empresa', categoria = '$categoria', sub_categoria = '$sub_categoria', situacao = '$situacao', placa = '$placa', contrato = '$contrato', entrada = '$entrada', saida = '$saida', user_edit = '$id_usuario_logado', data_edit = now() WHERE id = $id");

	if($query) { 
		echo '<p class="text-success">Informações atualizadas</p> <script>$(".retorno").load("almoxarifado/editar-equipamento.php?id='.$id.'")</script>'; 
	}else { 
		echo '<p class="text-danger">'.mysql_error().'</p>'; 
	}
	exit;
} 
$sql = mysql_query("SELECT * FROM notas_equipamentos WHERE id = '$id'"); 
while($l = mysql_fetch_array($sql)) { 
	extract($l);
	$equipe_e = $l['equipe'];
}
?>
	<div class="ajax"></div>

	<div class="col-sm-12" style="padding:0px">
		<form action="javascript:void(0)" onSubmit="post(this,'almoxarifado/editar-equipamento.php?ac=up&id=<?php echo $id ?>','.ajax')" enctype="multipart/form-data" class="formulario-info">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h5>
						<small>Informações do Equipamento</small>
						<span class="label label-info pull-right" style="padding:10px; font-size:11px; position:absolute; top:10px; right:10px;">
						Ultima atualização: <b><?php $control_date = explode(" ",$data_edit); echo implode("/",array_reverse(explode("-",$control_date[0])))." ".$control_date[1] ?></b>
						</span>
					</h5>
				</div>
				<div class="panel-body" style="width:100%">	
					<div class="col-xs-12 col-sm-4">
						<div class="col-xs-6">
							<label style="width:100%">Placa: <br/> <input type="text" name="placa" value="<?php echo $placa; ?>" class="form-control input-sm"  onfocus="$(this).mask('aaa-9999')"></label>
						</div>
						<div class="col-xs-6">
							<label style="width:100%">Patrimonio: <br/><input type="text" name="patrimonio" value="<?php echo $patrimonio; ?>" class="form-control input-sm up"  required></label>
						</div>
						<div class="col-xs-6">
							<label style="width:100%">Marca: </br><input type="text" name="marca" value="<?php echo $marca; ?>" class="form-control input-sm up" required></label>
						</div>
						<div class="col-xs-6">
							<label style="width:100%">Contrato: <br><input type="text" name="patrimonio2" value="<?php echo $patrimonio2; ?>" class="form-control input-sm"></label>
						</div>
						<div class="col-xs-6">
							<label style="width:100%">Valor: <br><input type="number" step="0.1" name="valor" value="<?php echo $valor; ?>" class="form-control input-sm"  required></label>
						</div>
						<div class="col-xs-6">
							<label style="width:100%">Dia Pagamento: <br><input type="text" name="dia_pagamento" value="<?php echo $dia_pagamento; ?>" class="form-control input-sm"  required></label>
						</div>
						<div class="col-xs-6">
							<label style="width:100%">Desconto: <br><input type="text" name="justificativa" value="<?php echo $justificativa; ?>" class="form-control input-sm"  required /></label>
						</div>
						
						<div class="col-xs-6">
							<label style="width:100%">Desconto: <br><input type="number" name="desconto" value="<?php echo $desconto; ?>" step="0.01" class="form-control input-sm"  required /></label>
						</div>
						<div class="col-xs-6">
							<label style="width:100%">Ano: <br><input type="text" name="ano" value="<?php echo $ano; ?>" class="form-control input-sm"  required></label>
						</div>
						<div class="col-xs-6">
							<label style="width:100%">Chassi / Nº série: <br><input style="width:100%;"type="text" name="chassi" value="<?php echo $chassi; ?>" class="form-control input-sm up"  required></label>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4">
						<div class="col-xs-12">
							<label>Empresa: <br>
								<select name="empresa" class="form-control input-sm combobox" >
									<option value="0"></option>
									<?php 
										$categorias = mysql_query("select * from notas_empresas WHERE status = 0 order by nome asc");
										while($l = mysql_fetch_array($categorias)) {
											if($empresa==$l['id']) { 
												echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>'; 
											} else { 
												echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>'; 
											}
										}
									?>			
								</select>
							</label>
						</div>
						<div class="col-xs-12">
							<label for "" style="width:100%"> Categoria & Sub-Categoria: 
								<select name="categoria" onChange="$('#itens23').load('almoxarifado/sub-cat-eq.php?categoria=' + $(this).val() + '');" style="width:100%" class="form-control input-sm" id="categ">
									<option value="0">SELECIONE UMA CATEGORIA</option>
									<?php 
										$categorias = mysql_query("select * from notas_cat_e where oculto = '0' order by descricao asc");
										while($l = mysql_fetch_array($categorias)) {
											if($categoria==$l['id']) {
												echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>'; 
											} else { 
												echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>'; 
											}
										}
									?>		
								</select>
							</label>
						</div>
						<div class="col-xs-12">
							<label id="itens23" style="width:100%">
								<label style="width:100%">
									<select name="sub_categoria" style="width:100%" class="form-control input-sm">
										<option>SELECIONE UMA SUB-CATEGORIA PRIMEIRO!</option>
										<?php 
											$sub_categorias = mysql_query("select * from notas_cat_sub where associada = $categoria order by descricao asc");
											while($l = mysql_fetch_array($sub_categorias)) {
												if($sub_categoria==$l['id']) { 
													echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>'; 
												} else { 
													echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>'; 
												}
											}
										?>		

									</select>
								</label>
							</label>
						</div>
						<div class="col-xs-12">
							<label>Observações: <br><input type="text" maxlength="300" style="height: 100px;" size="300" name="obs" value="<?php echo $obs; ?>" class="form-control input-sm"></textarea></label>
						</div>
					</div>
		
					<div class="col-xs-12 col-sm-4">
						<div class="col-xs-6">
							<label style="width:100%">Situação: <br>
								<select name="situacao" class="form-control input-sm" >
									<?php 
										$situacoes = mysql_query("select * from notas_eq_situacao where status = '0' order by descricao asc");
										while($l = mysql_fetch_array($situacoes)) {
											if($situacao==$l['id']) { echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>'; }
											else { echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>'; }
										}
									?>			
								</select>
							</label>
						</div>
						<div class="col-xs-6">
							<label>Obra:
								<select name="obra_opcao" class="form-control dropdown input-sm">
									<?php
										$obras = mysql_query("select * from notas_obras WHERE status = '0' and id IN($obra_usuario) ORDER BY descricao");
										while($l = mysql_fetch_array($obras)) { 
											if($l['id']==$obra) { echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>'; }
											else { echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>'; }
										}
									?>		
								</select>
							</label>
						</div>
						<div class="col-xs-12">
							<label style="width:100%">Responsável: <br>
								<select name="local" class="form-control input-sm combobox" required>
									<option value="0">00._SEM RESPONSAVEL</option>	
									<?php 
										$categorias = mysql_query("select * from rh_funcionarios where demissao = '0000-00-00' and obra IN($obra_usuario) order by nome asc");
										while($l = mysql_fetch_array($categorias)) {
											if($l['id']==$local) { echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>'; }
											else { echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>'; }
										}
									?>			
								</select>
							</label>
						</div>
						<div class="col-xs-12">
							<label style="width:100%">Equipe: <br>
								<select name="equipe" class="form-control input-sm combobox">
									<option value="0">00._SEM EQUIPE</option>	
									<?php 
										$equipes = mysql_query("select * from equipes where id <> 0 and status = 0 and oculto = 1 and obra IN($cidade_usuario) order by nome asc");
										while($l = mysql_fetch_array($equipes)) {
											if($l['id']==$equipe_e) { echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>'; }
											else { echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>'; }
										}
									?>			
								</select>
							</label>
						</div>
						<div class="col-xs-6">
							<label style="width:100%">Status: 
								<select class="form-control input-sm" name="status_2" disabled>
									<option value=""></option>
									<?php 
										$status_dois = mysql_query("select * from status_2 order by descricao asc");
										while($l = mysql_fetch_array($status_dois)) {
											if($l['id']==$status_2) { echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>'; }
											else { echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>'; }
										}
									?>	
								</select>
							</label>	
						</div>
						<div class="col-xs-6">
							<label style="width:100%">Tipo de contrato: <br>
								<select name="contrato" class="form-control input-sm" >
									<option value="0"></option>	
									<?php 
										$contratos = mysql_query("select * from rh_contratos order by nome asc");
										while($l = mysql_fetch_array($contratos)) {
											if($l['id']==$contrato) { echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>'; }
											else { echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>'; }
										}
									?>			
								</select>
							</label>
						</div>
						<div class="col-xs-6">
							<label style="width:100%">Entrada: <br><input type="date" name="entrada" value="<?php echo $entrada ?>" class="form-control input-sm" ></label>
						</div>
						<div class="col-xs-6">
							<label style="width:100%">Saída: <br><input type="date" name="saida" value="<?php echo $saida ?>" class="form-control input-sm"   ></label><br/>
						</div>
						
						<div class="col-xs-12">
							<label>
								<input type="submit" style="width:100%; height:30px; margin-top:20px" value="Atualizar" class="btn btn-info btn-sm">
							</label>
						</div>
					</div>
				</div>
			</div>
		</form>
<!---------------------- FORMULARIOS ABAIXO ------------------------>
		<div class="panel panel-info">
			<div class="panel-heading"><h5><small>Incluir foto ao equipamento</small></h5></div>
			<center>
				<div class="panel-body" style="width:100%">
					<?php 
						if($imagem <> '') { echo '<td><img src="almoxarifado/uploads/'.$imagem.'" alt="" class="img-thumbnail"></td>'; }
							echo '<form action="almoxarifado/upload_eq.php?id='.$id.'&img='.$imagem.'" enctype="multipart/form-data" method="POST" target="ifrm">';
							echo '<label>Imagem: <br/><input type="file" style="width:100%" name="myfile" class="form-control input-sm"></label><br/>';
							echo '<label><input type="submit" style="width:100px" class="btn btn-info btn-sm" value="Enviar"></label>'; 	
							echo '</form>';
					?>
				</div>
			</center>
		</div>
		<iframe name="ifrm" style="display:none"></iframe>
		<!-- DESCONTOS -->
		<div class="panel panel-success">
			<div class="panel-heading"><h5><small> Historico de Descontos</small></h5></div>
			<div class="desconto" style="padding:15px;">
				<form action="javascript:void(0)" onsubmit="post(this,'almoxarifado/listar-desconto.php?ac=add&id=<?php echo $id;?>','.listar-desconto')" class="formulario-success">
						<table class="table table-responsive table-condensed table-green" style="font-size:11px">
							<thead>
								<tr><th>Descrição</th><th>Valor</th><th>Data</th><th>Tipo</th><th></th></tr>
							</thead>
							<tbody>
						<tr>
							<td width="50%">
								<label><input type="text" maxlength="250" style="width:100%;" class="form-control input-sm" name="obs" required></label>
							</td>
							<td width="10%">
								<label>
									<input type="number" step="0.01"  name="valor" placeholder="R$" style="width:100%" class="form-control input-sm" required>
								</label>
							</td>
							<td width="10%">
								<label>
									<input type="date" name="data" style="width:100%" value="<?php echo $todayTotal?>" max="<?php echo $todayTotal?>" class="form-control input-sm" required>
								</label>
							</td>
							<td width="10%">
								<label>
									<select name="tipo" class="form-control input-sm">
										<option value="0">DESCONTO</option>
										<option value="1">RESSARCIMENTO</option>
									</select>
								</label>
							</td>
							<td width="10%">
								<label style="width:100%;">
									<input type="submit" style="width:100%;" class="btn btn-success btn-sm" value="Inserir" /></label>
							</td>
						</tr>
							</tbody>
						</table>
				</form>
				<script>ldy("almoxarifado/listar-desconto.php?id=<?php echo $id;?>",".listar-desconto")</script>
				<div class="listar-desconto"></div>
			</div>
		</div>
		<!-- HISTORICO -->
		<div class="panel panel-success">
			<div class="panel-heading"><h5>Inserir <small> Historico de informações</small></h5></div>
			<div class="historico" style="padding:15px;">
				<form action="javascript:void(0)" onsubmit="post(this,'almoxarifado/listar-historico.php?ac=add&id=<?php echo $id;?>','.listar-historico')" class="formulario-success">
						<table class="table table-responsive table-condensed table-striped table-green" style="background:#FFF; font-size:11px">
							<thead>
								<tr>
									<th>Descricao</th>
									<th colspan="2">Atual</th>
									<th colspan="2">Proxima</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td width="50%">
										<label>Descrição:
											<input type="text" maxlength="200" style="width:100%;" class="form-control input-sm" name="historico" required></label>
									</td>
									<td width="10%">
										<label>Data: <input type="date" name="data" style="width:100%" value="<?php echo $todayTotal?>" max="<?php echo $todayTotal?>" class="form-control input-sm" required></label>
									</td>
									<td width="10%">
										<label>KM: <input type="number" step="0.01"  name="km" style="width:100%" class="form-control input-sm" required></label>
									</td>
									<td width="10%">
										<label>Data: <input type="date" name="data2" style="width:100%" value="<?php echo $todayTotal?>" class="form-control input-sm"></label>
									</td>
									<td width="10%">
										<label>KM: <input type="number" step="0.01" name="km2" style="width:100%" class="form-control input-sm"></label>
									</td>
									<td width="10%">
										<label style="width:100%"><br/>
											<input type="submit" style="width:100%;" class="btn btn-success btn-sm" value="Inserir" />
										</label>
									</td>
								</tr>
							</tbody>
						</table>
				</form>
				<script>ldy("almoxarifado/listar-historico.php?id=<?php echo $id; ?>",".listar-historico")</script>
				<div class="listar-historico"></div>
			</div>
		</div>
	</div>