<style>
	@media print {
		#cinza { background-color: #CCC; }
		table { font-size: 9px; }	
	}
	
</style>

<?php
include("../config.php"); 

if(@$ac=='resultado') {

	$inicial = '01/'.$inicial; 
    echo '<h3>Relação de Funcionários</h3>';
	
	$item = @$it3+1;
	echo '<table width="100%" class="table table-condensed table-bordered table-hover small">';
	echo '<tr class="small">
						<th></th>
                        <th>Funcionário: </th>
						<th>Função: </th>
						<th>Obra: </th>
						<th>Admissão: </th>
						<th> Salário </th>
						<th> Nº PIS </th>';
	echo '<br><tr><td colspan="3" class="primary">Lista de Funcionários Ativos</td></tr>';
			
			$funcionarios = mysql_query("select * from rh_funcionarios where demissao = '0000-00-00' and admissao <> '0000-00-00' order by obra desc");
			while($l = mysql_fetch_array($funcionarios)) { extract($l);
			
			@$se = 1+@$it3++;
			
					echo '<tr class="small">';
					echo '<td>'.$se.'</td>';
					//echo '<td></td>';
					echo '<td>'.$nome.'</td>';
					echo '<td>'.@mysql_result(mysql_query("select * from rh_funcoes where id = $funcao"),0,"descricao").'</td>';
					echo '<td>'.@mysql_result(mysql_query("select * from notas_obras where id = $obra"),0,"descricao").'</td>';
					
						'</td>';
					echo '<td>'.implode("/",array_reverse(explode("-",$admissao))).'</td>';
					echo '<td>'.@mysql_result(mysql_query("select * from rh_funcoes where id = $funcao"),0,"salario").'</th>';		
					echo '<td>'.$pis_numero.'</td>';

					echo '<td>';
					/*if($exp > 0) { echo '<center><span class="label label-success">SIM</center></span>'; }
						else { echo '<center><span class="label label-danger">NÃO</center></span>'; } 
					echo '</td>';
					echo '<td>';
					  if($expdias < 2) { 
					  $exp45 = substr($admissao, -2) + 45;
					  echo '<center>'.$exp45.'</center>'; }
							else { echo '<center>'.$admissao.'</center>'; }*/
						
					echo '</td>';

					echo '</tr>'; 
					
			
		}
	
	
	
	
	

	
	
	echo '</table>';
}  

else { ?>
			
	<form action="javascript:void(0)" onSubmit="post(this,'rh/relatorio-detalhado-func.php?ac=resultado','.retorno')">
		<label for="">Mês referente: <input type="text" class="form-control input-sm" onfocus="$(this).mask('99/9999')" name="inicial" /></label>
		<label for=""><input type="submit" class="btn btn-success btn-sm" value="Filtrar" /></label>	
	</form>
	
	<div class="retorno"></div>
	
<?php }	?>

<script>
$(document).ready(function() {
	$('.popover').popover({
  		trigger: 'focus'
	})
})
</script>