<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	
	public $session;


	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('login_model');
	}

	public function index(){
		//load session library
		$this->load->library('session');

		if($this->session->userdata('user')){
			$this->load->view('back_end/login_page');

		}
		else{
			$this->load->view('back_end/login_page');
		}
	}

	public function login(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST') 
		{

			$this->load->library('session');


			// Variables del formulario
			$emails = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;
			$password = isset($_REQUEST['password']) ? $_REQUEST['password'] : null;

			if($emails==null || $password=='')
			{
			   $this->session->set_flashdata('success','El email y la contraseña no pueden estar vacios');
			   $this->index();


			}
			else
			{
				$emails=strtoupper($emails);
				
				$data = $this->login_model->get_user_login($emails, $password);


				//print_r($data); die();
			
				if ($data) 
				{

					// Variables de la base de datos
					$IdUser = $data->id;
					$nameuser = $data->name;
					$correouser = strtoupper($data->username);
					$passworduser = password_hash($data->password,PASSWORD_BCRYPT);
					$iddepart = $data->id_department;
					$namedepart = $data->namedepart;
					$idrol = $data->id_rol; 
					$namerol = $data->namerol;                       

					// Comprobamos si los datos son correctos
					if ($correouser == $emails && password_verify($password,$passworduser)) {
						// Si son correctos, creamos la sesión
	

						$datas = $this->login_model->get_user_loginarray($emails, $password);

						$this->session->set_userdata('user', $datas);

						redirect('crud');

					} else {
						$this->session->set_flashdata('success','El email o la contraseña es incorrecta.');
						$this->index();

					}

				}
				else{
					$this->session->set_flashdata('success','El correo no se encuentra registrado. Por favor verifique.');
					$this->index();

				}

				
			}

			
		}
	}

	public function home(){
		//load session library
		$this->load->library('session');

		//restrict users to go to home if not logged in
		if($this->session->userdata('user')){
			$this->load->view('back_end/home');
		}
		else{
			//redirect('/');
			redirect('login_page');
		}
		
	}

	function logout(){
		//load session library
		$this->load->library('session');
		$this->session->unset_userdata('user');
		redirect('/');
	}

}
