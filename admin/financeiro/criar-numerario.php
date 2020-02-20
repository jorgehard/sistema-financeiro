<?php
	include("../config.php");
	include("../validar_session.php");
	getData();
	getNivel();

if($ac == 'puxar_num'){ 
	$valor_num = mysql_result(mysql_query("select * from notas_numerario WHERE obra = $obra_controle ORDER BY numero DESC LIMIT 1"),0,"numero")+1;
	echo '
	<label id="itens" style="width:100%">
		<small>Número da Solicitação:</small><br/> 
		<input type="number" step="1" name="numero" placeholder="Nº" class="form-control" value="'.$valor_num.'" style="width:100%" required>
	</label>';
	exit;
}
	if($atu=='ac'){
		echo '<label style="width:100%"><small>Contrato:</small> <br/>';
		echo '<select name="obra" class="form-control input-sm" onChange="$(\'#itens\').load(\'financeiro/criar-numerario.php?ac=puxar_num&obra_controle=\' + $(this).val() + \'\');" style="width:100%" required>';
		echo '<option value="" selected disabled> Selecione um contrato </option>';
					$obras = mysql_query("select * from notas_obras where cidade IN($cidade) and id in($obra_usuario) order by descricao asc");
					while($l = mysql_fetch_array($obras)) {
						echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>';
					}
			echo '</select>
		</label>';
	exit;
	}
?>
	<h3 style="font-family: 'Oswald', sans-serif;letter-spacing:5px; text-align:center"> 
		<p>		<img src="http://polemicalitoral.com.br/guaruja/imagens/logo.png" style="position:relative; bottom:10px;" width="50px"/> <small>CADASTRO de NUMERARIO</small></p>
	</h3>

	<form action="javascript:void(0)" id="form1" onSubmit="post('#form1','financeiro/criar-numerario-query.php','.retorno')" class="form-inline">
		<div class="panel panel-default" style="width:50%; margin:0 auto;">
			<div class="panel-body" style="padding:20px;">
				<div class="col-xs-12">
					<label style="width:100%"><small>Obra:</small> <br/>
						<select name="obra" class="form-control input-sm" onChange="$('#itens-obra').load('financeiro/criar-numerario.php?atu=ac&cidade=' + $(this).val() + '');" style="width:100%" required>
							<option value="" selected disabled>Selecione uma obra</option>
							<?php
								$obras = mysql_query("SELECT * FROM notas_obras_cidade WHERE id IN($cidade_usuario) ORDER BY nome ASC");
								while($l=mysql_fetch_array($obras)) {
									echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>';	
								}	
							?>	
						</select>
					</label>
				</div>
				<div class="col-xs-12">
					<label id="itens-obra" style="width:100%">
						<label style="width:100%"><small>Contrato:</small> <br/>
							<select name="obra" class="form-control input-sm" style="width:100%" required>
								<option value="" selected disabled>Selecione uma obra</option>	
							</select>
						</label>
					</label>
				</div>
				<div class="col-xs-12">
					<label for="" style="width:100%">
						<small>Data: </small><br/>
						<input type="date" name="data" class="form-control input-sm" style="width:100%" value="<?php echo $todayTotal; ?>" required>
					</label>
				</div>
				<div class="col-xs-12">
					<label id="itens" style="width:100%">
						<small>Número da Solicitação: </small><br/>
						<input type="text" name="numero" placeholder="Nº" class="form-control input-sm" style="width:100%" style="width:100%" required disabled />
					</label>
				</div>
				<div class="col-xs-12" style="margin-top:10px">
					<label style="width:100%; text-align:center">
						<input type="submit" style="margin-left:5px; width:50%" value="Salvar" class="btn btn-success btn-sm" />
					</label>
				</div>
			</div>
		</div>
	</form>
<div class="retorno"></div>
