<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Products_Model extends CI_Model
	{
		//Esta funcion es la que jala la informacion de la base de datos dependiendo del Nis y la ordena de manera descendente por fecha
		function get_products($pagination, $segment)
		{	
			$this->db->order_by('Fecha', 'desc'); 	
		  	$this->db->limit($pagination, $segment);
		  	$Nis = isset($_POST['Nis'])?$_POST['Nis']:'1';
		  	$query = $this->db->get_where('productos', array('Nis'=>$Nis))->result();
		  	//$query = $this->db->get_where('productos', array('Nis'=>$_POST['Nis']))->result();
		     
			return $query;	
			$this->db->last_query();      
		}

		//Esta funcion es la que toma todos los valores dependiendo del Nis y los guarda en un query
		function get($Nis)
		{
		   $query = $this->db->get_where('productos', array('Nis'=>$Nis))->result();
		   return $query;
		}	

		//Esta funcion es la que define los parametros de el formulario de update
		function update_product($Nis=NULL)
		{
			$data = array
			(
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

		//Esta funcion es la que elimina la informacion del producto dependiendo del Nis
		function delete_product($Nis)
		{
			return $this->db->delete('productos', array('Nis' => $Nis));	
		}
	}
