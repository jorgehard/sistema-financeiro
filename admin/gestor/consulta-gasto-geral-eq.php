<?php include("../config.php"); ?>
<script>
$(document).ready(function(){
	$(".btnPrint").printPage();
	$(function(){
		$("#myTable").tablesorter();
		
	});
});
</script>
	<h3 style="font-family: 'Oswald', sans-serif;letter-spacing:6px;">CONSULTA <small> - </small>

		<a href="#" onclick="ldy('gestor/testeee.php','.conteudo')" style="letter-spacing:5px; margin-top:10px; margin-right:10px;" class="hidden-xs hidden-print pull-right btn btn-info btn-sm"> 
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Cadastrar
		</a>
	</h3><hr/>

	<form action="javascript:void(0)" id="form1">
		<div class="well well-sm" style="padding:10px 10px 5px 10px;">
			<label>
				<input type="text" name="busca" placeholder="Digite algo para buscar" size="50" class="form-control input-sm">
			</label>
				<input type="submit" value="Pesquisar" onClick="post('#form1','gestor/testeee.php','.retorno')" class="btn btn-success btn-sm">
		</div>
	</form>
	<div class="resultado">
		<table class="table table-responsive table-condensed table-bordered small">
			<tr>
				<td colspan="5" >
					<p style="font-weight:bold; font-size:13px; float:left; margin:10px;">
					EMPRESA<br/>
					T.A COMÉRCIO E INSTALAÇÕES LTDA - ME <br/>
					CNPJ:&nbsp; &nbsp; 05.361.509/0001-83 <br/>
					REF: &nbsp; &nbsp; MEDIÇÃO 4<br/>
					PERIODO &nbsp; &nbsp; DE 01 Á 31 DE JANEIRO DE 2016 <br/>
					LOCAL &nbsp; &nbsp;  GUARUJÁ<br/>
					</p>
					
					<img src="../../imagens/logo.png" alt="Logo" style="float:left; margin:10px;" class="pull-right img-responsive" width="100px"/>
				</td>
			</tr>
			<tr>
				<td colspan="5" align="center" style="font-weight:bold">MEMORIA DE CALCULO - A RECEBER</td>
			</tr>
			<tr style="font-weight:bold">
				<td align="center">ITEM</td>
				<td align="center">DESCRIÇÃO</td>
				<td align="center">UNID</td>
				<td align="center">V. UNIT.</td>
				<td align="center">TOTAL</td>
			</tr>
			<tr>
				<td align="center">01.01</td>
				<td align="center">SUB-BASE EM BRITA OU MACADAME HIDRÁULICO (A)</td>
				<td align="center">3230,48</td>
				<td align="center">7,00</td>
				<td align="center">R$ 25.413,36</td>
			</tr>
			<tr>
				<td align="center">01.02</td>
				<td align="center">CAPA DE CONCRETO ASFALTICO (A)</td>
				<td align="center">3630,48</td>
				<td align="center">46,00</td>
				<td align="center">R$ 167.002,08</td>
			</tr>			
			<tr>
				<td align="center">01.03</td>
				<td align="center">HIDRÁULICO (A)</td>
				<td align="center">4630,48</td>
				<td align="center">21,00</td>
				<td align="center">R$ 532.002,08</td>
			</tr>			
			<tr>
				<td colspan="4" align="right">TOTAL:</td>
				<td align="center">R$ 000.000,00</td>
			</tr>
		</table>
	</div>
