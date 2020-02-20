<?php
	include("../config.php");
	include("../validar_session.php");
	include("../../functions/function-print.php");
	getData();
	getNivel();
?>
<script>
	  $(function () {
		$('input').iCheck({
		  checkboxClass: 'icheckbox_square-green',
		  radioClass: 'iradio_square-green',
		  increaseArea: '20%' // optional
		});
	  });
	</script>
<style>
	#autoco {
		max-height: 200px;
		overflow: auto;
		position: absolute;
		border-top: 3px solid #333;
		border-bottom: 3px solid #333;
		display: none;
		width: auto;
		background:#FFF;
	}

</style>
<?php
	if(@$ac=='busca-material') {
		$busca = str_replace("-","%",$busca);
		echo '<ul class="list-group" style="background:#FFF">';
		$sql = mysql_query("select * from ss_materiais where status = 0 and codigo like '%$busca%' or descricao like _utf8 '%$busca%' COLLATE utf8_unicode_ci");
		while($l = mysql_fetch_array($sql)) { extract($l);
			
			$saida_itens = mysql_result(mysql_query("select *, sum(quantidade) as qt from ss_retirada_sabesp, ss_retirada_itens where ss_retirada_sabesp.id = ss_retirada_itens.id_retirada and id_item = '$id' and ss_retirada_sabesp.equipe = '$equipe' and status = 0"),0,"qt");			
			$dev_itens = mysql_result(mysql_query("select *, sum(quantidade) as qt from ss_retirada_sabesp, ss_retirada_itens where ss_retirada_sabesp.id = ss_retirada_itens.id_retirada and id_item = '$id' and equipe = '$equipe' and status = 1"),0,"qt");			
  			$saldo_retirada = $saida_itens-$dev_itens;
  			$saida_ss = mysql_result(mysql_query("select *, sum(ss_ma.qtd) as qt from ss_se, ss_ma where ss_se.cod_ss = ss_ma.cod_ss and ss_ma.material = $id and ss_se.equipe = '$equipe'"),0,"qt");
  			$saldo = $saldo_retirada-$saida_ss;
  			
  			echo '<li class="list-group-item small"><span class="badge">'.$saldo.'</span>
  						<a href="javascript:void(0)" onclick=\'$("#busca").val("'.trim($descricao).'"); $("#item").val("'.$id.'"); $("#autoco").hide()\'>'.$codigo.' - '.addslashes($descricao).'</a>
  				 </li>';			
		}
		
		echo '</ul>';
		exit;
	}
	
	if(@$ac=='listar') {
		if(@$op=='inserir') {
			$qtd = str_replace(",",".",$qtd); 
			mysql_query("insert into ss_retirada_itens (id_retirada,id_item,quantidade,tipo) values ('$retirada','$item','$qtd','$tipo')");
		}
		
		if(@$op=='del') { mysql_query("delete from ss_retirada_itens where id = $item"); }
		
		echo '<table class="table table-bordered table-condensed table-green small">';
		echo '<thead><tr><th>Descricao</th><th style="text-align:center">Saldo</th><th style="text-align:center">Qtd</th><th style="text-align:center">Tipo</th>';
		if($editarss_usuario == '1' || $acesso_login == 'MASTER'){
			echo '<th>Excluir</th>';
		}
		echo '</tr></thead><tbody>';
		
		$sql = mysql_query("SELECT ss_retirada_sabesp.equipe as equipe_id, ss_retirada_itens.id, ss_retirada_itens.id_retirada, ss_retirada_itens.id_item, ss_retirada_itens.quantidade, ss_retirada_itens.tipo FROM ss_retirada_sabesp INNER JOIN ss_retirada_itens ON ss_retirada_sabesp.id = ss_retirada_itens.id_retirada where id_retirada = '$retirada' order by id desc");
		while($l = mysql_fetch_array($sql)) { extract($l);
			
			$total_entrada = @mysql_result(mysql_query("SELECT SUM(ss_retirada_itens.quantidade) as entrada FROM ss_retirada_sabesp INNER JOIN ss_retirada_itens ON ss_retirada_sabesp.id = ss_retirada_itens.id_retirada INNER JOIN ss_materiais ON ss_materiais.id = ss_retirada_itens.id_item WHERE (ss_retirada_sabesp.data BETWEEN '2016-11-01' and '$todayTotal') AND ss_retirada_itens.id_item = '$id_item' AND ss_retirada_sabesp.equipe = '$equipe_id' AND ss_retirada_itens.tipo = '1'"),0,"entrada");
			
			$total_saida = @mysql_result(mysql_query("SELECT SUM(qtd) as qtd FROM ss_ma WHERE (data_uso BETWEEN '2016-11-01' and '$todayTotal') and ss_ma.material = '$id_item' AND ss_ma.equipe = '$equipe_id'"),0,"qtd");
			
			$total_saldo = $total_entrada - $total_saida;
			
			echo '<tr>';
			echo '<td>'.@mysql_result(mysql_query("select * from ss_materiais where id = $id_item"),0,"descricao").'</td>';
			$maximo_geral = @mysql_result(mysql_query("SELECT maximo FROM ss_materiais WHERE id = $id_item"),0,"maximo");
			
			if ($maximo_geral != 0 && $total_saldo >= $maximo_geral){
				echo '<td class="text-center"><span class="label label-warning" style="width:150px !important; font-size:12px;">'.number_format($total_saldo,"0").'</span></td>';
				//echo '<script>alert("Atenção!!! Material com saldo em amarelo ja passou do limite estabelecido")</script>';
			}else if ($total_saldo > 0){
				echo '<td class="text-center"><span class="label label-success" style="width:150px !important; font-size:12px;">'.number_format($total_saldo,"0").'</span></td>';
			}else{
				echo '<td class="text-center"><span class="label label-danger" style="width:150px !important; font-size:12px;">'.number_format($total_saldo,"0").'</span></td>';
			}
			echo '<td align="center">'.number_format($quantidade,"2").'</td>';
			echo '<td align="center" width="80px">'; if($tipo==1) { echo '<span class="label label-info">RETIRADA</span>'; } else { echo '<span class="label label-primary">DEVOLUÇÃO</span>'; }
			echo '</td>';
			if($editarss_usuario == '1' || $acesso_login == 'MASTER'){
				echo '<td align="center" width="40px"><a href="#" onclick=\'ldy("almoxarifado/editar-retirada-sabesp.php?ac=listar&op=del&item='.$id.'&retirada='.$retirada.'",".resultado")\' class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a></td>';
			}
			echo '</tr>'; 
		}		

		echo '</tbody></table>';
		
		exit;
	}
