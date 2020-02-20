<?php
	include("../config.php");
	include("../validar_session.php");
	getData();
	getNivel();

if(@$ac=='del') { 
	mysql_query("delete from financeiro_anexo where id = '$id_anexo'"); 
} 
?>
<script type="text/javascript">
	$(function() {
        $("table").tablesorter({
            textExtraction: function(node){ 
                var cell_value = $(node).text();
                var sort_value = $(node).data('value');
                return (sort_value != undefined) ? sort_value : cell_value;
            }
        })
    });
</script>
<table class="table table-condensed table-bordered table-green">
	<thead>
		<tr>
			<th style="text-align:center"><small>Data Vencimento:</small></th>
			<th style="text-align:center"><small>Valor Vencimento:</small></th>
			<th><small>Obs</small></th>
			<th><small>Tipo</small></th>
			<th style="text-align:center"><small>Anexo</small></th>
			<?php if($acesso_login == 'MASTER' && $kfx != 'ax'){ echo '<th style="text-align:center"><small>Excluir:</small></th>'; } ?>
		</tr>
	</thead>
	<?php
		$sql = @mysql_query("select *, id as id_anexo from financeiro_anexo WHERE id_nota = '$id_nota' order by id desc") or die (mysql_error());
        while($l = @mysql_fetch_array($sql)) { extract($l);
			$data_pagamento = @mysql_result(mysql_query("SELECT data_pagamento FROM notas_nf_venc WHERE id = '$id_venc'"),0,"data_pagamento");
			$valor_pagamento = @mysql_result(mysql_query("SELECT valor_pagamento FROM notas_nf_venc WHERE id = '$id_venc'"),0,"valor_pagamento");
			echo '<tr>';
			if($tipo_anexo == '1' || $tipo_anexo == '2'){
				echo '<td width="10%" data-value="'.$data_pagamento.'" style="text-align:center">'.implode("/",array_reverse(explode("-",$data_pagamento))).'</td>';
				echo '<td width="10%" data-value="'.$valor_pagamento.'" style="text-align:center">R$ '.number_format($valor_pagamento,2,",",".").'</td>';
			}else{
				echo '<td width="10%" style="text-align:center">-</td>';
				echo '<td width="10%" style="text-align:center">-</td>';
			}
			echo '<td width="50%">'.$obs.'</td>';
			if($tipo_anexo == '0'){
				echo '<td width="10%">NOTA FISCAL</td>';
			}else if($tipo_anexo == '1'){
				echo '<td width="10%">BOLETO</td>';
			}else if($tipo_anexo == '2'){
				echo '<td width="10%">COMPROVANTE</td>';
			}else{
				echo '<td width="10%">-</td>';
			}
			echo '<td width="10%" style="text-align:center"><a href="financeiro/uploads_anexo/'.$anexo.'.pdf" target="_blank" class="btn btn-xs btn-info"> Visualizar <i class="fa fa-file-pdf-o" aria-hidden="true"></i></a></td>';
			if($acesso_login == 'MASTER' && $kfx != 'ax'){
				
				echo '<td width="5%" style="text-align:center"><a href="javascript:void(0)" class="btn btn-xs btn-danger" onclick=\'ldy("financeiro/lista-anexos.php?ac=del&id_anexo='.$id_anexo.'&id_nota='.$id_nota.'",".cursos")\'><span class="glyphicon glyphicon-trash"></span></a></td>';
			}
			echo '</tr>';
		}
	?>
</table>

