<?php @session_start();
	require_once('config.php');
	// VERIFICA LOGIN
	if(isset($_COOKIE['user']) && isset($_COOKIE['password'])){
		$stat = mysql_query("SELECT * FROM usuarios WHERE login = '".$_COOKIE['user']."' AND senha = '".$_COOKIE['password']."' AND status = '0'");
		$count = mysql_num_rows($stat);
		if ($count == "1"){
			$rowa = mysql_fetch_array($stat);
			$nome_login = $rowa['nome'];
			$nivel_acesso = $rowa['nivel_acesso'];
			$acesso_login = $rowa['acesso_login'];
			$_SESSION['id_usuario_logado'] = $rowa['id'];
			$login_usuario = $rowa['login'];
			$obra_usuario = $rowa['obra'];
			$cidade_usuario = $rowa['cidade'];
			$editarss_usuario = $rowa['editarss'];
			$tipo_home = $rowa['tipo_home'];
			$tipo_login = $rowa['tipo_login'];
			$status_connect = true;
			$ultimologin = date('d/M/Y', time());
			mysql_query("UPDATE `usuarios` SET `ultimo_login` = now() WHERE id = '".$rowa['id']."'");
			$id_usuario_logado = $_SESSION['id_usuario_logado']; 
			$ip = $_SERVER['REMOTE_ADDR'];	
		}
	}else if(isset($_SESSION['login_usuario']) && isset($_SESSION['senha_usuario'])){
		$stat = mysql_query("SELECT * FROM usuarios WHERE login = '".$_SESSION['login_usuario']."' AND senha = '".$_SESSION['senha_usuario']."' AND status = '0'");
		$count = mysql_num_rows($stat);
		if ($count == 1){
			$rowa = mysql_fetch_array($stat);
			$nome_login = $rowa['nome'];
			$ultimo_login_view = $rowa['ultimo_login'];
			$nivel_acesso = $rowa['nivel_acesso'];
			$acesso_login = $rowa['acesso_login'];
			$_SESSION['id_usuario_logado'] = $rowa['id'];
			$login_usuario = $rowa['login'];
			$obra_usuario = $rowa['obra'];
			$cidade_usuario = $rowa['cidade'];
			$editarss_usuario = $rowa['editarss'];
			$tipo_home = $rowa['tipo_home'];
			$tipo_login = $rowa['tipo_login'];
			$status_connect = true;
			$ultimologin=date('d/M/Y', time());
			mysql_query("UPDATE `usuarios` SET `ultimo_login` = now() WHERE id = '".$rowa['id']."'");
			$id_usuario_logado = $_SESSION['id_usuario_logado']; 
			$ip = $_SERVER['REMOTE_ADDR'];	
		}else{
			session_destroy();
			$status_connect = false;
			echo "<script>window.location='../index.php';</script>";	
		}
	}else{
		$status_connect = false;
		echo "<script>window.location='../index.php';</script>";			
	}	
	// FUNÇÕES
	// FUNÇÃO DATA PARA INPUT

	function getData(){
		global $today, $todayTotal, $inicioMes, $finalMes, $mes_nome, $meses_numero, $hora_view, $data_view, $ano_view;
		$today = getdate(); 
		if($today['mon'] < 10) { 
			$today['mon'] = '0'.$today['mon'];
		} else { 
			$today['mon'] = $today['mon'];
		} 
		if($today['mday'] < 10){ 
			$today['mday'] = '0'.$today['mday']; 
		}else{ 
			$today['mday'] = $today['mday']; 
		}  
		
		$todayTotal = $today['year'].'-'.$today['mon'].'-'.$today['mday'];
		$inicioMes = $today['year'].'-'.$today['mon'].'-01';
		$finalMes = $today['year'].'-'.$today['mon'].'-'.date("t", mktime(0,0,0,$today['mon'],'01',$today['year']));
		$data_view = date("d/m/Y", mktime(gmdate("d"), gmdate("m"), gmdate("Y")));
		$hora_view = $today['hours'].':'.$today['minutes'].':'.$today['seconds'].'';
		$ano_view = $today['year'];
		
		$meses_numero = array (1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");
		
		switch($today['mon']){
			case '01':
				$mes_nome = 'JANEIRO';
			break;
			case '02':
				$mes_nome = 'FEVEREIRO';
			break;
			case '03':
				$mes_nome = 'MARÇO';
			break;
			case '04':
				$mes_nome = 'ABRIL';
			break;
			case '05':
				$mes_nome = 'MAIO';
			break;
			case '06':
				$mes_nome = 'JUNHO';
			break;
			case '07':
				$mes_nome = 'JULHO';
			break;
			case '08':
				$mes_nome = 'AGOSTO';
			break;
			case '09':
				$mes_nome = 'SETEMBRO';
			break;
			case '10':
				$mes_nome = 'OUTUBRO';
			break;
			case '11':
				$mes_nome = 'NOVEMBRO';
			break;
			case '12':
				$mes_nome = 'DEZEMBRO';
			break;
		}
	}
	function getNivel(){
		global $nivel_acesso, $nivel_acesso_array, $financeiro_array, $rh_array, $equipamento_array, $almoxarifado_array, $compras_array, $tecseg_array, $gerenciadorss_array, $consulta_array, $gestor_array, $preposto_array;
		$nivel_acesso_array = explode(",", $nivel_acesso);
		foreach ($nivel_acesso_array as $key_acesso) {
			switch ($key_acesso) {
				case 1:
					$financeiro_array = $_SESSION['id_usuario_logado'];
					break ;
				case 2:
					$rh_array = $_SESSION['id_usuario_logado'];
					break ;
				case 3:
					$equipamento_array = $_SESSION['id_usuario_logado'];
					break ;
				case 4:
					$almoxarifado_array = $_SESSION['id_usuario_logado'];
					break ;
				case 5:
					$compras_array = $_SESSION['id_usuario_logado'];
					break ;
				case 6:
					$tecseg_array = $_SESSION['id_usuario_logado'];
					break ;
				case 7:
					$gerenciadorss_array = $_SESSION['id_usuario_logado'];
					break ;
				case 8:
					$consulta_array = $_SESSION['id_usuario_logado'];
					break ;
				case 9:
					$gestor_array = $_SESSION['id_usuario_logado'];
					break ;
				case 10:
					$preposto_array = $_SESSION['id_usuario_logado'];
					break ;
			 }
		}
	}
	function MaskPHP($mask,$str){
		$str = str_replace(" ","",$str);
		for($i=0;$i<strlen($str);$i++){
			$mask[strpos($mask,"#")] = $str[$i];
		}
		return $mask;
	}
	?>