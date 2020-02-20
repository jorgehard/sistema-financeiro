<?php
	include("../config.php");
	include("../validar_session.php");
	getData();
	getNivel();


if(@$ac=='del') { 
	mysql_query("delete from rh_funcionario_historico where id = $id"); 
} 
if(@$ac=='add') { 
	mysql_query("insert into rh_funcionario_historico (funcionario,mensagem,data) values ('$funcionario','$mensagem','$data')"); 
} 
?>
<table class="table table-condensed table-bordered table-green">
	<thead>
		<tr><th style="text-align:center"><small>Data</small></th><th><small>Historico</small></th>
		<?php if($acesso_login == 'MASTER' || $acesso_login == 'MODERADOR'){ echo '<th style="text-align:center"><small>Excluir:</small></th>'; } ?></tr>
	</thead>
	<?php
		$sql = @mysql_query("select * from rh_funcionario_historico where funcionario = '$funcionario' order by data desc") or die (mysql_error());
        while($l = @mysql_fetch_array($sql)) { extract($l);
			echo '<tr>';
			echo '<td width="10%" style="text-align:center">'.implode("/",array_reverse(explode("-",$data))).'</td>';
			echo '<td width="80%">'.$mensagem.'</td>';
			if($acesso_login == 'MASTER' || $acesso_login == 'MODERADOR'){
				echo '<td width="5%" style="text-align:center"><a href="javascript:void(0)" class="btn btn-xs btn-danger" onclick=\'ldy("rh/lista-historico.php?ac=del&id='.$id.'&funcionario='.$funcionario.'",".historico")\'><span class="glyphicon glyphicon-trash"></span></a></td>';
			}
			echo '</tr>';
		}
	?>
</table>

