<?php
	include("../config.php");
	include("../validar_session.php");
	include("../../functions/function-print.php");
	getData();
	getNivel();
?>
<script type="text/javascript">
$(document).ready(function(){
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
	// P O L E M I C A ------------------------------------------------------------------------------------
		if($relatorio==1) {
			foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1); 
			foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
			foreach($ci as $cis) { @$cia .= $cis.','; } $cia = substr($cia,0,-1);
			topoPrint();
				echo '
				<p>
					<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
						RELATÓRIO DE MATERIAL - POLÊMICA
					</h3>
					<p style="text-align:center;  font-size:14px;"><small>Período: '.implode("/",array_reverse(explode("-",$inicial))).' á '.implode("/",array_reverse(explode("-",$final))).'</small>';
					
					$obra_controle = mysql_query("SELECT * FROM equipes WHERE id IN($equ) ORDER BY nome LIMIT 1");
					while($c = mysql_fetch_array($obra_controle)){
						echo '<br/><span class="hidden-xs hidden-md hidden-lg visible-print"><b>'.$c['nome'].'</b></span><br/>';
					}
					
				echo '</p>
		
				</p>';
			echo '<table class="table table-condensed table-color small">';
			echo '<thead>';
			echo '<tr class="small">
					<th>Nº</th>
					<th>C.R.</th>
					<th>Data:</th>
					<th>Responsavel:</th>
					<th> Equipe </th>
					<th>Material / Item:</th>
					<th>Saida</th>
					<th>Valor UN:</th>
					<th>Total </th>
					</tr>';
			echo '</thead><tbody>';

			$sql = mysql_query("SELECT notas_retirada.id as id_retirada, notas_retirada.funcionario, notas_retirada.equipe, notas_retirada.data, notas_retirada_itens.id_item, notas_retirada_itens.quantidade FROM notas_retirada INNER JOIN notas_retirada_itens ON notas_retirada.id = notas_retirada_itens.id_retirada INNER JOIN notas_itens ON notas_retirada_itens.id_item = notas_itens.id WHERE notas_itens.categoria in(2,3) and notas_retirada.equipe IN($equ) AND (notas_retirada.data BETWEEN '$inicial' and '$final') AND notas_retirada.obra IN($oba) ORDER BY notas_retirada.data DESC");				    
			while($l = mysql_fetch_array($sql)) { extract($l);
				$se += 1;
				echo '<tr>';
				echo '<td>'.$cia.'</td>';
				echo '<td>'.$id_retirada.'</td>';
				echo '<td>'.implode("/",array_reverse(explode("-",$data))).'</td>';
				echo '<td>'.@mysql_result(mysql_query("select * from rh_funcionarios where id = $funcionario"),0,"nome").'</td>';
				echo '<td>'.@mysql_result(mysql_query("select * from equipes where id = $equipe"),0,"nome").'</td>';
				echo '<td>'.mysql_result(mysql_query("SELECT descricao FROM notas_itens WHERE id = '$id_item'"),0,"descricao").'</td>';
				$obra_geral = mysql_query("SELECT * FROM notas_obras WHERE cidade IN($cia)");
				while($xz = mysql_fetch_array($obra_geral)){ $obra_g .= $xz['id'].','; } $obra_g = substr($obra_g,0,-1);
				// MEDIA MATERIAL
				$total_nf = mysql_result(mysql_query("select SUM(notas_itens_add.quantidade*notas_itens_add.valor) as totalSum FROM notas_nf, notas_itens_add WHERE notas_nf.id = notas_itens_add.nota AND notas_nf.obra in($obra_g) AND notas_itens_add.item = '$id_item' ORDER BY notas_itens_add.id DESC"),0,"totalSum");
				
				$qtd_nf = mysql_result(mysql_query("select SUM(notas_itens_add.quantidade) as totalSum FROM notas_nf, notas_itens_add WHERE notas_nf.id = notas_itens_add.nota AND notas_nf.obra in($obra_g) AND notas_itens_add.item = '$id_item'  ORDER BY notas_itens_add.id DESC"),0,"totalSum");
				
				@$total_media = @$total_nf/@$qtd_nf;
				
				echo '<td>'.number_format($quantidade,"2").'</td>';
				echo '<td> R$ '.number_format($total_media,"2", ",", ".").'</td>';
				$total = $total_media * $quantidade;
				echo '<td>R$ '.number_format($total,"2", ",", ".").'</td>';
				echo '</tr>';	
				if($_SESSION['id_usuario_logado'] == '66s'){
					echo '<tr>';
					echo "<td>select SUM(notas_itens_add.quantidade*notas_itens_add.valor) as totalSum FROM notas_nf, notas_itens_add WHERE notas_nf.id = notas_itens_add.nota AND notas_nf.obra in(".$oba.") AND notas_itens_add.item = '".$id_item."'  ORDER BY notas_itens_add.id DESC LIMIT 1</td>";
					echo "<td>select SUM(notas_itens_add.quantidade) as totalSum FROM notas_nf, notas_itens_add WHERE notas_nf.id = notas_itens_add.nota AND notas_nf.obra in(".$oba.") AND notas_itens_add.item = '".$id_item."'  ORDER BY notas_itens_add.id DESC</td>";
					echo '</tr>';
				}
				$soma3 += $total;
			}
			echo '</tbody></table>';
			echo '<tr>';
			echo '<h1>Total Geral <small>R$ '.number_format($soma3,"2",",",".").'</small></h1>';
			echo '</tr>';
			exit;		
		}	
		// RELATORIO POLEMICA MEMORIA
		if($relatorio==3) {
			foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1); 
			foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
			$data = implode("-",array_reverse(explode("/",$data)));
			echo '<h5><small>Período: '.implode("/",array_reverse(explode("-",$inicial))).' á '.implode("/",array_reverse(explode("-",$final))).'</small></h5>';
			echo '<table class="table table-condensed table-color small" id="myTable">';
			echo '<thead>
					<tr class="small">
						<th class="text-center">Nº</th>
						<th class="text-center">ITEM</th>
						<th class="text-center">DESCRIÇÃO</th>
						<th class="text-center">RETIRADA</th>
						<th class="text-center">VLR UN</th>
						<th class="text-center">TOTAL</th>
					</tr>
				  </thead>
				  <tbody>';
			$sql = mysql_query("SELECT SUM(notas_retirada_itens.quantidade) as quantidade_total, notas_retirada_itens.id_item FROM notas_retirada INNER JOIN notas_retirada_itens ON notas_retirada.id = notas_retirada_itens.id_retirada INNER JOIN notas_itens ON notas_itens.id = notas_retirada_itens.id_item WHERE notas_itens.categoria in(2,3) and notas_retirada.equipe IN($equ) AND (notas_retirada.data BETWEEN '$inicial' and '$final') GROUP BY notas_retirada_itens.id_item ORDER BY notas_retirada.data DESC");			
			while($l = mysql_fetch_array($sql)) {
				extract($l);
				$se += 1;
				echo '<tr>';	
				echo '<td class="text-center">'.$se.'</td>';	
				echo '<td class="text-center">'.$id_item.'</td>';	
				echo '<td>'.mysql_result(mysql_query("SELECT descricao FROM notas_itens WHERE id = '$id_item'"),0,"descricao").'</td>';
				echo '<td class="text-center">'.number_format($quantidade_total,"2").'</td>';
				$total_nf = mysql_result(mysql_query("select SUM(notas_itens_add.quantidade*notas_itens_add.valor) as totalSum FROM notas_nf, notas_itens_add WHERE notas_nf.id = notas_itens_add.nota AND notas_nf.obra in($oba) AND notas_itens_add.item = '$id_item'  ORDER BY notas_itens_add.id DESC LIMIT 1"),0,"totalSum");
				
				$qtd_nf = mysql_result(mysql_query("select SUM(notas_itens_add.quantidade) as totalSum FROM notas_nf, notas_itens_add WHERE notas_nf.id = notas_itens_add.nota AND notas_nf.obra in($oba) AND notas_itens_add.item = '$id_item'  ORDER BY notas_itens_add.id DESC LIMIT 1"),0,"totalSum");
				
				@$total_media = @$total_nf/@$qtd_nf;
				echo '<td class="text-center">R$ '.number_format($total_media,"2", ",", ".").'</td>';
				$total_retirada = $total_media * $quantidade_total;
				echo '<td class="text-center">R$ '.number_format($total_retirada,"2", ",", ".").'</td>';
				echo '</tr>';	
				$somaGeral += $total_retirada;
			}
			echo '</tbody>';
			echo '</table>';
			echo '<h1>Total Geral <small>R$ '.number_format($somaGeral,"2",",",".").'</small></h1>';
			exit;	
		}
	}
