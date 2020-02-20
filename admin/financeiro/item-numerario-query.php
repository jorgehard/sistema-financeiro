<?php

include("../config.php");

extract($_POST);

$vencimento = implode("-",array_reverse(explode("/",$vencimento)));

$ordem = @mysql_result(mysql_query("select * from notas_numerario_itens where id_numerario = '$numerario' order by ordem desc limit 1"),0,"ordem")+1;

$query = mysql_query("insert into notas_numerario_itens
	 	     		 (ordem,id_numerario,id_nota,numero,valor,vencimento,obs, equipe)
                     values ('$ordem','$numerario','$nota','$numero','$valor','$vencimento','$obs','$idequipe')");


if($query) { echo '<script>ldy("financeiro/itens-adicionados-numerario.php?numerario='.$numerario.'",".adicionadas");</script>'; }

?>

