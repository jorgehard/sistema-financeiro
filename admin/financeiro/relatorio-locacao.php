<?php
include_once("../config.php");
include_once("../validar_session.php");
include "funcao-valorextenso.php"; 
getData();
getNivel();

?>
<script src="../js/combobox-resume.js"></script>
<script type="text/javascript">
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
		buttonWidth: '100%'
	}); 
});
</script>

<style>

	table {

		border-collapse: collapse;

		width: 100%;

	}

	

	table tr td, th {

		padding: 5px;

		border: 1px solid #333;

	}

	

</style>



<?php



	function nome_mes($m) {

	switch ($m) {

        case "01":    $mes = 'JANEIRO';     break;

        case "02":    $mes = 'FEVEREIRO';   break;

        case "03":    $mes = 'MARÇO';       break;

        case "04":    $mes = 'ABRIL';       break;

        case "05":    $mes = 'MAIO';        break;

        case "06":    $mes = 'JUNHO';       break;

        case "07":    $mes = 'JULHO';       break;

        case "08":    $mes = 'AGOSTO';      break;

        case "09":    $mes = 'SETEMBRO';    break;

        case "10":    $mes = 'OUTUBRO';     break;

        case "11":    $mes = 'NOVEMBRO';    break;

        case "12":    $mes = 'DEZEMBRO';    break; 

 	}	return $mes; }

	



if($ac == 'puxar'){

	echo '<label class="formulario-normal" style="width:100%"><small>Locador:</small><br/>
			<select class="form-control input-sm combobox" name="empresa">';
				$sql = mysql_query("select *, notas_equipamentos.id as id_e from notas_empresas, notas_equipamentos where notas_equipamentos.empresa = notas_empresas.id and notas_equipamentos.status_2 = 1 AND notas_equipamentos.obra = '$obra_tipo' order by notas_empresas.nome asc");

				while($l = mysql_fetch_array($sql)) { extract($l);

					echo '<option value="'.$id_e.'">'.$nome.' - '.$placa.'</option>';

				}

			echo '</select>

		</label>';

	exit;

}

