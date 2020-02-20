<?php
	include("../config.php");
	include("../validar_session.php");
	include("../../functions/function-print.php");
	getData();
	getNivel();
?>
<style>
.formulario-info .ui-button{ 
	background:#a9d0d8 !important; 
	border: 1px solid #a9d0d8 !important; 
}
</style>
	<script>
	  $(function () {
		$('input').iCheck({
		  checkboxClass: 'icheckbox_square-blue',
		  radioClass: 'iradio_square-blue',
		  increaseArea: '20%' // optional
		});
	  });
	</script>
<script src="../js/combobox-resume.js"></script>
<?php 
if(@$ac == 'ins') {
	try{
		$query = mysql_query("insert into rh_funcionarios (nome,obra,funcao,admissao,situacao,tipo_emp,status,motivo_imp, data_registro) values ('$nome','$obra','$funcao','$admissao', 15, '$tipo_emp', '1', '$motivo_imp', $todayTotal)");	
		$last_id = mysql_insert_id();
		$query2 = mysql_query("insert into rh_funcionario_historico (mensagem, data, funcionario) values ('$obs','$todayTotal','$last_id')");	
		if($query){
			echo '<p class="text-success text-center">Funcionário pré cadastrado com sucesso, favor imprimir a analise de contratação abaixo</p>'; 
			echo '<p style="width:100%; text-align:center"><a href="rh/imprimir-analise-contratacao.php?id='.$last_id.'&motivo_imp='.$motivo_imp.'" target="_blank" class="btn btn-warning btn-xs hidden-print" style="width:50%; margin-top:10px; padding:10px; font-size:15px; font-weight:bold; margin-bottom:30px;">IMPRIMIR ANALISE DE CONTRATAÇÃO</a></p>';	
		}else{
			echo '<p class="text-danger">Algo aconteceu de errado!!</p>';
		}
	}catch(Exception $e){
		echo "Error";
		exit;
	}
	//echo '<script>ldy("rh/imprimir-analise-contratacao.php?id='.$last_id.'&motivo_imp='.$motivo_imp.'",".conteudo")</script>';
	exit;
} 
?>
	<div class="container-fluid" style="padding:0px; position:relative; top: -20px">
		<h3 style="font-family: 'Oswald', sans-serif;letter-spacing:5px; text-align:center"> 
			<p>		<img src="http://polemicalitoral.com.br/guaruja/imagens/logo.png" style="position:relative; bottom:10px;" width="50px"/> <small>CADASTRO DE <B>FUNCIONARIOS</B></small></p>
		</h3>
	</div>
	<div class="retorno"></div>

	<form action="javascript:void(0)" class="formulario-info" onSubmit="post(this,'rh/cadastro-funcionario.php?ac=ins','.retorno'); this.reset()" enctype="multipart/form-data" >
		<div class="panel panel-info" style="width:80%; margin:0 auto;">
			<div class="panel-body" style="padding:20px; margin:0px;">
				<div class="row">
					<div class="col-xs-12 col-md-6">
						<label for="" style="width:100%"><small>Nome: </small>
							<input type="text" name="nome" class="form-control input-sm" required>
						</label>
						<label for="" style="width:100%"><small>Data Prevista:</small> <br/>
							<input type="date" name="admissao" class="form-control input-sm" required>
						</label>
						<label for="" style="width:100%"><small>Observações:</small> <br/>
							<textarea name="obs" class="form-control input-sm" style="resize:none"></textarea>
						</label>
						<span style="width:100%; text-align:center;"><small>Tipo de funcionario:</small></span><br/>
						<div class="col-xs-8" style="padding:0px;">
							<div class="col-xs-6" style="padding:2px;">
								<label>
									<input type="radio" id="tipo_emp" style="height: 19px; width: 19px;" name="tipo_emp" value="0" checked> 
									<span style="font-size:13px; font-weight:bold; font-family: 'Comfortaa', cursive;">Funcionario</span>
								</label>
							</div>
							<div class="col-xs-6" style="padding:2px;">
								<label>
									<input type="radio" id="tipo_emp2" style="height: 19px; width: 19px; margin-left:10px" name="tipo_emp" value="1"> 
									<span style="font-size:13px; font-weight:bold; font-family: 'Comfortaa', cursive;">Empresa</span>
								</label>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-md-6">
						<label for="" style="width:100%"><small>Obra:</small><br/>
							<select name="cidade" class="form-control input-sm" onChange="$('#item-consulta-obra').load('../functions/functions-load.php?atu=obra-one&cidade_2=' + $(this).val() + '');" required>
								<option value="">Selecione uma Obra</option>
									<?php 
										$equipes = mysql_query("select * from notas_obras_cidade where id IN($cidade_usuario) order by nome asc"); 
										while($l=mysql_fetch_array($equipes)) {
											echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>';	
										} 
									?>	
							</select>
						</label>
						
						<label id="item-consulta-obra" style="width:100%">
							<label for="" style="width:100%"><small>Contrato:</small><br/>
								<select class="form-control input-sm" name="obra" required>
									<option value="">Selecione um contrato</option>
								</select>
							</label>
						</label>
						<label style="width:100%"><small>Função:</small><br/>
							<select class="form-control input-sm combobox" name="funcao" required>
								<option value=""></option>
									<?php 
										$funcoes = mysql_query("select * from rh_funcoes order by descricao asc"); 
										while($l=mysql_fetch_array($funcoes)) {
											if($funcao==$l['id']) { echo '<option value="'.$l['id'].'" selected>'.strtoupper($l['descricao']).'</option>'; }
											else { echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>'; }  	
										} 
									?>	
							</select>
						</label>
						<span style="width:100%;"><small>Motivo Contratação:</small><br/></span>
						<div class="col-xs-12" style="padding:0px;">
							<div class="col-xs-6" style="padding:2px;">
								<label>
									<input type="radio" name="motivo_imp" value="0" checked> 
									<span style="font-size:13px; font-weight:bold; font-family: 'Comfortaa', cursive;">Aumento do quadro</span>
								</label>
							</div>
							<div class="col-xs-6" style="padding:2px">
								<label>
									<input type="radio" name="motivo_imp" value="1"> 
									<span style="font-size:13px; font-weight:bold; font-family: 'Comfortaa', cursive;">Substituição de funcionário</span>
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row" style="margin-top:30px">
			<center> 
				<input type="submit" class="btn btn-primary btn-sm" style="width:50%; height:40px" align ="center" value="Continuar o Cadastro >>"/>
			</center>
		</div>
	</form>