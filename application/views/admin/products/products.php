<?=heading($title, 2);
	$eliminado = $this->session->flashdata('eliminado'); //Tomamos el mensaje que setiamos en el controlador
	if($eliminado)
	echo $eliminado;

?>	
<div class="all_products">	
	<p align="center">
		<?=anchor('manage_products/add/' ,'Insertar Lectura Manual', array('title'=>'Agregar Producto')); ?>
	</p>

	<form method="post" name="form1" id="form1" action="" align="left">
	<label>Busqueda por Nis</label><br />
	<input type="text" id="Nis" name="Nis" value="" /> <br />
	<button type="submit" id="buscar" >Buscar</button><br />

	</form>

	<?php 
		$edit_img = '<img src="'.base_url().'assets/img/edit.png"/>'; 
		$img = '<img src="'. base_url().'assets/img/image.png"/>'; 

		$check = array
		(
			'id'=>'check',
			'name'=>'check',
			'value'=>1,
			'checked'=>FAlSE
		);

		$atributo_link = array('class'=>'link');
		$atributo_img = array('title'=>'Cambiar la Imagen del Producto');

		//En este form se realizan los cambios de la tabla de busqueda por NIS
		echo form_open('manage_products/delete');
		$this->output->enable_profiler(TRUE);
	    foreach($results as $result)
	    {
	    	//Este if valida si existe una imagen
			if($result->Foto_Lectura ==='')
			{
				$product_img = $img;		
			}
			//En caso de que no exista imagen se le asigna un icono por default
			else
			{
				$product_img = img(base_url().'/images/'.$result->Foto_Lectura);
			}
				if (isset($_POST['Nis']))
				{
					$this->table->add_row(

					'<strong>'.$result->Fecha.'</strong>',								
					$result->IdDispositivo,
					$result->Pin,
					$result->NoCel,
					anchor('manage_products/image?product='.$result->Nis[0], $product_img, $atributo_img),
					anchor('manage_products/image?product='.$result->Nis[0], $product_img, $atributo_img),
					anchor('manage_products/image?product='.$result->Nis[0], $product_img, $atributo_img),
					$result->Serie,
					$result->Lec_Ant,
					$result->Lect_Act,
					$result->Consumo,
					$result->Anomalia,
					anchor('manage_products/edit?product='.$result->Nis[0], $edit_img, $atributo_link ),
					$delete  = form_checkbox('products[]',$result->Nis[0], FALSE)
					);
				}else{$_POST['Nis']=0;}
		} // fin foreach
		echo $this->table->generate();  
	?>

	<div class="actions">
		<strong>
	  		Marcar<?=form_checkbox($check)?>
	  	</strong>
	  	<strong class="delete_user" onClick="return confirm('Esta seguro de eliminar los registros?');">
	  		<?=form_submit('action', 'Eliminar')?>
	  	</strong>
	</div>

	<?php echo form_close()?>
	<div id="pagination">
		<?=$this->pagination->create_links();?>
	</div>

	<script type="text/javascript">
		// *** Funciones con jQuery
		$(document).ready(function()
		{
			var products = $('#table :checkbox');  // alert(products.length); 
			var check = $('#check'); 
			// **** Función para seleccionar y deseleccionar los productos   	
			check.click(function()
			{	
				var j = 0;
				var option = $('#check:checked').val();
				if(option==1)
				{
				 	products.each(function()
				 	{
						products[j].checked=1;
						j++;
					});
			    }
			    else
			    {
					products.each(function()
					{
						products[j].checked=0;
						j++;
					});
				} // fin if
			});
		});	
	</script>
</div>	