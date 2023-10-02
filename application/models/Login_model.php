<?php
	class Login_model extends CI_Model {
		function __construct(){
			parent::__construct();
			$this->load->database();
		}

		public function get_user_login($email, $password){

			$this->db->select('u.id, u.name, u.username, u.password, u.id_department,d.name as namedepart, 
			u.id_rol, r.name as namerol');
			$this->db->from('users as u');
			$this->db->join('department as d','d.id = u.id_department');
			$this->db->join('roles as r','r.id = u.id_rol');
			$this->db->where('u.username', $email);

			$query = $this->db->get();
            
            return $data = $query->row();

		}

		public function get_user_loginarray($email, $password){

			$this->db->select('u.id, u.name, u.username, u.password, u.id_department,d.name as namedepart, 
			u.id_rol, r.name as namerol,d.code as code_depart, r.code as code_rol');
			$this->db->from('users as u');
			$this->db->join('department as d','d.id = u.id_department');
			$this->db->join('roles as r','r.id = u.id_rol');
			$this->db->where('u.username', $email);

			$query = $this->db->get();
            

			return $query->row_array();

		}

	}
?>