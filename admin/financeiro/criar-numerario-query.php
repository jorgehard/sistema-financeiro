<?php

include("../config.php");

$data = implode("-",array_reverse(explode("/",$data)));

$query = mysql_query("insert into notas_numerario (data,numero,obra)values ('$data','$numero','$obra')");

$id = mysql_insert_id();

if($query) { echo '<script>ldy("financeiro/protocolo.php?id='.$id.'",".conteudo");</script>'; }

?>

