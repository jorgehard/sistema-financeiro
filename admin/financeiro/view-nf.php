<?php 
	include("../config.php");
	include("../validar_session.php");
	getData();
	getNivel();
?>
<script src="../js/combobox-resume.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$(".btnPrint").printPage();
});
</script>
<style>
container-zebrado:nth-of-type(odd) {
    background: #e0e0e0;
}
</style>
<?php
	$sql = mysql_query("select empresa, numero, recebimento, obra as obra_nt, tipo_nota from notas_nf where id = '$id'");
	while($l = mysql_fetch_array($sql)) { extract($l); }
	$cidade_nt = mysql_result(mysql_query("SELECT cidade FROM notas_obras WHERE id = '$obra_nt'"),0,"cidade");
?>
<div>
	<table class="table table-condensed small" style="margin:0px;">
	<tr class="active">
		<td style="border:none; padding:0px;">
			<ul class="nav nav-tabs" role="tablist">
				<li class="active"><a href="#home" style="color:#333; padding:15px;" role="tab" data-toggle="tab">Informações</a></li>
				<li><a href="#vencimentos" style="color:#333; padding:15px;" role="tab" data-toggle="tab">Vencimentos</a></li>
				<li><a href="#anexos" style="color:#333; padding:15px;" role="tab" data-toggle="tab">Anexos & Documentos</a></li>
			</ul>
		</td>
	</tr>
	</table>
	<!-- Tab panes -->
	<div class="tab-content">
		<!-- Principal, dados da SS -->
		<div class="tab-pane active" id="home">
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
					echo '<td>'.mysql_result(mysql_query("select * from notas_obras where id = '$obra_nt'"),0,"descricao").'</td>';
					echo '<td>'.mysql_result(mysql_query("select * from empresa_cadastro where id = '$empresa'"),0,"razao_social").'</td>';
					echo '<td>'.$numero.'</td>';
					echo '<td>'.implode("/",array_reverse(explode("-",$recebimento))).'</td>';
					echo '<td>'.mysql_num_rows(mysql_query("SELECT * FROM notas_nf_venc WHERE nota = '$id'")).'x</td>';
					echo '</tr>';
				?>
				</tbody>
			</table>
			<h4>
				<small style="font-family: \'Oswald\', sans-serif; letter-spacing:3px;">Itens adicionados a nota fiscal</small>
			</h4>
			<div class="lista_itens">
			<?php
			echo '<table class="table table-condensed table-bordered table-color small">';
				echo '<thead>';
				echo '<tr>
						<th>ID:</th>
						<th>Material / Item:</th>
						<th>Categoria:</th>
						<th style="text-align:center">Desconto:</th>
						<th style="text-align:center">Quantidade:</th>
						<th style="text-align:center">Valor Unitário:</th>
						<th style="text-align:center">Sub-Total:</th>
					   </tr>';
				echo '</thead>';
				echo '<tbody>';
				$sql = mysql_query("select valor, desconto, quantidade, item, categoria, id as id_item from notas_itens_add where nota = '$id' order by id desc");
				while($l = mysql_fetch_array($sql)) { extract($l);
					$descontovalor = $valor - $desconto;
					$subtotal = $quantidade * $descontovalor;
					@$total_quantidade += $quantidade;
					@$total_valor += $valor;
					@$total_sub += $subtotal;
					echo '<tr>';
					echo '<td>'.$id_item.'</td>';
					echo '<td>'.@mysql_result(mysql_query("select * from notas_itens where id = $item"),0,"descricao").'</td>';
					echo '<td>'.@mysql_result(mysql_query("select * from notas_categorias_sub where id = '$categoria'"),0,"descricao").'</td>';
					if($desconto == '0'){
						echo '<td style="text-align:center">-</td>';
					}else{
						echo '<td style="text-align:center">R$'.number_format($desconto,"2",",",".").'</td>';
					}
					echo '<td style="text-align:center">'.number_format($quantidade,"2").'</td>';
					echo '<td style="text-align:center">R$'.number_format($valor,"2",",",".").'</td>';
					echo '<td style="text-align:center">R$'.number_format($subtotal,"2",",",".").'</td>';
					echo '</tr>';
				}
				echo '</tbody>';
				echo '<tfoot>';
				echo '<tr class="active">
						<th colspan="3"></th>
						<th style="text-align:center">Total: </th>
						<th style="text-align:center">'.number_format(@$total_quantidade,"2").'</th>
						<th style="text-align:center">SubTotal: </th>
						<th style="text-align:center">'.number_format(@$total_sub,"2",",",".").'</th>';
				echo '</tr>';
				echo '</tfoot>';
				echo '</table>';
			?>
			</div>
		</div>
		<div class="tab-pane" id="anexos">
		
		anexos
		
		</div>
		<div class="tab-pane" id="vencimentos">
			<?php
			echo '<table class="table table-condensed table-bordered table-color small">';
				echo '<thead>';
				echo '<tr>
						<th>Parcela</th>
						<th style="text-align:center; padding:5px 2px; background:#def8fc; font-weight:bold">Data Venc.</th>
						<th style="text-align:center; padding:5px 2px; background:#def8fc; font-weight:bold">Valor (R$):</th>
						<th style="text-align:center; padding:5px 2px; font-weight:bold">Data Previsão</th>
						<th style="text-align:center; padding:5px 2px; font-weight:bold">Valor (R$)</th>
						<th style="text-align:center">Obs:</th>
						<th style="text-align:center">Conta:</th>
					   </tr>';
				echo '</thead>';
				echo '<tbody>';
				$sql = mysql_query("select * from notas_nf_venc where nota = '$id' order by parcela asc");
				while($xx = mysql_fetch_array($sql)) { 
					echo '<tr>
						<td>'.$xx['parcela'].'</td>
						<td style="text-align:center; padding:5px 2px; background:#def8fc; font-weight:bold">'.implode("/",array_reverse(explode("-",$xx['data']))).'</td>
						<td style="text-align:center; padding:5px 2px; background:#def8fc; font-weight:bold">R$ '.number_format($xx['valor'],2,",",".").'</td>
						<td style="text-align:center; padding:5px 2px; font-weight:bold">'.implode("/",array_reverse(explode("-",$xx['data_pagamento']))).'</td>
						<td style="text-align:center; padding:5px 2px; font-weight:bold">R$ '.number_format($xx['valor_pagamento'],2,",",".").'</td>
						<td style="text-align:center">'.$xx['obs'].'</td>
						<td style="text-align:center">'.mysql_result(mysql_query("SELECT nome FROM equipes WHERE id = '$xx[conta]'"),0,"nome").'</td>';
					echo '</tr>';
				}
				echo '</tbody>';
				echo '<tfoot>';
				echo '<tr class="active">
						<th colspan="3"></th>
						<th style="text-align:center">Total: </th>
						<th style="text-align:center">'.number_format(@$total_quantidade,"2").'</th>
						<th style="text-align:center">SubTotal: </th>
						<th style="text-align:center">'.number_format(@$total_sub,"2",",",".").'</th>';
				echo '</tr>';
				echo '</tfoot>';
				echo '</table>';
			?>

		</div>
	</div>
</div> <!-- fim div retorno -->

	<div class="modal" id="myModalEditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="height:auto;">
		<div class="modal-dialog" style="width:50%;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" style="color:#C9302C; opacity:1; "  onclick="$('.modal').modal('hide')" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Informações</h4>
				</div>
				<div class="modal-body">
					Aguarde um momento &nbsp;&nbsp; <img src="../../imagens/loading.gif" alt="Carregando" width="20px"/>
				</div>
			</div>
		</div>
	</div>

			<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="height:auto;">
				<div class="modal-dialog" style="width:95%;">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" style="color:#C9302C; opacity:1; "  onclick="$('.modal').modal('hide')" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="myModalLabel" style="font-family: \'Oswald\', sans-serif; letter-spacing:5px;">Controle de Parcelas - Vencimento</h4>
						</div>
						<div class="modal-body">
							Aguarde um momento &nbsp;&nbsp; <img src="../../imagens/loading.gif" alt="Carregando" width="20px"/>
						</div>
					</div>
				</div>
			</div>
	