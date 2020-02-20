<?php
include("../config.php");
include("../validar_session.php");
getData();
getNivel();
?>
<script>
 
	$(document).ready(function(){
		
		$('.sel').multiselect({
			buttonClass: 'btn btn-sm', 
			numberDisplayed: 1,
			maxHeight: 500,
			includeSelectAllOption: true,
			selectAllText: "Selecionar todos",
			enableFiltering: true,
			enableCaseInsensitiveFiltering: true,
			selectAllValue: 'multiselect-all',
			buttonWidth: 'auto'
		}); 
	});
</script>
<style>
	.btn-sm2 {
		margin: 10px !important;
		background-color:#FDFDFD !important;
		color:#092A5D;
		width:110px;
		height:80px;
		padding-top:15px;
	}
	.ds-button{
		 padding:20px 0px 0px 40px;
	}
	.lg {
		font-size:28px;
	}
	body {
		background: url("../imagens/bg-dash.jpg") repeat center 20%;
		-moz-background-size: cover; -webkit-background-size: cover; -o-background-size: cover; background-size: cover;
	}
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
		border-radius:5px;
		padding:5px 10px 5px 10px;
		font-size:20px;
		margin-left:30px;
		font-family: 'Oswald', sans-serif;
		background-color:transparent;
	}
	@media (min-width: 1199px) and (max-width: 1350px){
		.ds-button{
			padding:0px !important;
		}
		.icon-pole{
			margin-bottom:10px;
		}
		.button-index{
			margin: 5px;
		}
		.button-index a{
			font-size:12px !important;
		}
		.msg-alert{
			margin-left:20px !important;
			width:30% !important;
		}
	}
	@media (min-width: 900px) and (max-width: 1199px){
		.db-pricing-eleven .price{
			font-size:3.5em;
		}
		.db-pricing-eleven .type{
			font-size:1.5em;
		}
		.button-index a{
			font-size:12px !important;
		}
		.msg-alert .alert h5{
			font-size:12px;
		}
	}
	@media (min-width: 650px) and (max-width: 900px){
		.db-pricing-eleven .price{
			font-size:2.5em;
		}
		.db-pricing-eleven .type{
			font-size:1.3em;
		}
		.button-index a{
			font-size:12px !important;
		}
		.button-index i{
			font-size:25px;
		}
		.msg-alert .alert h5{
			font-size:12px;
		}
	}
		@media (max-width: 650px){
			.top-dash{
				position:absolute;
				top:20px;
				left:-40px;
				padding: 0px; margin:0px;
			}
			.icon-pole{
				position:relative;
				left:25px;
			}
			.container-fluid{
				margin:0px;
			}
			.button-index a{
				font-size:10px !important;
				width:90px;
				margin:0px;
			}
			.button-index span, i{
				margin-bottom:10px;
			}
			.button-index i{
				font-size:25px;
			}
			.ds-button{
				margin:40px 0px 40px -20px
				
			}
			.footer{
				position:relative;
				top:50px;
			}
		}
</style>

