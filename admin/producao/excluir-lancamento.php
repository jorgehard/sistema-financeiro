<?php include("../config.php") ?>

<?php mysql_query("delete from producao where id = $id"); echo '<script>window.location.href="./?data='.$data.'";</script>'; ?>


