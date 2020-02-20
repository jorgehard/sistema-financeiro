<?php
	include("../config.php");
	include("../validar_session.php");
	getData();
	if(@$action == 'del') { 
		mysql_query("delete from notas_itens_add where id = $item"); 
	}
	echo '<table class="table table-condensed table-bordered table-color small">';
	echo '<thead>';
	echo '<tr>
			<th>ID:</th>
            <th>Item:</th>
			<th>Dias</th>
			<th>Inicial</th>
			<th>Final</th>
            <th style="text-align:center">Qtd:</th>
            <th style="text-align:center">Vlr UN:</th>
          	<th style="text-align:center">Vlr Total:</th>
            <th colspan="2"></th>
           </tr>';
	echo '</thead>';
	echo '<tbody>';
	$sql = mysql_query("select * from notas_itens_add where nota = '$id' order by id desc");
	while($l = mysql_fetch_array($sql)) { extract($l);
		$data_inicio = new DateTime($data_1);
		$data_fim = new DateTime($data_2);
		$dateInterval = $data_inicio->diff($data_fim);
		$dias_un = ($dateInterval->days)+1;
		@$subtotal = $quantidade * $valor;
		@$total_quantidade += $quantidade;
		@$total_valor += $valor;
		@$total_sub += $subtotal;
		echo '<tr>';
		echo '<td>'.$id.'</td>';
		echo '<td>'.@mysql_result(mysql_query("select * from notas_itens where id = $item"),0,"descricao").'</td>';
		echo '<td>'.$dias_un.'</td>';
		echo '<td>'.implode("/",array_reverse(explode("-",$data_1))).'</td>';
		echo '<td>'.implode("/",array_reverse(explode("-",$data_2))).'</td>';
		echo '<td style="text-align:center">'.number_format($quantidade,"2").'</td>';
		echo '<td style="text-align:center">R$'.number_format($valor,"2",",",".").'</td>';
		echo '<td style="text-align:center">R$'.number_format($subtotal,"2",",",".").'</td>';
		
		echo '<td width="2%" align="center"><a href="#" onclick=\'$(".modal-body").load("financeiro/editar-cupom.php?item='.$id.'&nota='.$nota.'&obra_nt='.$obra_nt.'")\' data-toggle="modal" data-target="#myModalEditar" style="margin:0px; padding:5px;" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></a></td>';
		
		echo '<td width="2%" align="center"><a href="#" onclick=\'$(".lista_itens").load("financeiro/itens-nota-lista-locacao.php?action=del&id='.$nota.'&item='.$id.'&obra_nt='.$obra_nt.'")\' style="margin:0px; padding:5px;" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a></td>';
		
		echo '</tr>';
	}
	echo '</tbody>';
	echo '<tfoot>';
	echo '<tr class="active">
			<th colspan="4"></th>
			<th style="text-align:center">Total: </th>
			<th style="text-align:center">'.number_format(@$total_quantidade,"2").'</th>
			<th style="text-align:center">SubTotal: </th>
			<th style="text-align:center">'.number_format(@$total_sub,"2",",",".").'</th>
			<th colspan="2"></th>';
	echo '</tr>';
	echo '</tfoot>';
	echo '</table>';

	
?>