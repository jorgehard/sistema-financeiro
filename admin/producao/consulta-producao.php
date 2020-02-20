<?php include("../config.php") ?>

<?php if(@$ac=='resultado') { ?>

            <?php
                if(@$op=='del') { mysql_query("delete from producao where id = $lanc"); }
                if(@$op=='update') { mysql_query("update producao set quantidade = '$quantidade', servico = '$servico', valor = '$valor' where id = $lanc"); }
            ?>

<div class="panel panel-default">
  <div class="panel-heading">Resultado do filtro:</div>
  <div class="panel-body" style="height:190px;overflow:auto;">
        <?php

            $inicial_en = implode("-",array_reverse(explode("/",$inicial))); $final_en = implode("-",array_reverse(explode("/",$final)));
            $sql = mysql_query("select * from producao where equipe = $equipe and (data between '$inicial_en' and '$final_en') order by valor desc, data desc");
            while($l = mysql_fetch_array($sql)) { extract($l);
                echo '<form action="javascript:void(0)" class="form-inline" onSubmit=\'post(this,"producao/consulta-producao.php?ac=resultado&op=update&inicial='.$inicial.'&final='.$final.'&equipe='.$equipe.'&lanc='.$id.'",".resultado")\'>';   ?>

                <select class="form-control input-sm" name="servico">

                <?php

                $valor_servico = @mysql_result(mysql_query("select * from sp where id = $servico"),0,"valor");
                $total = $quantidade*$valor_servico;

                if($servico==0) { echo '<option value="0"></option>'; }
                $frentes = mysql_query("select * from sp order by descricao asc");
                while($l = mysql_fetch_array($frentes)) {

                    if($servico==$l['id']) { echo '<option value="'.$l['id'].'" selected>'.$l['descricao'].'</option>'; }
                    else { echo '<option value="'.$l['id'].'">'.$l['descricao'].'</option>'; }

                }
                ?>
                </select>

                <?php

                echo '<input type="text" value="'.$quantidade.'" name="quantidade" class="form-control input-sm" size="3"> ';
                echo '<input type="text" value="R$ '.number_format($valor_servico,"2",",",".").'" class="form-control input-sm" size="3" disabled> ';
                echo '<input type="text" value="R$ '.number_format($total,"2",",",".").'" class="form-control input-sm" disabled> ';
                echo '<input type="text" value="'.$valor.'" name="valor" class="form-control input-sm" size="6"> ';
                echo '<input type="submit" class="btn btn-success btn-xs" value="Atualizar"> ';
                echo '<a class="btn btn-danger btn-xs" onclick=\'ldy("producao/consulta-producao.php?ac=resultado&op=del&inicial='.$inicial.'&final='.$final.'&equipe='.$equipe.'&lanc='.$id.'",".resultado")\'>Excluir</a>';
                echo '</form>';

                @$sum_quantidade += $quantidade;
                @$sum_valor += $total;
                @$sum_val_sab += $valor;

                }
                ?>
  </div>

  <div class="panel-footer" style="text-align:right">
        <span class="label label-primary">Total quantidade: <?php echo $sum_quantidade; ?></span>&nbsp;
        <span class="label label-primary">Total Produção: R$ <?php echo number_format($sum_valor,"2",",","."); ?></span>&nbsp;
        <span class="label label-primary">Total Sabesp: R$ <?php echo number_format($sum_val_sab,"2",",","."); ?></span>&nbsp;
  </div>
</div>

<table class="table table-condensed table-bordered table-striped">
	<tr><th>Tipo de Serviço</th><th>Quantidade</th><th>Valor Unitário</th><th>Total</th></tr>
	<?php
			$sql = mysql_query("select *,SUM(quantidade) as qtd from producao where equipe = '$equipe' and quantidade <> 0 and (data between '$inicial_en' and '$final_en') group by servico order by servico asc");
			while($l = mysql_fetch_array($sql)) { extract($l);
				
				$valor_unitario = mysql_result(mysql_query("select * from sp where id = $servico"),0,"valor");				
				$total = $qtd*$valor_unitario;
					
				echo '<tr class="small">';
								echo '<td>'.mysql_result(mysql_query("select * from sp where id = $servico"),0,"descricao").'</td>';
								echo '<td>'.number_format($qtd,"2").'</td>';
								echo '<td>'.number_format($valor_unitario,"2",',','.').'</td>';
								echo '<td>'.number_format($total,"2",',','.').'</td>';
				echo '</tr>';	
			}
	?>
</table>


<?php } else { ?>

    <h3>Consulta de lançamentos <small>Produção</small></h3>

    <form class="form-inline" action="javascript:void(0)" onsubmit="post(this,'producao/consulta-producao.php?ac=resultado','.resultado')">

            <select class="form-control input-sm" name="equipe">
            <option value="">Todos</option>

                <?php
                $frentes = mysql_query("select * from equipes order by nome asc");
                while($l = mysql_fetch_array($frentes)) { extract($l);

                    echo '<option value="'.$id.'">'.$nome.'</option>';

                }
                ?>
            </select>

            <input type="text" name="inicial" class="form-control input-sm" onfocus="$(this).mask('99/99/9999')" />
            <input type="text" name="final" class="form-control input-sm" onfocus="$(this).mask('99/99/9999')" />
            <input type="submit" class="btn btn-success btn-sm" value="Filtrar" />
    </form>

    <div class="resultado"></div>

<?php } ?>


