<?php 
include("../config.php");
include("../validar_session.php");
date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_MONETARY,"pt_BR", "ptb");
$today = getdate(); 

	if($today['mon'] < 10) { 
		$today['mon'] = '0'.$today['mon'];
	} else { 
		$today['mon'] = $today['mon'];
	} 
	if($today['mday'] < 10){ 
		$today['mday'] = '0'.$today['mday']; 
	}else{ 
		$today['mday'] = $today['mday']; 
	}  
	$todayTotal = $today['year'].'-'.$today['mon'].'-'.$today['mday'];
	$inicioMes = $today['year'].'-'.$today['mon'].'-01';
?>

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
<div style="page-break-after: always">
        <table width="1062" border="0">
         
          <tr>
            <td width="100" height="120"><img src="http://guaruja.polemicalitoral.com.br/imagens/logo.png" width="90" height="110"></td>
            <td width="899" class="cabecalho22"><p>Polêmica Serviços Básicos Ltda<br />
			Rua Attílio Gelsomini. 210 - galpão A - Vila Santa Rosa - CEP: 11431-130<br />
			Guarujá - São Paulo<br />
			Tel.      (013) 3351.1037<br />
			E-MAIL:      rh.guaruja@polemicaconstrutora.com.br <br />
			SITE:      www.polemicaconstrutora.com.br</p></td>

          </tr>

      </table>
		<h1>_____________________________________________________________________________________</h1>
        <h4 align="center">&nbsp;</h4>
      &nbsp;&nbsp;</h2>
      <br clear="all" />

      <h2 class="contratocenter">RECIBO DE DEVOLUÇÃO DE CTPS</h2>

      <p>&nbsp;</p>

      <p>&nbsp;</p>

     <h1 class="corpo"> <p>Declaramos para os devidos fins, que  nesta data, recebi em devolução  a minha  Carteira de Trabalho e Previdência Social nº <strong>055068  </strong>SÉRIE<strong> 00390</strong>, devidamente registrada na empresa Polêmica Serviços  Básicos Ltda.</p>

      <p>SÃO JOSÉ DOS CAMPOS, <?php echo strtoupper($data_2); ?> </p>

<h1 class="corpo">&nbsp;</h1>

      <p>&nbsp;</p>

      <p>&nbsp;</p>

	        <p><strong></strong><strong> </strong></p>

	

      <p>______________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                                            __________________________________________<br />

        <strong>POLÊMICA SERVIÇOS  BÁSICOS LTDA                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;             </strong><strong><?php echo $nome ?></strong></p>

      <p><strong>&nbsp;</strong></p>

      <p>____________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;____________________________________________<br />

        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Testemunha                                                                                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     Responsável (qdo. Menor)</p></td>

  </tr>

</table>
</div>
