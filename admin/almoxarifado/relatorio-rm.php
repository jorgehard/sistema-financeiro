<?php
	include("../config.php");
	include("../validar_session.php");
	include("../../functions/function-print.php");
	getData();
	getNivel();
?>
<script type="text/javascript">
$(document).ready(function(){
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
<style>
	@media print
	{
		table, tr, thead, tbody, td, th{
			border:1px solid #000 !important;
		}
	}

</style>
<?php
	
	if(@$ac=='listar') {
		//RELATORIO DETALHADA
		if($relatorio==10) {
			topoPrint();
			echo '
				<p>
					<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
						RELATÓRIO REMESA SABESP - DETALHADO
					</h3>
					<p style="text-align:center;  font-size:14px;"><small>Período: '.implode("/",array_reverse(explode("-",$inicial))).' á '.implode("/",array_reverse(explode("-",$final))).'</small></p>
				</p>';
			
			foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);

			$ftes = mysql_query("select * from ss_rm WHERE	(ss_rm.data between '$inicial' and '$final') and ss_rm.obra in($oba) order by numero DESC") or die (mysql_error());
			
			while($l = mysql_fetch_array($ftes)) { 	
				@$se = 1+@$it3++;

				echo '<table class="table table-condensed table-color small" style="font-size:10px">';
				echo '<br><thead><tr class="info"><th>'.$se.'<th colspan="2"><h8><b><left>NOTA DE REMESSA: '.$l['numero'].' </b></h5></th> <th colspan="5"><h8><b>'.implode("/",array_reverse(explode("-",$l['data']))).' - '.mysql_result(mysql_query("select * from notas_obras WHERE id = ".$l['obra'].""),0,"descricao").'</h7>	</th></tr>';
					
				echo '<tr class="active">
						<th style="text-align:center">Ord.</th>
						<th style="text-align:center">Código</th>
						<th>Material:</th>
						<th style="text-align:center">UN</th>
						<th style="text-align:center">Qtd.</th>
						<th style="text-align:center">Valor</th>
						<th style="text-align:center">Total</th>
					</tr></thead>';
					

				$inicial = implode("-",array_reverse(explode("/",$inicial))); $final = implode("-",array_reverse(explode("/",$final))); 				
					
				$ss_s = mysql_query("select * from ss_rm_itens,ss_materiais WHERE cod_rm = ".$l['id']." and ss_rm_itens.item = ss_materiais.id order by ss_materiais.codigo asc") or die (mysql_error());
				
				while($l = mysql_fetch_array($ss_s)) {  
					extract($l);
					@$su = 1+@$it2++;
	
					$total = 0;
					$vlr_item = $l['qtd']*$l['vlr'];
					$total += $vlr_item;
		
					$ma = @mysql_result(mysql_query("select * from ss_materiais WHERE id = ".$l['item'].""),0,"descricao");		
					$cod_ma = @mysql_result(mysql_query("select * from ss_materiais WHERE id = ".$l['item'].""),0,"codigo");		
					$un = @mysql_result(mysql_query("select * from ss_materiais WHERE id = ".$l['item'].""),0,"unidade");	echo '<tr>';
						echo '<td width="5%" align="center">'.$su.'</td>';
						echo '<td align="center">'.$cod_ma.'</td>';
						echo '<td>'.$ma.'</td>';
						echo '<td width="5%" align="center">'.$un.'</td>';
						echo '<td width="5%" align="center">'.number_format($qtd,"2").'</td>';
						echo '<td width="10%" data-order="'.$vlr.'" align="center">R$ '.number_format($vlr,"2").'</td>';
						echo '<td width="10%" data-order="'.$total.'" align="center">R$ '.number_format($total,"2").'</td>';
					echo '</tr>';	
						$total_geral += $total;
				}
				$it2 = 0;
					
				echo '</tbody></table>'; }
					
				echo '
						<div class="alert alert-info" role="alert" style="border:none">
							<h1 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:right;">Total Geral <small>R$ '.number_format($total_geral,"2",",",".").'</small></h1></div>';
		
				exit;		
			}
			//RELATORIO SIMPLES
		if($relatorio==11) {
			topoPrint();
			
			echo '<table id="resultadoTabela" class="table table-condensed table-color" style="font-size:12px">';
				echo '<thead><tr class="small"><th align="left">ID</th><th>Numero: RM:</th><th>Obra:</th><th>Data:</th><th>Qtd:</th><th>Valor:</th><th>Total:</th></tr></thead><tbody>';
						
				foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);

				$inicial = implode("-",array_reverse(explode("/",$inicial))); $final = implode("-",array_reverse(explode("/",$final))); 				
						
				$ss_s = mysql_query("select * from ss_rm, ss_rm_itens WHERE ss_rm_itens.cod_rm = ss_rm.id and (ss_rm.data between '$inicial' and '$final') and ss_rm.obra in($oba) group by ss_rm.id order by ss_rm.numero asc") or die (mysql_error());
				
				while($l = mysql_fetch_array($ss_s)) { 
					extract($l);
					
					$total = 0;
					
					$rm_itens = mysql_query("select * from ss_rm_itens WHERE cod_rm = '$cod_rm'");
					
					while($l = mysql_fetch_array($rm_itens)) {
						$vlr_item = $l['qtd']*$l['vlr'];
						$total += $vlr_item;
					}
					
					echo '<tr>';	
						echo '<td>'.$id.'</td>';
						echo '<td>'.$numero.'</td>';
						echo '<td>'.mysql_result(mysql_query("select * from notas_obras WHERE id = '$obra'"),0,"descricao").'</td>';
						echo '<td data-order="'.$data.'" >'.implode("/",array_reverse(explode("-",$data))).'</td>';
						echo '<td width="5%" align="center">'.number_format($qtd,"2").'</td>';
						echo '<td data-order="'.$vlr.'" width="10%" align="center">'.money_format('%n', $vlr).'</td>';
						echo '<td data-order="'.$total.'" width="10%" align="center">'.money_format('%n', $total).'</td>';
						echo '</tr>';	
						$total_geral += $total;		
				}
				echo '</tbody></table>';
						
				echo '<div class="page-header"><h1>Total Geral <small>R$ '.number_format($total_geral,"2",",",".").'</small></h1></div>';
				exit;		
			}
		//RELATORIO MEMORIA RM/SS
		if($relatorio==12) {
			foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1); 
			foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
			topoPrint();
			echo '
				<p>
					<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
						RELATORIO RM - MATERIAL
					</h3>
					<p style="text-align:center;  font-size:14px;"><small>Período: '.implode("/",array_reverse(explode("-",$inicial))).' á '.implode("/",array_reverse(explode("-",$final))).'</small></p>
				</p>
				<p class="hidden-xs hidden-lg hidden-md visible-print" style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
					';
					$obra_controle = mysql_query("SELECT * FROM notas_obras WHERE id IN($oba)");
					while($c = mysql_fetch_array($obra_controle)){
						echo $c['descricao'].'<br/>';
					}
					echo '
				</p>';
			echo '<table id="resultadoTabela" class="table table-condensed table-color small" id="myTable">';
			echo '<thead>
					<tr class="small">
						<th class="text-center">CODIGO</th>
						<th class="text-center">DESCRIÇÃO</th>
						<th class="text-center">RM</th>
						<th class="text-center">USADO</th>
						<th class="text-center">SALDO</th>
					</tr>
				  </thead>
				  <tbody>';

			$sql = mysql_query("SELECT codigo, id as id_item, descricao FROM ss_materiais");
			while($a = mysql_fetch_array($sql)) { extract($a);
				//RETIRADA
				//$retirada = @mysql_result(@mysql_query("SELECT SUM(quantidade) as total FROM ss_retirada_sabesp INNER JOIN ss_retirada_itens ON ss_retirada_sabesp.id = ss_retirada_itens.id_retirada WHERE ss_retirada_itens.tipo = '1' AND ss_retirada_sabesp.equipe IN($equ) AND ss_retirada_sabesp.obra IN($oba) AND ss_retirada_itens.id_item = '$id_item' AND (ss_retirada_sabesp.data BETWEEN '$inicial' and '$final') GROUP BY ss_retirada_itens.id_item"),0,"total");
				
				//DEVOLUÇÃO
				//$devolucao = @mysql_result(@mysql_query("SELECT SUM(quantidade) as total FROM ss_retirada_sabesp INNER JOIN ss_retirada_itens ON ss_retirada_sabesp.id = ss_retirada_itens.id_retirada WHERE ss_retirada_itens.tipo = '2' AND ss_retirada_sabesp.equipe IN($equ) AND ss_retirada_sabesp.obra IN($oba) AND ss_retirada_itens.id_item = '$id_item' AND (ss_retirada_sabesp.data BETWEEN '$inicial' and '$final') GROUP BY ss_retirada_itens.id_item"),0,"total");
				
				//SAIDA SS
				$total_saida = @mysql_result(@mysql_query("SELECT SUM(qtd) as total FROM ss_principal INNER JOIN ss_ma ON ss_principal.id = ss_ma.cod_ss WHERE ss_principal.obra IN($oba) AND ss_ma.equipe IN($equ) AND ss_ma.material = $id_item AND (ss_ma.data_uso BETWEEN '$inicial' and '$final') GROUP BY ss_ma.material"),0,"total");
				
				// RM
				$entrada_rm = @mysql_result(mysql_query("SELECT SUM(ss_rm_itens.qtd) as entrada FROM ss_rm INNER JOIN ss_rm_itens ON ss_rm.id = ss_rm_itens.cod_rm WHERE ss_rm.obra IN($oba) AND (ss_rm.data BETWEEN '$inicial' and '$final') AND ss_rm_itens.item = '$id_item' GROUP BY ss_rm_itens.item"),0,"entrada");
				
				//$saldo_equipes = $retirada - $devolucao;
				$saldo_equipes = $total_saida;
				$saldo_total = $entrada_rm - $saldo_equipes;
				$saldo_equipes_g += $saldo_equipes;
				$saldo_total_g += $saldo_total;
				$saldo_rm_g += $entrada_rm;
				if($saldo_equipes == '' && $saldo_total == '' && $entrada_rm == ''){
					echo '<tr class="hidden">';	
				}else{
					echo '<tr class="small">';	
				}
				echo '<td class="text-center">'.$codigo.'</td>';	
				echo '<td>'.$descricao.'</td>';
				echo '<td data-order="'.$entrada_rm.'" class="text-center">'.number_format($entrada_rm,"2",",",".").'</td>';			
				echo '<td data-order="'.$saldo_equipes.'" class="text-center">'.number_format($saldo_equipes,"2",",",".").'</td>';				
				echo '<td data-order="'.$saldo_total.'" class="text-center">'.number_format($saldo_total,"2",",",".").'</td>';
				echo '</tr>';	
			}
			echo '<tfoot>';
				echo '<tr>';
				echo '<th colspan="2"></th>';
				echo '<th class="text-center">'.number_format($saldo_rm_g,"2",",",".").'</th>';
				echo '<th class="text-center">'.number_format($saldo_equipes_g,"2",",",".").'</th>';
				echo '<th class="text-center">'.number_format($saldo_total_g,"2",",",".").'</th>';
				echo '</tr>';
			echo '</tfoot>';
			echo '</tbody>';
			echo '</table>';
			exit;	
		}
		//RELATORIO MEMORIA RM/CUPOM
		if($relatorio==13) {
			foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1); 
			foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
			topoPrint();
			echo '
				<p>
					<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
						RELATORIO RM - MATERIAL
					</h3>
					<p style="text-align:center;  font-size:14px;"><small>Período: '.implode("/",array_reverse(explode("-",$inicial))).' á '.implode("/",array_reverse(explode("-",$final))).'</small></p>
				</p>
				<p class="hidden-xs hidden-lg hidden-md visible-print" style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">';
					$obra_controle = mysql_query("SELECT * FROM notas_obras WHERE id IN($oba)");
					while($c = mysql_fetch_array($obra_controle)){
						echo $c['descricao'].'<br/>';
					}
					echo '
				</p>';		
			echo '<table class="table table-condensed table-color small" id="resultadoTabela">';
			echo '<thead>
					<tr class="small">
						<th colspan="3" style="background:transparent; border-top:1px solid #fff; border-left:1px solid #fff"> </th>
						<th colspan="3" class="text-center">CONTROLE MATERIAL</th>
						<th colspan="1" style="background:transparent; border-top:1px solid #fff; border-right:1px solid #fff"> </th>
					</tr>
					<tr class="small">
						<th class="text-center">CODIGO</th>
						<th class="text-center">DESCRIÇÃO</th>
						<th class="text-center">VLR UN</th>
						<th class="text-center">RM</th>
						<th class="text-center">RETIRADO</th>
						<th class="text-center">SALDO</th>
						<th class="text-center">TOTAL</th>
					</tr>
				  </thead>
				  <tbody>';

			$sql = mysql_query("SELECT codigo, id as id_item, descricao FROM ss_materiais");
			while($a = mysql_fetch_array($sql)) { extract($a);
				//RETIRADA
				$retirada = @mysql_result(@mysql_query("SELECT SUM(quantidade) as total FROM ss_retirada_sabesp INNER JOIN ss_retirada_itens ON ss_retirada_sabesp.id = ss_retirada_itens.id_retirada WHERE ss_retirada_itens.tipo = '1' AND ss_retirada_sabesp.equipe IN($equ) AND ss_retirada_sabesp.obra IN($oba) AND ss_retirada_itens.id_item = '$id_item' AND (ss_retirada_sabesp.data BETWEEN '$inicial' and '$final') GROUP BY ss_retirada_itens.id_item"),0,"total");
				
				//DEVOLUÇÃO
				$devolucao = @mysql_result(@mysql_query("SELECT SUM(quantidade) as total FROM ss_retirada_sabesp INNER JOIN ss_retirada_itens ON ss_retirada_sabesp.id = ss_retirada_itens.id_retirada WHERE ss_retirada_itens.tipo = '2' AND ss_retirada_sabesp.equipe IN($equ) AND ss_retirada_sabesp.obra IN($oba) AND ss_retirada_itens.id_item = '$id_item' AND (ss_retirada_sabesp.data BETWEEN '$inicial' and '$final') GROUP BY ss_retirada_itens.id_item"),0,"total");
				
				//SAIDA SS
				//$total_saida = @mysql_result(@mysql_query("SELECT SUM(qtd) as total FROM ss_principal INNER JOIN ss_ma ON ss_principal.id = ss_ma.cod_ss WHERE ss_ma.equipe IN($equ) AND ss_ma.material = $id_item AND (ss_ma.data_uso BETWEEN '$inicial' and '$final') GROUP BY ss_ma.material"),0,"total");
				
				// RM
				$entrada_rm = @mysql_result(mysql_query("SELECT SUM(ss_rm_itens.qtd) as entrada FROM ss_rm INNER JOIN ss_rm_itens ON ss_rm.id = ss_rm_itens.cod_rm WHERE ss_rm.obra IN($oba) AND (ss_rm.data BETWEEN '$inicial' and '$final') AND ss_rm_itens.item = '$id_item' GROUP BY ss_rm_itens.item"),0,"entrada");
				
				$vlr_un = @mysql_result(mysql_query("SELECT ss_rm_itens.vlr FROM ss_rm INNER JOIN ss_rm_itens ON ss_rm.id = ss_rm_itens.cod_rm WHERE ss_rm_itens.vlr <> '0.00' and ss_rm_itens.item = '$id_item' ORDER BY ss_rm_itens.id DESC LIMIT 1"),0,"vlr");
				
				$saldo_equipes = $retirada - $devolucao;
				$saldo_total = $entrada_rm - $saldo_equipes;
				$saldo_equipes_g += $saldo_equipes;
				$saldo_total_g += $saldo_total;
				$saldo_rm_g += $entrada_rm;
				if($saldo_equipes == '' && $saldo_total == '' && $entrada_rm == ''){
					echo '<tr class="hidden">';	
				}else{
					echo '<tr>';	
				}
				echo '<td class="text-center">'.$codigo.'</td>';	
				echo '<td>'.$descricao.'</td>';
				echo '<td data-order="'.$vlr_un.'" class="text-center">'.money_format('%n', $vlr_un).'</td>';			
				echo '<td data-order="'.$entrada_rm.'" class="text-center">'.number_format($entrada_rm,"2",",",".").'</td>';			
				echo '<td data-order="'.$saldo_equipes.'" class="text-center">'.number_format($saldo_equipes,"2",",",".").'</td>';				
				echo '<td data-order="'.$saldo_total.'" class="text-center">'.number_format($saldo_total,"2",",",".").'</td>';
				$saldo_total_rs = $vlr_un * $saldo_total;
				if($saldo_total_rs < 0){
					echo '<td data-order="'.$saldo_total_rs.'" class="text-center">'.money_format('%n', $saldo_total_rs).'</td>';
				}else{
					echo '<td data-order="'.$saldo_total_rs.'" class="text-center">'.money_format('%n', $saldo_total_rs).'</td>';
				}
				$saldo_total_rs_g += $saldo_total_rs;
				echo '</tr>';	
			}
			echo '<tfoot>';
				echo '<tr>';
				echo '<th colspan="3"></th>';
				echo '<th class="text-center">'.number_format($saldo_rm_g,"2").'</th>';
				echo '<th class="text-center">'.number_format($saldo_equipes_g,"2").'</th>';
				echo '<th class="text-center">'.number_format($saldo_total_g,"2").'</th>';
				echo '<th class="text-center">'.number_format($saldo_total_rs_g,"2").'</th>';
				echo '</tr>';
			echo '</tfoot>';
			echo '</tbody>';
			echo '</table>';
			exit;	
		}
	}
