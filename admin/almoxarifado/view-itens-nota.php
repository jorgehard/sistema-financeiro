<?php 
	include("../config.php");
	include("../validar_session.php");
?>
<div class="retorno">
<h4><small style="font-family: \'Oswald\', sans-serif; letter-spacing:3px;">Adicionar itens a nota fiscal</small>
<p class="pull-right">
	<!--
	<a href="financeiro/imprimir-nota.php?id=<?php echo $id; ?>" class="btn btn-warning btn-sm btnPrint"><span class="glyphicon glyphicon-print"></span> <br/>Imprimir</a>
				
	<a href="javascript:void(0)" onclick="$('.modal-body').load('financeiro/cadastro-vencimento.php?nota=<?php echo $id ?>')" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-usd"></span> <br/>Vencimento</a>
	
	<a onclick="ldy('financeiro/cadastro-nota.php','.conteudo')" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-floppy-save"></span> <br/>Novo</a></p>
	-->
</p>
</h4>
<table class="table table-striped table-condensed table-bordered small">
	<tr class="info small"><th>Obra:</th><th>Empresa:</th> <th>Nota Fiscal:</th><th>Recebimento:</th><th>Vencimento:</th></tr>

        <?php
        $sql = mysql_query("select *,obra as obra_nt from notas_nf where id = $id");
		while($l = mysql_fetch_array($sql)) { extract($l);
            echo '<tr class="large">';
        	echo '<td>'.mysql_result(mysql_query("select * from notas_obras where id = $obra_nt"),0,"descricao").'</td>';
        	echo '<td>'.mysql_result(mysql_query("select * from notas_empresas where id = $empresa"),0,"nome").'</td>';
            echo '<td>'.$numero.'</td>';
        	echo '<td>'.implode("/",array_reverse(explode("-",$recebimento))).'</td>';
			if(mysql_num_rows(mysql_query("select * from notas_nf_venc where nota = $id")) != 0) { 
				echo '<td>'.implode("/",array_reverse(explode("-",mysql_result(mysql_query("select * from notas_nf_venc where nota = $id"),0,"data")))).'</td>';
			}else{
				echo '<td>S/Vencimento</td>';
			}
        	echo '</tr>';

		}
        ?>

</table>
<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
    	<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" style="color:#C9302C; opacity:1; " onclick="$('.modal').modal('hide'); $('.modal-body').empty()" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title" id="myModalLabel" style="font-family: 'Oswald', sans-serif;letter-spacing:5px;">Cadastro <strong><small>Vencimento nota fiscal!!!</small></strong></h3>
			</div>
      		<div class="modal-body"></div>
      		<div class="modal-footer">
        	</div>
      	</div>
     </div>
</div>

<?php 
if(mysql_num_rows(mysql_query("select * from notas_nf_venc where nota = $id")) == 0) { 
	echo '<div class="alert alert-warning" role="alert">Você precisa adicionar o <b>vencimento</b> a nota.</div>'; 
	exit; 
} 
?>
<h4><small style="font-family: \'Oswald\', sans-serif; letter-spacing:3px;">Itens adicionados a nota fiscal</small></h4>
<?php
echo '<table class="table table-striped table-condensed table-bordered small">';
	echo '<tr class="info small">
			<th>ID:</th>
            <th>Material / Item:</th>
            <th>Parcela:</th>
            <th>Categoria:</th>
   			<th>Equipe:</th>
			<th>Data:</th>
            <th>Observações:</th>
			<th style="text-align:center">Desconto:</th>
            <th style="text-align:center">Quantidade:</th>
            <th style="text-align:center">Valor Unitário:</th>
          	<th style="text-align:center">Sub-Total:</th>
           </tr>';
		
	$sql = mysql_query("select * from notas_itens_add where nota = $id order by id desc");
	while($l = mysql_fetch_array($sql)) { extract($l);
		$descontovalor = $valor - $desconto;
		$subtotal = $quantidade * $descontovalor;
		$subtotal = round($subtotal,3);
		@$total_quantidade += $quantidade;
		@$total_valor += $valor;
		@$total_sub += $subtotal;
		echo '<tr>';
		echo '<td>'.$id.'</td>';
		if($categoria == 20){
			echo '<td>'.@mysql_result(mysql_query("select * from notas_equipamentos where id = $item"),0,"marca").' / '.@mysql_result(mysql_query("select * from notas_equipamentos where id = $item"),0,"placa").'</td>';
			echo '<td>'.$parcela.'</td>';
		}else{
			echo '<td>'.@mysql_result(mysql_query("select * from notas_itens where id = $item"),0,"descricao").'</td>';
			echo '<td> - </td>';
		}
		echo '<td>'.@mysql_result(mysql_query("select * from notas_categorias where id = $categoria"),0,"descricao").'</td>';
		echo '<td>'.@mysql_result(mysql_query("select * from equipes where id = $equipe"),0,"nome").'</td>';				
		echo '<td>'.implode("/",array_reverse(explode("-",$l['dataeq']))).'</td>';
		echo '<td>'.$observacoes.'</td>';
		echo '<td style="text-align:center">R$'.number_format($desconto,"2",",",".").'</td>';
		echo '<td style="text-align:center">'.number_format($quantidade,"2").'</td>';
		echo '<td style="text-align:center">R$'.number_format($valor,"2",",",".").'</td>';
		echo '<td style="text-align:center">R$'.number_format($subtotal,"2",",",".").'</td>';
		echo '</tr>';
	}
	echo '<tr class="active">
			<th colspan="7"></th>
			<th style="text-align:center">Total: </th>
			<th style="text-align:center">'.number_format(@$total_quantidade,"3").'</th>
			<th style="text-align:center">SubTotal: </th>
			<th style="text-align:center">'.number_format(@$total_sub,"3",",",".").'</th>';
	echo '</tr>';
	echo '</table>';
?>
</div>
