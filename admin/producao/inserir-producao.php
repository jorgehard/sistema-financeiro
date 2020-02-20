<?php include("../config.php") ?>
<h3>Inserir produção <small>Comece pela data</small></h3>

<form action="javascript:void(0)" onSubmit="post(this,'producao/inserir-producao-lista.php?frente_login=<?php echo $frente_login; ?>&id_login=<?php echo $id_login; ?>','.retorno')">
<label><input type="text" name="data_producao" class="form-control input-sm" placeholder="Digite a data" onfocus="$(this).mask('99/99/9999')"></label>

<label><select class="form-control input-sm" name="frente">
                <?php
                if($frente_login==2) { $frentes = mysql_query("select * from frentes where id = $frente_login order by descricao asc"); }
                else { $frentes = mysql_query("select * from frentes order by descricao asc"); }
                while($l = mysql_fetch_array($frentes)) { extract($l);

                    echo '<option value="'.$id.'" selected>'.$descricao.'</option>';

                }
                ?>
       </select>
</label>


<input type="submit" class="btn btn-success btn-sm" value="Enviar">
</form>


<div class="retorno"></div>
