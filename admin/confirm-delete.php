<div>
<h4>Tem certeza que deseja excluir este item?</h4>
</div>
<?php if(@$ac == 'excluir'){
	echo '<script>alert("TESTE")</script>';
}
<?php
 echo '<center><a href="#" class="btn btn-default btn-xs btn-danger" style="padding:5px" onclick=\'$(".ajax").load("almoxarifado/confirm-delete.php?ac=excluir&id_retirada='.$id_retirada.'")\'><span class="glyphicon glyphicon-trash"></span></a></center>';
?>