<?php
	include("../config.php");
	include("../validar_session.php");
	getData();
	getNivel();
?>
<script type="text/javascript">
$(document).ready(function(){
	$.fn.dataTable.ext.errMode = 'none';
    $('#resultadoTabela').DataTable({
		"paging": false,
		"lengthChange": false,
		"searching": false,
		"ordering": true,
		"info": false,
		"bAutoWidth": false
		
    });
	$('.sel').multiselect({
		buttonClass: 'btn btn-sm', 
		numberDisplayed: 1,
		maxHeight: 500,
		includeSelectAllOption: true,
		selectAllText: "Selecionar todos",
		enableFiltering: true,
		enableCaseInsensitiveFiltering: true,
		selectAllValue: 'multiselect-all',
		buttonWidth: '100%'
	}); 
	$("#selectbox").change(function(){
        if($(this).val() == "1"){
            $("#enc-box").removeClass("hidden");
			$("#user-box").addClass("hidden");
        }
		if($(this).val() == "2" || $(this).val() == "3"){
            $("#user-box").removeClass("hidden");
			$("#enc-box").addClass("hidden");
        }
    });

});
</script>
<style>
	@media print
	{
		table, tr, thead, tbody, td, th{
			border:1px solid rgba(23, 23, 23, 0.6) !important;
		}
	}
</style>
	<?php 	if($atu == 'select'){ 
				if($relatorio2 == '1') { ?>
					<label><small>Obra:</small><br/>
						<select name="ci[]" onChange="$('#itens').load('almoxarifado/relatorio-material-compras.php?atu=ac&tipo=1&cidade=' + $(this).val() + '');" style="width:250px;" class="sel" id="categ" required> 
							<option value="">Selecione uma obra</option>
							<?php
								$cidade = mysql_query("select * from notas_obras_cidade WHERE id IN(0,$cidade_usuario) order by nome asc");
								while($l = mysql_fetch_array($cidade)) {
									echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>';
								}
							?>	
						</select>
					</label>
					<label id="itens">
						<label><small>Contrato:</small><br/>
							<select name="ob[]" class="sel" multiple="multiple">
								<option value="">Selecione uma obra</option>		
							</select>
						</label>
						<label for=""><small>Encarregados:</small><br/>
								<select name="enc[]" class="sel" multiple="multiple">
								<?php
									$encarregados = mysql_query("SELECT * FROM encarregados WHERE obra IN(0,$cidade_usuario) ORDER BY nome ASC");
									while($z = mysql_fetch_array($encarregados)) {
										echo '<option value="'.$z['id'].'" selected>'.$z['nome'].'</option>';
									}
								?>		
								</select>
						</label>
						<label for="">
							<small>Status:</small><br/>
							<select name="st[]" OnChange="$('#itens2').load('almoxarifado/relatorio-material-compras.php?atu=st2&tipo=1&status3=' + $(this).val() + '');" class="sel" multiple="multiple">
								<option value="0" selected>ATIVA</option>
								<option value="1">INATIVA</option>
							</select>
						</label>
						<label id="itens2">
							<label for="">
								<small>Equipes:</small><br/>
									<select name="eq[]" class="sel" multiple="multiple">
									<?php
										$encarregados = mysql_query("select * from equipes WHERE obra IN(0,$cidade_usuario) and status IN(0) order by nome asc");
										while($x = mysql_fetch_array($encarregados)) {
											echo '<option value="'.$x['id'].'" selected>'.$x['nome'].'</option>';
										}
									?>		
								</select>
							</label>
						</label>
					</label>
	<?php } 
		exit; 
	} ?>
