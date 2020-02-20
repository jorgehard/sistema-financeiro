<?php 
	include("../config.php");
	include("../validar_session.php");
	getData();
?>
<script> 
	window.onload = function () {
		//window.print();
		//open(location, '_self').close();
	};
</script>

<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />
<title>Impressão - Polêmica Construtora</title>
<link rel="icon" href="../../imagens/logo.ico" type="image/x-icon"/>
<link rel="shortcut icon" href="../../imagens/logo.ico" type="image/x-icon"/>
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
@media print
{    
    .hidden-print
    {
        display: none !important;
    }
}

.btn-print{
	width:1027px;
	letter-spacing:5px; 
	text-align:center; 
	background:#F0AD4E; 
	color:#fff; 
	display:block;
	text-decoration:none;
	padding:20px;
	margin-top:10px;
	
}
</style>

<?php
$sql = mysql_query("select * from rh_funcionarios where id = $id");
while($l = mysql_fetch_array($sql)) { extract($l); $i_num = $id;  }

$data_2 = mb_convert_encoding(strftime( '%A, %d de %B de %Y', strtotime($admissao)), "UTF-8");
$data_1 = mb_convert_encoding(strftime( '%A, %d de %B de %Y', strtotime($todayTotal)), "UTF-8");
?>
<body>
<a href="javascript:window.print()" class="hidden-print btn-print"> <span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir</a>
<?php if($eprint == '1'){ ?>
<table width="1027" border="0" id="transporte1">
  <tr>
    <td>
		<h2 align="left" style="padding-bottom:20px; border-bottom:1px solid #000;">
			<div class="cabecalho" >
				<table width="1062" border="0">
					<tr>
						<td width="100" height="120">
							<img src="http://guaruja.polemicalitoral.com.br/imagens/logo.png" width="90" height="110">
						</td>
						<td width="899" class="cabecalho22"><p>Polêmica Serviços Básicos Ltda<br />
							Rua Euclides Miragaia. 700 – salas 82 e 83 – Centro - CEP: 12245-820 <br />
							São José dos Campos – São Paulo<br />
							Telefax (012) 3941-8555 <br />
							E-MAIL:      contato@polemica.construtora.com.br <br />
							SITE:      www.polemicaconstrutora.com.br</p>
						</td>
					</tr>
				</table>
			</div>
		</h2>

      <br clear="all" />

	  <h2 class="contratocenter" style="font-family: 'Tahoma', sans-serif;">CONTRATO DE EXPERIÊNCIA</h2>

      <p>&nbsp;</p>

      <h1 class="corpo" style="font-size:23px;">Pelo presente instrumento particular de Contrato de Experiência, a empresa <strong>POLÊMICA SERVIÇOS BÁSICOS LTDA.</strong>, com sede na Rua Euclides Miragaia, 700 sala 82 e 83 – na Cidade de São José dos Campos, Estado de SP, inscrita no CNPJ do MF sob n.º 61.870.101/0001-08 denominada a seguir Empregadora, e o Sr.(a) <strong><?php echo $nome; ?></strong> domiciliado na, <strong><?php echo $endereco; ?></strong> portador(a) da CTPS n.º <strong><?php 	echo $carteira_profissional; ?></strong> série <strong><?php echo $serie; ?></strong> doravante designado Empregado, celebram o presente Contrato Individual de Trabalho para fins de experiência, conforme a letra “c” inciso 2º. Do artigo 443 da Consolidação das Leis de Trabalho, mediante as seguintes condições:<br/>
		<strong>1º</strong> - O Empregado trabalhará para Empregadora na função de <strong><?php echo mysql_result(mysql_query("SELECT * FROM rh_funcoes WHERE id = $funcao"),0,"descricao");?></strong> e mais as funções que vierem a ser objeto de ordens verbais, cartas ou avisos, segundo as necessidades da Empregadora desde que compatíveis com suas atribuições.<br/>
		<strong>2º</strong> - O local de trabalho fica em – <strong><?php echo $cidade_servico ?></strong> podendo a Empregadora, a qualquer tempo, transferir o Empregado a título temporário ou definitivo, tanto no âmbito da unidade para a qual foi admitido, como para outras, em qualquer localidade deste Estado ou de outro dentro do País.<br/>
		<strong>3º</strong> - O horário de trabalho do Empregado será o seguinte: De <strong><?php echo $trabalho_periodo ?></strong> das <strong><?php echo $trabalho_entrada ?></strong> às <strong><?php echo $trabalho_saida ?></strong>, com <strong><?php echo $trabalho_refeicao ?></strong> de intervalo para refeição.<br/>
		<strong>4º</strong> - O Empregado recebera a remuneração de: <strong>R$ <?php echo number_format(mysql_result(mysql_query("SELECT * FROM rh_funcoes WHERE id = $funcao"),0,"salario"),2,",",".");?></strong> por mês.<br/>
		<strong>5º</strong> - O empregado se compromete a trabalhar em regime de compensação e de prorrogação de horas, inclusive em período noturno, sempre que as necessidades assim o exigirem, observadas as formalidades legais.<br/>
		<?php
		if($expdias == 1){
			$expdias = 45;
			$venc_expdias = date('d/m/Y', strtotime("+45 days",strtotime($admissao)));
		}else if($expdias == 2){
			$expdias = 30;
			$venc_expdias = date('d/m/Y', strtotime("+30 days",strtotime($admissao)));
		}else{
			$expdias = 0;
			$venc_expdias = 0;
		}
		?>
		<strong>6º</strong> - O prazo deste contrato é de <?php echo $expdias ?> dias, com início em <?php	echo date('d/m/Y', strtotime($admissao)); ?> e término em <?php echo $venc_expdias; ?> podendo ser prorrogado, obedecido o disposto no Parágrafo Único do Artigo 455 da CLT.<br/>
		<strong>7º</strong> - Além dos descontos previstos em Lei, reserva-se a Empregadora o direito de descontar do Empregado as importâncias correspondentes ao dano por eles causado, seja decorrentes de dolo ou culpa.<br/>
		<strong>8º</strong> - O Empregado fica ciente do Regulamento da Empresa e das Normas de Segurança que regulam suas atividades na Empregadora e se compromete a usar os equipamentos de segurança fornecidos, sob pena de ser punido por falta grave, nos termos da Legislação vigente e demais disposições inerentes a segurança e medicina do trabalho.<br/>
		<strong>9º</strong> - Vencido o período experimental e continuando o empregado a prestar serviços à Empregadora, por tempo indeterminado, ficam prorrogadas todas as cláusulas aqui estabelecidas, enquanto não se rescindir o contrato de trabalho.<br/>
		Tendo assim contratado, assinam o presente instrumento, em duas vias, na presença das testemunhas abaixo.
		</h1>


		<p>&nbsp;</p>
	
		<p>&nbsp;</p>
		
		 <h1 class="corpo"><p>São José dos Campos, <?php echo ucfirst($data_1); ?> </p></h1>
		
		<p>&nbsp;</p>
		<p>&nbsp;</p>

	        <p><strong></strong><strong> </strong></p>
      <p>______________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                                            __________________________________________<br />

        <strong>POLÊMICA SERVIÇOS  BÁSICOS LTDA                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;             </strong><strong><?php echo $nome ?></strong></p>
      <p><strong>&nbsp;</strong></p>
<p>&nbsp;</p>
		<p>&nbsp;</p><p>&nbsp;</p>
		<p>&nbsp;</p>
      </td>
  </tr>
</table>
<?php exit; } ?>
<?php if($eprint == '2'){ ?>
<table width="1027" border="0">
  <tr>
    <td>
		<h2 align="left" style="padding-bottom:20px; border-bottom:1px solid #000;">
			<div class="cabecalho" >
				<table width="1062" border="0">
					<tr>
						<td width="100" height="120">
							<img src="http://guaruja.polemicalitoral.com.br/imagens/logo.png" width="90" height="110">
						</td>
						<td width="899" class="cabecalho22"><p>Polêmica Serviços Básicos Ltda<br />
							Rua Euclides Miragaia. 700 – salas 82 e 83 – Centro - CEP: 12245-820 <br />
							São José dos Campos – São Paulo<br />
							Telefax (012) 3941-8555 <br />
							E-MAIL:      contato@polemica.construtora.com.br <br />
							SITE:      www.polemicaconstrutora.com.br</p>
						</td>
					</tr>
				</table>
			</div>
		</h2>

      <br clear="all" />

	  <h2 class="contratocenter" style="font-family: 'Tahoma', sans-serif;">PRORROGAÇÃO DO CONTRATO DE EXPERIÊNCIA</h2>

      <p>&nbsp;</p>

      <h1 class="corpo" style="font-size:23px;">
		<?php
		if($expdias == 1){
			$expdias = 45;
			$venc_expdias = date('d/m/Y', strtotime("+45 days",strtotime($admissao)));
			
			$venc_expdias2 = date('d/m/Y', strtotime("+45 days",strtotime(date('Y-m-d', strtotime("+45 days",strtotime($admissao))))));
		}else if($expdias == 2){
			$expdias = 60;
			$venc_expdias = date('d/m/Y', strtotime("+30 days",strtotime($admissao)));
			$venc_expdias2 = date('d/m/Y', strtotime("+60 days",strtotime(date('Y-m-d', strtotime("+30 days",strtotime($admissao))))));
		}else{
			$expdias = 0;
			$venc_expdias = 0;
		}
		?>
		Por mútuo acordo entre as partes, fica o presente Contrato de experiência que deveria terminar em 
		<?php echo $venc_expdias ?> fica prorrogado por mais <?php echo $expdias ?> dias até <?php echo $venc_expdias2 ?>.

		</h1>


		<p>&nbsp;</p>
	
		<p>&nbsp;</p>
		
		 <h1 class="corpo"><p>São José dos Campos, <?php echo ucfirst($data_1); ?> </p></h1>
		
		<p>&nbsp;</p>
		<p>&nbsp;</p>

	        <p><strong></strong><strong> </strong></p>
      <p>______________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                                            __________________________________________<br />

        <strong>POLÊMICA SERVIÇOS  BÁSICOS LTDA                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;             </strong><strong><?php echo $nome ?></strong></p>
      <p><strong>&nbsp;</strong></p>
<p>&nbsp;</p>
		<p>&nbsp;</p><p>&nbsp;</p>
		<p>&nbsp;</p>
      </td>
  </tr>
</table>
<?php exit; } ?>
<?php if($eprint == '3'){ ?>
<table width="1027" border="0" id="transporte1">
  <tr>
    <td>
		<h2 align="left" style="padding-bottom:20px; border-bottom:1px solid #000;">
			<div class="cabecalho" >
				<table width="1062" border="0">
					<tr>
						<td width="100" height="120">
							<img src="http://guaruja.polemicalitoral.com.br/imagens/logo.png" width="90" height="110">
						</td>
						<td width="899" class="cabecalho22"><p>Polêmica Serviços Básicos Ltda<br />
							Rua Euclides Miragaia. 700 – salas 82 e 83 – Centro - CEP: 12245-820 <br />
							São José dos Campos – São Paulo<br />
							Telefax (012) 3941-8555 <br />
							E-MAIL:      contato@polemica.construtora.com.br <br />
							SITE:      www.polemicaconstrutora.com.br</p>
						</td>
					</tr>
				</table>
			</div>
		</h2>

		<br clear="all" />

		<h2 class="contratocenter" style="font-family: 'Tahoma', sans-serif;">DECLARAÇÃO DE BENEFICIÁRIO DE VALE TRANSPORTE</h2>

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
		<h1 class="corpo"><p>São José dos Campos, <?php echo ucfirst($data_1); ?> </p></h1>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p><strong></strong><strong> </strong></p>
		<p>______________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                                            __________________________________________<br />
        <strong>POLÊMICA SERVIÇOS  BÁSICOS LTDA                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;             </strong><strong><?php echo $nome ?></strong></p>
		<p><strong>&nbsp;</strong></p>
      </td>
  </tr>
</table>
<?php exit; } ?>
<?php if($eprint == '4'){ ?>
<table width="1027" border="0" id="transporte1">
  <tr>
    <td>
		<h2 align="left" style="padding-bottom:20px; border-bottom:1px solid #000;">
			<div class="cabecalho" >
				<table width="1062" border="0">
					<tr>
						<td width="100" height="120">
							<img src="http://guaruja.polemicalitoral.com.br/imagens/logo.png" width="90" height="110">
						</td>
						<td width="899" class="cabecalho22"><p>Polêmica Serviços Básicos Ltda<br />
							Rua Euclides Miragaia. 700 – salas 82 e 83 – Centro - CEP: 12245-820 <br />
							São José dos Campos – São Paulo<br />
							Telefax (012) 3941-8555 <br />
							E-MAIL:      contato@polemica.construtora.com.br <br />
							SITE:      www.polemicaconstrutora.com.br</p>
						</td>
					</tr>
				</table>
			</div>
		</h2>

      <br clear="all" />

	  <h2 class="contratocenter" style="font-family: 'Tahoma', sans-serif;">CONTRATO DE TRABALHO</h2>

      <p>&nbsp;</p>

      <h1 class="corpo" style="font-size:23px;">Pelo presente instrumento particular de Contrato de Experiência, a empresa <strong>POLÊMICA SERVIÇOS BÁSICOS LTDA.</strong>, com sede na Rua Euclides Miragaia, 700 sala 82 e 83 – na Cidade de São José dos Campos, Estado de SP, inscrita no CNPJ do MF sob n.º 61.870.101/0001-08 denominada a seguir Empregadora, e o Sr.(a) <strong><?php echo $nome; ?></strong> domiciliado na, <strong><?php echo $endereco; ?></strong> portador(a) da CTPS n.º <strong><?php 	echo $carteira_profissional; ?></strong> série <strong><?php echo $serie; ?></strong> doravante designado Empregado, celebram o presente Contrato Individual de Trabalho para fins de experiência, conforme a letra “c” inciso 2º. Do artigo 443 da Consolidação das Leis de Trabalho, mediante as seguintes condições:<br/>
		<strong>1º</strong> - O Empregado trabalhará para Empregadora na função de <strong><?php echo mysql_result(mysql_query("SELECT * FROM rh_funcoes WHERE id = $funcao"),0,"descricao");?></strong> e mais as funções que vierem a ser objeto de ordens verbais, cartas ou avisos, segundo as necessidades da Empregadora desde que compatíveis com suas atribuições.<br/>
		<strong>2º</strong> - O local de trabalho fica em – <strong><?php echo $cidade_servico ?></strong> podendo a Empregadora, a qualquer tempo, transferir o Empregado a título temporário ou definitivo, tanto no âmbito da unidade para a qual foi admitido, como para outras, em qualquer localidade deste Estado ou de outro dentro do País.<br/>
		<strong>3º</strong> - O horário de trabalho do Empregado será o seguinte: De <strong><?php echo $trabalho_periodo ?></strong> das <strong><?php echo $trabalho_entrada ?></strong> às <strong><?php echo $trabalho_saida ?></strong>, com <strong><?php echo $trabalho_refeicao ?></strong> de intervalo para refeição.<br/>
		<strong>4º</strong> - O Empregado recebera a remuneração de: <strong>R$ <?php echo number_format(mysql_result(mysql_query("SELECT * FROM rh_funcoes WHERE id = $funcao"),0,"salario"),2,",",".");?></strong> por mês.<br/>
		<strong>5º</strong> - O empregado se compromete a trabalhar em regime de compensação e de prorrogação de horas, inclusive em período noturno, sempre que as necessidades assim o exigirem, observadas as formalidades legais.<br/>
		<strong>6º</strong> - Além dos descontos previstos em Lei, reserva-se a Empregadora o direito de descontar do Empregado as importâncias correspondentes ao dano por eles causado, seja decorrentes de dolo ou culpa.<br/>
		<strong>7º</strong> - O Empregado fica ciente do Regulamento da Empresa e das Normas de Segurança que regulam suas atividades na Empregadora e se compromete a usar os equipamentos de segurança fornecidos, sob pena de ser punido por falta grave, nos termos da Legislação vigente e demais disposições inerentes a segurança e medicina do trabalho.<br/>
		<strong>8º</strong> - Vencido o período experimental e continuando o empregado a prestar serviços à Empregadora, por tempo indeterminado, ficam prorrogadas todas as cláusulas aqui estabelecidas, enquanto não se rescindir o contrato de trabalho.<br/>
		Tendo assim contratado, assinam o presente instrumento, em duas vias, na presença das testemunhas abaixo.
		</h1>


		<p>&nbsp;</p>
	
		<p>&nbsp;</p>
		
		 <h1 class="corpo"><p>São José dos Campos, <?php echo ucfirst($data_1); ?> </p></h1>
		
		<p>&nbsp;</p>
		<p>&nbsp;</p>

	        <p><strong></strong><strong> </strong></p>
      <p>______________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                                            __________________________________________<br />

        <strong>POLÊMICA SERVIÇOS  BÁSICOS LTDA                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;             </strong><strong><?php echo $nome ?></strong></p>
      <p><strong>&nbsp;</strong></p>
<p>&nbsp;</p>
		<p>&nbsp;</p><p>&nbsp;</p>
		<p>&nbsp;</p>
      </td>
  </tr>
</table>
<?php exit; } ?>
<?php if($eprint == '5'){ ?>
<table width="1027" border="0" id="transporte1">
  <tr>
    <td>
		<h2 align="left" style="padding-bottom:20px; border-bottom:1px solid #000;">
			<div class="cabecalho" >
				<table width="1062" border="0">
					<tr>
						<td width="100" height="120">
							<img src="http://guaruja.polemicalitoral.com.br/imagens/logo.png" width="90" height="110">
						</td>
						<td width="899" class="cabecalho22"><p>Polêmica Serviços Básicos Ltda<br />
							Rua Euclides Miragaia. 700 – salas 82 e 83 – Centro - CEP: 12245-820 <br />
							São José dos Campos – São Paulo<br />
							Telefax (012) 3941-8555 <br />
							E-MAIL:      contato@polemica.construtora.com.br <br />
							SITE:      www.polemicaconstrutora.com.br</p>
						</td>
					</tr>
				</table>
			</div>
		</h2>

      <br clear="all" />

	  <h2 class="contratocenter" style="font-family: 'Tahoma', sans-serif;">ACORDO DE COMPENSAÇÃO DE HORAS</h2>

      <p>&nbsp;</p>
	  
      <p>&nbsp;</p>

      <h1 class="corpo" style="font-size:23px;"> 
		Empregador: 035 – Polêmica Serviços  Básicos Ltda.                CNPJ: 61.870.101/0001-08</h1>

		<h1 class="corpo" style="font-size:23px;">
			<p>
				Entre a empresa <strong>POLÊMICA  SERVIÇOS BÁSICOS LTDA., </strong>com estabelecimento situado à Rua Euclides Miragaia, 700 sala 82/83 – CEP 12245-820 - CENTRO – São José dos Campos – SP, com o Ramo de Prestação de Serviços, neste ato representada pelo Sr. João Moura Nunes, e seu Empregado (a) <strong><?php echo $nome ?> </strong>abaixo  assinado, portador (a) da Carteira de Trabalho e Previdência Social nº <strong><?php echo $carteira_profissional ?> </strong> série <strong><?php echo $serie ?>   </strong>fica acertado que o horário normal  de trabalho será o seguinte:
			</p>
		</h1>

      <p>&nbsp;</p>

      <h1 class="corpo" style="font-size:23px;"> <p>Das <strong><?php echo $trabalho_entrada; ?> </strong>às <strong><?php echo $trabalho_saida; ?> </strong>Segunda a Quinta-feira, e as  Sextas – Feiras das <strong><?php echo $sexta_entrada; ?> </strong>às <strong><?php echo $sexta_saida; ?> </strong>com <strong>01h </strong>de intervalo para refeição e descanso<strong>.</strong></p></h1>

      <p>&nbsp;</p>

       <h1 class="corpo" style="font-size:23px;"><p>Perfazendo o total de 44 Horas semanais.</p></h1>

      <p>&nbsp;</p>

       <h1 class="corpo" style="font-size:23px;"><p>Estando de pleno acordo, assinam o presente em 02 (duas)  vias.<br />

        O presente acordo vigorará pelo prazo indeterminado.</p></h1>


		<p>&nbsp;</p>
	
		<p>&nbsp;</p>
		
		<h1 class="corpo" style="font-size:23px;"><p>São José dos Campos, <?php echo ucfirst($data_1); ?> </p></h1>
		
		<p>&nbsp;</p>
		
		<p>&nbsp;</p>
		
		<p>&nbsp;</p>

	    <p><strong></strong><strong> </strong></p>
		<p>______________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                                            __________________________________________<br />

        <strong>POLÊMICA SERVIÇOS  BÁSICOS LTDA                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;             </strong><strong><?php echo $nome ?></strong></p>
		<p><strong>&nbsp;</strong></p>
		<p>&nbsp;</p>
		<p>&nbsp;</p><p>&nbsp;</p>
		<p>&nbsp;</p>
      </td>
  </tr>
</table>
<?php exit; } ?>
<?php if($eprint == '6'){ ?>
<table width="1027" border="0" id="transporte1">
  <tr>
    <td>
		<h2 align="left" style="padding-bottom:20px; border-bottom:1px solid #000;">
			<div class="cabecalho" >
				<table width="1062" border="0">
					<tr>
						<td width="100" height="120">
							<img src="http://guaruja.polemicalitoral.com.br/imagens/logo.png" width="90" height="110">
						</td>
						<td width="899" class="cabecalho22"><p>Polêmica Serviços Básicos Ltda<br />
							Rua Euclides Miragaia. 700 – salas 82 e 83 – Centro - CEP: 12245-820 <br />
							São José dos Campos – São Paulo<br />
							Telefax (012) 3941-8555 <br />
							E-MAIL:      contato@polemica.construtora.com.br <br />
							SITE:      www.polemicaconstrutora.com.br</p>
						</td>
					</tr>
				</table>
			</div>
		</h2>

      <br clear="all" />
			<p>&nbsp;</p>
		
			<h2 class="contratocenter" style="font-family: 'Tahoma', sans-serif;">AUTORIZAÇÃO PARA DESCONTO DE VALE REFEIÇÃO</h2>

			<p>&nbsp;</p>

			<p>&nbsp;</p>

			<h1 class="corpo"> 
	 
				<p>Autorizo a empresa <strong>Polêmica Serviços Básicos Ltda.</strong>, a descontar mensalmente de meus vencimentos, o equivalente a 10% (dez por cento) do valor dos vales refeição por mim recebidos, durante o mês. </p>

				<p>&nbsp;</p>

				<p>&nbsp;</p>
	 
				<p>São José dos Campos, <?php echo strtoupper($data_1); ?> </p>
			</h1>
			<h1 class="corpo">&nbsp;</h1>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			
	        <p><strong></strong><strong> </strong></p>
			<p>______________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                                            __________________________________________<br />

			<strong>POLÊMICA SERVIÇOS  BÁSICOS LTDA                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;          </strong><strong><?php echo $nome ?></strong></p>

			<p><strong>&nbsp;</strong></p>

			<p>____________________________________	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;____________________________________________<br />

			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Testemunha                                                                                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     Responsável (qdo. Menor)</p>
		</td>
	</tr>
	</table>
<?php exit; } ?>
<?php if($eprint == '7'){ ?>
	<table width="1027" border="0" id="transporte1">
	<tr>
		<td>
		<h2 align="left" style="padding-bottom:20px; border-bottom:1px solid #000;">
			<div class="cabecalho" >
				<table width="1062" border="0">
					<tr>
						<td width="100" height="120">
							<img src="http://guaruja.polemicalitoral.com.br/imagens/logo.png" width="90" height="110">
						</td>
						<td width="899" class="cabecalho22"><p>Polêmica Serviços Básicos Ltda<br />
							Rua Euclides Miragaia. 700 – salas 82 e 83 – Centro - CEP: 12245-820 <br />
							São José dos Campos – São Paulo<br />
							Telefax (012) 3941-8555 <br />
							E-MAIL:      contato@polemica.construtora.com.br <br />
							SITE:      www.polemicaconstrutora.com.br</p>
						</td>
					</tr>
				</table>
			</div>
		</h2>

      <br clear="all" />

			<h2 class="contratocenter" style="font-family: 'Tahoma', sans-serif;">RECIBO DE DEVOLUÇÃO DE CTPS</h2>

			<p>&nbsp;</p>

			<p>&nbsp;</p>

			<h1 class="corpo"> 
	 
				<p>Eu <strong><?php echo $nome; ?></strong> declaro que recebi para os devidos fins, Carteira de Trabalho e Previdência Social nº <strong><?php echo $carteira_profissional; ?></strong> Série <strong><?php echo $serie; ?></strong>  com as devidas anotações. </p>

				<p>&nbsp;</p>

				<p>&nbsp;</p>
	 
				<p>São José dos Campos, <?php echo strtoupper($data_1); ?> </p>
			</h1>
			<h1 class="corpo">&nbsp;</h1>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			
	        <p><strong></strong><strong> </strong></p>
			<p>______________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                                            __________________________________________<br />

			<strong>POLÊMICA SERVIÇOS  BÁSICOS LTDA                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;          </strong><strong><?php echo $nome ?></strong></p>

			<p><strong>&nbsp;</strong></p>

			<p>____________________________________	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;____________________________________________<br />

			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Testemunha                                                                                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     Responsável (qdo. Menor)</p>
						
			<p><strong>&nbsp;</strong></p>
			
			<p><strong>&nbsp;</strong></p>
			
			<p><strong>&nbsp;</strong></p>
			
			<p><strong>&nbsp;</strong></p>
			
			<p><strong>&nbsp;</strong></p>
			
			<p><strong>&nbsp;</strong></p>
			
			<p><strong>&nbsp;</strong></p>
			<h1 class="corpo">
			<p>Pôlemica Serviços Basicos Ltda.<br/> Contrato: <?php echo mysql_result(mysql_query("SELECT * FROM notas_obras WHERE id = $obra"),0,"descricao"); ?></p>
			</h1>
		</td>
	</tr>
	</table>
<?php exit; } ?>
<?php if($eprint == '8'){ ?>
<table width="1027" border="0" id="transporte1">
  <tr>
    <td>
		<h2 align="left" style="padding-bottom:20px; border-bottom:1px solid #000;">
			<div class="cabecalho" >
				<table width="1062" border="0">
					<tr>
						<td width="100" height="120">
							<img src="http://guaruja.polemicalitoral.com.br/imagens/logo.png" width="90" height="110">
						</td>
						<td width="899" class="cabecalho22"><p>Polêmica Serviços Básicos Ltda<br />
							Rua Euclides Miragaia. 700 – salas 82 e 83 – Centro - CEP: 12245-820 <br />
							São José dos Campos – São Paulo<br />
							Telefax (012) 3941-8555 <br />
							E-MAIL:      contato@polemica.construtora.com.br <br />
							SITE:      www.polemicaconstrutora.com.br</p>
						</td>
					</tr>
				</table>
			</div>
		</h2>

      <br clear="all" />

			<h2 class="contratocenter" style="font-family: 'Tahoma', sans-serif;">RECIBO DE ENTREGA DE CTPS</h2>

			<p>&nbsp;</p>

			<p>&nbsp;</p>

			<h1 class="corpo"> 
	 
				<p>Eu <strong><?php echo $nome; ?></strong> declaro para os devidos fins, que nesta data, entreguei a minha Carteira de Trabalho e Previdência Social nº <strong><?php echo $carteira_profissional; ?></strong> Série <strong><?php echo $serie; ?></strong>, para registro da minha admissão na empresa <strong>Pôlemica Serviços Básicos Ltda.</strong> </p>

				<p>&nbsp;</p>

				<p>&nbsp;</p>
	 
				<p>São José dos Campos, <?php echo strtoupper($data_1); ?> </p>
			</h1>
			<h1 class="corpo">&nbsp;</h1>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			
	        <p><strong></strong><strong> </strong></p>
			<p>______________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                                            __________________________________________<br />

			<strong>POLÊMICA SERVIÇOS  BÁSICOS LTDA                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;          </strong><strong><?php echo $nome ?></strong></p>

			<p><strong>&nbsp;</strong></p>

			<p>____________________________________	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;____________________________________________<br />

			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Testemunha                                                                                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     Responsável (qdo. Menor)</p>
						
			<p><strong>&nbsp;</strong></p>
			
			<p><strong>&nbsp;</strong></p>
			
			<p><strong>&nbsp;</strong></p>
			
			<p><strong>&nbsp;</strong></p>
			
			<p><strong>&nbsp;</strong></p>
			
			<p><strong>&nbsp;</strong></p>
			
			<p><strong>&nbsp;</strong></p>
			<h1 class="corpo">
			<p>Pôlemica Serviços Basicos Ltda.<br/> Contrato: <?php echo mysql_result(mysql_query("SELECT * FROM notas_obras WHERE id = $obra"),0,"descricao"); ?></p>
			</h1>
		</td>
	</tr>
	</table>
<?php exit; } ?>
<?php if($eprint == '9'){ ?>
<table width="1027" border="0">
  <tr>
    <td>
		<h2 align="left" style="padding-bottom:20px; border-bottom:1px solid #000;">
			<div class="cabecalho" >
				<table width="1062" border="0">
					<tr>
						<td width="100" height="120">
							<img src="http://guaruja.polemicalitoral.com.br/imagens/logo.png" width="90" height="110">
						</td>
						<td width="899" class="cabecalho22"><p>Polêmica Serviços Básicos Ltda<br />
							Rua Euclides Miragaia. 700 – salas 82 e 83 – Centro - CEP: 12245-820 <br />
							São José dos Campos – São Paulo<br />
							Telefax (012) 3941-8555 <br />
							E-MAIL:      contato@polemica.construtora.com.br <br />
							SITE:      www.polemicaconstrutora.com.br</p>
						</td>
					</tr>
				</table>
			</div>
		</h2>

      <br clear="all" />

	  <h2 class="contratocenter" style="font-family: 'Tahoma', sans-serif;">TERMO DE SIGILO SOBRE INFORMAÇÕES</h2>

      <p>&nbsp;</p>
	  
      <p>&nbsp;</p>

		<h1 class="corpo" style="font-size:23px;">
			<p>
				Assumo o compromisso junto a POLÊMICA SERVIÇOS BÁSICOS LTDA, e a Companhia de Saneamento Básico do Estado de São Paulo – SABESP, de não divulgar a TERCEIROS os dados e informações (cadastro, nome, endereço, etc.) referentes ao Contrato SABESP e de seus Clientes.
			</p>
			
			<p>
				Declaro ainda não ignorar que CONSTITUI INFRAÇÃO à LEGISLAÇÃO a divulgação deste tipo de informação e estou ciente de que o desrespeito a esta norma importa em falta grave, com as sanções previstas em lei.
			</p>
		</h1>

      <p>&nbsp;</p>

		<p>&nbsp;</p>
	
		<p>&nbsp;</p>
		
		<h1 class="corpo" style="font-size:23px;"><p>São José dos Campos, <?php echo ucfirst($data_1); ?> </p></h1>
		
		<p>&nbsp;</p>
		
		<p>&nbsp;</p>
		
		<p>&nbsp;</p>

	    <p><strong></strong><strong> </strong></p>
		<p>______________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                                            __________________________________________<br />

        <strong>POLÊMICA SERVIÇOS  BÁSICOS LTDA                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;             </strong><strong><?php echo $nome ?></strong></p>
		<p><strong>&nbsp;</strong></p>
		<p>&nbsp;</p>
		<p>&nbsp;</p><p>&nbsp;</p>
		<p>&nbsp;</p>
      </td>
  </tr>
</table>
<?php exit; } ?>
<?php if($eprint == '10'){ ?>
<table width="1027" border="0">
  <tr>
    <td>
		<h2 align="left" style="padding-bottom:20px; border-bottom:1px solid #000;">
			<div class="cabecalho" >
				<table width="1062" border="0">
					<tr>
						<td width="100" height="120">
							<img src="http://guaruja.polemicalitoral.com.br/imagens/logo.png" width="90" height="110">
						</td>
						<td width="899" class="cabecalho22"><p>Polêmica Serviços Básicos Ltda<br />
							Rua Euclides Miragaia. 700 – salas 82 e 83 – Centro - CEP: 12245-820 <br />
							São José dos Campos – São Paulo<br />
							Telefax (012) 3941-8555 <br />
							E-MAIL:      contato@polemica.construtora.com.br <br />
							SITE:      www.polemicaconstrutora.com.br</p>
						</td>
					</tr>
				</table>
			</div>
		</h2>

      <br clear="all" />

	  <h2 class="contratocenter" style="font-family: 'Tahoma', sans-serif;">AUTORIZAÇÃO PARA DESCONTO DE CONTRIBUIÇÃO ASSISTENCIAL NEGOCIAL</h2>

      <p>&nbsp;</p>
	  
      <p>&nbsp;</p>

		<h1 class="corpo" style="font-size:23px;">
			<p>
				Eu, <strong><?php echo $nome ?></strong>, autorizo a empresa Polêmica Serviços Básicos Ltda., a descontar mensalmente dos meus vencimentos, o equivalente a 1% (um por cento) do salário básico a titulo de contribuição assistencial negocial, devendo o referido valor ser repassado ao sindicado representativo da categoria.
			</p>
		</h1>

      <p>&nbsp;</p>

		<p>&nbsp;</p>
	
		<p>&nbsp;</p>
		
		<h1 class="corpo" style="font-size:23px;"><p>São José dos Campos, <?php echo ucfirst($data_1); ?> </p></h1>
		
		<p>&nbsp;</p>
		
		<p>&nbsp;</p>
		
		<p>&nbsp;</p>

	    <p><strong></strong><strong> </strong></p>
		<p>______________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                                            __________________________________________<br />

        <strong>POLÊMICA SERVIÇOS  BÁSICOS LTDA                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;             </strong><strong><?php echo $nome ?></strong></p>
		<p><strong>&nbsp;</strong></p>
		<p>&nbsp;</p>
		<p>&nbsp;</p><p>&nbsp;</p>
		<p>&nbsp;</p>
      </td>
  </tr>
</table>
<?php exit; } ?>
<?php if($eprint == '11'){ ?>
<table width="1027" border="0">
  <tr>
    <td>
		<h2 align="left" style="padding-bottom:20px; border-bottom:1px solid #000;">
			<div class="cabecalho" >
				<table width="1062" border="0">
					<tr>
						<td width="100" height="120">
							<img src="http://guaruja.polemicalitoral.com.br/imagens/logo.png" width="90" height="110">
						</td>
						<td width="899" class="cabecalho22"><p>Polêmica Serviços Básicos Ltda<br />
							Rua Euclides Miragaia. 700 – salas 82 e 83 – Centro - CEP: 12245-820 <br />
							São José dos Campos – São Paulo<br />
							Telefax (012) 3941-8555 <br />
							E-MAIL:      adm@polemicalitoral.com.br <br />
							SITE:      www.polemicaconstrutora.com.br</p>
						</td>
					</tr>
				</table>
			</div>
		</h2>

		<br clear="all" />

		<h2 class="contratocenter" style="font-family: 'Tahoma', sans-serif; font-size:19px;"><u>Regulamento Interno</u></h2>

		<p>&nbsp;</p>
	  
		<h2 class="contratocenter" style="font-family: 'Tahoma', sans-serif; font-size:22px;">POLÊMICA SERVIÇOS BÁSICAS LTDA</h2>

		<p>&nbsp;</p>
		<ol>
			<h1 class="corpo" style="font-size:22px;"> 
				<li>
					<strong>Da  Integração no Contrato Individual de Trabalho</strong>
					<p><strong>Art.1º</strong> – O  presente Regulamento é parte integrante do contrato individual de trabalho. As  normas e preceitos nele contidos aplicam-se a todos os empregados,  complementando os princípios gerais de direitos e deveres contidos na  Consolidação das Leis do Trabalho (CLT).</p>
					<p><strong>Parágrafo único</strong> –  sua obrigatoriedade perdura o tempo de duração do contrato de trabalho, sendo  assim, o empregado que assinar o seu termo de ciência, não poderá alegar seu  desconhecimento.</p>
				</li>
				<li> 
					<strong>Da  Admissão</strong>
					<p><strong>Art. 2º</strong> – A admissão de  empregado condiciona-se a exames de seleção técnica e médica e mediante  apresentação dos documentos exigidos, no prazo fixado pelo empregador.</p>
				</li>
				<li> 
					<strong>Dos Deveres,  Obrigações e Responsabilidades do Empregado</strong>
					<p><strong>Art. 3º</strong> –  Todo empregado deve:</p>
					<p>a) Cumprir os  compromissos expressamente assumidos no contrato individual de trabalho, com  zelo, atenção e competência  profissional;<br />

						b) Obedecer às ordens e instruções emanadas de  seus superiores hierárquicos; <br />

						c) Sugerir medidas  para maior eficiência do serviço; <br />

						d) Observar a máxima  disciplina no local de trabalho; <br />

						e) Zelar pela boa  conservação das instalações, equipamentos e máquinas, comunicando as  anormalidades notadas; <br />

						f) Manter na vida  profissional conduta compatível com a dignidade do cargo ocupado e com a  reputação do quadro de pessoal da Empresa; <br />

						g) Usar os meios de  identificação pessoal estabelecidos; <br />

						h) Informar a área ou  responsável pelos recursos humanos sobre qualquer modificação em seus dados  pessoais, tais como, estado civil, militar, aumento ou redução de pessoas na  família, eventual mudança de residência, etc.;<br />

						i) Respeitar a honra,  boa fama e integridade física de todas as pessoas com quem mantiverem contato  por motivo de emprego.
					</p>

				</li>
				<li> 
					<strong>Das  Ausências, Saídas e Atrasos</strong>
					<p><strong>Art. 4º</strong> – O empregado que se  atrasar ao serviço, sair antes do término da jornada ou faltar por qualquer  motivo, deve justificar o fato ao superior imediato, verbalmente ou por  escrito, quando solicitado.</p>

					<p>§ 1 - Á empresa  cabe descontar os períodos relativos a atrasos, saídas mais cedo, sem prévia  autorização, faltas ao serviço, excetuada as faltas e ausências legais; <br />

					§ 2 - As faltas  ilegais, não justificadas perante a correspondente chefia, acarretam a  aplicação das penalidades previstas no item <strong>V </strong>deste regulamento; <br />

					§ 3°- As faltas  decorrentes de doença deverão ser abonadas através de Atestado Médico, com sua  apresentação dentro do prazo de 48 (quarenta e oito) horas, podendo ser  prorrogado por mais48 (quarenta e oito) horas, ou seja, prazo máximo de entrega  de Atestado Médico de 96 (noventa e seis) horas, 4 (quatro) dias, da data do início da ausência;<br />

					§ 4°- Documentos da  Previdência, como por exemplo: o de afastamento, certidão de nascimento de  filhos, certidão de casamento, certidão de óbito e qualquer semelhante, devem  ser apresentados no mesmo prazo do <strong>Art.  4º</strong>§ 3°, deste regulamento;<br />

					§ 5°- As  solicitações de abono de faltas, somente serão aceitas, se as justificativas,  com os correspondentes documentos de comprovação, forem apresentadas até 2  (dois) dias úteis após a data do início da ausência; </p>
				</li>
				<li>
					<strong>Penalidades</strong>
					<p>
						<strong>Art. 5º</strong> – Aos empregados  transgressores das normas deste Regulamento, aplicam-se as penalidades  seguintes:
					</p>
					<p>
						- Advertência verbal;<br/>
						- Advertência  escrita;<br/>
						- Suspensão; <br/>
						- Demissão, por justa  causa. 
					</p>
					<p>
						<strong>Art. 6º</strong> –  As penalidades são aplicadas segundo a gravidade da transgressão, pelo  Departamento de Pessoal.
					</p>
				</li>
			</h1>
			
			<p>&nbsp;</p>
			
			<h2 class="contratocenter" style="font-family: 'Tahoma', sans-serif; font-size:22px;">CONDUTA NÃO PERMITIDA EM HORARIO DE EXPEDIENTE</h2>
			<h1 class="corpo" style="font-size:22px;"> 
				<p>&nbsp;</p>
				<p>
					1) Uso Particular de aparelhos celulares em horário e /ou no setor do trabalho; <br/>
					2) Acessar redes sociais através de celulares particulares ou computadores da Empresa; <br/>
					3) Divulgar em redes sociais fotos e ou/comentários da empresa e ou nossa Contratante; <br/>
					4) Ultrapassar a jornada diária de trabalho, sem previa autorização da supervisão e Gerencia; <br/>
					5) Para as mulheres, apresentar-se ao trabalho usando decotes, saias ou vestidos curtos, calças de cotton, malhas ou roupas de ginástica/academia; <br/>
					6) Permanecer em setores que não seja seu setor de trabalho.
				</p>
				<li> 
					<strong>Das disposições Gerais </strong>
					<p>
						<strong>Art. 20º</strong> – Os empregados  devem observar o presente Regulamento, circulares, ordem de serviço, avisos,  comunicados e outras instruções expedidas pela direção da Empresa. 
					</p>
					<p>
						<strong>Art. 21º</strong> – Cada empregado  recebe um exemplar do presente Regulamento. Declara, por escrito, tê-lo  recebido, lido e estar de acordo com todos os seus preceitos. 
					</p>
					<p>
						<strong>Art. 22º</strong> – Os casos omissos  ou não previstos são resolvidos pela Empresa, à luz da CLT e legislação  complementar pertinente. 
					</p>
					<p>
						<strong>Art. 23º</strong> – O presente  regulamento pode ser substituído por outro, sempre que a Empresa julgar  conveniente, em consequência de alteração na legislação social.
					</p>
					<p>&nbsp;</p>
				</li>
				
				<p> Recebi um exemplar do  Regulamento Interno da <strong>POLÊMICA SERVIÇOS  BÁSICOS LTDA</strong></p>
				
				<p>&nbsp;</p>
					
				<p>São José dos Campos, <?php echo strtoupper($data_1); ?>.</p>
			</h1>
		</ol>
		<p>&nbsp;</p>	
		<p>&nbsp;</p>	
		<p>
			______________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                                            __________________________________________<br />

			<strong>POLÊMICA SERVIÇOS  BÁSICOS LTDA                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;             </strong><strong><?php echo $nome ?></strong>
		</p>
		<p><strong>&nbsp;</strong></p>

		<p>____________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;____________________________________________<br />

        Testemunha &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Responsável (qdo. Menor)</p></td>

  </tr>
