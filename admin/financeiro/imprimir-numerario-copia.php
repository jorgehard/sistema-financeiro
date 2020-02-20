<?php 
include("../config.php");
include("../validar_session.php"); 
?>

<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />

<style>
* { font-family: Arial; font-size: 9px; }
table { border-collapse: collapse;  }
body { font-size: 12px; }

@media print{
	.col-md-12{
		display:none;
	}
}
.button-class{
	padding:10px 150px 10px 150px; 
	font-size:15px; 
	font-weight:bold; 
	margin-bottom:30px; 
	background:#8c2539; 
	text-decoration:none; 
	border-radius:5px;
	color:#FFF;
}
.button-class:hover{
	background-color:#541622;
}
</style>

<script> window.print()</script>

<?php
$sql = mysql_query("select * from notas_numerario where id = $id");
while($l = mysql_fetch_array($sql)) { extract($l); $i_num = $id; }
?>
<div class="col-md-12" style="margin:0 auto; text-align:center; padding-bottom:30px; padding-top:10px;">
	<a href="#" class="button-class" onclick="javascript:window.close()">Fechar</a>
</div>
<table width="100%" border="1" cellpadding="3" cellspacing="1">
	<tr>
    	<td rowspan="2" align="center"><img src="http://www.polemicalitoral.com.br/guaruja/imagens/logo.png" width="70px;"></td>
        <td valign="middle"><h4 align="center">SOLICITAÇÃO DE NUMERÁRIO (CÓPIA)</h4></td>
    </tr>
    <tr>
        <td align="center"><strong>POLÊMICA SERVIÇOS BÁSICOS LTDA.</strong> | <strong>UNID/FILIAL:</strong> <?php echo mysql_result(mysql_query("select * from notas_obras where id = $obra"),0,"descricao"); ?> | <strong>DATA: </strong> <?php echo implode("/",array_reverse(explode("-",$data))); ?> | <strong>SOLICITAÇÃO Nº:</strong> <?php echo $numero; ?></td>
    </tr>
</table>
<table width="100%" border="1" cellpadding="1" cellspacing="0">
	<tr><th align="center">COMPRAS / FINANCEIRO</th></tr>