?>
<h4 style="font-family: 'Oswald', sans-serif;letter-spacing:5px;"><small>Informações Retirada <span style="font-size:8px"> + 01/11/2016</span></small>
</h4>
<table class="table table-condensed table-bordered table-blue">
	<thead>
		<tr class="small"><th>Equipe:</th><th>Data:</th></tr>
	</thead>
	<tbody>
	<tr>
		<?php
		$detalhes = mysql_query("select * from ss_retirada_sabesp where id = $retirada");
		while($l = mysql_fetch_array($detalhes)) { $id_e = $l['equipe'];
			echo '<td>'.mysql_result(mysql_query("select * from equipes where id = ".$l['equipe'].""),0,"nome").'</td>';
			echo '<td>'.implode("/",array_reverse(explode("-", $l['data']))).'</td>';
		}
		?>
	</tr>
	</tbody>
</table>

<script>
$(document).ready(function() {
	//$("#busca").blur(function() { $('#autoco').hide(); })
	$("#busca").keyup(function() {
		var vlr_campo = $(this).val();
		vlr = vlr_campo.replace(/\s/g,"-");
		
		if(vlr_campo.length > 3) {
		$('#autoco').show(); 
		$('#autoco').load('almoxarifado/editar-retirada-sabesp.php?ac=busca-material&equipe=<?php echo $id_e ?>&busca=' + vlr); }
		
		if(vlr_campo.length < 3) {
		$('#autoco').hide(); 	
		$('#item').val(''); 	
		}
	})
});
</script>
	<div class="alert alert-success" style="padding:5px 5px 0px 5px">
		<form action="javascript:void(0)" onSubmit="post(this,'almoxarifado/editar-retirada-sabesp.php?ac=listar&op=inserir&retirada=<?php echo $retirada ?>','.resultado'); $('#busca').val(''); $('#item').val('')" class="formulario-success">
			<div class="container-fluid" style="padding:0px">
				<div class="col-xs-4" style="padding:2px">
					<label><small>Selecione o material:</small>
						<input type="text" class="form-control input-sm" id="busca" style="width:100%" required>
						<input type="text" name="item" id="item" style="display: none" required>
						<div id="autoco"></div>
					</label>
				</div>
				<div class="col-xs-2" style="padding:2px">
					<label><small>Quantidade:</small>
						<input type="text" name="qtd" class="form-control input-sm" style="width:100%" required>
					</label>
				</div>
				<div class="col-xs-3" style="padding:2px">
					<label class="ret_dev"> <br/>
						<input type="radio" name="tipo" value="1" checked> 
						Retirada 
						<input type="radio" name="tipo" value="2"> 
						Devolução 
					</label>
				</div>
				<div class="col-xs-2" style="padding:2px">
					<label><br/>
						<input type="submit" style="width:100%" value="Adicionar" class="btn btn-success btn-sm" />
					</label>
				</div>
			</div>
		</form>
	</div>	

<script>ldy("almoxarifado/editar-retirada-sabesp.php?ac=listar&retirada=<?php echo $retirada ?>",".resultado")</script>

<div class="resultado"></div>