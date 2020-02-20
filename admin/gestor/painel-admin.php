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
	if(!isset($ano)){ 
		$ano = $today['year']; 
	} 
	if(!isset($tipo)){
		$tipo = $today['mon'];
	}
	if(!isset($cidade)){
		$cidade_explode = explode(",",$cidade_usuario);
		$cidade = $cidade_explode[0];
	}
?>
<style>
.navbar-nav > li > a:hover, .navbar-default .navbar-nav > li > a:focus {
	color: #6b6e6f;
	background:#eaeaea;
	border-top-right-radius:10px;
	border-top-left-radius:10px;
}
.active-nav{
	color: #000;
	background:#eaeaea;
	-webkit-box-shadow: 0px -4px 24px -8px rgba(87,87,87,1);
	-moz-box-shadow: 0px -4px 24px -8px rgba(87,87,87,1);
	box-shadow: 0px -4px 24px -8px rgba(87,87,87,1);
	border-top-right-radius:20px;
	border-top-left-radius:20px;
	opacity:0.7;
}
.navbar-nav > li > a {
	color:#6b6e6f;
}
.ano-style{
	border:none;
	font-size:20px;
	margin-left:30px;
	font-family: 'Oswald', sans-serif;
	font-weight:bold;
}
</style>
<?php 
		switch($tipo){
			case '01':
				$nome_mes = 'JANEIRO';
				break;
			case '02':
				$nome_mes = 'FEVEREIRO';
				break;
			case '03':
				$nome_mes = 'MARÇO';
				break;	
			case '04':
				$nome_mes = 'ABRIL';
				break;
			case '05':
				$nome_mes = 'MAIO';
				break;
			case '06':
				$nome_mes = 'JUNHO';
				break;
			case '07':
				$nome_mes = 'JULHO';
				break;
			case '08':
				$nome_mes = 'AGOSTO';
				break;
			case '09':
				$nome_mes = 'SETEMBRO';
				break;
			case '10':
				$nome_mes = 'OUTUBRO';
				break;
			case '11':
				$nome_mes = 'NOVEMBRO';
				break;
			case '12':
				$nome_mes = 'DEZEMBRO';
				break;
			default:
				$nome_mes = 'JANEIRO';
				$tipo = '01';
		}

		$oba = mysql_query("SELECT id FROM notas_obras WHERE cidade = '$cidade'");
		while($c = mysql_fetch_array($oba)){ 
			$obu .= $c['id'].','; 
		} 
		$obu = substr($obu,0,-1); 

		$vl = mysql_query("select * from ss_se,ss_principal where ss_se.cod_ss = ss_principal.id and MONTH(data) = '$tipo' and YEAR(data) = '$ano' and ss_principal.obra IN($obu)");
		while($l = mysql_fetch_array($vl)) {
			$vlr = mysql_result(mysql_query("select * from ss_itens where id = ".$l['servico'].""),0,"preco");
			$total = $l['qtd']*$vlr;	
			$total_geral += $total;	
		}
		
		$vl = mysql_query("select *,metas.valor as valor_meta from equipes, metas where equipes.categoria = metas.id and equipes.status = '0' and equipes.obra = '$cidade' ");
		while($l = mysql_fetch_array($vl)) {	
			$meta += $l['valor_meta'];	
		}
		
		$ss_s = mysql_query("select *, sum(notas_itens_add.quantidade*notas_itens_add.valor) as totall, notas_nf.id as id_n, notas_itens.categoria as categoria, notas_nf.empresa as empresa, notas_nf.vencimento as vencimento, notas_itens_add.valor as vlr, notas_itens_add.quantidade qtd FROM notas_nf, notas_itens_add, notas_itens where notas_nf.id = notas_itens_add.nota and notas_itens_add.item = notas_itens.id and notas_itens.categoria in(2,3,4,5,7,9,10,11,12,13,14,15,17) AND MONTH(recebimento) = '$tipo' and YEAR(recebimento) = '$ano' AND notas_nf.obra IN($obu) group by notas_nf.id order by notas_nf.numero") or die (mysql_error());
		while($z = mysql_fetch_array($ss_s)) {
			$total = 0;
			$total_despesas += $z['totall'];
	
		}
