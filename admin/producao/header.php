<?php include("../validar_session.php"); include("../config.php");  ?>
<html>
<head>

<script src="js/jquery.js"></script>
<script src="js/jquery.maskedinput.js"></script>

<link rel="stylesheet" href="../css.css">
</head>
<body>

<div class="menu-left">
<div class="logo"><img src="../logo.png" border="0" width="100px"></div>

<h1>Olá <?php echo $nome_login; ?></h1>

<?php if($acesso_login == 'master') { ?>

<h3>Relatórios</h3>
<ul>
     <li><a href="filtro.php">Resumo por eqp </a></li>
     <li><a href="filtro-resumido-equipes.php">Resumo total</a></li>
     <li><a href="filtro-dias.php">Acomp. Diario</a></li>
     <li><a href="filtro-para-equipes.php">Produção $ eqp</a></li>
</ul>

<?php } ?>

<h3>Informações</h3>

<ul>
<li><a href="./">Inserir produção</a></li>
</ul>

</div>

