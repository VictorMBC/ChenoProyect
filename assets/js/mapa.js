var url;
var map;

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
	salvar();
})

function salvar() 
{
	$.ajax(
	{
		type: 'post',
		url: url+'index.php/login/salvar',
		data: $('#forma').serialize(),
		dataType: 'json',
		success: function(data) 
		{			
				mostrar();
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
			var marcadores=data.results;			
			
				for(var cont=0; cont<marcadores.length; cont++) 
				{
					var lat=marcadores[cont].lat;
					var lon=marcadores[cont].lon;
					var nom=marcadores[cont].nom;
					var des=marcadores[cont].des;					
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