if(@$ac=='resultado') {
	$n = 1;	
	$sql = mysql_query("select *, id as id_equip, desconto as desconto, justificativa as justificativa from notas_equipamentos where id IN($empresa)");
	while($l = mysql_fetch_array($sql)) { extract($l);
	echo '<div class="resultado-edit hidden-print" style="width:100%; height:40px" >';
		if($acesso_login == 'MASTER' || $acesso_login == 'MODERADOR'){
			echo '<a href="#" style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; font-size:15px; padding:5px;" class="btn btn-xs btn-info pull-right" onclick=\'ldy("almoxarifado/editar-equipamento-master.php?id='.$l['id_equip'].'",".resultado")\'><span style="margin:5px"><span class="glyphicon glyphicon-pencil"></span> Editar Equipamento</span></a>';
		}else{
			echo '<a href="#" style="font-family: \'Oswald\', sans-serif; letter-spacing:5px; font-size:15px; padding:5px;" class="btn btn-xs btn-info pull-right" onclick=\'ldy("almoxarifado/editar-equipamento-almox.php?id='.$l['id_equip'].'",".resultado")\'><span style="margin:5px"><span class="glyphicon glyphicon-pencil"></span> Editar Equipamento</span></a>';
		}	
	
	echo '</div>';
	$ns = $n++;

	$nome_empresa = mysql_result(mysql_query("select * from notas_empresas where id = $empresa"),0,"nome");
	
	$nome_obra = explode("-",mysql_result(mysql_query("select * from notas_obras where id = $obra_tipo"),0,"descricao"));

	$cnpj_empresa = mysql_result(mysql_query("select * from notas_empresas where id = $empresa"),0,"cnpj");
	$banco_empresa = mysql_result(mysql_query("select * from notas_empresas where id = $empresa"),0,"banco");
	$conta_empresa = mysql_result(mysql_query("select * from notas_empresas where id = $empresa"),0,"cc");
	$ag_empresa = mysql_result(mysql_query("select * from notas_empresas where id = $empresa"),0,"ag");

	$rg_empresa = mysql_result(mysql_query("select * from notas_empresas where id = $empresa"),0,"cnpj");

	$descri = mysql_result(mysql_query("select * from notas_cat_e where id = $categoria"),0,"descricao");

	$subdescri = mysql_result(mysql_query("select * from notas_cat_sub where id = $sub_categoria"),0,"descricao");



	

	echo '<div style="width:100%;padding:5px;border-bottom:1px solid #333;">';

	echo '<div style="width:50%;float:left;"><img src="../imagens/logo.png" width="90px;" style="border:1px solid #333; padding: 5px; border-radius: 5px;"></div>';

	echo '<div style="width:50%;text-align:right;float:left;">
Polêmica Serviços Básicos Ltda<br />
							Rua Euclides Miragaia. 700 – Salas 82 e 83 – Centro - CEP: 12245-820 <br />
							São José dos Campos – São Paulo<br />
							Telefax (012) 3941-8555 <br />
							E-MAIL:      contato@polemica.construtora.com.br <br />
							SITE:      www.polemicaconstrutora.com.br <br />
	</div><div style="clear:both;"></div>';

	echo '</div>';
	if($pagamento_comb == '') { $pagamento_comb = 0; }
	if($desconto_comb == ''){$desconto_comb = 0; }
	

	$comdesc = ($valor + $pagamento_comb) - $desconto - $desconto_comb;
	$valor_extenso = escreverValorMoeda($comdesc);
	

	echo '<h2 align="center">RECIBO</h2>';

	echo '<h3 align="center">R$ '.number_format($comdesc,"2",",",".").'</h3>';

	echo '<div style="margin: 80px 0 80px 0; text-align: justify;">Recebi da empresa POLEMICA SERVIÇOS BÁSICOS LTDA, CNPJ/MF n.º 61.870.101/0010-08, 

		  a importância supra de <b>R$ '.number_format($comdesc,"2",",",".").'</b> ('.$valor_extenso.'), referente locação do veiculo <b>'.$descri.' '.$subdescri.' ' .$marca.'</b> 

		  Placa <b>'.$placa.'</b> de minha propriedade, no mês de '.nome_mes($mes_sol).' de '.$ano_sol.', conforme contrato, Banco <b>'.$banco_empresa.'</b> Conta <b>'.$conta_empresa.'</b> Agência <b>'.$ag_empresa.'</b>. </div>';

		  

	echo '<div style="margin: 80px 0 80px 0; text-align: justify;">Por ser verdade, firmo o presente dando ampla quitação para nada mais a reclamar no presente ou no futuro.</div>';

	echo '<div style="margin: 40px 0 80px 0; text-align: justify;">Obs: Este recibo só terá a devida validade após o deposito em conta.</div>';

	echo '<div style="margin: 80px 0 80px 0; text-align: right;">'.substr($nome_obra[0],0,-1).', '.date("d").' DE '.nome_mes(date("m")).' DE '.date("Y").'</div>';



if ($cnpj_empresa <> '0'){	echo '<div style="margin: 80px 0 80px 0; text-align: right;">__________________________________________________<br/>'.$nome_empresa.'<br/>'.$cnpj_empresa.'</div>'; } else {

		echo '<div style="margin: 80px 0 80px 0; text-align: right;">__________________________________________________<br/>'.$nome_empresa.'<br/>'.$rg_empresa.'</div>';



}

	

	echo '<h4>Demonstrativo</h4>';

	echo '<table>';

	echo '<tr><th>Descrição</th><th>Valor</th></tr>';

	echo '<tr><th>REFERENTE A LOCAÇÃO DE VEÍCULO DO MÊS DE  '.nome_mes($mes_sol).' / '.$ano_sol.'</th><th>&nbsp; R$ '.number_format($valor,"2",",",".").'</th></tr>';
	echo '<tr><th>PAGAMENTO DE COMBUSTIVEL</th><th>&nbsp; R$ '.number_format($pagamento_comb,"2",",",".").'</th></tr>';
	echo '<tr><th>DESCONTO DE COMBUSTIVEL</th><th>- R$ '.number_format($desconto_comb,"2",",",".").'</th></tr>';
	if($desconto >= 1){
		echo '<tr><th>'.$justificativa.'</th><th>&nbsp; R$ '.number_format($desconto,"2",",",".").'</th></tr>';
	}
	echo '<tr><th>TOTAL</th><th>&nbsp; R$ '.number_format($comdesc,"2",",",".").'</th></tr>';

	echo '</table>';

	if(mysql_num_rows($sql) <> $ns) { echo '<div style="page-break-after: always;"></div>'; }

	}

	exit;

}



