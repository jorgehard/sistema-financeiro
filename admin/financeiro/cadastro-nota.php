<?php 
	require_once("../config.php");
	require_once("../validar_session.php");
	getData();
	getNivel();
	$dataInicio = new DateTime($todayTotal);
	$dataInicio->add(new DateInterval('P'.(60).'D'));
	$dataInicio = $dataInicio->format('Y-m-d');
?>
<script src="../js/combobox-resume.js"></script>

<?php 
if($info == 1){
?>
<style>
.informativo{
	font-size:13px;
	color:rgba(0,0,0,0.7);
	background:url('../imagens/marcadagua-litoralrent.png') no-repeat center center;
	background-size:50%;
	font-family: 'Roboto Condensed', sans-serif;
}
.informativo h5{
	font-weight:bold;
	text-decoration:underline;
	color:#333;
	font-size:12px;
}
.informativo .underline{
	text-decoration:underline;
}
.informativo ul li{
	margin: 10px;
}
</style>
<div class="informativo">
	<p>
	Este cadastro é utilizado para o controle e gestão das despesas e faturamento da empresa, abaixo segue a descrição e explicação de cada campo.
	</p>
<h5><span class="glyphicon glyphicon-pushpin"></span>&nbsp; Tipo da Nota</h5>
<p>
	<ul>
		<li>
			<span class="underline"><small>"NOTA FISCAL – DESPESAS:"</small></span> Deve ser escolhida essa opção quando desejar lançar notas referente as despesas da empresa, como notas fiscais de compra, gastos com funcionários, compra de equipamentos e matérias, entre outros.
		</li>
		<li>
			<span class="underline"><small>"LOCAÇÃO:"</small></span>  Se refere as notas de entrada de capital, ou seja, as medições realizadas relacionadas a locação de equipamento.
		</li>
		<!--<li>
			<span class="underline"><small>"SERVIÇO:"</small></span> Usada para lançar entrada de valores, referente a prestação de serviços diversos.
		</li>
		<li>
			<span class="underline"><small>"VENDA:"</small></span> Tipo de lançamento utilizado para dar entrada em valores referente a venda de itens.
		</li>-->
	</ul>
</p>
<h5><span class="glyphicon glyphicon-pushpin"></span>&nbsp; Empresa</h5>
<p>- Neste campo deve ser selecionado a empresa ou pessoa referente ao lançamento em questão, campo importante para ser filtrado futuramente.</p>
<h5><span class="glyphicon glyphicon-pushpin"></span>&nbsp; Filial</h5>
<p>- Se refere a filial da empresa citada anteriormente.</p>
<h5><span class="glyphicon glyphicon-pushpin"></span>&nbsp; Fornecedor</h5>
<p>- Campo importante, onde deve ser selecionado a empresa que gerou a nota fiscal, já no caso de escolher uma locação, serviço ou venda, a empresa que se refere é a que está fornecendo a entrada do dinheiro, seja quem comprou, locou ou contratou o serviço.</p>
<h5><span class="glyphicon glyphicon-pushpin"></span>&nbsp; Número da Nota Fiscal</h5>
<p>- No caso de notas fiscais e documentos que possuem numeração, deve ser preenchida corretamente, seguindo o número do documento.
Caso não haja qualquer numeração referente ao lançamento, deve ser deixado em branco, para que o sistema gere um número aleatório.</p>
<h5><span class="glyphicon glyphicon-pushpin"></span>&nbsp; Emissão NF</h5>
<p>Data referente ao recebimento ou emissão do documento</p>
<h5><span class="glyphicon glyphicon-pushpin"></span>&nbsp; Parcela / Data Parcela / Valor</h5>
<p>Estes três campos quando se trata de uma Nota fiscal de Despesa, refere-se a divisão do vencimento da nota fiscal. Já quando se trata de um rendimento, esses três campos se referem ao controle da entrada do dinheiro.</p>
<h5><span class="glyphicon glyphicon-pushpin"></span>&nbsp; Observações</h5>
<p>Qualquer informação que seja pertinente ao lançamento e para um melhor controle futuro, deve ser anotado neste campo.</p>
<br/>
<p>Para quaisquer duvidas referente ao lançamento, procure um administrador. </p>
</div>
<?php
exit;
}
if($atu=='fornecedor'){
	echo '<label class="formulario-normal" for="" style="width:100%"><small>Fornecedor:</small> <select name="empresa" class="form-control input-sm combobox" required>';
	$sql = @mysql_query("select * from empresa_cadastro WHERE id <> '0' AND status = '0' order by razao_social asc");
	while($l = @mysql_fetch_array($sql)) { extract($l);
		echo '<option value="'.$id.'">'.$cnpj.' - '.$razao_social.'</option>';
	}
	echo '</select></label>';
	exit;
}
if($atu=='ac'){
	echo '<label for="" style="width:100%"><small>Filial:</small> 
			<select name="obra" class="form-control input-sm" style="width:100%" required>';
			$obras = mysql_query("select * from notas_obras where cidade IN($cidade) and id in($obra_usuario) AND id <> '0' AND status = '0' order by descricao asc");
			while($l = mysql_fetch_array($obras)) {
				echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>';
			}
		echo '</select>
	</label>';
	exit;
}
?>
<div class="retorno"> </div>
<form action="javascript:void(0)" class="formulario-info" onSubmit="post(this,'financeiro/cadastro-nota-query.php','.retorno')">
	<div class="panel panel-default" style="width:100%;">
		<h4 class="title-box"> <i class="fa fa-files-o" aria-hidden="true"></i> Cadastro de notas fiscais
			<a href="#" onclick='$(".modal-body").load("financeiro/cadastro-nota.php?info=1")' data-toggle="modal" data-target="#myModal" class="pull-right button-top-box"><i class="fa fa-info-circle"></i></a>
			<a href="#" onclick="ldy('financeiro/cadastro-nota.php','.conteudo')" class="pull-right button-top-box"><i class="fa fa-repeat"></i></a>
		</h4>
			<div class="panel-body " style="padding:20px; background:#FFF;">
				<div class="col-xs-12 col-md-6">
					<label style="width:100%">
						<label for="" style="width:100%"><small>Tipo da Nota:</small> 
							<select name="tipo_nota" class="form-control input-sm" style="width:100%;" required>
								<option value="0" selected>NOTA FISCAL - DESPESAS</option>
								<option value="1">FATURA DE LOCAÇÃO</option>
								<option value="2">VENDA</option>
								<option value="3">SERVIÇO</option>
							</select>
						</label>
					</label>
					<label for="" style="width:100%"><small>Empresa:</small><br/>
						<select name="cidade" onChange="$('#itens-obra').load('financeiro/cadastro-nota.php?atu=ac&cidade=' + $(this).val() + '');" style="width:100%" class="form-control input-sm" required> 
							<option value="" disabled selected>Selecione uma obra</option>
								<?php
										$cidade = @mysql_query("select * from notas_obras_cidade WHERE id IN($cidade_usuario) AND id <> '0' order by nome asc");
										while($l = @mysql_fetch_array($cidade)) {
											echo '<option value="'.$l['id'].'">'.$l['nome'].'</option>';
										}
								?>	
						</select>
					</label>
					<label id="itens-obra" style="width:100%">
						<label for="" style="width:100%"><small>Filial:</small> 
							<select name="obra" class="form-control input-sm" style="width:100%">
								<option value="" selected>Selecione uma Obra </option>
							</select>
						</label>
					</label>
					<div class="fornecedorAtu">
						<label class="formulario-normal" for="" style="width:100%"><small>Fornecedor:</small>
							<select name="empresa" class="form-control input-sm combobox" required>
								<?php
									$sql = @mysql_query("select * from empresa_cadastro WHERE id <> '0' AND status = '0' order by razao_social asc");
									while($l = @mysql_fetch_array($sql)) { extract($l);
										echo '<option value="'.$id.'">'.$cnpj.' - '.$razao_social.'</option>';
									}
								?>
							</select>
						</label>
					</div>
					<p class="help-block pull-right" style="font-size:13px;"><i class="fa fa-plus-circle" aria-hidden="true"></i> <a href="#" onclick='$(".modal-body").load("financeiro/cadastro-empresa.php")' data-toggle="modal" data-target="#myModal"  style="color:#6a6a6a">Cadastrar novo fornecedor.</a></p>
				</div>
				<div class="col-xs-12 col-md-6">
					<div class="col-xs-12 col-md-6" style="padding:0px 5px;">
						<div class="numeroNota">
							<label for="" style="width:100%">
								<small>Número da Nota Fiscal:</small>
								<input type="text" onfocus="$(this).mask('9?9999999999')" name="numero" class="form-control input-sm" style="width:100%">
							</label>
						</div>
					</div>
					<div class="col-xs-6" style="padding:0px 5px">
						<label for="" style="width:100%"><small>Emissão NF:</small><input type="date" name="recebimento" max="<?php echo $todayTotal ?>" min="2013-01-01" class="form-control input-sm" style="width:100%" required></label>
					</div>
					<div class="col-xs-12 col-md-12" style="padding:0px">
						<div class="col-xs-12 col-md-3" style="padding:0px 5px;">
							<label for="" style="width:100%"><small>Parcelas:</small>
								<input type="number" name="parcelas" max="48" min="1" step="1" class="form-control input-sm" value="1" style="width:100%" required />
							</label>
						</div>
						<div class="col-xs-12 col-md-5" style="padding:0px 5px;">
							<label for="" style="width:100%"><small>Data Parcela:</small>
								<input type="date" name="data_vencimento" class="form-control input-sm" style="width:100%" required />
							</label>
						</div>
						<div class="col-xs-12 col-md-4" style="padding:0px 5px;">
							<label for="" style="width:100%"><small>Valor:</small>
								<input type="text" onfocus="$(this).maskMoney({symbol:'R$ ',showSymbol:true, thousands:'.', decimal:',', symbolStay: true});" placeholder="R$" name="valor_vencimento" class="form-control input-sm" style="width:100%" />
							</label>
						</div>
					</div>
					<div class="col-xs-12" style="padding:0px 5px">
						<label for="" style="width:100%"><small>Observações:</small>
							<textarea id="summernote" cols="100" rows="10" class="form-control input-sm" name="observacoes" style="resize:none; height:113px"></textarea>
						</label>
					</div>
				</div>
				<hr>&nbsp;<hr/>
				<div class="col-xs-12" style="text-align:center">
					<label for="" style="width:40% !important;">
						<input type="submit" value="Cadastrar" style="width:100%; height:40px; margin-top:10px; color:#ccc; border-radius:5px" class="btn btn-primary btn-sm">
					</label>
				</div>
			</div>
	</div>
</form>
<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="height:auto;">
	<div class="modal-dialog" style="width:80%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" style="color:#C9302C; opacity:1; "  onclick="$('.modal').modal('hide')" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel" style="font-family: 'Oswald', sans-serif; letter-spacing:3px;">Lançamento de Notas Fiscais | <small>Informações</small></h4>
			</div>
			<div class="modal-body body-empresa">
				Aguarde um momento &nbsp;&nbsp; <img src="../../imagens/loading.gif" alt="Carregando" width="20px"/>
			</div>
		</div>
	</div>
</div>
