<?php
	include("../config.php");
	include("../validar_session.php");
	getData();
?>
<script src="../js/combobox-resume.js"></script>
<div class="editarVencimentoDiv">
<?php
	//MEDICAO VENCIMENTO
	if(@$ac == 'update'){
		$valor_pagamentoInput = str_replace("R$ ", "", $valor_pagamentoInput);
		$valor_pagamentoInput = str_replace(".", "", $valor_pagamentoInput);
		$valor_pagamentoInput = str_replace(",", ".", $valor_pagamentoInput);
		//VALOR VENC
		$valor_venc = str_replace("R$ ", "", $valor_venc);
		$valor_venc = str_replace(".", "", $valor_venc);
		$valor_venc = str_replace(",", ".", $valor_venc);
		$update = mysql_query("UPDATE `notas_nf_venc` SET `data`='$data_venc', `valor`='$valor_venc', `data_pagamento`='$data_pagamentoInput', `valor_pagamento`='$valor_pagamentoInput', `obs`='$obsInput', `conta`='$conta_venc' WHERE id = '$id_venc'");
		echo '<script>alert("Vencimento alterado com sucesso! Atualize a pagina");</script>';
	}
?>

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
		$sql = mysql_query("select * from notas_nf_venc where id = '$id_venc'");
		while($l=mysql_fetch_array($sql)) { extract($l);
		
		@$parcela_controle = @mysql_result(@mysql_query("select * from notas_nf_venc where nota = '$nota' order by parcela DESC LIMIT 1"),0,"parcela");
	?>
			<form action="javascript:void(0)" onsubmit="post(this,'financeiro/editar-vencimento.php?ac=update&cidade_nt=<?=$cidade_nt?>&id_venc=<?php echo $id_venc; ?>','.editarVencimentoDiv')" class="formulario-info2">
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
	<div style="margin-top:20px">
		<h5 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; padding-left:20px">Comprovantes</h5>
		<hr/>
		<div class="panel panel-success">
			<div class="panel-heading" style="font-weight:bold; text-align:center; font-family: 'Oswald', sans-serif; letter-spacing:3px;"><small>Anexo & Documentos | Nota fiscal</small></div>
				<div class="panel-body">
					<form class="form-inline formulario-success" action="financeiro/upload-anexo.php?id_nota=<?= $nota ?>" target="_blank" enctype="multipart/form-data" method="POST">
						<div class="container-fluid" style="padding:0px">
							<div class="col-md-2" style="padding: 3px">
								<label style="width:100%">
									<small>Tipo:</small><br/>
									<select class="form-control input-sm" onChange="$('.item-consulta').load('financeiro/anexar-documentos.php?atu=venc&id_nota=<?= $nota ?>&tipo_anexo=' + $(this).val() + '');" style="width:100%" name="tipo_anexo" required>
										<option value="">Selecione um tipo</option>
										<option value="0">Nota Fiscal</option>
										<option value="1">Boleto Vencimento</option>
										<option value="2">Comprovante Pagamento</option>
									</select>
								</label>
							</div>
							<div class="item-consulta"></div>
							<div class="col-md-2" style="padding: 3px">
								<label for='selecao-arquivo' style="width:100%; cursor: pointer;">
									<small>Anexar PDF:</small><br/>
									<input id='selecao-arquivo' type="file" accept="application/pdf" class="form-control input-sm" name="anexo" style="width:100%; background:transparent" required>
								</label>
							</div>
							<div class="col-md-4" style="padding: 3px">
								<label style="width:100%">
									<small>Observações:</small><br/>
									<input type="text" class="form-control input-sm" name="obs" style="width:100%;" required>
								</label>
							</div>
							<div class="col-xs-1" style="padding: 3px">
								<label style="width:100%">
									<br/>
									<input type="submit" class="btn btn-success btn-sm pull-right" style="width:100%;" value="Adicionar"/>
								</label>
							</div>
						</div>
						<script>ldy("financeiro/lista-anexos.php?kfx=ax&id_nota=<?= $nota ?>",".cursos12");</script>
						<div class="cursos12"></div>
					</form>
				</div>
			</div>
		</div>
</div>