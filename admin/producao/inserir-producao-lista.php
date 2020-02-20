<?php include("../config.php") ?>
<hr>

<?php

    extract($_POST);
	$data_producao = implode("-",array_reverse(explode("/",$data_producao)));
?>

<script>ldy('producao/producao-lista.php?data_producao=<?php echo $data_producao ?>','#valores')</script>

<h5>Adicionar <small>Valor total do período</small></h5>

<form id="form2" onSubmit="post('#form2','producao/producao-lista.php?ac=ins&data=<?php echo $data_producao; ?>&frente=<?php echo $frente; ?>','#valores')" action="javascript:void(0)">
<label><select class="form-control input-sm" name="eqp">
                <?php
                $equipes = mysql_query("select * from equipes order by nome asc");
                while($l = mysql_fetch_array($equipes)) { extract($l);
                	echo '<option value="'.$id.'">'.$nome.'</option>';
                }
                ?>
       </select>
</label>
<label><input type="text" name="val" class="form-control input-sm" placeholder="R$" id="val1"></label>


<input type="submit" class="btn btn-primary btn-sm" value="Adicionar">
</form>

<div class="panel panel-default">
  <div class="panel-heading">Valores adicionados</div>
  <div class="panel-body" id="valores" style="height: 100px; overflow: auto;">

  </div>
</div>



<script>ldy('producao/producao-lista-quantidade.php?data_producao=<?php echo $data_producao; ?>&id_user=<?php echo $id_user; ?>','#quantidades')</script>

<h5>Adicionar <small>Quantidade executada no período</small></h5>

<form onSubmit="post(this,'producao/producao-lista-quantidade.php?ac=ins&data=<?php echo $data_producao; ?>&frente=<?php echo $frente; ?>','#quantidades')" action="javascript:void(0)">
<label><select class="form-control input-sm" name="equipe" style="width:150px;">

                <option>Equipe:</option>
                <?php
                $equipes = mysql_query("select * from equipes order by nome asc");
                while($l = mysql_fetch_array($equipes)) { extract($l);
                	echo '<option value="'.$id.'">'.$nome.'</option>';
                }
                ?>
       </select>
</label>
<label><select class="form-control input-sm" name="servico" style="width:200px;">
                <option>Serviço:</option>
                <?php
                $servicos = mysql_query("select * from sp order by descricao asc");
                while($l = mysql_fetch_array($servicos)) { extract($l);
                	echo '<option value="'.$id.'">'.$descricao.'</option>';
                }
                ?>
       </select>
</label>
<label><input type="text" name="quantidade" class="form-control input-sm" placeholder="Quantidade" id="val2"></label>


<input type="submit" class="btn btn-primary btn-sm" value="Adicionar">
</form>

<div class="panel panel-default">
  <div class="panel-heading">Quantidades adicionados</div>
  <div class="panel-body" id="quantidades" style="height: 100px; overflow: auto;">

  </div>
</div>


<script type="text/javascript">
$(function(){
 $("#val1").maskMoney({symbol:'R$ ',showSymbol:false, thousands:'', decimal:'.', symbolStay: true});
 $("#val2").maskMoney({symbol:'R$ ',showSymbol:false, thousands:'', decimal:'.', symbolStay: true});
 })
</script>
