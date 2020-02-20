<?php
	include("../config.php");
	include("../validar_session.php");
	getData();
	getNivel();

if(@$ac=='del') { 
	$sql = mysql_query("delete from notas_historico_km where id = '$id_del'");	
} 
if(@$ac=='add') { 
	$sql = mysql_query("INSERT INTO notas_historico_km (`data`,`km`,`id_equipamento`, `descricao`, `data2`, `km2`) VALUES ('$data','$km','$id', '$historico', '$data2', '$km2')");
} 
// LISTAR HISTORICO 
echo '<div id="ajax-historico">';
echo '<table class="table table-condensed table-striped table-green">';
		echo '<thead>
					<tr>
						<td></td>
						<td colspan="2"><b><center>Atual</center></b></td>
						<td colspan="2"><b><center>Proxima</center></b></td>
						<td></td>
					</tr>
					<tr>
						<th><small>Descrição</small></th>
						<th><small>Data</small></th>
						<th><small>KM</small></th>
						<th><small>Data</small></th>
						<th><small>KM</small></th>
						<th></th>
					</tr>
				</thead>
				<tbody>';
		$sql = mysql_query("SELECT * FROM notas_historico_km WHERE id_equipamento = '$id'"); 
		while($l=mysql_fetch_array($sql)) { 
			echo '<tr>';
				echo '<td width="40%">'.$l['descricao'].'</td>';
				echo '<td width="15%">'.implode("/",array_reverse(explode("-",$l['data']))).'</td>';
				echo '<td width="15%">'.$l['km'].'</td>';
				echo '<td width="15%">'.implode("/",array_reverse(explode("-",$l['data2']))).'</td>';
				echo '<td width="15%">'.$l['km2'].'</td>';
				echo '<td width="5%" class="hidden-print" style="text-align:center">';
					if($acesso_login == 'MASTER' || $acesso_login == 'MODERADOR' || $acesso_login == 'EQUIPAMENTO'){
						echo '<a href="#" onclick=\'$("#ajax-historico").load("almoxarifado/listar-historico.php?ac=del&id_del='.$l['id'].'&id='.$l['id_equipamento'].'")\' class="btn btn-xs btn-danger" style="margin:0px; padding:0px 5px; font-weight:bold;"><span class="glyphicon glyphicon-trash"></span></a>';
					}
				echo '</td>';
			echo '</tr>';
		}
		echo '</tbody>
		</table>';
	echo '</div>';
