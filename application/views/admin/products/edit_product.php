<?=heading($title,4);

	$attributes = array
	(
		'id' => 'form_login',
		'class'=>'users'
	);

	$IdDispositivo = array
	(
		'name'=>'ID Dispositivo',
		'id'=>'IdDispositivo',
		'class'=>'input',
		'placeholder'=>'ID Dispositivo',
	    'value'=>set_value('IdDispositivo'),
	    'size'=> '35'
	);	

	$Pin = array
	(
		'name'=>'Pin',
		'id'=>'Pin',
		'class'=>'input',
		'placeholder'=>'Pin',
	    'value'=>set_value('Pin'),
	    'size'=> '35'
	);
						  
	$NoCel = array
	(
		'name'=>'NoCel',
		'id'=>'NoCel',
		'class'=>'input',
		'placeholder'=>'N° Celular',
	    'value'=>set_value('NoCel'), 'size'=> '35'
	);	

	$Serie = array
	(
		'name'=>'Serie',
		'id'=>'Serie',
		'class'=>'input',
		'placeholder'=>'N° Serie',
	    'value'=>set_value('Serie'),
	    'size'=> '35'
	);						  

	$Lec_Ant = array
	(
		'name'=>'Lec_Ant',
		'id'=>'Lec_Ant',
		'class'=>'input',
		'placeholder'=>'Lectura Anterior',
	    'value'=>set_value('Lec_Ant'),
	    'size'=> '35'
	);	
						  
	$Lect_Act = array
	(
		'name'=>'Lect_Act',
		'id'=>'Lect_Act',
		'class'=>'input',
		'placeholder'=>'Lectura Actual',
	    'value'=>set_value('Lect_Act'),
	    'size'=> '35'
	);					  

	$Consumo = array
	(
		'name'=>'Consumo',
		'id'=>'Consumo',
		'class'=>'input',
		'placeholder'=>'Consumo m³',
	    'value'=>set_value('Consumo'),
	    'size'=> '35'
	);	
						  				  				  
						  
	$Anomalia = array
	(
		'name'=>'Anomalia',
		'id'=>'Anomalia',
		'class'=>'input',
		'placeholder'=>'Anomalia/Comentario',
	    'value'=>set_value('Anomalia'),
	    'size'=> '35'
	);

	/*$data = array
	(
		'name'=>'Nis',
		'value'=>set_value('Nis')
	);*/

	if(validation_errors()){
?> 
	
<div id="error">
	<?=validation_errors();?>
</div>

<?php 
	}
	else
	{
		foreach ($results as $result)
		{
	  	
		   $Nis = $result->Nis;			 
	       $IdDispositivo['value'] = $result->IdDispositivo;
	       $Pin['value'] = $result->Pin;
	       $NoCel['value'] = $result->NoCel;
	       $Serie['value'] = $result->Serie;
	       $Lec_Ant['value'] = $result->Lec_Ant;
		   $Lect_Act['value'] = $result->Lect_Act;
		   $Consumo['value'] = $result->Consumo;
		   $Anomalia['value'] = $result->Anomalia;
    	}
	} 
?>

<?=form_open('manage_products/update', $attributes);?>

	<div class="padding">
		<?=form_label('ID Dispositivo');?>
	</div>
	<div class="padding">
		<?=form_input($IdDispositivo)?>
	</div>
	<div class="padding">
		<?=form_label('Pin')?>
	</div>
	<div class="padding">
		<?=form_input($Pin)?>
	</div>
	<div class="padding">
		<?=form_label('N° Celular')?>
	</div>
	<div class="padding">
		<?=form_input($NoCel)?>
	</div>
	<div class="padding">
		<?=form_label('N° Serie')?>
	</div>
	<div class="padding">
		<?=form_input($Serie)?>
	</div>
	<div class="padding">
		<?=form_label('Lectura Anterior')?>
	</div>
	<div class="padding">
		<?=form_input($Lec_Ant)?>
	</div>
	<div class="padding">
		<?=form_label('Lectura Actual')?>
	</div>
	<div class="padding">
		<?=form_input($Lect_Act)?>
	</div>
	<div class="padding">
		<?=form_label('Consumo m³')?>
	</div>
	<div class="padding">
		<?=form_input($Consumo)?>
	</div>
	<div class="padding">
		<?=form_label('Anomalia/Comentario')?>
	</div>
	<div class="padding">
		<?=form_input($Anomalia)?>
	</div>

<!--?=form_hidden('id',$id)?-->

<?=form_submit(array
	(
		'name' => 'submit',
		'class'=>'submit',
		'value' => 'Modificar'
	))
?>

<?=form_close();?>

<div class="clear"></div>