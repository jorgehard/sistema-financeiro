<?php
include("config.php");
include("validar_session.php");
getData();
getNivel();
?>
<style>
	body {
		background: url("../imagens/bg-dash.jpg") repeat center 20%;
		-moz-background-size: cover; -webkit-background-size: cover; -o-background-size: cover; background-size: cover;
	}
	/* Div SS */
	.div-servicos::-webkit-scrollbar {
		width: 10px;
	}
	.div-servicos::-webkit-scrollbar-track {
		-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
		border-radius: 10px;
	}
	 
	.div-servicos::-webkit-scrollbar-thumb {
		border-radius: 10px;
		-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 
	}
	.item-ss{
		padding:10px;
		font-size:12px;
		border-top:1px solid #eee;
	}
	.box-map{
		width:400px;
	}
</style>
<div class="container-fluid top-dash">
	<div class="col-xs-12 col-md-1 icon-pole hidden-xs" style="text-align:center">
		<center><img src="../imagens/logo.png" alt="Logo" height="140px" /></center>
	</div>
	<div class="col-xs-12 col-md-5">

	</div>
	<div class="col-xs-12 col-md-6 hidden-xs hidden-sm msg-alert">
		<div class="alert alert-info" role="alert" style="width:100%">
		
			<div class="pull-right"><a href="http://polemicalitoral.com.br:2095/" target="_blank" class="btn btn-primary"><span class="
