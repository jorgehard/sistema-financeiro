<?php include("../config.php") ?>
<style>

	* { font-family: Calibri; }
	body { margin: 0; }
	p { margin: 1px; }
	
	                @media print { 
                    #noprint { display:none; } 
                    body { background: #fff; }
                		}	
	
</style>
<script>
$(document).ready(function(){
$(function(){
$("table").tablesorter();
});
});
</script>
<?php $sql = mysql_query("select * from rh_encargos where id = $id"); while($l=mysql_fetch_array($sql)) { extract($l);
			$encargoss = (70 / 100) * $l['sliquido']; 
			echo '<a href="#" class="btn btn-warning btn-sm btnPrint" id="noprint" onclick="window.print()">Imprimir</a>';	 


 ?>


<form action="javascript:void(0)" onSubmit="post(this,'rh/editar-encargos.php?ac=update&id=<?php echo $id ?>','.ajax');" class="small" enctype="multipart/form-data">

	<h5><b>ENCARREGADO:</b>  <?php echo mysql_result(mysql_query("select * from rh_funcionarios where id = $funcionario and enc = 1"),0,"nome") ?> </h5>
	<h5><b>	CNPJ:</b> <?php echo mysql_result(mysql_query("select * from rh_funcionarios where id = $funcionario"),0,"cpf") ?> </h5>
	
	<h5><b>REFERENTE MEDIÇÃO: <?php echo $l['med']; ?>		</h5>
	<h5><b>PERIODO: DE<b> <?php echo $l['data']; ?>	<b>ATÉ</b>  <?php echo $l['datafinal']; ?> </h5><BR>
<?php
	echo '<br><br><table width="100%" class="table table-striped table-condensed table-bordered small">';
		echo '<tr class="small">
						<th></th>
                        <th>Funcionário: </th>
						<th>Salário Líquido: </th>
						<th>Encargos: </th>
						<th>Produção: </th>
						<th>VR:</th>
						<th>VA</th>
						<th>VT</th>';
				
		echo '<tr class="small">';
		
		@$se = 1+@$it3++;

		echo '<td>'.$se.'</td>';
		echo '<td>'.@mysql_result(mysql_query("select * from rh_funcionarios where id = $funcionario"),0,"nome").'</td>';
		echo '<td>'.number_format($sliquido,"2",",",".").'</td>';		
		echo '<td>'.number_format($encargoss,"2",",",".").'</td>';		
		echo '<td>'.number_format($producao,"2",",",".").'</td>';
		echo '<td>'.number_format($vr,"2",",",".").'</td>';		
		echo '<td>'.number_format($va,"2",",",".").'</td>';		
		echo '<td>'.number_format($vt,"2",",",".").'</td>';		
		
		echo '<tr>';
	echo '<th colspan="2" height="30px"width="rigth" fontsize="15"></th>';
	echo '<th colspan="1" height="30px"width="rigth" fontsize="15"> Total R$ &nbsp;'.substr("$soma4",-18,8).'</th>';
	echo '<th colspan="1" height="30px"width="rigth" fontsize="15"> Total R$ &nbsp;'.substr("$soma4",-18,8).'</th>';
	echo '<th colspan="1" height="30px"width="rigth" fontsize="15"> Total R$ &nbsp;'.substr("$soma4",-18,8).'</th>';
	echo '<th colspan="1" height="30px"width="rigth" fontsize="15"> Total R$ &nbsp;'.substr("$soma4",-18,8).'</th>';
	echo '<th colspan="1" height="30px"width="rigth" fontsize="15"> Total R$ &nbsp;'.substr("$soma4",-18,8).'</th>';
	echo '<th colspan="1" height="30px"width="rigth" fontsize="15"> Total R$ &nbsp;'.substr("$soma4",-18,8).'</th>';


	echo '</tr>';
	echo '</table>';
?>
	
	


<?php } ?>

</table>
<div id="noprint">
<div class="ajax"></div>
<div class="resultado" id="print"></div>
