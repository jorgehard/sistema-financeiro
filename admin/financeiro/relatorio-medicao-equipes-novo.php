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
if($atu=='select'){ 
	if($relatorio2 == '7') { ?>
			<div class="col-xs-6">
				<div class="col-xs-8" style="padding:0px">
					<div class="col-xs-6" style="padding:2px">
						<label style="width:100%"><small>Folha de Pagamento:</small><br/>
							<input type="date" name="inicial_folha" value="<?php echo $inicioMes; ?>" max="<?php echo $todayTotal ?>" class="form-control input-sm" style="width:100%" />
						</label>
					</div>
					<div class="col-xs-6" style="padding:2px">
						<label style="width:100%"><small></small><br/>
							<input type="date" name="final_folha" value="<?php echo $todayTotal; ?>" max="<?php echo $todayTotal ?>" class="form-control input-sm" style="width:100%" />
						</label>
					</div>
				</div>
				<div class="col-xs-4" style="padding:2px">
					<label style="width:100%"><small>Situação (RH):</small>
						<select name="st_rh[]" class="sel" multiple="multiple">
						<?php
							$stsrh = mysql_query("select * from rh_situacao order by descricao asc");
							while($l = mysql_fetch_array($stsrh)) { extract($l);
								echo '<option value="'.$id.'" selected>'.$descricao.'</option>';
							}
						?>
						</select>
					</label>
				</div>
			</div>
			<div class="col-xs-6">
				<div class="col-xs-8" style="padding:0px">
					<div class="col-xs-6" style="padding:2px">
						<label style="width:100%"><small>Período (Nota Fiscal):</small>
							<input type="date" name="inicial_despesas" value="<?php echo $inicioMes; ?>" max="<?php echo $todayTotal ?>" class="form-control input-sm" style="width:100%" />
						</label>
					</div>
					<div class="col-xs-6" style="padding:2px">
						<label style="width:100%"><small></small><br/>
							<input type="date" name="final_despesas" value="<?php echo $todayTotal; ?>" max="<?php echo $todayTotal ?>" class="form-control input-sm" style="width:100%" />
						</label>
					</div>
				</div>
				<div class="col-xs-4" style="padding:2px">
					<label style="width:100%"><small>Categoria (NF):</small>
						<select name="cat_n[]" class="form-control input-sm sel" multiple="multiple" style="width: 120px">
							<?php
							$medicao = mysql_query("select * from notas_categorias order by descricao asc ");
							while($l = mysql_fetch_array($medicao)) {
								echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>';
							}
							?>
						</select>
					</label>
				</div>
			</div>
			<div class="col-xs-6">
				<div class="col-xs-8" style="padding:0px">
					<div class="col-xs-6" style="padding:2px">
						<label style="width:100%"><small>Periodo (Almox):</small>
							<input type="date" name="inicial_almox" value="<?php echo $inicioMes; ?>" max="<?php echo $todayTotal ?>" class="form-control input-sm" style="width:100%" />
						</label>
					</div>
					<div class="col-xs-6" style="padding:2px">
						<label style="width:100%"><small></small><br/>
							<input type="date" name="final_almox" value="<?php echo $todayTotal; ?>" max="<?php echo $todayTotal ?>" class="form-control input-sm" style="width:100%" />
						</label>
					</div>
				</div>
				<div class="col-xs-4" style="padding:2px">
					<label style="width:100%"><small>Dias Uteis: </small>
						<input type="number" step="1" name="du" value="21" style="width:100%" class="form-control input-sm" />
					</label>
				</div>
			</div>
			<div class="col-xs-6">
				<div class="col-xs-6" style="padding:2px">
					<label style="width:100%"><small>Categoria:</small>
						<select name="cat[]" onChange="$('#itens_categoria').load('../functions/functions-load.php?atu=categoria&categoria=' + $(this).val() + '');" class="sel" multiple="multiple"> 
								<?php 
									$categorias = mysql_query("select * from notas_cat_e where oculto = '0' order by descricao asc");
									while($l = mysql_fetch_array($categorias)) {
										echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>'; 
									}
								?>		
						</select>
					</label>
				</div>
				<div class="col-xs-6" style="padding:2px">
					<div id="itens_categoria">
						<label style="width:100%"><small>Sub-Categoria:</small><br/>
							<select name="sbca[]" style="width:100%" class="sel" multiple="multiple">
								<?php 
									$sub_categorias = mysql_query("select * from notas_cat_sub order by descricao asc");
									while($l = mysql_fetch_array($sub_categorias)) {
										echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>'; 
									}
								?>		
							</select>
						</label>
					</div>
				</div>
			</div>
			<div class="col-xs-12" style="padding:0px">
				<div class="col-xs-6">
					<div class="col-xs-6" style="padding:2px">
						<label style="width:100%"><small>Valor a Somar: </small>
							<input type="number" step="0.01" name="valor_medicao2" placeholder="R$" class="form-control input-sm" style="width:100%" />
						</label>
					</div>
					<div class="col-xs-6" style="padding:2px">
						<label style="width:100%"><small>Observação:</small>
							<input type="text" placeholder="Contrato desejado" name="obs_medicao2" class="form-control input-sm" style="width:100%" />
						</label>
					</div>
				</div>
				<div class="col-xs-6">
					<div class="col-xs-4" style="padding:2px">
						<label style="width:100%"><small>Valor a Descontar </small>
							<input type="number" step="0.01" name="valor_descontar2" placeholder="R$" class="form-control input-sm" style="width:100%" />
						</label>
					</div>
					<div class="col-xs-4" style="padding:2px">
						<label style="width:100%"><small>Observação: </small>
							<input type="text" placeholder="Desconto referente" name="obs_descontar2" class="form-control input-sm" style="width:100%" />
						</label>
					</div>
					<div class="col-xs-4" style="padding:2px">
						<label style="width:100%"><small>Caução: </small>
							<select name="caucao_char" class="form-control input-sm" style="width:100%" required>
								<option value="0">NÃO</option>
								<option value="1" selected>SIM</option>
							</select>
						</label>
					</div>
				</div>
			</div>
<?php } else if($relatorio2 == '8'){ ?>

			<div class="col-xs-6" style="padding:0px">
				<div class="col-xs-6" style="padding:0px">
					<div class="col-xs-6" style="padding:2px">
						<label style="width:100%"><small>Folha de Pagamento:</small><br/>
							<input type="date" name="inicial_folha" value="<?php echo $inicioMes; ?>" max="<?php echo $todayTotal ?>" class="form-control input-sm" style="width:100%" />
						</label>
					</div>
					<div class="col-xs-6" style="padding:2px">
						<label style="width:100%"><small></small><br/>
							<input type="date" name="final_folha" value="<?php echo $todayTotal; ?>" max="<?php echo $todayTotal ?>" class="form-control input-sm" style="width:100%" />
						</label>
					</div>
				</div>
				<div class="col-xs-4" style="padding:2px">
					<label style="width:100%"><small>Situação (RH):</small>
						<select name="st_rh[]" class="sel" multiple="multiple">
						<?php
							$stsrh = mysql_query("select * from rh_situacao order by descricao asc");
							while($l = mysql_fetch_array($stsrh)) { extract($l);
								echo '<option value="'.$id.'" selected>'.$descricao.'</option>';
							}
						?>
						</select>
					</label>
				</div>
				<div class="col-xs-2" style="padding:2px">
					<label style="width:100%"><small>Dias Uteis: </small>
						<input type="number" step="1" name="du" value="21" style="width:100%" class="form-control input-sm" />
					</label>
				</div>
			</div>
<?php } exit; } ?>

