<?php include("../config.php") ?>

<script>
	$(document).ready(function() {
        	$("#btnPrint").printPage();
        })
</script>

<?php if(@$ac == 'filtrar') {

      echo '<hr><h3>Resultado filtro</h3>';

      //verifica se há produção nesta data
      $inicial_en = implode('-',array_reverse(explode("/",$inicial))); $final_en = implode('-',array_reverse(explode("/",$final)));
      echo '<p align="right"><a href="impressao-para-equipes.php?inicial_en='.$inicial_en.'&final_en='.$inicial_en.'" id="btnPrint" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-print"></span> Imprimir </a></p>';

      //frentes / metas
      $frentes = mysql_query("select * from metas");
      while($l = mysql_fetch_array($frentes)) { $id_frente = $l['id'];

      $total_sub_grupo = 0;

      $query = mysql_query("select *, SUM(quantidade) as total_quantidade, SUM(valor) as total_valor from producao, equipes where equipes.id = producao.equipe and equipes.categoria = $id_frente and data between '$inicial_en' and '$final_en' group by equipe");
      if(mysql_num_rows($query) > 0) {

         echo '<div class="panel panel-default"><div class="panel-heading"><h3 class="panel-title">'.$l['descricao'].'</h3></div><div class="panel-body">';
         echo '<table class="table table-condensed">
         <tr><th>EQUIPE</th><th>QUANTIDADE</th><th>META</th><th>SALDO</th><th>VALOR PRODUCAO</th></tr>';
                      
         while($l = mysql_fetch_array($query)) {extract($l);

         echo '<tr>';
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
         
         if($saldo_quantidade < 0) { $saldo_qtd = '<font color="#FF0000"><b>'.$saldo_quantidade.'</b></font>'; } else { $saldo_qtd = '<font color="#000">'.$saldo_quantidade.'</font>'; }


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
         echo '</table>';
         echo '</div><div class="panel-footer"><div align="right">TOTAL GRUPO | R$ '.number_format($total_sub_grupo,"2",",",".").'</div></div></div>';
         
         @$total_grupo += @$total_sub_grupo;

         //echo '<h3 align="right">Total quantidade: '.number_format($total_quantidade,"2").' | Total Valor: R$ '.number_format($total_valor,"2").'</h3>';
      }



?>

<?php  } echo '<h2 align="right">TOTAL GERAL | R$ '.number_format(@$total_grupo,"2",",",".").' </h2>';


} else { ?>

<h3>Filtro <small>Relação de produção por equipe</small></h3>

<form action="javascript:void(0)" onSubmit="post('#form1','producao/filtro-para-equipes.php?ac=filtrar','.retorno')" id="form1">
      <label><input type="text" size="10" name="inicial" placeholder="Inicial" class="form-control input-sm data" required></label>
      <label><input type="text" size="10" name="final" placeholder="Final" class="form-control input-sm data" required></label>
      <input type="submit" value="Filtrar" class="btn btn-success btn-sm">
</form>

<div class="retorno"></div>

<?php } ?>

<script>
	jQuery(function($){ $(".data").mask("99/99/9999");});
</script>