<?php
	if($atu=='ac'){
		echo '<label><small>Contrato:</small><br/>';
			echo "<select name=\"ob[]\" style=\"width:250px;\" class=\"sel\" multiple=\"multiple\">";
				
					$obras = mysql_query("select * from notas_obras where cidade IN($cidade) and id in($obra_usuario) order by descricao asc");
					while($l = mysql_fetch_array($obras)) {
						echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>';
					}
			echo '</select>
		</label>
		<label for=""><small>Encarregados:</small><br/>
				<select name="enc[]" class="sel" multiple="multiple">';
					$encarregados = mysql_query("select * from encarregados WHERE obra IN($cidade) order by nome asc");
					while($z = mysql_fetch_array($encarregados)) {
						echo '<option value="'.$z['id'].'" selected>'.$z['nome'].'</option>';
					}		
				echo '</select>
		</label>
		<label for="">
			<small>Status:</small><br/>
			<select name="st[]" OnChange="$(\'#itens2\').load(\'almoxarifado/relatorio-material-compras.php?atu=st2&cidade='.$cidade.'&tipo='.$tipo.'&status3=\' + $(this).val() + \'\');" class="sel" multiple="multiple">
				<option value="0" selected>ATIVA</option>
				<option value="1">INATIVA</option>
			</select>
		</label>
		<label id="itens2">
			<label><small>Equipes:</small><br/>';
				echo '<select name="eq[]" class="sel" multiple="multiple">';
				$equipe = mysql_query("select * from equipes WHERE obra IN($cidade) and status IN(0) order by nome asc");
				while($x = mysql_fetch_array($equipe)) {
					echo '<option value="'.$x['id'].'" selected>'.$x['nome'].'</option>';
				}	
				echo '</select>
			</label>
		</label>';
		exit;
	}
	if($atu=='st2'){
		if(!isset($cidade)){
			$cidade = "0,".$cidade_usuario."";
		}
		echo '		
		<label for="">
			<label><small>Equipes:</small><br/>';
				echo '<select name="eq[]" class="sel" multiple="multiple">';
				$equipe = mysql_query("select * from equipes WHERE obra IN($cidade) AND status IN($status3) order by nome asc");
				while($x = mysql_fetch_array($equipe)) {
					echo '<option value="'.$x['id'].'" selected>'.$x['nome'].'</option>';
				}	
			echo '</select>
			</label>
		</label>';
		exit;
		
	}
	if(@$ac=='listar') {
	// P O L E M I C A ------------------------------------------------------------------------------------
		if($relatorio==1) {
			foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1); 
			foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
			foreach($ci as $cis) { @$ciu .= $cis.','; } $ciu = substr($ciu,0,-1);
			foreach($enc as $encs) { @$enca .= $encs.','; } $enca = substr($enca,0,-1);
		 		echo '<table class="hidden-xs hidden-lg hidden-md visible-print" width="100%" style="margin-bottom:20px">';
		echo '<tr>
		<td style="padding:10px; text-align:center" width="10%"><img src="http://guaruja.polemicalitoral.com.br/imagens/logo.png" alt="Logo Polemica" width="50px" /></td>

		<td style="font-size:10px; padding-left:20px;" width="95%">
			<p class="pull-right" style="text-align: right; padding:10px 20px 10px 10px;">
				<b>POLÊMICA SERVIÇOS BÁSICOS LTDA.</b><br/>
				Rua Euclides Miragaia, 700, Salas 82 e 83 - Centro - CEP 12245-820 <br/>
				São José dos Campos - SP - TELEFAX (12) 3941-8555<br/>
				Inscrição Municipal Nº 66.133/3<br/>
				Inscrição Estadual - 645.412.590.115<br/>
			</p>
		</td>
		</tr>';
		echo '</table>';
		$ano = explode("-",$final);
		echo '
		<p>
			<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
				RELATÓRIO DETALHADO DE EQUIPES 
			</h3>
			<p style="text-align:center;  font-size:14px;"><small>Período: '.implode("/",array_reverse(explode("-",$inicial))).' á '.implode("/",array_reverse(explode("-",$final))).'</small></p>
		</p>
		<p style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">';
		$obra_controle = mysql_query("SELECT * FROM notas_obras WHERE id IN($oba)");
		while($c = mysql_fetch_array($obra_controle)){	echo $c['descricao'].'<br/>'; }
		echo '
		</p>
		<hr/>
		';
		echo '<table class="table table-condensed table-color">';
		$encquery = mysql_query("SELECT * FROM encarregados WHERE id IN($enca) AND obra IN($ciu) ORDER BY nome ASC");
		while($a = mysql_fetch_array($encquery)){
			$eqpcount = mysql_num_rows(mysql_query("SELECT * FROM equipes WHERE encarregado = ".$a['id']." AND id IN($equ)"));
			if($eqpcount == 0){
			echo '<tr class="hidden">
						<th colspan="5">'.$a['nome'].'</th>
					</tr>';
			}else{
				echo '<tr class="success">
						<th colspan="5">'.$a['nome'].'</th>
					</tr>';
				
			}
			$eqpquery = mysql_query("SELECT * FROM equipes WHERE encarregado = ".$a['id']." AND obra IN($ciu) AND id IN($equ) ORDER BY nome ASC");
			$total_producao = 0;
			while($b = mysql_fetch_array($eqpquery)){
				echo '<tr class="small info">';
				echo '
						<th>'.$b['nome'].' &nbsp; / &nbsp; <small>ID: '.$b['id'].'</small></th>
						<th width="10px">OBRA</th>
						<th width="10px">FUNÇÃO</th>
						<th width="10px">SITUAÇÃO</th>
						<th width="10px">ADMISSÃO</th>
					</tr>';
				$sql = mysql_query("SELECT * FROM rh_funcionarios WHERE equipe = ".$b['id']." AND (obra IN($oba) OR tipo_emp = '1') ORDER BY nome DESC");
				
				while($c = mysql_fetch_array($sql)) {
					$lider_geral = $b['lider_geral'];
					$salario = $c['salario'];
					$obra_fun = $c['obra'];
					$id_func = $c['id_2'];
					$situacao = explode("_",@mysql_result(@mysql_query("SELECT * FROM rh_situacao WHERE id = ".$c['situacao'].""),0,"descricao"));
					$sqlxl = mysql_query("SELECT SUM(quantidade) as quantidade_total, notas_itens.descricao FROM notas_retirada INNER JOIN notas_retirada_itens ON notas_retirada.id = notas_retirada_itens.id_retirada INNER JOIN notas_itens ON notas_retirada_itens.id_item = notas_itens.id WHERE notas_retirada.funcionario = '".$c['id']."' and (notas_retirada.data between '$inicial' and '$final') and notas_itens.categoria = '3' and notas_itens.oculto = '2' AND notas_retirada_itens.quantidade IS NOT NULL group by id_item");
					$sqlcount = mysql_num_rows($sqlxl);
					$se2 += 1;
					// =============================
					if($sqlcount == '0'){
						echo '<tr class="hidden">';
					}else{
						echo '<tr class="danger">';
					}
					echo '<td width="25%">'.$c['nome'].'</td>';
					echo '<td width="15%">'.mysql_result(mysql_query("SELECT * FROM notas_obras WHERE id = $obra_fun"),0,"descricao").'</td>';	
					echo '<td width="20%" >'.mysql_result(mysql_query("SELECT * FROM rh_funcoes WHERE id = ".$c['funcao'].""),0,"descricao").'</td>';	
					echo '<td width="15%" >'.$situacao[1].'</td>';		
					echo '<td width="10%" >'.implode("/",array_reverse(explode("-",$c['admissao']))).'</td>';	
					echo '</tr>'; 
					
					while($xl = mysql_fetch_array($sqlxl)){
						echo '<tr class="small">';
							echo '<td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$xl['descricao'].'</b></td>';
							echo '<td><b>'.$xl['quantidade_total'].'</b></td>';
							echo '<td colspan="3"></td>';
						echo '</tr>';
					}
					$total_geral += $salario;

				}
			}
		}
		echo '</tbody>';
		echo '</table>';
		
		echo '<h3 style="font-family: \'Oswald\', sans-serif;letter-spacing:8px;" class="pull-right">TOTAL: <small>R$'.@number_format($total_geral,"2",",",".").'</small></h3>';
	exit;	
	}			
}
?>
	<div class="container-fluid hidden-print" style="padding:0px 0px 15px 0px; margin-bottom:20px; border-bottom:1px solid #CCC">
		<img src="../imagens/logo.png" class="img-responsive" width="50px" style="float:left; margin-right:20px"/>
		<h3 style="font-family: 'Oswald', sans-serif; letter-spacing:5px;"> 
			RELATÓRIO<small><b> MATERIAL</b></small>
			<a href="javascript:window.print()" style="letter-spacing:8px; padding-left:40px; padding-right:40px;" class="hidden-xs hidden-print pull-right btn btn-warning btn-sm"> <span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir</a>
		</h3>
	</div>
	<div class="well well-sm hidden-print" style="padding:10px 10px 5px 10px;">
		<form id="form-box" action="javascript:void(0)" onSubmit="posti(this,'almoxarifado/relatorio-material-compras.php?ac=listar','.resultado');">
				<label><small>Tipo de relatorio:</small>
					<select name="relatorio" class="form-control input-sm" OnChange="$('#itens-geral').load('almoxarifado/relatorio-material-compras.php?atu=select&relatorio2=' + $(this).val() + '');" style="width: 180px" required>
						<option value="" selected disabled>Selecione o tipo de relatorio desejado</option>
						<option value="1">MATERIAL (POLEMICA) </option>
					</select>
				</label>
			
				<label id="itens-geral">
					<label><small>Obra:</small>
						<select style="width:250px;" class="form-control input-sm" disabled required> 
							<?php
								$cidade = mysql_query("select * from notas_obras_cidade WHERE id IN(0,$cidade_usuario) order by nome asc");
								while($l = mysql_fetch_array($cidade)) {
									echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>';
								}
							?>	
						</select>
					</label>
					<label id="itens">
						<label><small>Contrato:</small>
							<select style="width:250px;" class="form-control input-sm" disabled required> 
								<?php
									$obras = mysql_query("select * from notas_obras where id IN(0,$obra_usuario) order by descricao asc");
									while($l = mysql_fetch_array($obras)) {
										echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>';
									}
								?>		
							</select>
						</label>
						<label for="">
							<small>Status:</small>
							<select style="width:250px;" class="form-control input-sm" disabled required> 
								<option value="0" selected>ATIVA</option>
								<option value="1">INATIVA</option>
							</select>
						</label>
						<label id="itens2">
							<label for="">
								<small>Equipes:</small>
									<select style="width:250px;" class="form-control input-sm" disabled required> 
									<?php
										$encarregados = mysql_query("select * from equipes WHERE obra IN(0,$cidade_usuario) order by nome asc");
										while($x = mysql_fetch_array($encarregados)) {
											echo '<option value="'.$x['id'].'" selected>'.$x['nome'].'</option>';
										}
									?>		
								</select>
							</label>
						</label>
					</label>
				</label>
				<label><small>De:</small><input type="date" name="inicial" value="2017-04-01" min="2017-04-01" class="form-control input-sm" size="6" placeholder="Inicial" required /></label>
				<label><small>ate:</small><input type="date" name="final" value="<?php echo $todayTotal; ?>"  min="2017-04-01" class="form-control input-sm" size="6" placeholder="Final" required /></label>
				<input type="submit" style="margin-left:5px; width:150px;" value="Buscar" class="btn btn-success btn-sm" />
			</div>	
		</form>
	</div>
	<div class="resultado"></div>