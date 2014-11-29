<?=heading('Bienvenido: '.$user, 4);
	$users = '<img src="'.base_url().'assets/img/users.png"/>';
	$products = '<img src="'.base_url().'assets/img/products.png"/>';
	$images = '<img src="'.base_url().'assets/img/images.jpg"/>';
	$logout = '<img src="'.base_url().'assets/img/logout.png"/>';
?>

<style type="text/css">
			body { height: 100%; }
			#map_canvas { height: 500px; width: 99%;}			
		</style>

		<div id="map_canvas"></div>
			<form method="post" id="forma">
				<br /><label>Latitud</label>
					<input type="text" id="lat" name="lat" />
				<br /><label>Longitud</label>
					<input type="text" id="lon" name="lon" />
				<br /><label>Nombre</label>
					<input type="text" id="nom" name="nom" />
				<br /><label>Descripción</label>
					<input type="text" id="des" name="des">
				<br /><button type="button" id="guardar">Guardar</button>
			</form>
		<?php echo $scripts;?>
		<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCFYus52BtDaA0Kdwqi8inbq6Nme0nZ2LI&sensor=FALSE"></script>
		<p style="display: none;" id="ruta"><?php echo base_url();?></p>
			

<script>
window.onload=function(){
	initialize();
}

</script>