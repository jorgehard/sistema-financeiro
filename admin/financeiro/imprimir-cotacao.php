<?php
	require_once("../config.php");
	require_once("../validar_session.php");
	getData();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<title></title>
	<meta name="generator" content="LibreOffice 5.3.7.2 (Linux)"/>
	<meta name="author" content="Valdinei"/>
	<meta name="created" content="2018-01-25T09:06:06"/>
	<meta name="changedby" content="Jorge -"/>
	<meta name="changed" content="2018-01-25T10:41:53"/>
	<meta name="AppVersion" content="16.0300"/>
	<meta name="DocSecurity" content="0"/>
	<meta name="HyperlinksChanged" content="false"/>
	<meta name="LinksUpToDate" content="false"/>
	<meta name="ScaleCrop" content="false"/>
	<meta name="ShareDoc" content="false"/>
	<script>
		window.onload = function () {
			window.print();
		}
	</script>
	<style type="text/css">
		body,div,table,thead,tbody,tfoot,tr,th,td,p { font-family:"Calibri"; font-size:x-small }
		a.comment-indicator:hover + comment { background:#ffd; position:absolute; display:block; border:1px solid black; padding:0.5em;  } 
		a.comment-indicator { background:red; display:inline-block; border:1px solid black; width:0.5em; height:0.5em;  } 
		comment { display:none;  } 
	</style>
	
</head>

<body>
<?php

$sql = mysql_query("SELECT * FROM cadastro_cotacao WHERE id = '$id'");
while($xu = mysql_fetch_array($sql)){ extract($xu); }
?>
<table cellspacing="0" border="0">
	<colgroup width="48"></colgroup>
	<colgroup span="2" width="64"></colgroup>
	<colgroup span="3" width="70"></colgroup>
	<colgroup span="3" width="107"></colgroup>
	<tr>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000" colspan=2 rowspan=5 height="102" align="center" valign=bottom><font face="Arial" color="#000000"><br><img src="http://freatsistemas.com.br/polemica/imagens/logo.png" width=77 height=89 hspace=18 vspace=8>
		</font></td>
		<td style="border-top: 2px solid #000000; border-right: 2px solid #000000" colspan=7 align="right" valign=bottom bgcolor="#FFFFFF"><b><font face="Arial" size=1 color="#000000">POLÊMICA SERVIÇOS BÁSICOS LTDA.</font></b></td>
		</tr>
	<tr>
		<td style="border-right: 2px solid #000000" colspan=7 align="right" valign=bottom bgcolor="#FFFFFF"><font face="Arial" size=1 color="#000000">Rua Euclides Miragaia, 700, Salas 82 e 83 - Centro - CEP 12245-820&nbsp;</font></td>
		</tr>
	<tr>
		<td style="border-right: 2px solid #000000" colspan=7 align="right" valign=bottom bgcolor="#FFFFFF"><font face="Arial" size=1 color="#000000">São José dos Campos - SP - TELEFAX (12) 3941-8555</font></td>
		</tr>
	<tr>
		<td style="border-right: 2px solid #000000" colspan=7 align="right" valign=bottom bgcolor="#FFFFFF"><font face="Arial" size=1 color="#000000">Inscrição Municipal Nº 66.133/3</font></td>
		</tr>
	<tr>
		<td style="border-bottom: 2px solid #000000; border-right: 2px solid #000000" colspan=7 align="right" valign=bottom bgcolor="#FFFFFF"><font face="Arial" size=1 color="#000000">Inscrição Estadual - 645.412.590.115</font></td>
		</tr>
	<tr>
		<td colspan=9 height="8" align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		</tr>
	<tr>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000" colspan=9 rowspan=2 height="41" align="center" valign=middle><b><font size=5 color="#000000">COTAÇÃO</font></b></td>
		</tr>
	<tr>
		</tr>
	<tr>
		<td height="8" align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
	</tr>
	<tr>
        <?php if($tipo_cotacao == '1'){
            $tipo01 = 'X';
            $tipo02 = '&nbsp;&nbsp;&nbsp;';
            $tipo03 = '&nbsp;&nbsp;&nbsp;';
        }else if($tipo_cotacao == '2'){
            $tipo01 = '&nbsp;&nbsp;&nbsp;';
            $tipo02 = 'X';
            $tipo03 = '&nbsp;&nbsp;&nbsp;';
        }else if($tipo_cotacao == '3'){
            $tipo01 = '&nbsp;&nbsp;&nbsp;';
            $tipo02 = '&nbsp;&nbsp;&nbsp;';
            $tipo03 = 'X';
        }
        ?>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000;" colspan=3 height="25" align="center" valign=middle bgcolor="#99CCFF"><b><font size=4 color="#000000">(<?php echo $tipo01 ?>) MATERIAL</font></b></td>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000;" colspan=4 align="center" valign=middle bgcolor="#99CCFF"><b><font size=4 color="#000000">(<?php echo $tipo02 ?>) PRESTAÇÃO DE SERVIÇO</font></b></td>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000" colspan=2 align="center" valign=middle bgcolor="#99CCFF"><b><font size=4 color="#000000">(<?php echo $tipo03 ?>) EQUIPAMENTOS</font></b></td>
		</tr>
	<tr>
		<td height="8" align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
	</tr>
	<tr>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000" rowspan=2 height="41" align="center" valign=middle bgcolor="#99CCFF"><b><font color="#000000">DATA:</font></b></td>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000" colspan=4 rowspan=2 align="center" valign=middle sdval="43124" sdnum="1033;1033;M/D/YYYY"><b><font color="#000000">
		<?php echo implode("/", array_reverse(explode("-", $data_cotacao))); ?></font></b></td>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000" colspan=2 rowspan=2 align="center" valign=middle bgcolor="#99CCFF"><b><font color="#000000">SOLICITANTE:</font></b></td>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000" colspan=2 rowspan=2 align="center" valign=middle><b><font color="#000000"><?php echo $solicitante; ?></font></b></td>
		</tr>
	<tr>
		</tr>
	<tr>
		<td height="8" align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
	</tr>
	<tr>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000" colspan=2 height="21" align="center" valign=bottom bgcolor="#99CCFF"><b><font color="#000000">DESTINAÇÃO:</font></b></td>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000;" colspan=3 align="center" valign=bottom><b><font color="#000000"></font></b></td>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000;" colspan=2 align="center" valign=bottom><b><font color="#000000"><?php echo mysql_result(mysql_query("SELECT * FROM notas_obras_cidade WHERE id = '$cidade'"),0,"nome"); ?></font></b></td>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 2px solid #000000" colspan=2 align="center" valign=bottom><b><font color="#000000"></font></b></td>
		</tr>
	<tr>
		<td height="8" align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" colspan=2 height="21" align="center" valign=center bgcolor="#8EB4E3"><b><font face="Arial" color="#000000">DESCRIÇÃO</font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; " colspan=3 align="center" valign=center bgcolor="#8EB4E3"><b><font face="Arial" color="#000000">EMPRESA</font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; " align="center" valign=center bgcolor="#8EB4E3"><b><font face="Arial" color="#000000">CONTATO</font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="center" valign=center bgcolor="#8EB4E3"><b><font face="Arial" color="#000000">TELEFONE</font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="center" valign=center bgcolor="#8EB4E3"><b><font face="Arial" color="#000000">FORMA PAGAMENTO</font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=center bgcolor="#8EB4E3"><b><font face="Arial" color="#000000">PRAZO</font></b></td>
	</tr>
	<tr>
		<td height="7" align="center" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="center" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="center" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="center" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="center" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="center" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="center" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="center" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="center" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000;" colspan=2 height="20" align="center" valign=middle><font face="Arial" size=1 color="#000000">FORNECEDOR - 01</font></td>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000;" colspan=3 align="center" valign=middle><font color="#000000"><?php echo mysql_result(mysql_query("SELECT * FROM notas_empresas WHERE id = '$fornecedor01'"),0,"nome") ?></font></td>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000;" align="center" valign=middle><font face="Arial" color="#000000"><?php echo mysql_result(mysql_query("SELECT * FROM notas_empresas WHERE id = '$fornecedor01'"),0,"contato") ?></font></td>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000;" align="center" valign=middle><font face="Arial" color="#000000"><?php echo mysql_result(mysql_query("SELECT * FROM notas_empresas WHERE id = '$fornecedor01'"),0,"telefone_1")?></font></td>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000;" align="center" valign=middle><font face="Arial" color="#000000"><?php echo $forma_pagamento01; ?></font></td>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle><font face="Arial" color="#000000"><?php echo implode("/", array_reverse(explode("-", $prazo01))); ?></font></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000;" colspan=2 height="20" align="center" valign=middle><font face="Arial" size=1 color="#000000">FORNECEDOR - 02</font></td>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000;" colspan=3 align="center" valign=middle><font color="#000000"><?php echo mysql_result(mysql_query("SELECT * FROM notas_empresas WHERE id = '$fornecedor02'"),0,"nome") ?></font></td>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000;" align="center" valign=middle><font face="Arial" color="#000000"><?php echo mysql_result(mysql_query("SELECT * FROM notas_empresas WHERE id = '$fornecedor02'"),0,"contato") ?></font></td>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000;" align="center" valign=middle><font face="Arial" color="#000000"><?php echo mysql_result(mysql_query("SELECT * FROM notas_empresas WHERE id = '$fornecedor02'"),0,"telefone_1")?></font></td>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000;" align="center" valign=middle><font face="Arial" color="#000000"><?php echo $forma_pagamento02; ?></font></td>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle><font face="Arial" color="#000000"><?php echo implode("/", array_reverse(explode("-", $prazo02))); ?></font></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" colspan=2 height="20" align="center" valign=middle><font face="Arial" size=1 color="#000000">FORNECEDOR - 03</font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" colspan=3 align="center" valign=middle><font color="#000000"><?php echo mysql_result(mysql_query("SELECT * FROM notas_empresas WHERE id = '$fornecedor03'"),0,"nome") ?></font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="center" valign=middle><font face="Arial" color="#000000"><?php echo mysql_result(mysql_query("SELECT * FROM notas_empresas WHERE id = '$fornecedor03'"),0,"contato") ?></font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="center" valign=middle><font face="Arial" color="#000000"><?php echo mysql_result(mysql_query("SELECT * FROM notas_empresas WHERE id = '$fornecedor03'"),0,"telefone_1")?></font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="center" valign=middle><font face="Arial" color="#000000"><?php echo $forma_pagamento03; ?></font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle><font face="Arial" color="#000000"><?php echo implode("/", array_reverse(explode("-", $prazo03))); ?></font></td>
	</tr>
	<tr>
		<td height="8" align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; width:3%; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" height="36" align="center" valign=middle bgcolor="#99CCFF"><b><font color="#000000">ITEM </font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="center" valign=middle bgcolor="#99CCFF"><b><font color="#000000">DESCRIÇÃO</font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="center" valign=middle bgcolor="#99CCFF"><b><font color="#000000">QTD</font></b></td>
		
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; text-align:center" colspan="2" align="left" valign=middle bgcolor="#99CCFF"><b><font color="#000000">FORNEC.01</font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; text-align:center" colspan="2" align="left" valign=middle bgcolor="#99CCFF"><b><font color="#000000">FORNEC.02</font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:center" colspan="2" align="left" valign=middle bgcolor="#99CCFF"><b><font color="#000000">FORNEC.03</font></b></td>
	</tr>	
	<tr>
		<td style="border-left: 1px solid #000000;" align="center" valign=middle bgcolor="#99CCFF" colspan="3"></td>
		
		<td style="border-left: 1px solid #000000; text-align:center" align="left" valign=middle bgcolor="#99CCFF"><b><font color="#000000">VLR UN.</font></b></td>
		<td style="border-left: 1px solid #000000; text-align:center" align="left" valign=middle bgcolor="#99CCFF"><b><font color="#000000">TOTAL</font></b></td>
		<td style="border-left: 1px solid #000000; text-align:center" align="left" valign=middle bgcolor="#99CCFF"><b><font color="#000000">VLR UN.</font></b></td>
		<td style="border-left: 1px solid #000000; text-align:center" align="left" valign=middle bgcolor="#99CCFF"><b><font color="#000000">TOTAL</font></b></td>
		<td style="border-left: 1px solid #000000; text-align:center" align="left" valign=middle bgcolor="#99CCFF"><b><font color="#000000">VLR UN.</font></b></td>
		<td style="border-left: 1px solid #000000; text-align:center; border-right:1px solid #000" align="left" valign=middle bgcolor="#99CCFF"><b><font color="#000000">TOTAL</font></b></td>
	</tr>
	<!--
	<tr>
		<td height="7" align="left" valign=bottom bgcolor="#FFFFFF"><b><font size=1 color="#000000"><br></font></b></td>
		<td align="center" valign=bottom bgcolor="#FFFFFF"><b><font size=1 color="#000000"><br></font></b></td>
		<td align="center" valign=bottom bgcolor="#FFFFFF"><b><font size=1 color="#000000"><br></font></b></td>
		<td align="center" valign=bottom bgcolor="#FFFFFF"><b><font size=1 color="#000000"><br></font></b></td>
		<td align="center" valign=bottom bgcolor="#FFFFFF"><b><font size=1 color="#000000"><br></font></b></td>
		<td align="left" valign=bottom bgcolor="#FFFFFF"><b><font size=1 color="#000000"><br></font></b></td>
		<td align="left" valign=bottom bgcolor="#FFFFFF"><b><font size=1 color="#000000"><br></font></b></td>
		<td align="left" valign=bottom bgcolor="#FFFFFF"><b><font size=1 color="#000000"><br></font></b></td>
		<td align="center" valign=bottom bgcolor="#FFFFFF"><b><font size=1 color="#000000"><br></font></b></td>
	</tr>
	<!-- -- -->
	<?php
		$sql_cotacao = mysql_query("SELECT * FROM cadastro_cotacao_itens WHERE id_cotacao = '$id'");
		while($lx = mysql_fetch_array($sql_cotacao)) { 
			$se += 1;
			if($tipo_cotacao == '1'){
				$item_descricao = mysql_result(mysql_query("select * from notas_itens where id = '".$lx['item']."'"),0,"descricao").'</td>';
			}else if($tipo_cotacao == '2'){
				$item_descricao = mysql_result(mysql_query("select * from notas_itens where id = '".$lx['item']."'"),0,"descricao").'</td>';
			}else if($tipo_cotacao == '3'){
				$item_descricao = mysql_result(mysql_query("select * from notas_itens where id = '".$lx['item']."'"),0,"descricao").'</td>';
			}
	?>
	<tr>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000;" height="20" align="center" valign=bottom bgcolor="#99CCFF"><font color="#000000"><?php echo $se ?></font></td>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000;" align="center" valign=bottom><font color="#000000"><?php echo $item_descricao ?></font></td>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000;" align="center" valign=center><font color="#000000"><?= $lx['qtd']; ?></font></td>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000;" align="right" valign=bottom sdval="180" sdnum="1033;0;_-&quot;R$&quot; * #,##0.00_-;-&quot;R$&quot; * #,##0.00_-;_-&quot;R$&quot; * &quot;-&quot;??_-;_-@_-"><font color="#000000"> <?php echo 'R$ '.number_format($lx['vlr_fornecedor01'],"2",",",".") ?></font></td>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000;" align="right" valign=bottom sdval="180" sdnum="1033;0;_-&quot;R$&quot; * #,##0.00_-;-&quot;R$&quot; * #,##0.00_-;_-&quot;R$&quot; * &quot;-&quot;??_-;_-@_-"><font color="#000000"> <?php echo 'R$ '.number_format($lx['vlr_fornecedor01']*$lx['qtd'],"2",",",".") ?></font></td>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000;" align="right" valign=bottom sdval="190" sdnum="1033;0;_-&quot;R$&quot; * #,##0.00_-;-&quot;R$&quot; * #,##0.00_-;_-&quot;R$&quot; * &quot;-&quot;??_-;_-@_-"><font color="#000000"> <?php echo 'R$ '.number_format($lx['vlr_fornecedor02'],"2",",",".") ?></font></td>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000;" align="right" valign=bottom sdval="190" sdnum="1033;0;_-&quot;R$&quot; * #,##0.00_-;-&quot;R$&quot; * #,##0.00_-;_-&quot;R$&quot; * &quot;-&quot;??_-;_-@_-"><font color="#000000"> <?php echo 'R$ '.number_format($lx['vlr_fornecedor02']*$lx['qtd'],"2",",",".") ?></font></td>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000;" align="right" valign=bottom sdval="200" sdnum="1033;0;&quot;R$&quot; #,##0.00;[RED]-&quot;R$&quot; #,##0.00"><font color="#000000"><?php echo 'R$ '.number_format($lx['vlr_fornecedor03'],"2",",",".") ?></font></td>
		
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="right" valign=bottom sdval="200" sdnum="1033;0;&quot;R$&quot; #,##0.00;[RED]-&quot;R$&quot; #,##0.00"><font color="#000000"><?php echo 'R$ '.number_format($lx['vlr_fornecedor03']*$lx['qtd'],"2",",",".") ?></font></td>
	</tr>
	<?php	
			$total_qtd += $lx['qtd'];
			$total_fornecedor01 += $lx['vlr_fornecedor01']*$lx['qtd'];
			$total_fornecedor02 += $lx['vlr_fornecedor02']*$lx['qtd'];
			$total_fornecedor03 += $lx['vlr_fornecedor03']*$lx['qtd'];
		}	
	?>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" colspan=2 align="center" valign=center><b><font color="#000000">TOTAL</font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="center" valign=center ><font color="#000000"> <?= $total_qtd; ?></font></td>
		
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" colspan=2 align="center" valign=center sdval="180" sdnum="1033;0;_-&quot;R$&quot; * #,##0.00_-;-&quot;R$&quot; * #,##0.00_-;_-&quot;R$&quot; * &quot;-&quot;??_-;_-@_-"><font color="#000000"> <?php echo 'R$ '.number_format($total_fornecedor01,"2",",",".") ?></font></td>
		
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;" colspan=2 align="center" valign=center sdval="190" sdnum="1033;0;_-&quot;R$&quot; * #,##0.00_-;-&quot;R$&quot; * #,##0.00_-;_-&quot;R$&quot; * &quot;-&quot;??_-;_-@_-"><font color="#000000"> <?php echo 'R$ '.number_format($total_fornecedor02,"2",",",".") ?></font></td>
		
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=center sdval="200" sdnum="1033;0;&quot;R$&quot; #,##0.00;[RED]-&quot;R$&quot; #,##0.00"><font color="#000000"><?php echo 'R$ '.number_format($total_fornecedor03,"2",",",".") ?></font></td>
		
	</tr>
	<!-- -- -->
	<tr>
		<td height="7" align="center" valign=bottom><b><font size=1 color="#000000"><br></font></b></td>
		<td align="center" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="center" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="center" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="center" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="center" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="center" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="center" valign=bottom><font face="Arial" size=1 color="#000000"><br></font></td>
		<td align="center" valign=bottom><b><font size=1 color="#000000"><br></font></b></td>
	</tr>
	<tr>
		<td height="21" align="center" valign=bottom><b><font color="#000000"><br></font></b></td>
		<td align="center" valign=bottom><font face="Arial" color="#000000"><br></font></td>
		<td align="center" valign=bottom><font face="Arial" color="#000000"><br></font></td>
		<td align="center" valign=bottom><font face="Arial" color="#000000"><br></font></td>
		<td align="center" valign=bottom><font face="Arial" color="#000000"><br></font></td>
		<td align="center" valign=bottom><font face="Arial" color="#000000"><br></font></td>
		<td align="center" valign=bottom><font face="Arial" color="#000000"><br></font></td>
		<td align="center" valign=bottom><font face="Arial" color="#000000"><br></font></td>
		<td align="center" valign=bottom><b><font color="#000000"><br></font></b></td>
	</tr>
	<tr>
		<td style="border-top: 2px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000" colspan=3 height="22" align="center" valign=center bgcolor="#99CCFF"><b><font color="#000000">Carimbo/Visto Solicitante</font></b></td>
		<td align="left" valign=bottom><font face="Arial" color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" color="#000000"><br></font></td>
		<td style="border-top: 2px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000" colspan=3 align="center" valign=center bgcolor="#99CCFF"><b><font color="#000000">Carimbo/Visto GESTOR</font></b></td>
		</tr>
	<tr>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000" colspan=3 rowspan=4 height="82" align="center" valign=bottom><font face="Arial" color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" color="#000000"><br></font></td>
		<td align="left" valign=bottom><font face="Arial" color="#000000"><br></font></td>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000" colspan=3 rowspan=4 align="center" valign=bottom><font face="Arial" color="#000000"><br></font></td>
		</tr>
	<tr>
		<td align="left" valign=bottom><font color="#000000"><br></font></td>
		<td align="left" valign=bottom><font color="#000000"><br></font></td>
		<td align="left" valign=bottom><font color="#000000"><br></font></td>
		</tr>
	<tr>
		<td align="left" valign=bottom><font color="#000000"><br></font></td>
		<td align="left" valign=bottom><font color="#000000"><br></font></td>
		<td align="left" valign=bottom><font color="#000000"><br></font></td>
		</tr>
	<tr>
		<td align="left" valign=bottom><font color="#000000"><br></font></td>
		<td align="left" valign=bottom><font color="#000000"><br></font></td>
		<td align="left" valign=bottom><font color="#000000"><br></font></td>
		</tr>
</table>
<!-- ************************************************************************** -->
</body>

</html>