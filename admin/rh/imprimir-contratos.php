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
<style>
.solicita a{
	text-decoration:none;
	color:#ccc;
}
.solicita a:hover{
	color:#f3f3f3;
}
</style>
<div class="row">
	<div class="col-xs-12 solicita hidden-print" style="font-family: 'Roboto Condensed', sans-serif; letter-spacing: 1.5px;">
		<div class="col-xs-6">
			<div style="width:100%; height:120px; margin:0 auto; margin-top:10px; background:#003772; display:table;">
				<a href="rh/imprimir-etiqueta.php?id=<?php echo $id ?>" target="_blank">
					<div class="col-xs-3" style="height:100%;">
						<h1 style="text-align:center"><i class="fa fa-file-word-o" aria-hidden="true"></i></h1>
					</div>
					<div class="col-xs-9" style="background-color:#0b52a3; height:100%">
						<h4>ETIQUETA</h4>
						<p>Modelo de etiqueta para controle mensal de funcionarios..</p>
					</div>
				</a>
			</div>
		</div>
		<div class="col-xs-6">
			<div style="width:100%; height:120px; margin:0 auto; margin-top:10px; background:#003772; display:table;">
				<a href="rh/ficha-registro.php?id=<?php echo $id ?>" target="_blank">
					<div class="col-xs-3" style="height:100%;">
						<h1 style="text-align:center"><i class="fa fa-file-word-o" aria-hidden="true"></i></h1>
					</div>
					<div class="col-xs-9" style="background-color:#0b52a3; height:100%">
						<h4>FICHA DE REGISTRO</h4>
						<p>Folha de registro, com todas informações pertecentes ao funcionario...</p>
					</div>
				</a>
			</div>
		</div>
		<div class="col-xs-6">
			<div style="width:100%; height:120px; margin:0 auto; margin-top:10px; background:#003772; display:table;">
				<a href="rh/teste.php?id=<?php echo $id ?>&eprint=1" target="_blank">
					<div class="col-xs-3" style="height:100%;">
						<h1 style="text-align:center"><i class="fa fa-file-word-o" aria-hidden="true"></i></h1>
					</div>
					<div class="col-xs-9" style="background-color:#0b52a3; height:100%">
						<h4>CONTRATO DE EXPERIÊNCIA</h4>
						<p>Contrato de tempo de experiência de novos funcionarios</p>
					</div>
				</a>
			</div>
		</div>
		<div class="col-xs-6">
			<div style="width:100%; height:120px; margin:0 auto; margin-top:10px; background:#003772; display:table;">
				<a href="rh/teste.php?id=<?php echo $id ?>&eprint=2" target="_blank">
					<div class="col-xs-3" style="height:100%;">
						<h1 style="text-align:center"><i class="fa fa-file-word-o" aria-hidden="true"></i></h1>
					</div>
					<div class="col-xs-9" style="background-color:#0b52a3; height:100%">
						<h4>PRORROGAÇÃO DO CONTRATO DE EXPERIÊNCIA</h4>
						<p>Declaração para prorrogação do contrato de experiência</p>
					</div>
				</a>
			</div>
		</div>
		<div class="col-xs-6">
			<div style="width:100%; height:120px; margin:0 auto; margin-top:10px; background:#003772; display:table;">
				<a href="rh/teste.php?id=<?php echo $id ?>&eprint=3" target="_blank">
					<div class="col-xs-3" style="height:100%;">
						<h1 style="text-align:center"><i class="fa fa-file-word-o" aria-hidden="true"></i></h1>
					</div>
					<div class="col-xs-9" style="background-color:#0b52a3; height:100%">
						<h4>DECLARAÇÃO DE VALE TRANSPORTE</h4>
						<p>Declaração para efeitos do benefício do vale transportes</p>
					</div>
				</a>
			</div>
		</div>
		<div class="col-xs-6">
			<div style="width:100%; height:120px; margin:0 auto; margin-top:10px; background:#003772; display:table;">
				<a href="rh/teste.php?id=<?php echo $id ?>&eprint=4" target="_blank">
					<div class="col-xs-3" style="height:100%;">
						<h1 style="text-align:center"><i class="fa fa-file-word-o" aria-hidden="true"></i></h1>
					</div>
					<div class="col-xs-9" style="background-color:#0b52a3; height:100%">
						<h4>CONTRATO DE TRABALHO</h4>
						<p>Contrato de trabalho sem tempo de experiência, para novos funcionarios</p>
					</div>
				</a>
			</div>
		</div>
		<div class="col-xs-6">
			<div style="width:100%; height:120px; margin:0 auto; margin-top:10px; background:#003772; display:table;">
				<a href="rh/teste.php?id=<?php echo $id ?>&eprint=5" target="_blank">
					<div class="col-xs-3" style="height:100%;">
						<h1 style="text-align:center"><i class="fa fa-file-word-o" aria-hidden="true"></i></h1>
					</div>
					<div class="col-xs-9" style="background-color:#0b52a3; height:100%">
						<h4>ACORDO DE COMPENSAÇÃO DE HORAS</h4>
						<p>Declaração para aceite dos termos de compensação de horas.</p>
					</div>
				</a>
			</div>
		</div>
		<div class="col-xs-6">
			<div style="width:100%; height:120px; margin:0 auto; margin-top:10px; background:#003772; display:table;">
				<a href="rh/teste.php?id=<?php echo $id ?>&eprint=6" target="_blank">
					<div class="col-xs-3" style="height:100%;">
						<h1 style="text-align:center"><i class="fa fa-file-word-o" aria-hidden="true"></i></h1>
					</div>
					<div class="col-xs-9" style="background-color:#0b52a3; height:100%">
						<h4>AUTORIZAÇÃO PARA DESCONTO DE VALE REFEIÇÃO</h4>
						<p>Declaração de Desconto mensal de 10% do valor do vale refeição. </p>
					</div>
				</a>
			</div>
		</div>
		<div class="col-xs-6">
			<div style="width:100%; height:120px; margin:0 auto; margin-top:10px; background:#003772; display:table;">
				<a href="rh/teste.php?id=<?php echo $id ?>&eprint=7" target="_blank">
					<div class="col-xs-3" style="height:100%;">
						<h1 style="text-align:center"><i class="fa fa-file-word-o" aria-hidden="true"></i></h1>
					</div>
					<div class="col-xs-9" style="background-color:#0b52a3; height:100%">
						<h4>RECIBO DE DEVOLUCÃO CTPS</h4>
						<p>Recibo de devolução da carteira de trabalho ao funcionario</p>
					</div>
				</a>
			</div>
		</div>
		<div class="col-xs-6">
			<div style="width:100%; height:120px; margin:0 auto; margin-top:10px; background:#003772; display:table;">
				<a href="rh/teste.php?id=<?php echo $id ?>&eprint=8" target="_blank">
					<div class="col-xs-3" style="height:100%;">
						<h1 style="text-align:center"><i class="fa fa-file-word-o" aria-hidden="true"></i></h1>
					</div>
					<div class="col-xs-9" style="background-color:#0b52a3; height:100%">
						<h4>RECIBO DE ENTREGA CTPS</h4>
						<p>Recibo para recolhimento da carteira de trabalho do funcionario</p>
					</div>
				</a>
			</div>
		</div>
		<div class="col-xs-6">
			<div style="width:100%; height:120px; margin:0 auto; margin-top:10px; background:#003772; display:table;">
				<a href="rh/teste.php?id=<?php echo $id ?>&eprint=9" target="_blank">
					<div class="col-xs-3" style="height:100%;">
						<h1 style="text-align:center"><i class="fa fa-file-word-o" aria-hidden="true"></i></h1>
					</div>
					<div class="col-xs-9" style="background-color:#0b52a3; height:100%">
						<h4>TERMO DE SIGILO SOBRE INFORMAÇÕES</h4>
						<p>Termo para sigilo de informação da empresa.</p>
					</div>
				</a>
			</div>
		</div>
		<div class="col-xs-6">
			<div style="width:100%; height:120px; margin:0 auto; margin-top:10px; background:#003772; display:table;">
				<a href="rh/teste.php?id=<?php echo $id ?>&eprint=10" target="_blank">
					<div class="col-xs-3" style="height:100%;">
						<h1 style="text-align:center"><i class="fa fa-file-word-o" aria-hidden="true"></i></h1>
					</div>
					<div class="col-xs-9" style="background-color:#0b52a3; height:100%">
						<h4>AUTORIZAÇÃO CONTRIBUIÇÃO ASSISTENCIAL NEGOCIAL</h4>
						<p>Autorização para contribuição assistencial, de 1% dos rendimentos.</p>
					</div>
				</a>
			</div>
		</div>
		<div class="col-xs-6">
			<div style="width:100%; height:120px; margin:0 auto; margin-top:10px; background:#003772; display:table;">
				<a href="rh/teste.php?id=<?php echo $id ?>&eprint=11" target="_blank">
					<div class="col-xs-3" style="height:100%;">
						<h1 style="text-align:center"><i class="fa fa-file-word-o" aria-hidden="true"></i></h1>
					</div>
					<div class="col-xs-9" style="background-color:#0b52a3; height:100%">
						<h4>REGULAMENTO INTERNO</h4>
						<p>Regras e normas internas da empresa</p>
					</div>
				</a>
			</div>
		</div>
	</div>
	<div class="col-xs-12 solicita hidden-print" style="font-family: 'Roboto Condensed', sans-serif; letter-spacing: 1.5px;">
		<h4 style="margin-top:20px">Demissão: </h4><hr/>
		<div class="col-xs-6">
			<div style="width:100%; height:120px; margin:0 auto; margin-top:10px; background:#003772; display:table;">
				<a href="rh/teste.php?id=<?php echo $id ?>&eprint=12" target="_blank">
					<div class="col-xs-3" style="height:100%;">
						<h1 style="text-align:center"><i class="fa fa-file-word-o" aria-hidden="true"></i></h1>
					</div>
					<div class="col-xs-9" style="background-color:#0b52a3; height:100%">
						<h4>AVISO PREVIO INDENIZADO</h4>
						<p>Aviso sobre rescisão de contrato indenizado.</p>
					</div>
				</a>
			</div>
		</div>
		<div class="col-xs-6">
			<div style="width:100%; height:120px; margin:0 auto; margin-top:10px; background:#003772; display:table;">
				<a href="rh/teste.php?id=<?php echo $id ?>&eprint=13" target="_blank">
					<div class="col-xs-3" style="height:100%;">
						<h1 style="text-align:center"><i class="fa fa-file-word-o" aria-hidden="true"></i></h1>
					</div>
					<div class="col-xs-9" style="background-color:#0b52a3; height:100%">
						<h4>AVISO PREVIO TRABALHADO</h4>
						<p>Aviso sobre rescisão de contrato trabalhado.</p>
					</div>
				</a>
			</div>
		</div>
	</div>
</div><br/><br/>