?>
	<div class="container-fluid hidden-print" style="padding:0px 0px 15px 0px; margin-bottom:20px; border-bottom:1px solid #CCC">
		<img src="../imagens/logo.png" class="img-responsive" width="50px" style="float:left; margin-right:20px"/>
		<h3 style="font-family: 'Oswald', sans-serif; letter-spacing:5px;"> 
			RELATÓRIO <small><b>REMESA SABESP</b></small>
			<a href="javascript:window.print()" style="letter-spacing:8px; padding-left:40px; padding-right:40px;" class="hidden-xs hidden-print pull-right btn btn-warning btn-sm"> <span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir</a>
		</h3>
	</div>
	<div class="well well-sm hidden-print" style="padding:10px 10px 5px 10px;">
		<form action="javascript:void(0)" onSubmit="posti(this,'almoxarifado/relatorio-rm.php?ac=listar','.resultado');" class="form-inline">
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
				<div class="col-xs-2" style="padding:2px">
					<label style="width:100%"><small>Tipo:</small><br/>
						<select name="relatorio" class="form-control input-sm" style="width:100%" required>
							<option value="" disabled selected>Selecione o tipo de relatório desejado</option>
							<option value="10">DETALHADA</option>
							<option value="11">SIMPLES</option>
							<option value="12">MEMORIA RM/SS</option>
							<option value="13">MEMORIA RM/CUPOM</option>
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

	<div class="resultado"></div>