?>
	<div class="container-fluid hidden-print" style="padding:0px 0px 15px 0px; margin-bottom:20px; border-bottom:1px solid #CCC">
		<img src="../imagens/logo.png" class="img-responsive" width="50px" style="float:left; margin-right:20px"/>
		<h3 style="font-family: 'Oswald', sans-serif; letter-spacing:5px;"> 
			RELATÓRIO <small><b>MATERIAL POLÊMICA</b></small>
			<a href="javascript:window.print()" style="letter-spacing:8px; padding-left:40px; padding-right:40px;" class="hidden-xs hidden-print pull-right btn btn-warning btn-sm"> <span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir</a>
		</h3>
	</div>
	<div class="well well-sm hidden-print" style="padding:10px 10px 5px 10px;">
		<form id="form-box" action="javascript:void(0)" onSubmit="posti(this,'almoxarifado/relatorio-material-geral-epi.php?ac=listar','.resultado');" class="formulario-normal">
			<div class="container-fluid" style="padding:0px">
				<div class="col-xs-8" style="padding:0px">
					<div class="col-xs-3" style="padding:2px">
						<label style="width:100%"><small>Obra:</small><br/>
							<select name="ci[]" onChange="$('#item-consulta-obra').load('../functions/functions-load.php?atu=equipe&cidade=' + $(this).val() + '');" class="sel" required> 
								<option value="">Selecione uma obra</option>
								<?php
									$cidade = mysql_query("select * from notas_obras_cidade WHERE id IN(0,$cidade_usuario) order by nome asc");
									while($l = mysql_fetch_array($cidade)) {
										echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>';
									}
								?>	
							</select>
						</label>
					</div>
					<div class="col-xs-9" style="padding:0px">
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
							<input type="date" name="inicial" value="<?php echo $inicioMes; ?>" min="2017-04-01" max="<?php echo $todayTotal ?>" class="form-control input-sm" style="width:100%" />
						</label>
					</div>
					<div class="col-xs-6" style="padding:2px">
						<label style="width:100%"><small>ate:</small><br/>
							<input type="date" name="final" value="<?php echo $todayTotal; ?>" min="2017-04-01" max="<?php echo $todayTotal ?>" class="form-control input-sm" style="width:100%" />
						</label>
					</div>
				</div>
				<div class="col-xs-2" style="padding:2px">
					<label><small>Tipo de relatorio:</small>
						<select name="relatorio" class="form-control input-sm" style="width:100%" required>
							<option value="" selected disabled>Selecione o tipo de relatorio desejado</option>
							<option value="1">EQUIPE (POLEMICA) </option>
							<option value="3">MEMORIA DE CALCULO (POLEMICA) </option>
						</select>
					</label>
				</div>
				<div class="col-xs-2" style="padding:2px">
					<label><br/>
						<input type="submit" value="Pesquisar" style="width:120px; margin-left:5px" class="btn btn-success btn-sm">
					</label>
				</div>
			</div>	
		</form>
	</div>
	<div class="resultado"></div>