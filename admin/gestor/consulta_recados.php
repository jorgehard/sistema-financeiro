<?php include("../validar_session.php"); ?>
<?php include("../config.php") ?>


<?php 
    if(@$ac=='del') { mysql_query("delete from user_recados where id = $id"); }
 ?>
		<h4><small>VEJA AS SUAS MENSAGENS!</small></h4><hr>
		<table class="table table-striped table-condensed table-bordered small">
		<thead></thead>
		<tr><th></th>
			<th style="weight: 300px;" >MENSAGEM</th>
			<th>USUARIO</th>
			<th>STATUS</th>
		</tr>
		</thead><tbody>
        
		<?php
        $i = 1;
        if($tipo==0) { $sql = mysql_query("select * from usuarios_rec where funcionario = '$id_login' order by id desc") or die (mysql_error()); }
        while($l = mysql_fetch_array($sql)) { extract($l);
		$u = $i++;

				echo '<tr>';
				echo '<td>'.$u.'</td>';
				echo '<td style="weight: 300px;">'.$mensagem.'</td>';
				echo '<td>'.@mysql_result(mysql_query("select * from usuarios where id = $funcionario"),0,"nome").'</td>';
				echo '<td>';
					if($status == 1) { echo '<center><span class="label label-primary">NORMAL</center></span>'; }
					if($status == 2) { echo '<center><span class="label label-success">IMPORTANTE	</center></span>'; }
					if($status == 3) { echo '<center><span class="label label-danger">URGENTE</center></span>'; }
					echo '</td>';
				echo '<td><a href="javascript:void(0)" onclick=\'ldy("gestor/consulta_recados.php?ac=del&id='.$id.'&id='.$id.'",".notas")\'><span class="glyphicon glyphicon-trash"></span></a></td>';
				
				echo '</tr>';

            }
        ?>
		</tbody></table>