</table>
<?php exit; } ?>
<?php if($eprint == '12'){ ?>
<div class="hidden-print">
	<h1 class="corpo" style="font-size:20px;"> 
		Escolher cidade e data da impressão:
	</h1>
	<form action="teste.php?id=<?php echo $id; ?>&eprint=<?php echo $eprint ?>" method="post">
		<label>Cidade:</label>
		<select name="cidade_impressao" required>
			<option value="">Selecione uma opção</option>
			<option value="Santos">Santos</option>
			<option value="São Vicente">São Vicente</option>
			<option value="Cubatão">Cubatão</option>
			<option value="Guarujá">Guarujá</option>
			<option value="Bertioga">Bertioga</option>
		</select>
		<label>Data Aviso:</label>
		<input type="date" name="data_aviso" value="<?php echo $todayTotal ?>" />
		<input type="submit" value="Atualizar" style="cursor:pointer; width:100px; background:#5CB85C; padding:5px; border:0px; color:#fff"/>
	</form>
	<hr/>
</div>
<table width="1027" border="0" id="transporte1">
  <tr> 
    <td>
		<h2 align="left" style="padding-bottom:20px; border-bottom:1px solid #000;">
			<div class="cabecalho" >
				<table width="1062" border="0">
					<tr>
						<td width="100" height="120">
							<img src="http://guaruja.polemicalitoral.com.br/imagens/logo.png" width="90" height="110">
						</td>
						<td width="899" class="cabecalho22"><p>Polêmica Serviços Básicos Ltda<br />
							Rua Euclides Miragaia. 700 – salas 82 e 83 – Centro - CEP: 12245-820<br />
							São José dos Campos – São Paulo<br />
							Telefax (012) 3941-8555<br />
							E-MAIL:      adm@polemicalitoral.com.br<br />
							SITE:      www.polemicaconstrutora.com.br</p>
						</td>
					</tr>
				</table>
			</div>
		</h2>

      <br clear="all" />
	  
      <p>&nbsp;</p>
		<?php if($data_aviso == ''){ $data_aviso = $todayTotal; } ?>
		<?php if($cidade_impressao == ''){ $cidade_impressao = 'Santos'; } ?>
		<h1 class="corpo" style="font-size:23px; text-align:right"> 
			<?php echo $cidade_impressao ?>, <?php echo mb_convert_encoding(strftime( '%d de %B de %Y', strtotime($data_aviso)), "UTF-8"); ?>
		</h1>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<h1 class="corpo" style="font-size:23px;"> 
		Sr(a) <?php echo $nome ?>
		<br/>
		<br/>
		CTPS Nº <?php echo $carteira_profissional ?> &nbsp;&nbsp; Série: <?php echo $serie ?>
	</h1>
	<p>&nbsp;</p>
	<h2 class="contratocenter" style="font-family: 'Tahoma', sans-serif; font-size:19px;">AVISO PRÉVIO INDENIZADO</h2>
	<p>&nbsp;</p>
		<h1 class="corpo" style="font-size:23px; ">
			<p>
				Vimos comunicar-lhe através desta, que o seu contrato de Trabalho fica rescindido de pleno direito, a partir desta data, sendo que o Aviso Prévio será indenizado, conforme Artigo 487 da CLT.
			</p>
			<p>
				Pedimos apresentar a sua Carteira de Trabalho e Previdência Social ao nosso Deptº. Pessoal, para as devidas providencias, devendo o pagamento da Rescisão ocorrer 10 (dez) dias após o recebimento desta carta.
			</p>
		</h1>

      <p>&nbsp;</p>
      <p>&nbsp;</p>

		<h1 class="corpo" style="font-size:15px; text-align:right">
			<p>
				<span style="font-size:20px;">Atenciosamente</span>,
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<span style="font-size:20px;">Polêmica Serviços Básicos LTDA.</span>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<!-- <span style="font-size:20px;">CIENTE: </span>   -->
				<p>&nbsp;</p>
			   __________________________________<br/><strong><?php echo $nome ?><br/></strong>
			</p>
		</h1>
		<p>&nbsp;</p>
		<p>&nbsp;</p><p>&nbsp;</p>
		<p>&nbsp;</p>
      </td>
  </tr>
</table>
		
<?php exit; } ?>
<?php if($eprint == '13'){ ?>
<div class="hidden-print">
	<h1 class="corpo" style="font-size:20px;"> 
		Escolher cidade e data da impressão:
	</h1>
	<form action="teste.php?id=<?php echo $id; ?>&eprint=<?php echo $eprint ?>" method="post">
		<label>Cidade:</label>
		<select name="cidade_impressao" required>
			<option value="">Selecione uma opção</option>
			<option value="Santos">Santos</option>
			<option value="São Vicente">São Vicente</option>
			<option value="Cubatão">Cubatão</option>
			<option value="Guarujá">Guarujá</option>
			<option value="Bertioga">Bertioga</option>
		</select>
		<label>Opção Aviso:</label>
		<select name="opcao_impressao" required>
			<option value="">Selecione uma opção</option>
			<option value="1">1 - Redução de jornada</option>
			<option value="2">2 - Trabalhado 23 dias</option>
		</select>
		<label>Data Aviso:</label>
		<input type="date" name="data_aviso" value="<?php echo $todayTotal ?>" />
		<input type="submit" value="Atualizar" style="cursor:pointer; width:100px; background:#5CB85C; padding:5px; border:0px; color:#fff"/>
	</form>
	<hr/>
</div>
<table width="1027" border="0" id="transporte1">
  <tr> 
    <td>
		<h2 align="left" style="padding-bottom:20px; border-bottom:1px solid #000;">
			<div class="cabecalho" >
				<table width="1062" border="0">
					<tr>
						<td width="100" height="120">
							<img src="http://guaruja.polemicalitoral.com.br/imagens/logo.png" width="90" height="110">
						</td>
						<td width="899" class="cabecalho22"><p>Polêmica Serviços Básicos Ltda<br />
							Rua Euclides Miragaia. 700 – salas 82 e 83 – Centro - CEP: 12245-820<br />
							São José dos Campos – São Paulo<br />
							Telefax (012) 3941-8555<br />
							E-MAIL:      adm@polemicalitoral.com.br<br />
							SITE:      www.polemicaconstrutora.com.br</p>
						</td>
					</tr>
				</table>
			</div>
		</h2>

      <br clear="all" />
		<?php if($data_aviso == ''){ $data_aviso = $todayTotal; } ?>
		<?php if($cidade_impressao == ''){ $cidade_impressao = 'Santos'; } ?>
		<h1 class="corpo" style="font-size:23px; text-align:right"> 
			<?php echo $cidade_impressao ?>, <?php echo mb_convert_encoding(strftime( '%d de %B de %Y', strtotime($data_aviso)), "UTF-8"); ?>
		</h1>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<h1 class="corpo" style="font-size:23px;"> 
		Sr(a) <?php echo $nome ?>
		<br/>
		<br/>
		CTPS Nº <?php echo $carteira_profissional ?> &nbsp;&nbsp; Série: <?php echo $serie ?>
	</h1>
	<p>&nbsp;</p>
	<h2 class="contratocenter" style="font-family: 'Tahoma', sans-serif; font-size:19px;">AVISO PRÉVIO TRABALHADO</h2>
	<p>&nbsp;</p>
		<h1 class="corpo" style="font-size:23px; ">
			<p>
				Vimos comunicar-lhe através desta, que o seu Contrato de Trabalho fica rescindido de pleno direito, a partir desta data, sendo certo que V. Sa. Cumprirá o Aviso Prévio previsto por lei, conforme artigo 487 da CLT, até o dia <span style="color:red"><b> ? </b>de <b> ? </b> de <b> ? </b></span> conforme opção abaixo:
			</p>
			<?php if($opcao_impressao == '1'){
				echo '
			<p>
				1) – ( X ) Redução da  jornada de trabalho em 02 (duas) horas diárias.
			</p>
			<p>
				2) – ( &nbsp;&nbsp;&nbsp;) Trabalho de 23 dias em horário normal com redução de 07 (sete) dias corridos.
			</p>
			';
			}else if ($opcao_impressao == '2'){
				echo '
			<p>
				1) – ( &nbsp;&nbsp;&nbsp; ) Redução da  jornada de trabalho em 02 (duas) horas diárias.
			</p>
			<p>
				2) – ( X ) Trabalho de 23 dias em horário normal com redução de 07 (sete) dias corridos.
			</p>
			';	
			}else{
			echo '
			<p>
				1) – ( &nbsp;&nbsp;&nbsp; ) Redução da  jornada de trabalho em 02 (duas) horas diárias.
			</p>
			<p>
				2) – ( &nbsp;&nbsp;&nbsp; ) Trabalho de 23 dias em horário normal com redução de 07 (sete) dias corridos.
			</p>
			';	
				
				
			}
			?>
			<p>
				Pedimos apresentar a sua Carteira de Trabalho e Previdência Social ao nosso Departamento Pessoal, para as devidas providências, devendo o pagamento da rescisão ocorrer no 1º dia útil ao término do Aviso Prévio.
			</p>
		</h1>

      <p>&nbsp;</p>
      <p>&nbsp;</p>

		<h1 class="corpo" style="font-size:15px; text-align:right">
			<p>
				<span style="font-size:20px;">Atenciosamente</span>,
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<span style="font-size:20px;">Polêmica Serviços Básicos LTDA.</span>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<!-- <span style="font-size:20px;">CIENTE: </span>   -->
				<p>&nbsp;</p>
			   __________________________________<br/><strong><?php echo $nome ?><br/></strong>
			</p>
		</h1>
		<p>&nbsp;</p>
		<p>&nbsp;</p><p>&nbsp;</p>
		<p>&nbsp;</p>
      </td>
  </tr>
