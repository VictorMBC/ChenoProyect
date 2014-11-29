<?=heading($title, 2);?>
	<?php foreach($results as $result): ?>	
		<?=form_open('products/add'); ?> 	 
			<div class="products">	
		 		<p>
		 			<?=$result->marca;?>
		 		</p>
		   		<?php
		   			if($result->imagen)
		   				{?>
	  						<div class="image">
					  			<?=img(base_url().'images/'.$result->imagen);?>
					  		</div>
	        	<?php   }
	        			else
	        			{
	        				$img = '<img src="'. base_url().'assets/img/image.png"/>'?>
							<div class="image">
								<?=$img;?>
							</div>
				<?php 	} ?>
	  						<div class="detalles">
	  							<?=
	  								'Valor: '.$this->cart->format_number($result->precio).br(1).
	                           		'Pantalla: '.$result->pantalla.br(1).
	                           		'Ram: '.$result->ram.br(1).
	                           		'Procesador: '.$result->procesador.br(1).
	                           		'Disco Duro: '.$result->disco_duro;
	                           	?>
	                        </div>

		            		<div class="price">
		            			<?='Precio: '.'$'.$result->precio;?>
		            		</div>

				<div class="option">
		     		<?php if($result->valores):?>
		     			<?=form_label($result->opcion);?>
						<?=form_dropdown($result->opcion,$result->valores);?>
					<?php endif; ?>
						<select name="cantidad">
	                 		<option value="" selected>
	                 			Cant.
	                 		</option>
	                  			<?php for($i=1; $i<16; $i++):?>                  
					        <option value="<?=$i?>">
					            <?=$i?>
					        </option>                  
	                  			<?php endfor; ?>
	        			</select>				
					<?=form_hidden('id', $result->id); ?>
					<?=form_hidden('segment', $this->uri->segment(3));?>
					<?=$this->util->button('cart'); // $this->util->button('cart',' Comprar'); ?>
		  		</div>		
			</div><!-- End Products -->
	    <?=form_close(); ?>
	<?php endforeach; ?>
<div id="pagination">
	<?=$this->pagination->create_links();?>
</div>