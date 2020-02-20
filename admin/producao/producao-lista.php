<?php include("../config.php") ?>

<?php if(@$ac == 'ins') { mysql_query("insert into producao (equipe,data,valor,user,frente)
                                                   values ('$eqp','$data','$val','1','$frente')");  $data_producao = $data; } ?>

<table class="table table-condensed table-striped">
<tr class="small"><th>Data:</th><th>Equipe:</th><th>Valor:</th></tr>
<?php

	$query = mysql_query("select * from producao where data = '$data_producao' and quantidade = '0.00' order by id desc");
        while($l = mysql_fetch_array($query)) { extract($l);
        	echo '<tr class="small">';
        	     echo '<td>'.implode("/",array_reverse(explode("-",$data))).'</td>';
                     echo '<td>'.mysql_result(mysql_query("select * from equipes where id = $equipe"),0,"nome").'</td>';
                     echo '<td>'.$valor.'</td>';
                echo '</tr>';
        }

?>
</table>
