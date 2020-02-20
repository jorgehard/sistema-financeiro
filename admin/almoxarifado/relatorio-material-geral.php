<?php
include("../config.php");
include("../validar_session.php");
getData();
?>
<script type="text/javascript">
$(document).ready(function(){
	$("table").tablesorter();
	$(".decimal").maskMoney({precision:2});
	$('.sel').multiselect({
      buttonClass: 'btn btn-sm',
	  numberDisplayed: 1,
	  maxHeight: 200,
	  includeSelectAllOption: true,
	  selectAllText: "Selecionar todos",
	  enableFiltering: true,
	  enableCaseInsensitiveFiltering: true,
	  selectAllValue: 'multiselect-all'
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
				if($relatorio2 == '1' || $relatorio2 == '3') { ?>
					<label><small>Obra:</small><br/>
						<select name="ci[]" onChange="$('#itens').load('almoxarifado/relatorio-material-geral.php?atu=ac&tipo=2&cidade=' + $(this).val() + '');" style="width:250px;" class="sel" id="categ" required> 
							<option value="">Selecione uma obra</option>
							<?php
								$cidade = mysql_query("select * from notas_obras_cidade WHERE id IN(0,$cidade_usuario) order by nome asc");
								while($l = mysql_fetch_array($cidade)) {
									echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>';
								}
							?>	
						</select>
					</label>
					<label><small>Categoria:</small> <br/>
						<select name="cat[]" class="sel" multiple="multiple">
						<?php 
							$categorias = mysql_query("select * from notas_categorias order by descricao asc"); 
							while($l=mysql_fetch_array($categorias)) {
								echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>'; 
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
						<label for="">
							<small>Status:</small><br/>
							<select name="st[]" OnChange="$('#itens2').load('almoxarifado/relatorio-material-geral.php?atu=st2&tipo=2&status3=' + $(this).val() + '');" class="sel" multiple="multiple">
								<option value="0" selected>ATIVA</option>
								<option value="1" selected>INATIVA</option>
							</select>
						</label>
						<label id="itens2">
							<label for="">
								<small>Equipes:</small><br/>
									<select name="eq[]" class="sel" multiple="multiple" required>
									<?php
										$encarregados = mysql_query("select * from equipes WHERE obra IN(0,$cidade_usuario) order by nome asc");
										while($x = mysql_fetch_array($encarregados)) {
											echo '<option value="'.$x['id'].'">'.$x['nome'].'</option>';
										}
									?>		
								</select>
							</label>
						</label>
					</label>
			<?php }else if($relatorio2 == '4') { ?>
					<label><small>Obra:</small><br/>
						<select name="ci[]" onChange="$('#itens').load('almoxarifado/relatorio-material-geral.php?atu=ac&tipo=1&cidade=' + $(this).val() + '');" style="width:250px;" class="form-control input-sm" required> 
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
						<label for="">
							<small>Status:</small><br/>
							<select name="st[]" OnChange="$('#itens2').load('almoxarifado/relatorio-material-geral.php?atu=st2&tipo=1&status3=' + $(this).val() + '');" class="sel" multiple="multiple">
								<option value="0" selected>ATIVA</option>
								<option value="1" selected>INATIVA</option>
							</select>
						</label>
						<label id="itens2">
							<label for="">
								<small>Equipes:</small><br/>
									<select name="eq[]" class="sel">
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
	<?php	}else{ 	  ?>
					<label><small>Obra:</small><br/>
						<select name="ci[]" onChange="$('#itens').load('almoxarifado/relatorio-material-geral.php?atu=ac&tipo=2&cidade=' + $(this).val() + '');" style="width:250px;" class="sel" id="categ" required> 
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
						<label for="">
							<small>Status:</small><br/>
							<select name="st[]" OnChange="$('#itens2').load('almoxarifado/relatorio-material-geral.php?atu=st2&tipo=2&status3=' + $(this).val() + '');" class="sel" multiple="multiple">
								<option value="0" selected>ATIVA</option>
								<option value="1" selected>INATIVA</option>
							</select>
						</label>
						<label id="itens2">
							<label for="">
								<small>Equipes:</small><br/>
									<select name="eq[]" class="sel" multiple="multiple" required>
									<?php
										$encarregados = mysql_query("select * from equipes WHERE obra IN(0,$cidade_usuario) order by nome asc");
										while($x = mysql_fetch_array($encarregados)) {
											echo '<option value="'.$x['id'].'">'.$x['nome'].'</option>';
										}
									?>		
								</select>
							</label>
						</label>
					</label>
	<?php } exit; } ?>
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
		<label for="">
			<small>Status:</small><br/>
			<select name="st[]" OnChange="$(\'#itens2\').load(\'almoxarifado/relatorio-material-geral.php?atu=st2&cidade='.$cidade.'&tipo='.$tipo.'&status3=\' + $(this).val() + \'\');" class="sel" multiple="multiple">
				<option value="0" selected>ATIVA</option>
				<option value="1" selected>INATIVA</option>
			</select>
		</label>
		<label id="itens2">
			<label for="">
			<label><small>Equipes:</small><br/>';
			if($tipo=='1'){
				echo '<select name="eq[]" class="sel">';
			}else{
				echo '<select name="eq[]" class="sel" multiple="multiple">';
			}
				$equipe = mysql_query("select * from equipes WHERE obra IN($cidade) order by nome asc");
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
			if($tipo=='1'){
				echo '<select name="eq[]" class="sel">';
			}else{
				echo '<select name="eq[]" class="sel" multiple="multiple">';
			}
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
			foreach($cat as $cats) { @$catu .= $cats.','; } $catu = substr($catu,0,-1);
			foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1); 
			foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
			foreach($ci as $cis) { @$cia .= $cis.','; } $cia = substr($cia,0,-1);
			$inicial = implode("-",array_reverse(explode("/",$inicial))); 
			$final = implode("-",array_reverse(explode("/",$final)));
		 
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
						RELATÓRIO DE MATERIAL - POLÊMICA
					</h3>
					<p style="text-align:center;  font-size:14px;"><small>Período: '.implode("/",array_reverse(explode("-",$inicial))).' á '.implode("/",array_reverse(explode("-",$final))).'</small>';
					
					$obra_controle = mysql_query("SELECT * FROM equipes WHERE id IN($equ) ORDER BY nome LIMIT 1");
					while($c = mysql_fetch_array($obra_controle)){
						echo '<br/><span class="hidden-xs hidden-md hidden-lg visible-print"><b>'.$c['nome'].'</b></span><br/>';
					}
					
				echo '</p>
		
				</p>';
			echo '<table width="100%" class="table table-striped table-condensed table-bordered small">';
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

			$sql = mysql_query("SELECT notas_retirada.id as id_retirada, notas_retirada.funcionario, notas_retirada.equipe, notas_retirada.data, notas_retirada_itens.id_item, notas_retirada_itens.quantidade FROM notas_retirada INNER JOIN notas_retirada_itens ON notas_retirada.id = notas_retirada_itens.id_retirada INNER JOIN notas_itens ON notas_itens.id = notas_retirada_itens.id_item WHERE notas_itens.categoria IN($catu) and notas_retirada.equipe IN($equ) AND (notas_retirada.data BETWEEN '$inicial' and '$final') AND notas_retirada.obra IN($oba) ORDER BY notas_retirada.data DESC");				    
			while($l = mysql_fetch_array($sql)) { extract($l);
				$se += 1;
				echo '<tr class="small">';
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
				$soma3 += $total;
			}
			echo '</tbody></table>';
			echo '<tr>';
			echo '<h1>Total Geral <small>R$ '.number_format($soma3,"2",",",".").'</small></h1>';
			echo '</tr>';
			exit;		
		}	
		//  S A B E S P  -----------------------------------------------------------------------------------------------------------------
		if($relatorio==2) {
			foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1); 
			foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
			$data = implode("-",array_reverse(explode("/",$data)));
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
			echo '<tr> </tr>';
		
			echo '</table>';
			$ano = explode("-",$final);
			echo '
				<p>
					<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
						RELATORIO NOTA FISCAL - MATERIAL
					</h3>
					<p style="text-align:center;  font-size:14px;"><small>Período: '.implode("/",array_reverse(explode("-",$inicial))).' á '.implode("/",array_reverse(explode("-",$final))).'</small></p>
				</p>
				<p style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
					';
					$obra_controle = mysql_query("SELECT * FROM notas_obras WHERE id IN($oba)");
					while($c = mysql_fetch_array($obra_controle)){
						echo $c['descricao'].'<br/>';
					}
					echo '
				</p>
				<hr/>
			';		
			echo '<table class="table table-min table-striped small" id="myTable">';
			echo '<thead>
					<tr class="small">
						<th colspan="2" style="background:transparent; border-top:1px solid #fff; border-left:1px solid #fff"> </th>
						<th colspan="3" class="text-center">CONTROLE MATERIAL</th>
						<th colspan="1" style="background:transparent; border-top:1px solid #fff; border-right:1px solid #fff"> </th>
					</tr>
					<tr class="small">
						<th class="text-center">CODIGO</th>
						<th class="text-center">DESCRIÇÃO</th>
						<th class="text-center">RM</th>
						<th class="text-center">RETIRADA</th>
						<th class="text-center">SS</th>
						<th class="text-center">SALDO</th>
					</tr>
				  </thead>
				  <tbody>';

			$sql = mysql_query("SELECT codigo, id as id_item, descricao FROM ss_materiais");
			while($a = mysql_fetch_array($sql)) { extract($a);
				//RETIRADA
				$retirada = @mysql_result(@mysql_query("SELECT SUM(quantidade) as total FROM ss_retirada_sabesp INNER JOIN ss_retirada_itens ON ss_retirada_sabesp.id = ss_retirada_itens.id_retirada WHERE ss_retirada_itens.tipo = '1' AND ss_retirada_sabesp.equipe IN($equ) AND ss_retirada_sabesp.obra IN($oba) AND ss_retirada_itens.id_item = '$id_item' AND (ss_retirada_sabesp.data BETWEEN '$inicial' and '$final') GROUP BY ss_retirada_itens.id_item"),0,"total");
				
				//DEVOLUÇÃO
				$devolucao = @mysql_result(@mysql_query("SELECT SUM(quantidade) as total FROM ss_retirada_sabesp INNER JOIN ss_retirada_itens ON ss_retirada_sabesp.id = ss_retirada_itens.id_retirada WHERE ss_retirada_itens.tipo = '2' AND ss_retirada_sabesp.equipe IN($equ) AND ss_retirada_sabesp.obra IN($oba) AND ss_retirada_itens.id_item = '$id_item' AND (ss_retirada_sabesp.data BETWEEN '$inicial' and '$final') GROUP BY ss_retirada_itens.id_item"),0,"total");

				//SAIDA 
				$total_saida = @mysql_result(@mysql_query("SELECT SUM(qtd) as total FROM ss_principal INNER JOIN ss_ma ON ss_principal.id = ss_ma.cod_ss WHERE ss_principal.obra IN($oba) and ss_ma.equipe IN($equ) AND ss_ma.material = $id_item AND (ss_ma.data_uso BETWEEN '$inicial' and '$final') GROUP BY ss_ma.material"),0,"total");
				
				// RM
				$entrada_rm = @mysql_result(mysql_query("SELECT SUM(ss_rm_itens.qtd) as entrada FROM ss_rm INNER JOIN ss_rm_itens ON ss_rm.id = ss_rm_itens.cod_rm WHERE ss_rm.obra IN($oba) AND (ss_rm.data BETWEEN '$inicial' and '$final') AND ss_rm_itens.item = '$id_item' GROUP BY ss_rm_itens.item"),0,"entrada");
				
				$saldo_equipes = $retirada - $devolucao;
				$saldo_total = $saldo_equipes - $total_saida;
				$saldo_equipes_g += $saldo_equipes;
				$total_saida_g += $total_saida;
				$saldo_total_g += $saldo_total;
				$saldo_rm_g += $entrada_rm;
				if($saldo_equipes == '' && $saldo_total == '' && $saldototal2 == '' && $entrada_rm == ''){
					echo '<tr class="hidden">';	
				}else{
					echo '<tr class="small">';	
				}
				echo '<td class="text-center">'.$codigo.'</td>';	
				echo '<td>'.$descricao.'</td>';
				echo '<td class="text-center">'.number_format($entrada_rm,"2").'</td>';			
				echo '<td class="text-center">'.number_format($saldo_equipes,"2").'</td>';			
				echo '<td class="text-center">'.number_format($total_saida,"2").'</td>';			
				echo '<td class="text-center">'.number_format($saldo_total,"2").'</td>';
				echo '</tr>';	
			}
			echo '<tfoot>';
				echo '<tr>';
				echo '<th colspan="2"></th>';
				echo '<th class="text-center">'.number_format($saldo_rm_g,"2").'</th>';
				echo '<th class="text-center">'.number_format($saldo_equipes_g,"2").'</th>';
				echo '<th class="text-center">'.number_format($total_saida_g,"2").'</th>';
				echo '<th class="text-center">'.number_format($saldo_total_g,"2").'</th>';
				echo '</tr>';
			echo '</tfoot>';
			echo '</tbody>';
			echo '</table>';
			exit;	
		}
		// RELATORIO POLEMICA MEMORIA
		if($relatorio==3) {
			foreach($cat as $cats) { @$catu .= $cats.','; } $catu = substr($catu,0,-1);
			foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1); 
			foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
			$data = implode("-",array_reverse(explode("/",$data)));
			echo '<h5><small>Período: '.implode("/",array_reverse(explode("-",$inicial))).' á '.implode("/",array_reverse(explode("-",$final))).'</small></h5>';
			echo '<table class="table table-condensed table-bordered table-striped small" id="myTable">';
			echo '<thead>
					<tr class="small">
						<th class="text-center">Nº</th>
						<th class="text-center">ITEM</th>
						<th class="text-center">DESCRIÇÃO</th>
						<th class="text-center">ENTRADA</th>
						<th class="text-center">SAIDA</th>
						<th class="text-center">VLR UN</th>
						<th class="text-center">TOTAL</th>
					</tr>
				  </thead>
				  <tbody>';
			$sql = mysql_query("SELECT SUM(notas_retirada_itens.quantidade) as quantidade_total, notas_retirada_itens.id_item FROM notas_retirada INNER JOIN notas_retirada_itens ON notas_retirada.id = notas_retirada_itens.id_retirada INNER JOIN notas_itens ON notas_itens.id = notas_retirada_itens.id_item WHERE notas_itens.categoria IN($catu) and notas_retirada.equipe IN($equ) AND notas_retirada.obra IN($oba) AND (notas_retirada.data BETWEEN '$inicial' and '$final') GROUP BY notas_retirada_itens.id_item ORDER BY notas_retirada.data DESC");	
			while($l = mysql_fetch_array($sql)) {
				extract($l);
				$se += 1;
				echo '<tr class="small">';	
				echo '<td class="text-center">'.$se.'</td>';	
				echo '<td class="text-center">'.$id_item.'</td>';	
				echo '<td>'.mysql_result(mysql_query("SELECT descricao FROM notas_itens WHERE id = '$id_item'"),0,"descricao").'</td>';
				$total_nf = mysql_result(mysql_query("select SUM(notas_itens_add.quantidade*notas_itens_add.valor) as totalSum FROM notas_nf, notas_itens_add WHERE notas_nf.id = notas_itens_add.nota AND notas_nf.obra in($oba) AND notas_itens_add.item = '$id_item'  ORDER BY notas_itens_add.id DESC LIMIT 1"),0,"totalSum");
				
				$qtd_nf = mysql_result(mysql_query("select SUM(notas_itens_add.quantidade) as totalSum FROM notas_nf, notas_itens_add WHERE notas_nf.id = notas_itens_add.nota AND notas_nf.obra in($oba) AND notas_itens_add.item = '$id_item' ORDER BY notas_itens_add.id DESC LIMIT 1"),0,"totalSum");
				
				$qtd_nf_entrada = mysql_result(mysql_query("select SUM(notas_itens_add.quantidade) as totalSum FROM notas_nf, notas_itens_add WHERE notas_nf.id = notas_itens_add.nota AND notas_nf.obra in($oba) AND notas_itens_add.item = '$id_item' AND (notas_nf.dataxml BETWEEN '$inicial' and '$final') ORDER BY notas_itens_add.id DESC LIMIT 1"),0,"totalSum");
				
				@$total_media = @$total_nf/@$qtd_nf;
				
				echo '<td class="text-center">'.number_format($qtd_nf_entrada,"2").'</td>';
				echo '<td class="text-center">'.number_format($quantidade_total,"2").'</td>';
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
		// RELATORIO POLEMICA MEMORIA DATA REF
		if($relatorio==5) {
			foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1); 
			foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
			$data = implode("-",array_reverse(explode("/",$data)));
			echo '<h5><small>Período: '.implode("/",array_reverse(explode("-",$inicial))).' á '.implode("/",array_reverse(explode("-",$final))).'</small></h5>';
			echo '<table class="table table-condensed table-bordered table-striped small" id="myTable">';
			echo '<thead>
					<tr class="small">
						<th class="text-center">Nº</th>
						<th class="text-center">ITEMs</th>
						<th class="text-center">DESCRIÇÃO</th>
						<th class="text-center">RETIRADA</th>
						<th class="text-center">VLR UN</th>
						<th class="text-center">TOTAL</th>
					</tr>
				  </thead>
				  <tbody>';
			$sql = mysql_query("SELECT SUM(notas_retirada_itens.quantidade) as quantidade_total, notas_retirada_itens.id_item FROM notas_retirada INNER JOIN notas_retirada_itens ON notas_retirada.id = notas_retirada_itens.id_retirada WHERE notas_retirada.equipe IN($equ) AND (notas_retirada.data_ref BETWEEN '$inicial' and '$final') GROUP BY notas_retirada_itens.id_item ORDER BY notas_retirada.data DESC");
			while($l = mysql_fetch_array($sql)) {
				extract($l);
				$se += 1;
				echo '<tr class="small">';	
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
		// SABESP		
		if($relatorio==4) {
			foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1); 
			foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
			$data = implode("-",array_reverse(explode("/",$data)));
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
			echo '<tr> </tr>';
		
			echo '</table>';
			$ano = explode("-",$final);
			echo '
				<p>
					<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
						RELATORIO MATERIAL - SABESP
					</h3>
					<p style="text-align:center;  font-size:14px;"><small>Período: '.implode("/",array_reverse(explode("-",$inicial))).' á '.implode("/",array_reverse(explode("-",$final))).'</small></p>
				</p>
				<p style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
					';
					$obra_controle = mysql_query("SELECT * FROM equipes WHERE id IN($equ)");
					while($c = mysql_fetch_array($obra_controle)){	echo '<br/><b>'.$c['nome'].'</b><br/>'; }
					echo '
				</p>
				<hr/>
			';		
			echo '<table class="table table-min table-striped small" id="myTable">';
			echo '<thead>
					<tr class="small">
						<th colspan="2" style="background:transparent; border-top:1px solid #fff; border-left:1px solid #fff"> </th>
						<th colspan="3" class="text-center" style="border-left:1px solid #ccc">CONTROLE MATERIAL</th>
						<!--<th colspan="1" style="background:transparent; border-top:1px solid #fff; border-right:1px solid #fff"> </th>-->
					</tr>
					<tr class="small">
						<th class="text-center">CODIGO</th>
						<th class="text-center">DESCRIÇÃO</th>
						<!--<th class="text-center">RM</th>-->
						<th class="text-center">RETIRADA</th>
						<th class="text-center">SS</th>
						<th class="text-center">SALDO</th>
					</tr>
				  </thead>
				  <tbody>';

			$sql = mysql_query("SELECT codigo, id as id_item, descricao FROM ss_materiais");
			while($a = mysql_fetch_array($sql)) { extract($a);
				//RETIRADA
				$retirada = @mysql_result(@mysql_query("SELECT SUM(quantidade) as total FROM ss_retirada_sabesp INNER JOIN ss_retirada_itens ON ss_retirada_sabesp.id = ss_retirada_itens.id_retirada WHERE ss_retirada_itens.tipo = '1' AND ss_retirada_sabesp.equipe IN($equ) AND ss_retirada_sabesp.obra IN($oba) AND ss_retirada_itens.id_item = '$id_item' AND (ss_retirada_sabesp.data BETWEEN '$inicial' and '$final') GROUP BY ss_retirada_itens.id_item"),0,"total");
				
				//DEVOLUÇÃO
				$devolucao = @mysql_result(@mysql_query("SELECT SUM(quantidade) as total FROM ss_retirada_sabesp INNER JOIN ss_retirada_itens ON ss_retirada_sabesp.id = ss_retirada_itens.id_retirada WHERE ss_retirada_itens.tipo = '2' AND ss_retirada_sabesp.equipe IN($equ) AND ss_retirada_sabesp.obra IN($oba) AND ss_retirada_itens.id_item = '$id_item' AND (ss_retirada_sabesp.data BETWEEN '$inicial' and '$final') GROUP BY ss_retirada_itens.id_item"),0,"total");

				//SAIDA 
				$total_saida = @mysql_result(@mysql_query("SELECT SUM(qtd) as total FROM ss_principal INNER JOIN ss_ma ON ss_principal.id = ss_ma.cod_ss WHERE ss_ma.equipe IN($equ) AND ss_ma.material = $id_item AND (ss_ma.data_uso BETWEEN '$inicial' and '$final') GROUP BY ss_ma.material"),0,"total");
				
				// RM
				//$entrada_rm = @mysql_result(mysql_query("SELECT SUM(ss_rm_itens.qtd) as entrada FROM ss_rm INNER JOIN ss_rm_itens ON ss_rm.id = ss_rm_itens.cod_rm WHERE ss_rm.obra IN($oba) AND (ss_rm.data BETWEEN '$inicial' and '$final') AND ss_rm_itens.item = '$id_item' GROUP BY ss_rm_itens.item"),0,"entrada");
				
				$saldo_equipes = $retirada - $devolucao;
				$saldo_total = $saldo_equipes - $total_saida;
				$saldo_equipes_g += $saldo_equipes;
				$total_saida_g += $total_saida;
				$saldo_total_g += $saldo_total;
				//$saldo_rm_g += $entrada_rm;
				if($saldo_equipes == '' && $saldo_total == '' && $total_saida == ''){
					echo '<tr class="hidden">';	
				}else{
					echo '<tr class="small">';	
				}
				echo '<td class="text-center">'.$codigo.'</td>';	
				echo '<td>'.$descricao.'</td>';
				//echo '<td class="text-center">'.number_format($entrada_rm,"2").'</td>';			
				echo '<td class="text-center">'.number_format($saldo_equipes,"2").'</td>';			
				echo '<td class="text-center">'.number_format($total_saida,"2").'</td>';			
				echo '<td class="text-center">'.number_format($saldo_total,"2").'</td>';
				echo '</tr>';	
			}
			echo '<tfoot>';
				echo '<tr>';
				echo '<th colspan="2"></th>';
				//echo '<th class="text-center">'.number_format($saldo_rm_g,"2").'</th>';
				echo '<th class="text-center">'.number_format($saldo_equipes_g,"2").'</th>';
				echo '<th class="text-center">'.number_format($total_saida_g,"2").'</th>';
				echo '<th class="text-center">'.number_format($saldo_total_g,"2").'</th>';
				echo '</tr>';
			echo '</tfoot>';
			echo '</tbody>';
			echo '</table>';
			exit;	
		}
	}
?>
	<div style="clear: both;" class="hidden-print">
		<img class="logo-print hidden-print" src="http://polemicalitoral.com.br/guaruja/imagens/logo.png" style="float:left; position:relative; bottom:10px; margin-right:10px" width="50px"/>
		<div class="alert alert-warning text-center hidden-print" style="font-size:11px">
			<strong style="font-size:13px">Atenção!!!</strong><br/> Relatorio começou a ser controlado a partir de <b>01/04/2017</b>
		</div>
		<h3 style="font-family: 'Oswald', sans-serif; letter-spacing:5px; position:relative; top:10px;"> 
			<p>RELATORIO <small> MATERIAL </small></p>
		</h3>
		<a a href="javascript:window.print()" style="letter-spacing:5px; position:relative; bottom:10px;" class="hidden-xs hidden-print pull-right btn btn-warning btn-sm"> <span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir</a>
	</div>
	<div style="clear: both;" class="hidden-print">
		<hr></hr>
	</div>
	<div class="hidden-print">
		<div class="well well-sm" style="padding:5px 10px 0px 10px;">
			<form id="form-box" action="javascript:void(0)" onSubmit="posti(this,'almoxarifado/relatorio-material-geral.php?ac=listar','.resultado');">
				<label><small>Tipo de relatorio:</small>
					<select name="relatorio" class="form-control input-sm" OnChange="$('#itens-geral').load('almoxarifado/relatorio-material-geral.php?atu=select&relatorio2=' + $(this).val() + '');" style="width: 180px" required>
						<option value="" selected disabled>Selecione o tipo de relatorio desejado</option>
						<option value="1">EQUIPE (POLEMICA) </option>
						<option value="4">EQUIPE (SABESP) </option>
						<option value="2">MEMORIA DE CALCULO (SABESP) </option>
						<option value="3">MEMORIA DE CALCULO (POLEMICA) </option>
						<option value="5">DATA REF (POLEMICA) </option>
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
								<option value="1" selected>INATIVA</option>
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
				<label><small>De:</small><input type="date" name="inicial" value="<?php echo $inicioMes; ?>" min="2017-04-01" class="form-control input-sm" size="6" placeholder="Inicial" required /></label>
				<label><small>ate:</small><input type="date" name="final" value="<?php echo $todayTotal; ?>"  min="2017-04-01" class="form-control input-sm" size="6" placeholder="Final" required /></label>
				<input type="submit" style="margin-left:5px; width:150px;" value="Buscar" class="btn btn-success btn-sm" />
			</div>	
		</form>
	</div>
	<div class="resultado"></div>