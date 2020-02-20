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
while($l = mysql_fetch_array($sql)) { extract($l); $i_num = $id; $obs_num = $obs; }
?>
<div class="col-md-12" style="margin:0 auto; text-align:center; padding-bottom:30px; padding-top:10px;">
	<a href="#" class="button-class" onclick="javascript:window.close()">Fechar</a>
</div>
<table width="100%" border="1" cellpadding="3" cellspacing="1">
	<tr>
    	<td rowspan="2" align="center"><img src="http://guaruja.polemicalitoral.com.br/imagens/logo.png" width="70px;"></td>
        <td valign="middle"><h4 align="center">SOLICITAÇÃO DE NUMERÁRIO</h4></td>
    </tr>
    <tr>
        <td align="center"><strong>POLÊMICA SERVIÇOS BÁSICOS LTDA.</strong> | <strong>UNID/FILIAL:</strong> <?php echo mysql_result(mysql_query("select * from notas_obras where id = $obra"),0,"descricao"); ?> | <strong>DATA: </strong> <?php echo implode("/",array_reverse(explode("-",$data))); ?> | <strong>SOLICITAÇÃO Nº:</strong> <?php echo $numero; ?></td>

    </tr>

</table>

<table width="100%" border="1" cellpadding="3" cellspacing="1">

	<tr><th align="center" style="padding:10px">COMPRAS / FINANCEIRO</th></tr>

</table>

<table width="100%" border="1" cellpadding="3" cellspacing="1">

	<tr>

    	<th align="center">Nº </th>

        <th align="center">Nº NOTA</th>

        <th align="center">FAVORECIDO / FORMA DE PAGAMENTO</th>

        <th align="center">ARQUIVO XML</th>

		<th colspan="2" align="center">VALOR TOTAL:</th>

    </tr>
    <?php
	$u = 0;
	$co = 0;
	$query = mysql_query("select * from notas_numerario_itens where id_numerario = '$id' order by vencimento asc, numero asc");
	while($l = mysql_fetch_array($query)) { extract($l);
	$id_empresa = mysql_result(mysql_query("select * from notas_nf where id = $id_nota"),0,"empresa");
	$nome_empresa = mysql_result(mysql_query("select * from notas_empresas where id = $id_empresa"),0,"nome");
	$favorecido = mysql_result(mysql_query("select * from notas_empresas where id = $id_empresa"),0,"favorecido");
	$cnpj_favorecido = mysql_result(mysql_query("select * from notas_empresas where id = $id_empresa"),0,"cnpj_favorecido");
	$u += 1;;
	$co += 1;
	echo '<tr style="border-top:1px solid #000">';
	echo '<td align="center">'.$u.'</td>';
	echo '<td align="center">'.$numero.'</td>';
	echo '<td align="left">'.$nome_empresa.'<br>';
	if($obs == '' || $obs == 'EM BRANCO'){
		echo '<strong>-</strong>';
	}else{
		echo '<strong>'.$obs.'</strong>';
	}	
	echo '</td>';
	if(mysql_result(mysql_query("select * from notas_nf where id = '$id_nota'"),0,"dataxml") == '0000-00-00'){
		echo '<td align="center"> - </td>';
	}else{
		echo '<td align="center">'.implode("/",array_reverse(explode("-",mysql_result(mysql_query("select * from notas_nf where id = '$id_nota'"),0,"dataxml")))).'</td>';
	}
	echo '<td colspan="2" align="center" style="width:80px">R$ '.number_format($valor,"2",",",".").'</td>';
	echo '</tr>';
		$test = mysql_query("SELECT * FROM notas_nf_venc WHERE nota = $id_nota");

		$parcela = 0;

		echo '<tr>';

			echo '<th colspan="3">';
				//if($favorecido != '' && $cnpj_favorecido != ''){
					echo '<b>FAVORECIDO:</b>'.$favorecido.' - <b>CNPJ/CPF: '.$cnpj_favorecido.'</b>';
				//}
			echo '</th>';

			echo '<th>Parcela</th>';

			echo '<th>Valor:</th>';

			echo '<th>Vencimento:</th>';

		echo '<tr>';

		while($b = mysql_fetch_array($test)){

			$parcela += 1;

			$co += 1;

			echo '<tr>';

			echo '<td colspan="3"></td>';

			echo '<td align="center">'.$parcela.'x</td>';

			echo '<td align="center">R$ '.number_format($b['valor'],"2",",",".").' </td>';

			echo '<td align="center">'.implode("/",array_reverse(explode("-",$b['data']))).' </td>';

			echo '</tr>';

		}

        	

		@$total += $valor;



	}

	echo '<tr style="border:1px solid #000">';

	

		echo '<th colspan="4" align="center" style="font-size:13px">TOTAL</th>';

		echo '<th colspan="2" align="center" style="font-size:13px">R$ '.number_format($total,"2",",",".").'</th>';

	

	echo '</tr>';



	?>

    

    

    

    

</table>



<br>



<table width="100%" border="1" cellpadding="15">

    <tr>

    	<td width="30%">

		Enviado por: <?php echo mysql_result(mysql_query("SELECT * FROM usuarios WHERE id = ".$_SESSION['id_usuario_logado'].""),0,"nome"); ?>

		<br/><br/><br/>

		Data: <?php echo date("d/m/Y") ?>

		</td>

        <td width="30%">

		Recebido por: 

		<br/><br/><br/>

		Data: __/__/____

		</td>

        <td width="40%">

		Analisado por: 

		<br/><br/><br/>

		Data: __/__/____

		</td>      

    </tr>

</table>



<br/>

<?php if($obs_num != ''){

	echo '<table width="100%" border="1" cellpadding="15" cellspacing="1">

		<tr>

			<td>Observações: <br/>'.$obs_num.'</td>

		</tr>

	</table>';

}

?>