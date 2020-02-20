<?php include("../config.php"); ?>

<script>//window.print()</script>

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
$data_2 = strftime( '%A, %d de %B de %Y', strtotime( $admissao) );
?>

<body>
<div style="page-break-after: always; font-size: 36px;">
<table width="1027" border="0">
  <tr>
    <td><table width="1062" border="0">
      <tr>
        <td width="100" height="120"><img src="http://guaruja.polemicalitoral.com.br/imagens/logo.png" width="90" height="110"></td>
        <td width="899" class="cabecalho22">Polêmica Serviços Básicos Ltda<br />
        Rua Attílio Gelsomini. 210 - galpão A - Vila Santa Rosa - CEP: 11431-130<br />
        Guarujá - São Paulo<br />
          Tel.      (013) 3351.1037<br />
          E-MAIL:      rh.guaruja@polemicaconstrutora.com.br <br />
          SITE:      www.polemicaconstrutora.com.br</td>
      </tr>
    </table>
      <h2 align="left">&nbsp;&nbsp;____________________________________________________________________________________</h2>
      <p>&nbsp;</p>
      <p class="corpo">Guarujá,  <?php echo strtoupper($data_2); ?></p>
      <p class="corpo">Ao Banco Itaú S/A <br>
        Guarujá - SP</p>
      <p>&nbsp;</p>
      <p class="corpo">Solicitamos a abertura de <strong>conta corrente</strong> para o funcionário,  conforme dados descritos abaixo: </p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p class="corpo">Nome COSME VIEIRA DE CARVALHO <br>
        RG<strong>: </strong>56.880.658-X<br>
        CPF: 280.892.698-77      </p>
      <p class="corpo">Endereço Residencial:<br>
        RUA PRATA, 304, BAIRRO: VILA BALNEARIO <br>
        CIDADE: PRAIA GRANDE- SP <br>
        CEP: 11.707-410<br>
        Renda Mensal: R$ 1.500,00</p>
      <p align="center">&nbsp;</p>
      <p align="center" class="corpo">Atenciosamente,</p>
      <p align="center" class="corpo">&nbsp;</p>
      <p align="center" class="corpo">&nbsp;</p>
    <p align="center" class="corpo"><strong> <center> Polêmica Serviços Básicos Ltda</strong><br>
        <strong>CNPJ: 61.870.101/0001-08</strong></center></p>
      <p align="center" class="corpo"><strong>&nbsp;</strong></p>
      <p align="center" class="corpo"><strong>&nbsp;</strong></p>
      <p class="corpo">Confirmação  de dados com o RH – Tel.: (13)3351.1037<br>
      e-mail: <a href="mailto:rh.guaruja@polemicaconstrutora.com.br">rh.guaruja@polemicaconstrutora.com.br</a></p> </center></td>

  </tr>

</table>

</div>
<div style="page-break-after: always">

<table width="1027" border="0">

   <tr>

    <td><h2 align="left">
      <div class="cabecalho">
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
        <h4 align="right">&nbsp;</h4>
      </div>
      &nbsp;&nbsp;____________________________________________________________________________________</h2>
      <p>&nbsp;</p>
      <p class="corpo">Guarujá, <?php echo strtoupper($data_2); ?></p>
      <p class="corpo">Á</p>
      <p class="corpo">Clinica Médico Clinasma</p>
      <p class="corpo">Rua Benjamin Constant, 357 - Centro</p>
      <p class="corpo">Guarujá - SP</p>
      <p>&nbsp;</p>
      <p class="corpo">Solicitamos  o atestado de saúde ocupacional (ASO) <strong>ADMISSIONAL </strong><strong>PERIODICO ANUAL</strong> do funcionário,  conforme dados descritos abaixo do funcionário,  conforme dados descritos abaixo: </p>
      <p>&nbsp;</p>
      <p class="corpo">Nome <?php echo $nome; ?>  <br>
        RG<strong>: <?php echo $rg; ?> </strong><br>
        FUNÇÃO: <?php echo @mysql_result(mysql_query("select * from cargos where id = $funcao"),0,"descricao"); ?> </p>
      <p class="corpo">Endereço Residencial:<br>
        <?php echo $endereco; ?><br>
        Renda Mensal: R$ 1.500,00</p>
      <p align="center">&nbsp;</p>
      <p align="center" class="corpo">Atenciosamente,</p>
      <p align="center" class="corpo">&nbsp;</p>
      <p align="center" class="corpo">&nbsp;</p>
      <p align="center" class="corpo"><strong>
        <center>
          Polêmica Serviços Básicos Ltda</strong><br>
          <strong>CNPJ: 61.870.101/0001-08</strong>
        </center>
      </p>
      <p align="center" class="corpo"><strong>&nbsp;</strong></p>
      <p align="center" class="corpo"><strong>&nbsp;</strong></p>
      <p class="corpo">Confirmação  de dados com o RH – Tel.: (13)3351.1037<br>
      e-mail: <a href="mailto:rh.guaruja@polemicaconstrutora.com.br">rh.guaruja@polemicaconstrutora.com.br</a></p>      <h2 class="contratocenter">&nbsp;</h2></td>

  </tr>
</table>
</div>

<table width="1027" border="0">
  <tr>
    <td><h2 align="left">
      <div class="cabecalho">
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

        <h4 align="right">&nbsp;</h4>

      </div>

      &nbsp;&nbsp;____________________________________________________________________________________</h2>

      <br clear="all" />

      <h2 class="contratocenter">DECLARAÇÃO DE BENEFICIÁRIO DE VALE TRANSPORTE</h2>

      <p>&nbsp;</p>

      <p>&nbsp;</p>

      <h1 class="corpo">(    ) Opto pela utilização do Vale Transporte</h1>

      <p class="corpo">(    ) Não opto pela utilização do Vale  Transporte      </p>

      <h1 class="corpo">Eu  declaro para efeitos do benefício do vale transporte:</h1>

      <p class="corpo"><br />

        1º)  Meu endereço residencial:<strong> <?php echo $endereco ?> </strong></p>

      <p class="corpo">2º)  Os meios de transporte coletivo, público e regular que a meu ver, são os mais  adequados para os meus deslocamentos:</p>

      <p class="corpo"><strong>&nbsp;</strong></p>

      <ol>

        <li> <span class="corpo">De  minha residência para o local de trabalho: ______________________________</span></li>

      </ol>

      <p>&nbsp;</p>

      <ol>

        <li> <span class="corpo">Do  local de trabalho para minha residência: _______________________________</span></li>

      </ol>

      <p>&nbsp;</p>

      <p>&nbsp;</p>

      <p class="corpo">Comprometo-me  a atualizar as informações acima sempre que ocorrerem alterações, e a utilizar  os vales transportes que me forem concedidos exclusivamente no percurso indicado.<br />

        Estou  ciente de que a declaração inexata que induza o empregador em erro ou uso  indevido dos vales transporte configura justa causa para rescisão do contrato  de trabalho por ato de improbidade.</p>

		<p>&nbsp;</p>
	
		<p>&nbsp;</p>
	
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

<table width="1027" border="0">

  <tr>
<div style="page-break-after: always">

    <td><h2 align="left">

      <div class="cabecalho">

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

        <h4 align="right">&nbsp;</h4>

      </div>

      &nbsp;&nbsp;____________________________________________________________________________________</h2>

      <br clear="all" />

      <h2 class="contratocenter">ACORDO DE COMPENSAÇÃO DE HORAS</h2>

      <p>&nbsp;</p>

      <p>&nbsp;</p>

      <h1 class="corpo"> Empregador: 035 – Polêmica Serviços  Básicos Ltda.                CNPJ: 61.870.101/0001-08

       <h1 class="corpo"><p>Entre a empresa <strong>POLÊMICA  SERVIÇOS BÁSICOS LTDA., </strong>com estabelecimento situado à Rua Attílio Gelsomini. 210 - galpão A - Vila Santa Rosa, com o Ramo de Prestação de Serviços, neste ato representada pelo Sr. João  Moura Nunes, e seu Empregado (a) <strong><?php echo $nome ?> </strong>abaixo  assinado, portador (a) da Carteira de Trabalho e Previdência Social nº <strong><?php echo $carteira_profissional ?> </strong> série <strong><?php echo $serie ?>   </strong>fica acertado que o horário normal  de trabalho será o seguinte:</p>

      <p>&nbsp;</p>

      <h1 class="corpo"> <p>Das <strong><?php echo $trabalho_entrada; ?> </strong>às <strong><?php echo $trabalho_saida; ?> </strong>Segunda a Quinta-feira, e as  Sextas – Feiras das <strong><?php echo $sexta_entrada; ?> </strong>às <strong><?php echo $sexta_saida; ?> </strong>com <strong>01h </strong>de intervalo para refeição e descanso<strong>.</strong></p>

      <p>&nbsp;</p>

       <h1 class="corpo"><p>Perfazendo o total de 44 Horas semanais.</p>

      <p>&nbsp;</p>

       <h1 class="corpo"><p>Estando de pleno acordo, assinam o presente em 02 (duas)  vias.<br />

        O presente acordo vigorará pelo prazo indeterminado.</p>

