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
?>
<script type="text/javascript">
$(document).ready(function(){
	$('.sel').multiselect({
		buttonClass: 'form-control input-sm', 
		numberDisplayed: 1,
		buttonWidth: '100%',
		enableFiltering: true,
		enableCaseInsensitiveFiltering: true
	}); 
});
</script>
<style>
	.multiselect-container {
        width: 100% !important;
    }
</style>
<?php
if($atu=='ac'){
	$obra_controle = mysql_query("SELECT id FROM notas_obras WHERE cidade IN($cidade) and status = '0'"); 
	while($fk = mysql_fetch_array($obra_controle)) { $obrs .= $fk['id'].','; }  $obrs = substr($obrs,0,-1);
	echo '
		<div class="form-group">
			<label>Funcionário:</label>
			<select name="funcionario" onChange="ldy(\'rh/cadastro-solicitacao.php?di=1&cidade='.$cidade.'&funcionario_change=\' + $(this).val(),\'.conteudo\')" class="sel" required>
				<option value="">Selecione um funcionario</option>';
					$funcs = mysql_query("select * from rh_funcionarios WHERE obra IN($obrs) and demissao = '0000-00-00' AND situacao <> '1' order by nome asc");
					while($l = mysql_fetch_array($funcs)) { extract($l);
						echo '<option value="'.$id.'">'.$nome.'</option>';
					} 	
			echo '</select>
		</div>';
	exit;
}

	if($di == 1){
		$fun_consult = mysql_query("SELECT * FROM rh_funcionarios WHERE id = $funcionario_change");
		while($w = mysql_fetch_array($fun_consult)){
			$cargo_o = mysql_result(mysql_query("SELECT descricao FROM rh_funcoes WHERE id = ".$w['funcao'].""),0,"descricao");
			$data_admissao_o = $w['admissao'];
			$salario_o = mysql_result(mysql_query("SELECT salario FROM rh_funcoes WHERE id = ".$w['funcao'].""),0,"salario");
			$pis_o = $w['pis_numero'];
			$data_demissao_o = $w['demissao'];
		}
		echo "<script>$('.disabled-control').prop('disabled', false);</script>";
	}
?>
	<div class="text-center" style="clear: both; margin-top:10px;">
		<img src="http://polemicalitoral.com.br/guaruja/imagens/logo.png" width="50px"/>
		<h3 style="font-family: 'Oswald', sans-serif; letter-spacing:5px;"> 
			<p>SOLICITAÇAO <small> RESCISÃO CONTRATUAL</small></p>
		</h3>
	</div>
	<div class="retorno"></div>
