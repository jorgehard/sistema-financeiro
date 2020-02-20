<?php
	include("../config.php");
	include("../validar_session.php");
	getData();
	if(@$ac=='ins') { 
		$valor_pagoInput = str_replace("R$ ", "", $valor_pagoInput); $valor_pagoInput = str_replace(".", "", $valor_pagoInput); $valor_pagoInput = str_replace(",", ".", $valor_pagoInput);
		//VALOR VENC
		$valorInput = str_replace("R$ ", "", $valorInput);
		$valorInput = str_replace(".", "", $valorInput);
		$valorInput = str_replace(",", ".", $valorInput);
		$num_parcela = mysql_result(mysql_query("SELECT COUNT(*) as contagem FROM notas_nf_venc WHERE nota = '$nota'"),0,"contagem");
		$num_parcela = $num_parcela + 1;
		mysql_query("insert into notas_nf_venc (nota, parcela, data, valor, data_pagamento, valor_pagamento, obs, conta) values ('$nota', '$num_parcela', '$dataInput', '$valorInput', '$data_pagoInput', '$valor_pagoInput', '$obsInput', '$contaInput')"); 
		echo '<script>ldy("financeiro/cadastro-vencimento.php?nota='.$nota.'&cidade_nt='.$cidade_nt.'",".modal-body")</script>';
		echo "<script>$('.modal').on('hidden.bs.modal', function (e) { 
			ldy('financeiro/itens-nota.php?id=".$nota."','.retorno') 
			ldy('financeiro/itens-nota-lista.php?id=".$nota."','.lista_itens');
		})";
		exit;
	}
	
	//deletar vencimento
	if(@$ac=='del') { 
		mysql_query("delete from notas_nf_venc where id = '$id'");
	}
	//MEDICAO VENCIMENTO
	if(@$ac == 'medi'){
		$valor_pagamentoInput = str_replace("R$ ", "", $valor_pagamentoInput);
		$valor_pagamentoInput = str_replace(".", "", $valor_pagamentoInput);
		$valor_pagamentoInput = str_replace(",", ".", $valor_pagamentoInput);
		//VALOR VENC
		$valor_venc = str_replace("R$ ", "", $valor_venc);
		$valor_venc = str_replace(".", "", $valor_venc);
		$valor_venc = str_replace(",", ".", $valor_venc);
		
		$update = mysql_query("UPDATE `notas_nf_venc` SET `data`='$data_venc', `valor`='$valor_venc', `data_pagamento`='$data_pagamentoInput', `valor_pagamento`='$valor_pagamentoInput', `obs`='$obsInput', `conta`='$conta_venc' WHERE id = '$id'");
		echo '<script>alert("Vencimento alterado com sucesso! Atualize a pagina");</script>';
	}