<h1 class="corpo">&nbsp;</h1>

      <p>&nbsp;</p>

      <p>&nbsp;</p>

	      <p>&nbsp;</p>

      <p>&nbsp;</p>




	        <p><strong></strong><strong> </strong></p>



      <p>______________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                                            __________________________________________<br />

        <strong>POLÊMICA SERVIÇOS  BÁSICOS LTDA                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;             </strong><strong><?php echo $nome ?></strong></p>

      <p><strong>&nbsp;</strong></p>

      <p>____________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;____________________________________________<br />

        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Responsável (qdo. Menor)</p></td>

  </tr>

  

</table>
<tr>

  <td><h2 align="left">

      <div class="cabecalho">

        <table width="1062" border="0">
		<div style="page-break-after: always">

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

 <h4 align="right">&nbsp;</h4>

      </div>

      &nbsp;&nbsp;____________________________________________________________________________________</h2>

      <br clear="all" />
      </div>

    </h2>

     <!-- <br clear="all" />-->

      <h2 class="contratocenter">DECLARAÇÃO</h2>

      <p>&nbsp;</p>

      <p>&nbsp;</p>

      <h1 class="corpo"> <p>Declaro para os devidos fins, conhecer a orientação dada pelo meu empregador, através do  curso de treinamento pré-admissional, que no exercício de minhas funções não é admissível, sob  nenhum pretexto, fraudar e/ou manipular dados e informações registradas nos formulários por mim  preenchidos, decorrentes da execução dos serviços a mim confiados, uma vez que tal, prática  conduz a uma série de problemas e prejuízos ao meu empregador e ao seu cliente.  Assim sendo, estou ciente de que, se incorrer violação desta regra, estarei cometendo falta grave,  podendo ser demitido &ldquo;por justa causa&rdquo;, conforme previsto no Art. 482 da CLT. A apuração e  comprovação do fato dar-se-á pela fiscalização interna da Polêmica e de seu cliente.
	  <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>

      <p>SÃO JOSÉ DOS CAMPOS, <?php echo strtoupper($data_2); ?></p>



	        <p><strong></strong><strong> </strong></p>
<p>&nbsp;</p>
<p>&nbsp;</p>

	

      <p><u>    ______________________________                        </u><br />

      <strong><?php echo $nome ?></strong></p></td>

</tr>

<!--</table>-->
	
</div>

<p>&nbsp;</p>

<table width="1027" border="0">

  <tr>

    <td width="1690" height="21">&nbsp;</td>

  </tr>

  <tr>

    <td height="975"><h2 align="left">

      <div class="cabecalho">
        <table width="1062" border="0">
  <div style="page-break-after: always">
         
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
        <h4 align="center">&nbsp;</h4></div>
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

</div></div>
</table>
	
<table width="" border="0">
 <div style="page-break-after: always">

  <tr>

    <h2 align="left">

      <div class="cabecalho">

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

        <h4 align="right">&nbsp;</h4>

      </div>
      <br clear="all" />

      <h2 class="contratocenter">RECIBO DE ENTREGA DE CTPS</h2>

      <p>&nbsp;</p>

      <p>&nbsp;</p>

     <h1 class="corpo"> <p>Declaramos  para os devidos fins, que nesta data, entreguei a minha Carteira de Trabalho e  Previdência Social nº <strong>055068  </strong>SÉRIE<strong> 00390</strong>, para registro da minha admissão na  empresa Polêmica Serviços Básicos Ltda.<strong> </strong></p>

      <p>&nbsp;</p>

      <p>&nbsp;</p>

      <p>SÃO JOSÉ DOS CAMPOS,  <?php echo strtoupper($data_2); ?> </p>

<h1 class="corpo">&nbsp;</h1>

      <p>&nbsp;</p>

      <p>&nbsp;</p>

	       



	  

      <p>______________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                                            __________________________________________<br />

        <strong>POLÊMICA SERVIÇOS  BÁSICOS LTDA                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;             </strong><strong><?php echo $nome ?></strong></p>

      <p><strong>&nbsp;</strong></p>

      <p>____________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;____________________________________________<br />

        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Testemunha                                                                                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     Responsável (qdo. Menor)</p>

  </tr>
</div>
<!--</table>-->

<p>&nbsp;</p>

<p></p>

<p></p>

<p></p>

<p></p>

<p></p>

<p></p>

<p></p>

<p></p>

<p></p>

<p></p>

<p></p>

<p></p>

<p></p><br></br></br><br></br></br><br></br></br>

<table width="1027" border="0">
 <div style="page-break-after: always">

  <tr>

    <td height=""><h2 align="left">

      <div class="cabecalho">

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

        <h4 align="right">&nbsp;</h4>

      </div>

      &nbsp;&nbsp;____________________________________________________________________________________</h2>

      <br clear="all" />

      <h2 class="contratocenter"><strong>TERMO DE SIGILO SOBRE INFORMAÇÕES</strong></h2>

      <p>&nbsp;</p>

      <p>&nbsp;</p>

     <h1 class="corpo"> <p>Assumo o compromisso junto a POLÊMICA  SERVIÇOS BÁSICO LTDA, e a Companhia de Saneamento Básico do Estado de São Paulo  – SABESP, de não divulgar a TERCEIROS os dados e informações (cadastro, nome,  endereço, etc.) referentes ao Contrato SABESP e de seus Clientes.</p>

Declaro ainda não ignorar que CONSTITUI INFRAÇÃO à  LEGISLAÇÃO a divulgação deste tipo de informação e estou ciente de que o  desrespeito a esta norma importa em falta grave, com as sanções previstas em  lei.

<p>&nbsp;</p>

      <p>&nbsp;</p>

      <p>SÃO JOSÉ DOS CAMPOS,  <?php echo strtoupper($data_2); ?> </p>

      <h1 class="corpo">&nbsp;</h1>

      <p>&nbsp;</p>

      <p>&nbsp;</p>

	        <p><strong></strong><strong> </strong></p>

      <p class="center">&nbsp;</p>
      <p class="center">&nbsp;</p>
      <p class="center">&nbsp;</p>
      <p class="center">&nbsp;</p>
      <p class="center">&nbsp;</p>


      <p>______________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                                            __________________________________________<br />

        <strong>POLÊMICA SERVIÇOS  BÁSICOS LTDA                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;             </strong><strong><?php echo $nome ?></strong></p>

      <p><strong>&nbsp;</strong></p>

      <p>____________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;____________________________________________<br />

        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Testemunha                                                                                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     Responsável (qdo. Menor)</p></td>

  </tr>
</div>
</table>

<p></p>

<table width="1027" border="0">
 <div style="page-break-after: always">

  <tr>

    <td><h2 align="left">

      <div class="cabecalho">

        <h4 align="right">&nbsp;</h4>

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

        <h4 align="right"></h4>

</div></div>
      &nbsp;&nbsp;____________________________________________________________________________________</h2>
      <p align="left">
      </p><h2 class="contratocenter"><strong>AUTORIZAÇÃO PARA DESCONTO DE CONTRIBUIÇÃO<br>
ASSISTENCIAL NEGOCIAL</strong></h2> <br><br></br><br />
      <p class="corpo">EU<strong> </strong><strong><?php echo $nome ?></strong><strong>, </strong>AUTORIZO A EMPRESA POLÊMICA SERVIÇOS BÁSICOS LTDA, A  DESCONTAR MENSALMENTE DE MEUS VENCIMENTOS, O EQUIVALENTE A 1% (UM POR CENTO) DO  SALÁRIO BÁSICO A TÍTULO DE CONTRIBUIÇÃO ASSISTENCIAL NEGOCIAL, DEVENDO O  REFERIDO VALOR SER REPASSADO AO SINDICATO REPRESENTATIVO DA CATEGORIA.<u> </u></p>

