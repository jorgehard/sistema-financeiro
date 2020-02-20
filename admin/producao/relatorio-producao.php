<style>
	@media print {
		#none { display:none; }
	}
</style>

<?php include("../config.php") ?>

<script>
	$(document).ready(function() {
        	$("#btnPrint").printPage();
        })
</script>

<?php if(@$ac == 'filtrar') {

      echo '<hr><h3>Fechamento de serviços</h3>';
      echo '<p>Período: '.$inicial.' à '.$final.'</p>';

      //verifica se há produção nesta data
      $inicial_en = implode('-',array_reverse(explode("/",$inicial))); $final_en = implode('-',array_reverse(explode("/",$final)));


      //frentes / metas
      $frentes = mysql_query("select * from rh_funcionarios where enc = 1 and id <> 87");
      while($l = mysql_fetch_array($frentes)) { $id_enc = $l['id'];

      $total_sub_grupo = 0;


      $query = mysql_query("select *, equipes.categoria as id_meta, func_equipes.equipe as i_equipe from func_equipes, equipes where func_equipes.equipe like equipes.id and func_equipes.enc = $id_enc and (func_equipes.data between '$inicial_en' and '$final_en') group by equipes.categoria order by equipes.nome asc");
      if(mysql_num_rows($query) > 0) {

         echo '<table class="table table-condensed table-bordered small" style="page-break-after: always;">';
         $valor_enc = @mysql_result(mysql_query("select * from func_equipes where funcionario = $id_enc and (func_equipes.data between '$inicial_en' and '$final_en')"),0,"valor");
         echo '<tr class="danger" style="font-weight:bold;"><th colspan="5">ENCARREGADO - '.@mysql_result(mysql_query("select * from rh_funcionarios where id = $id_enc"),0,"nome").'</th><th colspan="2" style="text-align:right;">R$ '.number_format($valor_enc,"2",",",".").'</th></tr>';

         while($l = mysql_fetch_array($query)) { $i_equipe = $l['id_meta'];


         echo '<tr class="active"><td colspan="7">'.@mysql_result(mysql_query("select * from metas where id = ".$l['id_meta'].""),0,"descricao").'</td></tr>';
         echo '<tr class="small"><th style="text-align:center;">EQUIPE</th><th>FUNCIONÁRIO</th><th style="text-align:center;">QTD</th><th style="text-align:center;">META</th><th style="text-align:center;">SALDO</th><th style="text-align:center;">PRODUÇÃO</th><th style="text-align:center;">A PAGAR</th></tr>';
         
         $eqps = mysql_query("select * from func_equipes, equipes where func_equipes.equipe = equipes.id and equipes.categoria = $i_equipe and func_equipes.enc = $id_enc and (func_equipes.data between '$inicial_en' and '$final_en') order by equipes.nome asc");
         while($l = mysql_fetch_array($eqps)) { extract($l);

         echo '<tr class="small">';
         $total_valor = 0;

         $nome_equipe = @mysql_result(mysql_query("select * from equipes where id = '$equipe'"),0,"nome");
         $nome_equipe = explode("_",$nome_equipe);
         $categoria_equipe = @mysql_result(mysql_query("select * from equipes where id = '$equipe'"),0,"categoria");
         $total_quantidade = @mysql_result(mysql_query("select *, SUM(quantidade) as total_quantidade from producao where equipe = '$equipe' and (data between '$inicial_en' and '$final_en')"),0,"total_quantidade");
         $meta_quantidade = @mysql_result(mysql_query("select * from metas where id = '$categoria_equipe'"),0,"quantidade");
         $saldo_quantidade = $total_quantidade-$meta_quantidade;

         if($saldo_quantidade < 0) { $saldo_qtd = '<font color="#FF0000"><b>'.$saldo_quantidade.'</b></font>'; } else { $saldo_qtd = '<font color="#000">'.$saldo_quantidade.'</font>'; }

              echo '<td style="width:50px;">'.$nome_equipe[0].'</td>';
              echo '<td style="width:500px;">'.mysql_result(mysql_query("select * from rh_funcionarios where id = $funcionario"),0,"nome").'</td>';
              echo '<td style="width:100px;" align="center">'.$total_quantidade.'</td>';
              echo '<td style="width:100px;" align="center">'.$meta_quantidade.'</td>';
              echo '<td style="width:100px;" align="center">'.$saldo_qtd.'</td>';


                $total_v = 0;
                $servs = mysql_query("select *, SUM(quantidade) as total_serv from producao where equipe = '$equipe' and (data between '$inicial_en' and '$final_en') group by servico");
                while($li = mysql_fetch_array($servs)) {

                  $serv = $li['servico'];
                  $valor_u = @mysql_result(mysql_query("select * from sp where id = $serv"),0,"valor");
                  $total_g = $li['total_serv']*$valor_u;
                  $total_v += $total_g;

                }

              echo '<td style="width:100px;" align="center">';

                   //if($saldo_quantidade >= 0) {
                   echo 'R$ '.number_format($total_v,"2",",",".").'';
                   //}  else { $total_valor = 0; }

              echo '</td>';

              echo '<td style="width:100px;" align="center">';

                   //if($saldo_quantidade >= 0) {
                   echo 'R$ '.number_format($valor,"2",",",".").'';
                   //}  else { $total_valor = 0; }

              echo '</td>';
         echo '</tr>';

         $total_sub_grupo += $valor;
         }
         echo '<tr><td colspan="7">&nbsp;</td></tr>';
         }

         $total_sub = $total_sub_grupo+$valor_enc;
         echo '<tr class="info"><td colspan="5" align="right">TOTAL:</td><td colspan="2" align="right">R$ '.number_format($total_sub,"2",",",".").'</td></tr>';
         echo '</table>';


         @$total_grupo += @$total_sub;

         //echo '<h3 align="right">Total quantidade: '.number_format($total_quantidade,"2").' | Total Valor: R$ '.number_format($total_valor,"2").'</h3>';
      }



?>

<?php  } echo '<h2 align="right">TOTAL GERAL | R$ '.number_format(@$total_grupo,"2",",",".").' </h2>';


} else { ?>

<div id="none">
<h3>Filtro <small>Relação de produção por equipe</small></h3>

<form action="javascript:void(0)" onSubmit="post('#form1','producao/relatorio-producao.php?ac=filtrar','.retorno')" id="form1">
      <label><input type="text" size="10" name="inicial" placeholder="Inicial" class="form-control input-sm data" required></label>
      <label><input type="text" size="10" name="final" placeholder="Final" class="form-control input-sm data" required></label>
      <input type="submit" value="Filtrar" class="btn btn-success btn-sm">
</form>
</div>

<div class="retorno"></div>

<?php } ?>

<script>
	jQuery(function($){ $(".data").mask("99/99/9999");});
</script>





