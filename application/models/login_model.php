<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	//Esta modelo es el encargado del login y el mapa
	class Login_Model extends CI_Model
	{
		public function __construct() 
		{
			$this->load->database();
		}

		//Esta funcion valida el usuario y la contraseña
		function valid_user($username, $password)
		{
		  	$this->db->where('username', $username);
		  	$this->db->where('password', $password);

		  	$query = $this->db->get('users');
		   
		   	if($query->num_rows() >0)
		   	{
				return TRUE;
			}
			else
			{
		    	return FALSE;
		    }
		}

		//Esta funcion valida por medio de ajax el usuario
		function valid_user_ajax($username)
		{ 
			$this->db->where('username', $username);
		    $query = $this->db->get('users');
				  
			if($query->num_rows() >0)
			{
		        echo $query->num_rows();
			}
		}

		//esta es la funcion que se usa para guardar la informacion del mapa
		public function salvar() 
		{
			$latitud=$this->input->post('lat');
			$longitud=$this->input->post('lon');
			$data=array(
				'latitud'=>$latitud,
				'longitud'=>$longitud);
			$this->db->insert('productos', $data);
		}	
		public function buscar() 
		{
			$Nis=$_POST['Nis'];
			$data=array(
				'Nis'=>$Nis);
			$query=$this->db->get_where('productos', array('Nis'=>$_POST['Nis']));
			//$query=$this->db->get('productos', $data);
			$data=array();
			$data['extra']=$Nis;
			if($results=$query->result()) 
			{
				$data['results']=array();			
				foreach($results as $res) 
				{
					//print_r($res);
					$data['results'][]=array(
						'lat'=>$res->latitud,
						'lon'=>$res->longitud);
				}
			}
			else 
			{
				$data['results']='';
			}

			return $data;
		}	

	
		//esta es la funcion encargada de mostrar la informacion del mapa en donde le asignemos
		public function mostrar() 
		{
			//$query=$this->db->get_where('productos', array('Nis'=>$_POST['Nis']))->result();
			//$query=$this->db->query("SELECT 'latitud','longitud' FROM productos");
			$query=$this->db->get('productos', $data);
			$data=array();		
			if($results=$query->result()) 
			{
				$data['results']=array();			
				foreach($results as $res) 
				{
					$data['results'][]=array(
						'lat'=>$res->latitud,
						'lon'=>$res->longitud);
				}
			}
			else 
			{
				$data['results']='';
			}		
			return $data;
	}
}
?>