?>
		<div class="row">
			<div class="callout-dark text-center fade-in-b" style="margin-bottom:30px">
				<h2 style="color:#021652">
					<span class="glyphicon glyphicon-calendar" aria-hidden="true" style="margin-right:20px"></span>BEM-VINDO - <b>ANÁLISE</b> DE MEDIÇÃO MENSAL
					<sup>
						<form method="GET" action="" style="margin-top:10px;">
							<select class="ano-style" name="cidade" onChange="ldy('gestor/painel-admin.php?cidade=' + $(this).val(),'.conteudo')">
								<?php
									$sql = mysql_query("select * from notas_obras_cidade where id IN($cidade_usuario) order by nome asc");
									while($o = mysql_fetch_array($sql)) {
										if($cidade == $o['id']){
											echo '<option value="'.$o['id'].'" selected>'.$o['nome'].'</option>';
										}else{
											echo '<option value="'.$o['id'].'">'.$o['nome'].'</option>';
										}
									}
								?>	
							</select>
						</form>
					</sup>
					<sup>
						<form method="POST" action="" style="margin-top:10px;">
							<select class="ano-style" onChange="ldy('gestor/painel-admin.php?cidade=<?php echo $cidade ?>&ano=' + $(this).val(),'.conteudo')">
								<option value="2016" <?php if($ano == "2016"){ echo " selected"; } ?>> 2016</option>
								<option value="2017" <?php if($ano == "2017"){ echo " selected"; } ?>> 2017</option>
							</select>
						</form>
					</sup>
				</h2>
			</div>
		</div>
		<div class="container">
		<center>
			<div class="alert alert-info" style="width:50%; font-size:12px; padding: 5px; background:none; border:none;">
				<?php echo '<strong>Data: </strong> '.$tipo.'/'.$ano; ?>
			</div>
		</center>

				<ul class="nav navbar-nav text-center" style="border-bottom:2px solid #eaeaea;font-weight:bold; padding:0px 10px 0px 10px;">
                    <li><a href="#" <?php if($tipo=='01'){   echo 'class="active-nav"';}?> onclick="ldy('gestor/painel-admin.php?tipo=01&cidade=<?php echo $cidade ?>&ano=<?php    echo $ano ?>','.conteudo')">JANEIRO</a></li>
					<li><a href="#" <?php if($tipo=='02'){   echo 'class="active-nav"';}?> onclick="ldy('gestor/painel-admin.php?tipo=02&cidade=<?php echo $cidade ?>&ano=<?php    echo $ano ?>','.conteudo')">FEVEREIRO</a></li>
					<li><a href="#" <?php if($tipo=='03'){   echo 'class="active-nav"';}?> onclick="ldy('gestor/painel-admin.php?tipo=03&cidade=<?php echo $cidade ?>&ano=<?php    echo $ano ?>','.conteudo')">MARÇO</a></li>
					<li><a href="#" <?php if($tipo=='04'){   echo 'class="active-nav"';}?> onclick="ldy('gestor/painel-admin.php?tipo=04&cidade=<?php echo $cidade ?>&ano=<?php    echo $ano ?>','.conteudo')">ABRIL</a></li>
					<li><a href="#" <?php if($tipo=='05'){   echo 'class="active-nav"';}?> onclick="ldy('gestor/painel-admin.php?tipo=05&cidade=<?php echo $cidade ?>&ano=<?php    echo $ano ?>','.conteudo')">MAIO</a></li>
					<li><a href="#" <?php if($tipo=='06'){   echo 'class="active-nav"';}?> onclick="ldy('gestor/painel-admin.php?tipo=06&cidade=<?php echo $cidade ?>&ano=<?php    echo $ano ?>','.conteudo')">JUNHO</a></li>
					<li><a href="#" <?php if($tipo=='07'){   echo 'class="active-nav"';}?> onclick="ldy('gestor/painel-admin.php?tipo=07&cidade=<?php echo $cidade ?>&ano=<?php    echo $ano ?>','.conteudo')">JULHO</a></li>
					<li><a href="#" <?php if($tipo=='08'){   echo 'class="active-nav"';}?> onclick="ldy('gestor/painel-admin.php?tipo=08&cidade=<?php echo $cidade ?>&ano=<?php    echo $ano ?>','.conteudo')">AGOSTO</a></li>
					<li><a href="#" <?php if($tipo=='09'){   echo 'class="active-nav"';}?> onclick="ldy('gestor/painel-admin.php?tipo=09&cidade=<?php echo $cidade ?>&ano=<?php    echo $ano ?>','.conteudo')">SETEMBRO</a></li>
					<li><a href="#" <?php if($tipo=='10'){  echo 'class="active-nav"';}?> onclick="ldy('gestor/painel-admin.php?tipo=10&cidade=<?php echo $cidade ?>&ano=<?php   echo $ano ?>','.conteudo')">OUTUBRO</a></li>
					<li><a href="#" <?php if($tipo=='11'){  echo 'class="active-nav"';}?> onclick="ldy('gestor/painel-admin.php?tipo=11&cidade=<?php echo $cidade ?>&ano=<?php   echo $ano ?>','.conteudo')">NOVEMBRO</a></li>
					<li><a href="#" <?php if($tipo=='12'){  echo 'class="active-nav"';}?> onclick="ldy('gestor/painel-admin.php?tipo=12&cidade=<?php echo $cidade ?>&ano=<?php   echo $ano ?>','.conteudo')">DEZEMBRO</a></li>
				</ul>
		</div>
				<div class="tab-content" style="margin:0px 10px 0px 10px">
					<div class="row db-padding-btm db-attached">
						<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
							<div class="db-wrapper">
								<div class="db-pricing-eleven db2-bk-color-one">
									<div class="price" style="font-size:45px">
										<sup style="font-size:11px;">MÊS DE</sup><sub>	<?php echo $nome_mes; ?></sub>
										<small></small>
									</div>
									<div class="type" style="font-size:26px; background:#04163B;">
										<?php echo $ano;?>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2" style="padding-right:0px; padding-left:0px;">
							<div class="db-wrapper">
								<div class="db-pricing-eleven db2-bk-color-three">
									<div class="price" style="font-size:45px; position:relative;">
										<p><sup>R$</sup><sub><?php echo number_format(($meta),"2",",","."); ?></sub></p>
										<small></small>
									</div>
									<div class="type" style="font-size:26px; background:#0d1e38;">
										META
									</div>
								</div>
							 </div>
						</div>
						<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" style="padding-right:0px; padding-left:0px;">
							<div class="db-wrapper">
								<div class="db-pricing-eleven db2-bk-color-two">
									<div class="price" style="font-size:45px">
										<sup>R$</sup><sub><?php echo number_format(($total_geral),"2",",","."); ?></sub>
										<small></small>
									</div>
									<div class="type" style="font-size:26px; background:#04163B;">
										FATURADO
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2" style="padding-right:0px; padding-left:0px;">
							<div class="db-wrapper">
								<div class="db-pricing-eleven db2-bk-color-three">
									<div class="price" style="font-size:45px">
										<sup>R$</sup><sub><?php echo number_format(($meta)-($total_geral),"2",",","."); ?></sub>
										<small></small>
									</div>
									<div class="type" style="font-size:26px; background:#171722;">
										FALTA
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2" style="padding-right:0px; padding-left:0px;">
							<div class="db-wrapper">
								<div class="db-pricing-eleven db2-bk-color-six">
									<div class="price" style="font-size:45px">
										<sup>R$</sup><sub><?php echo number_format(($total_despesas),"2",",","."); ?></sub>
										<small></small>
									</div>
									<div class="type" style="font-size:26px; background:#0d1e38;">
										 DESPESAS
									</div>
								</div>
							</div>
						</div>        
					</div>
				</div>
		
















