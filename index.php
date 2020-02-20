<?php 
	include_once("admin/config.php");
	if(@$acao=='deslogar'){	
		session_destroy();
		$cookie_time = (10 * 365 * 24 * 60 * 60);
		@setcookie ("user", "", time() - $cookie_time);
		@setcookie ("password", "$md5password", time() - $cookie_time);
		echo "<script>location.href='index.php'</script>";
		exit;
	}
	if((isset($_SESSION['login_usuario']) && isset($_SESSION['senha_usuario'])) || (isset($_COOKIE['user']) && isset($_COOKIE['password']))){
		echo "<script>window.location='admin/';</script>";
	}
	if(isset($_POST["submit"])) {
		$user = preg_replace('/[^[:alnum:]_\-@.]/', '',$_POST['user']);
		$password = preg_replace('/[^[:alnum:]_]/', '',$_POST['password']);
		$md5password = md5($password);
		$stat = mysql_query("SELECT * FROM usuarios WHERE login = '$user' AND senha = '$md5password'");
		$count = mysql_num_rows($stat);
		if ($count == "1"){
			$row = mysql_fetch_array($stat);
			if($row['status'] == '0'){
				$_SESSION['id_usuario'] = $row['id'];
				$_SESSION['login_usuario'] = $user;
				$_SESSION['senha_usuario'] = $md5password;
				if(isset($_POST["autologin"])){
					$cookie_time = (10 * 365 * 24 * 60 * 60);
					setcookie ("user", "$user", time() + $cookie_time);
					setcookie ("password", "$md5password", time() + $cookie_time);
				}
				echo "<script>window.location='admin/';</script>";
			}else{
				$msg_login = 'bloqueado';
			}
		}else{
			$msg_login = 'login_errado';
		}
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>LitoralRent - Financeiro</title>
	<meta name="description" content="Painel de acesso restrito para controle administrativo. Polêmica Construtora LTDA">
    <meta name="author" content="jorgehenrique@live.com">
	<link rel="icon" href="imagens/icone-litoralrent.ico" type="image/x-icon"/>
	<link rel="shortcut icon" href="imagens/icone-litoralrent.ico" type="image/x-icon"/>	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/AdminLTE.min.css">
	<link rel="stylesheet" href="js/iCheck/square/green.css">
	<link rel="stylesheet" href="css/login.css?v4.3">
	
	<link href="https://fonts.googleapis.com/css?family=Chela+One|Oswald" rel="stylesheet">
</head>
<!-- PASSAR TODOS OS ESTILOS INLINE PARA O ARQUIVO CSS QUANDO TERMINAR -->
<body class="wrapper">
<div class="background-color"></div>
	<div class="form-signin-2">
		<?php
		if($msg_login == 'login_errado'){
			echo '
				<div class="alert alert-danger" role="alert" style="font-size:12px">
					<strong><i class="fa fa-warning"></i> Login inválido!</strong> <br/>
					Senha ou login incorretos, tente novamente ou contate um administrador!.
				</div>';
		}else if($msg_login == 'bloqueado'){
			echo '
				<div class="alert alert-danger" role="alert" style="font-size:12px">
					<strong><i class="fa fa-warning"></i> Login Bloqueado!</strong> <br/>
					Você não tem acesso ao sistema.!.
				</div>';
			
		}
		?>
		<div class="box-form">
		<div class="formHeader">
				<h2 class="form-signin-heading-2" style="margin:0px; padding:0px">
					<center>
						<img src="imagens/litoralrent-logo.png" alt="Logo Empresa" class="img-responsive" width="40%"/>
					</center>
				</h2>
		</div>
		<div class="form-center1">
			<fieldset>
				<form action="" method="post">
					<div class="container-fluid" style="padding:0px">
						<div class="form-group has-feedback">
							<input type="text" name="user" class="form-control" placeholder="Usuário" autofocus required/>
							<span class="glyphicon glyphicon-user form-control-feedback"></span>
						</div>
						<div class="form-group has-feedback">
							<input type="password" name="password" class="form-control" placeholder="Senha" required/>
							<span class="glyphicon glyphicon-lock form-control-feedback"></span>
						</div>
						<div class="col-xs-12" style="padding:0px">
							<div class="form-group remember-me">
								<label class="container">
									<input type="checkbox" class="lembrar" value="1" name="autologin"/> 
									<span class="checkmark"></span>
									<span class="titulo">
									Lembrar senha</span>
								</label>
							</div>
							  
						</div>
						<div class="col-xs-12 footer">
							<input class="btn btn-block btn-success" type="submit" name="submit" value="Entrar"/>
						</div>
					</div>
				</form>
			</fieldset>
			<div class="text-center" style="margin-top:20px">
				<a href="https://www.facebook.com/LITORALRENTT/" target="_blank" style="color:#FFF; background:#3b5998; margin-right:5px;" class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></a>
				<button style="color:#FFF; background:#00aced; margin-right:5px;" class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
				<button style="color:#FFF; background:#d34836" class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>
			</div>
		</div>
		</div>
	</div>
	<footer class="footer-login">
		<strong>AtlasWare Soluções Tecnologicas | Todos direitos reservados.  Copyright &copy; 2018 </strong>
	</footer>
	<script src="https://code.jquery.com/jquery-2.0.3.min.js"></script>
    <script src="js/index.js"></script>
</body>
</html>
