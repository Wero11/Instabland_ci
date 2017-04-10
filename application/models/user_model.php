<?php 

class User_model extends CI_Model{
	
	public function getLists(){
		$this->db->order_by('users.id', 'asc');
		$query = $this->db->get('users');
		if( $query->num_rows() > 0 ) {
			return $query->result();
		}
		return NULL;
	}
	
	public function getList($email,$password){
		$this->db->order_by('users.id', 'asc');
		$this->db->where("email",$email);
		$this->db->where("password",$password);
		$query = $this->db->get('users');
		if( $query->num_rows() > 0 ) {
			return $query->result();
		}
		return false;
	}
	
	public function record_count() {
		return $this->db->count_all("users");
	}
	
	public function fetch_all_users($limit, $start) {
		$this->db->limit($limit, $start);
		$this->db->order_by('users.id', 'asc');
		$query = $this->db->get("users");
	
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return false;
	}
	
	public function fetch_users($limit, $start) {
		$this->db->limit($limit, $start);
		$this->db->order_by('users.id', 'asc');
		$this->db->where("isAdmin",0);
		$query = $this->db->get("users");
	
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return false;
	}
	
	public function fetch_admins($limit, $start) {
		$this->db->limit($limit, $start);
		$this->db->order_by('users.id', 'asc');
		$this->db->where("isAdmin",1);
		$query = $this->db->get("users");
	
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return false;
	}
	
	public function addRow($data){
		$this->db->insert('users', $data);
	}
	
	public function updateRow($id, $data){
		$this->db->where("id", $id);
		$this->db->update("users", $data);
	}
	
	public function deleteRow($id){
		$this->db->where("id",$id);
		$this->db->delete('users');
		return 'success';
	}
	
	public function user_item($id){
		$this->db->where('id', $id);
		$query = $this->db->get('users');
		return $query->row();
	}
}
?>