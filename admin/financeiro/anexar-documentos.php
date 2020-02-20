<?php 
	include("../config.php");
	include("../validar_session.php");
	getData();
	getNivel();
?>
<script src="../js/combobox-resume.js"></script>
<?php 
	if($atu=='venc'){
		if($tipo_anexo == '1' || $tipo_anexo == '2'){
		?>
		<div class="col-md-3" style="padding: 3px">
			<label style="width:100%">
				<small>Vencimento Ref.:</small><br/>
				<select class="form-control input-sm combobox" name="id_venc" required>
				<?php 
					$cursos = mysql_query("select * from notas_nf_venc WHERE nota = '$id_nota' order by data_pagamento desc"); 
					while($c=mysql_fetch_array($cursos)) {
						echo '<option value="'.$c['id'].'">'.$c['parcela'].'x - Venc.: '.implode("/",array_reverse(explode("-",$c['data_pagamento']))).' / Valor: '.number_format($c['valor_pagamento'],2,",",".").'</option>'; 
					}  	
				?>	
				</select>
			</label>
		</div>
		<?php
		}
		exit;
	}
?>
<!-- LISTA HISTORICO CURSOS -->
	<div class="panel panel-success">
		<div class="panel-heading" style="font-weight:bold; text-align:center; font-family: 'Oswald', sans-serif; letter-spacing:3px;"><small>Anexo & Documentos | Nota fiscal</small></div>
			<div class="panel-body">
				<form class="form-inline formulario-success" action="financeiro/upload-anexo.php?id_nota=<?php echo $id_nota ?>" target="_blank" enctype="multipart/form-data" method="POST">
					<div class="container-fluid" style="padding:0px">
						<div class="col-md-2" style="padding: 3px">
							<label style="width:100%">
								<small>Tipo:</small><br/>
								<select class="form-control input-sm" onChange="$('.item-consulta').load('financeiro/anexar-documentos.php?atu=venc&id_nota=<?= $id_nota ?>&tipo_anexo=' + $(this).val() + '');" style="width:100%" name="tipo_anexo" required>
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
					<script>ldy("financeiro/lista-anexos.php?id_nota=<?php echo $id_nota ?>",".cursos");</script>
					<div class="cursos"></div>
				</form>
			</div>
		</div>