</table>
		
<?php exit; } ?>
<?php if($eprint == '55'){ ?>
<table width="1027" border="0" id="transporte1">
  <tr>
    <td>
		<h2 align="left" style="padding-bottom:20px; border-bottom:1px solid #000;">
			<div class="cabecalho" >
				<table width="1062" border="0">
					<tr>
						<td width="100" height="120">
							<img src="http://guaruja.polemicalitoral.com.br/imagens/logo.png" width="90" height="110">
						</td>
						<td width="899" class="cabecalho22"><p>Polêmica Serviços Básicos Ltda<br />
							Rua Euclides Miragaia. 700 – salas 82 e 83 – Centro - CEP: 12245-820 <br />
							São José dos Campos – São Paulo<br />
							Telefax (012) 3941-8555 <br />
							E-MAIL:      adm@polemicalitoral.com.br <br />
							SITE:      www.polemicaconstrutora.com.br</p>
						</td>
					</tr>
				</table>
			</div>
		</h2>

      <br clear="all" />
	  
      <p>&nbsp;</p>

      <h1 class="corpo" style="font-size:23px; text-align:right"> 
		Santos, 21 de Novembro de 2017</h1>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<h1 class="corpo" style="font-size:23px;"> 
		Ao Departamento de estágio
	</h1>
	<p>&nbsp;</p>
	<h1 class="corpo" style="font-size:23px; padding-left:30px;"> 
		Curso: Ciência da Computação<br/>
		Aluno: Jorge Henrique Baptista<br/>
		RA: C15EIF-1<br/>
		Campus: Rangel - Santos<br/>
	<p>&nbsp;</p>
		<h1 class="corpo" style="font-size:23px; ">
			<p>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Declaro para os devidos fins que <strong>Jorge Henrique Baptista</strong> portador de RG Nº <strong>35.486.936-X</strong>, não mantém vinculo empregatício, mas exerce atividade autônoma nesta Empresa <strong>POLÊMICA  SERVIÇOS BÁSICOS LTDA., </strong> desde <strong>01/06/2017</strong>, excedendo <strong>420 horas</strong>.
			</p>
		</h1>

      <p>&nbsp;</p>

      <h1 class="corpo" style="font-size:19px;"><strong>Exercendo as seguintes funções: </strong></h1>

      <p>&nbsp;</p>

       <h1 class="corpo" style="font-size:22px;"><p>a. Analise e Desenvolvimento de Sistemas, encarregado pela criação e atualização de novas ferramentas para o sistema intranet da empresa.</p></h1>

      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>

       <h1 class="corpo" style="font-size:15px; text-align:right"
	   ><p>
	   <span style="font-size:20px;">Atenciosamente</span>,<br /><br /><br /><br /><br />
	   __________________________________<br/><strong>BENEDITO VALDINEI DA SILVA<br/></strong>
	   </p></h1>
		<p>&nbsp;</p>
		<p>&nbsp;</p><p>&nbsp;</p>
		<p>&nbsp;</p>
      </td>
  </tr>
</table>
<?php exit; } ?>

