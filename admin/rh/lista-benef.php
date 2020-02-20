<?php
	include("../config.php");
	include("../validar_session.php");
	getData();
	getNivel();

if(@$ac=='del') { 
	mysql_query("delete from rh_benef where id = $id"); 
}
if(@$ac=='add') { 
	mysql_query("insert into rh_benef (funcionario,nome,parentesco,nascimento) values ('$funcionario','$nome','$parentesco','$nascimento')"); 
} 
?>

<table class="table table-condensed table-bordered table-green">
	<thead>
		<tr>
			<th><small>Nome:</small></th><th style="text-align:center"><small>Parentesco:</small></th><th style="text-align:center"><small>Nascimento:</small></th><th style="text-align:center"><small>Editar:</small></th><th style="text-align:center">
			<?php if($acesso_login == 'MASTER' || $acesso_login == 'MODERADOR'){ echo '<small>Excluir:</small>'; } ?></th>
		</tr>
	</thead>
	<?php
        $sql = @mysql_query("select * from rh_benef where funcionario = '$funcionario' order by nome desc");
        while($l = @mysql_fetch_array($sql)) { 
			extract($l);
			echo '<tr>';
			echo '<td width="70%">'.$nome.'</td>';
			echo '<td width="10%" style="text-align:center">'.$parentesco.'</td>';
			echo '<td width="10%" style="text-align:center">'.implode("/",array_reverse(explode("-",$nascimento))).'</td>';
			echo '<td width="3%" style="text-align:center"><a href="#" onclick=\'$(".modal-body").load("rh/editar-benef.php?id='.$id.'")\' data-toggle="modal" data-target="#myModalLista" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-edit"></span></a></td>';
			if($acesso_login == 'MASTER' || $acesso_login == 'MODERADOR'){
				echo '<td width="3%" style="text-align:center"><a href="javascript:void(0)" class="btn btn-xs btn-danger" onclick=\'ldy("rh/lista-benef.php?ac=del&id='.$id.'&funcionario='.$funcionario.'",".benef")\'><span class="glyphicon glyphicon-trash"></span></a></td>';
			}
			
			echo '</tr>';
		}
	?>
</table>

