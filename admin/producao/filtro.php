<?php include("../config.php") ?>

<script>
	$(document).ready(function() {
        	$("#btnPrint").printPage();
        })
</script>

<?php if(@$ac == 'resultado') {

      $inicial_en = implode('-',array_reverse(explode("/",$inicial))); $final_en = implode('-',array_reverse(explode("/",$final)));

      echo '<a href="impressao-filtro.php?inicial_en='.$inicial_en.'&final_en='.$final_en.'" id="btnPrint" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-print"></span> Imprimir</a>';

      //frentes
      $frentes_e = mysql_query("select * from frentes");
      while($l = mysql_fetch_array($frentes_e)) { $id_frentes = $l['id'];

      echo '<h3>'.$l['descricao'].'</h3>';

      $equipes = mysql_query("select *, equipes.id as idequipe from equipes, producao where equipes.id = producao.equipe and producao.frente = '$id_frentes' group by equipes.nome");
      while($l = mysql_fetch_array($equipes)) { $id_equipe = $l['idequipe'];

      $total_quantidade = 0;
      $total_valor = 0;

      //verifica se há produção nesta data
      $query = mysql_query("select *, SUM(quantidade) as total from producao where servico <> 0 and equipe = '$id_equipe' and frente = '$id_frentes' and data between '$inicial_en' and '$final_en' group by servico");
      if(mysql_num_rows($query) > 0) {

         echo '<table class="table table-bordered table-condensed">
              <tr class="active"><th colspan="6" align="left"><p class="text-warning">'.mysql_result(mysql_query("select * from equipes where id = $id_equipe"),0,"nome").'</p></th></tr>
              <tr style="font-size:11px;" class="active"><th>ITEM</th><th>DESCRICAO</th><th>UNID</th><th>QTDE</th><th>VALOR UNIT.</th><th>TOTAL</th></tr>';
         while($l = mysql_fetch_array($query)) {extract($l);

                  $valor_unitario = mysql_result(mysql_query("select * from sp where id = $servico"),0,"valor");
                  $total_geral = $total*$valor_unitario;
         
                  echo '<tr style="font-size:11px;">';
                  echo '<td>'.mysql_result(mysql_query("select * from sp where id = $servico"),0,"item").'</td>';
                  echo '<td>'.mysql_result(mysql_query("select * from sp where id = $servico"),0,"descricao").'</td>';
                  echo '<td>UN</td>';
                  echo '<td>'.$total.'</td>';
                  echo '<td>R$ '.$valor_unitario.'</td>';
                  echo '<td>R$ '; echo number_format($total_geral,"2"); echo '</td>';
                  echo '</tr>';

                  @$total_quantidade += $total;
                  @$total_valor += $total_geral;
         }
         echo '</table>';
         echo '<p class="bg-warning" align="right">Total quantidade: '.number_format($total_quantidade,"2").' | Total Valor: R$ '.number_format($total_valor,"2").'</p>';
      } }

      echo '<br><br>';
?>

<?php } } else { ?>

<h3>Filtro</h3>

<form action="javascript:void(0)" onSubmit="post('#form1','producao/filtro.php?ac=resultado','.retorno')" id="form1">
<label><select size="1" name="equipe_selec" class="form-control">
                 	      <option value=""></option>
                 <?php
                      $equipes = mysql_query("select * from equipes order by nome asc");
                      while($l = mysql_fetch_array($equipes)) { extract($l);
                               echo '<option value="'.$id.'">'.$nome.'</option>';
                      }
                 ?>
                 </select></label>
                 <label><input type="text" size="10" name="inicial" class="form-control data" placeholder="Inicial" required></label>
                 <label><input type="text" size="10" name="final" class="form-control data" placeholder="Final" required></label>

                 <input type="submit" value="Filtrar" class="btn btn-success">

</form>


<?php } ?>

<div class="retorno"></div>

<script>
	jQuery(function($){ $(".data").mask("99/99/9999");});
</script>



