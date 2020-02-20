<?php
	include("../config.php");
	include("../validar_session.php");
	getData();
	getNivel();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>REGISTRO DE EMPREGADO - POLÊMICA</title>
	<meta name="author" content="tonon" />
	<meta name="title" content="Untitled Spreadsheet" />
	<meta name="company" content="Angelo Adalberto Tonon" />
	<style type="text/css">
	.font-bold {
		font-weight: 900 !important;
	}
	.transp-block { 
		height: 730px;
		width: 100%;
		position: absolute;
		z-index:-1;
	}
	.transp-block img {  
		max-height: 100%;  
		max-width: 100%; 
		width: 300px;
		height: auto;
		position: absolute;  
		opacity:0.3;
		top: 0;  
		bottom: 0;  
		left: 0;  
		right: 0;  
		margin: auto;
	}
	  html { font-family:Calibri, Arial, Helvetica, sans-serif; font-size:11px; }
	  table { border-collapse:collapse; page-break-after:always;}
	  .gridlines td { border:1px dotted black }
	  .gridlines th { border:1px dotted black }
	  .b { text-align:center }
	  .e { text-align:center }
	  .f { text-align:right }
	  .inlineStr { text-align:left }
	  .n { text-align:right }
	  .s { text-align:left }
	  td { padding-left:3px; }
	  td.style0 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style0 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style1 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style1 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style2 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style2 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style3 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style3 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style4 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style4 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style5 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style5 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style6 { vertical-align:middle; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style6 { vertical-align:middle; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style7 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style7 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  
	  td.style8 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  
	  th.style8 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  
	  td.style9 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style9 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style10 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style10 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style11 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style11 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style12 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style12 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style13 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:6pt;   }
	  th.style13 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:6pt;   }
	  td.style14 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style14 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style15 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style15 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style16 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style16 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style17 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style17 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style18 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style18 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style19 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style19 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style20 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style20 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style21 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style21 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style22 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style22 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style23 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style23 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style24 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style24 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style25 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:7px;   }
	  th.style25 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:7px;   }
	  td.style26 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style26 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style27 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style27 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style28 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style28 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style29 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style29 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style30 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:7px;   }
	  th.style30 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:7px;   }
	  td.style31 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style31 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style32 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style32 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style33 { vertical-align:middle; text-align:right; padding-right:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style33 { vertical-align:middle; text-align:right; padding-right:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style34 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:2px solid #000000 !important; border-left:none #000000; border-right:2px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style34 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:2px solid #000000 !important; border-left:none #000000; border-right:2px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style35 { vertical-align:middle; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:7px;   }
	  th.style35 { vertical-align:middle; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:7px;   }
	  td.style36 { vertical-align:middle; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:7px;   }
	  th.style36 { vertical-align:middle; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:7px;   }
	  td.style37 { vertical-align:middle; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:7px;   }
	  th.style37 { vertical-align:middle; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:7px;   }
	  td.style38 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:7px;   }
	  th.style38 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:7px;   }
	  td.style39 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:7px;   }
	  th.style39 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:7px;   }
	  td.style40 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:7px;   }
	  th.style40 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:7px;   }
	  td.style41 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style41 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style42 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:7px;   }
	  th.style42 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:7px;   }
	  td.style43 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:7px;   }
	  th.style43 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:7px;   }
	  td.style44 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:7px;   }
	  th.style44 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:7px;   }
	  td.style45 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style45 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style46 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:7px;   }
	  th.style46 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:7px;   }
	  td.style47 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; text-decoration:underline; color:#0000FF; font-family:'Arial'; font-size:9px;   }
	  th.style47 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; text-decoration:underline; color:#0000FF; font-family:'Arial'; font-size:9px;   }
	  td.style48 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style48 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style49 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style49 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style50 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style50 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style51 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style51 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style52 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style52 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style53 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style53 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style54 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style54 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style55 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style55 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style56 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style56 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style57 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style57 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style58 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style58 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style59 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style59 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style60 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style60 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style61 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style61 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style62 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style62 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style63 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style63 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style64 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style64 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style65 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style65 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style66 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style66 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style67 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style67 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style68 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style68 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style69 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style69 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style70 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style70 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style71 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style71 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style72 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style72 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style73 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style73 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style74 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style74 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style75 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style75 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style76 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style76 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style77 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:7px;  FFF }
	  th.style77 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:7px;  FFF }
	  td.style78 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:7px;  FFF }
	  th.style78 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:7px;  FFF }
	  td.style79 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:7px;  FFF }
	  th.style79 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:7px;  FFF }
	  td.style80 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style80 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style81 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style81 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style82 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style82 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style83 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style83 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style84 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style84 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style85 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:7px;   }
	  th.style85 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:7px;   }
	  td.style86 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:7px;   }
	  th.style86 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:7px;   }
	  td.style87 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:7px;   }
	  th.style87 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:7px;   }
	  td.style88 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style88 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style89 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style89 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style90 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style90 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style91 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style91 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style92 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style92 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style93 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style93 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style94 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style94 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style95 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style95 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style96 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style96 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style97 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:7px;  FFF }
	  th.style97 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:7px;  FFF }
	  td.style98 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:7px;  FFF }
	  th.style98 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:7px;  FFF }
	  td.style99 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style99 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style100 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style100 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style101 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style101 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style102 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style102 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style103 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style103 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style104 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style104 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style105 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style105 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style106 { vertical-align:middle; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style106 { vertical-align:middle; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style107 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style107 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style108 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style108 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style109 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style109 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style110 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style110 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style111 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style111 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style112 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style112 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style113 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style113 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style114 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style114 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style115 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style115 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style116 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style116 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style117 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style117 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style118 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style118 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style119 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style119 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style120 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style120 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style121 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style121 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style122 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style122 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style123 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style123 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style124 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style124 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style125 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style125 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style126 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style126 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style127 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style127 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style128 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style128 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style129 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style129 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style130 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style130 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style131 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style131 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style132 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style132 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style133 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style133 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style134 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style134 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style135 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style135 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style136 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style136 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style137 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; text-decoration:underline; color:#000000; font-family:'Arial'; font-size:14px;   }
	  th.style137 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; text-decoration:underline; color:#000000; font-family:'Arial'; font-size:14px;   }
	  td.style138 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:14px;   }
	  th.style138 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:14px;   }
	  td.style139 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style139 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style140 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style140 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style141 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style141 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style142 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style142 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style143 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style143 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style144 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style144 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style145 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style145 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style146 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style146 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style147 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:7px;   }
	  th.style147 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:7px;   }
	  td.style148 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style148 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style149 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style149 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style150 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style150 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style151 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style151 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style152 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style152 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style153 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style153 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style154 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style154 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style155 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style155 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style156 { vertical-align:middle; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial Black'; font-size:9px;   }
	  th.style156 { vertical-align:middle; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial Black'; font-size:9px;   }
	  td.style157 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial Black'; font-size:9px;   }
	  th.style157 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial Black'; font-size:9px;   }
	  td.style158 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style158 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style159 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style159 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style160 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style160 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style161 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style161 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style162 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style162 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style163 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style163 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style164 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style164 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style165 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style165 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style166 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style166 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style167 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style167 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style168 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style168 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style169 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style169 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style170 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style170 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style171 { vertical-align:top; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style171 { vertical-align:top; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style172 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style172 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style173 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style173 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style174 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style174 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style175 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style175 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style176 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style176 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style177 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style177 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style178 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style178 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style179 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style179 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style180 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style180 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style181 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style181 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style182 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style182 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style183 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style183 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style184 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style184 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style185 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style185 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style186 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:5pt;   }
	  th.style186 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:5pt;   }
	  td.style187 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:5pt;   }
	  th.style187 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:5pt;   }
	  td.style188 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style188 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style189 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style189 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style190 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style190 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style191 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style191 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style192 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  th.style192 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;  FFF }
	  td.style193 { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:2px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style193 { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:2px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style194 { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style194 { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style195 { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:2px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style195 { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:2px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style196 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:2px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style196 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:2px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style197 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style197 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style198 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:2px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style198 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:2px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style199 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style199 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style200 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style200 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style201 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style201 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style202 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style202 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style203 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style203 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style204 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style204 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style205 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style205 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style206 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style206 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style207 { vertical-align:middle; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial Black'; font-size:9px;   }
	  th.style207 { vertical-align:middle; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial Black'; font-size:9px;   }
	  td.style208 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial Black'; font-size:9px;   }
	  th.style208 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial Black'; font-size:9px;   }
	  td.style209 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:7px;   }
	  th.style209 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:7px;   }
	  td.style210 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style210 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style211 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style211 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  td.style212 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  th.style212 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9px;   }
	  table.sheet0 col.col0 { width:3.38888885pt }
	  table.sheet0 col.col1 { width:3.38888885pt }
	  table.sheet0 col.col2 { width:18.29999979pt }
	  table.sheet0 col.col3 { width:37.27777734999999pt }
	  table.sheet0 col.col4 { width:29.14444411pt }
	  table.sheet0 col.col5 { width:6.7777777pt }
	  table.sheet0 col.col6 { width:14.91111094pt }
	  table.sheet0 col.col7 { width:14.23333317pt }
	  table.sheet0 col.col8 { width:10.84444432pt }
	  table.sheet0 col.col9 { width:8.133333239999999pt }
	  table.sheet0 col.col10 { width:8.133333239999999pt }
	  table.sheet0 col.col11 { width:28.46666634pt }
	  table.sheet0 col.col12 { width:18.97777756pt }
	  table.sheet0 col.col13 { width:17.62222202pt }
	  table.sheet0 col.col14 { width:12.87777763pt }
	  table.sheet0 col.col15 { width:9.48888878pt }
	  table.sheet0 col.col16 { width:48.12222166999999pt }
	  table.sheet0 col.col17 { width:16.94444425pt }
	  table.sheet0 col.col18 { width:12.87777763pt }
	  table.sheet0 col.col19 { width:25.75555526pt }
	  table.sheet0 col.col20 { width:10.16666655pt }
	  table.sheet0 col.col21 { width:14.23333317pt }
	  table.sheet0 col.col22 { width:11.52222209pt }
	  table.sheet0 col.col23 { width:8.811111009999999pt }
	  table.sheet0 col.col24 { width:5.42222214px }
	  table.sheet0 col.col25 { width:7.455555469999999pt }
	  table.sheet0 col.col26 { width:53.54444383pt }
	  table.sheet0 col.col27 { width:21.01111087pt }
	  table.sheet0 col.col28 { width:4.066666619999999pt }
	  table.sheet0 col.col29 { width:15.58888871pt }
	  table.sheet0 col.col30 { width:14.23333317pt }
	  table.sheet0 col.col31 { width:16.26666648pt }
	  table.sheet0 col.col32 { width:16.94444425pt }
	  table.sheet0 col.col33 { width:14.23333317pt }
	  table.sheet0 col.col34 { width:10.84444432pt }
	  table.sheet0 col.col35 { width:10.16666655pt }
	  table.sheet0 col.col36 { width:42.02222174pt }
	  table.sheet0 col.col37 { width:18.29999979pt }
	  table.sheet0 col.col38 { width:21.01111087pt }
	  table.sheet0 col.col39 { width:3.38888885pt }
	  table.sheet0 col.col40 { width:16.94444425pt }
	  table.sheet0 col.col41 { width:30.49999965pt }
	  table.sheet0 col.col42 { width:42pt }
	  table.sheet0 col.col43 { width:6.099999929999999pt }
	  table.sheet0 col.col44 { width:42pt }
	  table.sheet0 col.col100 { width:42pt }
	  table.sheet0 tr { height:12.75pt }
	  table.sheet0 tr.row0 { height:6pt }
	  table.sheet0 tr.row1 { height:16.1pt }
	  table.sheet0 tr.row2 { height:6pt }
	  table.sheet0 tr.row3 { height:16.1pt }
	  table.sheet0 tr.row4 { height:3.75pt }
	  table.sheet0 tr.row5 { height:16.1pt }
	  table.sheet0 tr.row6 { height:3.75pt }
	  table.sheet0 tr.row7 { height:16.1pt }
	  table.sheet0 tr.row8 { height:16.1pt }
	  table.sheet0 tr.row9 { height:5.25pt }
	  table.sheet0 tr.row10 { height:10pt }
	  table.sheet0 tr.row11 { height:16.1pt }
	  table.sheet0 tr.row12 { height:6pt }
	  table.sheet0 tr.row13 { height:10.75pt }
	  table.sheet0 tr.row14 { height:16.1pt }
	  table.sheet0 tr.row15 { height:5.25pt }
	  table.sheet0 tr.row16 { height:7.75pt }
	  table.sheet0 tr.row17 { height:14pt }
	  table.sheet0 tr.row18 { height:3.75pt }
	  table.sheet0 tr.row19 { height:7.75pt }
	  table.sheet0 tr.row20 { height:15pt }
	  table.sheet0 tr.row21 { height:6pt }
	  table.sheet0 tr.row22 { height:16.1pt }
	  table.sheet0 tr.row23 { height:16.1pt }
	  table.sheet0 tr.row24 { height:16.1pt }
	  table.sheet0 tr.row25 { height:6pt }
	  table.sheet0 tr.row26 { height:13.1pt }
	  table.sheet0 tr.row27 { height:13.1pt }
	  table.sheet0 tr.row28 { height:13.1pt }
	  table.sheet0 tr.row29 { height:13.1pt }
	  table.sheet0 tr.row30 { height:13.1pt }
	  table.sheet0 tr.row31 { height:13.1pt }
	  table.sheet0 tr.row32 { height:13.1pt }
	  table.sheet0 tr.row33 { height:6pt }
	  table.sheet0 tr.row34 { height:15.1pt }
	  table.sheet0 tr.row35 { height:14.1pt }
	  table.sheet0 tr.row36 { height:6pt }
	  table.sheet0 tr.row37 { height:14.1pt }
	  table.sheet0 tr.row38 { height:14.1pt }
	  table.sheet0 tr.row39 { height:14.1pt }
	  table.sheet0 tr.row40 { height:6pt }
	  table.sheet0 tr.row41 { height:15pt }
	  table.sheet0 tr.row42 { height:15pt }
	  table.sheet0 tr.row43 { height:15pt }
	  table.sheet0 tr.row44 { height:15pt }
	  table.sheet0 tr.row45 { height:12.75pt }
	  table.sheet0 tr.row46 { height:12.75pt }
	  table.sheet0 tr.row47 { height:7.5pt }
	  table.sheet0 tr.row48 { height:12.75pt }
	  table.sheet0 tr.row49 { height:12.75pt }
	  
	  
	  table.sheet0 col.col-0 { width:20.38888885pt !important; }
	  table.sheet0 col.col-2 { width:120.38888885pt !important; }
	  table.sheet0 col.col-3 { width:5.38888885pt !important; }
	  table.sheet0 col.col-4 { width:150.38888885pt !important; }
	  table.sheet0 tr.row101 { height:22.1pt }
	  table.sheet0 tr.row100 { height:16.1pt }
	  
	  body { 
			margin:10px 0px 0px 10px; 
		}
		
	  @media print{@page {size: landscape}}
	</style>
	<script> 
		window.onload = function () {
			window.print();
			//open(location, '_self').close();
		};
	</script>
</head>

  <body>
	<?php
	$sql = mysql_query("select * from rh_funcionarios where id = $id"); 
	while($l=mysql_fetch_array($sql)) { extract($l); }
	
	?>
	<table border="0" cellpadding="0" cellspacing="0" id="sheet0" class="sheet0 gridlines">
		<col class="col0">
		<col class="col1">
		<col class="col2">
		<col class="col3">
		<col class="col4">
		<col class="col5">
		<col class="col6">
		<col class="col7">
		<col class="col8">
		<col class="col9">
		<col class="col10">
		<col class="col11">
		<col class="col12">
		<col class="col13">
		<col class="col14">
		<col class="col15">
		<col class="col16">
		<col class="col17">
		<col class="col18">
		<col class="col19">
		<col class="col20">
		<col class="col21">
		<col class="col22">
		<col class="col23">
		<col class="col24">
		<col class="col25">
		<col class="col26">
		<col class="col27">
		<col class="col28">
		<col class="col29">
		<col class="col30">
		<col class="col31">
		<col class="col32">
		<col class="col33">
		<col class="col34">
		<col class="col35">
		<col class="col36">
		<col class="col37">
		<col class="col38">
		<col class="col39">
		<col class="col40">
		<col class="col41">
		<col class="col42">
		<col class="col43">
		<col class="col44">
		<tbody>
		  <tr class="row0">
			<td class="column0 style2 null"></td>
			<td class="column1 style3 null" colspan="42"></td>
		  </tr>		  
		  <tr class="row0">
			<td class="column0 style5 null"></td>
			<td class="column1 style22 null" colspan="42"></td>
			<td class="column43 style6 null"></td>
		  </tr>
		  <tr class="row1">
			<td class="column0 style5 null"></td>
			<td class="column1 style4 null"></td>
			<td class="column1 style22 null" rowspan="5" style="text-align:center; border:0px solid; padding:5px;"><img class="transparent" src="http://guaruja.polemicalitoral.com.br/imagens/logo.png" alt="" width="40px"/></td>
			<td class="column1 style22 null" rowspan="5"></td>
			<td class="column2 style137 s style138" colspan="39">REGISTRO DE EMPREGADO</td>
			<td class="column0 style5 null"></td>
		  </tr>
		  <tr class="row4">
			<td class="column0 style5 null"></td>
			<td class="column1 style4 null"></td>
			<td class="column1 style4 null" colspan="39"></td>
			<td class="column43 style5 null"></td>
		  </tr>
		  <tr class="row4">
			<td class="column0 style5 null"></td>
			<td class="column1 style4 null"></td>
			<td class="column2 style4 null">EMPREGADOR: </td>
			<td class="column3 style22 null font-bold" colspan="21"> POLÊMICA SERVIÇOS BÁSICOS LTDA</td>
			<td class="column18 style4 s">ENDEREÇO: </td>
			<td class="column3 style22 null font-bold" colspan="16" > RUA EUCLIDES MIRAGAIA, 700 SL83 - CENTRO - SJCAMPOS/SP CEP: 12245-820</td>
			<td class="column43 style5 null"></td>
		  </tr>
		  <tr class="row4">
			<td class="column0 style5 null"></td>
			<td class="column1 style4 null" colspan="10"></td>
			<td class="column1 style4 null"></td>
			<td class="column1 style4 null" colspan="31"></td>
			<td class="column43 style5 null"></td>
		  </tr>
		  <tr class="row5">
			<td class="column0 style5 null"></td>
			<td class="column1 style4 null"></td>
			<td class="column2 style139 s style140" colspan="2">Nº DO RE</td>
			<td class="column4 style101 null style103 font-bold" colspan="6"> <?php echo $numero_ordem; ?></td>
			<td class="column9 style4 null"></td>
			<td class="column11 style8 s">NOME:</td>
			<td class="column12 style121 null style122 font-bold" colspan="22" style="padding-left:10px"> <?php echo $nome ?> </td>
			<td class="column37 style8 s" colspan="4">Nº MATRICULA:</td>
			<td class="column40 style11 null font-bold"> <?php echo $numero_matricula; ?></td>
			<td class="column41 style75 null style91" colspan="2"></td>
			<td class="column43 style5 null"></td>
		  </tr>
		  <tr class="row6">
			<td class="column0 style5 null"></td>
			<td class="column43 style5 null" colspan="43"></td>
		  </tr>
		  <tr class="row7">
			<td class="column0 style5 null"></td>
			<td class="column1 style4 null"></td>
			<td class="column2 style49 s style57 font-bold" colspan="3" rowspan="11" style="background: url('imagens/<?php echo $imagem; ?>') no-repeat center;
-moz-background-size: cover;
background-size: cover;
-webkit-background-size: cover;
-o-background-size: cover;"> </td>
			<td class="column5 style4 null"></td>
			<td class="column6 style104 s style109" colspan="4" rowspan="2">FILIAÇÃO</td>
			<td class="column10 style8 s">PAI: </td>
			<td class="column11 style12 null"></td>
			<td class="column12 style110 null style111 font-bold" colspan="19"><?php echo $nome_pai; ?></td>
			<td class="column31 style13 s">NACIONALIDADE:</td>
			<td class="column32 style14 null font-bold"><?php echo $nacionalidade_pai; ?></td>
			<td class="column33 style14 null"></td>
			<td class="column34 style14 null"></td>
			<td class="column35 style75 null style91" colspan="4"></td>
			<td class="column39 style4 null"></td>
			<td class="column40 style112 s style120 font-bold" colspan="3" rowspan="14">AUTENTICAÇÃO</td>
			<td class="column43 style5 null"></td>
		  </tr>
		  <tr class="row8">
			<td class="column0 style5 null"></td>
			<td class="column1 style4 null"></td>
			<td class="column5 style4 null"></td>
			<td class="column10 style8 s">MÃE: </td>
			<td class="column11 style12 null"></td>
			<td class="column12 style110 null style111 font-bold" colspan="19"><?php echo $nome_mae; ?></td>
			<td class="column31 style13 s"> NACIONALIDADE:</td>
			<td class="column32 style14 null font-bold"><?php echo $nacionalidade_mae; ?></td>
			<td class="column33 style14 null"></td>
			<td class="column34 style14 null"></td>
			<td class="column35 style75 null style91" colspan="4"></td>
			<td class="column39 style4 null"></td>
			<td class="column43 style5 null"></td>
		  </tr>
		  <tr class="row9">
			<td class="column0 style5 null"></td>
			<td class="column1 style4 null" colspan="42"></td>
			<td class="column43 style5 null"></td>
		  </tr>
		  <tr class="row10">
			<td class="column0 style5 null"></td>
			<td class="column1 style4 null"></td>
			<td class="column5 style4 null"></td>
			<td class="column6 style71 s style129" colspan="6">DATA DO NASCIMENTO</td>
			<td class="column12 style126 s style128" colspan="3">IDADE</td>
			<td class="column15 style71 s style129" colspan="3">NACIONALIDADE</td>
			<td class="column18 style71 s style80" colspan="8">ESTADO CIVIL</td>
			<td class="column26 style71 s style73" colspan="4">LOCAL DO NASCIMENTO</td>
			<td class="column30 style71 s style73" colspan="3">ESTADO</td>
			<td class="column33 style71 s style81" colspan="6">CARTEIRA DE IDENTIDADE</td>
			<td class="column39 style4 null"></td>
			<td class="column43 style5 null"></td>
		  </tr>
		  <tr class="row11">
			<td class="column0 style5 null"></td>
			<td class="column1 style4 null"></td>
			<td class="column5 style4 null"></td>
			<td class="column6 style74 null style76 font-bold" colspan="6"> <?php echo implode("/",array_reverse(explode("-",$nascimento))); ?></td>
			<?php
			// Separa em dia, mês e ano
			list($ano, $mes, $dia) = explode('-', $nascimento);
		   
			// Descobre que dia é hoje e retorna a unix timestamp
			$hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
			// Descobre a unix timestamp da data de nascimento do fulano
			$nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
		   
			// Depois apenas fazemos o cálculo já citado :)
			$idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
			?>
			<td class="column12 style74 null style76 font-bold" colspan="3"> <?php echo $idade; ?></td>
			<td class="column15 style74 null style76 font-bold" colspan="3"> <?php echo $nacionalidade; ?></td>
			<td class="column18 style74 null style76 font-bold" colspan="8"> <?php echo @mysql_result(mysql_query("SELECT * FROM rh_estado_civil WHERE id = $estado_civil"),0,"descricao"); ?></td>
			<td class="column26 style123 null style125 font-bold" colspan="4"> <?php echo $local_nascimento; ?></td>
			<td class="column30 style123 null style125 font-bold" colspan="3"> <?php echo $estado; ?></td>
			<td class="column33 style74 null style76 font-bold" colspan="6"> <?php echo $rg; ?></td>
			<td class="column39 style4 null"></td>
			<td class="column43 style5 null"></td>
		  </tr>
		  <tr class="row12">
			<td class="column0 style5 null"></td>
			<td class="column1 style4 null" colspan="42"></td>
			<td class="column43 style5 null"></td>
		  </tr>
		  <tr class="row13">
			<td class="column0 style5 null"></td>
			<td class="column1 style4 null"></td>
			<td class="column5 style4 null"></td>
			<td class="column6 style135 s style128" colspan="6">	CART. PROFISSIONAL	</td>
			<td class="column12 style71 s style73" colspan="3">		SÉRIE				</td>
			<td class="column15 style71 s style73" colspan="3">		CART.RESERVISTA		</td>
			<td class="column18 style71 s style81" colspan="4">		CATEGORIA			</td>
			<td class="column22 style71 s style81" colspan="5">		CPF					</td>
			<td class="column27 style71 s style81" colspan="6">		TÍTULO DE ELEITOR	</td>
			<td class="column33 style71 s style81" colspan="6">		EXAME MÉDICO		</td>
			<td class="column39 style4 null"></td>
			<td class="column43 style5 null"></td>
		  </tr>
		  <tr class="row14">
			<td class="column0 style5 null"></td>
			<td class="column1 style4 null"></td>
			<td class="column5 style4 null"></td>
			<td class="column6 style130 null style130 font-bold" colspan="6"> <?php echo $carteira_profissional; ?></td>
			<td class="column12 style130 null style130 font-bold" colspan="3"> <?php echo $serie; ?></td>
			<td class="column15 style74 null style76 font-bold" colspan="3"> <?php echo $carteira_reservista; ?></td>
			<td class="column18 style74 null style76 font-bold" colspan="4"> <?php echo $carteira_reservista_categoria; ?></td>
			<td class="column22 style74 null style76 font-bold" colspan="5"> <?php echo $cpf; ?></td>
			<td class="column27 style74 null style76 font-bold" colspan="6"> <?php echo $titulo_eleitor; ?></td>
			<td class="column33 style74 null style76 font-bold" colspan="6"> </td>
			<td class="column39 style4 null"></td>
			<td class="column43 style5 null"></td>
		  </tr>
		  <tr class="row15">
			<td class="column0 style5 null"></td>
			<td class="column1 style4 null" colspan="42"></td>
			<td class="column43 style5 null"></td>
		  </tr>
		  <tr class="row16">
			<td class="column0 style5 null"></td>
			<td class="column1 style4 null"></td>
			<td class="column5 style42 null"></td>
			<td class="column6 style35 s" colspan="6">QUANDO ESTRANGEIRO</td>
			<td class="column12 style36 null"></td>
			<td class="column13 style37 null"></td>
			<td class="column14 style80 s style73" colspan="5">CARTEIRA MODELO 19</td>
			<td class="column21 style71 s style143" colspan="10">É CASADO COM BRASILEIRA?</td>
			<td class="column28 style71 s style73" colspan="5">É NATURALIZADO?</td>
			<td class="column34 style71 s style73" colspan="5">TEM FILHOS BRASILEIROS?</td>
			<td class="column39 style4 null"></td>
			<td class="column43 style5 null"></td>
		  </tr>
		  <tr class="row17">
			<td class="column0 style5 null"></td>
			<td class="column1 style4 null"></td>
			<td class="column5 style43 null"></td>
			<td class="column6 style46 s" colspan="7">DATA QUE CHEGOU AO BRASIL</td>
			<td class="column13 style44 null"></td>
			<td class="column14 style58 null style61 font-bold" colspan="5" rowspan="2">  </td>
			<td class="column21 style62 null style61 font-bold" colspan="10" rowspan="2"> <?php echo $casado_brasileira; ?> </td>
			<td class="column28 style58 null style61 font-bold" colspan="5" rowspan="2"> <?php echo $naturalizado; ?> </td>
			<td class="column34 style64 null style69 font-bold" colspan="5" rowspan="2"> <?php echo $tem_filhos_brasileiros; ?> </td>
			<td class="column39 style4 null"></td>
			<td class="column43 style5 null"></td>
		  </tr>
		  <tr class="row18">
			<td class="column0 style5 null"></td>
			<td class="column1 style4 null"></td>
			<td class="column2 style41 null" colspan="3"></td>
			<td class="column5 style43 null"></td>
			<td class="column6 style38 null"></td>
			<td class="column7 style39 null" colspan="6"></td>
			<td class="column13 style40 null"></td>
			<td class="column39 style4 null"></td>
			<td class="column43 style5 null"></td>
		  </tr>
		  <tr class="row19">
			<td class="column0 style5 null"></td>
			<td class="column1 style4 null"></td>
			<td class="column2 style62 null style61" colspan="12" rowspan="2"></td>
			<td class="column14 style71 s style73" colspan="7">GRAU DE INSTRUÇÃO</td>
			<td class="column21 style71 s style73" colspan="13">NOME DO CÔNJUGE</td>
			<td class="column34 style8 s">QUANTOS?</td>
			<td class="column35 style10 null"></td>
			<td class="column36 style10 null"></td>
			<td class="column37 style10 null"></td>
			<td class="column38 style45 null"></td>
			<td class="column39 style4 null"></td>
			<td class="column43 style5 null"></td>
		  </tr>
		  <tr class="row20">
			<td class="column0 style5 null"></td>
			<td class="column1 style4 null"></td>
			<td class="column14 style74 null style76 font-bold" colspan="7"><?php echo @mysql_result(mysql_query("SELECT * FROM rh_grau_escolaridade WHERE id = $grau_instrucao"),0,"nome"); ?></td>
			<td class="column21 style74 null style76 font-bold" colspan="13"><?php echo $nome_conjuge; ?></td>
			<td class="column34 style74 null style76 font-bold" colspan="5"> <?php echo $quantidade_filhos; ?></td>
			<td class="column39 style4 null"></td>
			<td class="column43 style5 null"></td>
		  </tr>
		  <tr class="row21">
			<td class="column0 style5 null"></td>
			<td class="column1 style4 null" colspan="42"></td>
			<td class="column43 style5 null"></td>
		  </tr>
		  <tr class="row22">
			<td class="column0 style5 null"></td>
			<td class="column1 style4 null"></td>
			<td class="column2 style8 s" colspan="3">ENDEREÇO:</td>
			<td class="column3 style17 null"></td>
			<td class="column4 style121 null style134  font-bold"  colspan="22"> <?php echo $endereco; ?></td>
			<td class="column28 style4 null"></td>
			<td class="column24 style71 s style73" colspan="14">CIDADE ONDE IRÁ PRESTAR O SERVIÇO</td>
			<td class="column43 style5 null "></td>
		  </tr>
		  <tr class="row23">
			<td class="column0 style5 null"></td>
			<td class="column1 style4 null"></td>
			<td class="column2 style8 s" colspan="3">MUDANÇA DE ENDEREÇO:</td>
			<td class="column3 style17 null"></td>
			<td class="column4 style121 null style134" colspan="22"> </td>
			<td class="column28 style4 null"></td>
			<td class="column29 style71 s style81  font-bold" colspan="14"><?php echo $cidade_servico; ?></td>
			<td class="column43 style5 null"></td>
		  </tr>
		  <tr class="row36">
			<td class="column0 style5 null"></td>
			<td class="column1 style4 null"></td>
			<td class="column14 style22 null" colspan="25"></td>
			<td class="column14 style22 null"></td>
			<td class="column14 style22 null"></td>
			<td class="column14 style22 null" colspan="14"></td>
			<td class="column43 style5 null"></td>
		  </tr>
		  
		  
		  
		  
		  <tr class="row26">
			<td class="column0 style5 null"></td>
			<td class="column1 style4 null"></td>
			<td class="column19 style88 null style89" rowspan="7" style="position:relative"><p style="transform: rotate(-90deg); width:600px; display:block; position:absolute; right:-275px; top:45px; letter-spacing:2px;">BENEFICIÁRIOS</div></td>
			<td class="column3 style71 s style84" colspan="16">NOME</td>
			<td class="column19 style71 s style73" colspan="7">PARENTESCO</td>
			<td class="column26 style71 s style73" colspan="2">NASCIDO EM</td>
			<td class="column28 style4 null"></td>
			<td class="column24 style71 s style73" colspan="14">PROGRAMA DE INTEGRAÇÃO SOCIAL - PIS</td>
			<td class="column43 style5 null"></td>
		  </tr>
		  
		  
		  
		  
		  
		  <tr class="row27">
			<td class="column0 style5 null"></td>
			<td class="column1 style4 null"></td>
			<!-- filhos -->
			<?php 
				$sqlb = mysql_query("SELECT * FROM rh_benef WHERE funcionario = '$id' ORDER BY id DESC LIMIT 0 , 1");
				$b = mysql_fetch_array($sqlb);
			?>
				<td class="column3 style131 null style111 font-bold" colspan="16" style="padding-left:5px">		<?php echo $b['nome']; ?></td>
				<td class="column19 style88 null style89 font-bold" colspan="7"> 								<?php echo $b['parentesco']; ?></td>
				<td class="column26 style88 null style89 font-bold" colspan="2"> 								<?php echo implode("/",array_reverse(explode("-",$b['nascimento']))); ?></td>
			<!--  -->
			<td class="column28 style4 null"></td>
			<td class="column29 style94 s style95" colspan="4">CADASTRADO EM: </td>
			<td class="column32 style75 null style76 font-bold" colspan="10" style="text-align:left"> <?php echo implode("/",array_reverse(explode("-",$pis_cadastro))); ?></td>
			<td class="column43 style5 null"></td>
		  </tr>
		  <tr class="row28">
			<td class="column0 style5 null"></td>
			<td class="column1 style4 null"></td>
			<!-- filhos -->
			<?php 
				$sqlb = mysql_query("SELECT * FROM rh_benef WHERE funcionario = '$id' ORDER BY id DESC LIMIT 1 , 1");
				$b = mysql_fetch_array($sqlb);
			?>
				<td class="column3 style131 null style111 font-bold" colspan="16" style="padding-left:5px">		<?php echo $b['nome']; ?></td>
				<td class="column19 style88 null style89 font-bold" colspan="7"> 								<?php echo $b['parentesco']; ?></td>
				<td class="column26 style88 null style89 font-bold" colspan="2"> 								<?php echo implode("/",array_reverse(explode("-",$b['nascimento']))); ?></td>
			<!--  -->
			<td class="column28 style4 null"></td>
			<td class="column29 style94 s style95" colspan="4">SOB Nº: </td>
			<td class="column32 style75 null style76 font-bold" colspan="10" style="text-align:left"> <?php echo $pis_numero; ?></td>
			<td class="column43 style5 null"></td>
		  </tr>
		  <tr class="row29">
			<td class="column0 style5 null"></td>
			<td class="column1 style4 null"></td>
			<!-- filhos -->
			<?php 
				$sqlb = mysql_query("SELECT * FROM rh_benef WHERE funcionario = '$id' ORDER BY id DESC LIMIT 2 , 1");
				$b = mysql_fetch_array($sqlb);
			?>
				<td class="column3 style131 null style111 font-bold" colspan="16" style="padding-left:5px">		<?php echo $b['nome']; ?></td>
				<td class="column19 style88 null style89 font-bold" colspan="7"> 								<?php echo $b['parentesco']; ?></td>
				<td class="column26 style88 null style89 font-bold" colspan="2"> 								<?php echo implode("/",array_reverse(explode("-",$b['nascimento']))); ?></td>
			<!--  -->
			<td class="column28 style4 null"></td>
			<td class="column29 style92 s style93" colspan="4">DEP. NO BANCO:</td>
			<td class="column33 style75 null style76 pis2 font-bold" colspan="10" style="text-align:left"><?php echo $pis_banco; ?></td>
			<td class="column43 style5 null"></td>
		  </tr>
		  <tr class="row30">
			<td class="column0 style5 null"></td>
			<td class="column1 style4 null"></td>
			<!-- filhos -->
			<?php 
				$sqlb = mysql_query("SELECT * FROM rh_benef WHERE funcionario = '$id' ORDER BY id DESC LIMIT 3 , 1");
				$b = mysql_fetch_array($sqlb);
			?>
				<td class="column3 style131 null style111 font-bold" colspan="16" style="padding-left:5px">		<?php echo $b['nome']; ?></td>
				<td class="column19 style88 null style89 font-bold" colspan="7"> 								<?php echo $b['parentesco']; ?></td>
				<td class="column26 style88 null style89 font-bold" colspan="2"> 								<?php echo implode("/",array_reverse(explode("-",$b['nascimento']))); ?></td>
			<!--  -->
			<td class="column28 style4 null"></td>
			<td class="column29 style92 s style93" colspan="4">ENDEREÇO:</td>
			<td class="column33 style75 null style76 pis2 font-bold" colspan="10" style="text-align:left"><?php echo strtoupper($pis_endereco); ?></td>
			<td class="column43 style5 null"></td>
		  </tr>
		  <tr class="row31">
			<td class="column0 style147 s style149" rowspan="16"></td>
			<td class="column1 style19 null"></td>
			<!-- filhos -->
			<?php 
				$sqlb = mysql_query("SELECT * FROM rh_benef WHERE funcionario = '$id' ORDER BY id DESC LIMIT 4 , 1");
				$b = mysql_fetch_array($sqlb);
			?>
				<td class="column3 style131 null style111 font-bold" colspan="16" style="padding-left:5px">		<?php echo $b['nome']; ?></td>
				<td class="column19 style88 null style89 font-bold" colspan="7"> 								<?php echo $b['parentesco']; ?></td>
				<td class="column26 style88 null style89 font-bold" colspan="2"> 								<?php echo implode("/",array_reverse(explode("-",$b['nascimento']))); ?></td>
			<!--  -->
			<td class="column28 style4 null"></td>
			<td class="column29 style71 s style81" colspan="14">CÓDIGOS</td>
			<td class="column43 style5 null"></td>
		  </tr>
		  <tr class="row32">
			<td class="column1 style19 null"></td>
			<!-- filhos -->
			<?php 
				$sqlb = mysql_query("SELECT * FROM rh_benef WHERE funcionario = '$id' ORDER BY id DESC LIMIT 5 , 1");
				$b = mysql_fetch_array($sqlb);
			?>
				<td class="column3 style131 null style111 font-bold" colspan="16" style="padding-left:5px">		<?php echo $b['nome']; ?></td>
				<td class="column19 style88 null style89 font-bold" colspan="7"> 								<?php echo $b['parentesco']; ?></td>
				<td class="column26 style88 null style89 font-bold" colspan="2"> 								<?php echo implode("/",array_reverse(explode("-",$b['nascimento']))); ?></td>
			<!--  -->
			<td class="column28 style4 null"></td>
			<td class="column29 style20 s">BANCO:</td>
			<td class="column30 style21 null"></td>
			<td class="column31 style75 null style76 font-bold" colspan="6"> <?php echo $pis_numbanco; ?></td>
			<td class="column37 style20 s">AGÊNCIA:</td>
			<td class="column38 style21 null"></td>
			<td class="column39 style75 null style76 font-bold" colspan="4"> <?php echo $pis_agencia; ?></td>
			<td class="column43 style5 null"></td>
		  </tr>
		  <tr class="row36">
			<td class="column1 style19 null"></td>
			<td class="column14 style22 null" colspan="25"></td>
			<td class="column14 style22 null"></td>
			<td class="column14 style22 null" colspan="15"></td>
			<td class="column43 style5 null"></td>
		  </tr>
		  <tr class="row34">
			<td class="column1 style19 null"></td>
			<td class="column2 style71 s style73" colspan="5">DATA DA ADMISSÃO</td>
			<td class="column2 style71 s style73" colspan="5">DATA DO REGISTRO</td>
			<td class="column7 style71 s style81" colspan="10">CARGO</td>
			<td class="column17 style71 s style81" colspan="7">SALÁRIO INICIAL</td>
			<td class="column24 style71 s style81" colspan="3">COMISSÃO</td>
			<td class="column27 style71 s style81" colspan="6">TAREFA</td>
			<td class="column39 style71 s style81" colspan="5">FORMA DE PAGAMENTO</td>
			<td class="column43 style5 null"></td>
		  </tr>
		  <tr class="row35">
			<td class="column1 style19 null"></td>
			<td class="column2 style74 null style76 font-bold" colspan="5"><?php echo implode("/",array_reverse(explode("-",$admissao))); ?></td>
			<td class="column34 style74 null style76 font-bold" colspan="5"><?php echo implode("/",array_reverse(explode("-",$data_registro))); ?></td>
			<td class="column7 style123 null style125 font-bold" colspan="10"> <?php echo @mysql_result(mysql_query("SELECT * FROM rh_funcoes WHERE id = '$funcao'"),0,"descricao"); ?></td>
			<td class="column17 style74 null style76 font-bold" colspan="7"> R$ <?php echo number_format(@mysql_result(mysql_query("SELECT * FROM rh_funcoes WHERE id = '$funcao'"),0,"salario"),2,",","."); ?></td>
			<td class="column24 style74 null style76 font-bold" colspan="3"> </td>
			<td class="column27 style74 null style76 font-bold" colspan="6"> </td>
			<td class="column39 style74 null style76 font-bold" colspan="5"> </td>
			<td class="column43 style5 null"></td>
		  </tr>
		  <tr class="row36">
			<td class="column1 style19 null"></td>
			<td class="column14 style22 null" colspan="20"></td>
			<td class="column14 style22 null"></td>
			<td class="column14 style22 null" colspan="20"></td>
			<td class="column43 style5 null"></td>
		  </tr>
		  <tr class="row37">
			<td class="column1 style19 null"></td>
			<td class="column2 style71 s style73" colspan="21">SITUAÇÃO PERANTE AO FUNDO DE GARANTIA POR TEMPO DE SERVIÇO</td>
			<td class="column23 style4 null"></td>
			<td class="column24 style71 s style73" colspan="19">HORÁRIO DE TRABALHO</td>
			<td class="column43 style5 null"></td>
		  </tr>
		  <tr class="row38">
			<td class="column1 style19 null"></td>
			<td class="column2 style8 s" colspan="2">É OPTANTE:</td>
			<td class="column4 style158 s style158 font-bold" colspan="2" style="text-align:left"> <?php echo $optante_fgts; ?></td>
			<td class="column7 style11 s" colspan="5">DATA DA OPÇÃO: </td>
			<td class="column12 style161 f style162 font-bold" colspan="4" style="text-align:left"> <?php echo implode("/",array_reverse(explode("-",$data_opcao_fgts))); ?></td>
			<td class="column15 style11 s" colspan="4">DATA DA RETRATAÇÃO: </td>
			<td class="column19 style159 null style160 font-bold" colspan="4" style="text-align:left"> <?php echo implode("/",array_reverse(explode("-",$data_retratacao_fgts))); ?></td>
			<td class="column23 style4 null"></td>
			<td class="column24 style71 s style81" colspan="3">ENTRADA</td>
			<td class="column27 style71 s style81" colspan="7">REFEIÇÃO</td>
			<td class="column34 style71 s style81" colspan="5">SAÍDA</td>
			<td class="column39 style71 s style81" colspan="4">DESCANSO SEMANAL</td>
			<td class="column43 style5 null"></td>
		  </tr>
		  <tr class="row39">
			<td class="column1 style19 null"></td>
			<td class="column2 style8 s" colspan="3">BANCO DEPOSITÁRIO</td>
			<td class="column5 style121 null style122 font-bold" colspan="18"><?php echo $banco_depositario; ?></td>
			<td class="column23 style4 null"></td>
			<td class="column24 style74 null style76 font-bold" colspan="3"> <?php echo $trabalho_entrada; ?></td>
			<td class="column27 style74 null style76 font-bold" colspan="7"> <?php echo $trabalho_refeicao; ?></td>
			<td class="column34 style74 null style76 font-bold" colspan="5"> <?php echo $trabalho_saida; ?></td>
			<td class="column39 style74 null style76 font-bold" colspan="4"> <?php echo $trabalho_descanso; ?></td>
			<td class="column43 style5 null"></td>
		  </tr>
		  <tr class="row36">
			<td class="column1 style19 null"></td>
			<td class="column14 style22 null"></td>
			<td class="column14 style22 null"></td>
			<td class="column14 style22 null"></td>
			<td class="column14 style22 null"></td>
			<td class="column14 style22 null"></td>
			<td class="column14 style22 null"></td>
			<td class="column14 style22 null"></td>
			<td class="column14 style22 null"></td>
			<td class="column14 style22 null"></td>
			<td class="column14 style22 null"></td>
			<td class="column14 style22 null"></td>
			<td class="column14 style22 null"></td>
			<td class="column14 style22 null"></td>
			<td class="column14 style22 null"></td>
			<td class="column14 style22 null"></td>
			<td class="column14 style22 null"></td>
			<td class="column14 style22 null"></td>
			<td class="column14 style22 null"></td>
			<td class="column14 style22 null"></td>
			<td class="column14 style22 null"></td>
			<td class="column14 style22 null"></td>
			<td class="column14 style22 null" colspan="20"></td>
			<td class="column43 style5 null"></td>
		  </tr>
		  <tr class="row41">
			<td class="column1 style19 null"></td>
			<td class="column2 style112 s style170" colspan="6" rowspan="6">POLEGAR DIREITO</td>
			<td class="column8 style22 null"></td>
			<td class="column9 style22 null"></td>
			<td class="column10 style22 null"></td>
			<td class="column11 style22 null"></td>
			<td class="column12 style22 null"></td>
			<td class="column13 style22 null"></td>
			<td class="column14 style22 null"></td>
			<td class="column15 style22 null"></td>
			<td class="column16 style22 null"></td>
			<td class="column17 style22 null"></td>
			<td class="column18 style22 null"></td>
			<td class="column19 style22 null"></td>
			<td class="column20 style22 s"></td>
			
			<td class="column35 style4 null"></td>
			<td class="column36 style4 null"></td>
			<td class="column37 style4 null"></td>
			<td class="column24 style71 s style73" colspan="19">HORÁRIO DE TRABALHO</td>
			<td class="column43 style5 null"></td>
		  </tr>
		  <tr class="row38">
			<td class="column23 style19 null" colspan="23"></td>
			<td class="column24 style71 s style81" colspan="3">ENTRADA</td>
			<td class="column27 style71 s style81" colspan="7">REFEIÇÃO</td>
			<td class="column34 style71 s style81" colspan="5">SAÍDA</td>
			<td class="column39 style71 s style81" colspan="4" rowspan="2"> -</td>
			<td class="column43 style5 null"></td>
		  </tr>
		  <tr class="row39">
			<td class="column23 style19 null" colspan="23"></td>
			<td class="column24 style74 null style76 font-bold" colspan="3"> <?php echo $trabalho_entrada2; ?></td>
			<td class="column27 style74 null style76 font-bold" colspan="7"> <?php echo $trabalho_refeicao2; ?></td>
			<td class="column34 style74 null style76 font-bold" colspan="5"> <?php echo $trabalho_saida2; ?></td>
			
			<td class="column43 style5 null"></td>
		  </tr>
		  <tr class="row43">
			<td class="column1 style19 null"></td>
			<td class="column8 style22 null" colspan="14"></td>
			<td class="column22 style4 null"></td>
			<td class="column23 style4 null"></td>
			<td class="column24 style4 null"></td>
			<td class="column25 style4 null"></td>
			<td class="column26 style22 null" colspan="17" style="font-size:7px">ESTOU DE PLENO ACORDO COM AS DECLARAÇÕES ACIMA QUE EXPRIMEM A VERDADE</td>
			<td class="column43 style5 null"></td>
		  </tr>
		  <tr class="row44">
			<td class="column1 style19 null"></td>
			<td class="column8 style22 null"></td>
			<td class="column9 style22 null"></td>
			<td class="column10 style22 null"></td>
			<td class="column11 style22 null"></td>
			<td class="column12 style22 null"></td>
			<td class="column13 style22 null"></td>
			<td class="column14 style22 null"></td>
			<td class="column15 style22 null"></td>
			<td class="column16 style22 null"></td>
			<td class="column17 style22 null"></td>
			<td class="column18 style22 null"></td>
			<td class="column19 style22 null"></td>
			<td class="column20 style22 null"></td>
			<td class="column21 style22 null"></td>
			<td class="column22 style4 null"></td>
			<td class="column23 style4 null"></td>
			<td class="column24 style4 null"></td>
			<td class="column25 style4 null"></td>
			<td class="column26 style4 null"></td>
			<td class="column27 style4 null"></td>
			<td class="column28 style4 null"></td>
			<td class="column29 style4 null"></td>
			<td class="column30 style4 null"></td>
			<td class="column31 style4 null"></td>
			<td class="column32 style4 null"></td>
			<td class="column33 style4 null"></td>
			<td class="column34 style4 null"></td>
			<td class="column35 style4 null"></td>
			<td class="column36 style4 null"></td>
			<td class="column37 style4 null"></td>
			<td class="column38 style4 null"></td>
			<td class="column39 style4 null"></td>
			<td class="column40 style4 null"></td>
			<td class="column41 style4 null"></td>
			<td class="column42 style4 null"></td>
			<td class="column43 style5 null"></td>
		  </tr>
		  <tr class="row45">
			<td class="column1 style19 null"></td>
			<td class="column8 style4 null"></td>
			<td class="column9 style23 null"></td>
			<td class="column10 style23 null"></td>
			<td class="column11 style23 null"></td>
			<td class="column12 style23 null"></td>
			<td class="column13 style23 null"></td>
			<td class="column14 style23 null"></td>
			<td class="column15 style23 null"></td>
			<td class="column16 style23 null"></td>
			<td class="column17 style23 null"></td>
			<td class="column18 style23 null"></td>
			<td class="column19 style23 null"></td>
			<td class="column20 style23 null"></td>
			<td class="column21 style4 null"></td>
			<td class="column22 style4 null"></td>
			<td class="column23 style4 null"></td>
			<td class="column24 style4 null"></td>
			<td class="column25 style4 null"></td>
			<td class="column26 style4 null"></td>
			<td class="column27 style23 null"></td>
			<td class="column28 style23 null"></td>
			<td class="column29 style23 null"></td>
			<td class="column30 style23 null"></td>
			<td class="column31 style23 null"></td>
			<td class="column32 style23 null"></td>
			<td class="column33 style23 null"></td>
			<td class="column34 style23 null"></td>
			<td class="column35 style23 null"></td>
			<td class="column36 style23 null"></td>
			<td class="column37 style23 null"></td>
			<td class="column38 style23 null"></td>
			<td class="column39 style23 null"></td>
			<td class="column40 style23 null"></td>
			<td class="column41 style23 null"></td>
			<td class="column42 style4 null"></td>
			<td class="column43 style5 null"></td>
		  </tr>
		  <tr class="row46">
			<td class="column0 style5 null"></td>
			<td class="column1 style4 null" colspan="9"></td>
			<td class="column9 style171 s style171" colspan="11">CARIMBO E ASSINATURA DO EMPREGADOR</td>
			<td class="column21 style4 null" colspan="10"></td>
			<td class="column27 style70 s style70" colspan="11">ASSINATURA DO EMPREGADO</td>
			<td class="column42 style4 null"></td>
			<td class="column43 style5 null"></td>
		  </tr>
		  <tr class="row47">
			<td class="column0 style7 null"></td>
			<td class="column1 style24 null"></td>
			<td class="column2 style3 null" colspan="40"></td>
			<td class="column11 style25 null"></td>
			<td class="column43 style26 null"></td>
		  </tr>
		</tbody>
	</table>	
	<!-- verso -->
	<table border="0" cellpadding="0" cellspacing="0" id="sheet0" class="sheet0 gridlines" style="margin-top:25px; margin-right:20px; transform: rotate(180deg)">
		<col class="col-0">
		<col class="col-2">
		<col class="col-2">
		<col class="col-2">
		<col class="col-2">
		<col class="col-3">
		<col class="col-0">
		<col class="col-2">
		<col class="col-3">
		<col class="col-4">
		<col class="col-4">
		<tbody>
		  <tr class="row101">
			<td class="column11 style8 s" colspan="2">NOME:</td>
			<td class="column12 style121 null" colspan="8" style="padding-left:10px; border-right:none;">
				<div style=" border-bottom:1px dashed #000; width:70%;  position:relative; top:5px"></div>
			</td>
			<td class="column12 style121 null style122 font-bold" colspan="1" style="padding-left:10px; border-left:none"><div style=" border-bottom:1px dashed #000; width:70%;  position:relative; top:10px; left:20px;"></div>Nº:</td>
		  </tr>
		  <tr class="row6">
			<td class="column43 style22 null" colspan="4"></td>
		  </tr>
		  <!-- base -->
		  <tr class="row100">
			<td class="column19 style88 null style89" rowspan="12" style="position:relative"><p style="transform: rotate(-90deg); width:600px; display:block; position:absolute; right:-290px; top:110px;">FERIAS</div></td>
			<td class="column19 style88 null style89" colspan="2" rowspan="2">REFERENTE AO PERÍODO</td>
			<td class="column19 style88 null style89" colspan="2"> GOZADAS</td>
			
			
			<td class="column28 style4 null"></td>
			<td class="column19 style88 null style89" rowspan="12" style="position:relative"><p style="transform: rotate(-90deg); width:600px; display:block; position:absolute; right:-290px; top:110px;">CONTRIBUIÇÃO SINDICAL</div></td>
			<td class="column19 style88 null style89">PERÍODO</td>
			<td class="column19 style88 null style89" colspan="2">SINDICATO</td>
			<td class="column19 style88 null style89">IMPORTÂNCIA</td>
		  </tr>
		  <!-- fim base -->
		  
		  <tr class="row100">
			<td class="column19 style88 null style89">DE</td>
			<td class="column19 style88 null style89">A</td>
			<td class="column28 style4 null"></td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold" colspan="2"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
		  </tr>
		  <tr class="row100">
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column28 style4 null"></td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold" colspan="2"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
		  </tr>
		  <tr class="row100">
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column28 style4 null"></td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold" colspan="2"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
		  </tr>
		  <tr class="row100">
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column28 style4 null"></td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold" colspan="2"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
		  </tr>
		  <tr class="row100">
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column28 style4 null"></td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold" colspan="2"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
		  </tr>
		  <tr class="row100">
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column28 style4 null"></td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold" colspan="2"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
		  </tr>
		  <tr class="row100">
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column28 style4 null"></td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold" colspan="2"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
		  </tr>
		  <tr class="row100">
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column28 style4 null"></td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold" colspan="2"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
		  </tr>
		  <tr class="row100">
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column28 style4 null"></td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold" colspan="2"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
		  </tr>
		  <tr class="row100">
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column28 style4 null"></td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold" colspan="2"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
		  </tr>
		  <tr class="row100">
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column28 style4 null"></td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold" colspan="2"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
		  </tr>
		  <tr class="row6">
			<td class="column43 style22 null" colspan="4"></td>
		  </tr>
		  <tr class="row100">
			<td class="column19 style88 null style89" rowspan="9" style="position:relative"><p style="transform: rotate(-90deg); width:600px; display:block; position:absolute; right:-290px; top:80px;">ACIDENTES DE TRABALHO</div></td>
			<td class="column19 style88 null style89">DATA</td>
			<td class="column19 style88 null style89">LOCAL</td>
			<td class="column19 style88 null style89">CAUSA</td>
			<td class="column19 style88 null style89">DATA DA ALTA</td>
			<td class="column19 style88 null style89" colspan="3" style="border-left:none !important">RESULTADO</td>
			<td class="column28 style4 null"></td>
			<td class="column19 style88 null style89" colspan="2">OBSERVAÇÕES</td>
		  </tr>
		  <tr class="row100">
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold" style="border-right:none !important"> </td>
			<td class="column19 style88 null style89 font-bold" colspan="2" style="border-left:none !important"> </td>
			<td class="column28 style4 null"></td>
			<td class="column19 style88 null style89 font-bold" colspan="2"> </td>
		  </tr>
		  <tr class="row100">
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold" style="border-right:none !important"> </td>
			<td class="column19 style88 null style89 font-bold" colspan="2" style="border-left:none !important"> </td>
			<td class="column28 style4 null"></td>
			<td class="column19 style88 null style89 font-bold" colspan="2"> </td>
		  </tr>
		  <tr class="row100">
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold" style="border-right:none !important"> </td>
			<td class="column19 style88 null style89 font-bold" colspan="2" style="border-left:none !important"> </td>
			<td class="column28 style4 null"></td>
			<td class="column19 style88 null style89 font-bold" colspan="2"> </td>
		  </tr>
		  <tr class="row100">
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold" style="border-right:none !important"> </td>
			<td class="column19 style88 null style89 font-bold" colspan="2" style="border-left:none !important"> </td>
			<td class="column28 style4 null"></td>
			<td class="column19 style88 null style89 font-bold" colspan="2"> </td>
		  </tr>
		  <tr class="row100">
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold" style="border-right:none !important"> </td>
			<td class="column19 style88 null style89 font-bold" colspan="2" style="border-left:none !important"> </td>
			<td class="column28 style4 null"></td>
			<td class="column19 style88 null style89 font-bold" colspan="2"> </td>
		  </tr>
		  <tr class="row100">
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold" style="border-right:none !important"> </td>
			<td class="column19 style88 null style89 font-bold" colspan="2" style="border-left:none !important"> </td>
			<td class="column28 style4 null"></td>
			<td class="column19 style88 null style89 font-bold" colspan="2"> </td>
		  </tr>
		  <tr class="row100">
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold" style="border-right:none !important"> </td>
			<td class="column19 style88 null style89 font-bold" colspan="2" style="border-left:none !important"> </td>
			<td class="column28 style4 null"></td>
			<td class="column19 style88 null style89 font-bold" colspan="2"> </td>
		  </tr>
		  <tr class="row100">
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold" style="border-right:none !important"> </td>
			<td class="column19 style88 null style89 font-bold" colspan="2" style="border-left:none !important"> </td>
			<td class="column28 style4 null"></td>
			<td class="column19 style88 null style89 font-bold" colspan="2"> </td>
		  </tr>
		
		 <tr class="row6">
			<td class="column43 style22 null" colspan="4"></td>
		  </tr>
		  <tr class="row100">
			<td class="column19 style88 null style89" rowspan="11" style="position:relative"><p style="transform: rotate(-90deg); width:600px; display:block; position:absolute; right:-290px; top:100px;">ALTERAÇÕES DE CARGO E SALÁRIOS</div></td>
			<td class="column19 style88 null style89">DATA</td>
			<td class="column19 style88 null style89" colspan="2">CARGO OU FUNÇÃO</td>
			<td class="column19 style88 null style89">SALÁRIO</td>
			<td class="column19 style88 null style89" colspan="3" style="border-left:none !important">HORÁRIO</td>
			<td class="column28 style4 null"></td>
			<td class="column19 style88 null style89" colspan="2">ASSINATURA DO EMPREGADO</td>
		  </tr>
		  <tr class="row100">
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold" colspan="2"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold" style="border-right:none !important"> </td>
			<td class="column19 style88 null style89 font-bold" colspan="2" style="border-left:none !important"> </td>
			<td class="column28 style4 null"></td>
			<td class="column19 style88 null style89 font-bold" colspan="2"> </td>
		  </tr>
		  <tr class="row100">
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold" colspan="2"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold" style="border-right:none !important"> </td>
			<td class="column19 style88 null style89 font-bold" colspan="2" style="border-left:none !important"> </td>
			<td class="column28 style4 null"></td>
			<td class="column19 style88 null style89 font-bold" colspan="2"> </td>
		  </tr>
		  <tr class="row100">
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold" colspan="2"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold" style="border-right:none !important"> </td>
			<td class="column19 style88 null style89 font-bold" colspan="2" style="border-left:none !important"> </td>
			<td class="column28 style4 null"></td>
			<td class="column19 style88 null style89 font-bold" colspan="2"> </td>
		  </tr>
		  <tr class="row100">
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold" colspan="2"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold" style="border-right:none !important"> </td>
			<td class="column19 style88 null style89 font-bold" colspan="2" style="border-left:none !important"> </td>
			<td class="column28 style4 null"></td>
			<td class="column19 style88 null style89 font-bold" colspan="2"> </td>
		  </tr>
		  <tr class="row100">
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold" colspan="2"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold" style="border-right:none !important"> </td>
			<td class="column19 style88 null style89 font-bold" colspan="2" style="border-left:none !important"> </td>
			<td class="column28 style4 null"></td>
			<td class="column19 style88 null style89 font-bold" colspan="2"> </td>
		  </tr>
		  <tr class="row100">
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold" colspan="2"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold" style="border-right:none !important"> </td>
			<td class="column19 style88 null style89 font-bold" colspan="2" style="border-left:none !important"> </td>
			<td class="column28 style4 null"></td>
			<td class="column19 style88 null style89 font-bold" colspan="2"> </td>
		  </tr>
		  <tr class="row100">
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold" colspan="2"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold" style="border-right:none !important"> </td>
			<td class="column19 style88 null style89 font-bold" colspan="2" style="border-left:none !important"> </td>
			<td class="column28 style4 null"></td>
			<td class="column19 style88 null style89 font-bold" colspan="2"> </td>
		  </tr>
		  <tr class="row100">
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold" colspan="2"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold" style="border-right:none !important"> </td>
			<td class="column19 style88 null style89 font-bold" colspan="2" style="border-left:none !important"> </td>
			<td class="column28 style4 null"></td>
			<td class="column19 style88 null style89 font-bold" colspan="2"> </td>
		  </tr>
		  <tr class="row100">
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold" colspan="2"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold" style="border-right:none !important"> </td>
			<td class="column19 style88 null style89 font-bold" colspan="2" style="border-left:none !important"> </td>
			<td class="column28 style4 null"></td>
			<td class="column19 style88 null style89 font-bold" colspan="2"> </td>
		  </tr>
		  <tr class="row100">
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold" colspan="2"> </td>
			<td class="column19 style88 null style89 font-bold"> </td>
			<td class="column19 style88 null style89 font-bold" style="border-right:none !important"> </td>
			<td class="column19 style88 null style89 font-bold" colspan="2" style="border-left:none !important"> </td>
			<td class="column28 style4 null"></td>
			<td class="column19 style88 null style89 font-bold" colspan="2"> </td>
		  </tr>
		</tbody>
	</table>
  </body>
</html>
