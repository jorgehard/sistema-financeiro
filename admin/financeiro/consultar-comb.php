<?php
	include("../config.php");
	include("../validar_session.php");
	include("../../functions/function-print.php");
	getData();
	getNivel();
?>
<style type="text/css">
@media print {
	table, tr, thead, tbody, td, th{
		border:1px solid rgba(23, 23, 23, 0.6) !important;
	}
}
</style>
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
<?php 

if(@$ac=='excluir-rm') {
	mysql_query("delete from comb_rm where id = $id");
	mysql_query("delete from comb_rm_itens where cod_rm = $id");
	echo '<script>$("#rm'.$id.'").hide()</script>';
	exit;
}?>

<?php
if(@$ac == 'buscar') { 
echo '<table class="table table-bordered table-condensed table-color">
    <thead>
	<tr class="small"><th>Nota</th><th>Data</th><th>Ref.:</th><th>Placa</th><th class="text-center">KM</th><th class="text-center">Obra</th><th class="text-center">Total</th><th class="text-center"><span class="glyphicon glyphicon-edit"></span></th><th class="text-center"><span class="glyphicon glyphicon-trash"></span></th></tr>
    </thead>
    <tbody>';
        $sql = mysql_query("SELECT *, comb_rm.id as id FROM comb_rm WHERE comb_rm.nota like '%$busca%' order by comb_rm.data desc");
        while($l = mysql_fetch_array($sql)) { extract($l);
		$get_inicial_km = mysql_result(mysql_query("SELECT km_inicial FROM comb_rm where id =".$l['id'].""),0,"km_inicial");
		$comb_rm_itens = mysql_query("select * from comb_rm_itens where comb_rm_itens.cod_rm = ".$l['id']." ORDER BY comb_rm_itens.kmfinal asc");
		
		$n1 = $get_inicial_km; $total_b = 0; $mediakm_b = 0;
		while($b = mysql_fetch_array($comb_rm_itens)) { 
			$kmrodados = $b['kmfinal'] - $n1; 
			$n1 = $b['kmfinal']; 
			@$mediakm = @$kmrodados / $b['qtd'];
			$total = $b['vlr'] * $b['qtd'];
			$total_b += $total;
			$mediakm_b += $mediakm;
		}
		$valortotalkm += $mediakm;
		$valortotalT += $total_b;
            echo '<tr class="small" id="rm'.$id.'">';
			if($l['tipo'] == '2'){
				echo '<td>'.$nota.'</td>';
			}else{
				echo '<td>'.@mysql_result(mysql_query("select * from notas_nf where id = ".$l['nota'].""),0,"numero").'</td>';
			}
			echo '<td>'.implode("/",array_reverse(explode("-",$data))).'</td>';
			echo '<td>'.implode("/",array_reverse(explode("-",$data_ref))).'</td>';
            echo '<td>'.@mysql_result(mysql_query("select * from notas_equipamentos where id = ".$l['equipamento'].""),0,"placa").'</td>';
			echo '<td><center>'.number_format($mediakm_b,"2",',', '.').'</center></td>';
			echo '<td><center>'.@mysql_result(mysql_query("SELECT * FROM notas_obras WHERE id = $obra"),0,"descricao").'</center></td>';
			echo '<td><center>'.number_format($total_b,"2",',', '.').'</center></td>';
			if($l['tipo'] == '2'){
				echo '<td width="5%" class="text-center"><a href="#"  class="btn btn-xs btn-warning" onClick=\'$(".retorno").load("financeiro/editar-comb-rm.php?cod_rm='.$id.'&rec_busca='.$busca.'")\'><span class="glyphicon glyphicon-pencil"></span></a></td>'; 		
			}else if($l['tipo'] == '1'){
				echo '<td width="5%" class="text-center"><a href="#"  class="btn btn-xs btn-info" onclick=\'$(".retorno").load("financeiro/editar-comb-rm-novo.php?cod_rm='.$id.'&tipocc=NOTA&rec_busca='.$busca.'")\'><span class="glyphicon glyphicon-pencil"></span></a></td>'; 
			}else{
				echo '<td>ANTIGO</td>';
			}
            echo '<td width="5%" class="text-center"><a href="#" class="btn btn-xs btn-danger" onclick=\'$(".retorno").load("financeiro/consultar-comb.php?ac=excluir-rm&id='.$id.'")\'><span class="glyphicon glyphicon-trash"></span></a></td>';
        	echo '</tr>';

        }
		echo ' </tbody></table>';
		echo '
		<div class="pull-right">
			<h2 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px;">KM: <small>'.number_format($valortotalkm,"2",",", ".").'</small></h2>
			<h2 style="font-family: \'Oswald\', sans-serif; letter-spacing:5px;">Total: <small>R$ '.number_format($valortotalT,"2",",", ".").'</small></h2>
		</div>';
		
		exit; 
	}
