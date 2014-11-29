<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Util{
 	
	function button($case, $text=''){
		
		switch ($case) {
			
			case 'cart':
				  return $bottom = '<button type="submit" class="button" value="submit"><img src="'.base_url().
				           'assets/img/cart.png" alt="key"/>'.$text.'</button>';
				break;			
			default:		
				return '';
				break;		
		}		
		
	}

//-----------------------------------------------------------------------

	function icon($icon){
		
		switch ($icon) {
			
			case 'add':
					return $image = '<img src="'.base_url().'assets/img/cart.png" alt="key"/>';
				break;						
			default:		
				return '';
				break;		
		}		
		
	}
	
//------------------------------------------------------------------------------

}
