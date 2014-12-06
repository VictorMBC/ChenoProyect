<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_products extends CI_Controller
{

	function __construct()
	{ 
		parent::__Construct();
		$this ->load->model('Products_Model');
		$this->load->library('pagination');
		
		//$this->form_validation->set_rules('marca', 'Marca', 'required|min_length[3]');
		//$this->form_validation->set_rules('pantalla', 'Pantalla', 'required|min_length[3]');
		//$this->form_validation->set_rules('ram', 'Memoria Ram', 'required|min_length[3]');
		//$this->form_validation->set_rules('procesador', 'Procesador', 'required|min_length[3]');
		//$this->form_validation->set_rules('disco_duro', 'Disco Duro', 'required|min_length[3]');
		//$this->form_validation->set_rules('precio', 'Precio','required|min_length[6]');     	    
		//$this->form_validation->set_message('required', 'el campo %s es requerido');			
		//$this->form_validation->set_error_delimiters('<ul><li>', '</li></ul>');	
    }
	
	//Esta funcion es controla la ventana de Busqueda por NIS en la aplicacion
	function index()
	{
		//aqui se realizan los cambios a busqueda por nis

		$pagination = 6;
	    //$config['base_url'] = base_url().'index.php/manage_products/index'; 	
	    $config['base_url'] = base_url().'manage_products/index';  
	    $config['total_rows'] = $this->db->get('productos')->num_rows();
	    $config['per_page'] = $pagination;
	    $config['num_links'] = 20;
	    $config['next_link'] = 'Siguiente »';
	    $config['prev_link'] = '« Anterior';
		
	    $this->pagination->initialize($config);
			
		$this->table->set_heading(
								'Fecha',
								'ID Dispositivo',
								'PIN', 
								'N° Celular',
								'Foto Lectura',
								'Foto Serie',
								'Foto Recibo',
								'Serie',
								'Lectura Anterior',
								'Lectura Actual',
								'Consumo m³',
								'Anomalia/Comentario',
								'Editar',''
								);

		$tmpl = array ( 'table_open'  => '<table border="1" id="table">' );
		$this->table->set_template($tmpl); 
	      	
		$data['title'] = 'Busqueda por NIS';
		
		$data['results'] = $this->Products_Model->get_products($pagination, $this->uri->segment(2));
			
		$this->load->view('admin/header_admin',$data);
		$this->load->view('admin/products/products');
		$this->load->view('front/footer');
	}

	function edit()
	{
		$Nis = $this->input->get('Nis'); 
		$data['title'] = 'Editar Producto'; 
		$data['results'] = $this->Products_Model->get($Nis);
		
		$this->load->view('admin/header_admin',$data);
		$this->load->view('admin/products/edit_product');
		$this->load->view('front/footer');
	}

	function add()
	{
		$data['title'] = 'Editar Lectura';

		if ($this->form_validation->run() == FALSE)
		{			
			$this->load->view('admin/header_admin',$data);
			$this->load->view('admin/products/new_product');
			$this->load->view('front/footer');		
		}
		else
		{
			$insert = $this->Products_Model->update_product();
				
			if($insert)
			{
				
				$data['title'] = 'La lectura se cre&oacute; correctamente.'; 
				$this->load->view('admin/header_admin',$data);
				$this->load->view('admin/success');
				$this->load->view('front/footer');
			}
			else
			{	
				$this->load->view('admin/header_admin',$data);
				$this->load->view('admin/products/new_product');
				$this->load->view('front/footer');
			}	
		}
	}
	  
//	function Buscar_Nis()
//	{
//		$id = $this->input->get('product'); 
//		$data['title'] = 'Busqueda NIS'; 
//		$data['results'] = $this->Products_Model->get($id);
//		
//		$this->load->view('admin/header_admin',$data);
//		$this->load->view('admin/products/edit_product');
//		$this->load->view('front/footer');
//	}

	function update()
	{
		$data['title'] = 'Editar Lectura';
		$data['Nis'] = $this->input->post('Nis'); 

		if ($this->form_validation->run() == FALSE)
		{			
			$this->load->view('admin/header_admin',$data);
			$this->load->view('admin/products/edit_product');
			$this->load->view('front/footer');		
		}
		else
		{
			$insert = $this->Products_Model->update_product($this->input->post('Nis'));
		if($insert)
		{
			$data['title'] = 'La lectura se actualiz&oacute; correctamente.'; 
			$this->load->view('admin/header_admin',$data);
			$this->load->view('admin/success');
			$this->load->view('front/footer');
		}
		else
		{
			$this->load->view('admin/header_admin',$data);
			$this->load->view('admin/products/edit_product');
			$this->load->view('front/footer');	
		}	
	}

}

function delete()
	{
		if(FALSE === ($products = $this->input->post('products')))
		{
			redirect('manage_products','location');
		}
		foreach($products as $product)
		{
			$delete = $this->Products_Model->delete_product($product);
		}
	   	if($delete)
	   	{  // Setiamos el mensaje utilizando flashdata.
			$this->session->set_flashdata('eliminado', 'El producto fue eliminado correctamente');
	   	}
	   	else
	   	{
	   		$this->session->set_flashdata('eliminado', 'El producto no pudo ser eliminado');
	   	}
	   		redirect('manage_products','location'); // ó redirect('manage_products', 'refresh');
		}   
	}// fin de la clase