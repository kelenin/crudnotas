<?php


	class Crud_model extends CI_Model {
		function __construct(){
			parent::__construct();
			$this->load->database();
		}

		public function record_count()
		{
			return $this->db->count_all('crud');
		}

		public function get_news()
		{

				$this->db->select('n.id,d.name, n.description,n.name_cliente,n.company,n.phone, u.name as nombre_usu,
									s.name as name_status, s.code as codestatus,n.observation as observ,
									n.deleted_date,n.reactiva_date');
							$this->db->from('notas as n');
							$this->db->join('department as d','d.id = n.id_departament');
							$this->db->join('users as u','u.id = n.id_users');
							$this->db->join('status as s','s.id = n.status');
							$this->db->order_by('n.id','ASC');
				

			$query = $this->db->get();

			return $query->result();

		}

		public function get_newdepart($id_departament)
		{

			$this->db->select('n.id,d.name, n.description,n.name_cliente,n.company,n.phone, u.name as nombre_usu,
									s.name as name_status, s.code as codestatus,n.observation as observ,
									n.deleted_date,n.reactiva_date');
							$this->db->from('notas as n');
							$this->db->join('department as d','d.id = n.id_departament');
							$this->db->join('users as u','u.id = n.id_users');
							$this->db->join('status as s','s.id = n.status');
							$this->db->where('n.id_departament', $id_departament);
							$this->db->order_by('n.id','ASC');
		

	
			$query = $this->db->get();

			return $query->result();

		}

		function userListingCount($searchText = '')
		{

			$this->db->select('n.id,d.name, n.description,n.name_cliente,n.company,n.phone, u.name as nombre_usu,
									s.name as name_status, s.code as codestatus,n.observation as observ,
									n.deleted_date,n.reactiva_date');
							$this->db->from('notas as n');
							$this->db->join('department as d','d.id = n.id_departament');
							$this->db->join('users as u','u.id = n.id_users');
							$this->db->join('status as s','s.id = n.status');
							if(!empty($searchText)) {
								$likeCriteria = "(n.id  LIKE '%".$searchText."%'
												OR  n.nombre_usu  LIKE '%".$searchText."%'
												OR  s.code  LIKE '%".$searchText."%'
												OR  n.description  LIKE '%".$searchText."%')";
								$this->db->where($likeCriteria);
							}
							
			$query = $this->db->get();
			
			return $query->num_rows();
		}

		function getNotasInfo($notasId)
		{
			$query = $this->db->query("SELECT n.id,n.description, n.status,n.id_departament,n.observation
			FROM notas as n
			INNER JOIN status as s ON n.status=s.id
			WHERE n.id =".$notasId."");
			return $query->row();
			
		}

		function editNotass($notasInfo, $notasId)
		{
			$this->db->where('id', $notasId);
			$this->db->update('notas', $notasInfo);
			
			return TRUE;
		}

		function addNewNotas($addnotasdInfo)
		{
			$this->db->trans_start();
			$this->db->insert('notas', $addnotasdInfo);
			
			$insert_id = $this->db->insert_id();
			
			$this->db->trans_complete();
			
			return $insert_id;
		}

		function deleteNotas($deletednotasdInfo,$id)
		{
			$this->db->where('id', $id);
			$this->db->update('notas', $deletednotasdInfo);
			
			return TRUE;
		}

		function activarNotas($activarnotasdInfo,$id)
		{
			$this->db->where('id', $id);
			$this->db->update('notas', $activarnotasdInfo);
			
			return TRUE;
		}
		

	}
?>