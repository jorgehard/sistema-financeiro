<?php include("header.php") ?>
<div class="conteudo">

<h1>Últimos 3 dias</h1>


<?php

      //frentes / metas
      $frentes = mysql_query("select * from metas");
      while($l = mysql_fetch_array($frentes)) { $id_frente = $l['id'];
      $query = mysql_query("select * from producao, equipes where equipes.id = producao.equipe and equipes.categoria = $id_frente group by equipe");
      if(mysql_num_rows($query) > 0) {

         $_meta_valor = 0;
         $_saldo_total = 0;

         
         echo '<h3>'.$l['descricao'].'</h3>';
         echo '<table border="1" cellpadding="5"><tr style="background:#CCC;color:#333">';
         echo '<th>EQUIPE</th>';
         
              $ultimos_dias = mysql_query("select * from producao group by data order by data desc limit 3");
              while($l = mysql_fetch_array($ultimos_dias)) {
                       echo '<th colspan="2">'.$l['data'].'</th>';
              }

         echo '</tr>';
                      
         while($l = mysql_fetch_array($query)) {extract($l);
         
         echo '<tr>';
              echo '<td width="300px">'.mysql_result(mysql_query("select * from equipes where id = $equipe"),0,"nome").'</td>';
              
              $ultimos_dias = mysql_query("select * from producao group by data order by data desc limit 3");
              while($l = mysql_fetch_array($ultimos_dias)) {

                       $data_serv = $l['data'];
                       $qtd_dia = mysql_result(mysql_query("select sum(quantidade) as q_dia from producao where equipe = $equipe and data = '$data_serv'"),0,"q_dia");

                       $total_v_serv = 0;

                       $prod_dia = mysql_query("select * from producao where equipe = $equipe and data = '$data_serv'");
                       while($l = mysql_fetch_array($prod_dia)) {
                                $preco_serv = mysql_result(mysql_query("select * from sp where id = $servico"),0,"valor");
                                $valor_serv = $l['quantidade']*$preco_serv;
                                @$total_v_serv += $valor_serv;
                       }

                       echo '<td width="50px">'.$qtd_dia.'</td>';
                       echo '<td width="50px">R$ '.number_format($total_v_serv,"2",",",".").'</td>';
              }
              
              
         echo '</tr>';
         
         }
         
         echo '<tr style="background:#666666;color:#fff">
              </tr>';
         echo '</table>';
         

      }
      


?>

<?php




} ?>

</div>
<?php include('footer.php') ?>