<?php
	if($atu=='ac'){
		echo '<b style="font-size:14px;">Contrato: </b>';
			echo '<select name="ob[]" style="width:250px;" class="sel" multiple="multiple">';
					$obrasql2 = mysql_query("select * from notas_obras where cidade IN($cidade) AND status = '0' order by descricao asc");
					while($o = mysql_fetch_array($obrasql2)) {
						echo '<option value="'.$o['id'].'" selected>'.$o['descricao'].'</option>';
					}
			echo '</select>';
		exit;
	}
	if($ac == 'listarGrafico2'){
		foreach($ob as $obs) { @$obu .= $obs.','; } $obra_r = substr($obu,0,-1); 
		foreach($et as $ets) { @$eta .= $ets.','; } $eta = substr($eta,0,-1);		
?>
		<a href="preposto/imprimir-grafico2.php?cidade=<?php echo $cidade; ?>&obra_r=<?php echo $obra_r; ?>&eta=<?php echo $eta ?>" target="_blank" style="letter-spacing:5px; position:relative; bottom:20px" class="pull-right btn btn-warning btn-sm"> 
			<span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir
		</a>
		<script type="text/javascript">
		  google.charts.load('current', {'packages':['bar']});
		  google.charts.setOnLoadCallback(drawChart);

		  function drawChart() {
			var data = google.visualization.arrayToDataTable([
			<?php
				$data_inicio = $todayTotal;
				
				$data_termino = new DateTime($data_inicio);
				$data_termino -> sub(new DateInterval('P1M'));
				$data_termino = $data_termino->format('Y-m');
				
				$data_termino2 = new DateTime($data_termino);
				$data_termino2 -> sub(new DateInterval('P1M'));
				$data_termino2 = $data_termino2->format('Y-m');
				
				$data_termino0 = substr($data_inicio, 0 , -3);
				$string_grafico1 = "'".implode("/",array_reverse(explode("-",$data_termino2)))."', '".implode("/",array_reverse(explode("-",$data_termino)))."', '".implode("/",array_reverse(explode("-",$data_termino0)))."'";
			?>	
			  ['Categorias', <?php echo $string_grafico1 ?>],
			<?php
			$categoria_grafico = mysql_query("SELECT * FROM notas_categorias WHERE id IN($eta) and status = '0'");
			while($cat = mysql_fetch_array($categoria_grafico)){
				echo $oba;
				$total_1 = mysql_result(mysql_query("select SUM(notas_itens_add.quantidade*notas_itens_add.valor) as totalSum FROM notas_nf, notas_itens_add WHERE notas_nf.id = notas_itens_add.nota AND notas_itens_add.categoria = '".$cat['id']."' and notas_nf.obra in ($obra_r) AND (notas_nf.dataxml between '".$data_termino2."-01' and '".$data_termino2."-31') order by notas_itens_add.categoria"),0,"totalSum");
				
				$total_2 = mysql_result(mysql_query("select SUM(notas_itens_add.quantidade*notas_itens_add.valor) as totalSum FROM notas_nf, notas_itens_add WHERE notas_nf.id = notas_itens_add.nota AND notas_itens_add.categoria = '".$cat['id']."' and notas_nf.obra in ($obra_r) AND (notas_nf.dataxml between '".$data_termino."-01' and '".$data_termino."-31') order by notas_itens_add.categoria"),0,"totalSum");
				
				$total_3 = mysql_result(mysql_query("select SUM(notas_itens_add.quantidade*notas_itens_add.valor) as totalSum FROM notas_nf, notas_itens_add WHERE notas_nf.id = notas_itens_add.nota AND notas_itens_add.categoria = '".$cat['id']."' and notas_nf.obra in ($obra_r) AND (notas_nf.dataxml between '".$data_termino0."-01' and '".$data_termino0."-31') order by notas_itens_add.categoria"),0,"totalSum");
				
				if($total_1 == '') { $total_1 = 0; }
				if($total_2 == '') { $total_2 = 0; }
				if($total_3 == '') { $total_3 = 0; }
				echo "['".$cat['descricao']."', $total_1, $total_2, $total_3],";
			}
			?>
			]);

			var options = {
			  chart: {
				title: 'Categoria Itens',
				subtitle: 'Comparativo dos ultimos 3 meses',
			  }
			};

			var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

			chart.draw(data, google.charts.Bar.convertOptions(options));
		  }
		</script>
		<div class="container-fluid">
			<div class="col-md-12" style="margin-bottom:20px">
				<div id="columnchart_material" style="width: 100%; height:500px;"></div>
			</div>
		</div>
		<div class="container-fluid">
			<?php
			
			$inicial = implode("-",array_reverse(explode("/",$inicial))); 
			$final = implode("-",array_reverse(explode("/",$final)));
			//
			$data_inicio = $todayTotal;
			
			$data_termino = new DateTime($data_inicio);
			$data_termino -> sub(new DateInterval('P1M'));
			$data_termino = $data_termino->format('Y-m');
			
			$data_termino2 = new DateTime($data_termino);
			$data_termino2 -> sub(new DateInterval('P1M'));
			$data_termino2 = $data_termino2->format('Y-m');
			
			$data_termino0 = substr($data_inicio, 0 , -3);
			//
			$data_termino_fat1 = new DateTime($data_inicio);
			$data_termino_fat1 -> sub(new DateInterval('P1M'));
			$data_termino_fat1 = $data_termino_fat1->format('Y-m');
			
			$data_termino_fat2 = new DateTime($data_termino_fat1);
			$data_termino_fat2 -> sub(new DateInterval('P1M'));
			$data_termino_fat2 = $data_termino_fat2->format('Y-m');
			
			$data_termino_fat3 = new DateTime($data_termino_fat2);
			$data_termino_fat3 -> sub(new DateInterval('P1M'));
			$data_termino_fat3 = $data_termino_fat3->format('Y-m');
			

			/*echo $data_termino0.' = '.$data_termino_fat1.'<br/>';
			echo $data_termino.' = '.$data_termino_fat2.'<br/>';
			echo $data_termino2.' = '.$data_termino_fat3.'<br/>';*/
			
			
			$categorias = mysql_query("SELECT * FROM notas_categorias WHERE id IN($eta)"); 
			$se = 0; $total_geral = 0;
			
			echo '<table class="table table-min table-striped table-bordered" style="font-size:18px;">';
			echo '<thead><tr><th>Nº</th><th>Categoria</th>
			<th>'.implode("/",array_reverse(explode("-",$data_termino2))).'</th>
			<th>'.implode("/",array_reverse(explode("-",$data_termino))).'</th>
			<th>'.implode("/",array_reverse(explode("-",$data_termino0))).'</th>
			</tr></thead><tbody>';
			echo '<tr>';
				echo '<td>  </td>';
				echo '<td style="text-align:center">FATURAMENTO CSI</td>';
				$total_faturamento_01 = mysql_result(mysql_query("SELECT SUM(valor_sabesp_d + valor_sabesp_i) as totalSum FROM ae_medicao WHERE (data_ref between '".$data_termino_fat3."' and '".$data_termino_fat3."') AND obra IN($obra_r)"),0,"totalSum");
				
				$total_faturamento_02 = mysql_result(mysql_query("SELECT SUM(valor_sabesp_d + valor_sabesp_i) as totalSum FROM ae_medicao WHERE (data_ref between '".$data_termino_fat2."' and '".$data_termino_fat2."') AND obra IN($obra_r)"),0,"totalSum");
				
				$total_faturamento_03 = mysql_result(mysql_query("SELECT SUM(valor_sabesp_d + valor_sabesp_i) as totalSum FROM ae_medicao WHERE (data_ref between '".$data_termino_fat1."' and '".$data_termino_fat1."') AND obra IN($obra_r)"),0,"totalSum");
			
				echo '<td width="20%">'.money_format('%n', $total_faturamento_01).'</td>';
				echo '<td width="20%">'.money_format('%n', $total_faturamento_02).'</td>';
				echo '<td width="20%">'.money_format('%n', $total_faturamento_03).'</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td>  </td>';
				echo '<td style="text-align:center">FATURAMENTO 75%</td>';
				echo '<td width="20%">'.money_format('%n', $total_faturamento_01*75/100).'</td>';
				echo '<td width="20%">'.money_format('%n', $total_faturamento_02*75/100).'</td>';
				echo '<td width="20%">'.money_format('%n', $total_faturamento_03*75/100).'</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td> </td>';
				echo '<td style="text-align:center">FOLHA DE PAGAMENTO</td>';
				//$total_folha_01 = mysql_result(mysql_query(" - "),0,"totalSum");
				
				$total_folha_03 = mysql_result(mysql_query("SELECT SUM(((select salario from rh_funcoes where id = funcao)*0.8) + (select salario from rh_funcoes where id = funcao)+((vale_qtd*2)*21)+((vale_qtd2*2)*21)+(vale_refeicao*21)+(vale_alimentacao)) as totalSum FROM rh_funcionarios WHERE demissao = '0000-00-00' and situacao IN(6,10,7,12) and (obra IN($obra_r) OR tipo_emp = '1') order by rh_funcionarios.nome asc"),0,"totalSum");
				
				echo '<td width="20%">'.money_format('%n', $total_folha_03).'</td>';
				echo '<td width="20%">'.money_format('%n', $total_folha_03).'</td>';
				echo '<td width="20%">'.money_format('%n', $total_folha_03).'</td>';
			echo '</tr>';
			while($c = mysql_fetch_array($categorias)) {
				$cat_id = $c['id'];
				echo '<tr>';
				$se += 1;
				echo '<td width="20px">'.$se.'</td>';
				echo '<td>'.$c['descricao'].'</td>';
				$total_1 = mysql_result(mysql_query("select SUM(notas_itens_add.quantidade*notas_itens_add.valor) as totalSum FROM notas_nf, notas_itens_add WHERE notas_nf.id = notas_itens_add.nota AND notas_itens_add.categoria = '".$c['id']."' and notas_nf.obra in ($obra_r) AND (notas_nf.dataxml between '".$data_termino2."-01' and '".$data_termino2."-31') order by notas_itens_add.categoria"),0,"totalSum");
			
				$total_2 = mysql_result(mysql_query("select SUM(notas_itens_add.quantidade*notas_itens_add.valor) as totalSum FROM notas_nf, notas_itens_add WHERE notas_nf.id = notas_itens_add.nota AND notas_itens_add.categoria = '".$c['id']."' and notas_nf.obra in ($obra_r) AND (notas_nf.dataxml between '".$data_termino."-01' and '".$data_termino."-31') order by notas_itens_add.categoria"),0,"totalSum");
				
				$total_3 = mysql_result(mysql_query("select SUM(notas_itens_add.quantidade*notas_itens_add.valor) as totalSum FROM notas_nf, notas_itens_add WHERE notas_nf.id = notas_itens_add.nota AND notas_itens_add.categoria = '".$c['id']."' and notas_nf.obra in ($obra_r) AND (notas_nf.dataxml between '".$data_termino0."-01' and '".$data_termino0."-31') order by notas_itens_add.categoria"),0,"totalSum");
				
				echo '<td width="20%">'.money_format('%n', $total_1).'</td>';
				echo '<td width="20%">'.money_format('%n', $total_2).'</td>';
				echo '<td width="20%">'.money_format('%n', $total_3).'</td>';
				

				$total_geral_1 += $total_1;
				$total_geral_2 += $total_2;
				$total_geral_3 += $total_3;
				
				$total_geral += $total_1 + $total_2 + $total_3;
				echo '</tr>';
			}
			echo '</tbody>';
			echo '<tfoot>';
			echo '<tr>';
				echo '<td colspan="2" style="text-align:center">TOTAL CATEGORIAS</td>';
				echo '<td>'.money_format('%n', $total_geral_1).'</td>';
				echo '<td>'.money_format('%n', $total_geral_2).'</td>';
				echo '<td>'.money_format('%n', $total_geral_3).'</td>';
			echo '</tr>';
			$total_saldo_01 = ($total_faturamento_01*75/100) - $total_folha_03 - $total_geral_1;
			$total_saldo_02 = ($total_faturamento_02*75/100) - $total_folha_03 - $total_geral_2;
			$total_saldo_03 = ($total_faturamento_03*75/100) - $total_folha_03 - $total_geral_3;
			echo '<tr class="info" style="font-weight:bold">';
				echo '<td colspan="2" style="text-align:center">SALDO (LIQUIDO - TOTAL)</td>';
				echo '<td>';
				if($total_saldo_01 > 0){
					echo '<span class="text-success">'.money_format('%n', $total_saldo_01).'</span>';
				}else{
					echo '<span class="text-danger">'.money_format('%n', $total_saldo_01).'</span>';
				}
				echo '</td>';
				echo '<td>';
				if($total_saldo_02 > 0){
					echo '<span class="text-success">'.money_format('%n', $total_saldo_02).'</span>';
				}else{
					echo '<span class="text-danger">'.money_format('%n', $total_saldo_02).'</span>';
				}
				echo '</td>';
				echo '<td>';
				if($total_saldo_03 > 0){
					echo '<span class="text-success">'.money_format('%n', $total_saldo_03).'</span>';
				}else{
					echo '<span class="text-danger">'.money_format('%n', $total_saldo_03).'</span>';
				}
				echo '</td>';
			echo '</tr>';
			echo '</tfoot>';
			echo '</table>';	
			?>
		</div>
<?php
	exit; 
} 
?>
<div class="row hidden-xs ">
	<h4 style="font-family: 'Oswald', sans-serif; text-align:center; width:100%"><span class="glyphicon glyphicon-calendar" aria-hidden="true" style="margin-right:20px;"></span>GRAFICO - SITUAÇÃO NOTA FISCAL <b>CATEGORIAS</b></h4>
		<div class="row">
			<div class="callout-dark text-center fade-in-b" style="margin-bottom:30px">
				<h2 style="color:#021652">
					<div class="well well-sm">
						<form action="javascript:void(0)" onSubmit="posti(this,'preposto/saldo-notas.php?ac=listarGrafico2','.grafico2');" class="form-inline">
							<label style="margin-right:10px;">
								<b style="font-size:14px;">Obra: </b>
								<select name="ci[]" onChange="$('#contrato2').load('preposto/saldo-notas.php?atu=ac&cidade=' + $(this).val() + '');" style="width:250px;" class="sel" multiple="multiple" required> 
									<?php
										$sql = mysql_query("select * from notas_obras_cidade where id IN($cidade_usuario) order by nome asc");
										while($o = mysql_fetch_array($sql)) {
											echo '<option value="'.$o['id'].'" selected>'.$o['nome'].'</option>';
										}
									?>	
								</select>
							</label>
							<label id="contrato2" style="margin-right:10px;">
								<b style="font-size:14px;">Contrato: </b>
								<select name="ob[]" class="sel" multiple="multiple" required>
									<?php
										$obrasql2 = mysql_query("select * from notas_obras where id IN($obra_usuario) AND status = '0' order by descricao asc");
										while($o = mysql_fetch_array($obrasql2)) {
											echo '<option value="'.$o['id'].'" selected>'.$o['descricao'].'</option>';
										}
									?>	
								</select>
							</label>
							<label style="margin-right:20px;">
								<b style="font-size:14px;">Categoria: </b>
								<select name="et[]" class="sel" multiple="multiple" required>
								<?php
									$sql = mysql_query("select * from notas_categorias where status = '0' and id <> '0' order by descricao asc");
									while($l = mysql_fetch_array($sql)) { extract($l);
										echo '<option value="'.$id.'" selected>'.$descricao.'</option>';
									}
								?>
								</select>
							</label>
							<label>
								<button type="submit" id="graficoButton2" class="btn btn-success btn-sm" style="margin-left:10px; width:100px"><span class="glyphicon glyphicon-search"></span></button>
							</label>
						</form>
					</div>
				</h2>
			</div>
		</div>
	<div class="row" style="background:transparent; padding:20px;">
		<div class="grafico2"> </div>
	</div>
</div>