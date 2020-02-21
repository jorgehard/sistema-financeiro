<?php @session_start();
error_reporting(E_ALL ^ E_NOTICE);
ini_set("display_errors", 1 );

setlocale(LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );
date_default_timezone_set( 'America/Sao_Paulo' );

extract($_POST); 
extract($_GET);

//MYSQL
$link = @mysql_connect("host", "user_bd", "senha", true);
mysql_select_db("bancodados", $link);
mysql_set_charset('utf8',$link);

if(!$link)
{
    echo "ERRO AO CONECTAR COM O BANCO DE DADOS!";
	exit();
}
?>
