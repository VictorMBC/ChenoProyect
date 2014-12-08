var url;
var map;
var last = null;

$(document).ready(function() 
{
	url=$('#ruta').text();
	
	initialize();
});

function initialize() 
{
	var mapOptions = 
	{
		center: new google.maps.LatLng(29.05616970274342, -110.98388671875),
		zoom: 8,
		mapTypeId: google.maps.MapTypeId.ROADMAP,	
	};	
	map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);	
	mostrar();
}

$('#guardar').click(function() 
{
	buscar();
})

function buscar() 
{
	$.ajax(
	{
		type: 'post',
		url: url+'index.php/login/buscar',
		data: $('#forma').serialize(),
		dataType: 'json',
		success: function(data) 
		{		
			//console.log(data);	
				//mostrar();
				var marcadores=data.results;			
				//console.log(marcadores);
				for(var cont=0; cont<marcadores.length; cont++) 
				{
					var lat=marcadores[cont].lat;
					var lon=marcadores[cont].lon;				
					var contentString = '<div id="content">'+
						'<div id="siteNotice">'+
						'</div>'+
						'<h1 id="firstHeading" class="firstHeading">a</h1>'+
						'<div id="bodyContent">'+
							'<p>b</p>'+
						'</div>'+
					'</div>';					
					var infowindow = new google.maps.InfoWindow(
					{
						content: contentString
					});					
					var myLatlng = new google.maps.LatLng(lat, lon);
					if(last !=null){
						last.setMap(null);
					}					
					last = new google.maps.Marker(
					{
						position: myLatlng,
						map: map,
						title: 'NOM',
						infowindow: infowindow
					});
					
					google.maps.event.addListener(last, 'click', function() 
					{
						this.infowindow.open(map, this);
					});
				}
		}
		
	});
}

function mostrar() {
	$.ajax({
		type: 'post',
		url: url+'index.php/login/mostrar',
		data: $('#forma').serialize(),
		dataType: 'json',
		success: function(data) 
		{
			console.log(data.d);
			var marcadores=data.results;			
			
				for(var cont=0; cont<marcadores.length; cont++) 
				{
					var lat=marcadores[cont].lat;
					var lon=marcadores[cont].lon;				
					var contentString = '<div id="content">'+
						'<div id="siteNotice">'+
						'</div>'+
						'<h1 id="firstHeading" class="firstHeading">'+nom+'</h1>'+
						'<div id="bodyContent">'+
							'<p>'+des+'</p>'+
						'</div>'+
					'</div>';					
					var infowindow = new google.maps.InfoWindow(
					{
						content: contentString
					});					
					var myLatlng = new google.maps.LatLng(lat, lon);					
					var marker = new google.maps.Marker(
					{
						position: myLatlng,
						map: map,
						title: nom,
						infowindow: infowindow
					});
					
					google.maps.event.addListener(marker, 'click', function() 
					{
						this.infowindow.open(map, this);
					});
				}			
		}
	});
}