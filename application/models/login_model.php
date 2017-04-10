<?php 

class Login_model extends CI_Model{
	
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	function Isadmin($email,$password){
		$this->db->select('*');
		$this->db->where('email',$email);
		$this->db->where('password',$password);
		//$this->db->where('level','admin');
		$query = $this->db->get('users');
		$row = $query->result();
		if( $query->num_rows() > 0 ) {
			$this->session->set_userdata('admin', '');
			$this->session->set_userdata('user', 'true');
			
			if ( $row[0]->isAdmin == 1 ) {
				$this->session->set_userdata('admin', 'true');
			}
			$this->session->set_userdata('mine', $row[0]->id);
			return 'true';
		} else {
			return 'false';
		}
	}
}
?>