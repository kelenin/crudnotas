<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Crud extends CI_Controller {

    
    public $session;

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('crud_model');

	}

    public function index()
    { 
        $this->load->library('session');

		//restrict users to go back to login if session has been set
		if($this->session->userdata('user')){
            $this->NotasListing();

		}
		else{
			$this->load->view('back_end/login_page');
		}

    }

	function NotasListing()
    {
		$this->load->library('session');

		$user = $this->session->userdata('user');
        //print_r($user);
		extract($user);

		if($code_depart=='AC' && $code_rol=='JF')
		{
       		$data['crud'] = $this->crud_model->get_news();
		}
		else{
			$data['crud'] = $this->crud_model->get_newdepart($id_department);
		}

        $this->load->view('back_end/home', $data);
    }

	function addNotas()
    {
            $this->load->model('crud_model');	
        

			$this->load->view('back_end/crud/create');


    }

	function addNewNotas()
    {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('departamento','Departamento','trim|required');
			$this->form_validation->set_rules('description','Descripción','trim|required');
            $this->form_validation->set_rules('name_cliente','Nombre del Cliente','trim|required');
			$this->form_validation->set_rules('company','Compañia','trim|required');
			$this->form_validation->set_rules('phone','Telefono','trim|required');

            if($this->form_validation->run() == FALSE)
            {
                $this->addNotas();
            }
            else
            {   //pre($_POST); die;
                $departamento = $this->security->xss_clean($this->input->post('departamento'));
                $description = trim(strtoupper(strtolower($this->security->xss_clean($this->input->post('description')))));
                $name_cliente = trim(strtoupper(strtolower($this->security->xss_clean($this->input->post('name_cliente')))));
				$company = trim(strtoupper(strtolower($this->security->xss_clean($this->input->post('company')))));
				$phone = $this->security->xss_clean($this->input->post('phone'));

                $user = $this->session->userdata('user');

                extract($user);
        
                
                $addnotasdInfo = array('id_departament'=> $departamento, 'description'=>$description,
                                    'name_cliente'=>$name_cliente, 'company'=> $company, 'phone'=> $phone, 
                                    'id_users'=> $id, 'created_date'=>date('Y-m-d H:i:s'),'status'=>1);
                
                $this->load->model('crud_model');
                $result = $this->crud_model->addNewNotas($addnotasdInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success_uno', 'Se agrego el registro con exito');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Fallo el registro');
                }
                
                redirect('addNotas');
            }
    }

	function modifyNotas($notasId = NULL)
    {
            if($notasId == null)
            {
                redirect('NotasListing');
            }

			$this->load->library('session');

			$data['editInfo'] = $this->crud_model->getNotasInfo($notasId);

            $this->load->view('back_end/crud/update',$data);


    }
	function editNotas()
    {
		$this->load->library('form_validation');
		
		$notasId = $this->input->post('notasId');
		
		$this->form_validation->set_rules('fname','Descripcion','trim|required|max_length[128]');
		$this->form_validation->set_rules('statusupd','Estatus','trim|required');
        $this->form_validation->set_rules('observ','Observacion','trim|required');

		if($this->form_validation->run() == FALSE)
		{
			$this->modifyNotas($notasId);
		}
		else
		{
			$descripcion = trim(strtoupper($this->security->xss_clean($this->input->post('fname'))));
			$statusupd = strtolower($this->security->xss_clean($this->input->post('statusupd')));
			$observ = trim(strtoupper($this->security->xss_clean($this->input->post('observ'))));
			
			$notasInfo = array();
			
			if($descripcion)
			{
													
			    $notasInfo = array('description'=> $descripcion, 'status'=>$statusupd, 'observation'=>$observ, 'update_date'=>date('Y-m-d H:i:s'));
			}
			
			
			$result = $this->crud_model->editNotass($notasInfo, $notasId);
			
			if($result == true)
			{
				$this->session->set_flashdata('success_dos', 'Fue actualizado con exito');
			}
			else
			{
				$this->session->set_flashdata('error', 'Fallo al actualizacion');
			}
			
			redirect('modifyNotas/'.$notasId.'');
		}
    

    }

    function deleteNotas($notasId = NULL)
    {
            if($notasId == null)
            {
                redirect('NotasListing');
            }

			$this->load->library('session');

            $deletednotasdInfo = array('deleted_date'=>date('Y-m-d H:i:s'));
            
            $result = $this->crud_model->deleteNotas($deletednotasdInfo,$notasId);
         
            if ($result ==TRUE) { redirect('NotasListing'); }
            else { echo(json_encode(array('status'=>FALSE))); }
        
    }

    function activarNotas($notasId = NULL)
    {
            if($notasId == null)
            {
                redirect('NotasListing');
            }

			$this->load->library('session');

            $activarnotasdInfo = array('reactiva_date'=>date('Y-m-d H:i:s'));
            
            $result = $this->crud_model->activarNotas($activarnotasdInfo,$notasId);
            
            if ($result ==TRUE) { redirect('NotasListing'); }
            else { echo(json_encode(array('status'=>FALSE))); }
        
    }


}
