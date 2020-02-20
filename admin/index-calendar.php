<?php 
include("validar_session.php"); 
include("config.php");
getNivel(); getData();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="recepcao" >
	<title>LitoralRent - Financeiro</title>
	<link rel="stylesheet" href="../css/bootstrap.css?v3"/>
	<link rel="stylesheet" href="../css/jquery-ui.css"/>
	<link href="../css/uploadfile.min.css" rel="stylesheet"/>
	<link href="../css/AdminLTE.css?v1" rel="stylesheet" type="text/css"/>
	<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"/>
	<link href='https://fonts.googleapis.com/css?family=Oswald:300' rel='stylesheet' type='text/css'/>
	<link href="https://fonts.googleapis.com/css?family=Lobster|Roboto+Condensed|PT+Sans+Narrow|" rel="stylesheet">
	<link rel="icon" href="../imagens/icone-litoralrent.ico" type="image/x-icon"/>
	<link rel="shortcut icon" href="../imagens/icone-litoralrent.ico" type="image/x-icon"/>
	<link rel="stylesheet" href="../js/datatables/dataTables.bootstrap.css"/>
	<link rel="stylesheet" href="../js/iCheck/square/blue.css">
	<link rel="stylesheet" href="../js/iCheck/square/green.css">
	<link rel="stylesheet" href="../css/css.css?v9.0"/>
	<link href='../js/fullcalendar/packages/core/main.css' rel='stylesheet' />
	<link href='../js/fullcalendar/packages/daygrid/main.css' rel='stylesheet' />
	<link href='../js/fullcalendar/packages/timegrid/main.css' rel='stylesheet' />
	<link href='../js/fullcalendar/packages/list/main.css' rel='stylesheet' />
	<script src='../js/fullcalendar/packages/core/main.js'></script>
	<script src='../js/fullcalendar/packages/interaction/main.js'></script>
	<script src='../js/fullcalendar/packages/daygrid/main.js'></script>
	<script src='../js/fullcalendar/packages/timegrid/main.js'></script>
	<script src='../js/fullcalendar/packages/list/main.js'></script>
	<script>

	  document.addEventListener('DOMContentLoaded', function() {
		var calendarEl = document.getElementById('calendar');

		var calendar = new FullCalendar.Calendar(calendarEl, {
		  plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
		  locale: 'pt-br',
		  height: 'parent',
		  header: {
			left: 'prev,next today',
			center: 'title',
			right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
		  },
		  defaultView: 'dayGridMonth',
		  defaultDate: '<?= $todayTotal ?>',
		  navLinks: true, // can click day/week names to navigate views
		  editable: true,
		  eventLimit: true,
		  events: [ 
			<?php 
			$dataAdd4 = new DateTime($todayTotal);
			$dataAdd4->add(new DateInterval('P3M'));
			$dataAdd4 = $dataAdd4->format('Y-m-d');
	
			$contas_m = mysql_query("SELECT (SELECT razao_social FROM empresa_cadastro WHERE id = notas_nf.empresa) as empresa_nome, notas_nf_venc.data_pagamento, notas_nf_venc.valor_pagamento, notas_nf.obra as obra_c, notas_nf.numero, notas_nf.recebimento as data_emissao, notas_nf.id as id_nota, notas_nf_venc.id as id_venc FROM notas_nf_venc INNER JOIN notas_nf ON notas_nf_venc.nota = notas_nf.id WHERE (notas_nf_venc.data_pagamento BETWEEN '$inicioMes' and '$dataAdd4') AND notas_nf.tipo_nota IN(0) AND notas_nf_venc.conta IN(0) AND notas_nf.obra IN(1) ORDER BY notas_nf_venc.data ASC");
			while($k = mysql_fetch_array($contas_m)){ extract($k);
				$cidade_nt = mysql_result(mysql_query("SELECT cidade FROM notas_obras WHERE id = '$obra_c'"),0,"cidade");
				echo "{ 
						id: '".$id_nota."',
						id_venc: '".$id_venc."',
						cidadeNt: '".$cidade_nt."',
						valor: '".$valor_pagamento."',
						title: '".$empresa_nome."',						
						numero: '".$numero."',
						dataEmissao: '".implode("/",array_reverse(explode("-",$data_emissao)))."',
						parcelas: '".mysql_num_rows(mysql_query("SELECT * FROM notas_nf_venc WHERE nota = '$id_nota'"))."x',
						start: '".$data_pagamento."',";
						if($data_pagamento <= $todayTotal){
							echo "color: '#b20000'";
						}else{
							echo "color: '#f6b042'";
						}
				echo "},";  
				
			}
			?>
			{
				id: 'SEMID',
				title: 'FECHAR MEDIÇÃO',						
				numero: '1',
				dataEmissao: '2019-04-26',
				start: '2019-04-26',
				color: '#4F2C76',
			}
		  ],
			eventClick: function (info2) {
				$('#calendarModal').modal(); 
				$('#modal-title').html(info2.event.title);
				$('#numeroModal').html(info2.event.extendedProps.numero);
				$('#emissaoModal').html(info2.event.extendedProps.dataEmissao);
				$('#parcelasModal').html(info2.event.extendedProps.parcelas);
				$('.edit-vencimento').load("financeiro/editar-vencimento.php?id_venc=" + info2.event.extendedProps.id_venc + "&cidade_nt=" + info2.event.extendedProps.cidadeNt);
			},
		});

		calendar.render();
	  });

	</script>
