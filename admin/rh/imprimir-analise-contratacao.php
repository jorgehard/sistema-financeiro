<?php include("../config.php"); ?>
<script> 
	window.onload = function () {
		window.print();
		open(location, '_self').close();
	};
</script>

<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />

<style type="text/css">
.cabecalho {
	font-family: arial;
	font-size: 12px;
	font-weight: normal;
	font-style: normal;
	font-variant: normal;
	color: #003;
	line-height: normal;
	text-align: right;
}
.cabecalho22 {
	font-family: arial;
	font-size: 19px;
	font-weight: normal;
	font-style: normal;
	font-variant: normal;
	color: #003;
	line-height: normal;
	text-align: right;
}
.contratocenter {
	text-align: center;
}
.corpo {
	font-family: Arial;
	font-size: 27px;
	font-weight: normal;
	text-align: justify;
}
.center {
	text-align: justify;
	font-size: 12px;
}
</style>

<?php
$sql = mysql_query("select * from rh_funcionarios where id = $id");
while($l = mysql_fetch_array($sql)) { extract($l); $i_num = $id;  }
setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );
date_default_timezone_set( 'America/Sao_Paulo' );
$today = getdate(); 
$todayTotal = $today['year'].'-'.$today['mon'].'-'.$today['mday'];
$data_2 = mb_convert_encoding(strftime( '%A, %d de %B de %Y', strtotime($admissao)), "UTF-8");
$data_1 = mb_convert_encoding(strftime( '%A, %d de %B de %Y', strtotime($todayTotal)), "UTF-8");
?>
<body>
<table width="1027" border="0" id="transporte1">
  <tr>
    <td>
		<h2 align="left" style="padding-bottom:20px; border-bottom:1px solid #000;">
			<div class="cabecalho" >
				<table width="1062" border="0">
					<tr>
						<td style="padding:10px; text-align:center" width="10%"><img src="http://guaruja.polemicalitoral.com.br/imagens/logo.png" alt="Logo Polemica" width="80px" /></td>
						<td style="font-size:18px; padding-left:20px;" width="95%">
							<p class="pull-right" style="text-align: right; padding:10px 20px 10px 10px;">
								<b>POLÊMICA SERVIÇOS BÁSICOS LTDA.</b><br/>
								Rua Euclides Miragaia, 700, Salas 82 e 83 - Centro - CEP 12245-820 <br/>
								São José dos Campos - SP - TELEFAX (12) 3941-8555<br/>
								Inscrição Municipal Nº 66.133/3<br/>
								Inscrição Estadual - 645.412.590.115<br/>
							</p>
						</td>
					</tr>
				</table>
			</div>
		</h2>

      <br clear="all" />

	  <h2 class="contratocenter" style="font-family: 'Tahoma', sans-serif;">ANÁLISE PARA CONTRATAÇÃO DE CANDIDATO A VAGA</h2>

		<p>&nbsp;</p>


		<p>&nbsp;</p>
		<h1 class="corpo" style="font-size:23px;">
			<strong>Obra:</strong> <?php echo @mysql_result(mysql_query("select descricao from notas_obras WHERE id = '$obra'"),0,"descricao"); ?>
		</h1>
		<p>&nbsp;</p>
		<h1 class="corpo" style="font-size:23px;">
			<strong>Nome do candidato:</strong> <?php echo $nome; ?>
		</h1>
		<p>&nbsp;</p>
		<h1 class="corpo" style="font-size:23px;">
			<strong>Função:</strong> <?php echo @mysql_result(mysql_query("select descricao from rh_funcoes WHERE id = '$funcao'"),0,"descricao"); ?>
		</h1>
		<p>&nbsp;</p>
		<h1 class="corpo" style="font-size:23px;">
			<strong>Salário Proposto:</strong> R$ <?php echo number_format(mysql_result(mysql_query("select salario from rh_funcoes WHERE id = '$funcao'"),0,"salario"),2,",","."); ?>
		</h1>
		<p>&nbsp;</p>
		<h1 class="corpo" style="font-size:23px;">
			<strong>Data prevista para contratação:</strong> <?php echo implode("/",array_reverse(explode("-",$admissao))); ?>
		</h1>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		 <h1 class="corpo" style="font-size:23px;">
		 <?php 
		 if($motivo_imp == '0'){
			echo '<strong>(&nbsp;X&nbsp;)  Aumento de quadro&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;)  Substituição de funcionário </strong>';
		 }else{
			echo '<strong>(&nbsp;&nbsp;&nbsp;)  Aumento de quadro&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;X&nbsp;)  Substituição de funcionário </strong>';
		 }
		 ?>
		 </h1>
		 
		<p>&nbsp;</p>
		<h1 class="corpo" style="font-size:23px;">
			<strong>Observações:</strong> <br/><br/>
			<span><?php echo @mysql_result(mysql_query("SELECT mensagem FROM rh_funcionario_historico WHERE funcionario = '$id' ORDER BY id DESC LIMIT 1"),0,"mensagem");?></span>
		</h1>
		 
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<h1 class="corpo" style="font-size:23px;">
		<strong>(&nbsp;&nbsp;&nbsp;) Aprovado &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;) Não Aprovado </strong>
		</h1>
		
		<p>&nbsp;</p>
		 <h1 class="corpo"><p><?php echo ucfirst($data_2); ?> </p></h1>
		
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
	        <p><strong></strong><strong> </strong></p>
		<p class="corpo" style="font-size:20px">__________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                                          __________________________________<br />

        <strong>&nbsp;Responsável pela Obra                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;           </strong><strong>Aprovação diretoria</strong></p>
      <p><strong>&nbsp;</strong></p>
<p>&nbsp;</p>
		<p>&nbsp;</p><p>&nbsp;</p>
		<p>&nbsp;</p>
      </td>
  </tr>
</table>
</body>

</html>