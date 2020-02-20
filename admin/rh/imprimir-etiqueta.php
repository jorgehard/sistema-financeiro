<?php
	include("../config.php");
	include("../validar_session.php");
	getData();
	getNivel();
?>
<link rel="stylesheet" href="../../css/bootstrap.css" />
<script>window.print()</script>
<style type="text/css">
.etiqueta{
	font-weight:bold;
	text-align:center;
	font-size:10px;
	margin-top:5px;
	width:100%;
}
</style>
<table class="etiqueta">
        <?php
        $topo = mysql_query("select * from rh_funcionarios where id = $id");
        while ($l = mysql_fetch_array($topo)) { extract($l);
        echo '  
		<tr><td>Polêmica Serviços Básicos LTDA</td></tr>
		<tr><td>CNPJ: 61.870.101/0010-07</td></tr>
		<tr><td>Obra: '.mysql_result(mysql_query("select * from notas_obras where id = $obra"),0,"descricao").'</td></tr>
		<tr><td>Nome: '.$nome.'</td></tr>
		<tr><td>Função: '.mysql_result(mysql_query("select * from rh_funcoes where id = $funcao"),0,"descricao").'</td></tr>
		<tr><td style="padding-top:2px">Mês: '.$mes_nome.' &nbsp;&nbsp;&nbsp;&nbsp;Ano: '.$today['year'].'</td></tr>
		<tr><td style="padding-top:2px">Horario: Seg. a Qui. '.$trabalho_entrada.' as '.$trabalho_saida.'</td></tr>
		<tr><td>&nbsp;&nbsp;&nbsp; Sex. '.$sexta_entrada.' as '.$sexta_saida.'</td></tr>
		<tr><td>Descanso/Almoço: '.implode("as",explode("-",$trabalho_refeicao)).'</td></tr>';
		

        }

        ?>
</table>