<p class="center">&nbsp;</p>

      <p class="center">&nbsp;</p>

      <p class="center">&nbsp;</p>
      <p class="center">&nbsp;</p>
      <p class="center">&nbsp;</p>
      <p class="center">&nbsp;</p>
      <p class="center">&nbsp;</p>
      <p class="center">&nbsp;</p>
      <p class="center">&nbsp;</p>
      <p class="center">&nbsp;</p>
      <p class="center">&nbsp;</p>
      <p class="center">&nbsp;</p>
      <p class="center">&nbsp;</p>
      <p class="center">&nbsp;</p>
      <p class="center">&nbsp;</p>
      <p class="center">&nbsp;</p>

      <p><strong></strong><strong> </strong></p>

	

      <p>______________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                                            __________________________________________<br />

        <strong>POLÊMICA SERVIÇOS  BÁSICOS LTDA                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;             </strong><strong><?php echo $nome ?></strong></p>

      <p><strong>&nbsp;</strong></p>

      <p>____________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;____________________________________________<br />

        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Testemunha                                                                                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     Responsável (qdo. Menor)</p></td>

  </tr>

  <tr>

    <td>&nbsp;</td>

  </tr>
</div>
</table>

<table width="1027" border="0">
 <div style="page-break-after: always">

  <tr>

    <td><h2 align="left">

      <div class="cabecalho">

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

        <h4 align="right">&nbsp;</h4>

      </div>

      &nbsp;&nbsp;____________________________________________________________________________________</h2>

      <h2 class="contratocenter"><p align="center"><strong><u>Regulamento Interno</u></strong></p>
	 <br clear="all" />

      <h2 class="contratocenter">POLÊMICA SERVIÇOS BÁSICAS LTDA</h2>

      <p>&nbsp;</p>

      <p>&nbsp;</p>

      <p>&nbsp;</p>

      <ol>

       <h1 class="corpo"> <li><span dir="ltr"> </span><strong>Da  Integração no Contrato Individual de Trabalho <br><br><br></strong>

          <p><strong>Art.1º</strong> – O  presente Regulamento é parte integrante do contrato individual de trabalho. As  normas e preceitos nele contidos aplicam-se a todos os empregados,  complementando os princípios gerais de direitos e deveres contidos na  Consolidação das Leis do Trabalho (CLT).<br />

            <strong>    Parágrafo único</strong> –  sua obrigatoriedade perdura o tempo de duração do contrato de trabalho, sendo  assim, o empregado que assinar o seu termo de ciência, não poderá alegar seu  desconhecimento.</p><br><br>

        </li>

        <li> <strong>Da  Admissão</strong><br><br><br>

          <p><br><strong>Art. 2º</strong> – A admissão de  empregado condiciona-se a exames de seleção técnica e médica e mediante  apresentação dos documentos exigidos, no prazo fixado pelo empregador.<br><br></p>

        </li>

        <li> <strong>Dos Deveres,  Obrigações e Responsabilidades do Empregado</strong>

          <p><br><br><strong>Art. 3º</strong> –  Todo empregado deve:</p><br><br>

          <p>  a) Cumprir os  compromissos expressamente assumidos no contrato individual de trabalho, com  zelo,          atenção e competência  profissional;<br />

            b) Obedecer às ordens e instruções emanadas de  seus superiores hierárquicos; <br />

            c) Sugerir medidas  para maior eficiência do serviço; <br />

            d) Observar a máxima  disciplina no local de trabalho; <br />

            e) Zelar pela boa  conservação das instalações, equipamentos e máquinas, comunicando as  anormalidades notadas; <br />

            f) Manter na vida  profissional conduta compatível com a dignidade do cargo ocupado e com a  reputação do quadro de pessoal da Empresa; <br />

            g) Usar os meios de  identificação pessoal estabelecidos; <br />

            h) Informar a área ou  responsável pelos recursos humanos sobre qualquer modificação em seus dados  pessoais, tais como, estado civil, militar, aumento ou redução de pessoas na  família, eventual mudança de residência, etc.;<br />

            i) Respeitar a honra,  boa fama e integridade física de todas as pessoas com quem mantiverem contato  por motivo de emprego.</p>

        </li>

        <li> <strong>Das  Ausências, Saídas e Atrasos</strong>

          <p><br><br><strong>Art. 4º</strong> –O empregado que se  atrasar ao serviço, sair antes do término da jornada ou faltar por qualquer  motivo, deve justificar o fato ao superior imediato, verbalmente ou por  escrito, quando solicitado.</p>

          <p>§ 1 - Á empresa  cabe descontar os períodos relativos a atrasos, saídas mais cedo, sem prévia  autorização, faltas ao serviço, excetuada as faltas e ausências legais; <br />

            § 2 - As faltas  ilegais, não justificadas perante a correspondente chefia, acarretam a  aplicação das penalidades previstas no item <strong>V </strong>deste regulamento; <br />

            § 3°- As faltas  decorrentes de doença deverão ser abonadas através de Atestado Médico, com sua  apresentação dentro do prazo de 48 (quarenta e oito) horas, podendo ser  prorrogado por mais48 (quarenta e oito) horas, ou seja, prazo máximo de entrega  de Atestado Médico de 96 (noventa e seis) horas, 4 (quatro) dias, da data do início da ausência;<br />

            § 4°- Documentos da  Previdência, como por exemplo: o de afastamento, certidão de nascimento de  filhos, certidão de casamento, certidão de óbito e qualquer semelhante, devem  ser apresentados no mesmo prazo do <strong>Art.  4º</strong>§ 3°, deste regulamento;<br />

          § 5°- As  solicitações de abono de faltas, somente serão aceitas, se as justificativas,  com os correspondentes documentos de comprovação, forem apresentadas até 2  (dois) dias úteis após a data do início da ausência; </p>

        </li>

        <li><span dir="ltr"> </span><strong>Penalidades</strong>

          <p><br><br><strong>   Art. 5º</strong> – Aos empregados  transgressores das normas deste Regulamento, aplicam-se as penalidades  seguintes:<br />

            - Advertência verbal;<br />

            - Advertência  escrita;<br />

            - Suspensão; <br />

            - Demissão, por justa  causa. </p>

          <p><strong>Art. 6º</strong> –  As penalidades são aplicadas segundo a gravidade da transgressão, pelo  Departamento de Pessoal.</p><br>

        </li>

        <li> <strong>Das disposições Gerais </strong>

          <p><br><br><strong>    Art. 20º</strong> – Os empregados  devem observar o presente Regulamento, circulares, ordem de serviço, avisos,  comunicados e outras instruções expedidas pela direção da Empresa. </p>

          <p><br><br><strong>   Art. 21º</strong> – Cada empregado  recebe um exemplar do presente Regulamento. Declara, por escrito, tê-lo  recebido, lido e estar de acordo com todos os seus preceitos. </p>

          <p><br><br><strong>  Art. 22º</strong> – Os casos omissos  ou não previstos são resolvidos pela Empresa, à luz da CLT e legislação  complementar pertinente. </p>

          <p><br><br><strong>  Art. 23º</strong> – O presente  regulamento pode ser substituído por outro, sempre que a Empresa julgar  conveniente, em consequência de alteração na legislação social.</p>

          <p>&nbsp;</p>

          <p> Recebi um exemplar do  Regulamento Interno da <strong>POLÊMICA SERVIÇOS  BÁSICOS LTDA</strong></p>

          <p>&nbsp;</p>

          <p>São José dos Campos, <?php echo strtoupper($data_2); ?>.</p>

        </li>

      </ol>


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

<table width="" border="0">
  <div style="page-break-after: always">

  <tr>	
    <td><h2 align="left">

      <div class="cabecalho">


        <table width="" border="0">

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

        <h4 align="right">&nbsp;</h4>

