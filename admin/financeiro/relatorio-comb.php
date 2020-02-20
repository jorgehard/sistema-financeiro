<?php
	include("../config.php");
	include("../validar_session.php");
	include("../../functions/function-print.php");
	getData();
	getNivel();
?>
<script src="../js/combobox-resume.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	jQuery.tablesorter.addParser({
		id: "monetaryValue",
		is: function (s) {
			return false;
		}, format: function (s) {
			var n = parseFloat( s.replace('R$','').replace(/,/g,'') );
			return isNaN(n) ? s : n;
		}, type: "numeric"
	});
	$("#resultadoTabela").tablesorter();
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

<style type="text/css">

@media print {
	.quebrapagina {
	   page-break-before: always;
	   float:none;
	}
	table, tr, thead, tbody, td, th{
		border:1px solid rgba(23, 23, 23, 0.6) !important;
	}

}
</style>
<?php
	if($atu=='notafiscal'){
		echo '<label style="width:100%" class="formulario-normal"><small>Nota Fiscal:</small>
			<select name="num_nota" class="form-control input-sm combobox">	
			<option></option>';	
			$numeros = mysql_query("select numero from notas_nf WHERE obra IN($obra_usuario) order by numero asc");
			while($l = mysql_fetch_array($numeros)) {
				echo '<option value="'.$l['id'].'">'.$l['numero'].'</option>';
			}
						
			$numerosb = mysql_query("select nota from comb_rm where obra IN($obra_usuario) GROUP BY nota ORDER BY data DESC");
			while($d = mysql_fetch_array($numerosb)) {
				echo '<option value="'.$d['nota'].'">'.$d['nota'].'</option>';
			}	
			echo '</select>';
		echo '</label>';
		exit;
	}
	if(@$ac=='listar') {
	if($relatorio==11) {
		foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1);
		foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
			
		$ft2s = mysql_query("select *, comb_rm.id as id, notas_equipamentos.local as funcionario, notas_equipamentos.equipe as equipe from comb_rm, notas_equipamentos where comb_rm.equipamento = notas_equipamentos.id and comb_rm.equipe IN($equ) and comb_rm.tipo IN(1,2) and comb_rm.nota = '$num_nota' AND comb_rm.obra IN($oba) order by notas_equipamentos.sub_categoria asc");
		
		$frow1 = @mysql_result($ft2s,0,"nota");
		$frow2 = @mysql_result($ft2s,0,"tipo");
		$frow3 = @mysql_result($ft2s,0,"obra");
		
		topoPrint();
		
		$ano = explode("-",$final);
			echo '<p>
					<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
						CONTROLE DE CONSUMO DE COMBUSTÍVEL
					</h3>';
						if($frow2 == 2){
							echo '<h5 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center; "><small> NOTA FISCAL: <b>'.$frow1.'</b> <br/>REF: <b>'.$mes.' / '.$ano[0].' </b></small></h5>';
						}else{
							echo '<h5 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center; "><small> NOTA FISCAL: <b>'.$num_nota.'</b>  <br/>REF: <b>'.$mes.' / '.$ano[0].' </b></small></h5>';
						}
						
						
					echo '
				</p>
				<p style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
					'.mysql_result(mysql_query("select * from notas_obras where id = '$frow3'"),0,"descricao").'
				</p>
				<p style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;"><small>Período: '.implode("/",array_reverse(explode("-",$inicial))).' á '.implode("/",array_reverse(explode("-",$final))).'</small></p>';
		//================================ INICIO ===============================================
		//=======================================================================================
		$ftes = mysql_query("select *, comb_rm.id as id, notas_equipamentos.local as funcionario, comb_rm.equipe as equipe_fu2 from comb_rm, notas_equipamentos where comb_rm.equipamento = notas_equipamentos.id and comb_rm.equipe IN($equ) and comb_rm.tipo IN(1,2) and comb_rm.nota = '$num_nota' AND comb_rm.obra IN($oba) order by notas_equipamentos.sub_categoria asc");
		
		while($l = mysql_fetch_array($ftes)) {
			
			$se += 1;  $km_fixed_s = $l['km_inicial']; $km_fixed_f = $l['km_final']; $categoriaid = $l['categoria'];
			$placa_fixed = @mysql_result(mysql_query("select * from notas_equipamentos where id = ".$l['equipamento'].""),0,"placa");
			$sub_ = @mysql_result(mysql_query("select * from notas_equipamentos where id = ".$l['equipamento'].""),0,"sub_categoria");
			$sub_fixed = @mysql_result(mysql_query("select * from notas_cat_sub where id = '$sub_'"),0,"descricao");
			$equipe_fu2 = @mysql_result(mysql_query("select * from equipes where id = ".$l['equipe_fu2'].""),0,"nome");
			$catnome = @mysql_result(mysql_query("select * from notas_cat_e where id = '$categoriaid'"),0,"descricao");
			if($catnome != $recu_catnome){
				echo ' <span style="font-weight:bold; font-size:10px; display:block; margin-top:30px; ">Categoria: '.$catnome.'</span>';
				echo '<table class="table-min table-color small" cellpadding="1" cellspacing="0" style="border-collapse:collapse;font-size:11px; margin-top:5px; margin-bottom:10px;" border="1" width="100%">';
			}else{
				echo '<table class="table-min table-color small" cellpadding="1" cellspacing="0" style="border-collapse:collapse;font-size:11px; margin-top:5px; margin-bottom:10px;" border="1" width="100%">';
			}
			$recu_catnome = $catnome;
			//========================================================================================
			//========================================================================================
			
				echo '<tr class="small"><th><center>DATA</center></th><th><center>ODÔMETRO</center></th> <th colspan="6"><h6>Veículo: <b>'.$sub_fixed.' - '.$placa_fixed.'</b></h6></th><th>'.$equipe_fu2.' - '.implode("/",array_reverse(explode("-",$l['data_ref']))).'<a href="#"  class="pull-right btn btn-warning btn-xs hidden-print" onclick=\'$(".resultado").load("financeiro/editar-comb-rm.php?cod_rm='.$l['id'].'&tipocc=COMB&rec_obu='.$obu.'&rec_tipo='.$relatorio.'&rec_mes='.$mes.'&rec_obra='.$oba.'&rec_equ='.$equ.'")\'><span class="glyphicon glyphicon-folder-open"></span></a></th></tr>';
			
				$total_odo = $l['km_final'] - $l['km_inicial'];
				$funcionario = @mysql_result(mysql_query("select * from rh_funcionarios where id = ".$l['funcionario'].""),0,"nome");
				$get_inicial_km = mysql_result(mysql_query("SELECT km_inicial FROM comb_rm where id =".$l['id'].""),0,"km_inicial");
				$get_inicial_data = mysql_result(mysql_query("SELECT data FROM comb_rm where id =".$l['id'].""),0,"data");
			
				echo '<tr class="small"><th style="font-weight:normal; background:none; padding:0px;">'.implode("/",array_reverse(explode("-",$get_inicial_data))).'</th><th style="font-weight:normal; background:none; padding:0px;">'.$get_inicial_km.'</th><th>KM RODADOS</th><th><center>LITROS</center><th><center>CCFISCAL</center></th><th>MEDIA KM</th><th>TOTAL</th><th>FUNCIONARIO</th><th><center>$ / LITRO</center></th><th colspan="2"><center>OBSERVAÇÃO</center></th></tr>';
					
				$inicial = implode("-",array_reverse(explode("/",$inicial))); $final = implode("-",array_reverse(explode("/",$final))); 
			
				$total_qtd = 0; $total_vlr = 0; $total_media = 0; $numerolinhas = 0;
			
				$ss_s = mysql_query("select *, funcionario as funcionario_itens from comb_rm_itens where comb_rm_itens.cod_rm = ".$l['id']." ORDER BY comb_rm_itens.data asc") or die (mysql_error());
			
				$n1 = $get_inicial_km;
			
				while($l = mysql_fetch_array($ss_s)) {  extract($l);
					$numerolinhas = mysql_num_rows($ss_s);
					$kmrodados = $l['kmfinal'] - $n1; 
					$n1 = $l['kmfinal'];
					$mediakm = $kmrodados / $l['qtd'];
					$su += 1;
					$total = $l['qtd'] * $l['vlr'];
					//$total = bcmul($total, '100', 2); 
					//$total = bcdiv($total, '100', 2);
					echo '<tr class="small">';
					echo '<td>'.implode("/",array_reverse(explode("-",$l['data']))).'</td>';
					echo '<td>'.$l['kmfinal'].'</td>';
					echo '<td>'.$kmrodados.'</td>';
					echo '<td><center>'.number_format($qtd,"2").'</center></td>';
					echo '<td><center>'.$l['cupom'].'</center></td>';
					echo '<td><center>'.number_format($mediakm,"2").'</center></td>';
					echo '<td><center> R$ '.number_format($total,"2").'</center></td>';
					echo '<td><center>'.mysql_result(mysql_query("SELECT * FROM rh_funcionarios WHERE id = '$funcionario_itens'"),0,"nome").'</center></td>';
					echo '<td><center> R$ '.number_format($vlr,"2").'</center></td>';
					echo '<td colspan="2"><center>'.$obs.'</center></td>';
					echo '</tr>';
					
					$total_media += $mediakm;	
					$total_vlr += $total;				
				}
				$total_qtd = $total_media / $numerolinhas;
				$total_geral_fixed += $total_vlr;
				$total_qtd_fixed += $total_qtd;
				$it2 = 0; 

				echo '<tr bgcolor="#FF0000"><th colspan="4"></th><th>Total:</th><th><center><b>'.number_format($total_qtd,"2").'</center></th><th><center><h5><b>R$ '.number_format($total_vlr,"2",",","").'</center></th><th colspan="3"></th></tr>';

				echo '</tbody></table>'; 
		}
		echo '<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:right;">Total Geral <small>R$ '.number_format($total_geral_fixed,"2",",",".").'</small></h1>';
		exit;		
	}
	if($relatorio==12) {
		foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1);
		foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
			
		$ft2s = mysql_query("select *, comb_rm.id as id, notas_equipamentos.local as funcionario, notas_equipamentos.equipe as equipe from comb_rm, notas_equipamentos where comb_rm.equipamento = notas_equipamentos.id and comb_rm.equipe IN($equ) and comb_rm.tipo IN(1,2) and comb_rm.nota = '$num_nota' AND comb_rm.obra IN($oba) order by notas_equipamentos.sub_categoria asc");
		
		$frow1 = @mysql_result($ft2s,0,"nota");
		$frow2 = @mysql_result($ft2s,0,"tipo");
		$frow3 = @mysql_result($ft2s,0,"obra");
		
		topoPrint();
		
		$ano = explode("-",$final);
			echo '<p>
					<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
						CONTROLE DE CONSUMO DE COMBUSTÍVEL
					</h3>';
						if($frow2 == 2){
							echo '<h5 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center; "><small> NOTA FISCAL: <b>'.$frow1.'</b> <br/>REF: <b>'.$mes.' / '.$ano[0].' </b></small></h5>';
						}else{
							echo '<h5 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center; "><small> NOTA FISCAL: <b>'.$num_nota.'</b>  <br/>REF: <b>'.$mes.' / '.$ano[0].' </b></small></h5>';
						}
						
						
					echo '
				</p>
				<p style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
					'.mysql_result(mysql_query("select * from notas_obras where id = '$frow3'"),0,"descricao").'
				</p>
				<p style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;"><small>Período: '.implode("/",array_reverse(explode("-",$inicial))).' á '.implode("/",array_reverse(explode("-",$final))).'</small></p>';
				
				
		$ftes = mysql_query("select *, comb_rm.id as id, notas_equipamentos.local as funcionario, comb_rm.equipe as equipe_fu2 from comb_rm, notas_equipamentos where comb_rm.equipamento = notas_equipamentos.id and comb_rm.equipe IN($equ) and comb_rm.tipo IN(1,2) and comb_rm.nota = '$num_nota' AND comb_rm.obra IN($oba) order by notas_equipamentos.sub_categoria asc");
		echo '<table id="resultadoTabela" class="table table-bordered table-striped table-min table-color" width="100%">';
			echo '<thead>';
			echo '<tr><th>Ord.</th><th>Equipe</th><th>Categoria</th><th>Sub-Categoria</th><th>Placa</th><th>Valor</th></tr>';
			echo '</thead><tbody>';
		while($l = mysql_fetch_array($ftes)) {
			$se += 1;
			echo '<tr>';
			echo '<td width="5px">'.$se.'</td>';
			echo '<td>'.@mysql_result(mysql_query("SELECT * FROM equipes WHERE id = '".$l['equipe_fu2']."'"),0,"nome").'</td>';
			
			echo '<td>'.@mysql_result(mysql_query("SELECT * FROM notas_cat_e WHERE id = '".$l['categoria']."'"),0,"descricao").'</td>';
			echo '<td>'.@mysql_result(mysql_query("SELECT * FROM notas_cat_sub WHERE id = '".$l['sub_categoria']."'"),0,"descricao").'</td>';
			echo '<td>'.@mysql_result(mysql_query("select * from notas_equipamentos where id = ".$l['equipamento'].""),0,"placa").'</td>';

				$ss_s = mysql_query("select *, funcionario as funcionario_itens from comb_rm_itens where comb_rm_itens.cod_rm = ".$l['id']." ORDER BY comb_rm_itens.data asc") or die (mysql_error());
				$total_vlr = 0;
				while($l = mysql_fetch_array($ss_s)) {  extract($l);
					$total = $l['qtd'] * $l['vlr'];
					$total_vlr += $total;				
				}
			echo '<td>R$ '.number_format($total_vlr,"2",",","").'</td>';
			
			echo '</tr>';
			$total_geral_fixed += $total_vlr;
		}
		
				echo '</tbody></table>'; 
		echo '<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:right;">Total Geral <small>R$ '.number_format($total_geral_fixed,"2",",",".").'</small></h1>';
		exit;		
	}				
}
?>	
	<table width="100%" class="table-responsive nav-pills2 hidden-print" style="margin-bottom:15px">
		<tr>
			<td><a href="#" onclick="ldy('financeiro/cadastrar-comb.php','.conteudo')"><li><span class="glyphicon glyphicon-star"></span> 
			CADASTRAR PLACA</li></a></td>
			<td><a href="#" onclick="ldy('financeiro/consultar-comb.php','.conteudo')"><li><small><span class="glyphicon glyphicon-search"></span></small> 
			CONSULTAR CUPOM</li></a></td>
			<td><a href="#" onclick="ldy('financeiro/relatorio-comb.php','.conteudo')"><li class="activeb"><span class="glyphicon glyphicon-th-list"></span> 
			EMITIR RELATORIO</li></a></td>
		</tr>
	</table>

	<div class="container-fluid hidden-print" style="padding:0px 0px 15px 0px; margin-bottom:20px; border-bottom:1px solid #CCC">
		<img src="../imagens/logo.png" class="img-responsive" width="50px" style="float:left; margin-right:20px"/>
		<h3 style="font-family: 'Oswald', sans-serif; letter-spacing:5px;"> 
			RELATÓRIO DE <small><b>COMBUSTIVEL</b></small>
			<a href="javascript:window.print()" style="letter-spacing:8px; padding-left:40px; padding-right:40px;" class="hidden-xs hidden-print pull-right btn btn-warning btn-sm"> <span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir</a>
		</h3>
	</div>
	<div class="well well-sm hidden-print" style="padding:10px 10px 5px 10px;">
		<form action="javascript:void(0)" onSubmit="posti(this,'financeiro/relatorio-comb.php?ac=listar','.resultado');" class="form-inline">
			<div class="container-fluid" style="padding:0px">
				<div class="col-xs-8" style="padding:0px">
					<div class="col-xs-2" style="padding:2px">
						<label style="width:100%"><small>Obra:</small><br/>
							<select name="ci[]" onChange="$('#item-consulta-obra').load('../functions/functions-load.php?atu=equipe&cidade=' + $(this).val() + ''); $('#item-notafiscal').load('financeiro/relatorio-comb.php?atu=notafiscal');" class="sel" multiple="multiple" id="categ" required> 
							<?php
								$cidade = mysql_query("select * from notas_obras_cidade WHERE id IN(0,$cidade_usuario) order by nome asc");
								while($l = mysql_fetch_array($cidade)) {
									echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>';
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
				<div class="col-xs-4" style="padding:2px">
					<div id="item-notafiscal">
						<label style="width:100%" class="formulario-normal"><small>Nota Fiscal:</small>
							<select name="num_nota" class="form-control input-sm combobox">	
								<option>Selecione uma obra</option>		
							</select>
						</label>
					</div>
				</div>
				<div class="col-xs-3" style="padding:2px">
					<label style="width:100%"><small>Tipo:</small>
						<select name="relatorio" class="form-control input-sm" style="width:100%">
							<option value="" disabled>Selecione o tipo de relatório desejado</option>
							<option value="11">DETALHADA</option>
							<option value="12">SIMPLES</option>
						</select>
					</label>
				</div>
				<div class="col-xs-4" style="padding:0px">
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
				<div class="col-xs-3" style="padding:2px">
					<label style="width:100%"><small>Mês:</small>
						<select name="mes" class="form-control input-sm" style="width:100%">
							<option value="" disabled>SELECIONE O MÊS REFERENTE</option>
							<option value="JANEIRO">JANEIRO</option>
							<option value="FEVEREIRO">FEVEREIRO</option>
							<option value="MARÇO">MARÇO</option>
							<option value="ABRIL">ABRIL</option>
							<option value="MAIO">MAIO</option>
							<option value="JUNHO">JUNHO</option>
							<option value="JULHO">JULHO</option>
							<option value="AGOSTO">AGOSTO</option>
							<option value="SETEMBRO">SETEMBRO</option>
							<option value="OUTUBRO">OUTUBRO</option>
							<option value="NOVEMBRO">NOVEMBRO</option>
							<option value="DEZEMBRO">DEZEMBRO</option>
						</select>
					</label>
				</div>
				<div class="col-xs-2" style="padding:2px;">
					<label class="pull-right" style="width:100%"><br/>
						<input type="submit" value="Pesquisar" style="width:100%" class="btn btn-success btn-sm">
					</label>
				</div>
			</div> <!-- container end -->
		</form>
	</div>
	
	<div class="resultado"></div>