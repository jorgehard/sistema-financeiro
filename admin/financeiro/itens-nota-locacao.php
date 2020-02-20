			<table class="table table-condensed table-bordered table-color">
				<thead>
					<tr class="small">
						<th>Filial:</th>
						<th>Fornecedor:</th> 
						<th>Nota Fiscal:</th>
						<th>Emissão NF:</th>
						<th>Parcelas:</th>
					</tr>
				</thead>
				<tbody>
				<?php
					echo '<tr>';
					echo '<td>'.mysql_result(mysql_query("select * from notas_obras where id = $obra_nt"),0,"descricao").'</td>';
					echo '<td>'.mysql_result(mysql_query("select * from empresa_cadastro where id = $empresa"),0,"razao_social").'</td>';
					echo '<td>'.$numero.'</td>';
					echo '<td>'.implode("/",array_reverse(explode("-",$recebimento))).'</td>';
					echo '<td>'.mysql_num_rows(mysql_query("SELECT * FROM notas_nf_venc WHERE nota = '$id'")).'x</td>';
					echo '</tr>';
				?>
				</tbody>
			</table>
			<h4>
				<small style="font-family: \'Oswald\', sans-serif; letter-spacing:3px;">Selecionar itens para incluir a fatura de locação</small>
			</h4>
			
			<form action="javascript:void(0)" class="formulario-info" onSubmit="post(this,'financeiro/itens-nota-query.php?nota=<?php echo $id; ?>&tipo_nota=<?php echo $tipo_nota ?>','.lista_itens')">
				<table class="table table-condensed table-bordered table-blue small">
					<thead>
						<tr>
							<th class="text-center">Periodo:</th>
							<th class="text-center">Categoria:</th>
							<th class="text-center">Sub-Categoria / Item</th>
							<th class="text-center">Qtd:</th>
							<th class="text-center">Valor:</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td width="30%">
								<div class="col-xs-6" style="padding:2px">
									<label style="width:100%">
										<input type="date" name="data_1" min="2018-08-01" max="<?= $todayTotal ?>" class="form-control input-sm" required />
									</label>
								</div>
								<div class="col-xs-6" style="padding:2px">
									<label style="width:100%">
										<input type="date" name="data_2" min="2018-08-01" max="<?= $todayTotal ?>" class="form-control input-sm" required />
									</label>
								</div>
							</td>
							<td width="20%">
								<label style="width:100%">
									<select name="categoria" onChange="$('#atu-categoria').load('../functions/functions-load.php?atu=categoria_notaFiscal&categorias=' + $(this).val() + '');" class="form-control input-sm" id="categ" required>
										<option value="" disabled selected>Selecione uma categoria</option>
										<?php
											$sql = mysql_query("select * from notas_categorias WHERE obra IN($cidade_nt) and status = '0' order by descricao asc");
											while($l = mysql_fetch_array($sql)) {
												echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>';
											}
										?>
									</select>
								</label>
							</td>
							<td id="atu-categoria" width="30%">
								<div class="col-xs-6" style="padding:2px">
									<label style="width:100%">
										<select name="categoria" class="form-control input-sm" disabled>
											<option value="" disabled selected>Selecione uma categoria</option>
										</select>
									</label>
								</div>
								<div class="col-xs-6" style="padding:2px">
									<label style="width:100%">
										<select name="item" class="form-control input-sm" disabled>
											<option>Selecione uma categoria antes</option>
										</select>
									</label>
								</div>
							</td>
							<td width="5%">
								<label style="width:100%">
									<input type="number" step="0.001" name="quantidade" value="1" class="form-control input-sm" required />
								</label>
							</td>
							<td width="15%">
								<label style="width:100%">
									<input type="text" onfocus="$(this).maskMoney({symbol:'R$ ',showSymbol:true, thousands:'.', decimal:',', symbolStay: true});" placeholder="R$" name="valor" class="form-control input-sm" style="width:100%" />
								</label>
							</td>
							<td width="5%">
								<button class="btn btn-success btn-sm" style="width:100%">
									<span class="glyphicon glyphicon-plus"></span>
								</button>
							</td>
						</tr>
					</tbody>
				</table>
			</form>
			<h4>
				<small style="font-family: \'Oswald\', sans-serif; letter-spacing:3px;">Itens adicionados a nota fiscal</small>
			</h4>
			
			<script> ldy("financeiro/itens-nota-lista-locacao.php?id=<?php echo $id ?>&obra_nt=<?php echo $obra_nt ?>",".lista_itens"); </script>
			
			<div class="lista_itens"></div>