</div>

      &nbsp;&nbsp;____________________________________________________________________________________</h2>


      <br clear="all" />

      <blockquote>

        <h2 class="contratocenter">DECLARAÇÃO DE FUNCIONÁRIO EXTERNO</h2>

      </blockquote>

      <p>&nbsp;</p>

      <p>&nbsp;</p>

      <p class="corpo">Eu, <strong><?php echo $nome ?> ,</strong> <?php echo $nacionalidade ?>,  <?php echo $estado_civil ?>, <?php echo @mysql_result(mysql_query("select * from cargos where id = $funcao"),0,"descricao"); ?>, portadora do RG nº <?php echo $rg ?> e do CPF/MF nº <?php echo $cpf ?>,  residente e domiciliado (a) à <?php echo $endereco ?> DECLARO que:</p>

      <p class="corpo"><a name="_GoBack" id="_GoBack"></a>Minha jornada de trabalho é das  <?php echo $trabalho_entrada ?>min. as <?php echo $trabalho_saida ?>min., com intervalo para refeição e descanso de  <?php echo $trabalho_refeicao ?>min., e tenho conhecimento da <u>obrigação de gozar do intervalo de  refeição e descanso.</u></p>

      <p class="corpo"> Com isso, e por trabalhar livre e sem  fiscalização, devo gozá-lo no horário determinado em contrato de trabalho. <br />

        Por  ser verdade e ser esta minha vontade que manifesto livre de qualquer tipo de  pressão, assino o presente, na presença de duas testemunhas.</p>

      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>



      <p>______________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                                            __________________________________________<br />

        <strong>POLÊMICA SERVIÇOS  BÁSICOS LTDA                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;             </strong><strong><?php echo $nome ?></strong></p>

      <p><strong>&nbsp;</strong></p>

      <p>____________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;____________________________________________<br />

        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Testemunha                                                                                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     Responsável (qdo. Menor)</p></td>      <p align="right">&nbsp;</p>

      <p align="right">&nbsp;</p></td>

	  

  </tr>

  <tr>

    <td height="21"><table width="1027" border="0">
  <div style="page-break-after: always">
  
  <tr>
    <td><h2 align="left">
      <div class="cabecalho">
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
        <h4 align="right">&nbsp;</h4>
      </div>
      &nbsp;&nbsp;____________________________________________________________________________________
      <br clear="all" />
      </h2>
      <h2 class="contratocenter">TERMO DE RESPONSABILIDADE <br>
CONCESSÃO DE SALÁRIO FAMÍLIA <br>
PORTARIA N.º MPAS – 3040/82</h2>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p><span class="corpo">Empregador: 035 – Polêmica Serviços Básicos Ltda.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                CNPJ: 61.870.101/0001-08 </span></p>
      <p><span class="corpo">Nome do Segurado: <?php echo $nome ?> </span></p>
      <p><span class="corpo">CTPS ou Doc. Identidade nº. <?php echo $rg ?></span> </p>
      <p>&nbsp;</p>
      <table width="835" border="1" cellspacing="1" cellpadding="1">
        <tr>
          <th width="622" scope="col"><span class="corpo">Nome do Filho</span></th>
          <th width="161" scope="col"><span class="corpo">Data Nascimento</span></th>
        </tr>
       
	<?php 	$filho_1 = @mysql_result(mysql_query("select * from rh_benef where funcionario = $id and ordem = '1'"),0,"nome");   
			$filho_2 = @mysql_result(mysql_query("select * from rh_benef where funcionario = $id and ordem = '2'"),0,"nome"); 	
			$filho_3 = @mysql_result(mysql_query("select * from rh_benef where funcionario = $id and ordem = '3'"),0,"nome");
			$filho_4 = @mysql_result(mysql_query("select * from rh_benef where funcionario = $id and ordem = '4'"),0,"nome");
			?>

	<?php if ($filho_1 <> '') { ?>
       <tr> 
          <td><?php echo @mysql_result(mysql_query("select * from rh_benef where funcionario = $id and ordem = '1'"),0,"nome"); ?></td>
          <td><?php echo @mysql_result(mysql_query("select * from rh_benef where funcionario = $id and ordem = '1'"),0,"nascimento"); ?></td>
        </tr> <?php }; ?> 
      
      <?php if ($filho_2 <> '') { ?>  <?php }; ?> 
      
      
       <?php if ($filho_3 <> '') { ?>
        <?php }; ?> 
        <?php if ($filho_4 <> '') { ?> <?php }; ?>
        </table>
      <p>&nbsp;</p>
<p><span class="corpo">Pelo presente

TERMO DE 

RESPONSABILIDADE, declaro estar ciente que deverei comunicar de imediato a ocorrência dos 

seguintes fatos ou ocorrências que determinam a perda do direito ao Salário-Família:</span></p>
<p><span class="corpo">- Óbito de filho;</span></p>
<p><span class="corpo">- Cessação da invalidez de filho inválido;</span></p>
<p><span class="corpo"> - Sentença judicial que determine pagamento a outrem (casos de desquite ou separação, 
  
  abandono de filho ou perda do pátrio poder).</span></p>
<p><span class="corpo"> Estou ciente, ainda, de que a falta de cumprimento do compromisso ora assumido, além de obrigar a 
  
  devolução das importâncias recebidas indevidamente, sujeitar-me-a as penalidades previstas no art. 
  
  171 do código penal e a rescisão do contrato de trabalho, por justa causa, nos termos do art. 482 da 
  
  Consolidação das Leis do Trabalho.</span></p>
  <br /><br /><br /><br /><br /><br /><br /><br />
