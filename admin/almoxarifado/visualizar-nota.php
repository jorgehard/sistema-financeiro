<?php
	include("../config.php");
	include("../validar_session.php");
	include("../../functions/function-print.php");
	getData();
	getNivel();
?>
<style>
	@media print
	{
		table, tr, thead, tbody, td, th{
			border:1px solid #000 !important;
		}
	}
</style>
<script type="text/javascript">
$(document).ready(function(){
	$("table").tablesorter({
		dateFormat : "ddmmyyyy"
	});
	
	$.fn.dataTable.ext.errMode = 'none';
    $('#resultadoTabela').DataTable({
		"paging": true,
		"pageLength": 50,
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
<?php 
	if(@$ac == 'medi'){
		$update = mysql_query("UPDATE `notas_nf` SET `medicao`='$medicao' WHERE id = '$id_nota'");
	}
	if(@$ac == 'localizar') { 
		echo '<table id="resultadoTabela" class="table table-condensed table-color" style="font-size:11px">
		<thead>
			<tr class="small">
				<th style="text-align:center">Nota</th>
				<th style="text-align:center">Valor</th>
				<th style="text-align:center">Med</th>
				<th style="text-align:center">Recebimento</th>
				<th style="text-align:center">Obra</th>
				<th>Empresa</th>
				<th style="text-align:center">Obs</th>
				<th style="text-align:center">Data Ref.</th>
				<th style="text-align:center">Num</th>
				<th class="hidden-print" style="text-align:center"></th>';
			echo '</tr>
		</thead><tbody>';
		
		foreach($ob as $obs) { @$oba .= $obs.','; } $oba = substr($oba,0,-1);

		$i = 1;
		$sql = mysql_query("select *,notas_nf.id as id_nota, notas_nf.obra as obra_nota from notas_nf, notas_empresas where notas_empresas.id = notas_nf.empresa and notas_nf.obra IN ($oba) and (notas_nf.recebimento between '$inicial' and '$final') and (notas_empresas.nome like '%$busca%' OR notas_nf.numero like '%$busca%' OR notas_nf.observacoes like '%$busca%') order by notas_nf.recebimento") or die (mysql_error());
		while($l = mysql_fetch_array($sql)) { extract($l);
			$u = $i++;
			echo '<tr class="small" id="cupom'.$id_nota.'">';
			echo '<td width="50px" style="text-align:center">'.$numero.'</td>';
			$v_t = 0;
        	$i_add = mysql_query("SELECT * FROM notas_itens_add WHERE nota = $id_nota");
            while($l = mysql_fetch_array($i_add)) { 
            	$descontovalor = $l['valor'] - $l['desconto'];
				$subtotal = $l['quantidade'] * $descontovalor;
				$vl_total = round($subtotal,3);
				$v_t += $vl_total;
            }
			echo '<td width="75px" style="text-align:center">R$ '.number_format($v_t,"2",",",".").'</td>';
			echo '<td width="40px" style="text-align:center">'.$medicao.'</td>';
			echo '<td style="text-align:center">'.implode("/",array_reverse(explode("-",$recebimento))).'</td>';
			echo '<td width="160px" style="text-align:center">'.mysql_result(mysql_query("select * from notas_obras where id = $obra_nota"),0,"descricao").'</td>';
			$fornecedor_nome = @mysql_result(mysql_query("SELECT * FROM notas_empresas WHERE id = '$empresa'"),0,"nome");
				
			if( strlen($fornecedor_nome) >= 30 ) {
				$fornecedor_nome = substr($fornecedor_nome, 0, 30).'...<span class="glyphicon glyphicon-eye-open"></span>';
			}else{
				$fornecedor_nome = $fornecedor_nome.'...<span class="glyphicon glyphicon-eye-open"></span>';
			}
			
			echo '<td><a href="#" onclick=\'$(".modal-body").load("financeiro/view-empresa.php?id='.$empresa.'")\' data-toggle="modal" data-target="#myModal4"  class="btn btn-xs" style="margin:0px; padding:0px; font-size:10px; font-weight:bold;">'.$fornecedor_nome.'</a></td>';
			echo '<td style="text-align:center">'.$observacoes.'</td>';
			echo '<td style="text-align:center">'. implode("/",array_reverse(explode("-",$dataxml))).'</th>';
			echo '<td style="text-align:center">';
        	$nums = mysql_query("select * from notas_numerario_itens where id_nota = $id_nota");
            while($l = mysql_fetch_array($nums)) { $id_numerario = $l['id_numerario'];
				$numerario = mysql_result(mysql_query("select * from notas_numerario where id = $id_numerario"),0,"numero");
				echo '<a href="#" onclick=\'ldy("financeiro/protocolo.php?id='.$id_numerario.'",".conteudo")\'>'.$numerario.'</a> ';
            }
			echo '</td>';
			echo '<td width="30px" class="hidden-print" style="text-align:center">';
				echo '<a href="#" onclick=\'$(".modal-body").load("almoxarifado/view-itens-nota.php?id='.$id_nota.'")\' data-toggle="modal" data-target="#myModal3" class="btn btn-info btn-xs" style="margin:0px; padding:0px 5px 0px 5px; font-size:8px;"><span class="glyphicon glyphicon-eye-open"></span></a>';
			echo '</td>';
			echo '</tr>';
		}
		echo '</tbody></table>';
	exit;
} 
?>

	<div class="container-fluid" style="padding:0px 0px 15px 0px; margin-bottom:20px; border-bottom:1px solid #CCC">
		<img src="../imagens/logo.png" class="img-responsive" width="50px" style="float:left; margin-right:20px"/>
		<h3 style="font-family: 'Oswald', sans-serif; letter-spacing:5px;"> 
			CONSULTA DE <small><b>NOTAS FISCAIS</b></small>
			<a href="javascript:window.print()" style="letter-spacing:8px; padding-left:40px; padding-right:40px;" class="hidden-xs hidden-print pull-right btn btn-warning btn-sm"> <span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir</a>
		</h3>
	</div>
	<div class="well well-sm hidden-print" style="padding:10px 10px 5px 10px;">
		<form action="javascript:void(0)" onsubmit="post(this,'almoxarifado/visualizar-nota.php?ac=localizar','.retorno')">
			<div class="container-fluid" style="padding:0px">
				<div class="col-xs-3" style="padding:0px">
					<div class="col-xs-6" style="padding:2px">
						<label style="width:100%"><small>Obra:</small><br/>
							<select name="ci[]" onChange="$('#item-consulta-obra').load('../functions/functions-load.php?atu=ac&cidade=' + $(this).val() + '');" style="width:250px;" class="sel" multiple="multiple" id="categ" required> 
							<?php
								$cidade = mysql_query("select * from notas_obras_cidade WHERE id IN(0,$cidade_usuario) order by nome asc");
								while($l = mysql_fetch_array($cidade)) {
									echo '<option value="'.$l['id'].'" selected>'.$l['nome'].'</option>';
								}
							?>	
							</select>
						</label>
					</div>
					<div class="col-xs-6" style="padding:2px">
						<label id="item-consulta-obra" style="width:100%">
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
						</label>
					</div>
				</div>
				<div class="col-xs-4" style="padding:2px">
					<label style="width:100%"><small>Buscar:</small><br/>
						<input type="text" name="busca" placeholder="Busque por empresas, numero NF ou observações" size="40" class="form-control input-sm">
					</label>
				</div>
				<div class="col-xs-3" style="padding:0px">
					<div class="col-xs-6" style="padding:2px">
						<label style="width:100%"><small>Data NF:</small><br/>
							<input type="date" name="inicial" value="<?php echo $inicioMes; ?>" class="form-control input-sm"/>
						</label>
					</div>
					<div class="col-xs-6" style="padding:2px">
						<label style="width:100%"><br/>
							<input type="date" name="final" value="<?php echo $todayTotal ?>" class="form-control input-sm"/>
						</label>
					</div>
				</div>
				<div class="col-xs-2" style="padding:2px;">
					<label class="pull-right" style="width:100%"><br/>
						<input type="submit" value="Pesquisar" style="width:100%" class="btn btn-success btn-sm">
					</label>
				</div>
			</div>
		</form>
	</div>

	<div class="retorno"></div>
	
	<div class="modal" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="height:auto;">
		<div class="modal-dialog" style="width:80%;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" onclick="$('.modal').modal('hide');" data-dismiss="modal" aria-hidden="true"> &times; </button>
					<h4 class="modal-title" id="myModalLabel">Visualizar Nota Fiscal</h4>
				</div>
				<div class="modal-body">
					Aguarde um momento &nbsp;&nbsp; <img src="../../imagens/loading.gif" alt="Carregando" width="20px"/>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="height:auto;">
		<div class="modal-dialog" style="width:80%;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" onclick="$('.modal').modal('hide')" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Visualizar empresa</h4>
				</div>
				<div class="modal-body">
					Aguarde um momento &nbsp;&nbsp; <img src="../../imagens/loading.gif" alt="Carregando" width="20px"/>
				</div>
			</div>
		</div>
	</div>