</table>
    <?php
	$i = 1;
	$query = mysql_query("select * from notas_numerario_itens where id_numerario = '$id' order by vencimento asc, numero asc");
	while($l = mysql_fetch_array($query)) { extract($l);
	echo '<table width="100%" border="1" cellpadding="3" cellspacing="1">';
    $vencimento = implode("/",array_reverse(explode("-",$vencimento)));
	$id_empresa = mysql_result(mysql_query("select * from notas_nf where id = $id_nota"),0,"empresa");
	$obra_nota = mysql_result(mysql_query("select * from notas_nf where id = $id_nota"),0,"obra");
	$nome_empresa = mysql_result(mysql_query("select * from notas_empresas where id = $id_empresa"),0,"nome");
	$u = $i++;
		echo '<tr>';
		echo '<td align="center">'.$u.'</td>';
        echo '<td align="center">'.$numero.'</td>';
		echo '<td align="left" colspan="3">'.$nome_empresa.'</td>';
		echo '<td align="center">'.mysql_result(mysql_query("select * from notas_nf where id = '$id_nota'"),0,"observacoes").'</td>';
		echo '<td align="center">'.$vencimento.'</td>';
        echo '<td align="center" style="width:80px">R$ '.number_format($valor,"2",",",".").'</td>';
        echo '</tr>';
        echo '<tr class="small" style="background:#CCC;">

                		<th>OBRA:</th>

                        <th>CATEGORIA:</th>

                        <th colspan="2">MATERIAL/ITEM:</th>

                        <th>EQUIPE:</th>

                        <th>QUANTIDADE:</th>

                        <th>V. UN:</th>

                        <th>TOTAL:</th>

              		  </tr>';
		$itens_nota = mysql_query("select * from notas_itens_add where nota = $id_nota");
        while($l = mysql_fetch_array($itens_nota)) { 
        $descontovalor = $l['valor'] - $l['desconto'];
		$subtotal = $l['quantidade'] * $descontovalor;
        $saldo_materiais = mysql_query("SELECT * FROM `notas_retirada_itens`  where quantidade = id_nota");
		$entradas = mysql_result(mysql_query("select *, sum(quantidade) as total from notas_itens_add where nota = $id"),0,"total");
		$saidas = @mysql_result(mysql_query("select *, sum(notas_retirada_itens.quantidade) as total from notas_retirada_itens, notas_retirada where notas_retirada_itens.id_retirada = notas_retirada.id and  notas_retirada_itens.id_item = $id and notas_retirada.tipo = 1"),0,"total");
		$devolucoes = @mysql_result(mysql_query("select *, sum(notas_retirada_itens.quantidade) as total from notas_retirada_itens, notas_retirada where notas_retirada_itens.id_retirada = notas_retirada.id and  notas_retirada_itens.id_item = $id and notas_retirada.tipo = 2"),0,"total");
		$saidas_total = $saidas-$devolucoes;
		$saldo = $entradas-$saidas_total;
		echo '<tr class="small">';
		echo '<td>'.mysql_result(mysql_query("select * from notas_obras where id = $obra_nota"),0,"descricao").'</td>';

		echo '<td width="100px">'.@mysql_result(mysql_query("select * from notas_categorias where id = $l[categoria]"),0,"descricao").'&nbsp;'.@mysql_result(mysql_query("select * from notas_equipamentos where id = $l[equipamento]"),0,"placa").'</td>';
		if($l['categoria'] == '20'){
			echo '<td width="150px" colspan="2">'.@mysql_result(mysql_query("select * from notas_equipamentos where id = $l[item]"),0,"marca").' Placa: ('.@mysql_result(mysql_query("select * from notas_equipamentos where id = $l[item]"),0,"placa").')</td>';
		}else{
			echo '<td width="150px" colspan="2">'.@mysql_result(mysql_query("select * from notas_itens where id = $l[item]"),0,"descricao").'</td>';
		}
		echo '<td>'.@mysql_result(mysql_query("select * from equipes where id = $l[equipe]"),0,"nome").'</td>';
		echo '<td width="10px" align="center">'.number_format($l['quantidade'],"2").'</td>';
		echo '<td width="10px" align="center">R$'.number_format($l['valor'],"2",",",".").'</td>';
		echo '<td width="10px" align="center">R$'.number_format($subtotal,"2",",",".").'</td>';
		echo '</tr>';
		echo '<tr><td colspan="2"><center><b>Observacoes:</b></center></td><td colspan="6">'.$l['observacoes'].'</td></tr>';
	}
	@$total += $valor;
	echo '</table><br/>';
}
echo '<table><tr>';
echo '<th colspan="4" align="center">TOTAL</th>';
echo '<th colspan="2" align="center">R$ '.number_format($total,"2",",",".").'</th>';
echo '</tr></table>';
?>
</table>
<br>
<table width="100%" border="1" cellpadding="15" cellspacing="1">
	<tr>
		<td valign="top" width="30%" style="border-bottom: 1px solid #FFF;">Enviado por: <?php echo mysql_result(mysql_query("SELECT * FROM usuarios WHERE id = ".$_SESSION['id_usuario_logado'].""),0,"nome"); ?><br/></td>
        <td valign="top" width="30%" style="border-bottom: 1px solid #FFF;">Recebido por: </td>
        <td valign="top" width="40%" style="border-bottom: 1px solid #FFF;">Analisado por: </td>
	</tr>
    <tr>
    	<td valign="bottom">DATA: <?php echo date("d/m/Y") ?></td>
        <td valign="bottom">DATA: </td>
        <td valign="bottom">DATA: </td>
    </tr>
</table>