<p><strong></strong><strong> </strong></p>
      <p>______________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                                            __________________________________________<br />

        <strong>POLÊMICA SERVIÇOS  BÁSICOS LTDA                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;             </strong><strong><?php echo $nome ?></strong></p>
      <p><strong>&nbsp;</strong></p>
      <p>____________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;____________________________________________<br />
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Testemunha                                                                                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     Responsável (qdo. Menor)</p></td>
  </tr></div>
    </table>
      <table width="1027" border="0">
    <div style="page-break-after: always">
  
  <tr>
    <td><h2 align="left">
      <div class="cabecalho">
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
        <h4 align="right">&nbsp;</h4>
      </div>
      &nbsp;&nbsp;____________________________________________________________________________________
      <br clear="all" />
      </h2>
      <h2 class="contratocenter">SEGURANÇA DO TRABALHO</h2>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p><span class="corpo">Nome do Funcionário: <?php echo $nome; ?> </span></p>
      <p><span class="corpo">Função na Empresa: <?php echo @mysql_result(mysql_query("select * from cargos where id = $funcao"),0,"descricao");  ?></span></p>
      <p><span class="corpo"> Data de Admissão: <?php echo implode("/",array_reverse(explode("-",$admissao))); ?> </span></p>
      <p>&nbsp;</p>
      <p><span class="corpo">Pelo presente, declaro que recebi, gratuitamente, os EPI – Equipamentos de Proteção Individual, abaixo relacionados, recebendo ainda, treinamento sobre a utilização correta, para a sua guarda e conservação, e orientações sobre a legislação em vigência CLT e NR 6. Assumo o compromisso de usá-los para a finalidade a que se destina no trabalho, zelar pela sua guarda e conservação, devolvê-lo ao setor competente da empresa quando se tornar impróprio para o uso e, quando de minha demissão ou afastamento. Estou ciente, ainda, que no caso de minha recusa sem justo motivo, estarei incorrendo num gesto de insubordinação e transgressão às ordens e regulamentos de segurança e, assim, sujeito a incorrer num dos motivos para justa causa para a rescisão do contrato de trabalho, conforme artigo 158, combinado com alínea H, do artigo 482 da CLT. Estas informações serão mantidas em meu prontuário e arquivados por um período mínimo de 5 anos para efeito de fiscalização do MTE.</span></p>
      <p>&nbsp;</p>
      <table width="960" border="1" cellspacing="1" cellpadding="1">
      <tr></tr>
      <tr></tr>
      <tr>
        <th width="42" scope="col"><span class="corpo">QTD</span></th>
        <th width="300" height="30" scope="col">EPI</th>
        <th width="102" scope="col">Nº CA</th>
        <th width="146" scope="col">DATA ENTREGA</th>
        <th width="206" scope="col">DATA DEVOLUÇÃO</th>
        <th width="210" scope="col">ASSINATURA</th>
      </tr>
      <tr>
        <td>01</td>
        <td>ÓCULOS DE SEGURANÇA</td>
        <td>&nbsp;</td>
        <td>&nbsp; <?php echo implode("/",array_reverse(explode("-",$admissao))) ?></td>
        <td height="30">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>02</td>
        <td>PROTETOR AURICULAR</td>
        <td>&nbsp;</td>
        <td>&nbsp; <?php echo implode("/",array_reverse(explode("-",$admissao))) ?></td>
        <td height="30">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>01</td>
        <td height="30">LUVA DE RASPA</td>
        <td>&nbsp;</td>
        <td>&nbsp; <?php echo implode("/",array_reverse(explode("-",$admissao))) ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>01</td>
        <td height="30">LUVA DE PVC </td>
        <td>&nbsp;</td>
        <td>&nbsp; <?php echo implode("/",array_reverse(explode("-",$admissao))) ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>01</td>
        <td height="30">BOTA BA</td>
        <td>&nbsp;</td>
        <td>&nbsp; <?php echo implode("/",array_reverse(explode("-",$admissao))) ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>01</td>
        <td height="30">CAPACETE SEGURANÇA</td>
        <td>&nbsp;</td>
        <td>&nbsp; <?php echo implode("/",array_reverse(explode("-",$admissao))) ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>01</td>
        <td height="30">BOTA PVC</td>
        <td>&nbsp;</td>
        <td>&nbsp; <?php echo implode("/",array_reverse(explode("-",$admissao))) ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>02</td>
        <td height="30">CAMISETAS</td>
        <td>&nbsp;</td>
        <td>&nbsp; <?php echo implode("/",array_reverse(explode("-",$admissao))) ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>02</td>
        <td height="30">CALÇAS</td>
        <td>&nbsp;</td>
        <td>&nbsp; <?php echo implode("/",array_reverse(explode("-",$admissao))) ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>01</td>
        <td height="30">PROTETOR SOLAR FPS</td>
        <td>&nbsp;</td>
        <td>&nbsp; <?php echo implode("/",array_reverse(explode("-",$admissao))) ?></td>
        <td height="30">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="30">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="30">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      </table>
      <p>&nbsp;</p>
      <table width="962" height="85" border="1" cellpadding="0" cellspacing="0">
        <tr>
          <th width="320" height="83" scope="col"><p>Chefia Imediata:&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p></th>
          <th width="323" scope="col"><p>Setor RH e Dpto. Pessoal:</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p></th>
          <th width="311" scope="col"><p>Segurança do Trabalho:</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p></th>
        </tr>
      </table></td>
  </tr>
      </table>
      <table width="1027" border="0">
        <div style="page-break-after: always">
          <tr>
            <td><h2 align="left">
              <div class="cabecalho">
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
                <h4 align="right">&nbsp;</h4>
              </div>
              &nbsp;&nbsp;____________________________________________________________________________________ <br clear="all" />
            </h2>
              <h2 class="contratocenter">TREINAMENTO ADMISSIONAL (INTEGRAÇÃO)</h2>
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              <p><span class="corpo">Carga Horária: 06:00 h</span></p>
              <p><center><span class="corpo">TÓPICOS ABORDADOS</span></center></p>
              <p>1. Condições e Meio Ambiente de Trabalho:</p>
              <p>1.1- Definição de Segurança do trabalho;</p>
              <p>1.2- Atos e Condições inseguras;                                           </p>
<p> 1.3- Riscos de acidentes na obra;</p>
<p>1.4-Limpeza e Organização;</p>
<p>02- Obrigações dos empregados e do Empregador;</p>
<p><b>03-EPI-EQUIPAMENTO PROTEÇÃO INDIVIDUAL</b></p>
<p>3.1-Fornecimento gratuito dos Epis;</p>
<p>3.2-Finalidade;</p>
<p>3.3-Orientações sobre o uso correto;</p>
<p>3.4-Responsabilidade pelo uso e zelo;</p>
<p>04-EPC- EQUIPAMENTO DE PROTEÇÃO COLETIVA</p>
<p>4.1- Definição;</p>
<p>4.2-Áreas de risco;</p>
<p>4.3- Máquinas e equipamentos;</p>
<p><b>05- RISCOS INERENTES A FUNÇÃO </b></p>
<p> Eu <?php echo $nome ?> função <?php echo @mysql_result(mysql_query("select * from cargos where id = $funcao"),0,"descricao"); ?>
Declaro que recebi em 01/07/2015, treinamento admissional. Orientações de segurança do trabalho 
desta empresa, ciente de que terei que cumprir obrigatoriamente as normas de segurança conforme 
NR18 e utilizar os devidos, equipamentos de proteção individual (EPI).</p>
<blockquote>
  <p><br>
    <br>
<br>
<br><br>
              </p>
