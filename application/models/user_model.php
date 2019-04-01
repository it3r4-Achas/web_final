<?php

	class User_model extends CI_Model {


		public function save($data){


			$this->db->insert('blog',$data);
			return $this->db->affected_rows();


		}

		public function check_id($email) {
			$this->db->select('id');
			$this->db->from('users');
			$this->db->where('email', $email);
			$query = $this->db->get();
			return $query->result_array();
		}


		public function save_update($data, $id){



			$this->db->where('id', $id);
			$this->db->update('blog', $data);
			return $this->db->affected_rows();

		}

		public function get_users($id) {
			$this->load->database();
			$this->db->select('id,username,email');
			$this->db->where('id',$id);
			$query = $this->db->get('blog');
			return $query->result_array();
		}
		public function get_blogs($id) {
			$this->load->database();
			$this->db->select('id,words,image,Title');
			$this->db->where('id',$id);
			$query = $this->db->get('blog');
			return $query->result_array();
		}

		public function view_all(){
			 $this->db->select('id,words,image,Title');
			$result    =  $this->db->get('blog');

			return $result->result_array();
		 }

		 public function view_all_users(){
			 $this->db->select('id,username,email,password');
			$result    =  $this->db->get('users');

			return $result->result_array();
		 }
		

		public function update_email($id,$data) {

			$this->db->where('id', $id);
			$this->db->update('users', $data);
		}

		public function check_email($email){
			$this->db->where('email',$email);
			$query = $this->db->get('users');
			return $query->num_rows();
		}

		public function check_valid($email,$password){
			$this->db->select('password');
			$this->db->from('users');
			$this->db->where('email', $email);
			$query = $this->db->get();
			$original = "";
			foreach ($query->result() as $row)
			{
			        $original = $row->password;
			}
			$valid = password_verify($password, $original);
			return $valid;
		}

		public function check_user($id){
			$this->db->where('id',$id);
			$query = $this->db->get('users');
			return $query->num_rows();
		}

		public function delete_user($id){

			$this->db->where('id', $id);
			$this->db->delete('users');
			return $this->db->affected_rows();
		}
	}