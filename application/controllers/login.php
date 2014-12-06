<?php 

//controlador de la pagina principal de logueo

class Login extends CI_Controller
{
	
   function __construct() 
   { 
		parent::__construct();
		$this ->load->model('login_model');		
   }
   
   	//Esta funcion define las reglas de validación para el inicio de sesion
	function index()
	{ 

	 //$this->output->enable_profiler(TRUE);
       $this->form_validation->set_rules('username', 'Usuario', 'required|xss_clean|callback__valid_login');
	   $this->form_validation->set_rules('password', 'Contraseña','|md5|required|xss_clean');
	   
	   $this->form_validation->set_message('required', 'el campo %s es requerido');
       $this->form_validation->set_message('_valid_login', 'El usuario o contraseña son incorrectos');
	   
	   $this ->form_validation -> set_error_delimiters('<ul><li>', '</li></ul>');
     
		if ($this->form_validation->run() == FALSE)
		{
			//Aqui se le cambia el nombre a la aplicacion
			$data['title'] = 'Nombre de Aplicacion';

			$this->load->view('admin/login',$data);
		}
		else
		{
			$username = $this->input->post('username');
			$data_user = $array = array('user'=> $username, 'logued_in' => TRUE);
			 
			// asignamos dos datos a la sesión --> (username y logued_in)									 
			$this->session->set_userdata($data_user);
			$this->load->helper('url');
             redirect('login/principal/', 'refresh');	
		}
  	}

  	//En esta funcion se afecta el Mapa y en general la ventana Inicio
	public function principal()
	{
		$data['title'] = 'Administrador'; 
			$data['user'] = $this->session->userdata('user');  // = $this->session->userdata('user');
			$data['scripts']='<script src="'.base_url('assets/js/jquery-1.11.1.min.js').'"></script>'.
				'<script src="'.base_url('assets/js/bootstrap.js').'"></script>'.
				'<script src="'.base_url('assets/js/mapa.js').'"></script>';
				//$view=$this->load->view('admin', $data, TRUE);		
				//$this->output->set_output($view);			
			$this->load->view('admin/header_admin',$data);
            $this->load->view('admin/admin');
			$this->load->view('front/footer');
	}

	//Esta funcion es para guardar la latitud, longitud, etc del mapa.
	public function buscar() 
		{		
			$this->form_validation->set_rules('lat', 'Latitud');
			$this->form_validation->set_rules('lon', 'Longitud');
			$data=array();
			if($this->form_validation->run()===TRUE) 
				{					
					$data=$this->login_model->buscar();
				}		
			$this->jsonReturn($data);
		}

	//Esta funcion es para mostrar la informacion guardada del mapa
	public function mostrar() 
		{
			$data=$this->login_model->mostrar();
			$this->jsonReturn($data);
		}

	//Esta funcion es la eencargada del metodo Json que esta usando la aplicacion
	private function jsonReturn($data) 
		{
			$this->output->set_content_type('application/assets/json');
			$this->output->set_output(json_encode($data));
		}

	//Esta funcion afecta el inicio de sesion
	function _valid_login($username,$password)
	{ 
	    $username = $this->input->post('username');
	    $password = md5($this->input->post('password'));
        return $this->login_model->valid_user($username,$password);
	}

	//Esta funcion es el metodo ajax para conectarse a la sesion
	function valid_login_ajax()
	{
		//verificamos si la petición es via ajax
		if($this->input->is_ajax_request())
		{
			if($this->input->post('username')!=='')
			{
				$username = $this->input->post('username');
					 
				$this->login_model->valid_user_ajax($username);	
			}
		}
		else
		{
			redirect('login');
		}
	} // fin del método valid_login_ajax
	
	//Esta funcion es para desconectarse de la sesion
	function logout()
	{
        $this->session->sess_destroy(); 
		redirect('login');		
	}
}