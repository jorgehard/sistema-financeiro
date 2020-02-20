<?php
	include("../config.php");
	include("../validar_session.php");
	include("../../functions/function-print.php");
	getData();
	getNivel();
?>
<script type="text/javascript">
$(document).ready(function(){
	// ----------- SORTING MONEY ------------- //
	jQuery.tablesorter.addParser({
		id: "monetaryValue",
		is: function (s) {
			return false;
		}, format: function (s) {
			var n = parseFloat( s.replace('R$','').replace(/,/g,'') );
			return isNaN(n) ? s : n;
		}, type: "numeric"
	});
	// ---------
	$("#resultadoTabela").tablesorter({
		dateFormat : "ddmmyyyy",
		headers: {
			5 : { sorter: "monetaryValue" }
		},
		sortList: [[1,1]]
	});
	// ---------
	$("#resultadoTabela2").tablesorter({
		headers: {
			3 : { sorter: "monetaryValue" },
			4 : { sorter: "monetaryValue" },
			5 : { sorter: "monetaryValue" },
			6 : { sorter: "monetaryValue" },
			7 : { sorter: "monetaryValue" },
			8 : { sorter: "monetaryValue" },
		}
	});
	$("table").tablesorter({
		dateFormat : "ddmmyyyy"
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
});
</script>
<?php
	if(@$ac=='listar') {
	// DETALHADO
	if($relatorio==10) {
		foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
		foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1);
		foreach($si as $sis) { @$siu .= $sis.','; } $siu = substr($siu,0,-1);
		foreach($ci as $cis) { @$ciu .= $cis.','; } $ciu = substr($ciu,0,-1);
		foreach($enc as $encs) { @$enca .= $encs.','; } $enca = substr($enca,0,-1);
		if($inicial == '' || $final == ''){ 
			echo '<span class="text-danger">Periodo, obrigatorio</span>';
			exit;
		}
		topoPrint();
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
		echo '<table class="table table-striped table-condensed table-color" style="font-size:10px">';
		$encquery = mysql_query("SELECT * FROM encarregados WHERE id IN($enca) AND obra IN($ciu) ORDER BY nome ASC");
		while($a = mysql_fetch_array($encquery)){
			$eqpcount = mysql_num_rows(mysql_query("SELECT * FROM equipes WHERE encarregado = ".$a['id']." AND id IN($equ)"));
			if($eqpcount == 0){
			echo '<tr class="hidden">
						<th colspan="10">'.$a['nome'].'</th>
					</tr>';
			}else{
				echo '<tr class="success">
						<th colspan="10">'.$a['nome'].'</th>
					</tr>';
				
			}
			$eqpquery = mysql_query("SELECT * FROM equipes WHERE encarregado = ".$a['id']." AND obra IN($ciu) AND id IN($equ) ORDER BY nome ASC");
			$total_producao = 0;
			while($b = mysql_fetch_array($eqpquery)){
				echo '<tr class="small info">';
				echo '<th>Nº</th>
						<th>'.$b['nome'].' &nbsp; / &nbsp; <small>ID: '.$b['id'].'</small></th>
						<th width="10px">OBRA</th>
						<th width="10px">FUNÇÃO</th>
						<th width="10px">SITUAÇÃO</th>
						<th width="10px">ADMISSÃO</th>
						<th width="10px" class="hidden-print"></th>
					</tr>';
				$sql = mysql_query("SELECT *, id as id_2, funcao as cargo_func, (SELECT lider_geral FROM equipes WHERE lider_geral = id_2 GROUP BY lider_geral) as lider_geral, (SELECT salario FROM rh_funcoes WHERE rh_funcoes.id = cargo_func) as salario FROM rh_funcionarios WHERE situacao IN($siu) AND equipe = ".$b['id']." AND (obra IN($oba) OR tipo_emp = '1') ORDER BY lider_geral DESC");
				
				
				while($c = mysql_fetch_array($sql)) {
					$lider_geral = $b['lider_geral'];
					$salario = $c['salario'];
					$obra_fun = $c['obra'];
					$id_func = $c['id_2'];
					$situacao = explode("_",@mysql_result(@mysql_query("SELECT * FROM rh_situacao WHERE id = ".$c['situacao'].""),0,"descricao"));
					$se2 += 1;
					// =============================
					if(isset($c['lider_geral'])){
						echo '<tr class="text-danger">';
					}else{
						echo '<tr>';
					}
					echo '<td width="3%">'.$se2.'</td>';
					echo '<td width="25%">'.$c['nome'].'</td>';
					echo '<td width="15%">'.mysql_result(mysql_query("SELECT * FROM notas_obras WHERE id = $obra_fun"),0,"descricao").'</td>';	
					echo '<td width="20%" >'.mysql_result(mysql_query("SELECT * FROM rh_funcoes WHERE id = ".$c['funcao'].""),0,"descricao").'</td>';	
					echo '<td width="15%" >'.$situacao[1].'</td>';		
					echo '<td width="10%" >'.implode("/",array_reverse(explode("-",$c['admissao']))).'</td>';		
					//echo '<td width="10%">R$'.@number_format($salario,"2",",",".").'</td>';
					if($acesso_login == 'MASTER' || $acesso_login == 'MODERADOR' || $rh_array == $_SESSION['id_usuario_logado'] || $tecseg_array == $_SESSION['id_usuario_logado']){
						echo '<td width="10px" class="hidden-print"><a href="#" style="margin:0px 10px 0px 10px; font-size:8px" class="btn btn-xs btn-primary"onclick=\'ldy("rh/editar-funcionario.php?id='.$id_func.'",".retorno")\'><span class="glyphicon glyphicon-pencil"></span></a></td>';
					}else{
						echo '<td width="10px" class="hidden-print"><a href="#" style="margin:0px 10px 0px 10px; font-size:8px" class="btn btn-xs btn-info" onclick=\'ldy("rh/ver-rh.php?id='.$id_func.'",".retorno")\'><span class="glyphicon glyphicon-eye-open"></span></a></td>';
					}					
					echo '</tr>'; 
					$total_geral += $salario;

				}
			}
		}
		echo '</tbody>';
		echo '</table>';
		
		//echo '<h3 style="font-family: \'Oswald\', sans-serif;letter-spacing:8px;" class="pull-right">TOTAL: <small>R$'.@number_format($total_geral,"2",",",".").'</small></h3>';
	exit;
}
	
	// SIMPLES
	if($relatorio==11) {
		foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
		foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1);
		foreach($si as $sis) { @$siu .= $sis.','; } $siu = substr($siu,0,-1);
		foreach($enc as $encs) { @$enca .= $encs.','; } $enca = substr($enca,0,-1);
		foreach($emp as $emps) { @$empa .= $emps.','; } $empa = substr($empa,0,-1);
		if($inicial == '' || $final == ''){ 
			$periodo = '';
			$filtrodata = '';
		}else{
			$periodo = 'Periodo: '.implode("/",array_reverse(explode("-",$inicial))). ' á '.implode("/",array_reverse(explode("-",$final)));
			$filtrodata = "AND admissao BETWEEN '".$inicial."' AND '".$final."'";
		}
		
		if($final == ''){ $final == '9999-99-99'; }
		topoPrint();
		echo '
				<p>
					<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
						RELATORIO DE FUNCIONÁRIOS - SIMPLES
					</h3>
					<p style="text-align:center;  font-size:14px;"><small>'.$periodo.'</small></p>
				</p>
				<p style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
					';
					$obra_controle = mysql_query("SELECT * FROM notas_obras WHERE id IN($oba)");
					while($c = mysql_fetch_array($obra_controle)){
						echo $c['descricao'].'<br/>';
					}
					echo '
				</p>';
		// -- FIM TOPO -- //						
		echo '<table id="resultadoTabela" class="table table-bordered table-condensed table-color" style="font-size:10px">';
				echo '<thead>
						<tr class="small">
							<th style="text-align:center"><span class="glyphicon glyphicon-sort-by-attributes-alt"></span></th>
							<th>Funcionário:</th>
							<th>Função:</th>
							<th style="text-align:center">Obra:</th>
							<th style="text-align:center">Admissão:</th>
							<th style="text-align:center">Salário:</th>
							<th style="text-align:center">Situação:</th>
							<th style="text-align:center" class="hidden-print">Editar:</th>
						</tr>
					</thead>
					<tbody>';	
		$ss_s = mysql_query("select *, id as id_func, funcao as cargo_func, (SELECT salario FROM rh_funcoes WHERE rh_funcoes.id = cargo_func) as salario from rh_funcionarios where tipo_emp IN($empa) AND situacao IN($siu) and (obra IN($oba) OR tipo_emp = '1') ".$filtrodata." order by nome asc") or die (mysql_error());
		while($l = mysql_fetch_array($ss_s)) { extract($l);
			$i += 1;
			echo '<tr>';	
			echo '<td style="text-align:center">'.$i.'</td>';
			echo '<td>'.$nome.'</td>';
			echo '<td>'.@mysql_result(mysql_query("select * from rh_funcoes where id = '$funcao'"),0,"descricao").'</td>';
			echo '<td style="text-align:center">'.@mysql_result(mysql_query("select * from notas_obras where id = '$obra'"),0,"descricao").'</td>';
			echo '<td style="text-align:center">'.implode("/",array_reverse(explode("-",$admissao))).'</td>';
			echo '<td style="text-align:center"> R$ '.number_format($salario,2,",",".").'</td>';
			//SITUACAO
			$situacaob = @mysql_result(mysql_query("select * from rh_situacao where id = $situacao"),0,"descricao");
			$situacaob = explode("_",$situacaob);
			//
			echo '<td style="text-align:center">'.$situacaob[1].'</td>';
			if($acesso_login == 'MASTER' || $acesso_login == 'MODERADOR' || $acesso_login=='LIDER_RH'){
				echo '<td width="10px" class="hidden-print"><a href="#" style="margin:0px 10px 0px 10px; font-size:8px" class="btn btn-xs btn-primary"onclick=\'ldy("rh/editar-funcionario.php?acesso_login='.$acesso_login.'&id='.$id_func.'",".retorno")\'><span class="glyphicon glyphicon-pencil"></span></a></td>';
			}else{
				echo '<td width="10px" class="hidden-print"><a href="#" style="margin:0px 10px 0px 10px; font-size:8px" class="btn btn-xs btn-info" onclick=\'ldy("rh/ver-rh.php?acesso_login='.$acesso_login.'&id='.$id_func.'",".retorno")\'><span class="glyphicon glyphicon-eye-open"></span></a></td>';
			}	
			echo '</tr>';	
			$salariototal += $salario;
		}		
		echo '</table>';
		echo '<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:right;">
					<b><small>TOTAL:</small></b> R$'.number_format($salariototal,"2",",",".").'</h3>';

		exit;		
	}
	
	// CARGOS
	if($relatorio==12) {
		foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
		foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1);
		foreach($si as $sis) { @$siu .= $sis.','; } $siu = substr($siu,0,-1);
		foreach($enc as $encs) { @$enca .= $encs.','; } $enca = substr($enca,0,-1);
		topoPrint();
		echo '<p>
				<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
					RELATÓRIO DE FUNCIONARIOS - CARGOS
				</h3>
				<p style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center; text-align:center;  font-size:14px;"><small>Data: '.$data_view.'</small></p>
			</p>
			<p style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">';
				$obra_controle = mysql_query("SELECT * FROM notas_obras WHERE id IN($oba)");
				while($c = mysql_fetch_array($obra_controle)){
					echo $c['descricao'].'<br/>';
				}
			echo '</p>';
			
		$ftes = mysql_query("select * from rh_funcoes order by descricao") or die (mysql_error());
		while($l = mysql_fetch_array($ftes)) { 	
			$ss_s = mysql_query("SELECT * FROM rh_funcionarios WHERE rh_funcionarios.funcao = ".$l ['id']." AND rh_funcionarios.situacao IN($siu) and demissao = '0000-00-00' and (obra IN($oba) OR tipo_emp = '1') order by rh_funcionarios.nome asc") or die (mysql_error());
			
			$se += 1;
			if(mysql_num_rows($ss_s) > 0){
				echo '<table class="table table-min table-striped table-condensed table-color small" style="font-size:13px">';
				echo '<tr class="small info">
							<th style="text-align:center">'.$se.'</th>
							<th colspan="5"><h8><b><left>'.$l['descricao'].' </b></h5></th> 
							<th class="hidden-print"></th>
						</tr>';
				echo '<tr class="small">
						<th style="text-align:center">Nº</th>
						<th>FUNCIONARIO</th>
						<th style="text-align:center">OBRA</th>
						<th style="text-align:center">SITUAÇÃO</th>
						<th style="text-align:center">CARGO</th>
						<th style="text-align:center">SALÁRIO</th>
						<th class="hidden-print"></th>';
				echo '</tr>';
				$total_salario = 0;
				while($l = mysql_fetch_array($ss_s)) {  extract($l);
					$su += 1;
					echo '<tr class="small">'; 
					echo '<td width="5%" style="text-align:center">'.$su.'</td>';
					echo '<td width="30%">'.$nome.'</td>';
					echo '<td width="20%" style="text-align:center"><small>'.@mysql_result(mysql_query("select * from notas_obras where id = '$obra'"),0,"descricao").'</small></td>';
					//SITUACAO
					$situacaob = @mysql_result(mysql_query("select * from rh_situacao where id = $situacao"),0,"descricao");
					$situacaob = explode("_",$situacaob);
					//
					echo '<td width="15%" style="text-align:center">'.$situacaob[1].'</td>';
					
					echo '<td width="20%"style="text-align:center">'.@mysql_result(mysql_query("select * from rh_funcoes where id = '$funcao'"),0,"descricao").'</td>';
					echo '<td width="10%" style="text-align:center">R$ '.number_format(mysql_result(mysql_query("select * from rh_funcoes where id = '$funcao'"),0,"salario"),2,",",".").'</td>';
					$total_salario += mysql_result(mysql_query("select * from rh_funcoes where id = '$funcao'"),0,"salario");
					$total_geral += mysql_result(mysql_query("select * from rh_funcoes where id = '$funcao'"),0,"salario");
					if($acesso_login == 'MASTER' || $acesso_login == 'MODERADOR' || $rh_array == $_SESSION['id_usuario_logado']){
						echo '<td width="10px" class="hidden-print"><a href="#" style="margin:0px 10px 0px 10px; font-size:8px" class="btn btn-xs btn-primary"onclick=\'ldy("rh/editar-funcionario.php?acesso_login='.$acesso_login.'&id='.$id_func.'",".retorno")\'><span class="glyphicon glyphicon-pencil"></span></a></td>';
					}else{
						echo '<td width="10px" class="hidden-print"><a href="#" style="margin:0px 10px 0px 10px; font-size:8px" class="btn btn-xs btn-info" onclick=\'ldy("rh/ver-rh.php?acesso_login='.$acesso_login.'&id='.$id_func.'",".retorno")\'><span class="glyphicon glyphicon-eye-open"></span></a></td>';
					}	
					echo '</tr>';	
				}
				echo '
				<tr class="small">
					<th colspan="4" style="text-align:right"></th>
					<th style="text-align:center"><b>TOTAL:</b> </th>
					<th style="text-align:center"><b>R$ '.number_format($total_salario,2,",",".").'</b> </th>
					<th class="hidden-print"></th>
				</tr>';
				echo '</tbody>
				</table>'; 
			}
		}
		echo '<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:right;"><small>Total Geral:</small> R$ '.number_format($total_geral,2,",",".").'</h3>';
		exit;		
	}
	
	// DEMITIDOS
	if($relatorio==13) {
		foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
		foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1);
		foreach($si as $sis) { @$siu .= $sis.','; } $siu = substr($siu,0,-1);
		foreach($enc as $encs) { @$enca .= $encs.','; } $enca = substr($enca,0,-1);
		if($inicial == '' || $final == ''){ 
			$periodo = '';
			$filtrodata = '';
		}else{
			$periodo = 'Periodo: '.implode("/",array_reverse(explode("-",$inicial))). ' á '.implode("/",array_reverse(explode("-",$final)));
			$filtrodata = "AND demissao BETWEEN '".$inicial."' AND '".$final."'";
		}
		if($final == ''){ $final == '9999-99-99'; }
		topoPrint();
		echo '<p>
					<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
						RELATORIO DE FUNCIONÁRIOS - DEMITIDOS
					</h3>
					<p style="text-align:center;  font-size:14px;"><small>'.$periodo.'</small></p>
				</p>
				<p style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
					';
					$obra_controle = mysql_query("SELECT * FROM notas_obras WHERE id IN($oba)");
					while($c = mysql_fetch_array($obra_controle)){
						echo $c['descricao'].'<br/>';
					}
					echo '
				</p>';
			
		// -- FIM TOPO -- //						
		echo '<table class="table table-min table-striped table-condensed small table-color" style="font-size:10px">';
		echo '<thead>
			<tr class="small">
				<th style="text-align:center"><span class="glyphicon glyphicon-sort-by-attributes-alt"></span></th>
				<th>FUNCIONARIO</th>
				<th>FUNÇÃO</th>
				<th style="text-align:center">OBRA:</th>
				<th style="text-align:center">ADMISSÃO</th>
				<th style="text-align:center">DEMISSÃO</th>
				<th style="text-align:center">SALARIO</th>
				<th style="text-align:center">SITUACAO</th>
			</tr>
		</thead>
		<tbody>';	
		$ss_s = mysql_query("select *, funcao as cargo_func, (SELECT salario FROM rh_funcoes WHERE rh_funcoes.id = cargo_func) as salario from rh_funcionarios where demissao <> '0000-00-00' and situacao IN($siu) and (obra IN($oba) OR tipo_emp = '1') ".$filtrodata." order by nome asc") or die (mysql_error());
		while($l = mysql_fetch_array($ss_s)) { extract($l);
			$i += 1;
			echo '<tr>';	
			echo '<td  style="text-align:center">'.$i.'</td>';
			echo '<td>'.$nome.'</td>';
			echo '<td>'.@mysql_result(mysql_query("select * from rh_funcoes where id = '$funcao'"),0,"descricao").'</td>';
			echo '<td  style="text-align:center">'.@mysql_result(mysql_query("select * from notas_obras where id = '$obra'"),0,"descricao").'</td>';
			echo '<td style="text-align:center">'.implode("/",array_reverse(explode("-",$admissao))).'</td>';
			echo '<td  style="text-align:center">'.implode("/",array_reverse(explode("-",$demissao))).'</td>';
			echo '<td  style="text-align:center"> R$ '.number_format($salario,2,",",".").'</td>';
			//SITUACAO
				$situacaob = @mysql_result(mysql_query("select * from rh_situacao where id = $situacao"),0,"descricao");
				$situacaob = explode("_",$situacaob);
			//
			echo '<td  style="text-align:center">'.$situacaob[1].'</td>';
			echo '</tr>';	
			$salariototal += $salario;
		}		
		echo '</table>';
		echo '<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:right;">
					<b><small>TOTAL:</small></b> R$'.number_format($salariototal,"2",",",".").'</h3>';

		exit;		
	}
	
	// DEFICIENTES
	if($relatorio==14) {
		foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
		foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1);
		foreach($si as $sis) { @$siu .= $sis.','; } $siu = substr($siu,0,-1);
		foreach($enc as $encs) { @$enca .= $encs.','; } $enca = substr($enca,0,-1);
		if($inicial == '' || $final == ''){ 
			$periodo = '';
			$filtrodata = '';
		}else{
			$periodo = 'Periodo: '.implode("/",array_reverse(explode("-",$inicial))). ' á '.implode("/",array_reverse(explode("-",$final)));
			$filtrodata = "AND demissao BETWEEN '".$inicial."' AND '".$final."'";
		}
		if($final == ''){ $final == '9999-99-99'; }
		topoPrint();
		echo '
				<p>
					<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
						RELATORIO DE FUNCIONÁRIOS - DEFICIÊNTES (PCD)
					</h3>
					<p style="text-align:center;  font-size:14px;"><small>'.$periodo.'</small></p>
				</p>
				<p style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
					';
					$obra_controle = mysql_query("SELECT * FROM notas_obras WHERE id IN($oba)");
					while($c = mysql_fetch_array($obra_controle)){
						echo $c['descricao'].'<br/>';
					}
					echo '
				</p>';
			
		// -- FIM TOPO -- //						
		echo '<table class="table table-min table-striped table-condensed small table-color" style="font-size:10px">';
		echo '<thead>
			<tr class="small">
				<th style="text-align:center"><span class="glyphicon glyphicon-sort-by-attributes-alt"></span></th>
				<th>FUNCIONARIO</th>
				<th>FUNÇÃO</th>
				<th style="text-align:center">OBRA:</th>
				<th style="text-align:center">ADMISSÃO</th>
				<th style="text-align:center">TIPO DE DEFICIENCIA</th>
				<th style="text-align:center">SALARIO</th>
				<th style="text-align:center">SITUACAO</th>
			</tr>
		</thead>
		<tbody>';	
		$ss_s = mysql_query("select *, funcao as cargo_func, (SELECT salario FROM rh_funcoes WHERE rh_funcoes.id = cargo_func) as salario from rh_funcionarios where demissao <> '0000-00-00' and situacao IN($siu) and (obra IN($oba) OR tipo_emp = '1') ".$filtrodata." AND situacao = '12' order by nome asc") or die (mysql_error());
		while($l = mysql_fetch_array($ss_s)) { extract($l);
			$i += 1;
			echo '<tr>';	
			echo '<td  style="text-align:center">'.$i.'</td>';
			echo '<td>'.$nome.'</td>';
			echo '<td>'.@mysql_result(mysql_query("select * from rh_funcoes where id = '$funcao'"),0,"descricao").'</td>';
			echo '<td  style="text-align:center">'.@mysql_result(mysql_query("select * from notas_obras where id = '$obra'"),0,"descricao").'</td>';
			echo '<td style="text-align:center">'.implode("/",array_reverse(explode("-",$admissao))).'</td>';
			echo '<td  style="text-align:center">'.$deficiencia.'</td>';
			echo '<td  style="text-align:center"> R$ '.number_format($salario,2,",",".").'</td>';
			//SITUACAO
					$situacaob = @mysql_result(mysql_query("select * from rh_situacao where id = $situacao"),0,"descricao");
					$situacaob = explode("_",$situacaob);
			//
			echo '<td  style="text-align:center">'.$situacaob[1].'</td>';
			echo '</tr>';	
			$salariototal += $salario;
		}		
		echo '</table>';
		echo '<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:right;">
					<b><small>TOTAL:</small></b> R$'.number_format($salariototal,"2",",",".").'</h3>';

		exit;
	}
			
	// MEMORIA DE CALCULA
	if($relatorio==16) {
		foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
		foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1);
		foreach($si as $sis) { @$siu .= $sis.','; } $siu = substr($siu,0,-1);
		foreach($enc as $encs) { @$enca .= $encs.','; } $enca = substr($enca,0,-1);
		topoPrint();
		echo '
			<p>
				<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
					RELATÓRIO DE FUNCIONARIOS - CARGOS
				</h3>
				<p style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center; text-align:center;  font-size:14px;"><small>Data: '.$data_view.'</small></p>
			</p>
			<p style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">';
				$obra_controle = mysql_query("SELECT * FROM notas_obras WHERE id IN($oba)");
				while($c = mysql_fetch_array($obra_controle)){
					echo $c['descricao'].'<br/>';
				}
			echo '</p>';
			
		$ftes = mysql_query("select * from rh_funcoes order by descricao") or die (mysql_error());
		
		echo '<table id="resultadoTabela2" class="table table-condensed table-bordered table-color" style="font-size:12px">';
		echo '<thead>';
			echo '
			<tr class="small">
				<th>ORD</th>
				<th>DESCRIÇÃO</th>
				<th>QTD</th>
				<th>SALARIO</th>
				<th>ENCARGOS</th>
				<th>VT</th>
				<th>VR</th>
				<th>VA</th>
				<th>TOTAL</th>
			</tr>';
		echo '</thead>';
		echo '<tbody>';
		while($l = mysql_fetch_array($ftes)) { 	
			$ss_s = mysql_query("SELECT * FROM rh_funcionarios WHERE rh_funcionarios.funcao = ".$l ['id']." AND rh_funcionarios.situacao IN($siu) and demissao = '0000-00-00' and (obra IN($oba) OR tipo_emp = '1') order by rh_funcionarios.nome asc") or die (mysql_error());
			$se += 1;
			if(mysql_num_rows($ss_s) > 0){
				$total_salario = 0;
				$total_encargos = 0;
				$total_geral_refeicao = 0;
				$total_geral_transporte = 0;
				$total_geral_alimentacao = 0;
				while($k = mysql_fetch_array($ss_s)) {  extract($k);
					$total_funcionarios = mysql_num_rows($ss_s);
					$total_salario += mysql_result(mysql_query("select * from rh_funcoes where id = '$funcao'"),0,"salario");
					$total_encargos += mysql_result(mysql_query("select * from rh_funcoes where id = '$funcao'"),0,"salario")*0.8;
					$dias_uteis = 21; //($du+$dias_adicionais)-$faltas;
					$total_refeicao = $dias_uteis*$k['vale_refeicao'];
					$transporte1 = $dias_uteis*($k['vale_qtd']*2);
					$transporte2 = $dias_uteis*($k['vale_qtd2']*2);
					$transporte_total = $transporte1 + $transporte2;
					//
					$total_geral_refeicao += $total_refeicao;
					$total_geral_transporte += $transporte_total;
					$total_geral_alimentacao += $k['vale_alimentacao'];
					
					
				}
				
				$total_geral = $total_salario + $total_encargos + $total_geral_transporte + $total_geral_alimentacao + $total_geral_refeicao;
				//
				$total_funcionarios2 += $total_funcionarios;
				$total_salario2 += $total_salario;
				$total_encargos2 += $total_encargos;
				$total_geral_transporte2 += $total_geral_transporte;
				$total_geral_refeicao2 += $total_geral_refeicao;
				$total_geral_alimentacao2 += $total_geral_alimentacao;
				$total_geral2 += $total_geral;
				//
				echo '<tr class="small">
						<td style="text-align:center">'.$se.'</td>
						<td>'.$l['descricao'].' </td>
						<td>'.$total_funcionarios.' </td>
						<td><b>R$ '.number_format($total_salario,2,".",",").'</b></td>
						<td><b>R$ '.number_format($total_encargos,2,".",",").'</b></td>
						<td><b>R$ '.number_format($total_geral_transporte,2,".",",").'</b></td>
						<td><b>R$ '.number_format($total_geral_refeicao,2,".",",").'</b></td>
						<td><b>R$ '.number_format($total_geral_alimentacao,2,".",",").'</b></td>
						<td><b>R$ '.number_format($total_geral,2,".",",").'</b></td>
						';
				echo '</tr>';
			}
		}
		echo '</tbody>';
		echo '<tfoot>';
				echo '<tr class="active">';
					echo '<td colspan="2" style="text-align:center"><b> TOTAL </b></td>
						<td><b>'.$total_funcionarios2.'</b></td>
						<td><b>R$ '.number_format($total_salario2,2,",",".").'</b></td>
						<td><b>R$ '.number_format($total_encargos2,2,",",".").'</b></td>
						<td><b>R$ '.number_format($total_geral_transporte2,2,",",".").'</b></td>
						<td><b>R$ '.number_format($total_geral_refeicao2,2,",",".").'</b></td>
						<td><b>R$ '.number_format($total_geral_alimentacao2,2,",",".").'</b></td>
						<td><b>R$ '.number_format($total_geral2,2,",",".").'</b></td>
				</tr>';
			echo '</tfoot>';
		echo '</table>'; 
		echo '<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:right;"><small>Total Geral:</small> R$ '.number_format($total_geral2,2,",",".").'</h3>';
		exit;		
	}
}
?>
	<div class="container-fluid hidden-print" style="padding:0px 0px 15px 0px; margin-bottom:20px; border-bottom:1px solid #CCC">
		<img src="../imagens/logo.png" class="img-responsive" width="50px" style="float:left; margin-right:20px"/>
		<h3 style="font-family: 'Oswald', sans-serif; letter-spacing:5px;"> 
			RELATÓRIO <small><b>CONTROLE DE FUNCIONÁRIOS</b></small>
			<a href="javascript:window.print()" style="letter-spacing:8px; padding-left:40px; padding-right:40px;" class="hidden-xs hidden-print pull-right btn btn-warning btn-sm"> <span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir</a>
		</h3>
	</div>
	<div class="well well-sm hidden-print" style="padding:10px 10px 5px 10px;">
		<form action="javascript:void(0)" onSubmit="posti(this,'rh/relatorio-funcionarios.php?ac=listar','.retorno');" class="form-inline">
			<div class="container-fluid" style="padding:0px">
				<div class="col-xs-8" style="padding:0px">
					<div class="col-xs-2" style="padding:2px">
						<label style="width:100%"><small>Obra:</small><br/>
							<select name="ci[]" onChange="$('#item-consulta-obra').load('../functions/functions-load.php?atu=equipe&cidade=' + $(this).val() + '');" style="width:250px;" class="sel" multiple="multiple" id="categ" required> 
							<?php
								$cidade = mysql_query("select * from notas_obras_cidade WHERE id IN(0,$cidade_usuario) order by nome asc");
								while($l = mysql_fetch_array($cidade)) {
									echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>';
								}
							?>	
							</select>
						</label>
					</div>
					<div class="col-xs-10" style="padding:0px">
						<div id="item-consulta-obra">
							<div class="col-xs-3" style="padding:2px">
								<label style="width:100%"><small>Contrato:</small><br/>
									<select name="ob[]" class="sel" multiple="multiple">
										<?php
											$obras = mysql_query("select * from notas_obras where id IN(0,$obra_usuario) order by descricao asc");
											while($l = mysql_fetch_array($obras)) {
												echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>';
											}
										?>		
									</select>
								</label>
							</div>
							<div class="col-xs-3" style="padding:2px">
								<label style="width:100%"><small>Encarregados:</small>
									<select name="enc[]" class="sel" multiple="multiple">
									<?php
										$encarregados = mysql_query("select * from encarregados WHERE obra IN(0,$cidade_usuario) order by nome asc");
										while($z = mysql_fetch_array($encarregados)) {
											echo '<option value="'.$z['id'].'" selected>'.$z['nome'].'</option>';
										}
									?>		
									</select>
								</label>
							</div>
							<div class="col-xs-3" style="padding:2px">
								<label style="width:100%">
									<small>Status:</small>
									<select name="st[]" OnChange="$('#item-status').load('../functions/functions-load.php?atu=status1&status3=' + $(this).val() + '');" class="sel" multiple="multiple">
										<option value="0" selected>ATIVA</option>
										<option value="1" selected>INATIVA</option>
									</select>
								</label>
							</div>
							<div class="col-xs-3" style="padding:2px">
								<div id="item-status">
									<label style="width:100%">
										<small>Equipes:</small>
										<select name="eq[]" class="sel" multiple="multiple">
											<?php
												$encarregados = mysql_query("select * from equipes WHERE obra IN(0,$cidade_usuario) order by nome asc");
												while($x = mysql_fetch_array($encarregados)) {
													echo '<option value="'.$x['id'].'" selected>'.$x['nome'].'</option>';
												}
											?>		
										</select>
									</label>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-2" style="padding:2px">
					<label style="width:100%"><small>Situação:</small>
						<select name="si[]" class="sel" multiple="multiple">
						<?php
							$situacao = mysql_query("select * from rh_situacao order by ordem asc");
							while($l = mysql_fetch_array($situacao)) { extract($l);
								echo '<option value="'.$id.'" selected>'.$descricao.'</option>';
							}
						?>		
						</select>
					</label>
				</div>
				<div class="col-xs-2" style="padding:2px">
					<label style="width:100%"><small>Tipo:</small>
						<select name="emp[]" class="sel" multiple="multiple">
							<option value="0" selected>FUNCIONARIO</option>
							<option value="1" selected>EMPRESA</option>
						</select>
					</label>
				</div>
				<div class="col-xs-3" style="padding:0px">
					<div class="col-xs-6" style="padding:2px">
						<label style="width:100%"><small>Periodo:</small><br/>
							<input type="date" name="inicial" value="<?php echo $inicioMes; ?>" max="<?php echo $todayTotal ?>" class="form-control input-sm" style="width:100%" />
						</label>
					</div>
					<div class="col-xs-6" style="padding:2px">
						<label style="width:100%"><small>ate:</small><br/>
							<input type="date" name="final" value="<?php echo $todayTotal; ?>" max="<?php echo $todayTotal ?>" class="form-control input-sm" style="width:100%" />
						</label>
					</div>
				</div>
				<div class="col-xs-1" style="padding:2px">
					<label style="width:100%"><small>Dias Uteis:</small> 
						<input type="number" step="1" name="du" class="form-control input-sm" value="21" style="width:100%"/>
					</label>
				</div>
				<div class="col-xs-3" style="padding:2px">
					<label style="width:100%"><small>Tipo:</small><br/>
						<select name="relatorio" class="form-control input-sm" style="width:100%">
							<option value="10">DETALHADA</option>
							<option value="11">SIMPLES</option>
							<option value="12">CARGOS</option>
							<option value="13">DEMITIDOS</option>
							<option value="14">DEFICIÊNTES</option>
							<option value="16">MEMORIA DE CALCULO</option>
						</select>
					</label>
				</div>
				<div class="col-xs-2" style="padding:2px;">
					<label class="pull-right" style="width:100%"><br/>
						<input type="submit" value="Pesquisar" style="width:100%" class="btn btn-success btn-sm">
					</label>
				</div>
			</div>	
		</form>
	</div>
	<div class="retorno"></div>