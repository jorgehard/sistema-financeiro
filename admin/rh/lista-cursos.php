<?php
	include("../config.php");
	include("../validar_session.php");
	getData();
	getNivel();


if(@$ac=='del') { 
	mysql_query("delete from rh_historico_cursos where id = $id"); 
} 
?>
<table class="table table-condensed table-bordered table-green">
	<thead>
		<tr>
			<th style="text-align:center"><small>Data Vencimento:</small></th>
			<th style="text-align:center"><small>Valor Vencimento:</small></th>
			<th><small>Obs</small></th>
			<th style="text-align:center"><small>Anexo</small></th>
			<?php if($acesso_login == 'MASTER'){ echo '<th style="text-align:center"><small>Excluir:</small></th>'; } ?>
		</tr>
	</thead>
	<?php
		$sql = @mysql_query("select * from rh_historico_cursos where funcionario = '$funcionario' order by data desc") or die (mysql_error());
        while($l = @mysql_fetch_array($sql)) { extract($l);
			echo '<tr>';
			echo '<td width="10%" style="text-align:center">'.implode("/",array_reverse(explode("-",$data))).'</td>';
			echo '<td width="10%" style="text-align:center">'.implode("/",array_reverse(explode("-",$vencimento))).'</td>';
			echo '<td width="50%">'.$obs.'</td>';
			echo '<td width="20%">'.mysql_result(mysql_query("select * from rh_cursos WHERE id = '$curso' "),0,"descricao").'</td>';
			echo '<td width="10%" style="text-align:center"><a href="rh/uploads_rh/'.$anexo.'.pdf" target="_blank" class="btn btn-xs btn-info"> Visualizar <i class="fa fa-file-pdf-o" aria-hidden="true"></i></a></td>';
			if($acesso_login == 'MASTER' || $acesso_login == 'MODERADOR'){
				echo '<td width="5%" style="text-align:center"><a href="javascript:void(0)" class="btn btn-xs btn-danger" onclick=\'ldy("rh/lista-cursos.php?ac=del&id='.$id.'&funcionario='.$funcionario.'",".cursos")\'><span class="glyphicon glyphicon-trash"></span></a></td>';
			}
			echo '</tr>';
		}
	?>
</table>