<div class="well well-sm hidden-print" style="width:60%; padding:20px; margin:0 auto; margin-top:20px; margin-bottom:20px;">
<form action="javascript:void(0)" onSubmit="post(this,'rh/imprimir-solicitacao-rescisao.php','.conteudo')">
	<div class="form-group">
		<label>Data da Solicitação:</label>
		<input type="date" name="data_solicitacao" value="<?php echo $todayTotal; ?>" class="form-control input-sm disabled-control" required disabled />
	</div>
	
	<div class="form-group">
		<label>Obra:</label>
		<select name="cidade" onChange="$('#itens').load('rh/cadastro-solicitacao.php?atu=ac&cidade=' + $(this).val() + '');" class="form-control input-sm" style="width:100%" required> 
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
	</div>
	<label id="itens" style="width:100%"> 
		<div class="form-group">
			<label>Funcionário:</label><br/>
			<?php
			if($cidade == ''){ $cidade = '0'; }
			$obra_controle = mysql_query("SELECT id FROM notas_obras WHERE cidade IN($cidade) and status = '0'"); 
			while($fk = mysql_fetch_array($obra_controle)) { $obrs .= $fk['id'].','; }  $obrs = substr($obrs,0,-1);
			echo '
					<select id="multiselect-container" name="funcionario" onChange="ldy(\'rh/cadastro-solicitacao.php?di=1&cidade='.$cidade.'&funcionario_change=\' + $(this).val(),\'.conteudo\')" class="sel" required>
						<option value="">Selecione um funcionario</option>';
							$funcs = mysql_query("select * from rh_funcionarios WHERE obra IN($obrs) AND situacao <> '1' order by nome asc");
							while($l = mysql_fetch_array($funcs)) { 
								if($funcionario_change == $l['id']){
									echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>';
								}else{
									echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>';
								}
							} 	
					echo '</select>';
			?>
		</div>
	</label>
	<div class="form-group">
		<label>Cargo:</label>
		<input type="text" name="cargo" value="<?php echo $cargo_o; ?>" class="form-control input-sm disabled-control" required disabled />
	</div>
	<div class="form-group">
		<label>Data de Admissão:</label>
		<input type="date" name="data_admissao" value="<?php echo $data_admissao_o; ?>" class="form-control input-sm disabled-control" required disabled />
	</div>
	<div class="form-group">
		<label>Salário:</label>
		<input type="number" step="0.01" name="salario" value="<?php echo $salario_o; ?>" class="form-control input-sm disabled-control" required disabled />
	</div>
	<div class="form-group">
		<label>PIS Nº:</label>
		<input type="text" name="pis" value="<?php echo $pis_o; ?>" class="form-control input-sm disabled-control" required disabled />
	</div>
	<div class="form-group">
		<label>Data de Demissão:</label>
		<input type="date" name="data_demissao" value="<?php echo $data_demissao_o; ?>" class="form-control input-sm disabled-control" required disabled />
	</div>
	<div class="form-group">
		<label>Tipo:</label>
		<select name="tipo" class="form-control input-sm disabled-control" required disabled >
			<option value="DISPENSA SEM JUSTA CAUSA"> DISPENSA SEM JUSTA CAUSA </option>
			<option value="DISPENSA COM JUSTA CAUSA"> DISPENSA COM JUSTA CAUSA</option>
			<option value="PEDIDO DE DEMISSÃO">PEDIDO DE DEMISSÃO</option>
			<option value="TERMINO DE CONTRATO DE EXPERIENCIA">TERMINO DE CONTRATO DE EXPERIENCIA</option>
			<option value="TERMINO DE CONTRATO DE EXPERIENCIA">TERMINO ANTECIPADO DE CONTRATO DE EXPERIENCIA</option>
		</select>
	</div>
	<div class="form-group">
		<label>Motivo:</label>
		<input type="text" name="motivo" class="form-control input-sm disabled-control" disabled />
	</div>
	<div class="form-group">
		<label>Aviso:</label>
		<select name="aviso" class="form-control input-sm disabled-control" required disabled >
			<option value=" "> EM BRANCO</option>
			<option value="TRABALHADO"> TRABALHADO </option>
			<option value="INDENIZADO"> INDENIZADO</option>
		</select>
	</div>
	
	<div class="form-group col-xs-6" style="text-align:center; padding:10px">
		<p style="width:100%; text-align:center"><b>Consulta de Faltas & Beneficios:</b></p>
			<label><input type="date" name="inicial" value="<?php echo $inicioMes ?>" class="form-control input-sm disabled-control" required disabled /></label>
			<label><input type="date" name="final" value="<?php echo $todayTotal ?>" class="form-control input-sm disabled-control" required disabled /></label>
	</div>	
	<div class="form-group col-xs-6" style="text-align:center;  padding:10px">
		<p style="width:100%; text-align:center"><b>Dias Ticket & Transporte:</b></p>
			<label><input type="number" step="1" name="dias" class="form-control input-sm disabled-control" required disabled /></label>
	</div>	
	
	<div class="form-group">
		<label>Telefone:</label>
		<input type="text" name="telefone" onfocus="$(this).mask('(99) 9999-9999?9')" class="form-control input-sm disabled-control" disabled />
	</div>
	<div class="form-group">
		<label>Adiantamento:</label>
		<input type="text" name="adiantamento" class="form-control input-sm disabled-control" disabled />
	</div>
	<div class="form-group">
		<label>Contribuição Assistencial / Negocial:</label>
		<select name="contr_ass" class="form-control input-sm disabled-control" required disabled >
			<option value="SIM"> SIM</option>
			<option value="NÃO"> NÃO</option>
		</select>
	</div>
	<div class="form-group">
		<label>Contribuição Sindical:</label>
		<select name="contr_sind" class="form-control input-sm disabled-control" required disabled >
			<option value="SIM"> SIM</option>
			<option value="NÃO" selected> NÃO</option>
		</select>
	</div>
	<div class="form-group">
		<label>Extrato de FGTS</label>
		<select name="extrato_fgts" class="form-control input-sm disabled-control" required disabled >
			<option value="SIM"> SIM</option>
			<option value="NÃO"> NÃO</option>
		</select>
	</div>
	<div class="form-group" style="text-align:center">
		<input type="submit" style="width:50%" class="btn btn-success btn-sm" value="Avançar >">
	</div>
</form>
</div>
