<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Products_Model extends CI_Model
	{

		function get_products($pagination, $segment)
		{
			$this->db->order_by('Fecha', 'desc'); 	
		  	$this->db->limit($pagination, $segment);
		  	$query = $this->db->get('productos')->result();
		     
		  		//foreach ($query as $result)
		  		//{
					//if ($result->valores)
					//{
					//	$result->valores = explode(',',$result->valores);
					//}
				//}
			return $query;	      
		}

		function get($id)
		{
		   $query = $this->db->get_where('productos', array('Nis' => $id))->result();
		   return $query;
		}	

		function update_product($id=NULL)
		{
			$data = array
			(
		    	'marca' => $this->input->post('marca'),
		        'pantalla' => $this->input->post('pantalla'),
		        'ram' => $this->input->post('ram'),
		        'procesador' => $this->input->post('procesador'),
		        'disco_duro' => $this->input->post('disco_duro'),
		        'precio' => $this->input->post('precio'),
		        'opcion' => $this->input->post('opcion'),
		        'valores' => $this->input->post('atributos')
		    );
					
			if($id!==NULL)
			{
		  		$this->db->where('Nis', $id);
		  		return $this->db->update('productos', $data);
			}
			else
			{
		   		return $this->db->insert('productos', $data);
			}
		}

		function delete_product($id)
		{
			return $this->db->delete('productos', array('Nis' => $id));	
		}
	}