?>
	<table width="100%" class="table-responsive nav-pills2 hidden-print" style="margin-bottom:15px">
		<tr>
			<td><a href="#" onclick="ldy('financeiro/cadastrar-comb.php','.conteudo')"><li><span class="glyphicon glyphicon-star"></span> 
			CADASTRAR PLACA</li></a></td>
			<td><a href="#" onclick="ldy('financeiro/consultar-comb.php','.conteudo')"><li class="activeb"><small><span class="glyphicon glyphicon-search"></span></small> 
			CONSULTAR CUPOM</li></a></td>
			<td><a href="#" onclick="ldy('financeiro/relatorio-comb.php','.conteudo')"><li><span class="glyphicon glyphicon-th-list"></span> 
			EMITIR RELATORIO</li></a></td>
		</tr>
	</table>
	<div class="container-fluid hidden-print" style="padding:0px 0px 15px 0px; margin-bottom:20px; border-bottom:1px solid #CCC">
		<img src="../imagens/logo.png" class="img-responsive" width="50px" style="float:left; margin-right:20px"/>
		<h3 style="font-family: 'Oswald', sans-serif; letter-spacing:5px;"> 
			CONSULTA DE <small><b>LANÇAMENTOS DE CUPOM</b></small>
			<a href="javascript:window.print()" style="letter-spacing:8px; padding-left:40px; padding-right:40px;" class="hidden-xs hidden-print pull-right btn btn-warning btn-sm"> <span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Imprimir</a>
		</h3>
	</div>
	<div class="well well-sm hidden-print" style="padding:10px 10px 5px 10px;">
		<form action="javascript:void(0)" class="form-inline" onSubmit=" post(this,'financeiro/consultar-comb.php?ac=buscar','.retorno'); " class="hidden-print">
			<div class="container-fluid" style="padding:0px">
				<div class="col-xs-6 formulario-normal" style="padding:2px">
					<label style="width:100%"><small>Numero (NF):</small><br/> 
						<select name="busca" class="form-control input-sm combobox">
							<option></option>
							<?php
							$numeros = mysql_query("select numero from notas_nf WHERE obra IN($obra_usuario) order by numero asc");
							while($l = mysql_fetch_array($numeros)) {
								echo '<option value="'.$l['id'].'">'.$l['numero'].'</option>';
							}
							
							$numerosb = mysql_query("select nota from comb_rm where obra IN($obra_usuario) GROUP BY nota ORDER BY data DESC");
							while($d = mysql_fetch_array($numerosb)) {
								echo '<option value="'.$d['nota'].'">'.$d['nota'].'</option>';
							}
							?>		
						</select>
					</label>
				</div>
				<div class="col-xs-6">
					<label class="pull-right" style="width:100%"><br/>
						<input type="submit" value="Pesquisar" style="width:50%" class="btn btn-success btn-sm">
					</label>
				</div>
			</div>
		</form>
	</div>
	<div class="retorno"></div>


