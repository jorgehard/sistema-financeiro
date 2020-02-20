<?php include("../config.php") ?>

<?php if(@$ac == 'ins') { mysql_query("insert into producao (equipe,data,servico,user,frente,quantidade)
                                                   values ('$equipe','$data','$servico','1','$frente','$quantidade')");  $data_producao = $data; } ?>

<table class="table table-condensed" cellpadding="1" cellspacing="1">
<tr style="font-size: 10px"><th>Data:</th><th>Equipe:</th><th>Quantidade:</th></tr>
<?php

	$query = mysql_query("select * from producao where data = '$data_producao' and quantidade <> '0.00' order by id desc");
        while($l = mysql_fetch_array($query)) { extract($l);
        	echo '<tr style="font-size: 10px">';
        	     echo '<td>'.implode("/",array_reverse(explode("-",$data))).'</td>';
                     echo '<td>'.mysql_result(mysql_query("select * from equipes where id = $equipe"),0,"nome").'</td>';
                     echo '<td>'.$quantidade.'</td>';
                echo '</tr>';
        }

?>
</table>
