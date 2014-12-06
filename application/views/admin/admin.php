<?=heading('Bienvenido: '.$user, 4);
	$users = '<img src="'.base_url().'assets/img/users.png"/>';
	$products = '<img src="'.base_url().'assets/img/products.png"/>';
	$images = '<img src="'.base_url().'assets/img/images.jpg"/>';
	$logout = '<img src="'.base_url().'assets/img/logout.png"/>';
?>

<style type="text/css">
			body { height: 100%; }
			#map_canvas { height: 417px; width: 99%;}			
		</style>
		<form method="post" id="forma" action="" align="left">
				<!--<br /><label>Latitud</label>
					<input type="text" id="lat" name="lat" />-->
				<br /><label>Nis</label>
					<input type="text" id="Nis" name="Nis" />
				<br /><button type="button" id="guardar">Guardar</button>
			</form>
		<div id="map_canvas"></div>

		<?php echo $scripts;?>
		<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCFYus52BtDaA0Kdwqi8inbq6Nme0nZ2LI&sensor=FALSE"></script>
		<p style="display: none;" id="ruta"><?php echo base_url();?></p>

<script>
window.onload=function(){
	initialize();
}

</script>