<?php
	//MEMORIA DE CALCULO
	if($relatorio==1) {
		foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1); 
		foreach($st as $sts) { @$sta .= $sts.','; } $sta = substr($sta,0,-1); 
		foreach($md as $mds) { @$mda .= $mds.','; } $mda = substr($mda,0,-1);
		foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
		
		@$total_q = 0; @$total_g = 0; @$total_p = 0;
		
		echo '<center><img src="http://www.polemicalitoral.com.br/guaruja/imagens/logo.png" width="80px;" style="margin-right:40px;"><h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:4px; text-align:center; margin-bottom:20px;"><p>RELATORIO MEMORIA DE CALCULO</p><small> PERIODO DE '.implode("/",array_reverse(explode("-",$inicial))).' À '.implode("/",array_reverse(explode("-",$final))).'</small></h3></center>';		
		$equip = mysql_query("select * from equipes where id IN($equ)");
		echo '<center><b><small>Equipe(s):</small></b></center>';
		while($k = mysql_fetch_array($equip)){
			echo '<center><b>'.$k['nome'].'</b></center><br/>';
		}
		echo '<table class="table table-bordered table-condensed table-color" style="font-size:11px"><thead><tr><th>ITEM</th><th align="left">Serviço Executado</th><th style="text-align:center">UN</th><th style="text-align:center">Npreco</th><th style="text-align:center">QTD</th><th style="text-align:center">Preço</th><th style="text-align:center">Total</th></tr></thead><tbody>';
		
		$sql = mysql_query("select *, sum(ss_se.qtd) as qtd_total, ss_itens.unidade as unidade_se, ss_principal.id as id_ss from ss_se, ss_principal, ss_itens where ss_se.cod_ss = ss_principal.id and ss_se.servico = ss_itens.id AND ss_principal.situacao IN($sta) AND ss_principal.obra IN($oba) AND ss_se.equipe IN($equ) AND (ss_se.data between '$inicial' and '$final') AND ss_principal.medicao in($mda) GROUP BY ss_se.servico ORDER BY ss_itens.item asc");
		while($l = mysql_fetch_array($sql)) { extract($l);	
				$valor_metros = @mysql_result(mysql_query("select SUM(qtd*qtd2) AS total from ss_metro WHERE cod_ss = '$id_ss' ORDER BY id DESC LIMIT 1"),0,"total");
				$total_valor_metros += $valor_metros;		
			$id_producao = mysql_result(mysql_query("select * from ss_itens where id = $servico"),0,"producao");
			$preco_producao = @mysql_result(mysql_query("select * from sp where id = $id_producao"),0,"valor");
			$total_producao = $qtd_total*$preco_producao;
			$total = $qtd_total*mysql_result(mysql_query("select * from ss_itens where id = $servico"),0,"preco");
				
			$total = $total * ($porcentagem / 100);
			if(mysql_result(mysql_query("select * from ss_itens where id = $servico"),0,"preco")<>0) {	
				echo '<tr>';
				echo '<td>'.mysql_result(mysql_query("select * from ss_itens where id = $servico"),0,"item").'</td>';
				echo '<td align="left">'.mysql_result(mysql_query("select * from ss_itens where id = $servico"),0,"descricao").'</td>';
				echo '<td style="text-align:center">'.$unidade_se.'</td>';
				echo '<td style="text-align:center">'.$npreco.'</td>';
				echo '<td style="text-align:center">'.$qtd_total.'</td>';
				echo '<td style="text-align:center">R$ '.number_format((mysql_result(mysql_query("select * from ss_itens where id = $servico"),0,"preco")* ($porcentagem / 100)),"2",",",".").'</td>';
				echo '<td style="text-align:center">R$ '.number_format($total,"2",",",".").'</td>';
				echo '</tr>'; 
				@$total_q += $qtd_total;
				@$total_g += $total; 
				@$total_p += $total_producao; 	
			}
		}		
		echo '</tbody><tfoot><tr><th colspan="4" style="text-align:center">TOTAL</th><th style="text-align:center">'.number_format($total_q,"2").'</th><th></th><th style="text-align:center">R$ '.number_format($total_g,"2",",",".").'</th> </tr></tfoot></table>'; 
		@$total_geral_t += $total_g;
		echo '<h2 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px;">Total M²: <small>'.number_format($total_valor_metros,"2",",",".").'</small></h2>';
		exit;
	}
	//EQUIPES
	if($relatorio==2) {
		foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1); 
		foreach($st as $sts) { @$sta .= $sts.','; } $sta = substr($sta,0,-1); 
		foreach($md as $mds) { @$mda .= $mds.','; } $mda = substr($mda,0,-1);
		foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
		foreach($enc as $encs) { @$enca .= $encs.','; } $enca = substr($enca,0,-1);

		@$total_q = 0; @$total_ss = 0; @$total_g = 0; @$total_p = 0; @$total_meta = 0; @$total_saldo = 0; 
		
		echo '<center><img src="http://www.polemicalitoral.com.br/guaruja/imagens/logo.png" width="80px;" style="margin-right:40px;"><h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:4px; text-align:center; margin-bottom:20px;"><p>RELATORIO GERAL DE EQUIPES POR ENCARREGADOS</p><small> PERIODO DE '.implode("/",array_reverse(explode("-",$inicial))).' À '.implode("/",array_reverse(explode("-",$final))).'</small></h3></center>';	
		
		$ftes = mysql_query("select id as id_enca1, nome as nome_enc1 from encarregados WHERE id IN($enca) order by nome");
		while($z = mysql_fetch_array($ftes)) {
			extract($z);
			$sql = mysql_query("select equipes.nome, equipes.id as id_equipe, equipes.encarregado as enc_equipe, ss_se.equipe as se_equipe from equipes, ss_se, metas where ss_se.equipe = equipes.id AND equipes.categoria = metas.id AND ss_se.equipe in($equ) AND equipes.encarregado = '$id_enca1' and (ss_se.data between '$inicial' and '$final') group by ss_se.equipe order by metas.valor");

			@$total_mes_equipe_ss = '0';
			
			if(mysql_num_rows($sql) != 0){
				echo '<table class="table table-bordered table-condensed table-color" style="font-size:11px">';
			
				echo '<thead><tr class="active info"><th colspan="9">'.$nome_enc1.'</th></tr><tr><th colspan="2"></th><th colspan="2" style="text-align:center; font-size:13px">META</th><th colspan="5" style="text-align:center; font-size:13px">SITUAÇÃO REAL</th></tr><tr><th>Nº</th><th>EQUIPE</th><th style="text-align:center">META $</th><th style="text-align:center">META SS</th><th style="text-align:center">QTD SS</th><th style="text-align:center">PORC</th><th style="text-align:center">TOTAL MEDIÇÃO</th><th style="text-align:center">SALDO</th><th style="text-align:center">Total Produção</th></tr></thead><tbody>';

				while($l = mysql_fetch_array($sql)) {  
					extract($l); 
					$se += 1;
					@$q_total = 0; $v_total = 0; $v_total_p = 0; $qtd_ss = 0; @$meta_equipe_valor = 0; @$meta_ss_qtd = 0; @$meta_ss = 0; @$meta_equipe_qtd = 0;
					
					
					$total_mes_equipe_ss = mysql_num_rows(mysql_query("select * from ss_principal INNER JOIN ss_se ON ss_se.cod_ss = ss_principal.id INNER JOIN ss_itens ON ss_se.servico = ss_itens.id WHERE ss_itens.preco <> '0.00' AND ss_se.equipe = '$id_equipe' and ss_principal.situacao IN($sta) AND ss_principal.obra IN($oba) AND (ss_se.data between '$inicial' and '$final') group by ss_principal.id"));

					$meta_equipe = @mysql_result(mysql_query("select * from equipes where id = $id_equipe"),0,"categoria");
					
					$control_meta = mysql_result(mysql_query("select * from equipes where id = $id_equipe"),0,"controlmeta");
					
					if($control_meta == '1'){ 
						echo '<tr class="warning">'; 
					}else{ 
						echo '<tr>'; 
					}
					echo '<td width="10px">'.$se.'</td>';
					echo '<td width="300px">'.@mysql_result(mysql_query("select * from equipes where id = $id_equipe"),0,"nome").'</td>';
					
					
					$sql2 = mysql_query("select *, sum(ss_se.qtd) as qtd_total from ss_se, ss_principal where ss_se.cod_ss = ss_principal.id and ss_se.equipe = '$id_equipe' and ss_principal.situacao IN($sta) AND ss_principal.obra IN($oba) AND (ss_se.data between '$inicial' and '$final') group by ss_se.servico order by data asc");
					while($l = mysql_fetch_array($sql2)) { extract($l); 
						if(mysql_result(mysql_query("select * from ss_itens where id = $servico"),0,"preco")<>0) {
							$id_producao = @mysql_result(mysql_query("select * from ss_itens where id = $servico"),0,"producao");
							$preco_producao = @mysql_result(mysql_query("select * from sp where id = $id_producao"),0,"valor");
							$meta_equipe_valor = @mysql_result(mysql_query("select * from metas where id = $meta_equipe"),0,"valor");
							$meta_equipe_qtd = @mysql_result(mysql_query("select * from metas where id = $meta_equipe"),0,"quantidade");
							$meta_ss_qtd = @mysql_result(mysql_query("select * from metas where id = $meta_equipe"),0,"ss");
							$total_producao = $qtd_total*$preco_producao;
							@$total = $qtd_total*@mysql_result(mysql_query("select * from ss_itens where id = $servico"),0,"preco");
							$cav = @mysql_result(mysql_query("select * from equipes where id = $id_equipe"),0,"cav");
							if($cav=='0' AND $id_producao == 10) { 
								$total_producao = 0; 
							} else { 	
								$total_producao = $total_producao; 
							}	
								@$q_total += $qtd_total; 
								@$v_total += $total; 
								@$v_total_p += $total_producao;
						}
					}
					@$saldo = $v_total-$meta_equipe_valor; @$meta_ss = mysql_result(mysql_query("select * from metas where id = $meta_equipe"),0,"quantidade");
					$portc = 0; $portccem = 0;
					if($control_meta == '1'){
						@$portc = $total_mes_equipe_ss/$meta_ss_qtd; 
						@$portc = number_format($portc,2); 
						$valornovo = $portc * $meta_equipe_qtd; 
						$portccem = $portc * 100;
					}else{
						@$portc = @$v_total / @$meta_equipe_valor; 
						$valornovo = $portc * $meta_equipe_qtd; 
						$portccem = $portc * 100;
					}
					echo '<td width="80px" style="text-align:center">R$ '.@number_format($meta_equipe_valor,"2",",",".").'</td>';
					echo '<td width="80px" style="text-align:center">'.$meta_ss_qtd.'</td>'; 
					echo '<td width="80px" style="text-align:center">'.$total_mes_equipe_ss.'</td>'; 
					if($portccem >= 80){
						echo '<td width="20px" style="text-align:center" class="lg text-success"><b>'.@number_format($portccem,"0",",",".").' %</b></td>';
					} else {
						echo '<td width="20px" style="text-align:center" class="text-danger">'.@number_format($portccem,"0",",",".").' %</td>';
					}
					echo '<td width="80px" style="text-align:center">R$ '.@number_format($v_total,"2",",",".").'</td>';
					echo '<td width="80px" style="text-align:center">R$ '.@number_format($saldo,"2",",",".").'</td>';
					echo '<td width="50px" style="text-align:center">R$ '.@number_format($valornovo,"2",",",".").'</td>';
					echo '</tr>';
					@$total_q += $meta_equipe_qtd; 
					@$total_p += $v_total_p; 
					
					@$total_ss += $total_mes_equipe_ss; 
					@$total_ss2 += $total_mes_equipe_ss; 
					
					@$total_g += $v_total; 
					@$total_g2 += $v_total; 
					
					@$total_meta += $meta_equipe_valor; 
					@$total_meta2 += $meta_equipe_valor; 
					
					@$total_saldo += $saldo;
					@$total_saldo2 += $saldo;
				}
				$total_saldo_meta = $total_meta - $total_g;		
				echo '<tr class="active">
						<th width="250px" colspan="2" style="text-align:center">TOTAL</th>
						<th style="text-align:center">R$ '.number_format($total_meta2,"2",",",".").'</th>
						<th></th>
						<th style="text-align:center">'.number_format($total_ss2,"2").'</th>
						<th> </th>
						<th style="text-align:center">R$ '.number_format($total_g2,"2",",",".").'</th>
						<th style="text-align:center">R$ '.number_format($total_saldo2,"2",",",".").'</th>
						<th></th>
					</tr>';
				echo '</table><br/>'; 
			}
			
		$total_ss2 = 0;
		$total_g2 = 0; 
		$total_meta2 = 0; 
		$total_saldo2 = 0;
		}
		
		$total_saldo_meta = $total_meta - $total_g;	

		echo '<table class="table table-condensed table-striped table-min">
					<tr class="active">
						<th width="200px" colspan="2" style="text-align:center"><br/>TOTAL</th>
						<th style="text-align:center">META<br/> R$ '.number_format($total_meta,"2",",",".").'</th>
						<th width="80px"></th>
						<th style="text-align:center">SS<br/> '.number_format($total_ss,"2").'</th>
						<th width="50px"> </th>
						<th style="text-align:center">MEDIDO<br/> R$ '.number_format($total_g,"2",",",".").'</th>
						<th style="text-align:center">SALDO<br/> R$ '.number_format($total_saldo,"2",",",".").'</th>
						<th width="50px"> </th>
					</tr></table>'; 			
		exit; 
	}
	//SIMPLES
	if($relatorio==5){
		foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1); 
		foreach($st as $sts) { @$sta .= $sts.','; } $sta = substr($sta,0,-1); 
		foreach($md as $mds) { @$mda .= $mds.','; } $mda = substr($mda,0,-1);
		foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
		
		echo '<center><img src="http://www.polemicalitoral.com.br/guaruja/imagens/logo.png" width="80px;" style="margin-right:40px;"><h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:4px; text-align:center; margin-bottom:20px;"><p>RELATORIO DE MEDIÇÃO -  SIMPLES</p><small> PERIODO DE '.implode("/",array_reverse(explode("-",$inicial))).' À '.implode("/",array_reverse(explode("-",$final))).'</small></h3></center>';
		
		
		echo '<table class="table table-bordered table-condensed table-color" style="font-size:11px">';
						
		echo '<thead>
				<tr class="small">
					<th style="text-align:center"><span class="glyphicon glyphicon-eject"></span></th>
					<th style="text-align:center">UN</th>
					<th style="text-align:center">SS</th>
					<th style="text-align:center">ANO</th>
					<th style="text-align:center">ENDERECO</th>
					<th style="text-align:center">BAIRRO</th>
					<th style="text-align:center">EQUIPE</th>
					<th style="text-align:center">ETAPA</th>
					<th style="text-align:center"> EXEC.</th>
					<th style="text-align:center"> PROTOC.</th>
					<th style="text-align:center"> TOTAL</th>
					<th style="text-align:center">M ²</th>
					<th style="text-align:center" class="hidden-print"><span class="glyphicon glyphicon-pencil"></span></th>
				</tr>
			  </thead><tbody>';
		
		$ss_s = mysql_query("SELECT ss_principal.*, ss_se.cod_ss, ss_se.servico, ss_se.equipe as equipe_se, ss_se.data, SUM(ss_se.qtd * ss_itens.preco) as total_valor, SUM(ss_se.qtd) as qtd_total_se FROM ss_principal LEFT JOIN ss_se ON ss_principal.id = ss_se.cod_ss INNER JOIN ss_itens ON ss_se.servico = ss_itens.id WHERE ss_principal.situacao IN($sta) AND ss_principal.obra IN($oba) AND ss_principal.medicao in($mda) AND ss_se.equipe IN($equ) AND (ss_se.data between '$inicial' and '$final') GROUP BY ss_principal.id");
		
		
		while($l = mysql_fetch_array($ss_s)) { extract($l);
			if($total_valor <> 0) {
				$total_valor = $total_valor * ($porcentagem / 100);
				$se += 1;
				$data_protocolo = @mysql_result(mysql_query("select * from ss_protocolo_itens, ss_protocolo where ss_protocolo.id = ss_protocolo_itens.id_protocolo and ss_protocolo_itens.cod_ss = $cod_ss limit 1"),0,"data");
				$qtd_total_se_g += $qtd_total_se;
				echo '<tr>';
				echo '<td width="5px" style="text-align:center">'.$se.'</td>';
				echo '<td style="text-align:center">'.$unidade.'</td>';
				echo '<td style="text-align:center">'.$ss.'</td>';
				echo '<td style="text-align:center">'.$ano.'</td>';
				echo '<td style="padding-left:10px">'.$endereco.'</td>';
				echo '<td style="padding-left:10px">'.$bairro.'</td>';
				echo '<td style="padding-left:10px">'.@mysql_result(mysql_query("select * from equipes where id = $equipe_se"),0,"nome").'</td>';
				echo '<td  style="padding-left:10px">'.@mysql_result(mysql_query("select * from ss_etapas where id = $etapa"),0,"descricao").'</td>';
				echo '<td style="text-align:center">'.implode("/",array_reverse(explode("-",$data))).'</td>';
				echo '<td style="text-align:center">'.implode("/",array_reverse(explode("-",$data_protocolo))).'</td>';
				echo '<td style="text-align:center">R$ '.number_format($total_valor,2,",",".").'</td>';
				$valor_metros = @mysql_result(mysql_query("select SUM(qtd*qtd2) AS total from ss_metro WHERE cod_ss = '$id' ORDER BY id DESC LIMIT 1"),0,"total");
				$total_valor_metros += $valor_metros;
				echo '<td style="text-align:center">'.number_format($valor_metros,2,",",".").' m²</td>';
				echo '<td width="3%" class="hidden-print" style="text-align:center; padding:3px;" id="val'.$id.'">';
						if($editarss_usuario == '1' || $acesso_login == 'MASTER'){
								echo '<a href="#"  style="font-size:8px;" onclick=\'ldy("ss/editar-ss.php?codss='.$id.'",".resultado")\' class="btn btn-info btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>';
						}else{
							echo '<a href="#" onclick=\'ldy("ss/ver-ss.php?id='.$id_princ.'",".resultado")\' class="btn btn-info btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a>';
						}
						echo '</td>';									
				echo '</tr>';	
				$total_geral += $total_valor;
			}			
		}			
		echo '</tbody></table>
		<div class="ajax"></div>
		<div class="page-header">
			<h2 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px;">Total SS: <small>'.$se.'</small></h2>
			<h2 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px;">Total M²: <small>'.number_format($total_valor_metros,"2",",",".").'</small></h2>
			<h2 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px;">Total Serviços: <small>'.$qtd_total_se_g.'</small></h2>
			<h2 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px;">Total Geral <small>R$ '.number_format($total_geral,"2",",",".").'</small></h2>
		</div>';
		exit;	
	}


	//MEDIÇÃO
	if($relatorio==6) {
		foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1); 
		foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1); 
		foreach($st as $sts) { @$sta .= $sts.','; } $sta = substr($sta,0,-1); 
		foreach($md as $mds) { @$mda .= $mds.','; } $mda = substr($mda,0,-1);
		
		$inicial = implode("-",array_reverse(explode("/",$inicial))); 
		$final = implode("-",array_reverse(explode("/",$final))); 
		
		echo '<center><img src="http://www.polemicalitoral.com.br/guaruja/imagens/logo.png" width="80px;" style="margin-right:40px;"><h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:4px; text-align:center; margin-bottom:20px;"><p>RELATORIO POR MEDIÇÃO</p></h3></center>';
		echo '<p style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">';
					$obra_controle = mysql_query("SELECT * FROM notas_obras WHERE id IN($oba)");
					while($c = mysql_fetch_array($obra_controle)){
						echo $c['descricao'].'<br/>';
					}
		echo '</p>';
		
		echo '<table class="table table-bordered table-striped table-min" border="1" style="margin:0 auto; width:100%; margin-bottom:40px;"><thead>';
		echo '
			<tr>
				<th style="background:#fff; border-top:1px solid #fff; border-left:1px solid #fff"></th>
				
				<th colspan="3" style="text-align:center; border:none; border-right:10px solid #FFF; background:#bee5f7">DESPESAS</th>
				
				<th colspan="3" style="text-align:center; border:none; background:#bee5f7">INVESTIMENTO</th>
				
				<th style="background:#fff; border-top:1px solid #fff;">
				
				</th>
				<th colspan="2" style="text-align:center; border:none; border-right:10px solid #FFF; background:#bee5f7">FATURAMENTO</th>
				
				
				<th style="background:#fff; border-top:1px solid #fff; border-right:1px solid #fff">';
					if($acesso_login == 'MASTER' || $_SESSION['id_usuario_logado'] == '147'){
						echo '<a href="#" onclick=\'$("#myModal2").modal("show"); ldy("ss/editar-valor-medicao.php",".modal-body")\' class="btn btn-xs btn-info pull-right"><span class="glyphicon glyphicon-cog"></span> </a>';
					}
				echo '</th>
			</tr>';
		echo '
			<tr class="small info">
				<th style="text-align:center; border-bottom:none;">MEDIÇÃO</th>
				
				<th style="text-align:center; border-bottom:none;">SABESP</th>
				<th style="text-align:center; border-bottom:none;">POLÊMICA</th>
				<th style="text-align:center; border-bottom:none;">DIFERENÇA</th>
				
				<th style="text-align:center; border-bottom:none;">SABESP</th>
				<th style="text-align:center; border-bottom:none;">POLÊMICA</th>
				<th style="text-align:center; border-bottom:none;">DIFERENÇA</th>
				
				<th style="text-align:center; border-bottom:none;">TOTAL</th>
				<th style="text-align:center; border-bottom:none;">ENTRADA</th>
				<th style="text-align:center; border-bottom:none;">SAIDA</th>
				<th style="text-align:center; border-bottom:none;">TOTAL</th>
			</tr></thead><tbody>';
		foreach($md as $mds) {
			//INVESTIMENTO
			$jica1 = mysql_query("select *, sum(ss_se.qtd) as qtd_total from ss_se, ss_principal, ss_itens where ss_principal.situacao IN($sta) and ss_principal.obra IN($oba) and ss_se.equipe IN($equ) and (ss_se.data between '$inicial' and '$final') and ss_itens.frente = '1' and ss_se.cod_ss = ss_principal.id and ss_se.servico = ss_itens.id and ss_principal.medicao = '$mds' group by ss_se.servico"); 
			
			//DESPESAS
			$jica2 = mysql_query("select *, sum(ss_se.qtd) as qtd_total from ss_se, ss_principal, ss_itens where ss_principal.situacao IN($sta) and ss_principal.obra IN($oba) and ss_se.equipe IN($equ) and (ss_se.data between '$inicial' and '$final') and ss_itens.frente = '2' and ss_se.cod_ss = ss_principal.id and ss_se.servico = ss_itens.id and ss_principal.medicao = '$mds' group by ss_se.servico"); 
			
			$total_j_i = 0; $total_j_d = 0;
			while($c = mysql_fetch_array($jica1)) {
				$id_producao = mysql_result(mysql_query("select * from ss_itens where id = ".$c['servico'].""),0,"producao");
				$total = $c['qtd_total'] * (mysql_result(mysql_query("select * from ss_itens where id = ".$c['servico'].""),0,"preco"));
				$total_j_i += $total;
			}
			while($d = mysql_fetch_array($jica2)) {
				$id_producao = mysql_result(mysql_query("select * from ss_itens where id = ".$d['servico'].""),0,"producao");
				$total = $d['qtd_total'] * (mysql_result(mysql_query("select * from ss_itens where id = ".$d['servico'].""),0,"preco"));
				$total_j_d += $total;
			}
			//
			$valor_sabesp = mysql_query("SELECT valor_sabesp_d, valor_sabesp_i, SUM(valor_reajuste_i + valor_reajuste_d) as valor_reajuste, valor_despesas FROM ae_medicao WHERE medicao = '$mds' AND obra IN($oba)");
			$valor_sabesp_d = 0;
			$valor_sabesp_i = 0; 
			$valor_reajuste = 0;
			$valor_despesas = 0;
			while($h = mysql_fetch_array($valor_sabesp)){
				$valor_sabesp_d += $h['valor_sabesp_d'];
				$valor_sabesp_i += $h['valor_sabesp_i'];
				$valor_reajuste += $h['valor_reajuste'];
				$valor_despesas += $h['valor_despesas'];
			}
			
			$valor_dife_d = $valor_sabesp_d - $total_j_d;
			$valor_dife_i = $valor_sabesp_i - $total_j_i;
			
			$valor_total_sabesp_d += $valor_sabesp_d;
			$valor_total_dife_d += $valor_dife_d;
			$valor_total_j_d += $total_j_d;
			
			$valor_total_sabesp_i += $valor_sabesp_i;
			$valor_total_dife_i += $valor_dife_i;
			$valor_total_j_i += $total_j_i;
			
			$valor_total_di = $valor_dife_d + $valor_dife_i;
			$valor_total_di_g += $valor_total_di;
			
			$valor_reajuste_g += $valor_reajuste;
			$valor_despesas_g += $valor_despesas;
			echo '<tr>
						<td width="10%" style="text-align:center">'.($mds == 0 ? 'S/MED' : $mds).'</td>
						<td width="13%" style="text-align:center">'.number_format($valor_sabesp_d,"2",",",".").'</td>
						<td width="13%" style="text-align:center">'.number_format($total_j_d,"2",",",".").'</td>
						
						<td width="13%" style="text-align:center">'.number_format($valor_dife_d,"2",",",".").'</td>
						
						<td width="13%" style="text-align:center">'.number_format($valor_sabesp_i,"2",",",".").'</td>
						<td width="13%" style="text-align:center">'.number_format($total_j_i,"2",",",".").'</td>
						<td width="13%" style="text-align:center">'.number_format($valor_dife_i,"2",",",".").'</td>
						
						<td style="text-align:center">'.number_format($valor_total_di,"2",",",".").'</td></td>
						
						<td width="13%" style="text-align:center">'.number_format($valor_reajuste,"2",",",".").'</td>
						<td width="13%" style="text-align:center">'.number_format($valor_despesas,"2",",",".").'</td>
						<td width="13%" style="text-align:center">'.number_format(($valor_reajuste-$valor_despesas),"2",",",".").'</td>
						
						
						
						</tr>';
		}
		echo '
			<tr class="active">
				<td style="text-align:center">Total</td>
				<td style="text-align:center">R$ '.number_format($valor_total_sabesp_d,"2",",",".").'</td>
				<td style="text-align:center">R$ '.number_format($valor_total_j_d,"2",",",".").'</td>
				<td style="text-align:center">R$ '.number_format($valor_total_dife_d,"2",",",".").'</td>
				<td style="text-align:center">R$ '.number_format($valor_total_sabesp_i,"2",",",".").'</td>
				<td style="text-align:center">R$ '.number_format($valor_total_j_i,"2",",",".").'</td>
				<td style="text-align:center">R$ '.number_format($valor_total_dife_i,"2",",",".").'</td>
				<td style="text-align:center">R$ '.number_format($valor_total_di_g,"2",",",".").'</td>
				
				<td style="text-align:center">R$ '.number_format($valor_reajuste_g,"2",",",".").'</td>
				<td style="text-align:center">R$ '.number_format($valor_despesas_g,"2",",",".").'</td>
				<td style="text-align:center">R$ '.number_format($valor_reajuste_g-$valor_despesas_g,"2",",",".").'</td>
			</tr>';
		echo '</tbody></table>';
		exit;		
	}
	//MEDIÇÃO EMPREITEIRO
	if($relatorio==7) {
		foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1); 
		foreach($st as $sts) { @$sta .= $sts.','; } $sta = substr($sta,0,-1); 
		foreach($md as $mds) { @$mda .= $mds.','; } $mda = substr($mda,0,-1);
		foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
		foreach($ci as $cis) { @$cid .= $cis.','; } $cid = substr($cid,0,-1);
		if(is_array($cat) AND is_array($sbca)){
			foreach($cat as $cats){ @$cata .= $cats.','; } $cata = substr($cata,0,-1);
			foreach($sbca as $sbcas)  { @$sbcat .= $sbcas.',';   } $sbcat  = substr($sbcat,0,-1);
		}
		
		foreach($cat_n as $catns){ @$catno .= $catns.','; } $catno = substr($catno,0,-1);
		foreach($st_rh as $st_rhs) { @$strh2 .= $st_rhs.','; } $strh2 = substr($strh2,0,-1);
		
		topoPrint();
		$ano = explode("-",$todayTotal);
		
		echo '<table class="table table-bordered table-condensed table-color" style="font-size:11px">';
				$v_total = 0;
				$porcentagem = $porcentagem/100;
				$sql2 = mysql_query("select *, sum(ss_se.qtd) as qtd_total from ss_se, ss_principal where ss_se.cod_ss = ss_principal.id and ss_se.equipe IN($equ) and ss_principal.situacao IN($sta) AND ss_principal.obra IN($oba) AND (ss_se.data between '$inicial' and '$final') AND ss_principal.medicao in($mda) group by ss_se.servico order by data asc");
				while($l = mysql_fetch_array($sql2)) { extract($l); 
					@$total = $qtd_total*@mysql_result(mysql_query("select * from ss_itens where id = $servico"),0,"preco");
					@$v_total += $total; 
				}
				echo '<tr style="font-size:12px">
						<th colspan="3">
						<small>Nome: </small>';
						$equ_controle = mysql_query("SELECT * FROM equipes WHERE id IN($equ) LIMIT 3");
						while($c = mysql_fetch_array($equ_controle)){ 
							$empresa_lider = mysql_result(mysql_query("SELECT empresa_emp FROM rh_funcionarios WHERE id = '".$c['lider_geral']."' "),0,"empresa_emp"); 
							
							$nome_lider .= @mysql_result(mysql_query("SELECT nome FROM notas_empresas WHERE id = '".$empresa_lider."' "),0,"nome")." & "; 
							if((@mysql_result(mysql_query("select * from notas_empresas where id = '".$empresa_lider."'"),0,"tipo")) == "1"){
								$cnpj_lider .= @mysql_result(mysql_query("SELECT cnpj FROM notas_empresas WHERE id = '".$empresa_lider."' "),0,"cpf")." & "; 
							}else{
								$cnpj_lider .= @mysql_result(mysql_query("SELECT cnpj FROM notas_empresas WHERE id = '".$empresa_lider."' "),0,"cnpj")." & "; 
							}
							
							
							
							$obra_equipe = mysql_result(mysql_query("SELECT * FROM notas_obras_cidade WHERE id = '".$c['obra']."' "),0,"nome");
						} 
						echo substr($nome_lider,0,-3);
						echo '<br/> 
							<small>CNPJ / CPF: </small>';
						echo substr($cnpj_lider,0,-3);
							
						echo '<br/>
							<small>Obra: </small>'.$obra_equipe.'<br/>
							<small>Periodo:</small> '.implode("/",array_reverse(explode("-",$inicial))).' até '.implode("/",array_reverse(explode("-",$final))).'</th>
						</tr>';
				
				echo '
					<tr>
						<th colspan="3" style="text-align:center; padding:0px;">MEDIÇÃO</th>
					</tr>
					<tr style="font-size:10px">
						<th style="text-align:center">ITEM</th>
						<th>DESCRIÇÃO</th>
						<th style="text-align:center">TOTAL</th>
					</tr>';
				echo '<tr class="danger hidden-print">';
					echo '<td style="text-align:center"> - </td>';
					echo '<td> VALOR MEMORIA DE CALCULO <small class="text-danger">*** 100%</small></td>';
					echo '<td style="text-align:center">R$ '.@number_format($v_total,"2",",",".").'</td>';
				echo '</tr>';
				
				$se = 0;
				$se += 1;
				echo '<tr>';
					echo '<td style="text-align:center">1</td>';
					$oba_controle = mysql_query("SELECT * FROM notas_obras WHERE id IN($oba)");
					while($m = mysql_fetch_array($oba_controle)){ 
						$total_obras = $m['descricao'];
					} 
					echo '<td> VALOR MEMORIA DE CALCULO - '.$total_obras.'</td>';
					$v_total = $v_total*$porcentagem;
					echo '<td style="text-align:center">R$ '.@number_format($v_total,"2",",",".").'</td>';
				echo '</tr>';
				if($valor_medicao2 <> ''){
					echo '<tr>';
						echo '<td style="text-align:center">2</td>';
						echo '<td> VALOR MEMORIA DE CALCULO - '.$obs_medicao2.'</td>';
						echo '<td style="text-align:center">R$ '.@number_format($valor_medicao2,"2",",",".").'</td>';
					echo '</tr>';
				}
				
				$valor_soma_total = $v_total + $valor_medicao2;
				
				echo '<tr>';
					echo '<td colspan="2"><small class="pull-right" style="font-size:10px; padding:0px;"><b>TOTAL MEDIDO</b></small></td>';
					echo '<td style="text-align:center; padding:0px;"><small><b>R$ '.@number_format($valor_soma_total,"2",",",".").'</b></small></td>';
				echo '</tr>';
			if(($inicial_folha != '' AND $final_folha != '') OR ($inicial_despesas != '' AND $final_despesas != '') OR (is_array($cat) AND is_array($sbca)) OR ($inicial_almox != '' AND $final_almox != '') OR ($valor_descontar2 <> '')){
				echo '<tr>';
					echo '<td colspan="3"></td>';
				echo '</tr>';
				echo '<tr>';
					echo '<th colspan="3" style="text-align:center; padding:0px;">DESCONTO</th>';
				echo '</tr>';
				echo '<tr style="font-size:10px">';
						echo '<th style="text-align:center">ITEM</th>';
						echo '<th>DESCRIÇÃO</th>';
						echo '<th style="text-align:center">TOTAL</th>';
				echo '</tr>';
				$se = 0;
				if($inicial_folha != '' AND $final_folha != ''){
					$se += 1;
					echo '<tr>';
						echo '<td style="text-align:center">'.$se.'</td>';
						echo '<td>FOLHA DE PAGAMENTO VA / VR / VT &nbsp;&nbsp;&nbsp; <b> <small>'.implode("/",array_reverse(explode("-",$inicial_folha))).' ate '.implode("/",array_reverse(explode("-",$final_folha))).'</small></b></td>';
							
							$salario = mysql_query("SELECT *,(SELECT salario FROM rh_funcoes WHERE rh_funcoes.id = funcao) as salario FROM rh_funcionarios WHERE situacao IN($strh2) AND equipe IN($equ) AND (obra IN($oba) OR tipo_emp = '1') ORDER BY nome ASC");
							while($k = mysql_fetch_array($salario)){
								$dias_adicionais = mysql_result(mysql_query("select *, count(id) as total from rh_horaextra where (data between '$inicial_folha' and '$final_folha') and funcionario = '".$k['id']."' and porcentagem <> 0 and hora_extra <> '0.00' and beneficio = 1"),0,"total");
					
								$faltas = mysql_result(mysql_query("select *, count(id) as total from rh_horaextra where (data between '$inicial_folha' and '$final_folha') and funcionario = '".$k['id']."' and falta IN(1,2)"),0,"total");
								$dias_uteis = ($du+$dias_adicionais)-$faltas;
								$du_controle = $du - 3;
								$total_refeicao = $dias_uteis*$k['vale_refeicao'];
								if($dias_uteis >= $du_controle){
									$vale_alimentacao = $k['vale_alimentacao'];
								}else{
									$vale_alimentacao = '0';
								}
								$transporte1 = $dias_uteis*($k['vale_qtd']*2);
								$transporte2 = $dias_uteis*($k['vale_qtd2']*2);
								$transporte_total = $transporte1 + $transporte2;
								
								
								$salario_total += ($k['salario']+($k['salario']*0.8)) + $transporte_total + $total_refeicao + $vale_alimentacao;
							}
						echo '<td style="text-align:center">R$ '.@number_format($salario_total,"2",",",".").'</td>';
					echo '</tr>';
				}
				if($inicial_despesas != '' AND $final_despesas != ''){
					$se += 1;
					echo '<tr>';
						echo '<td style="text-align:center">'.$se.'</td>';
						echo '<td>NOTAS FISCAIS (RELATORIO EM ANEXO) &nbsp;&nbsp;&nbsp; <b><small>'.implode("/",array_reverse(explode("-",$inicial_despesas))).' ate '.implode("/",array_reverse(explode("-",$final_despesas))).'</small></b></td>';
						$total_notafiscal = mysql_result(mysql_query("SELECT SUM(notas_itens_add.quantidade*notas_itens_add.valor) AS totalSum, notas_itens_add.nota, notas_itens_add.item, notas_itens_add.categoria, notas_itens_add.quantidade, notas_itens_add.valor, notas_nf.recebimento FROM notas_nf, notas_itens_add WHERE notas_nf.id = notas_itens_add.nota AND notas_nf.obra IN($oba) AND (notas_nf.recebimento between '$inicial_despesas' and '$final_despesas') and notas_itens_add.equipe in($equ) AND notas_itens_add.categoria IN($catno)"),0,"totalSum");
						echo '<td style="text-align:center">R$ '.@number_format($total_notafiscal,"2",",",".").'</td>';
					echo '</tr>';
				}
				if($inicial_almox != '' AND $final_almox != ''){
					$se += 1;
					echo '<tr>';
						echo '<td style="text-align:center">'.$se.'</td>';
						echo '<td>MATERIAL RETIRADO ALMOXARIFADO &nbsp;&nbsp;&nbsp; <b><small>'.implode("/",array_reverse(explode("-",$inicial_almox))).' ate '.implode("/",array_reverse(explode("-",$final_almox))).'</small></b></td>';
						//RETIRADA
						$sql = mysql_query("SELECT notas_retirada.id as id_retirada, notas_retirada.funcionario, notas_retirada.equipe, notas_retirada.data, notas_retirada_itens.id_item, notas_retirada_itens.quantidade FROM notas_retirada INNER JOIN notas_retirada_itens ON notas_retirada.id = notas_retirada_itens.id_retirada WHERE notas_retirada.equipe IN($equ) AND notas_retirada.obra IN($oba) AND (notas_retirada.data BETWEEN '$inicial_almox' and '$final_almox') ORDER BY notas_retirada.data DESC");		
						$obra_geral = mysql_query("SELECT * FROM notas_obras WHERE cidade IN($cid)");
						while($xz = mysql_fetch_array($obra_geral)){ $obra_g .= $xz['id'].','; } $obra_g = substr($obra_g,0,-1);
						while($s = mysql_fetch_array($sql)) {
							$total_nf = mysql_result(mysql_query("select SUM(notas_itens_add.quantidade*notas_itens_add.valor) as totalSum FROM notas_nf, notas_itens_add WHERE notas_nf.id = notas_itens_add.nota AND notas_nf.obra in($obra_g) AND notas_itens_add.item = '$s[id_item]'  ORDER BY notas_itens_add.id DESC LIMIT 1"),0,"totalSum");
				
							$qtd_nf = mysql_result(mysql_query("select SUM(notas_itens_add.quantidade) as totalSum FROM notas_nf, notas_itens_add WHERE notas_nf.id = notas_itens_add.nota AND notas_nf.obra in($obra_g) AND notas_itens_add.item = '$s[id_item]'  ORDER BY notas_itens_add.id DESC LIMIT 1"),0,"totalSum");
				
				
							@$total_media = @$total_nf / @$qtd_nf;
							$total_retirada_geral += $total_media * $s['quantidade'];
						}
						echo '<td style="text-align:center">R$ '.@number_format($total_retirada_geral,"2",",",".").'</td>';
					echo '</tr>';
				}
				if(is_array($cat) AND is_array($sbca)){
					$se += 1;
					echo '<tr>';
							echo '<td style="text-align:center">'.$se.'</td>';
							echo '<td>EQUIPAMENTO &nbsp;&nbsp;&nbsp; <b><small>'.implode("/",array_reverse(explode("-",$inicial_despesas))).' ate '.implode("/",array_reverse(explode("-",$final_despesas))).'</small></b></td>';
							//RETIRADA
							$sql = mysql_query("SELECT * FROM notas_equipamentos WHERE equipe IN($equ) AND obra IN($oba) AND status_2 = '1' AND categoria IN($cata) AND sub_categoria IN($sbcat)");				    
							while($s = mysql_fetch_array($sql)) {
								$total_equipamento += $s['valor'];
							}
							echo '<td style="text-align:center">R$ '.@number_format($total_equipamento,"2",",",".").'</td>';
						echo '</tr>';
					echo '<tr>';
				}
				if($valor_descontar2 <> ''){
					echo '<tr>';
						echo '<td style="text-align:center">2</td>';
						echo '<td> DESCONTO REFERENTE:'.$obs_descontar2.'</td>';
						echo '<td style="text-align:center">R$ '.@number_format($valor_descontar2,"2",",",".").'</td>';
					echo '</tr>';
				}
				
				$total_descontos = $salario_total + $total_notafiscal + $total_retirada_geral + $total_equipamento + $valor_descontar2;
				
				echo '<td colspan="2"><small class="pull-right" style="font-size:10px; padding:0px;"><b>TOTAL DESCONTOS</b></small></td>';
				echo '<td style="text-align:center; padding:0px;"><small><b>R$ '.@number_format($total_descontos,"2",",",".").'</b></small></td>';
				echo '</tr>';
			}
				echo '<tr>';
					echo '<td colspan="3"></td>';
				echo '</tr>';
			if($caucao_char == '1'){
				echo '<tr>';
					echo '<th colspan="3" style="text-align:center; padding:0px;">RETENÇÃO CAUÇÃO </th>';
				echo '</tr>';
				echo '<tr style="font-size:10px">';
						echo '<th style="text-align:center">ITEM</th>';
						echo '<th>DESCRIÇÃO</th>';
						echo '<th style="text-align:center">TOTAL</th>';
				echo '</tr>';
				echo '<tr>';
					$valor_calcao = $v_total*0.05;
					$se += 1;
					echo '<td style="text-align:center">1</td>';
					echo '<td>CALÇÃO - 5%</td>';
					echo '<td style="text-align:center">R$ '.@number_format($valor_calcao,"2",",",".").'</td>';
				echo '</tr>';
			}else{
				$valor_calcao = 0;
			}
				echo '<tr>';
					echo '<td colspan="3"></td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td colspan="2"><small class="pull-right" style="font-size:12px; padding:0px;"><b>VALOR TOTAL A RECEBER</b></small></td>';
					echo '<td style="text-align:center; padding:0px;"><small><b>R$ '.@number_format($valor_soma_total-($total_descontos+$valor_calcao),"2",",",".").'</b></small></td>';
				echo '</tr>';
				echo '<tr>';
				echo '<td colspan="3" style="padding-top:30px; padding-bottom:20px;" class="hidden-xs hidden-md hidden-lg visible-print">';
					echo '<div class="col-xs-6">';
						$nome_lider_contrato = mysql_result(mysql_query("SELECT (select nome from rh_funcionarios where id = lider) as nome FROM notas_obras WHERE id IN($oba)"),0,"nome"); 
						
						$rg_lider_contrato = mysql_result(mysql_query("SELECT (select rg from rh_funcionarios where id = lider) as rg FROM notas_obras WHERE id IN($oba)"),0,"rg"); 
						echo $today["mday"].' DE '.$mes_nome.' DE '.$today["year"];
						echo '<br/>';
						echo '<br/>';
						echo '<br/>';
						echo '<br/>';
						echo '__________________________________<br/>'.$nome_lider_contrato.'<br/>RG '.$rg_lider_contrato.'<br/>PREPOSTO';
						//echo '__________________________________<br/>PATRICIA DE LIMA<br/>RG: 47.657.077-3<br/>';
					echo '</div>';
					echo '<div class="col-xs-6">';
						echo '<br/>';
						echo '<br/>';
						echo '<br/>';
						echo '<br/>';
						echo '__________________________________<br/>'.substr($nome_lider,0,-3);
					echo '</div>';
				echo '</td>';
				echo '</tr>';
		echo '</table>'; 
		
		
		
		echo '<table class="table table-bordered table-condensed table-color" style="font-size:11px">';
			
			echo '<tr>';
				echo '<th colspan="3" style="text-align:center; padding:0px;">VALORES DE RETENÇÕES ACUMULADO</th>';
			echo '</tr>';
			echo '<tr style="font-size:10px;">';
				echo '<th style="text-align:center; padding:0px;">ITEM</th>';
				echo '<th style="padding:0px 0px 0px 10px">MÊS DE REFERÊNCIA</th>';
				echo '<th style="text-align:center; padding:0px;">VALOR RETENÇÃO</th>';
			echo '</tr>';
			//--------------------------------
			$retencao = mysql_query("SELECT data, SUM(medicao) as medicao, SUM(retencao) as retencao FROM ae_empreiteiro WHERE contrato IN($oba) and equipe IN($equ) GROUP BY data");
			
			$se = 0;
			while($d = mysql_fetch_array($retencao)){
				$se += 1;
				echo '<tr style="font-size:12px;">';
					echo '<td style="text-align:center; padding:0px;">'.$se.'</td>';
					echo '<td style="padding:0px 0px 0px 10px">'.implode("/",array_reverse(explode("-",$d['data']))).'</td>';
					echo '<td style="text-align:center; padding:0px;">'.number_format($d['retencao'],2,",",".").'</td>';
				echo '</tr>';	
				$total_retencao += $d['retencao'];
			}
			echo '<tr>';
				echo '<td colspan="3"></td>';
			echo '</tr>';
			echo '<tr class="active">';
				echo '<td colspan="2" style="text-align:center; padding:0px; font-size:12px;"><b>VALOR TOTAL RETENÇÃO</b></td>';
				echo '<td style="text-align:center; padding:0px; font-size:12px;"><b>R$ '.number_format($total_retencao,2,",",".").'</b></td>';
			echo '</tr>';
		echo '</table><br/>'; 
		exit; 
	}
	//RESUMO FECHAMENTO EMPREITEIRO
	if($relatorio==9) {
		foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1); 
		foreach($st as $sts) { @$sta .= $sts.','; } $sta = substr($sta,0,-1); 
		foreach($md as $mds) { @$mda .= $mds.','; } $mda = substr($mda,0,-1);
		foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
		foreach($ci as $cis) { @$cid .= $cis.','; } $cid = substr($cid,0,-1);
		topoPrint();
		if($acesso_login == 'MASTER'){
			echo '<a href="#" onclick=\'$("#myModal2").modal("show"); ldy("financeiro/editar-valor-emp.php",".modal-body")\' class="btn btn-sm btn-info pull-right hidden-print" style="letter-spacing:5px; position:relative; bottom:10px; margin-bottom:10px"><span class="glyphicon glyphicon-cog"></span> <b>Lançamento</b></a>';
		}
		echo '<small>Periodo de '.implode("/",array_reverse(explode("-",$inicial))).' À '.implode("/",array_reverse(explode("-",$final))).'</small>';
		echo '<table class="table table-bordered table-condensed table-color" style="font-size:10px">';
		echo '<thead>';
		echo '<tr>';
			echo '<th style="text-align:center">Nº</th>';
			echo '<th style="text-align:center">EQUIPE</th>';
			echo '<th style="text-align:center">EMPRESA/LIDER</th>';
			echo '<th style="text-align:center">EXECUTADO <BR/> ATUALIZADO</th>';
			//echo '<th style="text-align:center">PAGO</th>';
			echo '<th style="text-align:center">ACUMULADO<BR/>MEDIDO</th>';
			echo '<th style="text-align:center">DIFERENÇA</th>';
			echo '<th style="text-align:center">DESCONTOS</th>';
			echo '<th style="text-align:center">LIQUIDO </th>';
			echo '<th style="text-align:center">TOTAL</th>';
			//echo '<th style="text-align:center">RETENÇÃO (5%)</th>';
			
			echo '<th style="text-align:center">LUCRO (%)</th>'; 
			echo '<th style="text-align:center">RETENÇÃO ACUMULADA </th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
		$inicial_b =  substr($inicial,0,-3);
		$final_b =  substr($final,0,-3);
		$equ_controle = mysql_query("SELECT * FROM equipes WHERE equipes.id IN($equ)");
		while($c = mysql_fetch_array($equ_controle)){ 
			echo '<tr>';
			$emp = mysql_query("SELECT * FROM ae_empreiteiro WHERE contrato IN($oba) AND equipe = '$c[id]' AND (ae_empreiteiro.data BETWEEN '$inicial_b' AND '$final_b')");
			
			$medicao = 0; $valor_pagar = 0; $valor_retencao_pagar = 0; $descontos = 0; $porcentagem = 0; $liquido = 0;
			while($xl = mysql_fetch_array($emp)){
				
				$medicao += $xl['medicao'];
				$valor_pagar += $xl['valor_pagar'];
				$liquido += $xl['liquido'];
				$valor_retencao_pagar += $xl['retencao'];
				$descontos += $xl['descontos'];
			}
			$retencao_acumulada = @mysql_result(mysql_query("SELECT SUM(retencao) as retencao FROM ae_empreiteiro WHERE contrato IN($oba) and equipe = '$c[id]' ORDER BY id"),0,"retencao");
			
			$medicao_acumulada = @mysql_result(mysql_query("SELECT SUM(medicao) as medicao FROM ae_empreiteiro WHERE contrato IN($oba) and equipe = '$c[id]' and (data BETWEEN '$inicial_b' and '$final_b') ORDER BY id"),0,"medicao");
			
			$executado_acumulada = @mysql_result(mysql_query("select sum(ss_se.qtd * (select preco from ss_itens where id = ss_se.servico)) as total_sum FROM ss_principal INNER JOIN ss_se ON ss_principal.id = ss_se.cod_ss WHERE ss_principal.situacao IN($sta) AND ss_principal.obra IN($oba) AND ss_se.equipe = '$c[id]' AND (ss_se.data between '$inicial' and '$final')"),0,"total_sum");
			
			$medicao_tot += $medicao;
			$valor_pagar_tot += $valor_pagar;
			$liquido_tot += $liquido;
			$descontos_tot += $descontos;
			$valor_retencao_pagar_tot += $valor_retencao_pagar;
			$retencao_acumulada_tot += $retencao_acumulada;
			$executado_acumulada_tot += $executado_acumulada;
			$medicao_acumulada_tot += $medicao_acumulada;
			
			$SE += 1;
			@$porcentagem = (($executado_acumulada / $medicao_acumulada) - 1) * 100;
			echo '<td>'.$SE.'</td>';
			echo '<td>'.$c['nome'].'</td>';
			echo '<td>'.@mysql_result(mysql_query("select * from rh_funcionarios where id = $c[lider_geral]"),0,"nome").'</td>';
			echo '<td style="text-align:right">'.number_format($executado_acumulada,2,",",".").'</p></td>';
			echo '<td style="text-align:right">'.number_format($medicao_acumulada,2,",",".").'</p></td>';
			echo '<td style="text-align:right">'.number_format($executado_acumulada - $medicao_acumulada,2,",",".").'</td>';
			$valor_saldo = ($executado_acumulada - $medicao_acumulada) + $valor_pagar;
			$valor_saldo_g += $valor_saldo;
			echo '<td style="text-align:right">'.number_format($descontos,2,",",".").'</td>';
			echo '<td style="text-align:right">'.number_format($liquido,2,",",".").'</td>';
			echo '<td style="text-align:right">'.number_format($valor_saldo,2,",",".").'</td>';
			//echo '<td style="text-align:right">'.number_format($valor_retencao_pagar,2,",",".").'</td>';
			
			echo '<td style="text-align:right">'.number_format($porcentagem,0).'% </td>';
			echo '<td style="text-align:right">'.number_format($retencao_acumulada,2,",",".").'</td>';
			
			echo '</tr>';
			
		} 
		@$porcentagem_total = (($executado_acumulada_tot / $medicao_acumulada_tot)-1) * 100;
		echo '</tbody>';
		echo '<tfoot>';
		echo '<tr class="active" style="font-size:12px">';
			echo '<td colspan="3" style="text-align:center"><b>SOMA TOTAL</b></td>';
			echo '<td style="text-align:right"><b>'.number_format($executado_acumulada_tot,2,",",".").'</b></td>';
			echo '<td style="text-align:right"><b>'.number_format($medicao_acumulada_tot,2,",",".").'</b></td>';
			echo '<td style="text-align:right"><b>'.number_format($executado_acumulada_tot - $medicao_acumulada_tot,2,",",".").'</b></td>';
			echo '<td style="text-align:right"><b>'.number_format($descontos_tot,2,",",".").'</b></td>';
			echo '<td style="text-align:right"><b>'.number_format($liquido_tot,2,",",".").'</b></td>';
			echo '<td style="text-align:right"><b>'.number_format($valor_saldo_g,2,",",".").'</b></td>';
			//echo '<td style="text-align:right"><b>'.number_format($valor_retencao_pagar_tot,2,",",".").'</b></td>';
			echo '<td style="text-align:center"><b>'.number_format($porcentagem_total,0).'% </b></td>';
			echo '<td style="text-align:right"><b>'.number_format($retencao_acumulada_tot,2,",",".").'</b></td>';
			
		
		echo '</tr>';
		echo '</tfoot>';
		echo '</table>';
		echo "<b>".ucfirst(mb_convert_encoding(strftime( '%d de %B de %Y', strtotime($todayTotal)), "UTF-8"))."</b>";
		exit; 
	}
	//FUNCIONARIO
	if($relatorio==8) {
		foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);
		foreach($eq as $eqs) { @$equ .= $eqs.','; } $equ = substr($equ,0,-1);
		foreach($st_rh as $st_rhs) { @$strh2 .= $st_rhs.','; } $strh2 = substr($strh2,0,-1);
		if($inicial == '' || $final == ''){ 
			echo '<span class="text-danger">Periodo, obrigatorio</span>';
			exit;
		}
		topoPrint();
		$ano = explode("-",$final);
		echo '
		<p>
			<h3 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">
				RELATÓRIO DETALHADO DE EQUIPE 
			</h3>
			<p style="text-align:center;  font-size:14px;"><small>Período: '.implode("/",array_reverse(explode("-",$inicial))).' á '.implode("/",array_reverse(explode("-",$final))).'</small></p>
		</p>
		<p style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; text-align:center;">';
		$obra_controle = mysql_query("SELECT * FROM equipes WHERE id IN($equ)");
		while($c = mysql_fetch_array($obra_controle)){	echo $c['nome'].'<br/>'; }
		echo '
		</p>';
		echo '<table class="table table-bordered table-condensed table-color" style="font-size:11px">';
		$eqpquery = mysql_query("SELECT * FROM equipes WHERE id IN($equ) ORDER BY nome ASC");
		while($b = mysql_fetch_array($eqpquery)){
				echo '<tr class="small info">';
				echo '<th>Nº</th>
						<th>'.$b['nome'].' &nbsp; / &nbsp; <small>ID: '.$b['id'].'</small></th>
						<th width="10px">OBRA</th>
						<th width="10px">SALARIO</th>
						<th width="10px">ENCARGO</th>
						<th width="10px">VR</th>
						<th width="10px">VA</th>
						<th width="10px">VT</th>
						
						<th width="10px">TOTAL</th>
					</tr>';
				$sql = mysql_query("SELECT *, (SELECT salario FROM rh_funcoes WHERE rh_funcoes.id = rh_funcionarios.funcao) as salario FROM rh_funcionarios WHERE situacao IN(6,10) AND equipe = ".$b['id']." AND (obra IN($oba) OR tipo_emp = '1') ORDER BY nome ASC");
				$salario_total = 0;
				while($c = mysql_fetch_array($sql)) {
					$se2 += 1;
					// =============================
					if(isset($c['lider_geral'])){
						echo '<tr class="text-danger">';
					}else{
						echo '<tr>';
					}
					echo '<td width="3%">'.$se2.'</td>';
					echo '<td width="25%">'.$c['nome'].'</td>';
					echo '<td width="15%">'.mysql_result(mysql_query("SELECT * FROM notas_obras WHERE id = '$c[obra]' "),0,"descricao").'</td>';	
					echo '<td width="10%">R$'.@number_format($c['salario'],"2",",",".").'</td>';
					echo '<td width="10%">R$'.@number_format($c['salario']*0.8,"2",",",".").'</td>';

					$dias_adicionais = mysql_result(mysql_query("select *, count(id) as total from rh_horaextra where (data between '$inicial_folha' and '$final_folha') and funcionario = '".$c['id']."' and porcentagem <> 0 and hora_extra <> '0.00' and beneficio = 1"),0,"total");
					
					$faltas = mysql_result(mysql_query("select *, count(id) as total from rh_horaextra where (data between '$inicial_folha' and '$final_folha') and funcionario = '".$c['id']."' and falta IN(1,2)"),0,"total");
					$dias_uteis = ($du+$dias_adicionais)-$faltas;
					$du_controle = $du - 3;
					$total_refeicao = $dias_uteis*$c['vale_refeicao'];
					if($dias_uteis >= $du_controle){
						$vale_alimentacao = $c['vale_alimentacao'];
					}else{
						$vale_alimentacao = '0';
					}
					$transporte1 = $dias_uteis*($c['vale_qtd']*2);
					$transporte2 = $dias_uteis*($c['vale_qtd2']*2);
					$transporte_total = $transporte1 + $transporte2;
					echo '<td width="10%">R$'.@number_format($total_refeicao,"2",",",".").'</td>';
					echo '<td width="10%">R$'.@number_format($vale_alimentacao,"2",",",".").'</td>';
					echo '<td width="10%">R$'.@number_format($transporte_total,"2",",",".").'</td>';
					
					$salario_total += ($c['salario']+($c['salario']*0.8)) + $transporte_total + $total_refeicao + $vale_alimentacao;

					echo '<td width="10%">R$'.@number_format($salario_total,"2",",",".").'</td>';
					
					$total_geral += $salario_total;
					$salario_total = 0;	
					echo '</tr>'; 

				}
			}
		echo '</table>';
		
		echo '<h3 style="font-family: \'Oswald\', sans-serif;letter-spacing:8px;" class="pull-right">TOTAL: <small>R$'.@number_format($total_geral,"2",",",".").'</small></h3>';
		exit;
	}
