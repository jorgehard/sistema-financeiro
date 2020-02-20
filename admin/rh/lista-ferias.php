<?php
	include("../config.php");
	include("../validar_session.php");
	getData();
	getNivel();

if(@$ac=='del') { 
	mysql_query("delete from rh_ferias where id = $id"); 
} 
if(@$ac=='add') { 
	mysql_query("insert into rh_ferias (funcionario,dias,obs,data) values ('$funcionario','$dias','$obs','$data')"); 
} 
?>
<table class="table table-condensed table-bordered table-green">
	<thead>
		<tr>
			<th><small>Dias:</small></th>
			<th><small>Data:</small></th>
			<th><small>Observações:</small></th>
			<th style="text-align:center"><small>Editar:</small></th>
			<?php if($acesso_login == 'MASTER' || $acesso_login == 'MODERADOR'){ echo '
			<th style="text-align:center"><small>Excluir:</small></th>'; } ?>
		</tr>
	</thead>
	<?php
		$sql = @mysql_query("select * from rh_ferias where funcionario = '$funcionario' order by data desc") or die (mysql_error());
        while($l = @mysql_fetch_array($sql)) { extract($l);
			echo '<tr>';
			echo '<td width="10%">'.$dias.'</td>';
			echo '<td width="10%">'.implode("/",array_reverse(explode("-",$data))).'</td>';
			echo '<td width="75%">'.$obs.'</td>';
			echo '<td width="3%" style="text-align:center"><a href="#" onclick=\'$(".modal-body").load("rh/editar-ferias.php?id='.$id.'")\' data-toggle="modal" data-target="#myModalLista" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-edit"></span></a></td>';
			if($acesso_login == 'MASTER' || $acesso_login == 'MODERADOR'){
				echo '<td width="3%" style="text-align:center" ><a href="javascript:void(0)" class="btn btn-xs btn-danger" onclick=\'ldy("rh/lista-ferias.php?ac=del&id='.$id.'&funcionario='.$funcionario.'",".historico")\'><span class="glyphicon glyphicon-trash"></span></a></td>';
			}
			
			echo '</tr>';
		}
	?>
</table>