glyphicon glyphicon-envelope"></span><br/>Email</a></div>
			<h4>&nbsp;<span class="glyphicon glyphicon-certificate"></span> Bem-vindo <small><strong class="text-info"><? echo $nome_login; ?></strong></small></h4><h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Ao Gerenciamento de dados </h5><h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Aqui você pode conferir algumas informações sobre o mês atual</h5>
		</div>
	</div>
	<div class="container-fluid" style="padding:0px; position:relative; top:40px;">
		<div class="wrapper">
			<div class="main-inner">          
				<div class="main-content-innerpg">
					<div class="col-xs-12" style="font-family: \'Oswald\', sans-serif; letter-spacing:1px; padding:0px;">
						<div class="col-xs-3">
							<div class="panel panel-info">
								<div class="panel-heading">Serviços Não Executados <span class="pull-right badge">
								<?php
	$dataInicio = new DateTime($todayTotal); $dataInicio->sub(new DateInterval('P'.(7).'D'));
	$dataInicio = $dataInicio->format('Y-m-d');
	echo mysql_num_rows(mysql_query("SELECT id FROM ss_principal WHERE ss_principal.obra IN(25) and (ss_principal.emissao between '$dataInicio' and '$todayTotal') and ss_principal.situacao = '9' ORDER BY id DESC"));
	
	?></span><br/>
								<small style="font-size:10px">Ultimos 7 dias</small>
								</div>
								<div class="div-servicos panel-body" style="margin:1px; padding:0px; overflow-y: scroll; height: 500px" id="marker_list"></div>
							</div>
						</div>
						<div class="col-xs-9">
							<div class="panel panel-info" id="map" style="width: 100%; height: 560px;"></div> 
						</div> 
					</div>        
				</div> 
			</div>
		</div>
	</div>
	<script type="text/javascript">
		var delay = 10;
		var infowindow = new google.maps.InfoWindow();
		var latlng = new google.maps.LatLng(-23.962077, -46.397010);
		var mapOptions = {
			zoom: 13,
			center: latlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		}
		var geocoder = new google.maps.Geocoder(); 
		var map = new google.maps.Map(document.getElementById("map"), mapOptions);
		var bounds = new google.maps.LatLngBounds();

		function geocodeAddress(address, next) {
			var address = locations[address];
			geocoder.geocode({'address':address.name}, function (results,status){
				componentRestrictions: {
					country: 'BR'
				}		  
				if (status == google.maps.GeocoderStatus.OK) {
					var p = results[0].geometry.location;
					var lat=p.lat();
					var lng=p.lng();
					createMarker(address,lat,lng);
				} else {
					if (status == google.maps.GeocoderStatus.OVER_QUERY_LIMIT) {
						nextAddress--;
						delay++;
					}
				}
				next();
			});
		}
		function createMarker(add,lat,lng) {
			var contentString = '<div class="box-map"><div class="col-xs-12"><b>SS: </b>'+ add.unidade +'/<span class="text-danger">'+ add.ss +'</span>/'+ add.ano +'</div><div class="col-xs-12"><b>Etapa:</b>'+ add.etapa +'</div><div class="col-xs-12"><b>Data Emissão: </b>'+ add.emissao +'</div><div class="col-xs-12"><b>Data Prometida: </b> '+ add.dataprometida +'</div><div class="col-xs-12"><b>Endereço:</b> '+ add.endereco2 +', '+ add.numero +', '+ add.complemento +' ,'+ add.bairro +'</div><div class="col-xs-12 text-center" style="padding:10px; text-align:center"><a href="#" onclick=\'$("#myModalss").modal("show"); ldy("ss/ver-ss.php?id=' + add.id + '",".modal-body")\' style="width:50%;" class="btn btn-xs btn-success">Visualizar SS</a></div></div>';
			var image = { url: "../imagens/icons/map-marker.png", scaledSize: new google.maps.Size(25, 25)};
			var icons = {
				'0': { icon: image },
				'1': { icon: "../imagens/icons/cavalete1.png" },
			};
			var marker = new google.maps.Marker({
				position: new google.maps.LatLng(lat,lng),
				map: map,
				icon: icons[add.iconEtapa].icon
			});
			google.maps.event.addListener(marker, 'click', function() {
				infowindow.setContent(contentString); 
				infowindow.setOptions('maxWidth',350);
				infowindow.open(map,marker);
			});
   
			var ul = document.getElementById("marker_list");
			var li = document.createElement("div");
			var etapa1 = add.etapa;
			li.innerHTML = '<div class="col-xs-12 item-ss"><div class="col-xs-8" style="padding:0px"><i class="fa fa-info-circle" aria-hidden="true"></i> ' + etapa1 + '</div><div class="col-xs-4" style="padding:0px"><i class="fa fa-clock-o" aria-hidden="true"></i> ' + add.emissao + '</div><div class="col-xs-12" style="padding:5px 0px"><i class="fa fa-calendar" aria-hidden="true"></i> Prometida: <b class="text-success">'+ add.dataprometida +'</b></div><div class="col-xs-12" style="padding:5px 0px"><i class="fa fa-map-marker" aria-hidden="true"></i> ' + add.name + '</div><div class="col-xs-12"> <a onclick=\'$("#myModalss").modal("show"); ldy("ss/ver-ss.php?id=' + add.id + '",".modal-body")\' class="btn btn-xs btn-info pull-right"><i class="fa fa-eye" aria-hidden="true"></i> Visualizar </a></div></div>';
			ul.appendChild(li);
			google.maps.event.addDomListener(li, "click", function(){
				google.maps.event.trigger(marker, "click");
			});
			bounds.extend(marker.position);
		}
		var locations = [ 
			<?php
			$dataInicio = new DateTime($todayTotal); $dataInicio->sub(new DateInterval('P'.(7).'D'));
			$dataInicio = $dataInicio->format('Y-m-d');
			$sql = mysql_query("SELECT id, unidade, ss, ano, emissao, data_prometida, endereco, numero, complemento, bairro, (SELECT icon FROM ss_etapas WHERE id = ss_principal.etapa) as icon_etapa, (SELECT descricao FROM ss_etapas WHERE id = ss_principal.etapa) as etapa FROM ss_principal WHERE ss_principal.obra IN(25) and (ss_principal.emissao between '$dataInicio' and '$todayTotal') and ss_principal.situacao = '9' ORDER BY id ASC");
			while($l = mysql_fetch_array($sql)) { extract($l); echo "{etapa:'".$etapa."',name:'".$endereco.", ".$numero.", São Vicente - SP', endereco2:'".$endereco."', ss:'".$ss."', ano:'".$ano."', bairro:'".$bairro."', numero:'".$numero."', dataprometida:'".implode("/",array_reverse(explode("-",$data_prometida)))."', complemento:'".$complemento."', unidade:'".$unidade."', id:'".$id."', emissao:'".implode("/",array_reverse(explode("-",$emissao)))."', iconEtapa:'".$icon_etapa."'},"; }
			?>
		];
		var nextAddress = 0;
		function theNext() {
			if (nextAddress < locations.length) {
				console.log(locations[nextAddress]);
				setTimeout('geocodeAddress("'+nextAddress+'",theNext)', delay);
				nextAddress++;
			} else {
				map.fitBounds(bounds);
			}
		}
		theNext();
</script>
</div>
	<div class="modal" id="myModalss" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:auto;">
		<div class="modal-dialog" style="width:90%;">
			<div class="modal-content" style="width:100%; padding-bottom:10px;">
				<div class="modal-header" style="width:100%">
					<button type="button" class="close" onclick="$('.modal').modal('hide')" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Configuração</h4>
				</div>
				<div class="modal-body" style="width:100%; max-height:500px; overflow:auto; border-bottom:1px solid #E5E5E5;">
					Aguarde um momento &nbsp;&nbsp; <img src="../../imagens/loading.gif" alt="Carregando" width="20px"/>
				</div>
			</div>
		</div>
	</div>