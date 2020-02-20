<?php include("../config.php") ?>
<link rel="stylesheet" href="../../css/bootstrap.css">

<style>
* { font-size: 11px; }
body { background: #FFF; }
table tr td { padding: 1px; }
</style>

<?php $inicial = implode('/',array_reverse(explode("-",$inicial_en))); $final = implode('/',array_reverse(explode("-",$final_en))); ?>

<h1>Relatório de Produção</h1>
<p>Período: <?php echo $inicial; ?> à <?php echo $final; ?></p>

<?php

      //frentes
      $frentes_e = mysql_query("select * from frentes");
      while($l = mysql_fetch_array($frentes_e)) { $id_frentes = $l['id'];

      echo '<h1>'.$l['descricao'].'</h1>';

      //frentes / metas
      $frentes = mysql_query("select * from metas");
      while($l = mysql_fetch_array($frentes)) { $id_frente = $l['id'];

      $total_sub_grupo = 0;

      //verifica se há produção nesta data
      $query = mysql_query("select *, SUM(quantidade) as total_quantidade, SUM(valor) as total_valor from producao, equipes where equipes.id = producao.equipe and equipes.categoria = $id_frente and data between '$inicial_en' and '$final_en' group by equipe");
      if(mysql_num_rows($query) > 0) {

      echo '<h3>'.$l['descricao'].'</h3>';

         echo '<table border="1" cellpadding="5" width="100%">
         <tr style="background:#CCC;color:#333"><th>EQUIPE</th><th>QUANTIDADE</th><th>META</th><th>SALDO</th><th>VALOR PRODUCAO</th></tr>';

         while($l = mysql_fetch_array($query)) {extract($l);

         $total_valor = 0;
         $servs = mysql_query("select *, SUM(quantidade) as total_serv from producao where equipe = '$equipe' and data between '$inicial_en' and '$final_en' group by servico");
         while($li = mysql_fetch_array($servs)) {

                  $serv = $li['servico'];
                  $valor_unitario = @mysql_result(mysql_query("select * from sp where id = $serv"),0,"valor");
                  $total_geral = $li['total_serv']*$valor_unitario;
                  $total_valor += $total_geral;

         }



         $categoria_equipe = mysql_result(mysql_query("select * from equipes where id = '$equipe'"),0,"categoria");
         $meta_quantidade = mysql_result(mysql_query("select * from metas where id = '$categoria_equipe'"),0,"quantidade");
         $saldo_quantidade = $total_quantidade-$meta_quantidade;

         if($saldo_quantidade < 0) { $saldo_qtd = '<font color="#FFF"><b>'.$saldo_quantidade.'</b></font>'; } else { $saldo_qtd = '<font color="#000">'.$saldo_quantidade.'</font>'; }
         if($saldo_quantidade >= 0) { echo '<tr>'; } else { echo '<tr style="background:#D50000; color:#FFF; font-weight: bold;">'; }

              echo '<td>'.mysql_result(mysql_query("select * from equipes where id = $equipe"),0,"nome").'</td>';
              echo '<td>'.$total_quantidade.'</td>';
              echo '<td>'.$meta_quantidade.'</td>';
              echo '<td>'.$saldo_qtd.'</td>';
              echo '<td>';

                   //if($saldo_quantidade >= 0) {
                   echo 'R$ '.number_format($total_valor,"2",",",".").'';
                   //}  else { $total_valor = 0; }

              echo '</td>';
         echo '</tr>';

         $_valor = number_format(mysql_result(mysql_query("select *, SUM(valor) as total_valor from producao, equipes where equipes.id = producao.equipe and equipes.categoria = $id_frente and data between '$inicial_en' and '$final_en'"),0,"total_valor"),"2",",",".");

         /*

                  $valor_unitario = mysql_result(mysql_query("select * from sp where id = $servico"),0,"valor");
                  $total_geral = $total*$valor_unitario;

                  echo '<tr>';
                  echo '<td>'.mysql_result(mysql_query("select * from sp where id = $servico"),0,"item").'</td>';
                  echo '<td>'.mysql_result(mysql_query("select * from sp where id = $servico"),0,"descricao").'</td>';
                  echo '<td>UN</td>';
                  echo '<td>'.$total.'</td>';
                  echo '<td>R$ '.$valor_unitario.'</td>';
                  echo '<td>R$ '; echo number_format($total_geral,"2"); echo '</td>';
                  echo '</tr>';

                  @$total_quantidade += $total;
                  @$total_valor += $total_geral;

         echo '</table>';

         */

         $total_sub_grupo += $total_valor;

         }
         echo '<tr style="background:#CCC;color:#333"><td colspan="5" align="right"><b>TOTAL GRUPO | R$ '.number_format($total_sub_grupo,"2",",",".").'</b></td></tr>';
         echo '</table><div style="page-break-after: auto;"> </div>';

         @$total_grupo += @$total_sub_grupo;

         //echo '<h3 align="right">Total quantidade: '.number_format($total_quantidade,"2").' | Total Valor: R$ '.number_format($total_valor,"2").'</h3>';
      }}



?>

<?php  echo '<h2 align="right">TOTAL GERAL | R$ '.number_format(@$total_grupo,"2",",",".").' </h2>';   }?>