?>



	<div class="container-fluid hidden-print" style="padding:0px 0px 15px 0px; margin-bottom:20px; border-bottom:1px solid #CCC">
		<img src="../imagens/logo.png" class="img-responsive" width="50px" style="float:left; margin-right:20px"/>
		<h3 style="font-family: 'Oswald', sans-serif; letter-spacing:5px;"> 
			GERADOR DE  <small><b>RECIBOS DE LOCAÇÃO</b></small>
			<a href="javascript:window.print()" style="letter-spacing:8px; padding-left:40px; padding-right:40px;" class="hidden-xs hidden-print pull-right btn btn-warning btn-sm"> <span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir</a>
		</h3>
	</div>
	<div class="well well-sm hidden-print" style="padding:10px 10px 5px 10px;"> 
		<form action="javascript:void(0)" onsubmit="post(this,'financeiro/relatorio-locacao.php?ac=resultado','.resultado')">
			<div class="container-fluid" style="padding:0px">
				<div class="col-xs-2" style="padding:2px">
					<label style="width:100%"><small>Obra:</small><br/>
						<select name="obra_tipo" class="form-control input-sm" onChange="$('#itens').load('financeiro/relatorio-locacao.php?ac=puxar&obra_tipo=' + $(this).val() + '');" required>
							<option value="" selected disabled>Selecione uma obra</option>
							<?php 
								$obra = mysql_query("select * from notas_obras where id IN($obra_usuario) order by descricao asc");
								while($l = mysql_fetch_array($obra)) {
									echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>';
								}
							?>		
						</select>
					</label>
				</div>
				<div class="col-xs-4" style="padding:2px">
					<label id="itens" style="width:100%">
						<label style="width:100%"><small>Locador:</small><br/>
							<select class="form-control input-sm" name="empresa">
								<option value="">Selecione uma obra</option>
							</select>
						</label>
					</label>
				</div>
				<div class="col-xs-1" style="padding:2px">
					<label style="width:100%"><small>Mês:</small><br/>
						<input type="text" name="mes_sol" class="form-control input-sm" size="3" value="<?php echo $today['mon'] ?>" onClick="$(this).select()" maxlength="2" required>
					</label>
				</div>
				<div class="col-xs-1" style="padding:2px">
					<label style="width:100%"><small>Ano:</small><br/>
						<input type="text" name="ano_sol" class="form-control input-sm" size="3" value="<?php echo $today['year'] ?>" onClick="$(this).select()" maxlength="4" required>
					</label>
				</div>
				<div class="col-xs-2" style="padding:2px">
					<label style="width:100%"><small>Pagamento:</small><br/>
						<input type="number" name="pagamento_comb" class="form-control input-sm" />
					</label>
				</div>
				<div class="col-xs-2" style="padding:2px">
					<label style="width:100%"><small>Desconto:</small><br/>
						<input type="number" name="desconto_comb" class="form-control input-sm" />
					</label>
				</div>
				<div class="col-xs-12">
					<center>
						<label style="width:30%">
							<input type="submit" value="Gerar Recibo" style="width:100%" class="btn btn-success btn-sm"/>
						</label>
					</center>
				</div>
			</div>
		</form>
	</div>

	<div class="resultado"></div>

