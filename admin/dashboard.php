<?php
include("config.php");
include("validar_session.php");
getData();
getNivel();
?>
<style>
	.btn-sm2 {
		background-color:#FDFDFD !important;
		color:#092A5D;
		width:100%;
		height:80px;
		padding-top:15px;
		font-family: 'Roboto Condensed', sans-serif;
		font-weight:bold;
		letter-spacing:1px;
	}
	.lg {
		font-size:28px;
	}
	body {
		background: url("../imagens/bg-dash.jpg") repeat center 20%;
		-moz-background-size: cover; -webkit-background-size: cover; -o-background-size: cover; background-size: cover;
	}
	.navbar-nav > li > a:hover, .navbar-default .navbar-nav > li > a:focus {
		color: #6b6e6f;
		background:#eaeaea;
		border-top-right-radius:10px;
		border-top-left-radius:10px;
	}
	.active-nav{
		color: #000;
		background:#eaeaea;
		-webkit-box-shadow: 0px -4px 24px -8px rgba(87,87,87,1);
		-moz-box-shadow: 0px -4px 24px -8px rgba(87,87,87,1);
		box-shadow: 0px -4px 24px -8px rgba(87,87,87,1);
		border-top-right-radius:20px;
		border-top-left-radius:20px;
		opacity:0.7;
	}
	.navbar-nav > li > a {
		color:#6b6e6f;
	}

</style>