?>
	<div class="container-fluid hidden-print" style="padding:0px 0px 15px 0px; margin-bottom:20px; border-bottom:1px solid #CCC">
		<img src="../imagens/logo.png" class="img-responsive" width="50px" style="float:left; margin-right:20px"/>
		<h3 style="font-family: 'Oswald', sans-serif; letter-spacing:5px;"> 
			RELATÓRIO <small><b>MEDIÇÃO EMPREITEIRO</b></small>
			<a href="javascript:window.print()" style="letter-spacing:8px; padding-left:40px; padding-right:40px;" class="hidden-xs hidden-print pull-right btn btn-warning btn-sm"> <span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir</a>
		</h3>
	</div>
	<div class="well well-sm hidden-print" style="padding:10px 10px 5px 10px;">
		<form action="javascript:void(0)" onSubmit="posti(this,'financeiro/relatorio-medicao-equipes-novo.php?ac=listar&cidade=<?php echo $cidade ?>','.resultado');" class="formulario-normal">
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
						<select name="st[]" class="sel" multiple="multiple">
						<?php
							$sts = mysql_query("select * from ss_situacao WHERE id NOT IN(29, 9, 27, 26, 7, 8, 28) order by descricao asc");
							while($l = mysql_fetch_array($sts)) { extract($l);
								echo '<option value="'.$id.'" selected>'.$descricao.'</option>';
							}
						?>
						</select>
					</label>
				</div>
				<div class="col-xs-2" style="padding:2px">
					<label style="width:100%">
						<small>Medição:</small>
						<select name="md[]" class="form-control input-sm sel" multiple="multiple" style="width: 120px">
							<option value="0" selected>S/MED</option>
							<?php
							$medicao = mysql_query("select * from ae_medicao GROUP BY medicao order by medicao asc ");
							while($l = mysql_fetch_array($medicao)) {
								echo '<option value="'.$l['medicao'].'" selected>'.$l['medicao'].'</option>';
							}
							?>
							<option value="99" selected>99</option>
						</select>
					</label>
				</div>
				<div class="col-xs-3" style="padding:2px">
					<label style="width:100%"><small>Tipo:</small>
						<select name="relatorio" class="form-control input-sm" OnChange="$('#itens-geral').load('financeiro/relatorio-medicao-equipes-novo.php?atu=select&relatorio2=' + $(this).val() + '');" style="width:100%" required>
							<option value="" disabled selected>Selecione o tipo de Relatório</option>
							<option value="7">EMPREITEIRO (SIMPLES)</option>
							<option value="9">RESUMO FECHAMENTO (EMP)</option>
							<option value="1">MEMÓRIA DE CALCULO</option>
							<option value="5">SIMPLES</option>
							<option value="2">EQUIPES</option>
							<option value="8">DESCONTOS FUNCIONARIO</option>
							<!--<option value="6">MEDIÇÃO</option>-->
						</select>
					</label>
				</div>
				<div class="col-xs-3" style="padding:0px">
					<div class="col-xs-6" style="padding:2px">
						<label style="width:100%"><small>Periodo (Medição)</small><br/>
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
					<label style="width:100%"><small>Porc (%).:</small>
						<input type="text" name="porcentagem" value="60" class="form-control input-sm"  style="width:100%" required/>
					</label>
				</div>
				<div class="col-xs-12" style="padding:0px">
					<div id="itens-geral">
						
					</div>
				</div>
				<div class="col-xs-12" style="margin:10px 0px; text-align:center">
					<input type="submit" value="Pesquisar" style="width:50%; height:40px;" class="btn btn-success btn-sm" />
				</div>	
		</div>
	</form>
</div>
	<div class="resultado"></div>	
	<div class="modal" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:auto;">
		<div class="modal-dialog" style="width:90%;">
			<div class="modal-content" style="width:100%; padding-bottom:10px;">
				<div class="modal-header" style="width:100%">
					<button type="button" class="close" onclick="$('.modal').modal('hide')" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Configuração</h4>
				</div>
				<div class="modal-body" style="width:100%; max-height:500px; overflow:auto; border-bottom:1px solid #E5E5E5;">
					Aguarde um momento &nbsp;&nbsp; <img src="../../imagens/loading.gif" alt="Carregando" width="20px"/>
				</div>
			</div>
		</div>
	</div>