</head>
<body>
	<div class="navbar-topo1">
		<div class="container-fluid">
			<div class="pull-right">
				<a href="../index.php?acao=deslogar" title="Sair"><span class="btn btn-topo1 btn-xs">Encerrar Sessão</span></a>
			</div>
			<div class="pull-right">
				<a href="#" onclick="ldy('troca-senha.php','.conteudo')" class="btn btn-topo1 btn-xs">Alterar Senha</a>
			</div>
			<div class="pull-right">
				<a href="#" onclick="ldy('troca-senha.php','.conteudo')" class="btn btn-topo1 btn-xs">Pagina Inicial</a>
			</div>
		</div>
	</div>
	<div class="navbar-topo2">
		<div class="container-fluid">
			<div class="col-xs-2" style="position:relative; padding:0px">&nbsp;</div>
			<div class="col-xs-10 botoes-topo2">
				<div class="central">
					<?= mb_convert_encoding(ucwords(strftime('%A-feira, %d&nbsp;de %B&nbsp;de %Y', strtotime($todayTotal))), "UTF-8"); ?>
				</div>
				<div class="central" style="width:65px">
					Pesquisar:
				</div>
				<div class="central" style="width:250px">
					<div class="input-group">
						<input type="text" class="form-control pesquisa1" placeholder="Pesquisar por...">
						<span class="input-group-btn">
							<button class="btn pesquisa2" type="button"><span class="glyphicon glyphicon-search"></span></button>
						</span>
					</div><!-- /input-group -->
				</div>
			</div>
		</div>
	</div>
	<div class="navbar-topo3">
		<div class="container-fluid">
			<div class="col-xs-2" style="position:relative; padding:0px">
				<a class="logo-page" href="./"><img src="../imagens/litoralrent-logo.png" alt="" width="80px"/></a>
				<a class="logo-page2" href="./">Financeiro</a>
			</div>
			<div class="col-xs-10">
				<ul class="nav navbar-nav botoes-topo3">
				   <li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Nota Fiscal <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li role="presentation" class="dropdown-header">CADASTRO </li>
								<li class="sub-dropdown"><a href="#" onclick="ldy('financeiro/cadastro-nota.php','.conteudo')">LANÇAMENTO</a></li>
							<li role="presentation" class="divider"></li>
							<li role="presentation" class="dropdown-header">CONSULTA </li>
								<li class="sub-dropdown"><a href="#" onclick="ldy('financeiro/consulta-nota.php','.conteudo')">CONSULTA DE NOTAS</a></li>
							<li role="presentation" class="divider"></li>
							<li role="presentation" class="dropdown-header">RELATÓRIOS</li>
								<li class="sub-dropdown"><a href="#" onclick="ldy('financeiro/relatorio-funcionarios.php','.conteudo')">CONTROLE DE CONTAS</a></li>
								<li class="sub-dropdown"><a href="#" onclick="ldy('gestor/relatorio-notas.php','.conteudo')">GRAFICO CATEGORIA</a></li>
						</ul>
					</li>
					<li><a href="#">Saldo e Extratos</a></li>
					<li><a href="#">Transferencia</a></li>
					 <li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administração <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li role="presentation" class="dropdown-header">CADASTRO </li>
								<li><a href="#" onclick="ldy('financeiro/cadastro-nota.php','.conteudo')">LANÇAMENTO</a></li>
							<li role="presentation" class="divider"></li>
							<li role="presentation" class="dropdown-header">CONSULTA </li>
								<li><a href="#" onclick="ldy('financeiro/consulta-nota.php','.conteudo')">CONSULTA DE NOTAS</a></li>
							<li role="presentation" class="divider"></li>
							<li role="presentation" class="dropdown-header">RELATÓRIOS</li>
								<li><a href="#" onclick="ldy('financeiro/relatorio-funcionarios.php','.conteudo')">CONTROLE DE CONTAS</a></li>
								<li><a href="#" onclick="ldy('gestor/relatorio-notas.php','.conteudo')">GRAFICO CATEGORIA</a></li>
						</ul>
					</li>
					<li class="dropdown">         
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-search"></span> Gestor <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li role="presentation" class="dropdown-header">RH</li>
								<li><a href="#" onclick="ldy('gestor/consulta-usuarios.php','.conteudo')">USUARIOS</a></li>
								<li><a href="#" onclick="ldy('gestor/consulta-equipes.php','.conteudo')">CONTAS</a></li>
							<li role="presentation" class="divider"></li>
							<li role="presentation" class="dropdown-header">SS</li>
								<li><a href="#" onclick="ldy('gestor/consulta-situacoes.php','.conteudo')">SITUAÇÕES</a></li>  	
							<li role="presentation" class="divider"></li>
							<li role="presentation" class="dropdown-header">ALMOXARIFADO</li>
								<li><a href="#" onclick="ldy('almoxarifado/consulta-materiais-polemica.php','.conteudo')">ITEM MATERIAL</a></li>
								<li><a href="#" onclick="ldy('gestor/consulta-categoria-polemica.php','.conteudo')">CATEGORIAS</a></li>
						</ul>
					</li>
					<li><a href="#">Botão 1</a></li>
					<li><a href="#">Botão 2</a></li>
					<li><a href="#">Botão 3</a></li>
					<li><a href="#">Botão 4</a></li>
					<li><a href="#">Botão 5</a></li>
					<li><a href="#">Botão 6</a></li>
					<li><a href="#">Botão 7</a></li>
					<li><a href="#">Botão 8</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="container" style="padding:0px">
		<div class="conteudo">
			<div class="container-fluid" style="padding:0px;">
				<div class="col-xs-2" style="padding:20px 10px;">
					<nav class="navbar-lateral">
						<div class="container-fluid" style="padding:0px">
							<div class="sessao-lateral">
								<?php
								$hr_v = date("H");
								if($hr_v >= 12 && $hr<18) {
									$resp = "Boa tarde";
								}else if ($hr_v >= 0 && $hr_v <12 ){
									$resp = "Bom dia";
								}else{
									$resp = "Boa noite";
								}
								echo $resp.', <span style="font-weight:bold" class="text-warning">'.strtoupper($nome_login).'</span>';
								?>
							</div>
							<div class="sessao-lateral">
								<span class="linha"><?= strtoupper("Litoral Rent Locadora E Construcoes Ltda"); ?></span>
								<span class="linha">CNPJ: 024.094.902/0001-00</span>
								<span class="linha">Telefone: (13) 3043-4211</span>
							</div>
							<div class="sessao-lateral">
								<span class="linha">Ultimo Login:</span>
								<?php
									$data_view_h = new DateTime($ultimo_login_view);
									echo '<span class="linha">'.$data_view_h->format('d/m/Y H:i').'</span>';
								 ?>
							</div>
							<div class="sessao-lateral-2">
								<h4 class="title-box-2"> <i class="fa fa-money" aria-hidden="true"></i> Saldo da Conta</h4>
								<div class="sessao-body-2">
									- informações<br/>
									- informações<br/>
									- informações<br/>
									- informações<br/>
								
								</div>
							</div>
							<div class="sessao-lateral-2">
								<h4 class="title-box-2"> <i class="fa fa-money" aria-hidden="true"></i> Outras funções</h4>
								<div class="sessao-body-2">
									- informações<br/>
									- informações<br/>
									- informações<br/>
									- informações<br/>
								
								</div>
							</div>
						</div>
					</nav>
				</div>
				<div class="col-xs-10" style="padding:20px 10px;">
					<div class="container-fluid box-dashboard">
						<h4 class="title-box"> <i class="fa fa-calendar" aria-hidden="true"></i> Calendario de Pagamentos</h4>
						<div id="calendar-container">
							<div id="calendar"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container" style="padding:0px">
		<div class="navbar-footer">
			<div class="container-fluid">
				<span>&nbsp;&nbsp; Copyright &copy; 2019 <strong>Litoral Rent.</strong> Todos direitos reservados. </span>
			</div>
		</div>
	</div>
	
	
	
			<div id="loading" class="hidden-print" style="width:100%; height:100%; display:none; position:fixed; top:0; background: rgba(255, 255, 255, 0.5); z-index:9999;">
			<div style="position:relative; top: 40%; text-align:center;">
				<img src="../imagens/loading.svg"  alt="" width="40px" />
				<h4 style="font-family: 'Lobster', sans-serif; font-size:15px; color: rgba(0, 0, 0, 0.5);">Carregando...</h4>
			</div>
		</div>
		<div class="modal" id="calendarModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="height:auto;">
			<div class="modal-dialog" style="width:80%;">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" style="color:#C9302C; opacity:1; "  onclick="$('.modal').modal('hide')" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h5 class="modal-title" id="modal-title" style="font-family: \'Oswald\', sans-serif; letter-spacing:3px;">-
						</h5>
					</div>
					<div id="calendario-start" class="modal-body">
						<table class="table table-blue">
							<tr style="background:#e2f1ff">
								<td><b><small>Nota Fiscal:</small></b> <span id="numeroModal"></span> </td>
								<td><b><small>Emissão NF:</small></b> <span id="emissaoModal"></span> </td>
								<td><b><small>Parcelas:</small></b> <span id="parcelasModal"></span> </td>
							</tr>
						</table>
						<div class="container-fluid">
							
							<div class="edit-vencimento"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.2.4.min.js"></script>
	<script src="../js/jquery.uploadfile.min.js"></script>
	<script src="../js/bootstrap.js"></script>
	<script src="js/jquery.maskedinput.js"></script>
	<script src="../js/jquery.printPage.js"></script>
	<script src="../js/jquery.maskMoney.js"></script>
	<script src="../js/jquery.printElement.js"></script>
	<script src="../js/jquery-ui.js"></script>
	<script src="js/jquery.tablesorter.min.js"></script>
	<script src="../js/bootstrap-select.js"></script>
	<script src="../js/jquery.multiple.js"></script>
	<script src="../js/jquery.flot.min.js"></script>
	<script src="../js/jquery.flot.pie.min.js"></script>
	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
	<script src="../js/all.js"></script>
	<script src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="../js/iCheck/icheck.min.js"></script>	
	<script src="../js/datatables/jquery.dataTables.js?v1"></script>
	<script src="../js/datatables/dataTables.bootstrap.js?v1"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
</body>
</html>