?>
<style>
container-zebrado:nth-of-type(odd) {
    background: #e0e0e0;
}
</style>
<div class="container-fluid">
	<form action="javascript:void(0)" class="formulario-info" onSubmit="post(this,'financeiro/cadastro-vencimento.php?ac=ins&nota=<?php echo $nota ?>&cidade_nt=<?php echo $cidade_nt ?>','.modal-body')">
		<table class="table table-condensed table-color small">
			<thead>
				<tr>
					<th class="text-center">Data Vencimento:<?= $nota ?></th>
					<th class="text-center">Valor:</th>
					<th class="text-center">Data Prevista:</th>
					<th class="text-center">Valor Pago:</th>
					<th class="text-center">Obs:</th>
					<th class="text-center">Conta:</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<label style="width:100%">
							<input type="date" name="dataInput" class="form-control input-sm" style="width:100%" required />
						</label>
					</td>
					<td>
						<label style="width:100%">
							<input type="text" onInput="$(this).maskMoney({symbol:'R$ ',showSymbol:true, thousands:'.', decimal:',', symbolStay: true});" placeholder="R$" name="valorInput" class="form-control input-sm" style="width:100%" />
						</label>
					</td>
					<td>
						<label style="width:100%">
							<input type="date" name="data_pagoInput" class="form-control input-sm" style="width:100%" required />
						</label>
					</td>
					<td>
						<label style="width:100%">
							<input type="text" onInput="$(this).maskMoney({symbol:'R$ ',showSymbol:true, thousands:'.', decimal:',', symbolStay: true});" placeholder="R$" name="valor_pagoInput" class="form-control input-sm" style="width:100%" />
						</label>
					</td>
					<td width="20%">
						<input type="text" name="obsInput" maxlength="20" value="<?= $obs ?>" class="form-control input-sm" style="width:100%" />
					</td>
					<td width="10%">
						<label style="width:100%">
							<select class="form-control input-sm" name="contaInput" style="padding:0px; width:100%">
								<option value="0">A PAGAR</option>
								<?php 
									$stb = mysql_query("SELECT * FROM equipes WHERE obra = '$cidade_nt' and status = '0'");
									while($a = mysql_fetch_array($stb)){
										echo '<option value="'.$a['id'].'">'.$a['nome'].'</option>';
									}
								?>
							</select>
						</label>
					</td>
					<td width="5%">
						<input type="submit" value="Cadastrar" style="color:#f3f3f3" class="btn btn-primary btn-sm" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<hr/>
	<div class="ajax22"></div>
		<div class="container-fluid" style="margin:0px; padding:0px">
			<div class="col-xs-1 small" style="text-align:center; padding:5px 2px; font-weight:bold;">
				Parcela:
			</div>
			<div class="col-xs-7" style="padding:0px;">
				<div class="col-xs-3 small" style="text-align:center; padding:5px 2px; background:#def8fc; font-weight:bold">
					<span class="text-primary">Data Vencimento:</span>
				</div>
				<div class="col-xs-3 small" style="text-align:center; padding:5px 2px; font-weight:bold; background:#def8fc">
					<span class="text-primary">Valor (R$):</span>
				</div>
				<div class="col-xs-3 small" style="text-align:center; padding:5px 2px; font-weight:bold">
					Data Previsão:
				</div>
				<div class="col-xs-3 small" style="text-align:center; padding:5px 2px; font-weight:bold">
					Valor Pago:
				</div>
			</div>
			<div class="col-xs-2 small" style="padding:5px 2px; font-weight:bold">
				Obs:
			</div>
			<div class="col-xs-1 small" style="text-align:center; padding:5px 2px; font-weight:bold">
				Conta:
			</div>
			<div class="col-xs-1" style="padding:0px;">
				<div class="col-xs-6 small" style="text-align:center; padding:5px 2px; font-weight:bold">
					Salvar:
				</div>
				<div class="col-xs-6 small" style="text-align:center; padding:5px 2px; font-weight:bold">
					Excluir:
				</div>
			</div>
		</div>
		<div class="row">
	<?php
		@$parcela_controle = @mysql_result(@mysql_query("select * from notas_nf_venc where nota = '$nota' order by parcela DESC LIMIT 1"),0,"parcela");
		
		$sql = mysql_query("select * from notas_nf_venc where nota = '$nota' order by parcela asc");
		while($l=mysql_fetch_array($sql)) { extract($l);
	?>
			<form action="javascript:void(0)" onsubmit="post(this,'financeiro/cadastro-vencimento.php?ac=medi&nota=<?php echo $nota; ?>&cidade_nt=<?php echo $cidade_nt ?>&id=<?php echo $id;?>','.modal-body')" class="formulario-info2">
					<div class="container-fluid container-zebrado">
						<div class="col-xs-1" style="padding:2px;">
							<input type="text" name="parcela_venc" value="<?= $parcela ?>" class="form-control input-sm" style="width:100%" disabled />
						</div>
						<div class="col-xs-7" style="padding:0px;">
							<?php if($conta != '0') { ?>
								<div class="col-xs-3" style="padding:2px 5px; background:#def8fc">
									<input type="date" readonly="readonly" name="data_venc" value="<?= $data ?>" class="form-control input-sm" style="width:100%" />
								</div>
								<div class="col-xs-3" style="padding:2px 5px; background:#def8fc">
									<input type="text" readonly="readonly" onInput="$(this).maskMoney({symbol:'R$ ',showSymbol:true, thousands:'.', decimal:',', symbolStay: true});" placeholder="R$" name="valor_venc" value="R$ <?= number_format($valor,2,",","."); ?>" class="form-control input-sm" style="width:100%" />
								</div>
								<div class="col-xs-3" style="padding:2px 5px;">
									<input type="date" readonly="readonly" name="data_pagamentoInput" value="<?= $data_pagamento ?>" class="form-control input-sm" style="width:100%" />
								</div>
								<div class="col-xs-3" style="padding:2px 5px;">
									<input type="text" readonly="readonly" onInput="$(this).maskMoney({symbol:'R$ ',showSymbol:true, thousands:'.', decimal:',', symbolStay: true});" placeholder="R$" name="valor_pagamentoInput" value="R$ <?= number_format($valor_pagamento,2,",","."); ?>" class="form-control input-sm" style="width:100%" />
								</div>
							<?php }else{ ?>
								<div class="col-xs-3" style="padding:2px 5px; background:#def8fc">
									<input type="date" name="data_venc" value="<?= $data ?>" class="form-control input-sm" style="width:100%" />
								</div>
								<div class="col-xs-3" style="padding:2px 5px; background:#def8fc">
									<input type="text" onInput="$(this).maskMoney({symbol:'R$ ',showSymbol:true, thousands:'.', decimal:',', symbolStay: true});" placeholder="R$" name="valor_venc" value="R$ <?= number_format($valor,2,",","."); ?>" class="form-control input-sm" style="width:100%" />
								</div>
								<div class="col-xs-3" style="padding:2px 5px;">
									<input type="date" name="data_pagamentoInput" value="<?= $data_pagamento ?>" class="form-control input-sm" style="width:100%" />
								</div>
								<div class="col-xs-3" style="padding:2px 5px;">
									<input type="text" onInput="$(this).maskMoney({symbol:'R$ ',showSymbol:true, thousands:'.', decimal:',', symbolStay: true});" placeholder="R$" name="valor_pagamentoInput" value="R$ <?= number_format($valor_pagamento,2,",","."); ?>" class="form-control input-sm" style="width:100%" />
								</div>
							<?php } ?>
						</div>
						<div class="col-xs-2 small" style="padding:2px; font-weight:bold">
							<input type="text" name="obsInput" maxlength="20" value="<?= $obs ?>" class="form-control input-sm" style="width:100%" />
						</div>
						<?php $valor_total_venc += $valor; ?>
						<?php $valor_total_pag += $valor_pagamento; ?>
						<div class="col-xs-1" style="padding:2px">
							<select class="form-control input-sm" name="conta_venc" style="padding:0px; width:100%">
								<option value="0">A PAGAR</option>
							<?php 
							$stb = mysql_query("SELECT * FROM equipes WHERE obra = '$cidade_nt' and status = '0'");
							while($a = mysql_fetch_array($stb)){
								if($a['id'] == $conta){
									echo '<option value="'.$a['id'].'" selected>'.$a['nome'].'</option>';
								}else{
									echo '<option value="'.$a['id'].'">'.$a['nome'].'</option>';
								}
							}
							?>
							</select>
						</div>
						<div class="col-xs-1" style="padding:0px">
							<div class="col-xs-6" style="padding:2px; text-align:center">
								<button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-ok-circle"></span></button>
							</div>
							<div class="col-xs-6" style="padding:2px; text-align:center">
								<?php if($parcela_controle == $parcela){ ?>
								<a href="#" onclick='ldy("financeiro/cadastro-vencimento.php?ac=del&nota=<?php echo $nota; ?>&id=<?php echo $id;?>",".modal-body")' style="margin-left:10px" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></a>
								<?php }else{ ?>
								<a href="#" class="btn btn-danger btn-sm" disabled style="margin-left:10px; opacity:0.5"><span class="glyphicon glyphicon-trash"></span></a>
								<?php } ?>
							</div>
						</div>
					</div>
				</form>
				<?php
		}
	?>
	<div class="container-fluid container-zebrado">
		<div class="col-xs-1" style="padding:2px;">&nbsp;</div>
		<div class="col-xs-7" style="padding:0px; ">
			<div class="col-xs-3" style="padding:2px 5px; background:#def8fc; text-align:center"><span class="text-info"><small><b>Total</b></small></span></div>
			<div class="col-xs-3" style="padding:2px 5px; background:#def8fc; text-align:center"><span class="text-info"><small><b> R$: <?= number_format($valor_total_venc, 2, ",", ".") ?></b></small></span></div>
			<div class="col-xs-3" style="padding:2px 5px; text-align:center"><small><b>Total</b></small></div>
			<div class="col-xs-3" style="padding:2px 5px; text-align:center"><small><b> R$: <?= number_format($valor_total_pag, 2, ",", ".") ?></b></small></div>
		</div>
		<div class="col-xs-2 small" style="padding:2px; font-weight:bold">&nbsp;</div>
		<div class="col-xs-1" style="padding:2px">&nbsp;</div>
		<div class="col-xs-1" style="padding:0px">&nbsp;</div>
	</div>
	<?php //$parcela_controle ?>
	<h3 class="pull-right" style="font-family: \'Oswald\', sans-serif; letter-spacing:5px;">
		Total Venc <b><small> R$ <?= number_format($valor_total_venc,2,",",".") ?></small></b> <br/>
		Total Pago <b><small> R$ <?= number_format($valor_total_pag,2,",",".") ?> </small></b>
	</h3>
	</div>