<!--
<table width="" border="0">
  <div style="page-break-after: always">

  <tr>	
    <td><h2 align="left">

      <div class="cabecalho">


        <table width="" border="0">

          <tr>
            <td width="100" height="120"><img src="http://guaruja.polemicalitoral.com.br/imagens/logo.png" width="90" height="110"></td>
            <td width="899" class="cabecalho22"><p>Polêmica Serviços Básicos Ltda<br />
			Rua Euclides Miragaia. 700 – salas 82 e 83 – Centro - CEP: 12245-820 <br />
			São José dos Campos – São Paulo<br />
			Telefax (012) 3941-8555 <br />
			E-MAIL:      contato@polemica.construtora.com.br <br />
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
			Rua Euclides Miragaia. 700 – salas 82 e 83 – Centro - CEP: 12245-820 <br />
			São José dos Campos – São Paulo<br />
			Telefax (012) 3941-8555 <br />
			E-MAIL:      contato@polemica.construtora.com.br <br />
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
			Rua Euclides Miragaia. 700 – salas 82 e 83 – Centro - CEP: 12245-820 <br />
			São José dos Campos – São Paulo<br />
			Telefax (012) 3941-8555 <br />
			E-MAIL:      contato@polemica.construtora.com.br <br />
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
					Rua Euclides Miragaia. 700 – salas 82 e 83 – Centro - CEP: 12245-820 <br />
					São José dos Campos – São Paulo<br />
					Telefax (012) 3941-8555 <br />
					E-MAIL:      contato@polemica.construtora.com.br <br />
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
-->
</body>
</html>