<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
         var data1 = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Work',     11],
          ['Eat',      2],
          ['Commute',  2],
          ['Watch TV', 2],
          ['Sleep',    7]
        ]);

        var options1 = {
          title: 'My Daily Activities 1'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data1, options1);

        //GRAFICO 2
        var data2 = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Work',     11],
          ['Eat',      2],
          ['Commute',  2],
          ['Watch TV', 2],
          ['Sleep',    7]
        ]);

        var options2 = {
          title: 'My Daily Activities 2',
          pieHole: 0.4,
        };

        var chart2 = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart2.draw(data2, options2);

        //GRAFICO 3

		var data3 = google.visualization.arrayToDataTable([
          ['Mes', 'Guaruja', 'Santos', 'São Vicente'],
          ['Jan',  966136.20, 1021431.22, 524533.29],
          ['Fev',  857422.05, 883836.37, 516113.82],
          ['Mar',  1041160.89, 634460.92, 561046.72],
          ['Abr',  669188.22, 605251.10, 448276.23],
          ['Mai',  574435.92, 536639.80, 555864.15],
          ['Jun',  476902.06, 353895.69, 264278.42]
        //['Jul',  476902.06, 353895.69, 264278.42],
        //['Ago',  476902.06, 353895.69, 264278.42],
        //['Set',  476902.06, 353895.69, 264278.42],
        //['Out',  476902.06, 353895.69, 264278.42],
       	//['Nov',  476902.06, 353895.69, 264278.42],
		//['Dez',  476902.06, 353895.69, 264278.42]
        ]);
		var options3 = {
			title: 'Faturamento Total das Obras',
    		//curveType: 'function',
		    backgroundColor: '#f1f8e9',
        legend: { position: 'right' }
		};

		var chart3 = new google.visualization.LineChart(document.getElementById('chart_div'));
		chart3.draw(data3, options3);

		// COLUNA
		var data4 = google.visualization.arrayToDataTable([
	        ['Equipamento', 'Faturado', 'Meta'],
          ['  SANTOS - 02.00 - GUILHERME DOS SANTOS CARELLES', 46217.72, 173000.00],
          ['  SANTOS - 03.00 - WAGNER VITAL ANDRADE DOS SANTOS', 211423.80, 240000.00],
          ['  SANTOS - 04.00 - TAIS SOUSA REIS', 61413.01, 220000.00],
	        ['  SANTOS - 05.00_JULIO CESAR', 28037.89, 44000.00]
	     ]);

	      var options4 = {
	        title: 'Total medição por Encarregado - Junho',
          legend: { position: 'right' },

          backgroundColor: '#f1f8e9',
	        hAxis: {
	          title: 'Encarregados',
	        },
	        vAxis: {
	          title: 'Faturado'
	        }
	      };

      var chart4 = new google.visualization.ColumnChart(
        document.getElementById('chart_div2'));

      chart4.draw(data4, options4);
    }
    </script>

    <div id="chart_div" style="width: 900px; height: 400px;"></div>
     <div id="chart_div2" style="width: 800px; height: 500px;"></div>

  	 <div id="piechart" style="width: 600px; height: 500px;"></div>
     <div id="donutchart" style="width: 600px; height: 500px;"></div>