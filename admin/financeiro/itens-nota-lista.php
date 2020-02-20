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
            <th>Material / Item:</th>
            <th>Categoria:</th>
			<th style="text-align:center">Desconto:</th>
            <th style="text-align:center">Quantidade:</th>
            <th style="text-align:center">Valor Unitário:</th>
          	<th style="text-align:center">Sub-Total:</th>
            <th colspan="2"></th>
           </tr>';
	echo '</thead>';
	echo '<tbody>';
	$sql = mysql_query("select * from notas_itens_add where nota = '$id' order by id desc");
	while($l = mysql_fetch_array($sql)) { extract($l);
		$descontovalor = $valor - $desconto;
		$subtotal = $quantidade * $descontovalor;
		@$total_quantidade += $quantidade;
		@$total_valor += $valor;
		@$total_sub += $subtotal;
		echo '<tr>';
		echo '<td>'.$id.'</td>';
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
	
		echo '<td width="2%" align="center"><a href="#" onclick=\'$(".modal-body").load("financeiro/editar-cupom.php?item='.$id.'&nota='.$nota.'&obra_nt='.$obra_nt.'")\' data-toggle="modal" data-target="#myModalEditar" style="margin:0px; padding:5px;" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></a></td>';
			
		echo '<td width="2%" align="center"><a href="#" onclick=\'$(".lista_itens").load("financeiro/itens-nota-lista.php?action=del&id='.$nota.'&item='.$id.'&obra_nt='.$obra_nt.'")\' style="margin:0px; padding:5px;" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a></td>';
		
		echo '</tr>';
	}
	echo '</tbody>';
	echo '<tfoot>';
	echo '<tr class="active">
			<th colspan="3"></th>
			<th style="text-align:center">Total: </th>
			<th style="text-align:center">'.number_format(@$total_quantidade,"2").'</th>
			<th style="text-align:center">SubTotal: </th>
			<th style="text-align:center">'.number_format(@$total_sub,"2",",",".").'</th>
			<th colspan="2"></th>';
	echo '</tr>';
	echo '</tfoot>';
	echo '</table>';

	
?>