</blockquote>
<p><strong></strong><strong> </strong><br /><br /><br /><br /><br /><br /></p>
              <p>______________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                                            __________________________________________<br />
                <strong>POLÊMICA SERVIÇOS  BÁSICOS LTDA                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;             </strong><strong><?php echo $nome ?></strong></p>
              <p><strong>&nbsp;</strong></p>
              <p>____________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;____________________________________________<br />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Testemunha                                                                                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     Responsável (qdo. Menor)</p></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </div>
        
      </table>

      <table width="1048" height="1518" border="1" cellpadding="0" cellspacing="0">
				<div style="page-break-after: always">

		<tr>
          <th height="80" colspan="2" rowspan="4" scope="col"><img src="../unnamed.jpg" alt="" width="111" height="113"></th>
          <th width="485" scope="col">PROCEDIMENTO DE SEGURANÇA</th>
          <th width="104" rowspan="2" scope="col">Página: </th>
          <th width="186" rowspan="2" scope="col">1/2</th>
        </tr>
        <tr>
          <th width="485" rowspan="3" scope="col"><p>ORDEM DE SERVIÇO</p>
            <p>AJUDANTE DE SANEAMENTO</p></th>
        </tr>
        <tr>
          <th scope="col">Revisão:</th>
          <th scope="col">1</th>
        </tr>
        <tr>
          <th height="80" colspan="2" scope="col">Data: <?php echo implode("/",array_reverse(explode("-",$admissao))) ?> </th>
        </tr>
        <tr>
          <td height="21" colspan="5" scope="col">NOME: <?php echo $nome; ?> </td>
        </tr>
        <tr>
          <td height="21" colspan="5" scope="col">1. Descrição da Função</td>
        </tr>
        <tr>
          <td height="21" colspan="5" scope="col"><?php echo @mysql_result(mysql_query("select * from cargos where id = $funcao"),0,"descricao_2"); ?></td>
        </tr>
        <tr>
          <td height="21" colspan="5" scope="col">2. Agentes Associados às Atividades</td>
        </tr>
        <tr>
          <td width="248" height="21" scope="col"><ul>
            <li>Cortes diversos</li>
            <li>Projeção de materiais</li>
            <li>Choque elétrico</li>
            <li>Ruído (máquinas e equipamentos)</li>
          </ul>            </td>
          <td height="21" colspan="2" scope="col"><ul>
            <li>Poeira            </li>
            <li>Postura incorreta;            </li>
            <li>Dermatose de contato;            </li>
            <li>Soterramento</li>
          </ul>            </td>
          <td height="21" colspan="2" scope="col"><ul>
            <li>Queda de diferença de nível e de mesmo nível </li>
            <li>Abrasão</li>
            <li>Stress</li>
            <li> Atropelamento, Colisão</li>
          </ul>            </td>
        </tr>
        <tr>
          <td height="21" colspan="5" scope="col">3. EPI's de Uso Obrigatório</td>
        </tr>
        <tr>
          <td height="97" scope="col"><ul>
            <li> Capacete com jugular</li>
            <li>Botina de segurança;</li>
            <li>Máscara para Pó</li>
            <li> Luva de Látex, </li>
            <li>Neoprene, Raspa etc</li>
          </ul>            </td>
          <td height="97" colspan="2" scope="col"><ul>
            <li>Óculos de proteção contra impacto;</li>
            <li>Cinto de segurança tipo pára-quedista (Cabo guia e </li>
            <li>Trava Queda)</li>
            <li>Protetor Auricular</li>
          </ul>            </td>
          <td height="97" colspan="2" scope="col"><ul>
            <li>Bota de Borracha</li>
            <li>Protetor Solar</li>
          </ul></td>
        </tr>
        <tr>
          <td height="28" colspan="5" scope="col"><p>Ferramentas (Máquinas somente habilitados) utilizadas: Pá, Enxada. Vassoura, Marreta, Talhadeira, Carrinho de mão Girica, compactador, Serra cliper</p></td>
        </tr>
        <tr>
          <td height="21" colspan="5" scope="col">4. Recomendações</td>
        </tr>
        <tr>
          <td height="21" colspan="5" scope="col"><ul>
            <li> As refeições deverão ser feitas no refeitório</li>
            <li> È proibido trabalhar sobre efeito de Drogas (Álcool etc.) </li>
            <li> Comunique ao Depto Segurança do Trabalho qualquer irregularidade que possa colocar você ou seus</li>
            <li>companheiros em risco de acidentes. </li>
            <li> Não remova ou ultrapasse as proteções existentes na área.</li>
            <li> Usar e selar dos EPI's designados a sua função. Não execute trabalhos fora de sua função</li>
            <li> Comparecer ao departamento médico para exames periódicos sempre que solicitado.</li>
            <li> É obrigatório o uso de uniforme fornecido pela empresa gratuitamente, mas que deverá ser mantido limpo e </li>
            <li>completo. A falta do uniforme implicará em medidas disciplinares de acordo com a empresa.</li>
            <li>  Executar as tarefas sempre com atenção e cuidado, utilizando os equipamentos de proteção individual e mantê-los </li>
            <li>sempre limpos em condições de uso;</li>
            <li> Não se aproximar de equipamentos em operação. È é proibido manusear máquinas e equipamentos, somente </li>
            <li>funcionários habilitados e treinados poderão manusear;</li>
            <li>Sempre que remover uma proteção coletiva, observar para que a mesma seja recolocada no local o mais breve </li>
            <li>possível;</li>
            <li> Utilize sempre ferramentas apropriadas e sem defeitos. Procurar o almoxarife sempre que observar irregularidades.</li>
            <li>Executar as tarefas sempre com atenção e cuidado, utilizando os Equipamentos de Proteção Individual (E.P.I.), </li>
            <li>adequado a atividade. Mantê-los limpos e conservados.</li>
            <li> Ao executar serviços de picotamento de concreto, aberturas de valas, etc., fazer o uso sempre do óculos de </li>
            <li>segurança e luvas, proteja sua visão de ferimentos e perfurações]</li>
            <li> Em concretagem usar botas de borracha, luvas de látex ou neoprene. [O concreto tem composição química se </li>
            <li>proteja utilizando os epis relacionados;]</li>
            <li> Trabalhos próximos de ferramentas, máquinas e equipamentos ruidosos são prejudiciais à audição se proteja </li>
            <li>utilizando protetor auricular;</li>
            <li>Organizar os materiais de acordo com tipo e de modo a não prejudicar a via de circulação de pessoas.</li>
            <li> É proibido o uso de copo coletivo, pegar copos descartáveis no almoxarifado. O bebedouro deverá ser utilizado </li>
            <li>somente para beber água.</li>
            <li> Manter o vestiário limpo e não utilizar pregos como cabides.</li>
            <li>Ao levantar peso colocar-se na posição correta para não haver problemas com a coluna.</li>
            <li> Quando houver um acidente procure imediatamente seu encarregado e siga as instruções do Plano de Emergência </li>
            <li>que está exposto na área de vivência e nas pastas em cada veículo</li>
            <li> Sinalizar os locais de trabalho;</li>
            <li>Nunca carregar excessivamente as máquinas de forma a impedir a visão do operador, fica proibido transporte de </li>
            <li>pessoas na máquina;</li>
            <li> PARA CONHECIMENTO:</li>
            <li>Depositar os materiais de escavação a uma distancia superior á metade da profundidade, medida a partir da borda </li>
            <li>do talude</li>
            <li>  Proceder ao escoramento das paredes das valas nas escavações com mais de 1,25m;</li>
            <li> Instalar escadas ou rampas nas escavações com mais de 1,25 m, a fim de permitir a saída rápida em caso de </li>
            <li>emergência;</li>
            <li>Os taludes com mais de 1,25 m devem ter a estabilidade garantida por escoramentos corretamente dimensionados e</li>
            <li>inspecionados periodicamente;</li>
            <li> Cobrir ou impermeabilizar os taludes para evitar a erosão;</li>
            <li> Cuidar para que os locais onde houver aproximação de máquinas, equipamentos e veículos de carga, sejam </li>
            <li>devidamente escorados ou aumentados os ângulos dos taludes;</li>
            <li> Antes do início das escavações realizarem estudos geotécnicos acompanhado de laudos para verificar a </li>
            <li>estabilidade do solo, tipo de escoramentos que deverá ser usados e existência de cabos elétricos, tubulações de </li>
            <li>água, gás e outras, demarcando a área para evitar rompimento por máquinas;</li>
            <li> Os motoristas e operadores de máquinas e equipamentos deverão ser obrigatoriamente habilitados;</li>
            <li> Comunicar ao encarregado qualquer irregularidade;;</li>
            <li>OBS.: È proibido trabalhar na abertura de valas e assentamento de tubos em dias de chuva risco de</li>
            <li>soterramento</li>
          </ul></td>
        </tr>
        <tr>
          <td height="21" colspan="5" scope="col">5. Procedimentos em caso de acidentes</td>
        </tr>
        <tr>
          <td height="21" colspan="5" scope="col"><ul>
            <li>Em caso de acidente do Trabalho ou Acidente Ambiental verificar as medidas a serem tomadas no PAE (Plano de Atendimento a Emergência)/</li>
            </ul>
  <p>Obs: O acidente não comunicado, não será considerado para efeitos legais. </p></td>
        </tr>
        <tr>
          <td height="21" colspan="5" scope="col">6. Observações</td>
        </tr>
        <tr>
          <td colspan="5" scope="col"><ul>
            <li>As orientações aqui contidas não esgotam o assunto sobre prevenção de acidentes, devendo ser observadas todas as instruções existentes, ainda que verbais em especial as Normas e Regulamentos da Empresa.</li>
            <li>Não executar qualquer atividade sem treinamento e pleno conhecimento dos riscos e cuidados a serem observados.</li>
            </ul></td>
        </tr>
      </table>
      <table width="909" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="909">
          <table width="1003" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><p>PORTARIA 3214 DE 8 DE JUNHO DE 1978</p>
                <p>NORMA REGULAMENTADORA NÚMERO 1 (NR 1) DISPOSIÇÕES GERAIS</p>
                <p>1.7. CABE AO EMPREGADOR: </p>
                <p>a) Cumprir e fazer cumprir as disposições legais e regulamentares sobre segurança e medicina do trabalho;</p>
                <p>b) Elaborar ordens de serviço sobre segurança e medicina do trabalho, dando ciência aos empregados, com os </p>
                <p>seguintes objetivos:</p>

                <p> Prevenir atos inseguros no desempenho do trabalho;</p>
                <p> Divulgar as obrigações e proibições que os empregados devam conhecer e cumprir;</p>
                <p> Dar conhecimento aos empregados de que serão passíveis de punição, pelo descumprimento das ordens de </p>
                <p>serviço expedidas;</p>
                <p> Determinar os procedimentos que deverão ser adotados em caso de acidente do trabalho e doenças </p>
                <p>profissionais ou do trabalho;</p>
                <p> Adotar medidas determinadas pelo MTB;</p>
                <p> Adotar medidas para eliminar ou neutralizar a insalubridade e as condições inseguras de trabalho.</p>
                <p>c) Informar aos trabalhadores:</p>
                <p> Os riscos profissionais que possam originar-se nos locais de trabalho;</p>
                <p> Os meios para prevenir e limitar tais riscos e as medidas adotadas pela empresa;</p>
                <p> Os resultados dos exames médicos e de exames complementares de diagnóstico aos quais os próprios </p>
                <p>trabalhadores forem submetidos;</p>
                <p> Os resultados das avaliações ambientais realizadas nos locais de trabalho.</p>
                <p>d) Permitir que representantes dos trabalhadores acompanhassem a fiscalização dos preceitos legais e </p>
                <p>regulamentares sobre segurança e medicina do trabalho.</p>
                <p>1.8. CABE AO EMPREGADO:</p>
                <p>a) Cumprir as disposições legais e regulamentares sobre segurança e medicina do trabalho, inclusive as ordens de </p>
                <p>serviço expedidas pelo empregador;</p>
                <p>b) Usar o EPI fornecido pelo empregador;</p>
                <p>c) Submeter-se aos exames médicos previstos nas Normas Regulamentadoras - NR;</p>
                <p>d) Colaborar com a empresa na aplicação das Normas Regulamentadoras - NR.</p>
                <p>1.8.1. Constitui ato faltoso, a recusa injustificada do empregado ao cumprimento do disposto no item anterior.</p>
                <p>e) Cumprir as disposições legais e regulamentares sobre segurança e medicina do trabalho, inclusive as ordens de </p>
                <p>serviço expedidas pelo empregador;</p>
                <p>f) Usar o EPI fornecido pelo empregador;</p>
                <p>g) Submeter-se aos exames médicos previstos nas Normas Regulamentadoras - NR;</p>
                <p>h) Colaborar com a empresa na aplicação das Normas Regulamentadoras - NR.</p>
                <p>1.8.1. Constitui ato faltoso, a recusa injustificada do empregado ao cumprimento do disposto no item anterior.</p>
                <table width="824" height="133" border="1" cellpadding="0" cellspacing="0">
                  <tr>
                    <th width="441" rowspan="2" scope="col"><p class="center">Declaro que recebi do Depto de Segurança do Trabalho as orientações que </p>
                      <p class="center">fazem parte deste documento, bem como, cópia do mesmo, comprometendo-</p>
                      <p class="center">me a seguir as orientações nele contidas e reconhecendo serem elas </p>
                      <p class="center">indispensáveis à minha segurança e à de meus colegas de trabalho. Também </p>
                      <p class="center">afirmo ter recebido os EPI's de utilização obrigatória na minha função e </p>
                      <p class="center">comprometo-me a utilizá-los durante toda a minha jornada de trabalho, </p>
                      <p class="center">solicitando sua substituição sempre que necessário.</p></th>
                    <td width="377" height="88"><span class="center" style="text-align: left">NOME: <?php echo $nome; ?></span></td>
                  </tr>
                  <tr>
                    <td height="17"><span class="center" style="text-align: left">ASSINATURA:</span></td>
                  </tr>  
                </table></td>
            </tr>  </div>

          </table>
          <p></p></td>

        </tr>
   </table>
      <div style="page-break-after: always">
      <table width="1018" border="0" cellspacing="0" cellpadding="0">      <div style="page-break-after: always">

        <tr>
          <td><center>
            <p><img src="http://www.cygnuscosmeticos.com.br/wp-content/gallery/como-funciona-a-previdencia-social-1/Como-Funciona-a-Previdencia-Social-1.gif" alt="" width="97" height="94"/></p>
            <p>PERFIL PROFISSIOGRÁFICO PREVIDENCIÁRIO- PPP</p>
          </center></center></td>
        </tr>
      </table>
      <table width="909" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>   

          <td width="909"><table border="1" cellspacing="0" cellpadding="0" width="1000">
            <tr>
              <td colspan="3"><p align="center">I</p></td>
              <td colspan="16"><p>SEÇÃO DE DADOS ADMINISTRATIVOS</p></td>
            </tr>
            <tr>
              <td colspan="8" valign="top"><p>1- CNPJ do Domicílio    Tributário/CEI<br>
                61.870.101/0001-08</p></td>
              <td colspan="9" valign="top"><p>2-Nome    Empresarial<br>
                POLÊMICA SERVIÇOS    GERAIS/OPERAÇÕES </p></td>
              <td colspan="2" valign="top"><p>3- CNAE</p></td>
            </tr>
            <tr>
              <td colspan="14" valign="top"><p>4- Nome do Trabalhador</p>
                <p>          <br /> <?php echo $nome; ?>      </p></td>
              <td colspan="3" valign="top"><p>5- BR/PDH</p></td>
              <td colspan="2" valign="top"><p>6- NIT<br>
                <strong>24.325.635-8</strong></p></td>
            </tr>
            <tr>
              <td colspan="7" valign="top"><p>7- Data do Nascimento<br>
                <strong><?php echo implode("/",array_reverse(explode("-",$nascimento))); ?></strong></p></td>
              <td colspan="3" valign="top"><p>8- Sexo (F/M)<br>
                <strong>MASCULINO</strong></p></td>
              <td colspan="4" valign="top"><p>9- CTPS (Nº, Série e UF)<br>
                <strong>29669/237-SP</strong></p></td>
              <td colspan="3" valign="top"><p>10- Data de Admissão<br>
                <strong><?php echo implode("/",array_reverse(explode("-",$admissao))); ?></strong></p></td>
              <td colspan="2" valign="top"><p>11- Regime <br>
                CLT</p></td>
            </tr>
            <tr>
              <td colspan="2"><p align="center">12</p></td>
              <td colspan="17"><p>CAT REGISTRADA</p></td>
            </tr>
            <tr>
              <td colspan="6"><p>12.1- Data do Registro</p></td>
              <td colspan="6"><p>12.2- Número da CAT-</p></td>
              <td colspan="3"><p>12.1- Data do Registro</p></td>
              <td colspan="4"><p>12.2- Número da CAT</p></td>
            </tr>
            <tr>
              <td colspan="6" valign="top"><p align="center">&nbsp;</p></td>
              <td colspan="6" valign="top"><p align="center">&nbsp;</p></td>
              <td colspan="3" valign="top"><p align="center">&nbsp;</p></td>
              <td colspan="4" valign="top"><p align="center">&nbsp;</p></td>
            </tr>
            <tr>
              <td colspan="6" valign="top"><p align="center">&nbsp;</p></td>
              <td colspan="6" valign="top"><p align="center">&nbsp;</p></td>
              <td colspan="3" valign="top"><p align="center">&nbsp;</p></td>
              <td colspan="4" valign="top"><p align="center">&nbsp;</p></td>
            </tr>
            <tr>
              <td width="89"><p align="center">13</p></td>
              <td colspan="18"><p>LOTAÇÃO E ATRIBUIÇÃO</p></td>
            </tr>
            <tr>
              <td colspan="4"><p>13.1- Período</p></td>
              <td colspan="5"><p>13.2- CNPJ/CEI</p></td>
              <td colspan="2"><p>13.3- Setor</p></td>
              <td colspan="2"><p>13.4- Cargo</p></td>
              <td colspan="3"><p>13.5- Função</p></td>
              <td colspan="2"><p>13.6- CBO</p></td>
              <td width="466"><p>13.7- Cód. GFIP </p></td>
            </tr>
            <tr>
              <td colspan="4" valign="top"><p align="center">&nbsp;</p></td>
              <td colspan="5" valign="top"><p>&nbsp;</p></td>
              <td colspan="2" valign="top"><p>PRODUÇÃO</p></td>
              <td colspan="2" valign="top"><p align="center"><strong><?php echo @mysql_result(mysql_query("select * from cargos where id = $funcao"),0,"descricao"); ?></strong></p></td>
              <td colspan="3" valign="top"><p align="center"><strong><?php echo @mysql_result(mysql_query("select * from cargos where id = $funcao"),0,"descricao_2"); ?> </strong></p></td>
              <td colspan="2" valign="top"><p>&nbsp;</p></td>
              <td width="466" valign="top"><p>&nbsp;</p></td>
            </tr>
            <tr>
              <td colspan="4" valign="top"><p>__/__/___ a __/__/___</p></td>
              <td colspan="5" valign="top"><p>&nbsp;</p></td>
              <td colspan="2" valign="top"><p>&nbsp;</p></td>
              <td colspan="2" valign="top"><p>&nbsp;</p></td>
              <td colspan="3" valign="top"><p>&nbsp;</p></td>
              <td colspan="2" valign="top"><p>&nbsp;</p></td>
              <td width="466" valign="top"><p>&nbsp;</p></td>
            </tr>
            <tr>
              <td colspan="3"><p align="center">14</p></td>
              <td colspan="16"><p>PROFISSIOGRAFIA</p></td>
            </tr>
            <tr>
              <td colspan="5"><p>14.1- Período</p></td>
              <td colspan="14"><p>14.2- Descrição das Atividades</p></td>
            </tr>
            <tr>
              <td colspan="5"><p align="center"><strong><?php echo implode("/",array_reverse(explode("-",$admissao))); ?></strong></p></td>
              <td colspan="14" valign="top"><p>Auxílio a todos os serviços, compactação de solo, quebra de    pavimento, ajustes de tubulação, emenda, manuseio de cola branca.</p></td>
            </tr>
          </table>
            <table border="1" cellspacing="0" cellpadding="0" width="1000">
              <tr>
                <td width="71"><p align="center">II</p></td>
                <td colspan="10"><p>SEÇÃO DE REGISTROS AMBIENTAIS</p></td>
              </tr>
              <tr>
                <td width="71"><p align="center">15</p></td>
                <td colspan="10"><p>EXPOSIÇÃO A FATORES DE RISCOS</p></td>
              </tr>
              <tr>
                <td colspan="2"><p>15.1- Período</p></td>
                <td width="84"><p>15.2- Tipo</p></td>
                <td colspan="2"><p>15.3- Fator de Risco</p></td>
                <td colspan="2"><p>15.4- Intens./Conc.</p></td>
                <td width="103"><p>15.5- Técnica Utilizada</p></td>
                <td width="77"><p>15.6- EPC<br>
                  Eficaz (S/N)</p></td>
                <td width="77"><p>15.7- EPI<br>
                  Eficaz (S/N)</p></td>
                <td width="369"><p>15.8- CA EPI </p></td>
              </tr>
              <tr>
                <td colspan="2" valign="top"><p align="center"><strong>&nbsp;</strong></p>
                  <p align="center"><strong><?php echo implode("/",array_reverse(explode("-",$admissao))); ?></strong></p></td>
                <td width="84" valign="top"><p>         F</p></td>
                <td colspan="2" valign="top"><p>Ruído</p></td>
                <td colspan="2" valign="top"><p align="center">91.5 dB (A)</p></td>
                <td width="103"><p align="center">Dosimetria de Ruído</p></td>
                <td width="77"><p align="center"><strong>NA</strong></p></td>
                <td width="77"><p align="center">S</p></td>
                <td width="369"><p align="center">5.339</p></td>
              </tr>
              <tr>
                <td width="71"><p align="center">16</p></td>
                <td colspan="10"><p>RESPONSÁVEL PELOS REGISTROS AMBIENTAIS</p></td>
              </tr>
              <tr>
                <td colspan="2"><p>16.1- Período</p></td>
                <td colspan="2"><p>16.2- NIT</p></td>
                <td colspan="2"><p>16.3- Registro Conselho de Classe</p></td>
                <td colspan="5"><p>16.4- Nome do Profissional Legalmente    Habilitado</p></td>
              </tr>
              <tr>
                <td colspan="2" valign="top"><p align="center"><strong>&nbsp;</strong></p>
                  <p align="center"><strong><?php echo implode("/",array_reverse(explode("-",$admissao))); ?></strong><strong> </strong></p></td>
                <td colspan="2" valign="top"><p align="center">&nbsp;</p>
                  <p align="center"><strong>505.344.596-68</strong></p></td>
                <td colspan="2" valign="top"><p>&nbsp;</p>
                  <p>&nbsp;</p></td>
                <td colspan="5" valign="top"><p>&nbsp;</p>
                  <p><strong>                        Ivana Lopes Miranda</strong></p></td>
              </tr>
          </table>
            <table border="1" cellspacing="0" cellpadding="0">
              <tr>
                <td width="111"><p align="center">III</p></td>
                <td colspan="5"><p>SEÇÃO DE RESULTADOS DE MONITORAÇÃO BIOLÓGICA </p></td>
              </tr>
              <tr>
                <td width="111"><p align="center">17</p></td>
                <td colspan="5"><p>EXAMES MÉDICOS CLÍNICOS E COMPLEMENTARES (Quadros I e II, da NR-07) </p></td>
              </tr>
              <tr>
                <td colspan="2"><p>17.1- Data</p></td>
                <td width="79"><p>17.2- Tipo</p></td>
                <td width="93"><p>17.3- Natureza</p></td>
                <td width="112"><p>17.4- Exame (R/S)</p></td>
                <td width="590"><p>17.5- Indicação de Resultados</p></td>
              </tr>
            </table>
            <table border="1" cellspacing="0" cellpadding="0" width="1003">
              <tr>
                <td colspan="2"><p align="center"><strong><?php echo implode("/",array_reverse(explode("-",$admissao))); ?></strong></p></td>
                <td colspan="2" valign="top"><p>&nbsp;</p></td>
                <td colspan="2" valign="top"><p>&nbsp;</p></td>
                <td width="133" valign="top"><p>&nbsp;</p></td>
                <td colspan="2" valign="top"><p>(   ) Normal<br>
                  -      </p></td>
                <td width="585" valign="top"><p>(   )    Alterado<br>
                  (   )    Estável<br>
                  (   )    Agravamento<br>
                  (   )    Ocupacional<br>
                  (   )    Não Ocupacional</p></td>
              </tr>
              <tr>
                <td width="71"><p align="center">18</p></td>
                <td colspan="9"><p>RESPONSÁVEL PELA MONITORAÇÃO BIOLÓGICA</p></td>
              </tr>
              <tr>
                <td colspan="3"><p>18.1- Período</p></td>
                <td colspan="2"><p>18.2- NIT</p></td>
                <td colspan="3"><p>18.3- Registro Conselho de Classe</p></td>
                <td colspan="2"><p>18.4- Nome do Profissional Legalmente    Habilitado </p></td>
              </tr>
              <tr>
                <td colspan="3" valign="top"><p align="center">__/__/___    a __/__/___</p></td>
                <td colspan="2" valign="top"><p>&nbsp;</p></td>
                <td colspan="3" valign="top"><p>&nbsp;</p></td>
                <td colspan="2" valign="top"><p>&nbsp;</p></td>
              </tr>
            </table>
            <table width="1003" border="1" cellpadding="0" cellspacing="0">
              <tr>
                <td width="37"><p align="center">IV</p></td>
                <td width="681" colspan="4"><p>RESPONSÁVEIS PELAS INFORMAÇÕES </p></td>
              </tr>
              <tr>
                <td width="718" colspan="5"><p><em>Declaramos, para todos os fins de direito, que as informações    prestadas neste documento são verídicas e foram transcritas fielmente dos    registros administrativos, das demonstrações ambientais e dos programas    médicos de responsabilidade da empresa. É de nosso conhecimento que a    prestação de informações falsas neste documento constitui crime de    falsificação de documento público, nos termos do artigo 297 do Código Penal    e, também, que tais informações são de caráter privativo do trabalhador,    constituindo crime, nos termos da Lei nº 9.029/95, práticas discriminatórias    decorrentes de sua exigibilidade por outrem, bem como de sua divulgação para    terceiros, ressalvado quando exigida pelos órgãos públicos competentes.</em></p></td>
              </tr>
              <tr>
                <td width="137" colspan="2"><p>19- Data Emissão PPP </p></td>
                <td width="24"><p align="center">20</p></td>
                <td width="558" colspan="2"><p>REPRESENTANTE LEGAL DA EMPRESA</p></td>
              </tr>
              <tr>
                <td width="137" colspan="2" rowspan="2"><p align="center"><strong><?php echo implode("/",array_reverse(explode("-",$admissao))); ?></strong></p></td>
                <td width="264" colspan="2" valign="top"><p>20.1-NIT:  <strong>739.292.558-04</strong></p></td>
                <td width="318" valign="top"><p>20.2- Nome: <br>
                  <strong>JOÃO MOURA NUNES</strong></p></td>
              </tr>
              <tr>
                <td width="264" colspan="2" valign="top"><p align="center">&nbsp;</p>
                  <p align="center">(Carimbo)</p></td>
                <td width="318" valign="top"><p>&nbsp;</p>
                  <p align="center">__________________________________<br>
                  (Assinatura)</p></td>
              </tr>
            </table>
            <table width="1003" border="1" cellpadding="0" cellspacing="0">
              <tr>
                <td width="996"><p>OBSERVAÇÕES</p></td>
              </tr>
              <tr>
                <td width="996"><p>.</p></td>
              </tr>
            </table>
            <p></p></td>
        </tr>
    </table>
  </tr>
</div>
</table>
</body>

</html>