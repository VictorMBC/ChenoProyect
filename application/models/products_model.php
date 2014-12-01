<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Products_Model extends CI_Model
	{

		function get_products($pagination, $segment)
		{
			$this->db->order_by('Fecha', 'desc'); 	
		  	$this->db->limit($pagination, $segment);
		  	$query = $this->db->get('productos')->result();
		     
		  		foreach ($query as $result)
		  		{
					if ($result->Nis)
					{
						$result->Nis = explode(',',$result->Nis);
					}
				}
			return $query;	      
		}

		function get($Nis)
		{
		   $query = $this->db->get_where('productos', array('Nis' => $Nis))->result();
		   return $query;
		}	

		function update_product($Nis=NULL)
		{
			$data = array
			(
		    	'Fecha' => $this->input->post('Fecha'),
		        'IdDispositivo' => $this->input->post('Id Dispositivo'),
		        'Pin' => $this->input->post('Pin'),
		        'NoCel' => $this->input->post('N° Celular'),
		        'Serie' => $this->input->post('N° Serie'),
		        'Lec_Ant' => $this->input->post('Lectura Anterior'),
		        'Lect_Act' => $this->input->post('Lectura Actual'),
		        'Consumo' => $this->input->post('Consumo m³'),
		        'Anomalia' => $this->input->post('Anomalia/Comentario')
		    );
					
			if($Nis!==NULL)
			{
		  		$this->db->where('Nis', $Nis);
		  		return $this->db->update('productos', $data);
			}
			else
			{
		   		return $this->db->insert('productos', $data);
			}
		}

		function delete_product($Nis)
		{
			return $this->db->delete('productos', array('Nis' => $Nis));	
		}
	}
