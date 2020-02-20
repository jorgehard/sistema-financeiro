<?php
	include("../config.php");
	include("../validar_session.php");
	include("../../functions/function-print.php");
	getData();
	getNivel();
?>
<script type="text/javascript">
$(document).ready(function(){
	$("table").tablesorter({
		dateFormat : "ddmmyyyy",
		textExtraction: function(node){ 
			var cell_value = $(node).text();
			var sort_value = $(node).data('value');
			return (sort_value != undefined) ? sort_value : cell_value;
		}
	});
	$.fn.dataTable.ext.errMode = 'none';
    $('#resultadoTabela').DataTable({
		"paging": false,
		"lengthChange": false,
		"searching": true,
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
});
</script>
<?php if($atu=='ac'){ ?>
		<div class="col-xs-12 col-md-4" style="padding:3px">
			<label><small>Contrato:</small>
				<select name="ob[]" class="sel" multiple="multiple" style="width:100%">
					<?php 
					$obras = mysql_query("select * from notas_obras where cidade IN($cidade) and id in($obra_usuario) order by descricao asc");
					while($l = mysql_fetch_array($obras)) {
						echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>';
					}
					?>
				</select>
			</label>
		</div>
		<div class="col-xs-12 col-md-4" style="padding:3px">
			<label><small>Status:</small>
				<select name="st[]" OnChange="$('#itens2').load('financeiro/relatorio-notas.php?atu=st2&cidade=<?= $cidade ?>&status3=' + $(this).val() + '');" class="sel" multiple="multiple">
					<option value="0" selected>ATIVA</option>
					<option value="1" selected>INATIVA</option>
				</select>
			</label>
		</div>
		<div class="col-xs-12 col-md-4" style="padding:3px">
			<label id="itens2"><small>Equipes:</small>
				<select name="eq[]" class="sel" multiple="multiple">
					<?php
					$equipe = mysql_query("select * from equipes WHERE obra IN(0,$cidade) order by nome asc");
					while($x = mysql_fetch_array($equipe)) {
						echo '<option value="'.$x['id'].'" selected>'.$x['nome'].'</option>';
					}	
					?>
				</select>
			</label>
		</div>
	<?php
		exit; 
	}
	if($atu=='st2'){
		echo '<small>Equipes:</small>
					<select name="eq[]" class="sel" multiple="multiple">';
					$equipe = mysql_query("select * from equipes WHERE obra IN(0,$cidade) and status IN($status3) order by nome asc");
					while($x = mysql_fetch_array($equipe)) {
						echo '<option value="'.$x['id'].'" selected>'.$x['nome'].'</option>';
					}	
				echo '</select>';	
		exit; 
	} 
	if(@$ac=='listar') {
		// D E T A L H A D O -------------------------------------------------------------------------
		if($relatorio==4) {
			foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
			foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1);
			foreach($et as $ets) { @$eta .= $ets.','; } $eta = substr($eta,0,-1);
			foreach($tp as $tps) { @$tpa .= $tps.','; } $tpa = substr($tpa,0,-1);
			topoPrint();
			$ano = explode("-",$final);
			echo '
				<p>
					<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
						RELATORIO NOTA FISCAL - DETALHADO<br/>
							<small>POR DATA DE <b>EMISSÃO</b></small>
					</h3>
					<p style="text-align:center;  font-size:14px;"><small>Periodo: '.implode("/",array_reverse(explode("-",$inicial))).' à '.implode("/",array_reverse(explode("-",$final))).'</small></p>
				</p>
				<p class="hidden-xs hidden-lg hidden-md visible-print" style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
					';
					$obra_controle = mysql_query("SELECT * FROM notas_obras WHERE id IN($oba)");
					while($c = mysql_fetch_array($obra_controle)){
						echo $c['descricao'].'<br/>';
					}
					echo '
				</p>
				<hr/>';		
			$ss_s = mysql_query("select notas_nf.id as id_n, notas_nf.tipo_nota, notas_nf.empresa as empresa, notas_nf.obra, notas_nf.numero, notas_nf.recebimento FROM notas_nf WHERE notas_nf.obra in($oba) and (notas_nf.recebimento between '$inicial' and '$final') AND notas_nf.tipo_nota IN($tpa) GROUP BY notas_nf.id ORDER BY notas_nf.recebimento DESC") or die (mysql_error());
			while($l = mysql_fetch_array($ss_s)) { extract($l);	
				$count_lines = mysql_num_rows(mysql_query("SELECT * FROM notas_itens_add WHERE nota = '$id_n' AND notas_itens_add.equipe in($equ) AND notas_itens_add.categoria IN($eta)"));
				if($count_lines != '0'){
					$se += 1;
					echo '<table class="table table-min table-striped table-color" style="position:relative; left:0px; top:0px;">';
					echo '<tbody>';
						if($tipo_nota == '1'){
							echo '<tr class="success">';
						}else{	
							echo '<tr class="info">';	
						}
							echo '<td><i class="fa fa-eject" aria-hidden="true"></i>&nbsp;<b>'.$se.'</b></td>';
							echo '<td colspan="2" style="font-weight:bold"><b class="text-info">Nota: &nbsp;</b><a href="#" onclick=\'$(".modal-body").load("financeiro/view-nf.php?id='.$id_n.'&obra_nt='.$obra.'")\' data-toggle="modal" data-target="#myModal2"  class="btn-xs btn-link">'.$numero.'</a> / '.@mysql_result(mysql_query("select * from notas_empresas where id = $empresa"),0,"razao_social").'</td>';
							echo '<td style="font-weight:bold"><b class="text-info">Receb.: &nbsp;</b><span>'.implode("/",array_reverse(explode("-",$recebimento))).'</span></td>';
							echo '<td colspan="3" style="font-weight:bold"><b class="text-info">Obra: &nbsp;</b>'.mysql_result(mysql_query("select * from notas_obras where id = '$obra'"),0,"descricao").'</td>';
							echo '<td style="font-weight:bold;" colspan="2">';
							if($tipo_nota == '1'){
								echo '<span class="pull-right"><b class="text-info">Total:</b><b class="text-success">&nbsp;R$&nbsp;'.number_format(mysql_result(mysql_query("SELECT SUM(quantidade*(valor-desconto)) as total FROM notas_itens_add WHERE nota = '$id_n'"),0,"total"),2,",",".").'</b></span>';
							}else{
								echo '<span class="pull-right"><b class="text-info">Total:</b><b class="text-danger">&nbsp;R$&nbsp;'.number_format(mysql_result(mysql_query("SELECT SUM(quantidade*(valor-desconto)) as total FROM notas_itens_add WHERE nota = '$id_n'"),0,"total"),2,",",".").'</b></span>';
							}
							if($acesso_login == 'MASTER'){
							echo '<div style="position:absolute; right:-30px; top:0px;">';
								echo '<a href="#" onclick=\'$(".retorno").load("financeiro/itens-nota.php?id='.$id_n.'")\' class="btn btn-info btn-xs" style="margin:0px; padding:5px;"><i class="fa fa-eye" aria-hidden="true"></i></a>';
							echo '</div>';
							}
							echo '</td>';	
						echo '</tr>';
						echo '<tr>';
							echo '<td width="3%"><b><small>Nº</b></td>';
							echo '<td><b><small>ITEM:</small></b></td>';
							echo '<td><b><small>EQUIPE:</small></b></td>';
							echo '<td><b><small>CATEGORIA:</small></b></td>';
							echo '<td class="text-center"><b><small>QUANTIDADE:</small></b></td>';
							echo '<td class="text-center"><b><small>DESCONTO:</small></b></td>';
							echo '<td class="text-center"><b><small>VALOR:</small></b></td>';
							echo '<td class="text-center"><b><small>TOTAL ITEM:</small></b></td>';
							echo '<td></td>';
						echo '</tr>';
							$itens = mysql_query("SELECT * FROM notas_itens_add WHERE nota = '$id_n' AND notas_itens_add.equipe in($equ) AND notas_itens_add.categoria IN($eta)");
							$si = 0;
							$total_nota = 0;
							while($c = mysql_fetch_array($itens)){
								$si += 1;
								echo '<tr>';
									echo '<td width="3%"><small>'.$si.'</small></td>';
									echo '<td width="20%" style="text-align:left;">'.@mysql_result(mysql_query("select * from notas_itens where id = '$c[item]'"),0,"descricao").'</td>';
									echo '<td width="20%">'.@mysql_result(mysql_query("select * from equipes where id = '$c[equipe]'"),0,"nome").'</td>';
									echo '<td width="15%">'.@mysql_result(mysql_query("select * from notas_categorias where id = '$c[categoria]'"),0,"descricao").'</td>';
									echo '<td width="10%" class="text-center">'.number_format($c['quantidade'],2,",",".").'</td>';
									echo '<td width="10%" class="text-center">R$ '.number_format($c['desconto'],2,",",".").'</td>';
									echo '<td width="10%" class="text-center">R$ '.number_format($c['valor'],2,",",".").'</td>';
									$total_item = $c['quantidade'] * ($c['valor'] - $c['desconto']);
									echo '<td width="10%" class="text-center">R$ '.number_format($total_item,2,",",".").'</td>';
									echo '<td></td>';
								echo '</tr>';
								$total_nota += $total_item;
								$total_nota_ge += $total_item;
							}	
							
								echo '<tr class="active">';
									echo '<td colspan="7"><span class="pull-right"><b>Total Itens: </b></span></td>';
									echo '<td width="10%" class="text-center"><b>R$ '.number_format($total_nota,2,",",".").'</b></td>';
									echo '<td></td>';
								echo '</tr>';
					echo '</tbody></table>';
					
				}
			}
			echo '
			<table class="table pull-right">
				<tr><h2 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px;">Total Itens: <small> R$ '.number_format($total_nota_ge,2,",",".").'</small></h2></tr>
			</table>';
			
			exit;		
		}
		// S I M P L E S -----------------------------------------------------------------------------
		if($relatorio==5) {
			foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
			foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1);
			foreach($et as $ets) { @$eta .= $ets.','; } $eta = substr($eta,0,-1);
			foreach($tp as $tps) { @$tpa .= $tps.','; } $tpa = substr($tpa,0,-1);
			topoPrint();
			$ano = explode("-",$final);
			echo '
				<p>
					<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
						RELATORIO NOTA FISCAL - SIMPLES<br/>
							<small>POR DATA DE <b>EMISSÃO</b></small>
					</h3>
					<p style="text-align:center;  font-size:14px;"><small>Periodo: '.implode("/",array_reverse(explode("-",$inicial))).' à '.implode("/",array_reverse(explode("-",$final))).'</small></p>
				</p>
				<p class="hidden-xs hidden-lg hidden-md visible-print" style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
					';
					$obra_controle = mysql_query("SELECT * FROM notas_obras WHERE id IN($oba)");
					while($c = mysql_fetch_array($obra_controle)){
						echo $c['descricao'].'<br/>';
					}
					echo '
				</p>';	

			echo '<table class="table small table-condensed table-striped table-color" id="resultadoTabela">';
			echo '<thead>';
				echo '<tr>';
					echo '<th>Nº:</th>';
					echo '<th>Nota:</th>';
					echo '<th>Filial:</th>';
					echo '<th>Empresa:</th>';
					echo '<th>Obs:</th>';
					echo '<th class="text-center">Emissão:</th>';
					echo '<th class="text-center">Data Ref.:</th>';
					echo '<th>Valor:</th>';
					if($acesso_login == 'MASTER'){
						echo '<th>&nbsp;</th>';
					}
				echo '</tr>';
			echo '</thead>';
			echo '<tbody>';				
			$ss_s = mysql_query("select notas_nf.observacoes as obs, notas_nf.data_ref, notas_nf.id as id_n, notas_nf.empresa as empresa, notas_nf.obra, notas_nf.numero, notas_nf.tipo_nota, notas_nf.recebimento FROM notas_nf WHERE notas_nf.obra in($oba) and (notas_nf.recebimento between '$inicial' and '$final') AND notas_nf.tipo_nota IN($tpa) GROUP BY notas_nf.id ORDER BY notas_nf.recebimento DESC") or die (mysql_error());
			
			while($l = mysql_fetch_array($ss_s)) { extract($l);	
				$count_lines = mysql_num_rows(mysql_query("SELECT * FROM notas_itens_add WHERE nota = '$id_n' AND notas_itens_add.equipe in($equ) AND notas_itens_add.categoria IN($eta)"));
				if($count_lines != '0'){
					$itens = mysql_query("SELECT * FROM notas_itens_add WHERE nota = '$id_n' AND notas_itens_add.equipe in($equ) AND notas_itens_add.categoria IN($eta)");
					$total_nota = 0;
					while($c = mysql_fetch_array($itens)){
						$total_item = $c['quantidade'] * ($c['valor'] - $c['desconto']);
						$total_nota += $total_item;
						$total_nota_ge += $total_item;
					}	
					$se += 1;
					echo '<tr>';
						echo '<td>'.$se.'</td>';
						echo '<td><a href="#" onclick=\'$(".modal-body").load("financeiro/view-nf.php?id='.$id_n.'&obra_nt='.$obra.'")\' data-toggle="modal" data-target="#myModal2"  class="btn-xs btn-link">'.$numero.'</a></td>';
						echo '<td>'.mysql_result(mysql_query("select * from notas_obras where id = '$obra'"),0,"nome_exibir").'</td>';
						echo '<td>'.@mysql_result(mysql_query("select * from notas_empresas where id = $empresa"),0,"razao_social").'</td>';
						echo '<td>'.$obs.'</td>';
						echo '<td class="text-center" width="10%">'.implode("/",array_reverse(explode("-",$recebimento))).'</td>';
						echo '<td class="text-center" width="10%">'.implode("/",array_reverse(explode("-",$data_ref))).'</td>';
						if($tipo_nota == '1'){
							echo '<td class="text-success"><b>R$&nbsp;'.number_format($total_nota,2,",",".").'</b></td>';
						}else{
							echo '<td class="text-danger"><b>R$&nbsp;'.number_format($total_nota,2,",",".").'</b></td>';
						}
						if($acesso_login == 'MASTER'){
							echo '<td width="30px" class="hidden-print" style="text-align:center">';
							echo '<a href="#" onclick=\'$(".retorno").load("financeiro/itens-nota.php?id='.$id_n.'")\' class="btn btn-info btn-xs" style="margin:0px; padding:5px;"><i class="fa fa-eye" aria-hidden="true"></i></a>';
							echo '</td>';
						}
					echo '</tr>';
				}
			}
			echo '</tbody></table>';	
			echo '
			<div class="pull-right">
				<h2 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px;">Total Itens: <small> R$ '.number_format($total_nota_ge,2,",",".").'</small></h2>
			</div>';
			
			exit;		
		}
		// E M P R E S A  ----------------------------------------------------------------------------
		if($relatorio==6) {
			foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1);
			foreach($et as $ets) { @$eta .= $ets.','; } $eta = substr($eta,0,-1);
			foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
			foreach($tp as $tps) { @$tpa .= $tps.','; } $tpa = substr($tpa,0,-1);
			topoPrint();
			$ano = explode("-",$final);
			echo '
				<p>
					<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
						MEMORIA DE CALCULO - EMPRESAS<br/>
							<small>POR DATA DE <b>EMISSÃO</b></small>
					</h3>
					<p style="text-align:center;  font-size:14px;"><small>Periodo: '.implode("/",array_reverse(explode("-",$inicial))).' à '.implode("/",array_reverse(explode("-",$final))).'</small></p>
				</p>
				<p class="hidden-xs hidden-lg hidden-md visible-print" style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
					';
					$obra_controle = mysql_query("SELECT * FROM notas_obras WHERE id IN($oba)");
					while($c = mysql_fetch_array($obra_controle)){
						echo $c['descricao'].'<br/>';
					}
					echo '
				</p>
				<hr/>';	
			echo '<table class="table table-min table-striped" style="font-size:18px;">';
			echo '<thead><tr><th>ID</th><th>Razão Social</th><th>Total</th></tr></thead><tbody>';
					
			$categorias = mysql_query("SELECT SUM(quantidade*(valor-desconto)) as total, notas_nf.empresa FROM notas_nf INNER JOIN notas_itens_add ON notas_nf.id = notas_itens_add.nota WHERE notas_nf.obra in($oba) and (notas_nf.recebimento between '$inicial' and '$final') AND notas_nf.tipo_nota IN($tpa) AND notas_itens_add.categoria IN($eta) GROUP BY notas_nf.empresa ORDER BY total DESC");
			$se = 0; $total_geral = 0;
			while($c = mysql_fetch_array($categorias)) {
				$se += 1;
				echo '<tr>';
					echo '<td width="5%">'.$se.'</td>';
					echo '<td width="80%">'.mysql_result(mysql_query("SELECT * FROM notas_empresas WHERE id = '$c[empresa]'"),0,"razao_social").'</td>';
					echo '<td data-value="'.$c['total'].'" >R$&nbsp;'.number_format($c['total'],2,",",".").'</td>';
				echo '</tr>';
				$total_geral += $c['total'];
			}
			echo '</tbody></table>';	
			echo '	<div class="page-header">
						<h1 class="pull-right" style="font-family: \'Oswald\', sans-serif; letter-spacing:5px;">Total Geral <small> R$ '.number_format($total_geral,2,",",".").'</small></h1>
					</div>';		
			exit;		
		}
		// C A T E G O R I A -------------------------------------------------------------------------
		if($relatorio==7) {		
			foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1);
			foreach($et as $ets) { @$eta .= $ets.','; } $eta = substr($eta,0,-1);
			foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
			foreach($tp as $tps) { @$tpa .= $tps.','; } $tpa = substr($tpa,0,-1);
			topoPrint();
			$ano = explode("-",$final);
			echo '
				<p>
					<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
						MEMORIA DE CALCULO - CATEGORIAS <br/>
							<small>POR DATA DE <b>EMISSÃO</b></small>
					</h3>
					<p style="text-align:center;  font-size:14px;"><small>Periodo: '.implode("/",array_reverse(explode("-",$inicial))).' à '.implode("/",array_reverse(explode("-",$final))).'</small></p>
				</p>
				<p class="hidden-xs hidden-lg hidden-md visible-print" style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
					';
					$obra_controle = mysql_query("SELECT * FROM notas_obras WHERE id IN($oba)");
					while($c = mysql_fetch_array($obra_controle)){
						echo $c['descricao'].'<br/>';
					}
					echo '
				</p>
				<hr/>';	
			echo '<table class="table table-min table-striped" style="font-size:18px;">';
			echo '<thead><tr><th>ID</th><th>Categoria</th><th>Porc.</th><th>Total</th></tr></thead><tbody>';
				
	
			$total_itens_g = mysql_result(mysql_query("SELECT SUM(quantidade*(valor-desconto)) as total FROM notas_nf INNER JOIN notas_itens_add ON notas_nf.id = notas_itens_add.nota WHERE notas_nf.obra in($oba) and (notas_nf.recebimento between '$inicial' and '$final') AND notas_nf.tipo_nota IN($tpa) AND notas_itens_add.categoria IN($eta)"),0,"total");
			
			$categorias = mysql_query("SELECT SUM(quantidade*(valor-desconto)) as total, notas_itens_add.categoria FROM notas_nf INNER JOIN notas_itens_add ON notas_nf.id = notas_itens_add.nota WHERE notas_nf.obra in($oba) and (notas_nf.recebimento between '$inicial' and '$final') AND notas_nf.tipo_nota IN($tpa) AND notas_itens_add.categoria IN($eta) GROUP BY notas_itens_add.categoria ORDER BY total DESC");
			$se = 0; $total_geral = 0;
			while($c = mysql_fetch_array($categorias)) {
				$porcentagem = ($c['total']/$total_itens_g)*100;
				$se += 1;
				echo '<tr>';
					echo '<td width="5%">'.$se.'</td>';
					echo '<td width="65%">'.mysql_result(mysql_query("SELECT * FROM notas_categorias WHERE id = '$c[categoria]'"),0,"descricao").'</td>';
					echo '<td width="10%">'.number_format($porcentagem,2,",",".").'%</td>';
					echo '<td width="10%" data-value="'.$c['total'].'" >R$&nbsp;'.number_format($c['total'],2,",",".").'</td>';
				echo '</tr>';
				$total_geral += $c['total'];
			}
			echo '</tbody></table>';	
			echo '	<div class="page-header">
						<h1 class="pull-right" style="font-family: \'Oswald\', sans-serif; letter-spacing:5px;">Total Geral <small> R$ '.number_format($total_geral,2,",",".").'</small></h1>
					</div>';		
			exit;		
		}
		// M A T E R I A L ---------------------------------------------------------------------------
		if($relatorio==8) {
			foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1);
			foreach($et as $ets) { @$eta .= $ets.','; } $eta = substr($eta,0,-1);
			foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
			foreach($tp as $tps) { @$tpa .= $tps.','; } $tpa = substr($tpa,0,-1);
			topoPrint();
			$ano = explode("-",$final);
			echo '
				<p>
					<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
						MEMORIA DE CALCULO - ALMOX<br/>
							<small>POR DATA DE <b>EMISSÃO</b></small>
					</h3>
					<p style="text-align:center;  font-size:14px;"><small>Periodo: '.implode("/",array_reverse(explode("-",$inicial))).' à '.implode("/",array_reverse(explode("-",$final))).'</small></p>
				</p>
				<p class="hidden-xs hidden-lg hidden-md visible-print" style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
					';
					$obra_controle = mysql_query("SELECT * FROM notas_obras WHERE id IN($oba)");
					while($c = mysql_fetch_array($obra_controle)){
						echo $c['descricao'].'<br/>';
					}
					echo '
				</p>
				<hr/>';	
			echo '<table class="table table-min table-striped" style="font-size:18px;">';
			echo '<thead><tr><th>ID</th><th>Descrição</th><th>Porc.</th><th>Total</th></tr></thead><tbody>';
				
	
			$total_itens_g = mysql_result(mysql_query("SELECT SUM(quantidade*(valor-desconto)) as total FROM notas_nf INNER JOIN notas_itens_add ON notas_nf.id = notas_itens_add.nota WHERE notas_nf.obra in($oba) and (notas_nf.recebimento between '$inicial' and '$final') AND notas_nf.tipo_nota IN($tpa) AND notas_itens_add.categoria IN($eta)"),0,"total");
			
			$categorias = mysql_query("SELECT SUM(quantidade*(valor-desconto)) as total, notas_itens_add.item FROM notas_nf INNER JOIN notas_itens_add ON notas_nf.id = notas_itens_add.nota WHERE notas_nf.obra in($oba) and (notas_nf.recebimento between '$inicial' and '$final') AND notas_nf.tipo_nota IN($tpa) AND notas_itens_add.categoria IN($eta) GROUP BY notas_itens_add.item ORDER BY total DESC");
			$se = 0; $total_geral = 0;
			while($c = mysql_fetch_array($categorias)) {
				$porcentagem = ($c['total']/$total_itens_g)*100;
				$se += 1;
				echo '<tr>';
					echo '<td width="5%">'.$se.'</td>';
					echo '<td width="65%">'.mysql_result(mysql_query("SELECT * FROM notas_itens WHERE id = '$c[item]'"),0,"descricao").'</td>';
					echo '<td width="10%">'.number_format($porcentagem,2,",",".").'%</td>';
					echo '<td width="10%" data-value="'.$c['total'].'" >R$&nbsp;'.number_format($c['total'],2,",",".").'</td>';
				echo '</tr>';
				$total_geral += $c['total'];
			}
			echo '</tbody></table>';	
			echo '	<div class="page-header">
						<h1 class="pull-right" style="font-family: \'Oswald\', sans-serif; letter-spacing:5px;">Total Geral <small> R$ '.number_format($total_geral,2,",",".").'</small></h1>
					</div>';		
			exit;		
		}
		// A L  M O X  -------------------------------------------------------------------------------
		if($relatorio==9) {
			foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1);
			foreach($et as $ets) { @$eta .= $ets.','; } $eta = substr($eta,0,-1);
			foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
			foreach($tp as $tps) { @$tpa .= $tps.','; } $tpa = substr($tpa,0,-1);
			topoPrint();
			$ano = explode("-",$final);
			echo '
				<p>
					<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
						MEMORIA DE CALCULO - MATERIAL<br/>
							<small>POR DATA DE <b>EMISSÃO</b></small>
					</h3>
					<p style="text-align:center;  font-size:14px;"><small>Periodo: '.implode("/",array_reverse(explode("-",$inicial))).' à '.implode("/",array_reverse(explode("-",$final))).'</small></p>
				</p>
				<p class="hidden-xs hidden-lg hidden-md visible-print" style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
					';
					$obra_controle = mysql_query("SELECT * FROM notas_obras WHERE id IN($oba)");
					while($c = mysql_fetch_array($obra_controle)){
						echo $c['descricao'].'<br/>';
					}
					echo '
				</p>
				<hr/>';	
			echo '<table class="table table-min table-striped table-bordered ">';
			echo '<thead>
						<tr>
							<th colspan="4" style="background:#fff; border-top:1px solid #fff; border-left:1px solid #fff; border-right:1px solid #ccc"></th>
							<th colspan="3" style="text-align:center">Controle Material</th>
							<th colspan="2" style="background:#fff; border-top:1px solid #fff; border-left:1px solid #ccc; border-right:1px solid #fff"></th>
						</tr>
						<tr><th>ID</th> <th>Status</th> <th>Categoria</th><th>Material / Sub-Categoria </th><th style="text-align:center">Entrada</th><th style="text-align:center">Saida</th><th style="text-align:center">Total</th><th style="text-align:center">Vlr UN</th><th style="text-align:center">Total Vlr</th></tr>
					</thead>
					<tbody>';
			
			$se = 0;	
			
			$categorias = mysql_query("select * from notas_itens where categoria in($eta)");
			
			while($c = mysql_fetch_array($categorias)) {
				$cat_id = $c['id'];
				$categoria_id = $c['categoria'];
				
				$totall = mysql_result(mysql_query("SELECT SUM(notas_itens_add.quantidade) as totalSum FROM notas_nf INNER JOIN notas_itens_add ON notas_nf.id = notas_itens_add.nota WHERE notas_itens_add.item = '$cat_id' AND notas_itens_add.categoria <> '20' AND notas_itens_add.equipe IN($equ) AND (notas_nf.recebimento BETWEEN '$inicial' AND '$final') and notas_nf.obra IN($oba) ORDER BY notas_itens_add.categoria"),0,"totalSum");	

				$totallValor = mysql_result(mysql_query("SELECT SUM(notas_itens_add.quantidade*notas_itens_add.valor) as totalSum FROM notas_nf INNER JOIN notas_itens_add ON notas_nf.id = notas_itens_add.nota WHERE notas_itens_add.item = '$cat_id' AND notas_itens_add.equipe IN($equ) AND (notas_nf.recebimento BETWEEN '$inicial' AND '$final') and notas_nf.obra IN($oba)"),0,"totalSum");

				$totallUN = @mysql_result(mysql_query("SELECT notas_itens_add.valor as valor FROM notas_nf INNER JOIN notas_itens_add ON notas_nf.id = notas_itens_add.nota WHERE notas_itens_add.item = '$cat_id' AND notas_nf.obra IN($oba) ORDER BY notas_itens_add.id DESC LIMIT 1"),0,"valor");

				$total_cupom = mysql_result(mysql_query("SELECT SUM(notas_retirada_itens.quantidade) as totalCupom FROM notas_retirada INNER JOIN notas_retirada_itens ON notas_retirada.id = notas_retirada_itens.id_retirada WHERE id_item = '$cat_id' and notas_retirada.tipo = 1 and (notas_retirada.data between '$inicial' and '$final') and notas_retirada.obra IN($oba)"),0,"totalCupom");

				$totalnfcupom = $totall - $total_cupom;
				
				if($totall != '' || $total_cupom != ''){
					echo '<tr>'; $se += 1;
					echo '<td width="3%">'.$cat_id.'</td>';
					
					echo '<td width="3%">';
					if($c['oculto'] == '1'){ 
						echo '<span class="btn btn-xs small btn-danger" style="font-size:8px; width:45px;">INATIVO</span>';
					}else if($c['oculto'] == '2'){
						echo '<span class="btn btn-xs small btn-success" style="font-size:8px; width:45px;">ATIVO</span>';
					}
					echo '</td>'; 
					echo '<td>'.mysql_result(mysql_query("select * from notas_categorias where id = $categoria_id"),0,"descricao").'</td>';
					echo '<td width="50%">'.$c['descricao'].'</td>'; 
					echo '<td width="10%" style="text-align:center">'.number_format($totall,2,",","").'</td>';
					echo '<td width="10%" style="text-align:center">'.number_format($total_cupom,2,",","").'</td>';
					echo '<td width="10%" style="text-align:center">'.number_format($totalnfcupom,2,",","").'</td>';

					echo '<td width="10%" style="text-align:center">R$ '.number_format($totallUN,2,",",".").'</td>';
					echo '<td width="10%" style="text-align:center">R$ '.number_format($totallValor,2,",",".").'</td>';
					//echo '<td width="10%">R$ '.number_format($totallUN,2,",",".").'</td>';

					echo '</tr>';

					$total_geral += $totallValor;
				}
			}
			echo '</tbody></table>';
				echo '	<div class="page-header">
						<h1 class="pull-right" style="font-family: \'Oswald\', sans-serif; letter-spacing:5px;">Total Geral <small> R$ '.number_format($total_geral,2,",",".").'</small></h1>
					</div>';	
			exit;			
		}
}
?>
	<div class="container-fluid" style="position:relative; top:-10px">
		<a href="javascript:window.print()" style="letter-spacing:5px; padding-left:20px; padding-right:20px; margin-left:20px;" class="hidden-xs hidden-print pull-right btn btn-warning btn-xs"> <span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir</a>
	</div>
	<div class="panel panel-default hidden-print" style="width:100%; margin-bottom:15px;">
		<h4 class="title-box"> <i class="fa fa-money" aria-hidden="true"></i> Relatorio | Notas Fiscais </h4>
		<div class="panel-body " style="background:#FFF;">	
		<form action="javascript:void(0)" onSubmit="posti(this,'financeiro/relatorio-notas.php?ac=listar','.retorno');" class="formulario-normal">
			<div class="container-fluid">
				<div class="col-xs-12 col-md-3" style="padding:3px">
					<label><small>Obra:</small>
						<select name="cidade" onChange="$('#itens').load('financeiro/relatorio-notas.php?atu=ac&cidade=' + $(this).val() + '');" class="sel" multiple="multiple" required> 
							<?php
								$cidade = mysql_query("select * from notas_obras_cidade WHERE id IN(0,$cidade_usuario) order by nome asc");
								while($l = mysql_fetch_array($cidade)) {
									echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>';
								}
							?>	
						</select>
					</label>
				</div>
				<div class="col-xs-12 col-md-9" style="padding:0px">
					<div id="itens">
						<div class="col-xs-12 col-md-4" style="padding:3px">
							<label><small>Contrato:</small>
								<select name="ob[]" class="sel" multiple="multiple" style="width:100%">
									<?php
										$obras = mysql_query("select * from notas_obras where id IN(0,$obra_usuario) order by descricao asc");
										while($l = mysql_fetch_array($obras)) {
											echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>';
										}
									?>		
								</select>
							</label>
						</div>
						<div class="col-xs-12 col-md-4" style="padding:3px">
							<label><small>Status:</small>
								<select name="st[]" OnChange="$('#itens2').load('financeiro/relatorio-notas.php?atu=st2&cidade=<?= $cidade_usuario; ?>&status3=' + $(this).val() + '');" class="sel" multiple="multiple">
									<option value="0" selected>ATIVA</option>
									<option value="1" selected>INATIVA</option>
								</select>
							</label>
						</div>
						<div class="col-xs-12 col-md-4" style="padding:3px">
							<label id="itens2"><small>Contas:</small>
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
				<div class="col-xs-12 col-md-4" style="padding:0px">
					<div class="col-xs-12 col-md-6" style="padding:3px">
						<label><small>De:</small><br/>
							<input type="date" name="inicial" value="<?php echo $inicioMes; ?>" class="form-control input-sm" size="6" placeholder="Inicial" required/>
						</label>
					</div>
					<div class="col-xs-12 col-md-6" style="padding:3px">
						<label for=""><small>até:</small><br/>
							<input type="date" name="final" value="<?php echo $todayTotal; ?>" class="form-control input-sm" size="6" placeholder="Final" required/>
						</label>
					</div>
				</div>
				<div class="col-xs-12 col-md-6" style="padding:0px">
					<div class="col-xs-12 col-md-4" style="padding:3px">
						<label for=""><small>Tipo:</small><br/>
							<select name="relatorio" class="form-control input-sm">
								<option value="" disabled>SELECIONE O TIPO DE RELATÓRIO DESEJADO</option>
								<option value="4">DETALHADA</option>
								<option value="5">SIMPLES</option>
								<option value="6">MEMORIA P/ EMPRESA </option>
								<option value="7">MEMORIA P/ CATEGORIA</option>
								<option value="8">MEMORIA P/ MATERIAL</option>
								<option value="9">MEMORIA ALMOX </option>
							</select>
						</label>
					</div>
					<div class="col-xs-12 col-md-4" style="padding:3px">
						<label for=""><small>Categoria: </small>
							<select name="et[]" class="sel" multiple="multiple">
								<?php
									$sql = mysql_query("select * from notas_categorias order by descricao asc");
									while($l = mysql_fetch_array($sql)) { extract($l);
										echo '<option value="'.$id.'" selected>'.$descricao.'</option>';
									}
								?>
							</select>
						</label>
					</div>
					<div class="col-xs-12 col-md-4" style="padding:3px">
						<label for=""><small>Tipo Nota: </small>
							<select name="tp[]" class="sel" multiple="multiple">
								<option value="0" selected>DESPESAS</option>
								<option value="1" selected>RENDIMENTOS</option>
							</select>
						</label>
					</div>
				</div>
				<div class="col-xs-12 col-md-2" style="padding:3px">
					<label><br/>
						<input type="submit" style="margin-left:5px; width:100%" value="Buscar" class="btn btn-success btn-sm" />
					</label>
				</div>
			</div>
		</form>
		</div>
	</div>
	<div class="retorno" style="margin-top:0px;"></div>
	
	<div class="modal" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="height:auto;">
		<div class="modal-dialog" style="width:90%;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" style="color:#C9302C; opacity:1; "  onclick="$('.modal').modal('hide')" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel" style="font-family: \'Oswald\', sans-serif; letter-spacing:5px;">Visualizar Informações</h4>
				</div>
				<div class="modal-body">
					Aguarde um momento &nbsp;&nbsp; <img src="../../imagens/loading.gif" alt="Carregando" width="20px"/>
				</div>
			</div>
		</div>
	</div>