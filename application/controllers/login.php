<?php 

//pagina principal de logueo

class Login extends CI_Controller
{
	
   function __construct() 
   { 
		parent::__construct();
		$this ->load->model('Login_Model');		
   }
   
	function index()
	{  // reglas de validación para el inicio de sesion

	 //$this->output->enable_profiler(TRUE);
       $this->form_validation->set_rules('username', 'Usuario', 'required|xss_clean|callback__valid_login');
	   $this->form_validation->set_rules('password', 'Contraseña','|md5|required|xss_clean');
	   
	   $this->form_validation->set_message('required', 'el campo %s es requerido');
       $this->form_validation->set_message('_valid_login', 'El usuario o contraseña son incorrectos');
	   
	   $this ->form_validation -> set_error_delimiters('<ul><li>', '</li></ul>');
     
		if ($this->form_validation->run() == FALSE)
		{
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
			$this->load->view('admin/header_admin',$data);
            $this->load->view('admin/admin');
			$this->load->view('front/footer');
	}

	//Esta funcion afecta el inicio de sesion
	function _valid_login($username,$password)
	{ 
	    $username = $this->input->post('username');
	    $password = md5($this->input->post('password'));
        return $this->Login_Model->valid_user($username,$password);
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
					 
				$this->Login_Model->valid_user_ajax($username);	
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

	//Esta funcion es para guardar la latitud, longitud, etc del mapa.
	public function salvar() 
		{		
			$this->form_validation->set_rules('lat', 'Latitud');
			$this->form_validation->set_rules('lon', 'Longitud');
			$this->form_validation->set_rules('nom', 'Nombre');
			$this->form_validation->set_rules('des', 'Descripcion');
			$data=array();
			if($this->form_validation->run()===TRUE) 
				{					
					$this->mapa_model->salvar();
				}		
			$this->jsonReturn($data);
			}

	//Esta funcion es para mostrar la informacion guardada del mapa
	public function mostrar() 
		{
			$data=$this->mapa_model->mostrar();
			$this->jsonReturn($data);
		}

	//Esta funcion es la eencargada del metodo Json que esta usando la aplicacion
	private function jsonReturn($data) 
		{
			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode($data));
		}
}